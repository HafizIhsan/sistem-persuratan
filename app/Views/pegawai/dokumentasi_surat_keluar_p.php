<?= $this->extend('layouts/pegawai') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dokumentasi Surat Keluar</h1>
    </div>
    <!-- Content Row -->
    <div class="col-xl-9">
        <form id="formDokumentasiSuratKeluar" method="POST">
            <div class="form-group row">
                <label for="inputNoSurat" class="col-sm-2 col-form-label">Nomor Surat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputNoSurat" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="pilihStatusSurat" class="col-sm-2 col-form-label">Status Surat</label>
                <div class="col-sm-10">
                    <select id="pilihStatusSurat" class="form-control" placeholder="Pilih petugas">
                        <option>Belum Terkirim</option>
                        <option>Sudah Terkirim</option>
                    </select>
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
            <div class="form-group row">
                <div class="col-sm-2">Lampiran</div>
                <div class="col-sm-10">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="lampiran">
                        <label class="custom-file-label" for="lampiran" accept="application/pdf">Pilih file</label>
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
    $(function() {
        $('#submitDokumentasi').on('click', function(e) {
            $('#formDokumentasiSuratKeluar').submit();
        });
    });
</script>
<?= $this->endSection() ?>