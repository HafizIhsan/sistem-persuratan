<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Surat Lainnya</h1>

    <!-- DataTales Example -->
    <div class="row">
        <div class="col-12 col-lg-2">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-secondary">Filter</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="filterJenisSurat" class="col-form-label">Jenis Surat</label>
                        <select id="filterJenisSurat" class="form-control custom-select-sm">
                            <option selected>Semua</option>
                            <?php foreach ($jenis_surat_lainnya as $i) : ?>
                                <option value="<?= $i['JENIS_SURAT'] ?>"><?= $i['JENIS_SURAT'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-body">
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
                    <div class="form-inline">
                        <a href="dokumentasi_surat_lainnya" class="btn btn-success btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Tambah</span>
                        </a>
                        <form action="<?= base_url('SuratLainnyaController/surat_lainnya_excel') ?>" method="POST">
                            <button type="submit" class="btn btn-success btn-icon-split btn-sm ml-1">
                                <span class="icon text-white-50">
                                    <i class="fas fa-file-excel"></i>
                                </span>
                                <span class="text">Export</span>
                            </button>
                        </form>
                    </div>
                    <hr>
                    <div class="table-responsive table-hover">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Surat</th>
                                    <th>Pihak Pertama</th>
                                    <th>Pihak Kedua</th>
                                    <th>Tentang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($surat_lainnya as $key => $surat_lainnya) : ?>
                                    <?php for ($i = 0; $i <= count($pengguna); $i++) {
                                        if ($surat_lainnya['ID_PENGGUNA'] === $pengguna[$i]['ID_PENGGUNA']) {
                                            $nama = $pengguna[$i]['NAMA'];
                                        }
                                    }
                                    for ($i = 0; $i <= count($jenis_surat_lainnya); $i++) {
                                        if ($surat_lainnya['ID_JENIS_SURAT_LAINNYA'] === $jenis_surat_lainnya[$i]['ID_JENIS_SURAT_LAINNYA']) {
                                            $jenis_surat = $jenis_surat_lainnya[$i]['JENIS_SURAT'];
                                        }
                                    }

                                    ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td><?= $jenis_surat ?></td>
                                        <td><?= $surat_lainnya['PIHAK_1'] ?></td>
                                        <td><?= $surat_lainnya['PIHAK_2'] ?></td>
                                        <td><?= $surat_lainnya['TENTANG'] ?></td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <a href="<?= base_url('uploads/dokumentasi/' . $surat_lainnya['SCAN_SURAT']) ?>" class="btn btn-success btn-icon-split btn-sm" target="_blank">
                                                    <span class="icon">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-secondary btn-icon-split btn-sm ml-2" data-toggle="modal" data-target="#editModal-<?= $surat_lainnya['ID_SURAT_LAINNYA'] ?>">
                                                    <span class="icon">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-danger btn-icon-split btn-sm ml-2" data-toggle="modal" data-target="#hapusModal-<?= $surat_lainnya['ID_SURAT_LAINNYA'] ?>">
                                                    <span class="icon">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-primary btn-icon-split btn-sm ml-2" data-toggle="modal" data-target="#detailModal-<?= $surat_lainnya['ID_SURAT_LAINNYA'] ?>">
                                                    <span class="text">Detail</span>
                                                </a>
                                            </div>

                                            <!-- Hapus Modal -->
                                            <div class="modal fade" id="hapusModal-<?= $surat_lainnya['ID_SURAT_LAINNYA'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">Apakah anda yakin ingin menghapus data surat ini?</div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                            <a class="btn btn-primary" href="<?= base_url('data_surat_lainnya/delete/' . $surat_lainnya['ID_SURAT_LAINNYA']) ?>">Hapus</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Detail Modal -->
                                            <div class="modal fade" id="detailModal-<?= $surat_lainnya['ID_SURAT_LAINNYA'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-gradient-secondary">
                                                            <h5 class="modal-title text-white" id="exampleModalLabel">Detail Surat</h5>
                                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form>
                                                            <?= csrf_field(); ?>
                                                            <div class="modal-body">
                                                                <div class="form-row">
                                                                    <div class="form-group col-2">
                                                                        <label for="detailDokumentasi" class="col-form-label">Dokumentasi :</label>
                                                                        <a href="<?= base_url('uploads/dokumentasi/' . $surat_lainnya['SCAN_SURAT']) ?>" class="btn btn-success btn-icon-split" target="_blank">
                                                                            <span class="icon text-white-50">
                                                                                <i class="fas fa-eye"></i>
                                                                            </span>
                                                                            <span class="text">Lihat</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="form-group col-4">
                                                                        <label for="detailJenisSurat" class="col-form-label">Jenis Surat: </label>
                                                                        <input name='detailJenisSurat' type="text" class="form-control" id="detailJenisSurat" value="<?= $jenis_surat ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group col-6">
                                                                        <label for="detailNomorSurat" class="col-form-label">Nomor Surat :</label>
                                                                        <input name='detailNomorSurat' type="text" class="form-control" id="detailNomorSurat" value="<?= $surat_lainnya['NOMOR_SURAT'] ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-6">
                                                                        <label for="detailPihak1" class="col-form-label">Pihak 1 :</label>
                                                                        <input name='detailPihak1' type="text" class="form-control" id="detailPihak1" value="<?= $surat_lainnya['PIHAK_1'] ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group col-6">
                                                                        <label for="detailPihak2" class="col-form-label">Pihak 2 :</label>
                                                                        <input name='detailPihak2' type="text" class="form-control" id="detailPihak2" value="<?= $surat_lainnya['PIHAK_2'] ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="detailTentang" class="col-form-label">Tentang :</label>
                                                                    <textarea name='detailTentang' class="form-control" id="detailTentang" rows="3" style="resize: none;" readonly><?= $surat_lainnya['TENTANG'] ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal-<?= $surat_lainnya['ID_SURAT_LAINNYA'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-gradient-secondary">
                                                            <h5 class="modal-title text-white" id="exampleModalLabel">Edit Informasi Surat</h5>
                                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url('data_surat_lainnya/edit/' . $surat_lainnya['ID_SURAT_LAINNYA']) ?>" method="post">
                                                            <?= csrf_field(); ?>
                                                            <div class="modal-body">
                                                                <div class="form-row">
                                                                    <div class="form-group col-4">
                                                                        <label for="detailJenisSurat" class="col-form-label">Jenis Surat: </label>
                                                                        <input name='jenis_surat_lainnya' type="text" class="form-control" id="detailJenisSurat" value="<?= $jenis_surat ?>" required readonly>
                                                                    </div>
                                                                    <div class="form-group col-8">
                                                                        <label for="detailNomorSurat" class="col-form-label">Nomor Surat :</label>
                                                                        <input name='nomor_surat' type="text" class="form-control" id="detailNomorSurat" value="<?= $surat_lainnya['NOMOR_SURAT'] ?>" required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-6">
                                                                        <label for="detailPihak1" class="col-form-label">Pihak 1 :</label>
                                                                        <input name='pihak_1' type="text" class="form-control" id="detailPihak1" value="<?= $surat_lainnya['PIHAK_1'] ?>" required>
                                                                    </div>
                                                                    <div class="form-group col-6">
                                                                        <label for="detailPihak2" class="col-form-label">Pihak 2 :</label>
                                                                        <input name='pihak_2' type="text" class="form-control" id="detailPihak2" value="<?= $surat_lainnya['PIHAK_2'] ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="detailTentang" class="col-form-label">Tentang :</label>
                                                                    <textarea name='tentang' class="form-control" id="detailTentang" rows="3" style="resize: none;" required><?= $surat_lainnya['TENTANG'] ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
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
        var table = $('#dataTable').DataTable();
        $('#filterJenisSurat').change(function() {
            var jenis_surat = $('#filterJenisSurat').val();

            if (jenis_surat != 'Semua') {
                table.columns(1).search(jenis_surat).draw();
            } else {
                table.columns(1).search('').draw();
            }
        })
    });

    setTimeout("CallButton()", 2000);

    function CallButton() {
        document.getElementById("closeAlert").click();
    }
</script>
<?= $this->endSection() ?>