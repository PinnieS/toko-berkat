<!DOCTYPE html>
<html lang="en" >
 
<head>
 
  <meta charset="UTF-8">
  <title>Faktur TB. BERKAT REZEKI</title>
 
  <style>
@media print {
    .page-break { display: block; page-break-before: always; }
}
#invoice-POS {
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  margin: 0 auto;
  width: 350px;
  background: #FFF;
}
#invoice-POS ::selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS ::moz-selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS h1 {
  font-size: 1.5em;
  color: #222;
}
#invoice-POS h2 {
  font-size: .9em;
}
#invoice-POS h3 {
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
#invoice-POS p {
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}
#invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
  /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}
#invoice-POS #top {
  min-height: 100px;
}
#invoice-POS #mid {
  min-height: 80px;
}
#invoice-POS #bot {
  min-height: 50px;
}
#invoice-POS #top .logo {

  text-align: center;
}
#invoice-POS .clientlogo {
  background-size: 60px 60px;
  border-radius: 50px;
}
#invoice-POS .info {
  display: block;
  margin-left: 0;
  margin-top: 10px; 
}
#invoice-POS .title {
  float: right;
}
#invoice-POS .title p {
  text-align: right;
}
#invoice-POS table {
  width: 100%;
  border-collapse: collapse;
}
#invoice-POS .tabletitle {
  font-size: .5em;
  background: #EEE;
}
#invoice-POS .service {
  border-bottom: 1px solid #EEE;
}
#invoice-POS .item {
  width: 24mm;
}
#invoice-POS .itemtext {
  font-size: .5em;
}
#invoice-POS #legalcopy {
  margin-top: 5mm;
}
 
    </style>
 
  <script>
  window.console = window.console || function(t) {};
</script>
 
 
 
  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>
 
 
</head>
 
<body translate="no" >
 
 
  <div id="invoice-POS">
 
    <center id="top">
      <div class="logo">
      </div>
      <div class="info"> 
        <h3>TB. BERKAT REZEKI <br> Faktur Transaksi</h3>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
 
    <div id="mid">
      <div class="info">
        <h2>Info Transaksi</h2>
        <p> 
          No. Transaksi : {{ $penjualan->no_transaksi }} <br>
          Tanggal  : {{ $penjualan->created_at }}<br>
          Pelanggan   :  {{ $penjualan->nama_pelanggan }} <br>
          Telepon   :  {{ $penjualan->telepon }}
      </div>
    </div><!--End Invoice Mid-->
 
    <div id="bot">
 
                    <div id="table">
                        <table>
                            <tr class="tabletitle">
                                <td class="item"><h2>barang</h2></td>
                                <td class="Hours"><h2>Harga</h2></td>
                                <td class="Hours"><h2>Qty</h2></td>
                                <td class="Rate"><h2>Sub Total</h2></td>
                            </tr>
                          @foreach ($detail as $item)
                              
                          <tr class="service">
                            <td class="tableitem"><p class="itemtext">{{ $item->nama_barang }}</p></td>
                            <td class="tableitem"><p class="itemtext">{{ number_format($item->harga) }}</p></td>
                            <td class="tableitem"><p class="itemtext">{{ $item->jumlah }}</p></td>
                            <td class="tableitem"><p class="itemtext">{{ number_format($item->subtotal) }} ,-</p></td>
                          </tr>
                          @endforeach
 
                            
 
                            <tr class="tabletitle">
                                <td></td>
                                <td></td>
                                <td class="Rate"><h2>Total Harga</h2></td>
                                <td class="payment"><h2>Rp. {{ number_format($penjualan->total_harga) }}</h2></td>
                            </tr>
                            <tr class="tabletitle">
                                <td></td>
                                <td></td>
                                <td class="Rate"><h2>Jumlah Bayar</h2></td>
                                <td class="payment"><h2>Rp. {{ number_format($penjualan->bayar) }}</h2></td>
                            </tr>
                            <tr class="tabletitle">
                                <td></td>
                                <td></td>
                                <td class="Rate"><h2>Kembali</h2></td>
                                <td class="payment"><h2>Rp. {{ number_format($penjualan->kembali) }}</h2></td>
                            </tr>
                            <tr class="tabletitle">
                                <td></td>
                                <td></td>
                                <td class="Rate"><h2>Metode Pembayaran</h2></td>
                                <td class="payment"><h2>{{ $penjualan->metode_pembayaran }}</h2></td>
                            </tr>
 
                        </table>
                    </div><!--End Table-->
 
                    <div id="legalcopy">
                        <p class="legal"><strong>Terimakasih Telah Berbelanja!</strong>  Barang yang sudah dibeli tidak dapat dikembalikan. Jangan lupa berkunjung kembali <br> Hormat Kami, <br> {{ $penjualan->name }}
                        </p>
                    </div>
 
                </div><!--End InvoiceBot-->
  </div><!--End Invoice-->
 
</body>
 
</html>