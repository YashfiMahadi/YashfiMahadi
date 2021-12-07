<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> Transaksi </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('/') ? 'bg-white' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt {{ request()->is('/') ? 'text-info font-weight-bold' : 'text-white' }}"></i>
            <span class="{{ request()->is('/') ? 'text-info font-weight-bold' : '' }}">
                Dashboard
            </span>
        </a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ request()->is('input/transaksi') ? 'bg-white' : '' }}">
        <a class="nav-link" href="{{ route('transaksi') }}">
            <i class="fas fa-fw fa-table {{ request()->is('input/transaksi') ? 'text-info font-weight-bold' : 'text-white' }}"></i>
            <span class="{{ request()->is('input/transaksi') ? 'text-info font-weight-bold' : '' }}">
                Input Transaksi
            </span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>