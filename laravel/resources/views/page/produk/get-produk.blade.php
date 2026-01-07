@php
    $no = 1;
@endphp
@foreach ($produk as $data)
    <tr>
        <td>{{ $no++ }}</td>
        <td><img width="100px" src="{{ asset('foto_produk') }}/{{ $data->foto }}" alt=""></td>
        <td>{{ $data->nama_kategori }}</td>
        <td>{{ $data->nama_produk }}</td>
        <td>{{ $data->satuan }}</td>
        <td>Rp. {{ number_format($data->harga, 2) }}</td>
        <td>{{ number_format($data->stok) }}</td>

        <td>
            <a type="button" onclick="loadDeleteModal({{ $data->id_produk }})" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>

            <a href="{{ url('produk',$data->id_produk) }}" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
        </td>
    </tr>
@endforeach
