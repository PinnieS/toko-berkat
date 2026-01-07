<?php

namespace App\Http\Controllers;

use App\Models\HistoryStokOpname;
use App\Models\Produk;
use App\Models\StokOpname;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StokOpnameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stok_opname = Produk::join('stok_opname','barang.id_barang','=','stok_opname.id_barang')->get();
        $history_stok_opname = HistoryStokOpname::orderBy('tanggal_update', 'DESC')->get();
        return view('page.stok_opname.index', compact('stok_opname','history_stok_opname'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $barang = Produk::find($id);

    //     $stok_opname = StokOpname::where('id_barang','=',$id)->first();

    //     $barang->stok = $request->stok;

    //     $stok_opname->jumlah_fisik = $request->jumlah_fisik;

    //     $barang->save();

    //     $stok_opname->save();

    //     return redirect()->back()->with('success',"Data Berhasil Disimpan");
    // }

    public function bulkUpdate(Request $request)
    {
        foreach ($request->items as $item) {
            $barang = Produk::find($item['id_barang']);
            $stok_opname = StokOpname::where('id_barang', $item['id_barang'])->first();

            if ($barang && $stok_opname) {
                $barang->stok = $item['stok'];
                $stok_opname->jumlah_fisik = $item['jumlah_fisik'];
                $stok_opname->keterangan = $item['keterangan'];
                $stok_opname->tanggal_update = date('Y-m-d');
                $barang->save();
                $stok_opname->save();
            }

            HistoryStokOpname::create([
                'id_barang'     => $item['id_barang'],
                'nama_barang'   => $barang->nama_barang,
                'stok_sistem'   => $barang->stok,
                'jumlah_fisik'  => $item['jumlah_fisik'],
                'keterangan'    => $item['keterangan'],
                'user_name'       => Auth::user()->name, // opsional jika login
                'tanggal_update'=> date('Y-m-d H:i:s'),
            ]);

        }

        return redirect()->back()->with('success', 'Semua data berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cetak_stok_opname(Request $request)
    {
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        $stok_opname = Produk::join('stok_opname','barang.id_barang','=','stok_opname.id_barang')
        ->whereDate('stok_opname.tanggal_update','>=', $tgl_awal)
        ->whereDate('stok_opname.tanggal_update','<=', $tgl_akhir)
        ->get();

        $history_stok_opname = HistoryStokOpname::orderBy('tanggal_update', 'DESC')->get();
        return view('page.stok_opname.cetak_stok', compact('stok_opname','history_stok_opname', 'tgl_awal','tgl_akhir'));
    }

    public function cetak_history_stok_opname(Request $request)
    {
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        $stok_opname = Produk::join('stok_opname','barang.id_barang','=','stok_opname.id_barang')->get();
        $history_stok_opname = HistoryStokOpname::whereDate('tanggal_update','>=', $tgl_awal)
        ->whereDate('tanggal_update','<=', $tgl_akhir)
        ->orderBy('tanggal_update', 'DESC')
        ->get();
        return view('page.stok_opname.cetak_history', compact('stok_opname','history_stok_opname', 'tgl_awal','tgl_akhir'));
    }
}
