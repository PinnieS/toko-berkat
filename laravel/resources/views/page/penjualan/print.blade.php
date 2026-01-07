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
            background-color: #bbbb;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

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
            <td style="line-height: 10px"><h2>Toko</h2><h1> TB. BERKAT REZEKI</h1> <h3>Laporan Barang Keluar</h3></td>
        </tr>
    </table>
    <hr style="border: 2px solid #222">
    <br>
    <span style="background-color: #bbb;padding: 10px; width:100%;color:#fff;text-align:center;">Tanggal Laporan barang Keluar:
        {{ $tgl_awal }} / {{ $tgl_akhir }}</span>
    <br><br><br>
    <table id="customers">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>No Transaksi</th>
            <th>Nama Pelanggan</th>
            <th>Telepon</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Total Harga</th>
            <th>Keuntungan</th>
            <th>Nama Kasir</th>
        </tr>
        @php
        $no=1;
        $total=0;
        $untung=0;
        @endphp
        @foreach ($penjualan as $data)
        {{ $total= $total + ($data->harga_jual * $data->jumlah) }}
        {{ $untung = $untung + ($data->harga_jual * $data->jumlah) - $data->harga_modal * $data->jumlah}}
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->created_at }}</td>
            <td>{{ $data->no_transaksi }}</td>
            <td>{{ $data->nama_pelanggan }}</td>
            <td>{{ $data->telepon }}</td>
            <td>{{ $data->nama_barang }}</td>
            <td>{{ $data->jumlah }}</td>
            <td>Rp. {{ number_format($data->harga_modal) }}</td>
            <td>Rp. {{ number_format($data->harga_jual) }}</td>
            <td>Rp. {{ number_format($data->harga_jual * $data->jumlah) }}</td>
            <td>Rp. {{ number_format(($data->harga_jual * $data->jumlah) - $data->harga_modal * $data->jumlah) }}</td>
            <td>{{  $data->name }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="11">Total Penjualan</td>
            <td>Rp. {{ number_format($total, 2) }}</td>
        </tr>
        <tr>
            <td colspan="11">Total Keuntungan</td>
            <td>Rp. {{ number_format($untung, 2) }}</td>
        </tr>

    </table>
    <br><br><br>
    {{-- <table style="width: 100%" align="center">
        <tr>
            <td style="text-align: center">Dilaporan Oleh: <br><br><br><br>( {{ Auth::user()->name }} )</td>
            <td style="text-align: center">Mengetahui Pimpinan: <br><br><br><br>(................................)</td>
        </tr>
    </table> --}}

</body>

</html>
