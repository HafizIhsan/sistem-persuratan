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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">342</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">32</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Penugasan surat masuk</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tenggat Penugasan</th>
                                    <th>Nomor Surat</th>
                                    <th>Uraian Penugasan</th>
                                    <th>Status</th>
                                    <th>Dokumen Surat</th>
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
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Surat keluar yang belum Anda dokumentasi</h6>
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
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    $('#dataTable1').dataTable({
        bDestroy: true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
        }
    });
    $('#dataTable2').dataTable({
        bDestroy: true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
        }
    });
</script>

<?= $this->endSection() ?>