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
        <h6 class="m-0 font-weight-bold text-primary">Data Barang Masuk</h6>
        <p>Data Barang Masuk merupakan barang masuk</p>

       
    </div>
    <div class="card-header py-3">
        <a href="{{ url('pembelian/create') }}" class="btn-sm btn-success">Tambah Data</a>
        <a href="" data-toggle="modal" data-target="#cetakLaporan" class="btn-sm btn-danger"><i class="fa fa-print"></i> Laporan Barang Masuk</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" style="font-size: 14px !important" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Waktu Transaksi</th>
                        <th>No Transaksi</th>
                        <th>Nama Pemasok</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Sisa</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                       
                        <th>Total Harga Beli</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($pembelian as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td>{{ $data->no_transaksi }}</td>
                        <td>{{ $data->nama_pemasok }}</td>
                        <td>{{ $data->nama_barang }}</td>
                        <td>{{ $data->jumlah }}</td>
                        <td>{{ $data->sisa }}</td>
                        <td>Rp. {{ number_format($data->harga_beli) }}</td>
                        <td>Rp. {{ number_format($data->harga_jual) }}</td>
                       
                        <td>Rp. {{ number_format($data->jumlah * $data->harga_beli) }}</td>
                        <td>
                            <a href="{{ url('pembelian',$data->no_transaksi) }}" class="btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                            <br><br>
                            <a href="" data-toggle="modal" data-target="#hapusModal{{ $data->no_transaksi }}"
                                class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>

                            
                        </td>

                        <div class="modal fade" id="hapusModal{{ $data->no_transaksi }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ url('pembelian', $data->no_transaksi) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <div class="modal-body">
                                            <p class="text-center">Yakin untuk menghapus?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('page.pembelian.form-laporan')
@endsection