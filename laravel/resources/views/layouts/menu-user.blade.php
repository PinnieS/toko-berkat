<div class="sidebar-heading">
    Menu
</div>
@if (Auth::user()->level==1)

<li class="nav-item {{ request()->is('data-user*') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('data-user') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Data User</span></a>
</li>

<li class="nav-item {{ request()->is('produk*') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('produk') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Barang</span></a>
</li>
<li class="nav-item {{ request()->is('supplier*') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('supplier') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Supplier</span></a>
</li>


<li class="nav-item {{ request()->is('pembelian*') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('pembelian') }}">
        <i class="fas fa-fw fa-list"></i>
        <span>Data Barang Masuk</span></a>
</li>
<li class="nav-item {{ request()->is('penjualan*') || request()->is('pos') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('penjualan') }}">
        <i class="fas fa-fw fa-shopping-cart"></i>
        <span>Data Barang Keluar</span></a>
</li>
<li class="nav-item {{ request()->is('stok-opname')  ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('stok-opname') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Stok Opname</span></a>
</li>

@elseif(Auth::user()->level==2)
<li class="nav-item {{ request()->is('pembelian*') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('pembelian') }}">
        <i class="fas fa-fw fa-list"></i>
        <span>Data Barang Masuk</span></a>
</li>
<li class="nav-item {{ request()->is('penjualan*') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('penjualan') }}">
        <i class="fas fa-fw fa-shopping-cart"></i>
        <span>Data Barang Keluar</span></a>
</li>
<hr class="sidebar-divider d-none d-md-block">


@elseif(Auth::user()->level==3)
<li class="nav-item {{ request()->is('produk*') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('produk') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Barang</span></a>
</li>


<li class="nav-item {{ request()->is('pembelian*') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('pembelian') }}">
        <i class="fas fa-fw fa-list"></i>
        <span>Data Barang Masuk</span></a>
</li>
<li class="nav-item {{ request()->is('penjualan*') || request()->is('pos') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('penjualan') }}">
        <i class="fas fa-fw fa-shopping-cart"></i>
        <span>Data Barang Keluar</span></a>
</li>

@else

@endif


