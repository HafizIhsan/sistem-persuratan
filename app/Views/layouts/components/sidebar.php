<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard_admin">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-envelope"></i>
        </div>
        <div class="sidebar-brand-text mx-3 text-left mt-3">
            <p class="mb-0" style="font-size:15px;">Sistem Persuratan</p>
            <p style="font-size:10px;">Humas & Hukum BPS</p>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="dashboard_admin">

            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="buat_surat_keluar">

            <i class="fas fa-fw  fa-pencil-alt"></i>
            <span>Membuat Surat Keluar</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Dokumentasi Surat
    </div>

    <!-- Nav Item - Surat Keluar -->
    <li class="nav-item">
        <a class="nav-link" href="dokumentasi_surat_keluar">
            <i class="fas fa-fw ri-mail-send-fill"></i>
            <span>Surat Keluar</span>
        </a>
    </li>

    <!-- Nav Item - Surat Masuk -->
    <li class="nav-item">
        <a class="nav-link" href="dokumentasi_surat_masuk">
            <i class="fas fa-fw ri-mail-download-fill"></i>
            <span>Surat Masuk</span>
        </a>
    </li>

    <!-- Nav Item - Surat Masuk -->
    <li class="nav-item">
        <a class="nav-link" href="dokumentasi_surat_lainnya">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Surat Lainnya</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Kelola Data
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Surat</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="data_surat_keluar">Surat Keluar</a>
                <a class="collapse-item" href="data_surat_masuk">Surat Masuk</a>
                <a class="collapse-item" href="data_surat_keluar">Surat Lainnya</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- Nav Item - Surat Masuk -->
    <li class="nav-item">
        <a class="nav-link" href="data_pengguna">
            <i class="fas fa-fw fa-user"></i>
            <span>Data Pengguna</span></a>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa-fw fa-user"></i>
            <span>Data Pengguna</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="data_admin">Admin</a>
                <a class="collapse-item" href="data_pegawai">Pegawai</a>
            </div>
        </div>
    </li> -->

    <!-- Nav Item - Surat Masuk -->
    <li class="nav-item">
        <a class="nav-link" href="data_klasifikasi_surat">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Klasifikasi Surat</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->