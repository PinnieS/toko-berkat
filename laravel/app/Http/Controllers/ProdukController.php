<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\StokOpname;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $produk = Produk::all();
        return view('page.produk.data',compact('produk'));
    }


    

    public function store(Request $request)
    {
        
        $produk = Produk::create($request->all());

        $stok_opname = new StokOpname;

        $stok_opname = new StokOpname;
        $stok_opname->id_barang = $produk->id_barang; // ambil ID dari produk
        $stok_opname->jumlah_fisik = 0;
        $stok_opname->tanggal_update = now();
        $stok_opname->save();


        return redirect('produk')->with('success',"Data Berhasil Disimpan");

    }

    public function show($id)
    {
    
        $produk = DB::table('barang')->where('id_barang',$id)->first();

        return view('page.produk.update',['produk'=>$produk]);
    }

   

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'satuan' => 'required',
            'stok'=> 'required|numeric'
        ]);

        $produk = Produk::find($id);

        $produk->kode_barang = $request->kode_barang;
        $produk->nama_barang = strtoupper($request->nama_barang);
        $produk->satuan = $request->satuan;
   
        $produk->stok = $request->stok;

        $produk->save();

        return redirect('produk')->with('success',"Data barang Berhasil Dirubah");
    }

   

    public function hapus_produk(Request $request)
    {
        $produk = Produk::find($request->id_produk);

        $produk->delete();

        return redirect('produk')->with('error',"Data Berhasil Dihapus");


    }
}
