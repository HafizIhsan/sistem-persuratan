<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
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
            <div class="card border-left-success shadow h-100 py-2">
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
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Penugasan Surat Masuk</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pengirim</th>
                                    <th>Uraian Penugasan</th>
                                    <th>Tenggat Penugasan</th>
                                    <th>Status Penugasan</th>
                                    <th>Dokumen Surat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tugas_saya as $key => $tugas_saya) :
                                    if ($tugas_saya['STATUS'] != 'Selesai') { ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
                                            <td><?= $tugas_saya['INSTANSI_PENGIRIM'] ?></td>
                                            <td><?= $tugas_saya['URAIAN_PENUGASAN'] ?></td>
                                            <td><?= date('d-m-y H:i:s', strtotime($tugas_saya['TENGGAT_PENUGASAN'])) ?></td>
                                            <td><?= $tugas_saya['STATUS'] ?></td>
                                            <td>
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
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Surat Keluar Saya (Belum di Dokumentasi)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tanggal Surat</th>
                                    <th>Nomor Surat</th>
                                    <th>Perihal</th>
                                    <th>Status</th>
                                    <th>Dokumentasi</th>
                                    <th>Detail Surat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>15/04/2002</td>
                                    <td>B-001/02410/HM.300/04/2022</td>
                                    <td>Permintaan data untuk kegiatan statistik</td>
                                    <td>Sudah dikirim</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-flag"></i>
                                            </span>
                                            <span class="text">Unduh</span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-flag"></i>
                                            </span>
                                            <span class="text">Lihat</span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        }
    });
    $('#dataTable2').dataTable({
        bDestroy: true,
        paging: false,
        searching: false,
        info: false,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
        }
    });
</script>

<?= $this->endSection() ?>