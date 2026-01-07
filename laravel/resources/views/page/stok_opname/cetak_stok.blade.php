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
            <td style="line-height: 10px"><h2>Toko</h2><h1> TB. BERKAT REZEKI</h1> <h3>Laporan Stok Opname</h3></td>
        </tr>
    </table>
    <hr style="border: 2px solid #222">
    <h4>Tanggal Laporan: {{ $tgl_awal}} s.d {{ $tgl_akhir }}</h4>
    <br>
   
    <br>
    <table id="customers">
        <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Tanggal Update</th>
                        <th>Jumlah Tercatat</th>
                        <th>Jumlah Fisik</th>
                        <th>Selisih</th>
                        <th>Keterangan</th>
                       
                    </tr>
                </thead>
                <tbody>
                   
                        @php
                        $no = 1;
                        @endphp
                        @foreach ($stok_opname as $index => $data)
                            <tr>
                               
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->kode_barang }}</td>
                                <td>{{ $data->nama_barang }}</td>
                                <td>{{ $data->tanggal_update }}</td>
                                <td>
                                    {{ $data->stok }}
                                </td>
                                <td>
                                    {{ $data->jumlah_fisik }}
                                </td>
                                <td>{{ $data->stok - $data->jumlah_fisik }}</td>
                                <td>
                                   {{ $data->keterangan }}
                                </td>
                            </tr>
                        @endforeach
                       
                </tbody>    

    </table>
    <br><br><br>

</body>

</html>
