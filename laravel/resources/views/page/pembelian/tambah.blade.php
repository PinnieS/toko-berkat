@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Transaksi Barang Masuk</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <form action="{{ url('tambah-item-pembelian') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                        <label for="">Pilih Barang</label>
                        <select id="select2" name="id_produk" class="form-control">
                            @foreach ($produk as $item)
                                <option value="{{ $item->id_barang }}">{{ $item->nama_barang }} ({{$item->satuan}})</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" value="1">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Beli</label>
                        <input type="text" value="@php 
                        if(isset($_POST['harga_beli']))
                        { 
                            echo $_POST['harga_beli'];
                        } 
                        @endphp" class="form-control" name="harga_beli" placeholder="Masukan Harga">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Jual</label>
                        <input type="text" value="@php 
                        if(isset($_POST['harga_jual']))
                        { 
                            echo $_POST['harga_jual'];
                        } 
                        @endphp" class="form-control" name="harga_jual" placeholder="Masukan Harga">
                    </div>

                    

                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>

            <div class="col-lg-8">
                <p>Detail Transaksi</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Product</td>
                                <td>Jml</td>
                                <td>Beli</td>
                                <td>Jual</td>
                                <td>SubTotal</td>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($detail as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->nama_barang }}</td>
                                    <td>{{ $data->jumlah }}</td>
                                    <td>{{ number_format($data->harga_beli) }}</td>
                                    <td>{{ number_format($data->harga_jual) }}</td>
                                    <td>{{ number_format($data->subtotal) }}</td>
                                    
                                    {{-- <td>
                                        <a onclick="kurangCart({{ $data->id_penjualan_detail }})"
                                            class="btn-sm btn-warning"><i class="fa fa-minus"></i></a>
                                        <a onclick="hapusCart({{ $data->id_penjualan_detail }})"
                                            class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td> --}}
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                

                <form method="POST" action="{{ url('pembelian') }}">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                        <label for="">No Transaksi</label>
                        <input type="text" value="{{ $invoice }}" name="no_transaksi" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="datetime-local" value="{{ date('Y-m-d H:i:s') }}" name="tgl" class="form-control">
                    </div>
                    {{-- <div class="form-group">
                        <label for="">Nama Pemasok</label>
                        <input required type="text" value="" name="pemasok" class="form-control">
                    </div> --}}
                    <div class="form-group">
                        <label for="">Pilih Supplier</label>
                        <select  name="id_supplier" class="form-control">
                            @foreach ($supplier as $item)
                                <option value="{{ $item->id_supplier }}">{{ $item->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-danger">Simpan Pembelian</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection