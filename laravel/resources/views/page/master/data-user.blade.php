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
            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        </div>
        <div class="card-header py-3">
            <a href="" class="btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @php
                        $no = 1;
                    @endphp
                    <tbody>
                        @foreach ($user as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>
                                    @if ($data->level == 1)
                                        <span class="badge bg-danger text-white">Admin</span>
                                    @elseif($data->level == 2)
                                        <span class="badge bg-primary text-white">Pimpinan</span>
                                    @elseif($data->level==3)
                                        <span class="badge bg-success text-white">Kasir</span>
                                    @else
                                    <span class="badge bg-warning text-white">Karyawan</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->level == 1)
                                        <a href="" data-toggle="modal" data-target="#updateModal{{ $data->id }}" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    @else
                                        <a href="" data-toggle="modal" data-target="#hapusModal{{ $data->id }}"
                                            class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        <a href="" data-toggle="modal" data-target="#updateModal{{ $data->id }}" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    @endif
                                </td>
                            </tr>
                            {{-- Hapus --}}
                            <div class="modal fade" id="hapusModal{{ $data->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ url('data-user', $data->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <div class="modal-body">
                                                <p class="text-center">Yakin untuk menghapus user {{ $data->name }}?</p>
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
                            {{-- end --}}

                            {{-- update --}}
                            <div class="modal fade" id="updateModal{{ $data->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Updatew User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form autocomplete="off" action="{{ url('data-user',$data->id) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Nama</label>
                                                    <input type="text" value="{{ $data->name }}" class="form-control" placeholder="Masukan Nama.."
                                                        name="name" id="name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input readonly value="{{ $data->email }}" type="text" class="form-control" placeholder="Masukan Email.."
                                                        name="email" id="nama_user">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">New Password</label>
                                                    <input type="text"  class="form-control"
                                                        placeholder="Masukan Password.." name="password" id="password">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- end --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tambah -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('data-user') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" placeholder="Masukan Nama.." name="name"
                                id="name">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" placeholder="Masukan Email.." name="email"
                                id="nama_user">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" placeholder="Masukan Password.." name="password"
                                id="password">
                        </div>
                        <div class="form-group">
                            <label for="">Level</label>
                            <select name="level" id="level" class="form-control">
                                <option value="1">Admin</option>
                                
                                <option value="3">Kasir</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
