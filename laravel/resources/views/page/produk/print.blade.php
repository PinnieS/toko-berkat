<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #bbbb;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: red;
  color: white;
}
</style>
</head>
<body>

<table style="width:100%" align="left">
   
        
    <tr>
        <td style="line-height: 10px"><h2>Toko Bangunan</h2></td>
    </tr>
</table>
<hr style="border: 2px solid #222">
<br>
<span style="background-color: #bbb;padding: 10px; width:100%;color:#fff;text-align:center;">Waktu Laporan: {{ date('d-m-Y H:i:s') }}</span>
<br><br><br>
<table id="customers">
    <tr>
        <th>No</th>
        <th>Kategori</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Stok</th>
    </tr>
    @php
    $no = 1;
@endphp
@foreach ($produk as $data)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $data->nama_kategori }}</td>
        <td>{{ $data->nama_produk }}</td>
        <td>Rp. {{ number_format($data->harga, 2) }}</td>
        <td>{{ number_format($data->stok) }}</td>
    </tr>
@endforeach
</table>
<br><br><br>


</body>
</html>