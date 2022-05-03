<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dokumentasi Surat Masuk</h1>
    </div>
    <!-- Content Row -->
    <div class="col-xl-9">

        <form id="formDokumentasiSuratMasuk" method="POST">
            <div class="form-group row">
                <label for="inputNoSurat" class="col-sm-2 col-form-label">Nomor Surat</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputNoSurat" placeholder="">
                </div>
                <div class="mt-1 col-sm-1">
                    <a href="#" data-toggle="popover" data-trigger="focus" data-placement="right" data-content="Masukkan nomor surat yang tertera dalam surat">
                        <i class="fas fa-info-circle"></i>
                    </a>
                </div>
            </div>


            <div class="form-group row">
                <label for="inputInstansiPengirim" class="col-sm-2 col-form-label">Instansi Pengirim</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputInstansiPengirim" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPerihal" class="col-sm-2 col-form-label">Perihal</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPerihal" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">Dokumen Surat</div>
                <div class="col-sm-10">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="dokumenSurat">
                        <label class="custom-file-label" for="dokumenSurat" accept="application/pdf">Pilih file</label>
                    </div>
                </div>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Penugasan</legend>
                    <div class="col-sm-10">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="penugasan1" name="customRadio" class="custom-control-input" onclick="change_active(this,'formPenugasan')">
                            <label class="custom-control-label" for="penugasan1">Ada penugasan</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="penugasan2" name="customRadio" class="custom-control-input" onclick="change_deactive(this,'formPenugasan')">
                            <label class="custom-control-label" for="penugasan2">Belum ditugaskan</label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div id="formPenugasan" hidden>
                <div class="form-group row">
                    <label for="pilihPetugas" class="col-sm-2 col-form-label">Petugas</label>
                    <div class="col-sm-5">
                        <select id="pilihPetugas" class="form-control" placeholder="Pilih petugas">
                            <option selected>Pilih petugas</option>
                            <option>Petugas 1</option>
                            <option>Petugas 2</option>
                            <option>Petugas 3</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="uraianPenugasan" class="col-sm-2 col-form-label">Uraian Tugas</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="uraianPenugasan" rows="3"></textarea>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="date" class="col-sm-2 col-form-label">Tenggat Penyelesaian</label>
                    <div class="col-sm-3">
                        <div class="input-group date" id="datepicker">
                            <input type="text" class="form-control">
                            <span class="input-group-append">
                                <span class="input-group-text bg-grey">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group time">
                            <input type="text" id="timepkr" class="form-control" onclick="showpickers('timepkr',12)" />
                            <span class="input-group-append">
                                <span class="input-group-text bg-grey">
                                    <a onclick="showpickers('timepkr',12)"><i class="fa fa-clock-o"></i></a>
                                </span>
                            </span>
                        </div>
                        <div class="timepicker"></div>
                    </div>
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
    function change_active(radio, form) {
        var penugasan = document.getElementById(form);
        if (radio.checked == true) {
            penugasan.hidden = false;
        } else {
            penugasan.hidden = true;
        }
    }

    function change_deactive(radio, form) {
        var penugasan = document.getElementById(form);
        if (radio.checked == true) {
            penugasan.hidden = true;
        } else {
            penugasan.hidden = false;
        }
    }

    $(function() {
        $('#datepicker').datepicker({
            format: 'dd/mm/yyyy'
        });
    });

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
</script>
<?= $this->endSection() ?>