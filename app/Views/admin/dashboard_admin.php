<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Surat Keluar (<?= date("Y") ?>)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $surat_keluar ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas ri-mail-send-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Surat Masuk (<?= date("Y") ?>)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $surat_masuk ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas ri-mail-download-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Surat Lainnya (<?= date("Y") ?>)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $surat_lainnya ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->
    <div class="row" style="min-height:30vh;">
        <div class="col-12 col-lg-6">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Penugasan Surat Masuk</h6>
                        <a href="penugasan_surat_masuk" style="text-decoration-line: underline;" class="text-gray-600">Lihat selengkapnya</a>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                    $tgs = 0;
                    foreach ($tugas_saya as $key => $tugas) {
                        if ($tugas['STATUS'] != 'Selesai') {
                            $tgs++;
                        }
                    }
                    if ($tgs != 0) {
                    ?>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Perihal</th>
                                        <th>Uraian Penugasan</th>
                                        <th>Tenggat Penugasan</th>
                                        <th>Dokumen Surat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tugas_saya as $key => $tugas_saya) :
                                        if ($tugas_saya['STATUS'] != 'Selesai') { ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= $tugas_saya['PERIHAL'] ?></td>
                                                <td><?= $tugas_saya['URAIAN_PENUGASAN'] ?></td>
                                                <td><?= date('d-m-y H:i', strtotime($tugas_saya['TENGGAT_PENUGASAN'])) . " WIB" ?></td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="<?= base_url('uploads/dokumentasi/' . $tugas_saya['SCAN_SURAT_MASUK']) ?>" class="btn btn-success btn-icon-split btn-sm disable" target="_blank">
                                                        <span class="icon">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php }
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div class="d-flex justify-content-center">
                            <h4>Tidak ada penugasan surat masuk</h4>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Surat Keluar Anda (Belum di Dokumentasi)</h6>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($surat_keluar_saya as $key => $surat_keluar_saya) : ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
                                            <td><?= $surat_keluar_saya['NOMOR_SURAT_KELUAR'] ?></td>
                                            <td><?= $surat_keluar_saya['PERIHAL'] ?></td>
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

    <!-- <div><a href="send_email">send email</a></div> -->

    <!-- Content Row -->
    <div class="row">

    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    $('#dataTable1').dataTable({
        bDestroy: true,
        paging: false,
        searching: false,
        info: false,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
        },
        scrollY: '47vh',
        scrollCollapse: true
    });
    $('#dataTable2').dataTable({
        bDestroy: true,
        paging: false,
        searching: false,
        info: false,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
        },
        scrollY: '47vh',
        scrollCollapse: true
    });
</script>

<?= $this->endSection() ?>