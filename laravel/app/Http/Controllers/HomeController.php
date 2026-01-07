<?php

namespace App\Http\Controllers;


use App\Models\Pengeluaran;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = User::all();
      
        $penjualan = PenjualanDetail::all();

        // Get filters from request
        $month = $request->input('month');
        $year = $request->input('year');

        // Build query
        $query = Penjualan::query();

        if ($month) {
            $query->whereMonth('created_at', $month);
        }

        if ($year) {
            $query->whereYear('created_at', $year);
        }

        // Get sales data and aggregate by day
        $sales = $query->selectRaw('DATE(created_at) as date, SUM(total_harga) as total_sales')
                        ->groupBy('date')
                        ->orderBy('date')
                        ->get();

        $totalSelisih = DB::table('stok_opname as so')
            ->join('barang as b', 'b.id_barang', '=', 'so.id_barang')
            ->select(DB::raw('SUM(b.stok - so.jumlah_fisik) as total_selisih'))
            ->value('total_selisih');


        // Prepare data for chart
        $dates = $sales->pluck('date');
        $totals = $sales->pluck('total_sales');

        $totalKeuntungan = DB::table('barang_keluar_detail')
    ->select(DB::raw('SUM((harga_jual - harga_modal) * jumlah) as total_keuntungan'))
    ->value('total_keuntungan');


        $terakhir_stok_opname = DB::table('history_stok_opname')->orderBy('tanggal_update', 'desc')->first();


         $stokRendah = Produk::where('stok', '<', 10)->get();
       
        return view('home',compact('user','penjualan','dates','totals','month','year','totalSelisih', 'totalKeuntungan','terakhir_stok_opname', 'stokRendah'));
    }
}
