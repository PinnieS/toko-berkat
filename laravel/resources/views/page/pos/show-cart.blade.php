@php
    $no = 1;
@endphp
@foreach ($cart as $data)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $data->nama_barang }}</td>
        <td>{{ $data->jumlah }}</td>    
        <td>{{ number_format($data->harga_jual) }}</td>
       
        <td>{{ number_format($data->harga_jual * $data->jumlah ) }}</td>
        <td>
            <a onclick="kurangCart({{ $data->id_barang_keluar_detail }})" class="btn-sm btn-warning"><i class="fa fa-minus"></i></a>
            <a onclick="hapusCart({{ $data->id_barang_keluar_detail }})" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
@endforeach
