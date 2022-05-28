<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Masukkan Informasi Surat Keluar</h1>
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
                    <form id="formBuatSuratKeluar" method="post" onchange="validate(); generate();" enctype="multipart/form-data">
                        <div class="form-row">
                            <div id="msg"></div>
                            <div class="form-group col-md-3">
                                <label for="date">Tanggal Surat</label>
                                <div class="input-group date">
                                    <input onkeydown="return event.key != 'Enter';" id="tanggalSurat" type="date" value="<?= date('Y-m-d') ?>" class="form-control" name="tanggal_surat" min="2019-01-01" max="<?= date('Y-m-d') ?>" required>
                                </div>
                                <small id="klasifikasiHelpBlock" class="form-text text-muted">
                                    Format : mm/dd/yyyy
                                </small>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="pilihKlasifikasi">Klasifikasi Surat</label>
                                <select onkeydown="return event.key != 'Enter';" id="klasifikasiSurat" class="form-control" placeholder="Pilih klasifikasi surat..." name="klasifikasi_surat" required>
                                    <option value="" selected>Pilih klasifikasi surat ...</option>
                                    <?php
                                    foreach ($klasifikasi_surat as $key => $klasifikasi_surat) : ?>
                                        <option value="<?php echo $klasifikasi_surat['KODE'] . '.' . $klasifikasi_surat['NOMOR_KLASIFIKASI'] ?>"><?php echo $klasifikasi_surat['KODE'] . ' ' . $klasifikasi_surat['NOMOR_KLASIFIKASI'] . ' ' . $klasifikasi_surat['KETERANGAN'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small id="klasifikasiHelpBlock" class="form-text text-muted">
                                    Lihat daftar klasifikasi selengkapnya <a href="data_klasifikasi_surat" class="text-primary" style="text-decoration-line: underline;">disini</a>
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPenerima">Ditujukan kepada</label>
                                <input onkeydown="return event.key != 'Enter';" type="text" class="form-control" id="inputPenerima" placeholder="Penerima" name="penerima" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPenandatangan">TTD</label>
                                <input onkeydown="return event.key != 'Enter';" type="text" class="form-control" id="inputTTD" name="ttd" placeholder="Penandatangan" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPerihal">Perihal</label>
                            <textarea class="form-control" id="inputPerihal" name="perihal" placeholder="Perihal" rows="2" required></textarea>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="inputNomorSurat">Nomor Surat</label>
                            <div class="input-group">
                                <button type="button" class="btn btn-primary btn-clipboard mr-1 shadow btn-sm" id="generate" disabled="true">Generate</button>
                                <input type=" text" class="form-control" id="inputNomorSurat" placeholder="" name="nomor_surat_keluar" placeholder="Nomor surat" required readonly>
                                <button type="button" class="copyClipboard btn btn-info btn-clipboard ml-1 shadow btn-sm" id="copyClipboard" data-clipboard-action="copy" data-clipboard-target="#inputNomorSurat">Copy</button>
                            </div>
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                Salin nomor surat keluar dan input dalam draft surat keluar yang sudah disiapkan
                            </small>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Draft Surat Keluar</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="draftSuratKeluar" name="file" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword">
                                        <label class="custom-file-label" for="draftSuratKeluar" required>Pilih file ...</label>
                                    </div>
                                </div>
                                <small id="fileHelpBlock" class="form-text text-muted">
                                    Tipe file doc atau docx dan ukuran maksimum 2mb
                                </small>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#submitModal" id="submitButton" disabled="true">Submit</button>
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
                                        <button id="submitBuatSuratKeluar" class="btn btn-primary" type="submit" data-dismiss="modal">Selesai</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-5 d-flex align-items-center">
            <img src="<?= base_url() ?>/assets/img/writing.svg" alt="">
        </div>
    </div>
    <!-- Content Row -->
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#klasifikasiSurat').selectize({
            sortField: 'text'
        });
    });

    function generate() {
        var generate = document.getElementById('generate');
        var tanggal_surat = document.getElementById("tanggalSurat").value == "" ? false : true;
        var klasifikasi_surat = document.getElementById("klasifikasiSurat").value == "" ? false : true;

        var filled = (tanggal_surat && klasifikasi_surat);
        filled ? submit.disabled = false : submit.disabled = true;
    }

    $(document).ready(function() {

        new ClipboardJS('.copyClipboard');

    });

    $(function() {
        $('#submitBuatSuratKeluar').on('click', function(e) {
            $('#formBuatSuratKeluar').submit();
        });
    });

    $('#generate').on('click', function(e) {
        let tanggal = new Date(document.getElementById('tanggalSurat').value);
        let klasifikasi_surat = document.getElementById('klasifikasiSurat').value;
        let no_urut = document.getElementById('no_urut').value;
        let sub_no_urut = document.getElementById('sub_no_urut').value;
        let bulan = tanggal.getMonth() + 1;
        let tahun = tanggal.getFullYear();
        let no = '';

        if (sub_no_urut != "") {
            if (no_urut < 10) {
                no = "00" + no_urut + "." + sub_no_urut;
            } else if (no_urut > 9 && no_urut < 100) {
                no = "0" + no_urut + "." + sub_no_urut;
            } else if (no_urut > 99) {
                no = no_urut + "." + sub_no_urut;
            }
        } else {
            if (no_urut < 10) {
                no = "00" + no_urut;
            } else if (no_urut > 9 && no_urut < 100) {
                no = "0" + no_urut;
            } else if (no_urut > 99) {
                no = no_urut;
            };
        }


        let val = '';

        if (bulan < 10) {
            val = 'B-' + no + '/02410/' + klasifikasi_surat + '/0' + bulan + '/' + tahun;
        } else {
            val = 'B-' + no + '/02410/' + klasifikasi_surat + '/' + bulan + '/' + tahun;
        }

        if (!klasifikasi_surat == '') {
            document.getElementById('inputNomorSurat').setAttribute('value', val);
            document.getElementById('generate').disabled = true;
        }
    });

    $('#klasifikasiSurat').on('change', function(e) {
        document.getElementById('inputNomorSurat').setAttribute('value', '');
        document.getElementById('generate').disabled = false;
    });

    $('#tanggalSurat').on('change', function(e) {
        document.getElementById('inputNomorSurat').setAttribute('value', '');
        document.getElementById('generate').disabled = false;
    });


    $(document).ready(function() {
        $.ajax({
            type: 'post',
            url: "<?= site_url('check-tanggal-surat-availability') ?>",
            data: JSON.stringify({
                tanggal_surat: $('#tanggalSurat').val()
            }),
            contentType: 'application/json; charset=utf-8',
            dataType: 'html',
            cache: false,
            success: function(msg) {
                $('#msg').show();
                $("#msg").html(msg);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#msg').show();
                $("#msg").html(textStatus + " " + errorThrown);
            }
        });

        $("#tanggalSurat").on("input", function(e) {
            $('#msg').hide();
            if ($('#tanggalSurat').val() == null || $('#tanggalSurat').val() == "") {
                // $('#msg').show();
                // $("#msg").html("Tanggal surat harus diisi.").css("color", "red");
            } else {
                $.ajax({
                    type: 'post',
                    url: "<?= site_url('check-tanggal-surat-availability') ?>",
                    data: JSON.stringify({
                        tanggal_surat: $('#tanggalSurat').val()
                    }),
                    contentType: 'application/json; charset=utf-8',
                    dataType: 'html',
                    cache: false,
                    success: function(msg) {
                        $('#msg').show();
                        $("#msg").html(msg);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#msg').show();
                        $("#msg").html(textStatus + " " + errorThrown);
                    }
                });
            }
        });
    });

    var dateControler = {
        currentDate: null
    }

    $(document).on("change", "#tanggalSurat", function(event, ui) {
        var now = new Date();
        var selectedDate = new Date($(this).val());

        if (selectedDate > now) {
            $(this).val(dateControler.currentDate)
        } else {
            dateControler.currentDate = $(this).val();
        }
    });

    function validate() {
        var submit = document.getElementById('submitButton');
        var nomor_surat = document.getElementById("inputNomorSurat").value == "" ? false : true;
        var tanggal_surat = document.getElementById("tanggalSurat").value == "" ? false : true;
        var klasifikasi_surat = document.getElementById("klasifikasiSurat").value == "" ? false : true;
        var penerima = document.getElementById("inputPenerima").value == "" ? false : true;
        var file = document.getElementById("draftSuratKeluar").value == "" ? false : true;
        var perihal = document.getElementById("inputPerihal").value == "" ? false : true;
        var ttd = document.getElementById("inputTTD").value == "" ? false : true;

        var filled = (nomor_surat && tanggal_surat && klasifikasi_surat && penerima && file && ttd && perihal);
        filled ? submit.disabled = false : submit.disabled = true;
    }

    setTimeout("CallButton()", 2000);

    function CallButton() {
        document.getElementById("closeAlert").click();
    }
</script>
<?= $this->endSection() ?>