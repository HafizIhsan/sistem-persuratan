<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Klasifikasi Surat</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-end">
                <div class="col-md-9"></div>
                <div class="col-md-3">
                    <a href="kelola_klasifikasi_surat" class="btn btn-primary btn-icon-split btn-sm ml-3">
                        <span class="icon text-white-50">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span class="text">Kelola Data</span>
                    </a>
                    <a href="#" class="btn btn-success btn-icon-split btn-sm ml-3">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Data</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Kode</th>
                            <th>Nomor</th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($klasifikasi_surat as $key => $klasifikasi_surat) : ?>
                            <?php for ($i = 0; $i <= count($kategori_klasifikasi); $i++) {
                                if ($klasifikasi_surat['KODE'] === $kategori_klasifikasi[$i]['KODE']) {
                                    $kategori = $kategori_klasifikasi[$i]['KATEGORI'];
                                }
                            } ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $klasifikasi_surat['KODE'] ?></td>
                                <td><?= $klasifikasi_surat['NOMOR_KLASIFIKASI'] ?></td>
                                <td><?= $kategori ?></td>
                                <td><?= $klasifikasi_surat['KETERANGAN'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>