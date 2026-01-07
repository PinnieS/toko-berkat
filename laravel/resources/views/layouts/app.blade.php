<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TB. BERKAT REZEKI - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('template') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('template') }}/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="{{ asset('template') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @livewireStyles

</head>

<body id="page-top" class="">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion {{ request()->is('pos') ? 'toggled' : ''}}" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">TB. BERKAT REZEKI</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is('home') ? 'active' : ''}}">
                <a class="nav-link " href="{{ url('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            {{-- Menu User Star --}}
            @include('layouts.menu-user')
            {{-- Menu User End --}}

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        {{-- POs --}}
                        {{-- <li class="nav-item no-arrow">
                            <a class="nav-link btn btn-primary mr-5 h-50 mt-3" href="{{ url('pos') }}" id="userDropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-fw fa-shopping-cart"></i>SISTEM PENJUALAN
                            </a>
                        </li> --}}
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }} (@if(Auth::user()->level==1) Admin @elseif(Auth::user()->level==2) Pimpinan @elseif(Auth::user()->level==3) Kasir @else Karyawan @endif)</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('template') }}/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ url('profil') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                       

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h5 mb-4 text-gray-800">SISTEM INFORMASI PERSEDIAAN BARANG TB. BERKAT REZEKI</h1>

                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; TB. BERKAT REZEKI 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('template') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template') }}/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('template') }}/vendor/chart.js/Chart.min.js"></script>
    <script src="{{ asset('template') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('template') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('template') }}/js/demo/chart-area-demo.js"></script>
    <script src="{{ asset('template') }}/js/demo/chart-pie-demo.js"></script>
    <script src="{{ asset('template') }}/js/demo/datatables-demo.js"></script>

    

    {{-- select2 --}}
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- AJAX --}}

    <script>
        $(document).ready(function() {
            $('#select2').select2();
        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
        });
    
        showproduk();
        function showproduk() {
            $.ajax({
                url: "{{ url('get-produk') }}",
                type: 'get',
                success: function(data) {
                    $('#getproduk').html(data);
                }
            });
        }

        function loadDeleteModal(id) {
            $('#id_produk_delete').val(id);
            $('#hapusModalProduk').modal('show');
        }
        
        $("#cari_by_kategori").click(function(){
            var id_kategori = $("#id_kategori").val();
            $.ajax({
                url: "{{ url('cari-produk') }}",
                type: 'POST',
                data: {id_kategori:id_kategori},
                success: function(data) {
                    $('#getproduk').html(data);
                }
            });
        })
    </script>
    
    <script>
    // TAMBAH ITEM
       function addCart($id) {
            var no_transaksi = $("#no_transaksi").val();
            var jumlah = $("#jumlah_add").val();
            var id_produk = $id;
            $.ajax({
                url: "{{ url('add-cart') }}",
                type: 'POST',
                data: {no_transaksi:no_transaksi,id_produk:id_produk,jumlah:jumlah},
                success: function(data) {
                    showCart();
                    showFormCart();
                }
            });
       }
    // KURANGI ITEM
       function kurangCart($id) {
            var id_detail = $id;
            var harga_jual = $("#harga_jual").val();
            $.ajax({
                url: "{{ url('kurang-cart') }}",
                type: 'POST',
                data: {id_detail:id_detail, harga_jual:harga_jual},
                success: function(data) {
                    showCart();
                    showFormCart();
                }
            });
       }
    //    HAPUS ITEM
       function hapusCart($id) {
            var id_detail = $id;
            $.ajax({
                url: "{{ url('hapus-cart') }}",
                type: 'POST',
                data: {id_detail:id_detail},
                success: function(data) {
                    showCart();
                    showFormCart();
                }
            });
       }
        //    SHOW DETAIL PEMBELIAN
       showCart();
        function showCart() {
            var no_transaksi = $("#no_transaksi").val();
            $.ajax({
                url: "{{ url('show-cart') }}",
                type: 'POST',
                data:{no_transaksi:no_transaksi},
                success: function(data) {
                    $('#showCart').html(data);
                   
                }
            });
        }

        // SHOW PRODUK POS
        showProdukPos();
        function showProdukPos() {
            $.ajax({
                url: "{{ url('show-produk-pos') }}",
                type: 'GET',
                success: function(data) {
                    $('#show_produk_pos').html(data);
                }
            });
        }

        // CARI PRODUK DI POS
   
        function cariProduk()
        {
            var cariproduk = $("#cari_produk").val();
            $.ajax({
                url: "{{ url('cari-produk-pos') }}",
                type: 'POST',
                data: {cariproduk:cariproduk},
                success: function(data) {
                    $('#show_produk_pos').html(data);
                }
            });
        }
        // SHOW FORM TRASNAKSI (TOTAL ITEM, HARGA, DLL)
        showFormCart();
        function showFormCart() {
            var no_transaksi = $("#no_transaksi").val();
            $.ajax({
                url: "{{ url('show-form-cart') }}",
                type: 'POST',
                data:{no_transaksi:no_transaksi},
                success: function(data) {
                    for (let x = 0; x < data.length; x++) {
                        var a = data[x].subtotal;
                       
                        $('#total_harga').val(convertToRupiah(a));
                        $('#total_item').val(data[x].total_item);
                      
                    }
                    var c = convertToRupiah(a);
                    $("#grand_total").val(c);
                    
                    var d = $("#bayar").val();
                    var e = convertToAngka(d);

                    
                }
            });
        }

        // AKSI BAYAR
        let dengan_rupiah = document.getElementById('bayar');
            dengan_rupiah.addEventListener('keyup', function (e) {
                dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
                let grand_total_rupiah = $("#grand_total").val(); 
                let bayar_rupiah = $("#bayar").val();
                let grand_total = convertToAngka(grand_total_rupiah);
                let bayar = convertToAngka(bayar_rupiah);
                let kembali = bayar - grand_total;
               
                $("#kembali").val(convertToRupiah(kembali));

             

                if (bayar >= grand_total) {
                    var element = document.getElementById("simpan_transaksi");
                    element.classList.remove("disabled");
                }else{
                
                }
        });

        // SIMPAN TRANSAKSI
        function simpanTransaksi() {
            // normal item
            var no_transaksi = $("#no_transaksi").val();
            var nama_pelanggan = $("#nama_pelanggan").val();
            var telepon = $("#telepon").val();
            var tgl2 = $("#tgl2").val();
            var total_item = $("#total_item").val();
            var id_user = {{ Auth::user()->id }};
            var metode_pembayaran = $("#metode_pembayaran").val();
            // versi rupiah
            let grand_total_rupiah = $("#grand_total").val(); 
        
            let bayar_rupiah = $("#bayar").val(); 
            let kembali_rupiah = $("#kembali").val();
            
            // versi angka
            let grand_total = convertToAngka(grand_total_rupiah);
         
            let bayar = convertToAngka(bayar_rupiah);
            let kembali = convertToAngka(kembali_rupiah);

            // AJAX SIMPAN
            $.ajax({
                url: "{{ url('simpan-penjualan') }}",
                type: 'POST',
                data:{no_transaksi:no_transaksi,nama_pelanggan:nama_pelanggan,telepon:telepon,total_item:total_item,total_harga:grand_total,bayar:bayar,kembali:kembali,id_user:id_user,metode_pembayaran:metode_pembayaran,tgl2:tgl2},
                success: function(data) {
                    cetakFaktur(no_transaksi);

                    // Kosongkan input form
                    $("#no_transaksi").val('');
                    $("#nama_pelanggan").val('');
                    $("#telepon").val('');
                    $("#tgl2").val('');
                    $("#total_harga").val('');
                    $("#total_item").val('');
                    $("#grand_total").val('');
                    $("#bayar").val('');
                    $("#kembali").val('');
                    $("#metode_pembayaran").val('').trigger('change'); // untuk select2 jika digunakan
                     showCart();
                    // Jika ada tabel cart atau item transaksi, hapus juga
                    $("#tabel-transaksi tbody").empty();

                    // Reset total item dan total harga
                    $("#total_item").text('0');
                    $("#grand_total").text('Rp 0');
                },

                error: function(data){
                    cetakFaktur(no_transaksi);
                }
            });
            
        }

        // cetak faktur

        function cetakFaktur(no_transaksi) {
            var no_transaksi = no_transaksi;
            $("#id_faktur").val(no_transaksi);
            $('#fakturModal').modal('show');
        }

        // FUNGSI RUPIAH ANGKA
        function convertToRupiah(angka)
        {
        var rupiah = '';		
        var angkarev = angka.toString().split('').reverse().join('');
        for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
        }

        function convertToAngka(rupiah)
        {
            return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
        }

        function formatRupiah(angka, prefix) {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>

    <script>
        let transaksiBerjalan = false;

        setInterval(() => {
            transaksiBerjalan = $("#showCart tr").length > 0;
        }, 1000);

        $('a').on('click', function (e) {
            const href = $(this).attr('href');

            if (transaksiBerjalan) {
                e.preventDefault();
                alert('Transaksi anda belum selesai, data akan di hapus secara permanent jika pindah halaman');

                $.ajax({
                    url: '{{ url("hapus-barang-keluar-pos") }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function () {
                        window.location.href = href;
                    },
                    error: function () {
                        alert('Gagal menghapus data transaksi!');
                    }
                });
            }
        });
    </script>

</body>

</html>
