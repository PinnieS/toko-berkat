<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #bbbbbb;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color:red;
            color: white;
        }
    </style>
</head>

<body>

    <table style="width:100%">


        <tr>
            <td style="line-height: 10px"><h2>Toko</h2><h1> TB. BERKAT REZEKI</h1> <h3>Barang Masuk</h3></td>
        </tr>
    </table>
    <hr style="border: 2px solid #222">
    <br>
    <span style="text-align:center;">
        Tanggal Laporan Barang Masuk: <br>
        Periode Awal: {{ $tgl_awal }} <br>
    Periode Akhir: {{ $tgl_akhir }}</span>
    <br><br><br>
    <table id="customers">
        <tr>
           <th>No</th>
           <th>Tanggal</th>
           <th>No Transaksi</th>
           <th>Nama Pemasok</th>
           <th>Nama Barang</th>
           <th>Jumlah</th>
           <th>Harga Beli</th>
           <th>Harga Jual</th>
           <th>Kadaluarsa</th>
           <th>Total Harga Beli</th>
       </tr>
       @php
       $no=1;
       $total=0;
       @endphp
       @foreach ($pembelian as $data)
       {{ $total= $total + $data->total_harga }}
       <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $data->created_at }}</td>
        <td>{{ $data->no_transaksi }}</td>
        <td>{{ $data->nama_pemasok }}</td>
        <td>{{ $data->nama_barang }}</td>
        <td>{{ $data->jumlah }}</td>
        <td>Rp. {{ number_format($data->harga_beli) }}</td>
        <td>Rp. {{ number_format($data->harga_jual) }}</td>
        <td>{{ $data->kadaluarsa }}</td>
        <td>Rp. {{ number_format($data->jumlah * $data->harga_beli) }}</td>
    </tr>
    @endforeach
    <tr>
        <td colspan="9">Total Harga Barang Masuk</td>
        <td>Rp. {{ number_format($total, 2) }}</td>
    </tr>

</table>
<br><br><br>


</body>

</html>
