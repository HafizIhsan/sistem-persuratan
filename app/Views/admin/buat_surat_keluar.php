<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Masukkan Informasi Surat Keluar</h1>
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
                    <form id="formBuatSuratKeluar" method="post" onchange="validate();" enctype="multipart/form-data">
                        <div class="form-row">
                            <input type="text" value="<?= $max_no_urut['NO_URUT'] + 1 ?>" id="no_urut" name="no_urut" hidden>
                            <div class="form-group col-md-3">
                                <label for="date">Tanggal Surat</label>
                                <div class="input-group date">
                                    <input id="tanggalSurat" type="date" value="<?= date('Y-m-d') ?>" class="form-control" name="tanggal_surat" required>
                                </div>
                                <small id="klasifikasiHelpBlock" class="form-text text-muted">
                                    Format : mm/dd/yyyy
                                </small>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="pilihKlasifikasi">Klasifikasi Surat</label>
                                <select id="klasifikasiSurat" class="form-control" placeholder="Pilih klasifikasi surat..." name="klasifikasi_surat" required>
                                    <option value="" selected>Pilih klasifikasi surat...</option>
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
                                <label for="inputPenerima">Penerima</label>
                                <input type="text" class="form-control" id="inputPenerima" placeholder="" name="penerima" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPenandatangan">TTD</label>
                                <input type="text" class="form-control" id="inputTTD" name="ttd" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPerihal">Perihal</label>
                            <textarea class="form-control" id="inputPerihal" name="perihal" rows="2" required></textarea>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="inputNomorSurat">Nomor Surat</label>
                            <div class="input-group">
                                <button type="button" class="btn btn-primary btn-clipboard mr-1 shadow btn-sm" id="generate">Generate</button>
                                <input type="text" class="form-control" id="inputNomorSurat" placeholder="" name="nomor_surat_keluar" required readonly>
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
                                        <input type="file" class="custom-file-input" id="draftSuratKeluar" name="file">
                                        <label class="custom-file-label" for="draftSuratKeluar" required>Pilih file</label>
                                    </div>
                                </div>
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
        <div class="col-12 col-lg-4 d-flex align-items-center">
            <img src="<?= base_url() ?>/assets/img/writing.svg" alt="">
        </div>
    </div>
    <!-- Content Row -->
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // $(document).ready(function() {
    //     let now = new Date();
    //     let today = '';
    //     if (now.getDate() <= 9) {
    //         if ((now.getMonth() + 1) <= 9) {
    //             today = '0' + now.getDate() + '/' + '0' + (now.getMonth() + 1) + '/' + now.getFullYear();
    //         } else {
    //             today = '0' + now.getDate() + '/' + (now.getMonth() + 1) + '/' + now.getFullYear();
    //         }
    //     } else {
    //         if ((now.getMonth() + 1) <= 9) {
    //             today = now.getDate() + '/' + '0' + (now.getMonth() + 1) + '/' + now.getFullYear();
    //         } else {
    //             today = now.getDate() + '/' + (now.getMonth() + 1) + '/' + now.getFullYear();
    //         }
    //     }
    //     $('#inputDate').val(today);
    // });

    $(document).ready(function() {
        $('#klasifikasiSurat').selectize({
            sortField: 'text'
        });
    });

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
        let no_urut = parseInt(document.getElementById('no_urut').value);
        let bulan = tanggal.getMonth() + 1;
        let tahun = tanggal.getFullYear();
        let no = '';

        if (no_urut < 10) {
            no = "00" + no_urut;
        } else if (no_urut > 9 && no_urut < 100) {
            no = "0" + no_urut;
        } else if (no_urut > 99) {
            no = no_urut;
        };

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

    tanggalSurat.max = new Date().toLocaleDateString('en-ca');

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
</script>
<?= $this->endSection() ?>