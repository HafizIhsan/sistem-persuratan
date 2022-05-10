<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Surat Masuk</h1>

    <!-- DataTales Example -->
    <div class="row">
        <div class="col-12 col-lg-2">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-secondary">Filter</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="filterTahun" class="col-form-label">Tahun</label>
                        <select id="filterTahun" class="form-control custom-select-sm">
                            <option selected>Semua</option>
                            <?php
                            foreach ($surat_masuk as $i) {
                                $year[] = date('Y', strtotime($i['CREATED_AT']));
                            };
                            if (isset($year)) {
                                $year_filter = array_unique($year);
                                for ($i = 0; $i < count($year_filter); $i++) {
                            ?>
                                    <option value="<?= $year_filter[$i] ?>"><?= $year_filter[$i] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="filterStatus" class="col-form-label">Status Penugasan</label>
                        <select id="filterStatus" class="form-control custom-select-sm">
                            <option selected>Semua</option>
                            <option>Belum ditugaskan</option>
                            <option>Belum Selesai</option>
                            <option>Selesai</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-10">
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
                    <a href="dokumentasi_surat_masuk" class="btn btn-success btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah</span>
                    </a>
                    <hr>
                    <div class="table-responsive table-hover">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Terima</th>
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
                                        <td><?= date('d-m-Y', strtotime($surat_masuk['CREATED_AT'])) ?></td>
                                        <td><?= $surat_masuk['INSTANSI_PENGIRIM'] ?></td>
                                        <td><?= $surat_masuk['KETERANGAN'] ?></td>
                                        <td><?= $surat_masuk['STATUS'] ?></td>
                                        <td><?= $nama ?></td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <a href="#" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#viewModal-<?= $surat_masuk['ID_SURAT_MASUK'] ?>">
                                                    <span class="icon">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-secondary btn-icon-split btn-sm ml-2">
                                                    <span class="icon">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-danger btn-icon-split btn-sm ml-2" data-toggle="modal" data-target="#hapusModal-<?= $surat_masuk['ID_SURAT_MASUK'] ?>">
                                                    <span class="icon">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-primary btn-icon-split btn-sm ml-2">
                                                    <span class="text">Detail</span>
                                                </a>
                                            </div>

                                            <!-- View Modal -->
                                            <div id="viewModal-<?= $surat_masuk['ID_SURAT_MASUK'] ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-xl">

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

                                            <!-- Hapus Klasifikasi Modal -->
                                            <div class="modal fade" id="hapusModal-<?= $surat_masuk['ID_SURAT_MASUK'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">Apakah anda yakin ingin menghapus data surat dari : <?= $surat_masuk['INSTANSI_PENGIRIM'] ?> ?</div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                            <a class="btn btn-primary" href="<?= base_url('data_surat_masuk/delete/' . $surat_masuk['ID_SURAT_MASUK']) ?>">Hapus</a>
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

        $('#filterStatus').change(function() {
            var table = $('#dataTable').DataTable();
            var status = $('#filterStatus').val();

            if (status != 'Semua') {
                table.columns(4).search(status).draw();
            } else {
                table.columns(4).search('Selesai', 'Belum ditugaskan', 'Belum selesai').draw();
            }
        })
    });
</script>
<?= $this->endSection() ?>