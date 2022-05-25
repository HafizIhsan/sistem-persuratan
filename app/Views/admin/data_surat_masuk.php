<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Surat Masuk</h1>

    <!-- DataTales Example -->
    <div class="row">
        <div class="col-12 col-lg-2">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-secondary">Filter</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="filterTahun" class="col-form-label">Tahun</label>
                        <select id="filterTahun" class="form-control custom-select-sm">
                            <option selected>Semua</option>
                            <?php
                            foreach ($surat_masuk as $i) {
                                $year[] = date('Y', strtotime($i['CREATED_AT']));
                            };
                            if (isset($year)) {
                                $year_filter = array_unique($year);
                                for ($i = 0; $i < count($year_filter); $i++) {
                            ?>
                                    <option value="<?= $year_filter[$i] ?>"><?= $year_filter[$i] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="filterStatus" class="col-form-label">Status Penugasan</label>
                        <select id="filterStatus" class="form-control custom-select-sm">
                            <option selected>Semua</option>
                            <option>Belum ditugaskan</option>
                            <option>Dalam proses</option>
                            <option>Selesai</option>
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
                        <a href="dokumentasi_surat_masuk" class="btn btn-success btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Tambah</span>
                        </a>
                        <form action="<?= base_url('SuratMasukController/surat_masuk_excel') ?>" method="POST">
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
                                    <th>Tanggal Terima</th>
                                    <th>Pengirim</th>
                                    <th>Keterangan</th>
                                    <th>Status Penugasan</th>
                                    <th>Petugas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($surat_masuk as $key => $surat_masuk) : ?>
                                    <?php for ($i = 0; $i <= count($pengguna); $i++) {
                                        if ($surat_masuk['PETUGAS'] === $pengguna[$i]['ID_PENGGUNA']) {
                                            $nama = $pengguna[$i]['NAMA'];
                                        }
                                    } ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td><?= date('d-m-Y', strtotime($surat_masuk['TANGGAL_TERIMA'])) ?></td>
                                        <td><?= $surat_masuk['INSTANSI_PENGIRIM'] ?></td>
                                        <td><?= $surat_masuk['PERIHAL'] ?></td>
                                        <td class="d-flex justify-content-center">
                                            <?php
                                            if ($surat_masuk['STATUS'] == 'Selesai') {
                                                echo "<span class='badge badge-pill badge-success'>" . $surat_masuk['STATUS'] . "</span>";
                                            } else if ($surat_masuk['STATUS'] == 'Dalam proses') {
                                                echo "<span class=' badge badge-pill badge-warning'>" . $surat_masuk['STATUS'] . "</span>";
                                            } else if ($surat_masuk['STATUS'] == 'Belum ditugaskan') {
                                                echo "<span class='badge badge-pill badge-danger'>" . $surat_masuk['STATUS'] . "</span>";
                                            } ?>
                                        </td>
                                        <td>
                                            <?php if ($surat_masuk['STATUS'] != 'Belum ditugaskan') { ?>
                                                <?= $nama  ?>
                                            <?php } else { ?>
                                                <a href="#" class="btn btn-primary btn-icon-split btn-sm ml-2" data-toggle="modal" data-target="#penugasanModal-<?= $surat_masuk['ID_SURAT_MASUK'] ?>">
                                                    <span class="text">Tambah Penugasan</span>
                                                </a>
                                                <!-- Penugasan Modal -->
                                                <div class="modal fade" id="penugasanModal-<?= $surat_masuk['ID_SURAT_MASUK'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-gradient-secondary">
                                                                <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Penugasan Surat Masuk</h5>
                                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="<?= base_url('data_surat_masuk/tambah_penugasan/' . $surat_masuk['ID_SURAT_MASUK']) ?>" method="post">
                                                                <?= csrf_field(); ?>
                                                                <div class="modal-body">
                                                                    <div class="form-group row">
                                                                        <label for="pilihPetugas" class="col-sm-2 col-form-label">Petugas</label>
                                                                        <div class="col-sm-5">
                                                                            <select id="pilihPetugas" class="form-control" placeholder="Pilih petugas" name="petugas" onkeydown="return event.key != 'Enter';" required>
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
                                                                            <textarea class="form-control" id="uraianPenugasan" rows="3" placeholder="Uraian penugasan" name="uraian_penugasan" required></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <label for="date" class="col-sm-2 col-form-label">Tenggat Penyelesaian</label>
                                                                        <div class="col-sm-3">
                                                                            <div class="input-group date">
                                                                                <input id="tenggatPenugasanDate" type="date" class="form-control" name="tenggat_d" onkeydown="return event.key != 'Enter';" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <div class="input-group time">
                                                                                <input id="tenggatPenugasanTime" type="time" class="form-control" name="tenggat_t" onkeydown="return event.key != 'Enter';" required>
                                                                            </div>
                                                                        </div>
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
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <a href="<?= base_url('uploads/dokumentasi/' . $surat_masuk['SCAN_SURAT_MASUK']) ?>" class="btn btn-success btn-icon-split btn-sm" target="_blank">
                                                    <span class="icon">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                </a>
                                                <!-- <a href="#" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#viewModal-<?= $surat_masuk['ID_SURAT_MASUK'] ?>">
                                                    <span class="icon">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                </a> -->
                                                <a href="#" class="btn btn-secondary btn-icon-split btn-sm ml-2" data-toggle="modal" data-target="#editModal-<?= $surat_masuk['ID_SURAT_MASUK'] ?>">
                                                    <span class="icon">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-danger btn-icon-split btn-sm ml-2" data-toggle="modal" data-target="#hapusModal-<?= $surat_masuk['ID_SURAT_MASUK'] ?>">
                                                    <span class="icon">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-primary btn-icon-split btn-sm ml-2" data-toggle="modal" data-target="#detailModal-<?= $surat_masuk['ID_SURAT_MASUK'] ?>">
                                                    <span class="text">Detail</span>
                                                </a>
                                            </div>

                                            <p hidden><?= $surat_masuk['NOMOR_SURAT_MASUK'] ?></p>
                                        </td>
                                    </tr>

                                    <!-- Hapus Modal -->
                                    <div class="modal fade" id="hapusModal-<?= $surat_masuk['ID_SURAT_MASUK'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Apakah anda yakin ingin menghapus data surat dari : <?= $surat_masuk['INSTANSI_PENGIRIM'] ?> ?</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                    <a class="btn btn-primary" href="<?= base_url('data_surat_masuk/delete/' . $surat_masuk['ID_SURAT_MASUK']) ?>">Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Detail Modal -->
                                    <div class="modal fade" id="detailModal-<?= $surat_masuk['ID_SURAT_MASUK'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <label for="detailStatus" class="col-form-label">Dokumentasi :</label>
                                                                <a href="<?= base_url('uploads/dokumentasi/' . $surat_masuk['SCAN_SURAT_MASUK']) ?>" class="btn btn-success btn-icon-split" target="_blank">
                                                                    <span class="icon text-white-50">
                                                                        <i class="fas fa-eye"></i>
                                                                    </span>
                                                                    <span class="text">Lihat</span>
                                                                </a>
                                                            </div>
                                                            <div class="form-group col-3">
                                                                <label for="detailTanggalTerima" class="col-form-label">Tanggal Terima :</label>
                                                                <input name='detailTanggalTerima' type="text" class="form-control" id="detailTanggalTerima" value="<?= date('d-m-Y', strtotime($surat_masuk['TANGGAL_TERIMA'])) ?>" readonly>
                                                            </div>
                                                            <div class="form-group col-7">
                                                                <label for="detailNomorSurat" class="col-form-label">Nomor Surat :</label>
                                                                <input name='detailNomorSurat' type="text" class="form-control" id="detailNomorSurat" value="<?= $surat_masuk['NOMOR_SURAT_MASUK'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-9">
                                                                <label for="detailPengirim" class="col-form-label">Pengirim :</label>
                                                                <input name='detailPengirim' type="text" class="form-control" id="detailPengirim" value="<?= $surat_masuk['INSTANSI_PENGIRIM'] ?>" readonly>
                                                            </div>
                                                            <div class="form-group col-3">
                                                                <label for="detailStatus" class="col-form-label">Status Surat :</label>
                                                                <?php if ($surat_masuk['STATUS'] == 'Selesai') {
                                                                    echo "<div class='bg-success btn-icon-split form-control'>";
                                                                } else if ($surat_masuk['STATUS'] == 'Dalam proses') {
                                                                    echo "<div class='bg-warning btn-icon-split form-control'>";
                                                                } else if ($surat_masuk['STATUS'] == 'Belum ditugaskan') {
                                                                    echo "<div class='bg-danger btn-icon-split form-control'>";
                                                                } ?>
                                                                <span class="text text-white"><?= $surat_masuk['STATUS'] ?></span>
                                                                <?php echo "</div>" ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="detailPerihal" class="col-form-label">Perihal :</label>
                                                            <textarea name='detailPerihal' class="form-control" id="detailPerihal" rows="3" style="resize: none;" readonly><?= $surat_masuk['PERIHAL'] ?></textarea>
                                                        </div>
                                                        <?php if (isset($nama)) { ?>
                                                            <hr>
                                                            <div class="form-row">
                                                                <div class="form-group col-8">
                                                                    <label for="detailPetugas" class="col-form-label">Penugasan kepada :</label>
                                                                    <input name='detailPetugas' type="text" class="form-control" id="detailPetugas" value="<?php echo $nama ?>" readonly>
                                                                </div>
                                                                <div class="form-group col-4">
                                                                    <label for="detailTenggatPenugasan" class="col-form-label">Tenggat Penugasan :</label>
                                                                    <input name='detailTenggatPenugasan' type="text" class="form-control" id="detailTenggatPenugasan" value="<?= date('d-m-Y H:i', strtotime($surat_masuk['TENGGAT_PENUGASAN'])) ?> WIB" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="detailUraianPenugasan" class="col-form-label">Uraian Penugasan :</label>
                                                                <textarea name='detailUraianPenugasan' class="form-control" id="detailUraianPenugasan" rows="3" style="resize: none;" readonly><?= $surat_masuk['URAIAN_PENUGASAN'] ?></textarea>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal-<?= $surat_masuk['ID_SURAT_MASUK'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-gradient-secondary">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Informasi Surat Masuk</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url('data_surat_masuk/edit/' . $surat_masuk['ID_SURAT_MASUK']) ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <div class="modal-body">
                                                        <div class="form-row">
                                                            <div class="form-group col-3">
                                                                <label for="detailTanggalTerima" class="col-form-label">Tanggal Terima :</label>
                                                                <input name='tanggal_terima' type="date" class="form-control" id="detailTanggalTerima" value="<?= date('Y-m-d', strtotime($surat_masuk['TANGGAL_TERIMA'])) ?>" required>
                                                                <small id="nomorKlasifikasiHelpBlock" class="form-text text-muted">
                                                                    Format : mm/dd/yyyy
                                                                </small>
                                                            </div>
                                                            <div class="form-group col-9">
                                                                <label for="detailNomorSurat" class="col-form-label">Nomor Surat :</label>
                                                                <input name='nomor_surat' type="text" class="form-control" id="detailNomorSurat" value="<?= $surat_masuk['NOMOR_SURAT_MASUK'] ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-12">
                                                                <label for="detailPengirim" class="col-form-label">Pengirim :</label>
                                                                <input name="pengirim" type="text" class="form-control" id="detailPengirim" value="<?= $surat_masuk['INSTANSI_PENGIRIM'] ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="detailPerihal" class="col-form-label">Perihal :</label>
                                                            <textarea name='perihal' class="form-control" id="detailPerihal" rows="3" style="resize: none;" required><?= $surat_masuk['PERIHAL'] ?></textarea>
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
                                <?php endforeach;
                                ?>
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
        $('#filterTahun').change(function() {
            var tahun = $('#filterTahun').val();

            if (tahun != 'Semua') {
                table.columns(1).search(tahun).draw();
            } else {
                table.columns(1).search('').draw();
            }
        })

        $('#filterStatus').change(function() {
            var status = $('#filterStatus').val();

            if (status != 'Semua') {
                table.columns(4).search(status).draw();
            } else {
                table.columns(4).search('').draw();
            }
        })
    });

    setTimeout("CallButton()", 2000);

    function CallButton() {
        document.getElementById("closeAlert").click();
    }

    $(document).ready(function() {
        $('#dataTable').DataTable({
            bDestroy: true,
            scrollY: '47vh',
            scrollCollapse: true
        });
    });

    $(document).ready(function() {
        $('#pilihPetugas').selectize({
            searchField: 'text'
        });
    });

    tenggatPenugasanDate.min = new Date().toLocaleDateString('en-ca');
</script>
<?= $this->endSection() ?>