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
        <h3 class="card-title">Edit Data Barang</h3>
    </div>
    <div class="card-body">
        <div class="row">
            
            <div class="col-lg-12">
                <form action="{{ url('produk',$produk->id_barang) }}" method="POST">
                    @csrf
                    @method('PUT')
                   
                    <div class="form-group">
                        <label for="">Kode Barang</label>
                        <input type="text" value="{{ $produk->kode_barang }}" class="form-control" name="kode_barang" placeholder="Masukan Kode Barang...">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" value="{{ $produk->nama_barang }}" class="form-control" name="nama_barang" placeholder="Masukan Nama Barang...">
                    </div>

                    <div class="form-group">
                        <label for="">Satuan</label>
                        <select class="form-control" name="satuan">
                            <option value="Batang" {{ $produk->satuan == 'Batang' ? 'selected' : '' }}>Batang</option>
                            <option value="Lembar" {{ $produk->satuan == 'Lembar' ? 'selected' : '' }}>Lembar</option>
                            <option value="Sak" {{ $produk->satuan == 'Sak' ? 'selected' : '' }}>Sak</option>
                            <option value="Kg" {{ $produk->satuan == 'Kg' ? 'selected' : '' }}>Kg</option>
                            <option value="Meter" {{ $produk->satuan == 'Meter' ? 'selected' : '' }}>Meter</option>
                            <option value="Roll" {{ $produk->satuan == 'Roll' ? 'selected' : '' }}>Roll</option>
                            <option value="Liter" {{ $produk->satuan == 'Liter' ? 'selected' : '' }}>Liter</option>
                            <option value="Kaleng" {{ $produk->satuan == 'Kaleng' ? 'selected' : '' }}>Kaleng</option>
                            <option value="Pcs" {{ $produk->satuan == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                            <option value="Dus" {{ $produk->satuan == 'Dus' ? 'selected' : '' }}>Dus</option>
                            <option value="Pack" {{ $produk->satuan == 'Pack' ? 'selected' : '' }}>Pack</option>
                            <option value="Botol" {{ $produk->satuan == 'Botol' ? 'selected' : '' }}>Botol</option>
                            <option value="Karung" {{ $produk->satuan == 'Karung' ? 'selected' : '' }}>Karung</option>
                            <option value="Set" {{ $produk->satuan == 'Set' ? 'selected' : '' }}>Set</option>
                            <option value="Galon" {{ $produk->satuan == 'Galon' ? 'selected' : '' }}>Galon</option>
                            <option value="Unit" {{ $produk->satuan == 'Unit' ? 'selected' : '' }}>Unit</option>
                            <option value="Kubik" {{ $produk->satuan == 'Kubik' ? 'selected' : '' }}>Kubik</option>
                            <option value="Plastik" {{ $produk->satuan == 'Plastik' ? 'selected' : '' }}>Plastik</option>
                        </select>
                    </div>
                    
                
                    
                    
                
                
                    {{-- <div class="form-group">
                        <label for="">Stok</label> --}}
                        <input hidden type="number" value="{{ $produk->stok }}" class="form-control" name="stok" value="0" placeholder="Masukan Diskon barang...">
                    {{-- </div> --}}

                    <div class="modal-footer">
                       <a href="{{ url('produk') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection