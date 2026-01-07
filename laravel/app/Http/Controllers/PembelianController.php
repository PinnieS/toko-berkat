<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PembelianDetail;
use App\Models\Supplier;
use PDF;

class PembelianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pembelian =PembelianDetail::select('barang_masuk_detail.jumlah','barang_masuk_detail.harga_beli','barang_masuk.no_transaksi','barang_masuk_detail.harga_jual','barang_masuk_detail.sisa','barang_masuk.created_at','barang_masuk.nama_pemasok','barang.nama_barang','barang_masuk.total_harga')->join('barang_masuk','barang_masuk_detail.no_transaksi','=','barang_masuk.no_transaksi')->join('barang','barang_masuk_detail.id_barang','=','barang.id_barang')->orderBy('created_at', 'DESC')->get();
        return view('page.pembelian.data', ['pembelian' => $pembelian]);
    }

    public function create()
    {
        $produk = Produk::all();
        $y = date('Y');
        $m = date('m');
        $d = date('d');

        $cek = Pembelian::orderBy('id_barang_masuk','DESC')->first();

        $detail = PembelianDetail::join('barang','barang_masuk_detail.id_barang','=','barang.id_barang')->where('no_transaksi','=',NULL)->get();

        if ($cek==false) {
            $latest=0;
        } else {
            $latest= $cek->id_barang_masuk;
        }

        $supplier = Supplier::all();
        
        $invoice = 'TRP' .$y.$m.$d. ((int)$latest+1);
        return view('page.pembelian.tambah',['produk'=>$produk,'invoice'=>$invoice,'detail'=>$detail,'supplier'=>$supplier]);
    }

    public function tambah_item_pembelian(Request $request)
    {   
        $produk = Produk::find($request->id_barang);
        $pen_detail = PembelianDetail::where([['no_transaksi','=',NULL],['id_barang',$request->id_produk]])->first();

        if ($pen_detail==true) {
           $pen_detail->jumlah = $pen_detail->jumlah + $request->jumlah;
           $pen_detail->subtotal = ($request->harga_beli * $pen_detail->jumlah);
           $pen_detail->save();
        }else {
            PembelianDetail::create([
                'no_transaksi'=>NULL,
                'id_barang'=>$request->id_produk,
                'harga_beli'=>$request->harga_beli,
                'harga_jual'=>$request->harga_jual,
                'jumlah'=>$request->jumlah,
                'sisa'=>$request->jumlah,
                'subtotal'=>($request->harga_beli * $request->jumlah),
               
            ]);
        }

        return redirect('pembelian/create')->with('success',"Berhasil Ditambahkan");
    }

    public function store(Request $request)
    {
        $detail = PembelianDetail::where('no_transaksi','=',NULL)->get();

        

        $total_item = 0;
        $subtotal = 0;
        foreach ($detail as $item) {
            $total_item = $total_item + $item->jumlah;
            $subtotal = $subtotal + $item->subtotal;
            $item->no_transaksi = $request->no_transaksi;
            $item->save();

            $produk = Produk::find($item->id_barang);
            $produk->stok = $produk->stok + $item->jumlah;
            $produk->save();
        }

        $supplier = Supplier::find($request->id_supplier);

        $pembelian = new Pembelian;
        $pembelian->no_transaksi = $request->no_transaksi;
        $pembelian->id_supplier = $request->id_supplier;
        $pembelian->nama_pemasok = $supplier->nama_supplier;
        $pembelian->total_item = $total_item;
        $pembelian->total_harga = $subtotal;
        $pembelian->created_at = $request->tgl;

        $pembelian->save();

        return redirect('pembelian')->with('success',"Berhasil Ditambahkan");

    }

    public function show($id)
    {
        $pembelian = Pembelian::where('no_transaksi',$id)->first();
        $detail = PembelianDetail::join('barang','barang_masuk_detail.id_barang','=','barang.id_barang')->where('barang_masuk_detail.no_transaksi',$id)->get();

        return view('page.pembelian.data_detail',['pembelian'=>$pembelian,'detail'=>$detail]);
    }

    public function cetak_laporan(Request $request)
    {
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;

        $pembelian = PembelianDetail::select('barang_masuk_detail.jumlah','barang_masuk_detail.harga_beli','barang_masuk.no_transaksi','barang_masuk_detail.harga_jual','barang_masuk.created_at','barang_masuk.nama_pemasok','barang.nama_barang','barang_masuk.total_harga')->join('barang_masuk','barang_masuk_detail.no_transaksi','=','barang_masuk.no_transaksi')->join('barang','barang_masuk_detail.id_barang','=','barang.id_barang')->whereDate('barang_masuk_detail.created_at', '>=', $tgl_awal)
                        ->whereDate('barang_masuk.created_at', '<=', $tgl_akhir)
                        ->orderBy('barang_masuk.created_at', 'DESC')
                        ->get();

        $pdf = Pdf::loadView('page.pembelian.print', ['pembelian' => $pembelian, 'tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir])->setPaper('a4', 'landscape');

        return $pdf->download('laporan_barang_masuk.pdf');

        
    }

    public function destroy($id)
    {
        $pembelian = Pembelian::where('no_transaksi',$id)->first();

    
        $detail = PembelianDetail::where('no_transaksi',$id)->get();

        

    
        foreach ($detail as $item) {

            $produk = Produk::find($item->id_barang);
            $produk->stok = $produk->stok - $item->jumlah;
            $produk->save();

            $d = PembelianDetail::where('no_transaksi',$id)->first();
            
            $d->delete();
        }
    
        $pembelian->delete();

        return redirect('pembelian')->with('error',"Berhasil Dihapus");
    }
}
