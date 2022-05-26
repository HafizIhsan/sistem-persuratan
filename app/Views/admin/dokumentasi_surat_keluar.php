<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dokumentasi Surat Keluar</h1>
    </div>
    <!-- Content Row -->
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-lg-6 mb-3">
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
                    <form id="formDokumentasiSuratKeluar" action="<?= base_url('dokumentasi_surat_keluar/update_dokumentasi') ?>" method="post" enctype="multipart/form-data" onkeydown="return event.key != 'Enter';" onchange="validate();">
                        <div class="form-group">
                            <label for="inputNoSurat" class="col-form-label">Nomor Surat :</label>
                            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat_keluar" placeholder="Nomor surat">
                            <div id="msg"></div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pilihStatusSurat" class="col-form-label">Status Surat :</label>
                                <select id="pilihStatusSurat" class="form-control" name="status" placeholder="Pilih petugas">
                                    <option value="">Pilih status...</option>
                                    <option value="Belum terkirim">Belum Terkirim</option>
                                    <option value="Sudah terkirim">Sudah Terkirim</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Dokumentasi Surat:</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="dokumenSurat" name="file" accept="application/pdf">
                                    <label class="custom-file-label" for="dokumenSurat">Pilih file</label>
                                    <small id="fileHelpBlock" class="form-text text-muted">
                                        Tipe file pdf dan ukuran maksimum 2mb
                                    </small>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button id="submitButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#submitModal" disabled="true">Submit</button>
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
    </div>
    <!-- Content Row -->
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    function validate() {
        var pesan = document.getElementById('klasifikasiHelpBlock').textContent;
        var submit = document.getElementById('submitButton');
        var nomor_surat = document.getElementById("nomor_surat").value == "" ? false : true;
        var file = document.getElementById("dokumenSurat").value == "" ? false : true;
        var status_surat = document.getElementById("pilihStatusSurat").value == "" ? false : true;

        var filled = (nomor_surat && file && status_surat);
        if (pesan != 'Nomor surat tidak ditemukan') {
            filled ? submit.disabled = false : submit.disabled = true;
        } else {
            submit.disabled = true;
        }
    }

    $(function() {
        $('#submitDokumentasi').on('click', function(e) {
            $('#formDokumentasiSuratKeluar').submit();
        });
    });

    $(document).ready(function() {
        $('#pilihStatusSurat').selectize({
            searchField: 'text'
        });

        $("#nomor_surat").on("input", function(e) {
            $('#msg').hide();
            if ($('#nomor_surat').val() != null || $('#nomor_surat').val() != "") {
                $.ajax({
                    type: 'post',
                    url: "<?= site_url('check-nomor-surat-availability') ?>",
                    data: JSON.stringify({
                        nomor_surat: $('#nomor_surat').val()
                    }),
                    contentType: 'application/json; charset=utf-8',
                    dataType: 'html',
                    cache: false,
                    beforeSend: function(f) {
                        $('#msg').show();
                        $('#msg').html('Mencari...');
                    },
                    success: function(msg) {
                        $('#msg').show();
                        $("#msg").html(msg);
                        validate();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#msg').show();
                        $("#msg").html(textStatus + " " + errorThrown);
                    }
                });
            } else {
                validate();
            }
        });
    });

    setTimeout("CallButton()", 2000);

    function CallButton() {
        document.getElementById("closeAlert").click();
    }
</script>
<?= $this->endSection() ?>