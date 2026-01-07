@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12">
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
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Data Supplier</h3>
    </div>
    <div class="card-body">
        <div class="row">
            
            <div class="col-lg-12">
                <form action="{{ url('supplier', $supplier->id_supplier) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Supplier</label>
                            <input type="text" class="form-control" value="{{ $supplier->nama_supplier }}" name="nama_supplier" placeholder="Masukan Nama Supplier...">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat Supplier</label>
                            <input type="text" class="form-control" value="{{ $supplier->alamat }}" name="alamat" placeholder="Masukan Alamat...">
                        </div>
                        <div class="form-group">
                            <label for="">Telepon Supplier</label>
                            <input type="text" class="form-control" value="{{ $supplier->telepon }}" name="telepon" placeholder="Masukan Telepon...">
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
</div>
@endsection