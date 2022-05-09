<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Surat Masuk</h1>

    <!-- DataTales Example -->
    <div class="row">
        <div class="col-12 col-md-10">
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
                    <!-- <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span class="text">Kelola Surat Masuk</span>
                    </a>
                    <hr> -->
                    <div class="table-responsive table-hover">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Surat</th>
                                    <th>Pengirim</th>
                                    <th>Keterangan</th>
                                    <th>Status Penugasan</th>
                                    <th>Petugas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($surat_masuk as $key => $surat_masuk) : ?>
                                    <?php for ($i = 0; $i <= count($pengguna); $i++) {
                                        if ($surat_masuk['ID_PENGGUNA'] === $pengguna[$i]['ID_PENGGUNA']) {
                                            $nama = $pengguna[$i]['NAMA'];
                                        }
                                    } ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td><?= $surat_masuk['CREATED_AT'] ?></td>
                                        <td><?= $surat_masuk['INSTANSI_PENGIRIM'] ?></td>
                                        <td><?= $surat_masuk['KETERANGAN'] ?></td>
                                        <td><?= $surat_masuk['STATUS'] ?></td>
                                        <td><?= $nama ?></td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <a href="#" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#myModal">
                                                    <span class="icon">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-secondary btn-icon-split btn-sm ml-2">
                                                    <span class="icon">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-danger btn-icon-split btn-sm ml-2">
                                                    <span class="icon">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-primary btn-icon-split btn-sm ml-2">
                                                    <span class="text">Detail</span>
                                                </a>
                                            </div>

                                            <!-- View Modal -->
                                            <div id="myModal" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-xl modal-dialog-centered">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <embed src="<?= base_url('uploads/' . $surat_masuk['SCAN_SURAT_MASUK']) ?>" frameborder="0" width="100%" height="600px">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-2">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-secondary">Filter</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="filterTahun" class="col-form-label">Tahun</label>
                        <select id="filterTahun" class="form-control custom-select-sm">
                            <option selected>Semua</option>
                            <option>2020</option>
                            <option>2021</option>
                            <option>2022</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="filterTahun" class="col-form-label">Status Penugasan</label>
                        <select id="filterTahun" class="form-control custom-select-sm">
                            <option selected>Semua</option>
                            <option>2020</option>
                            <option>2021</option>
                            <option>2022</option>
                        </select>
                    </div>
                </div>
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
                table.columns(1).search(tahun).draw();
            } else {
                table.columns(1).search('-').draw();
            }
        })
    });
</script>
<?= $this->endSection() ?>