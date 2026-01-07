@extends('layouts.app')


@section('content')
    <div class="row mb-5">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12">
                    <h6>Daftar Produk</h6>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" placeholder="Cari barang" id="cari_produk" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <button onclick="cariProduk()" class="btn btn-danger">Cari barang</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="show_produk_pos" class="row">
              
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Transaksi</h6>
                </div>
                <div class="card-body">
                    <p>Detail Transaksi</p>
                    <table class="table table-bordered" style="font-size: 10px">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Product</td>
                                <td>Qty</td>
                                <td>Rp</td>
                             
                                <td>SubTotal</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody id="showCart"></tbody>
                    </table>
                    <div class="form-group">
                        <label for="">No. Transaksi</label>
                        <input type="text" id="no_transaksi" value="{{ $invoice }}" readonly class="form-control w-100" style="height: 30px ">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="datetime-local" value="{{ date('Y-m-d H:i:s') }}" id="tgl2" name="tgl2" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan">
                    </div>
                    <div class="form-group">
                        <label for="">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon">
                    </div>
                    <hr>
                    <table width="100%">
                        <tr>
                            <td>Total Item</td>
                            <td><input style="text-align: right" readonly id="total_item" class="form-control" type="text"></td>
                        </tr>
                        <tr>
                            <td>Total Harga (Rp)</td>
                            <td><input style="text-align: right" readonly id="total_harga" class="form-control" type="text"></td>
                        </tr>

                            <input hidden style="text-align: right" readonly class="form-control" id="grand_total" type="text">
                       
                        <tr>
                            <td>Bayar (Rp)</td>
                            <td><input style="text-align: right" type="text" id="bayar" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Kembali (Rp)</td>
                            <td><input style="text-align: right" id="kembali" type="text" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Metode Pembayaran</td>
                            <td>
                                <select name="metode_pembayaran" class="form-control" id="metode_pembayaran">
                                    <option value="Kas" selected>Kas</option>
                                    <option value="Transfer">Transfer</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ url('penjualan') }}" class="btn btn-danger">Batal</a>
                    <a href="{{ url('pos') }}" class="btn btn-warning">Refresh</a>
                    <button onclick="simpanTransaksi()" id="simpan_transaksi" type="button" class="btn btn-primary disabled">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@include('page.pos.form-cetak-faktur')







@endsection
