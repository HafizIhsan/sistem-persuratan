<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Surat Masuk</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php
            if (session()->getFlashData('success')) {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashData('success') ?>
                    <button id="closeAlert" type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
            }
            ?>
            <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-white-50">
                    <i class="fas fa-edit"></i>
                </span>
                <span class="text">Kelola Surat Masuk</span>
            </a>
            <hr>
            <div class="form-inline mb-3">
                <label for="filterTahun" class="mr-2 col-form-label">Tahun</label>
                <select id="filterTahun" class="form-control custom-select-sm">
                    <option selected>Semua</option>
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
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                                        <span class="icon">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                    </a>
                                </div>
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
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#myModal">
                                        <span class="icon">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </a>
                                </div>

                                <!-- View Modal -->
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <embed src="<?= base_url() ?>/doc/surat_masuk.pdf" frameborder="0" width="100%" height="600px">

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-eye"></i>
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
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#myModal">
                                        <span class="icon">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </a>
                                </div>

                                <!-- View Modal -->
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <embed src="<?= base_url() ?>/doc/surat_masuk.pdf" frameborder="0" width="100%" height="600px">

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
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

            if (tahun != 'Semua') {
                table.columns(0).search(tahun).draw();
            } else {
                table.columns(0).search('/').draw();
            }
        })
    });
</script>
<?= $this->endSection() ?>