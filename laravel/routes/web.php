<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;



use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfilController;

use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;

use App\Http\Controllers\StokOpnameController;
use App\Http\Controllers\SupplierController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// route profil
Route::resource('profil', ProfilController::class);
// route user
Route::resource('data-user',UserController::class);


// produk
Route::resource('produk',ProdukController::class);
Route::get('get-produk', [App\Http\Controllers\ProdukController::class, 'get_produk']);
Route::post('cari-produk', [App\Http\Controllers\ProdukController::class, 'cari_produk']);
Route::post('cetak-laporan-produk', [App\Http\Controllers\ProdukController::class, 'cetak_laporan']);
Route::post('hapus-produk', [App\Http\Controllers\ProdukController::class, 'hapus_produk']);
Route::post('ganti-foto-produk/{id}', [App\Http\Controllers\ProdukController::class, 'ganti_foto_produk']);

// pembelian
Route::resource('pembelian',PembelianController::class);
Route::post('cetak-laporan-pembelian', [App\Http\Controllers\PembelianController::class, 'cetak_laporan']);
Route::post('tambah-item-pembelian', [App\Http\Controllers\PembelianController::class, 'tambah_item_pembelian']);

// penjualan
Route::resource('penjualan',PenjualanController::class);
Route::post('cetak-laporan-penjualan', [App\Http\Controllers\PenjualanController::class, 'cetak_laporan']);
Route::post('hapus-penjualan/{id}', [App\Http\Controllers\PenjualanController::class, 'destroy']);
Route::post('hapus-barang-keluar-pos', [App\Http\Controllers\PenjualanController::class, 'deleteInvalidDetails']);

// POS
Route::resource('pos',PosController::class);
Route::post('show-cart', [App\Http\Controllers\PosController::class, 'show_cart']);
Route::post('show-form-cart', [App\Http\Controllers\PosController::class, 'show_form_cart']);
Route::post('add-cart', [App\Http\Controllers\PosController::class, 'add_cart']);
Route::post('kurang-cart', [App\Http\Controllers\PosController::class, 'kurang_cart']);
Route::post('hapus-cart', [App\Http\Controllers\PosController::class, 'hapus_cart']);
Route::post('simpan-penjualan', [App\Http\Controllers\PosController::class, 'simpan_penjualan']);
Route::post('cetak-faktur', [App\Http\Controllers\PosController::class, 'cetak_faktur']);
Route::get('show-produk-pos', [App\Http\Controllers\PosController::class, 'show_produk_pos']);
Route::post('cari-produk-pos', [App\Http\Controllers\PosController::class, 'cari_produk_pos']);


// stok opname
Route::resource('stok-opname', StokOpnameController::class);
Route::resource('supplier', SupplierController::class);

Route::post('/bulk-update', [StokOpnameController::class, 'bulkUpdate']);


Route::get('delete-supplier/{id}', [App\Http\Controllers\SupplierController::class, 'destroy']);

Route::get('cetak-stok-opname', [App\Http\Controllers\StokOpnameController::class, 'cetak_stok_opname']);


Route::get('cetak-history-stok-opname', [App\Http\Controllers\StokOpnameController::class, 'cetak_history_stok_opname']);