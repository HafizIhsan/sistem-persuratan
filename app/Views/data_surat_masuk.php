<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Surat Masuk</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- <h6 class="m-0 font-weight-bold text-primary">Data Surat Keluar</h6> -->
            <div class="row justify-content-start">
                <div class="col-md-2">
                    <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span class="text">Kelola Surat Masuk</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-inline mb-3">
                <label for="filterTahun" class="mr-2 col-form-label">Year</label>
                <select id="filterTahun" class="form-control custom-select-sm">
                    <option selected>All</option>
                    <option>2020</option>
                    <option>2021</option>
                    <option>2022</option>
                </select>
            </div>
            <div class="table-responsive table-hover">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal Surat</th>
                            <th width="21%">Nomor Surat</th>
                            <th>Instansi Pengirim</th>
                            <th>Perihal</th>
                            <th>Dokumentasi</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>29/4/2021</td>
                            <td>B-001/02410/HM.300/04/2022</td>
                            <td>Kemendagri</td>
                            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem temporibus quo suscipit ducimus magni illum quibusdam incidunt quis, error quod ipsa deleniti nulla rem odit non modi mollitia. Reprehenderit, eligendi.</td>
                            <td>
                                <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <span class="text">Unduh</span>
                                </a>
                            </td>
                            <td>
                                <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <span class="text">Lihat</span>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>29/4/2021</td>
                            <td>B-001/02410/HM.300/04/2022</td>
                            <td>Kemendagri</td>
                            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem temporibus quo suscipit ducimus magni illum quibusdam incidunt quis, error quod ipsa deleniti nulla rem odit non modi mollitia. Reprehenderit, eligendi.</td>
                            <td>
                                <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <span class="text">Unduh</span>
                                </a>
                            </td>
                            <td>
                                <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <span class="text">Lihat</span>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>29/4/2022</td>
                            <td>B-001/02410/HM.300/04/2022</td>
                            <td>Kemendagri</td>
                            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem temporibus quo suscipit ducimus magni illum quibusdam incidunt quis, error quod ipsa deleniti nulla rem odit non modi mollitia. Reprehenderit, eligendi.</td>
                            <td>
                                <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <span class="text">Unduh</span>
                                </a>
                            </td>
                            <td>
                                <a href="#" class="btn btn-primary btn-icon-split btn-sm">
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
<!-- /.container-fluid -->
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#filterTahun').change(function() {
            var table = $('#dataTable').DataTable();
            var tahun = $('#filterTahun').val();

            if (tahun != 'All') {
                table.columns(0).search(tahun).draw();
            } else {
                table.columns(0).search('/').draw();
            }
        })
    });
</script>
<?= $this->endSection() ?>