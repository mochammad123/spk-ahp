<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard/index">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">RD Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    @can('isAdmin')
    <div class="sidebar-heading">
        Data
    </div>

                <!-- Nav Item - Charts -->
    <li class="nav-item {{ Request::is('dashboard/criterias') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard/criterias">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Kriteria</span></a>
    </li>

    <li class="nav-item {{ Request::is('dashboard/subcriteria') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard/subcriteria">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Sub Kriteria</span></a>
    </li>

    <li class="nav-item {{ Request::is('dashboard/alternatives') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard/alternatives">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Alternatif</span></a>
    </li>
    @endcan

    @can('isUser')
    <div class="sidebar-heading">
        Perbandingan
    </div>

    <li class="nav-item {{ Request::is('dashboard/criteriacomparisons') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard/criteriacomparisons">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Perbandingan Kriteria</span></a>
    </li>

    <li class="nav-item {{ Request::is('dashboard/subcriteriacomparisons') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard/subcriteriacomparison">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Perbandingan Sub Kriteria</span></a>
    </li>

    <li class="nav-item {{ Request::is('dashboard/alternativecomparisons') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard/alternativecomparison">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Perbandingan Alternatif</span></a>
    </li>
    @endcan
 
                    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
        
                    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->