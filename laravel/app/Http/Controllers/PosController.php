<?php

namespace App\Http\Controllers;

use App\Models\PembelianDetail;
use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\PenjualanDetail;
use App\Models\StokOpname;
use Illuminate\Support\Facades\DB;
use PDF;

class PosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $penjualan = Penjualan::all();
        $produk = Produk::query()->join('barang_masuk_detail', 'barang.id_barang', '=', 'barang_masuk_detail.id_barang')->get();

        $y = date('Y');
        $m = date('m');
        $d = date('d');

        $cek = Penjualan::orderBy('id_barang_keluar', 'DESC')->first();

        if ($cek == false) {
            $latest = 0;
        } else {
            $latest = $cek->id_barang_keluar;
        }

        $invoice = 'TRX' . $y . $m . $d . ((int)$latest + 1);
        return view('page.pos.hal-pos', ['penjualan' => $penjualan, 'produk' => $produk, 'invoice' => $invoice]);
    }



    public function show_cart(Request $request)
    {
        $cart = DB::table('barang_keluar_detail')
            ->select('barang_keluar_detail.*', 'barang.nama_barang')
            ->join('barang', 'barang_keluar_detail.id_barang', '=', 'barang.id_barang')
            ->where('barang_keluar_detail.no_transaksi', $request->no_transaksi)
            ->get();

        return view('page.pos.show-cart', ['cart' => $cart]);
    }


    public function show_form_cart(Request $request)
    {
        $subtotal = PenjualanDetail::where('no_transaksi', $request->no_transaksi)->sum('subtotal');
        $total_item = PenjualanDetail::where('no_transaksi', $request->no_transaksi)->sum('jumlah');


        $data = array([
            'subtotal' => $subtotal,
            'total_item' => $total_item
        ]);

        return response()->json($data);
    }



    public function add_cart(Request $request)
    {
        $id_barang = $request->id_produk;
        $jumlah_keluar = $request->jumlah;
        $no_transaksi = $request->no_transaksi;

        // Ambil batch barang masuk sesuai FIFO (urutan tanggal masuk)
        $batchMasuk = DB::table('barang_masuk_detail')
            ->where('id_barang', $id_barang)
            ->where('sisa', '>', 0)
            ->orderBy('created_at', 'asc')
            ->get();

        $sisa = $jumlah_keluar;

        foreach ($batchMasuk as $batch) {
            if ($sisa <= 0) break;

            $ambil = min($sisa, $batch->jumlah);

            // Cek apakah item ini sudah ada di detail dengan harga_jual yg sama (opsional)
            $existing = PenjualanDetail::where([
                ['no_transaksi', $no_transaksi],
                ['id_barang', $id_barang],
                ['harga_jual', $batch->harga_jual]
            ])->first();

            if ($existing) {
                $existing->jumlah += $ambil;
                $existing->subtotal = $existing->jumlah * $batch->harga_jual;
                $existing->save();
            } else {
                PenjualanDetail::create([
                    'no_transaksi' => $no_transaksi,
                    'id_barang' => $id_barang,
                    'harga_modal' => $batch->harga_beli,
                    'harga_jual' => $batch->harga_jual,
                    'jumlah' => $ambil,
                    'subtotal' => $batch->harga_jual * $ambil,
                    'id_barang_masuk' => $batch->id_barang_masuk_detail, // Simpan ID barang masuk untuk referensi
                ]);
            }

            // Kurangi stok pada barang masuk
            DB::table('barang_masuk_detail')->where('id_barang_masuk_detail', $batch->id_barang_masuk_detail)
                ->update(['sisa' => $batch->sisa - $ambil]);

            $sisa -= $ambil;
        }

        if ($sisa > 0) {
            return response()->json(['status' => 'error', 'message' => 'Stok tidak mencukupi.'], 400);
        }

        return response()->json(['status' => 'success']);
    }


    public function kurang_cart(Request $request)
    {

        $pen_detail = PenjualanDetail::find($request->id_detail);

        $produk = Produk::find($pen_detail->id_barang);

        $barang_masuk_detail = PembelianDetail::where('id_barang_masuk_detail', $pen_detail->id_barang_masuk)->first();
        $barang_masuk_detail->sisa = $barang_masuk_detail->sisa + 1;
        $barang_masuk_detail->save();

        $pen_detail->jumlah = $pen_detail->jumlah - 1;

        $pen_detail->save();
    }

    public function hapus_cart(Request $request)
    {
          $detail = PenjualanDetail::find($request->id_detail);

        // Tambah stok ke barang_masuk_detail
      
           $barang_masuk_detail = PembelianDetail::where('id_barang_masuk_detail',$detail->id_barang_masuk)->first();
            $barang_masuk_detail->sisa = $barang_masuk_detail->sisa + $detail->jumlah;
            $barang_masuk_detail->save();
       

        $pen_detail = PenjualanDetail::find($request->id_detail);
        $pen_detail->delete();
    }

    public function simpan_penjualan(Request $request)
    {

        $pen = new Penjualan;

        $pen->no_transaksi = $request->no_transaksi;
        $pen->nama_pelanggan = $request->nama_pelanggan;
        $pen->telepon = $request->telepon;
        $pen->total_item = $request->total_item;
        $pen->total_harga = $request->total_harga;
        $pen->bayar = $request->bayar;
        $pen->kembali = $request->kembali;
        $pen->metode_pembayaran = $request->metode_pembayaran;
        $pen->id_user = $request->id_user;
        $pen->created_at = $request->tgl2;

        $pen->save();


        $detail = PenjualanDetail::where('no_transaksi', $request->no_transaksi)->get();



        foreach ($detail as $item) {
            $produk = Produk::find($item->id_barang);
            $produk->stok = $produk->stok  - $item->jumlah;
            $produk->save();



            $stok_opname = StokOpname::where('id_barang', $item->id_barang)->first();
            if ($stok_opname == true) {
                $stok_opname->jumlah_fisik = $stok_opname->jumlah_fisik - $item->jumlah;
                $stok_opname->save();
            } else {
                StokOpname::create([
                    'id_barang' => $item->id_barang,
                    'jumlah_fisik' => 0,
                    'keterangan' => '-',
                ]);
            }
        }
    }


    public function cetak_faktur(Request $request)
    {
        // Ambil data penjualan utama
        $penjualan = Penjualan::query()
            ->select('barang_keluar.*', 'users.name')
            ->leftJoin('users', 'barang_keluar.id_user', '=', 'users.id')
            ->where('barang_keluar.no_transaksi', $request->no_transaksi)
            ->first();

        // Ambil detail penjualan dengan FIFO berdasarkan barang masuk tertua
        $detail = PenjualanDetail::query()
            ->select('barang_keluar_detail.*', 'barang.nama_barang', 'fifo.harga_jual as harga')
            ->join('barang', 'barang_keluar_detail.id_barang', '=', 'barang.id_barang')
            ->join(DB::raw('
                    (
                        SELECT bmd1.id_barang, bmd1.harga_jual
                        FROM barang_masuk_detail bmd1
                        INNER JOIN (
                            SELECT id_barang, MIN(created_at) as min_date
                            FROM barang_masuk_detail
                            GROUP BY id_barang
                        ) bmd2 ON bmd1.id_barang = bmd2.id_barang AND bmd1.created_at = bmd2.min_date
                    ) as fifo
                '), 'barang.id_barang', '=', 'fifo.id_barang')
            ->where('barang_keluar_detail.no_transaksi', $request->no_transaksi)
            ->get();

        // Set ukuran kertas dan generate PDF
        $customPaper = array(0, 0, 400, 500);
        $pdf = Pdf::loadView('page.pos.faktur', [
            'penjualan' => $penjualan,
            'detail' => $detail
        ])->setPaper($customPaper);

        return $pdf->stream('faktur.pdf');
    }




    public function show_produk_pos(Request $request)
    {
        // Subquery: Ambil entri barang_masuk_detail paling awal (FIFO) dengan jumlah > 0 per barang
        $sub = DB::table('barang_masuk_detail')
            ->where('jumlah', '>', 0)
            ->select('id_barang', DB::raw('MIN(created_at) as earliest'))
            ->groupBy('id_barang');

        // Query utama: Join dengan subquery FIFO
        $produk = DB::table('barang')
            ->join('barang_masuk_detail', function ($join) use ($sub) {
                $join->on('barang.id_barang', '=', 'barang_masuk_detail.id_barang')
                    ->joinSub($sub, 'fifo', function ($join2) {
                        $join2->on('barang_masuk_detail.id_barang', '=', 'fifo.id_barang')
                            ->on('barang_masuk_detail.created_at', '=', 'fifo.earliest');
                    });
            })
            ->where('barang_masuk_detail.jumlah', '>', 0) // pastikan jumlah > 0
            ->select('barang.nama_barang', 'barang.stok', 'barang.id_barang', 'barang_masuk_detail.harga_jual')
            ->get();

        return view('page.pos.show-produk-pos', ['produk' => $produk]);
    }

    public function cari_produk_pos(Request $request)
    {
        // Subquery: Ambil entri barang_masuk_detail paling awal (FIFO) dengan jumlah > 0 per barang
        $sub = DB::table('barang_masuk_detail')
            ->where('jumlah', '>', 0)
            ->select('id_barang', DB::raw('MIN(created_at) as earliest'))
            ->groupBy('id_barang');

        // Query utama: Join dengan subquery FIFO
        $produk = DB::table('barang')
            ->join('barang_masuk_detail', function ($join) use ($sub) {
                $join->on('barang.id_barang', '=', 'barang_masuk_detail.id_barang')
                    ->joinSub($sub, 'fifo', function ($join2) {
                        $join2->on('barang_masuk_detail.id_barang', '=', 'fifo.id_barang')
                            ->on('barang_masuk_detail.created_at', '=', 'fifo.earliest');
                    });
            })
            ->where('barang_masuk_detail.jumlah', '>', 0)
            ->where('barang.nama_barang', 'LIKE', '%' . $request->cariproduk . '%')
            ->select('barang.nama_barang', 'barang.stok', 'barang.id_barang', 'barang_masuk_detail.harga_jual')
            ->get();

        return view('page.pos.show-produk-pos', ['produk' => $produk]);
    }
}
