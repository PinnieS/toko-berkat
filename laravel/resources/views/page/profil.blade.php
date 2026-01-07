@extends('layouts.app')


@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
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
                    <h6 class="m-0 font-weight-bold text-primary">Profil User</h6>
                </div>
                <form action="{{ url('profil', Auth::user()->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama User</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" placeholder="Nama User"
                                name="nama_user">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" readonly class="form-control" value="{{ $user->email }}"
                                placeholder="Nama User" name="email">
                        </div>
                        <div class="form-group">
                            <label for="">Level</label>
                            <input type="text" readonly class="form-control"
                                value="@if ($user->level == 1) Admin @elseif($user->level == 2) Pimpinan @else Kasir @endif"
                                placeholder="Nama User" name="level">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="">Update Password (Password harus 8 Karakter contoh: 12345678)</label>
                            <input type="text" class="form-control" placeholder="Masukan Password baru" name="password_new">
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('home') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary">Update Profil</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
