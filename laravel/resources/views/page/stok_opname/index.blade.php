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
            <h6 class="m-0 font-weight-bold text-primary">Stok Opname</h6>

            <br>
            <form action="{{ url('cetak-stok-opname') }}" method="GET">
                <div class="form-group">
                    <label for="">Tanggal Awal</label>
                    <input type="date" value="{{ date('Y-m-d') }}" name="tgl_awal" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Tanggal Akhir</label>
                    <input type="date" value="{{ date('Y-m-d') }}" name="tgl_akhir" class="form-control">
                </div>

                <button type="submit" class="btn btn-danger">Cetak Laporan Stok Opname</button>
            </form>

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Tanggal Update</th>
                            <th>Jumlah Tercatat</th>
                            <th>Jumlah Fisik</th>
                            <th>Selisih</th>
                            <th>Keterangan</th>

                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ url('bulk-update') }}" method="POST">
                            @csrf

                            @php
                                $no = 1;
                            @endphp
                            @foreach ($stok_opname as $index => $data)
                                <tr>
                                    <input type="hidden" name="items[{{ $index }}][id_barang]"
                                        value="{{ $data->id_barang }}">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->kode_barang }}</td>
                                    <td>{{ $data->nama_barang }}</td>
                                    <td>{{ $data->tanggal_update }}</td>
                                    <td>
                                        <input readonly type="number" class="form-control" name="items[{{ $index }}][stok]"
                                            value="{{ $data->stok }}">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control"
                                            name="items[{{ $index }}][jumlah_fisik]"
                                            value="{{ $data->jumlah_fisik }}">
                                    </td>
                                    <td>{{ $data->stok - $data->jumlah_fisik }}</td>
                                    <td>
                                        @php
                                            $selisih = $data->stok - $data->jumlah_fisik;
                                            $wajibKeterangan =
                                                $selisih < 0 ||
                                                $data->jumlah_fisik < 0 ||
                                                $data->stok != $data->jumlah_fisik;
                                        @endphp

                                        <input type="text" name="items[{{ $index }}][keterangan]"
                                            class="form-control" value="{{ $wajibKeterangan ? '' : '' }}"
                                            @if ($wajibKeterangan) required @endif>

                                        @if ($wajibKeterangan)
                                            <small class="text-danger">
                                                @if ($selisih < 0)
                                                    Selisih stok: {{ $selisih }}.
                                                @endif
                                                @if ($data->jumlah_fisik < 0)
                                                    Jumlah fisik tidak boleh negatif.
                                                @endif
                                                @if ($data->stok != $data->jumlah_fisik)
                                                    Jumlah tidak sesuai stok.
                                                @endif
                                                (Wajib isi keterangan)
                                            </small>
                                        @endif



                                    </td>
                                </tr>
                            
                            @endforeach
                            <tr>
                                <td colspan="9" class="text-end">
                                    <button type="submit" class="btn btn-success">Simpan Semua</button>
                                </td>
                            </tr>
                        </form>

                    </tbody>
                </table>
            </div>
        </div>


        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">History Stok Opname</h6>
            <br>
            <form action="{{ url('cetak-history-stok-opname') }}" method="GET">
                <div class="form-group">
                    <label for="">Tanggal Awal</label>
                    <input type="date" value="{{ date('Y-m-d') }}" name="tgl_awal" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Tanggal Akhir</label>
                    <input type="date" value="{{ date('Y-m-d') }}" name="tgl_akhir" class="form-control">
                </div>

                <button type="submit" class="btn btn-danger">Cetak History Stok Opname</button>
            </form>

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Tanggal Update</th>
                            <th>Jumlah Sistem</th>
                            <th>Jumlah Fisik</th>
                            <th>Keterangan</th>
                            <th>User</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($history_stok_opname as $data)
                            <tr>

                                <td>{{ $no++ }}</td>
                                <td>{{ $data->nama_barang }}</td>
                                <td>{{ $data->tanggal_update }}</td>
                                <td>{{ $data->stok_sistem }}</td>
                                <td>{{ $data->jumlah_fisik }}</td>
                                <td>{{ $data->keterangan }}</td>
                                <td>{{ $data->user_name }}</td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
