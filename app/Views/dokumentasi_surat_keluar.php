<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Masukkan Informasi Surat Keluar</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <form class="user">
            <div class="form-group">
                <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
            </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
            </div>
        </form>
    </div>
    <!-- Content Row -->
</div>
<?= $this->endSection() ?>