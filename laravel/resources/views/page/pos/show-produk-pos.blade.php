@foreach ($produk as $data)
<div class="col-lg-3 col-md-3">
    <div class="card p-2">
        
        <p style="font-size: 12px" class="mt-2">{{ $data->nama_barang }}</p>
        <p style="font-size: 12px;color:red;margin-top:-15px">{{ number_format($data->harga_jual) }}</p>
        <p style="font-size: 12px;color:#222;margin-top:-15px">Sisa {{ $data->stok }}</p>
        <div class="row">
            <div class="col-lg-7">
                <input style="text-align: center" id="jumlah_add" type="number"  class="form-control jumlah_add" value="1">
                
            </div>
            <div class="col-lg-5">
                <a type="button" onclick="addCart({{ $data->id_barang }})" class="btn btn-danger text-center"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>
@endforeach