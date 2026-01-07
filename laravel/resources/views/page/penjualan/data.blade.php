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
        <h6 class="m-0 font-weight-bold text-primary">Barang Keluar</h6>

       
    </div>
    <div class="card-header py-3">
        <a href="{{ url('pos') }}" class="btn-sm btn-success">Tambah Data</a>
        <a href="" data-toggle="modal" data-target="#cetakLaporan" class="btn-sm btn-danger"><i class="fa fa-print"></i> Laporan Penjualan</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" style="font-size: 14px !important" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Waktu Transaksi</th>
                        <th>No Transaksi</th>
                        <th>Nama Pelanggan</th>
                        <th>Telepon</th>
                        <th>Nama barang</th>
                        <th>Jumlah</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Total Harga</th>
                        <th>Keuntungan</th>
                        <th>Nama Kasir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                        $total=0;
                        $untung=0;
                        @endphp
                        @foreach ($penjualan as $data)
                        @php $total= $total + ($data->harga_jual * $data->jumlah) @endphp
                        @php $untung = $untung + ($data->harga_jual * $data->jumlah) - $data->harga_beli * $data->jumlah @endphp
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->created_at }}</td>
                            <td>{{ $data->no_transaksi }}</td>
                            <td>{{ $data->nama_pelanggan }}</td>
                            <td>{{ $data->telepon }}</td>
                            <td>{{ $data->nama_barang }}</td>
                            <td>{{ $data->jumlah }}</td>
                            <td>Rp. {{ number_format($data->harga_modal) }}</td>
                            <td>Rp. {{ number_format($data->harga_jual) }}</td>
                            <td>Rp. {{ number_format($data->harga_jual * $data->jumlah) }}</td>
                            <td>Rp. {{ number_format(($data->harga_jual * $data->jumlah) - $data->harga_modalz * $data->jumlah) }}</td>
                            <td>{{  $data->name }}</td>
                        
                     
                      
                        <td>
                           <!--  <a href="" data-toggle="modal" data-target="#fakturModal{{ $data->no_transaksi }}" class="btn-sm btn-success"><i class="fa fa-print"></i></a>
                            <br><br>
                            <a href="{{ url('penjualan',$data->no_transaksi) }}" class="btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                            <br><br> -->

                            <a href="" data-toggle="modal" data-target="#hapusModal{{ $data->id_penjualan_detail }}"
                                class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    {{-- hapus --}}
                    <div class="modal fade" id="hapusModal{{ $data->id_penjualan_detail }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ url('hapus-penjualan', $data->id_barang_keluar_detail) }}" method="POST">
                                    @method('POST')
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
                    {{-- faktur modal --}}
                    <div class="modal fade" id="fakturModal{{ $data->no_transaksi }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Transaksi Berhasil</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ url('cetak-faktur') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <input type="text" name="no_transaksi" value="{{ $data->no_transaksi }}" hidden id="id_faktur">
                                    <p align="center">Transaksi Berhasil Silahkan Cetak Faktur</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger"> <i class="fa fa-print"></i> Cetak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('page.penjualan.form-laporan')
@endsection