@extends('layouts.app')


@section('content')
    <div class="row mb-5">
        <div class="col-lg-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h6>Informasi Transaksi</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">No. Transaksi</label>
                        <input type="text" id="no_transaksi" value="{{ $pembelian->no_transaksi }}" readonly
                            class="form-control w-100">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="text" id="tgl" value="{{ $pembelian->created_at }}" readonly
                            class="form-control w-100">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Pemasok</label>
                        <input type="text" id="tgl"
                            value="{{ $pembelian->nama_pemasok }}" readonly
                            class="form-control w-100">
                    </div>
                  
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Transaksi</h6>
                </div>
                <div class="card-body">
                    <p>Detail Transaksi</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Product</td>
                                <td>Qty</td>
                                <td>Rp</td>
                                <td>SubTotal</td>
                                {{-- <td>Aksi</td> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                                $total=0;
                            @endphp
                            @foreach ($detail as $data)
                                @php
                                    $total = $data->subtotal + $total;
                                @endphp
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->nama_barang }}</td>
                                    <td>{{ $data->jumlah }}</td>
                                    <td>{{ number_format($data->harga_beli) }}</td>
                                    <td>{{ number_format($data->subtotal) }}</td>
                                    {{-- <td>
                                        <a onclick="kurangCart({{ $data->id_penjualan_detail }})"
                                            class="btn-sm btn-warning"><i class="fa fa-minus"></i></a>
                                        <a onclick="hapusCart({{ $data->id_penjualan_detail }})"
                                            class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td> --}}
                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="4">Total barang_masuk</td>
                                    <td>{{ number_format($total) }}</td>
                                </tr>

                        </tbody>
                    </table>

                </div>
                <div class="card-footer text-right">
                    <a href="{{ url('pembelian') }}" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
