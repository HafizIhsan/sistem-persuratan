<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Masukkan Informasi Surat Keluar</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-12 col-lg-8">
            <form id="formBuatSuratKeluar">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="date">Tanggal Surat</label>
                        <div class="input-group date">
                            <input type="date" value="<?= date('Y-m-d') ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="pilihKlasifikasi">Klasifikasi Surat</label>
                        <select id="klasifikasiSurat" class="form-control" placeholder="Pilih klasifikasi surat..." required>
                            <option value="" selected>Pilih klasifikasi surat...</option>
                            <?php
                            foreach ($klasifikasi_surat as $key => $klasifikasi_surat) : ?>
                                <option value="<?php echo $klasifikasi_surat['KODE'] . $klasifikasi_surat['NOMOR_KLASIFIKASI'] ?>"><?php echo $klasifikasi_surat['KODE'] . ' ' . $klasifikasi_surat['NOMOR_KLASIFIKASI'] . ' ' . $klasifikasi_surat['KETERANGAN'] ?></option>
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
                        <input type="text" class="form-control" id="inputPenerima" placeholder="" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPenandatangan">Penandatangan</label>
                        <input type="text" class="form-control" id="inputPenandatangan" placeholder="" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPerihal">Perihal</label>
                    <textarea class="form-control" id="inputPerihal" rows="2" required></textarea>
                </div>
                <hr>
                <div class="form-group">
                    <label for="inputNomorSurat">Nomor Surat</label>
                    <div class="input-group">
                        <button type="button" class="btn btn-primary btn-clipboard mr-1 shadow btn-sm" id="generate">Generate</button>
                        <input type="text" class="form-control" id="inputNomorSurat" placeholder="" required readonly>
                        <button type="button" class="copyClipboard btn btn-info btn-clipboard ml-1 shadow btn-sm" id="copyClipboard" data-clipboard-action="copy" data-clipboard-target="#inputNomorSurat">Copy</button>
                    </div>
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        Salin nomor surat keluar dan input dalam draft surat keluar yang sudah disiapkan
                    </small>
                </div>
                <div class="form-group">
                    <label>Draft Surat Keluar</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="draftSuratKeluar">
                            <label class="custom-file-label" for="draftSuratKeluar" required>Pilih file</label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#submitModal">Submit</button>
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
</script>
<?= $this->endSection() ?>