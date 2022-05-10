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
                    <?php $optionStat = array('Belum ditugaskan', 'Dalam proses', 'Selesai'); ?>
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
                    <a href="dokumentasi_surat_masuk" class="btn btn-success btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah</span>
                    </a>
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
                                        if ($surat_masuk['ID_PENGGUNA'] === $pengguna[$i]['ID_PENGGUNA']) {
                                            $nama = $pengguna[$i]['NAMA'];
                                        }
                                    } ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td><?= date('d-m-Y', strtotime($surat_masuk['TANGGAL_TERIMA'])) ?></td>
                                        <td><?= $surat_masuk['INSTANSI_PENGIRIM'] ?></td>
                                        <td><?= $surat_masuk['PERIHAL'] ?></td>
                                        <td><?= $surat_masuk['STATUS'] ?></td>
                                        <td><?= $nama  ?></td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <a href="<?= base_url('uploads/' . $surat_masuk['SCAN_SURAT_MASUK']) ?>" class="btn btn-success btn-icon-split btn-sm" target="_blank">
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

                                            <!-- View Modal
                                            <div id="viewModal-<?= $surat_masuk['ID_SURAT_MASUK'] ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <iframe src="<?= base_url('uploads/' . $surat_masuk['SCAN_SURAT_MASUK']) ?>" frameBorder="0" scrolling="auto" height="600px" width="100%"></iframe>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->

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
                                                                        <a href="<?= base_url('uploads/' . $surat_masuk['SCAN_SURAT_MASUK']) ?>" class="btn btn-success btn-icon-split" target="_blank">
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
                                                                        <input name='detailPengirim' type="text" class="form-control" id="detailPengirim" value="<?= $surat_masuk['INSTANSI_PENGIRIM'] ?>" required>
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
                                                                            <input name='detailTenggatPenugasan' type="text" class="form-control" id="detailTenggatPenugasan" value="<?= date('d-m-Y H:i', strtotime($surat_masuk['TENGGAT_PENUGASAN'])) ?>" readonly>
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
                                                                    <div class="form-group col-9">
                                                                        <label for="detailPengirim" class="col-form-label">Pengirim :</label>
                                                                        <input name="pengirim" type="text" class="form-control" id="detailPengirim" value="<?= $surat_masuk['INSTANSI_PENGIRIM'] ?>" required>
                                                                    </div>
                                                                    <div class="form-group col-3">
                                                                        <label for="detailStatus" class="col-form-label">Status Surat :</label>
                                                                        <select name="status" id="pilihStatus" class="form-control">
                                                                            <option value="<?= $surat_masuk['STATUS'] ?>"><?= $surat_masuk['STATUS'] ?> </option>
                                                                            <?php
                                                                            if (($key = array_search($surat_masuk['STATUS'], $optionStat)) !== false) {
                                                                                unset($optionStat[$key]);
                                                                            }
                                                                            for ($x = 0; $x <= count($optionStat); $x++) {
                                                                                if ($optionStat[$x] != NULL) {
                                                                                    echo "<option value='$optionStat[$x]'>$optionStat[$x]</option>";
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
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
                                        </td>
                                    </tr>
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
</script>
<?= $this->endSection() ?>