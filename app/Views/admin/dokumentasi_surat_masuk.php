<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dokumentasi Surat Masuk</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12 col-lg-7 mb-3">
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
                    <form id="formDokumentasiSuratMasuk" method="post" onchange="validate();" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="inputNoSurat" class="col-sm-2 col-form-label">Nomor Surat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputNoSurat" placeholder="Nomor surat" name="nomor_surat" required onkeydown="return event.key != 'Enter';">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPengirim" class="col-sm-2 col-form-label">Pengirim</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPengirim" name="instansi_pengirim" placeholder="Pengirim" required onkeydown="return event.key != 'Enter';">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPerihal" class="col-sm-2 col-form-label">Perihal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPerihal" placeholder="Perihal" name="perihal" required onkeydown="return event.key != 'Enter';">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2 col-form-label">Dokumentasi Surat</div>
                            <div class="col-sm-5">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="dokumenSurat" name="file" accept="application/pdf" required onkeydown="return event.key != 'Enter';">
                                    <label class="custom-file-label" for="dokumenSurat">Pilih file...</label>
                                    <small id="klasifikasiHelpBlock" class="form-text text-muted">
                                        Tipe file pdf dan ukuran maksimum 2mb
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-sm-2 col-form-label">Tanggal Terima</label>
                            <div class="col-sm-5">
                                <div class="input-group date">
                                    <input id="tanggalTerima" type="date" class="form-control" name="tanggal_terima" onkeydown="return event.key != 'Enter';">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-center">
                            <h5 class="mb-4">Penugasan (optional)</h5>
                        </div>
                        <div id="formPenugasan">
                            <div class="form-group row">
                                <label for="pilihPetugas" class="col-sm-2 col-form-label">Petugas</label>
                                <div class="col-sm-5">
                                    <select id="pilihPetugas" class="form-control" placeholder="Pilih petugas" name="petugas" onkeydown="return event.key != 'Enter';">
                                        <option value="" selected>Pilih petugas</option>
                                        <?php foreach ($admin as $key => $admin) : ?>
                                            <option value="<?= $admin['ID_PENGGUNA'] ?>"><?php echo $admin['NAMA'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="uraianPenugasan" class="col-sm-2 col-form-label">Uraian Tugas</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="uraianPenugasan" rows="3" placeholder="Uraian penugasan" name="uraian_penugasan"></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="date" class="col-sm-2 col-form-label">Tenggat Penyelesaian</label>
                                <div class="col-sm-3">
                                    <div class="input-group date">
                                        <input id="tenggatPenugasanDate" type="date" class="form-control" name="tenggat_d" onkeydown="return event.key != 'Enter';">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group time">
                                        <input id="tenggatPenugasanTime" type="time" class="form-control" name="tenggat_t" onkeydown="return event.key != 'Enter';">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button id="submitButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#submitModal" disabled='true'>Submit</button>
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
            </div>
        </div>
        <div class="col-12 col-lg-5 d-flex align-items-center">
            <img src="<?= base_url() ?>/assets/img/file-people.svg" alt="">
        </div>
    </div>
    <!-- Content Row -->
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    $(function() {
        $('#submitDokumentasi').on('click', function(e) {
            $('#formDokumentasiSuratMasuk').submit();
        });
    });

    $(function() {
        $('[data-toggle="popover"]').popover()
    })

    $('.popover-dismiss').popover({
        trigger: 'focus'
    })

    $(document).ready(function() {
        $('#pilihPetugas').selectize({
            searchField: 'text'
        });
    });

    tenggatPenugasanDate.min = new Date().toLocaleDateString('en-ca');
    tanggalTerima.max = new Date().toLocaleDateString('en-ca');

    function validate() {
        var submit = document.getElementById('submitButton');
        var nomor_surat = document.getElementById("inputNoSurat").value == "" ? false : true;
        var pengirim = document.getElementById("inputPengirim").value == "" ? false : true;
        // var uraian_penugasan = document.getElementById("uraianPenugasan").value == "" ? false : true;
        var perihal = document.getElementById("inputPerihal").value == "" ? false : true;
        var file = document.getElementById("dokumenSurat").value == "" ? false : true;
        // var petugas = document.getElementById("pilihPetugas").value == "" ? false : true;
        var date = document.getElementById("tanggalTerima").value == "" ? false : true;
        // var time = document.getElementById("tenggatPenugasanTime").value == "" ? false : true;

        var filled = (nomor_surat && pengirim && perihal && file && date);
        filled ? submit.disabled = false : submit.disabled = true;
    }

    setTimeout("CallButton()", 2000);

    function CallButton() {
        document.getElementById("closeAlert").click();
    }
</script>
<?= $this->endSection() ?>