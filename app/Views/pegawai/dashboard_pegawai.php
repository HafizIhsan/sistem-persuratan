<?= $this->extend('layouts/pegawai') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Surat Keluar Anda</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $surat_keluar ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas ri-mail-send-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Surat Keluar Belum di Dokumentasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($surat_keluar_saya) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas ri-mail-send-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-xl-10 col-md-8 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Surat Keluar Belum di Dokumentasi</h6>
                        <a href="surat_keluar_anda" style="text-decoration-line: underline;" class="text-gray-600">Lihat selengkapnya</a>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                    if (count($surat_keluar_saya) != 0) {
                    ?>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Surat</th>
                                        <th>Perihal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($surat_keluar_saya as $key => $surat_keluar_saya) : ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
                                            <td><?= $surat_keluar_saya['NOMOR_SURAT_KELUAR'] ?></td>
                                            <td><?= $surat_keluar_saya['PERIHAL'] ?></td>
                                            <td>
                                                <form action="<?= base_url('SuratKeluarController/to_dokumentasi_surat_keluar') ?>" method="POST">
                                                    <input type="text" name="id_surat_keluar" value="<?= $surat_keluar_saya['ID_SURAT_KELUAR'] ?>" hidden>
                                                    <button type="submit" class="btn btn-success btn-icon-split btn-sm">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-plus"></i>
                                                        </span>
                                                        <span class="text">Dokumentasi</span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div class="d-flex justify-content-center">
                            <h4>Semua surat keluar anda sudah terdokumentasi</h4>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    $('#dataTable2').dataTable({
        bDestroy: true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
        },
        paging: false,
        searching: false,
        "initComplete": function(settings, json) {
            $("#dataTable").wrap("<div style='overflow:auto; width:100%;position:relative; max-height:47vh;'></div>");
        },
        scrollCollapse: true
    });
</script>

<?= $this->endSection() ?>