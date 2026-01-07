<?php

namespace App\Http\Controllers;

use App\Models\PembelianDetail;
use PDF;
use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PenjualanDetail;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $penjualan = PenjualanDetail::query()
            ->select('barang_keluar.*', 'users.name','barang_keluar_detail.jumlah','barang_keluar_detail.harga_jual','barang.nama_barang','barang_keluar_detail.harga_jual','barang_keluar_detail.id_barang_keluar_detail','barang_keluar_detail.harga_modal')
             ->join('barang_keluar','barang_keluar_detail.no_transaksi','=','barang_keluar.no_transaksi')
            ->leftjoin('users', 'barang_keluar.id_user', '=', 'users.id')
            ->join('barang','barang_keluar_detail.id_barang','=','barang.id_barang')
            
            // ->whereDate('barang_keluar.created_at', '>=', $tgl_awal)
            // ->whereDate('barang_keluar.created_at', '<=', $tgl_akhir)
            ->orderBy('barang_keluar.created_at', 'DESC')
            ->get();
        return view('page.penjualan.data', ['penjualan' => $penjualan]);
    }

    public function show($id)
    {
        $penjualan = Penjualan::query()
            ->select('barang_keluar.*', 'users.name')
            ->leftjoin('users', 'barang_keluar.id_user', '=', 'users.id')
            ->where('barang_keluar.no_transaksi',$id)->first();

        $cart = PenjualanDetail::query()
                ->select('barang_keluar_detail.*','barang.nama_barang','barang.harga')
                ->join('barang','barang_keluar_detail.id_barang','=','barang.id_barang')
                ->where('barang_keluar_detail.no_transaksi',$id)->get();

        return view('page.penjualan.data_detail',['penjualan'=>$penjualan,'cart'=>$cart]);
    }

    public function cetak_laporan(Request $request)
    {
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir =$request->tgl_akhir;
        $penjualan = PenjualanDetail::query()
            ->select('barang_keluar.*', 'users.name','barang_keluar_detail.jumlah','barang_keluar_detail.harga_jual','barang.nama_barang','barang_keluar_detail.id_barang_keluar_detail','barang_keluar_detail.harga_modal')

             ->join('barang_keluar','barang_keluar_detail.no_transaksi','=','barang_keluar.no_transaksi')
            ->leftjoin('users', 'barang_keluar.id_user', '=', 'users.id')
            ->join('barang','barang_keluar_detail.id_barang','=','barang.id_barang')
            
            ->whereDate('barang_keluar.created_at', '>=', $tgl_awal)
            ->whereDate('barang_keluar.created_at', '<=', $tgl_akhir)
            ->orderBy('barang_keluar.created_at', 'DESC')
            ->get();

        $pdf = Pdf::loadView('page.penjualan.print', ['penjualan' => $penjualan, 'tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir])->setPaper('a4', 'landscape');

        return $pdf->download('laporan_barang_keluar.pdf');
    }

    public function destroy($id)
    {
    

    
        $detail = PenjualanDetail::where('id_barang_keluar_detail',$id)->first();

        

    
       

            $produk = Produk::find($detail->id_barang);
            $produk->stok = $produk->stok + $detail->jumlah;
            $produk->save();

        
        $detail->delete();

        return redirect('penjualan')->with('error',"Berhasil Dihapus");
    }

    public function deleteInvalidDetails()
    {
        // Ambil detail yang orphan
        $invalidDetails = DB::table('barang_keluar_detail')
            ->whereNotIn('no_transaksi', function ($q) {
                $q->select('no_transaksi')->from('barang_keluar');
            })
            ->get();

        // Tambah stok ke barang_masuk_detail
        foreach ($invalidDetails as $detail) {
           $barang_masuk_detail = PembelianDetail::where('id_barang_masuk_detail',$detail->id_barang_masuk)->first();
            $barang_masuk_detail->sisa = $barang_masuk_detail->sisa + $detail->jumlah;
            $barang_masuk_detail->save();
        }

        // Hapus detail yang orphan
        DB::table('barang_keluar_detail')
            ->whereNotIn('no_transaksi', function ($q) {
                $q->select('no_transaksi')->from('barang_keluar');
            })
            ->delete();

        return response()->json(['status' => 'deleted']);
    }

}
