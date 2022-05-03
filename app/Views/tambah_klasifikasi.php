<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Klasifikasi Surat</h1>
    </div>
    <!-- Content Row -->
    <div class="col-xl-9">
        <form id="formDokumentasiSuratKeluar" method="POST">
            <div class="form-group row">
                <label for="pilihKategori" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <select id="pilihKategori" class="form-control" placeholder="Pilih kategori">
                        <?php foreach ($kategori_klasifikasi as $key => $kategori_klasifikasi) : ?>
                            <option><?php echo $kategori_klasifikasi['KATEGORI'] . " (" . $kategori_klasifikasi['KODE'] . ")"; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputNoKlasifikasi" class="col-sm-2 col-form-label">Nomor Klasifikasi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputNoKlasifikasi" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="uraianKlasifikasi" class="col-sm-2 col-form-label">Keterangan Klasifikasi</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="uraianKlasifikasi" rows="3"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#submitModal">Submit</button>
                </div>
            </div>

            <!-- Submit Modal-->
            <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Apakah data sudah benar?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Pilih "Selesai" jika data sudah benar.</div>
                        <div class="modal-footer form-group">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                            <button id="submitDokumentasi" class="btn btn-primary" type="submit" data-dismiss="modal">Selesai</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Content Row -->
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    $(function() {
        $('#submitDokumentasi').on('click', function(e) {
            $('#formDokumentasiSuratKeluar').submit();
        });
    });
</script>
<?= $this->endSection() ?>