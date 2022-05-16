<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dokumentasi Surat Lainnya</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-12 col-lg-8 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <?php
                    if (session()->getFlashData('error')) {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashData('error') ?>
                            <button id="closeAlert" type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    }

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

                    <form id="formDokumentasiSuratLainnya" method="post" onchange="validate();" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pilihJenisSurat" class="col-form-label">Jenis Surat :</label>
                                <select name="id_jenis_surat_lainnya" id="pilihJenisSurat" class="form-control">
                                    <option value="">Pilih jenis surat...</option>
                                    <?php foreach ($jenis_surat_lainnya as $key => $jenis_surat_lainnya) : ?>
                                        <option value="<?= $jenis_surat_lainnya['ID_JENIS_SURAT_LAINNYA'] ?>"><?= $jenis_surat_lainnya['JENIS_SURAT'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputNoSurat" class="col-form-label">Nomor Surat :</label>
                                <input name="nomor_surat" type="text" class="form-control" id="inputNoSurat" placeholder="Nomor surat" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPihakPertama" class="col-form-label">Pihak Pertama :</label>
                                <input name="pihak_1" type="text" class="form-control" id="inputPihakPertama" placeholder="Pihak pertama" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPihakKedua" class="col-form-label">Pihak Kedua :</label>
                                <input name="pihak_2" type="text" class="form-control" id="inputPihakKedua" placeholder="Pihak kedua" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tentang" class="col-form-label">Tentang :</label>
                            <textarea name="tentang" class="form-control" id="inputTentang" rows="3" placeholder="Tentang" required></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Dokumentasi Surat :</label>
                                <div class="custom-file">
                                    <label class="custom-file-label" for="dokumenSurat">Pilih file...</label>
                                    <input name="file" type="file" class="custom-file-input" id="dokumenSurat" accept="application/pdf">
                                </div>
                                <small id="klasifikasiHelpBlock" class="form-text text-muted">
                                    Tipe file pdf dan ukuran maksimum 2mb
                                </small>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button id="submitButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#submitModal" disabled=true>Submit</button>
                        </div>

                        <!-- Submit Modal-->
                        <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
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
            </div>
        </div>
        <div class="col-12 col-lg-4 d-flex align-items-center">
            <img src="<?= base_url() ?>/assets/img/boy-work.svg" alt="">
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#pilihJenisSurat').selectize({
            searchField: 'text'
        });
    });

    $(function() {
        $('#submitDokumentasi').on('click', function(e) {
            $('#formDokumentasiSuratLainnya').submit();
        });
    });

    function validate() {
        var submit = document.getElementById('submitButton');
        var nomor_surat = document.getElementById("inputNoSurat").value == "" ? false : true;
        var pihak_1 = document.getElementById("inputPihakPertama").value == "" ? false : true;
        var pihak_2 = document.getElementById("inputPihakKedua").value == "" ? false : true;
        var tentang = document.getElementById("inputTentang").value == "" ? false : true;
        var file = document.getElementById("dokumenSurat").value == "" ? false : true;
        var jenis_surat = document.getElementById("pilihJenisSurat").value == "" ? false : true;

        var filled = (nomor_surat && pihak_1 && pihak_2 && tentang && file && jenis_surat);
        filled ? submit.disabled = false : submit.disabled = true;
    }

    // setTimeout("CallButton()", 2000);

    // function CallButton() {
    //     document.getElementById("closeAlert").click();
    // }
</script>
<?= $this->endSection() ?>