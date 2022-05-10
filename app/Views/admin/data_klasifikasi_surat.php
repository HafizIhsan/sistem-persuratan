<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Klasifikasi Surat</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive table-hover">
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
                <a href="kelola_klasifikasi_surat" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-edit"></i>
                    </span>
                    <span class="text">Kelola</span>
                </a>
                <a href="tambah_klasifikasi" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#tambahModal">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah</span>
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
                        <?php endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-secondary">
                    <h5 class="modal-title text-white" id="tambahModalLabel">Tambah Klasifikasi Surat</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTambahKlasifikasi" method="POST" class="needs-validation">
                        <div class="form-row">
                            <div class="form-group col-8">
                                <label for="pilihKategori" class="col-form-label">Kategori :</label>
                                <select name='kode' id="pilihKategori" class="form-control" placeholder="Pilih kategori" required>
                                    <option value="" selected>Pilih kategori</option>
                                    <?php foreach ($kategori_klasifikasi as $key => $kategori_klasifikasi) : ?>
                                        <option value="<?= $kategori_klasifikasi['KODE'] ?>"><?php echo $kategori_klasifikasi['KATEGORI'] . " (" . $kategori_klasifikasi['KODE'] . ")"; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="inputNoKlasifikasi" class="col-form-label">Nomor Klasifikasi :</label>
                                <input name='nomor_klasifikasi' type="text" class="form-control" id="inputNoKlasifikasi" placeholder="Nomor klasifikasi" required>
                                <small id="nomorKlasifikasiHelpBlock" class="form-text text-muted">
                                    Nomor klasifikasi terdiri dari 3 atau 4 angka <br> Contoh: 021, 130, 1101
                                </small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="uraianKlasifikasi" class="col-form-label">Keterangan Klasifikasi :</label>
                            <textarea name='keterangan' class="form-control" id="uraianKlasifikasi" rows="3" required placeholder="Keterangan klasifikasi" style="resize: none;"></textarea>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button id="tambahKlasifikasi" type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </form>
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
        $('#pilihKategori').selectize({
            searchField: 'text'
        });
    });

    setTimeout("CallButton()", 2000)

    function CallButton() {
        document.getElementById("closeAlert").click();
    }
</script>

<?= $this->endSection() ?>