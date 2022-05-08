<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Klasifikasi Surat</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
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
                <a href="data_klasifikasi_surat" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Selesai</span>
                </a>
                <hr>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Kode</th>
                            <th>Nomor</th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($klasifikasi_surat as $key => $klasifikasi_surat) : ?>
                            <?php for ($i = 0; $i <= count($kategori_klasifikasi); $i++) {
                                if ($klasifikasi_surat['KODE'] === $kategori_klasifikasi[$i]['KODE']) {
                                    $kategori = $kategori_klasifikasi[$i]['KATEGORI'];
                                }
                            }   ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $klasifikasi_surat['KODE'] ?></td>
                                <td><?= $klasifikasi_surat['NOMOR_KLASIFIKASI'] ?></td>
                                <td><?= $kategori ?></td>
                                <td><?= $klasifikasi_surat['KETERANGAN'] ?></td>
                                <td>
                                    <div class="btn-group d-flex align-items-sm-center" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editModal-<?= $klasifikasi_surat['ID_KLASIFIKASI_SURAT'] ?>">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal-<?= $klasifikasi_surat['ID_KLASIFIKASI_SURAT'] ?>">Hapus</button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Klasifikasi Modal -->
                            <div class="modal fade" id="editModal-<?= $klasifikasi_surat['ID_KLASIFIKASI_SURAT'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Klasifikasi Surat</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="<?= base_url('kelola_klasifikasi_surat/edit/' . $klasifikasi_surat['ID_KLASIFIKASI_SURAT']) ?>" method="post">
                                            <?= csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="form-group col-1">
                                                        <label for="kodeKlasifikasi" class="col-form-label">Kode :</label>
                                                        <input name='kode' type="text" class="form-control" id="kodeKlasifikasi" placeholder="Kode klasifikasi" value="<?= $klasifikasi_surat['KODE'] ?>" readonly required>
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label for="editNoKlasifikasi" class="col-form-label">Nomor Klasifikasi :</label>
                                                        <input name='nomor_klasifikasi' type="text" class="form-control" id="editNoKlasifikasi" placeholder="Nomor klasifikasi" value="<?= $klasifikasi_surat['NOMOR_KLASIFIKASI'] ?>" required readonly>
                                                    </div>
                                                    <div class="form-group col-7">
                                                        <label for="editKategori" class="col-form-label">Kategori :</label>
                                                        <input name='kategori' type="text" class="form-control" id="editKategori" placeholder="Kategori" value="<?= $kategori ?>" required readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editKeteranganKlasifikasi" class="col-form-label">Keterangan Klasifikasi :</label>
                                                    <textarea name='keterangan' class="form-control" id="editKeteranganKlasifikasi" rows="3" required placeholder="Keterangan klasifikasi" style="resize: none;"><?= $klasifikasi_surat['KETERANGAN'] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Hapus Klasifikasi Modal -->
                            <div class="modal fade" id="hapusModal-<?= $klasifikasi_surat['ID_KLASIFIKASI_SURAT'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Apakah anda yakin ingin menghapus klasifikasi "<?= $klasifikasi_surat['KODE'] . " " . $klasifikasi_surat['NOMOR_KLASIFIKASI'] ?>"?</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                            <a class="btn btn-primary" href="<?= base_url('kelola_klasifikasi_surat/delete/' . $klasifikasi_surat['ID_KLASIFIKASI_SURAT']) ?>">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
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
    setTimeout("CallButton()", 2000)

    function CallButton() {
        document.getElementById("closeAlert").click();
    }
</script>

<?= $this->endSection() ?>