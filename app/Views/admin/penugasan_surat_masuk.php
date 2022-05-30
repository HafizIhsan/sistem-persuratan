<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Penugasan Surat Masuk</h1>

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
                    <?php if (count($surat_masuk) != 0) { ?>
                        <div class="table-responsive table-hover">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pengirim</th>
                                        <th>Keterangan</th>
                                        <th>Uraian Penugasan</th>
                                        <th>Tenggat Penugasan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $nama = session()->get('nama');
                                    foreach ($surat_masuk as $key => $surat_masuk) : ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
                                            <td><?= $surat_masuk['INSTANSI_PENGIRIM'] ?></td>
                                            <td><?= $surat_masuk['PERIHAL'] ?></td>
                                            <td><?= $surat_masuk['URAIAN_PENUGASAN'] ?></td>
                                            <td><?= date('d-m-y H:i', strtotime($surat_masuk['TENGGAT_PENUGASAN'])) . " WIB" ?></td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <a href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#updateModal-<?= $surat_masuk['ID_SURAT_MASUK'] ?>">
                                                        <span class="text">Selesai</span>
                                                    </a>
                                                    <a href="<?= base_url('uploads/dokumentasi/' . $surat_masuk['SCAN_SURAT_MASUK']) ?>" class="btn btn-success btn-icon-split btn-sm ml-2" target="_blank">
                                                        <span class="icon">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </a>
                                                    <a href="#" class="btn btn-info btn-icon-split btn-sm ml-2" data-toggle="modal" data-target="#detailModal-<?= $surat_masuk['ID_SURAT_MASUK'] ?>">
                                                        <span class="text">Detail</span>
                                                    </a>
                                                </div>

                                                <p hidden><?= $surat_masuk['NOMOR_SURAT_MASUK'] ?></p>
                                            </td>
                                        </tr>

                                        <!-- Status Modal -->
                                        <div class="modal fade" id="updateModal-<?= $surat_masuk['ID_SURAT_MASUK'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Apakah anda yakin penugasan untuk surat masuk dari : <?= $surat_masuk['INSTANSI_PENGIRIM'] ?> sudah selesai ?</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                        <a class="btn btn-primary" href="<?= base_url('penugasan_surat_masuk/update_status/' . $surat_masuk['ID_SURAT_MASUK']) ?>">Selesai</a>
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
                                    <?php endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div class="d-flex justify-content-center">
                            <h4>Tidak ada penugasan surat masuk</h4>
                        </div>
                    <?php } ?>
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
            scrollX: true,
            scrollCollapse: true,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
            }
        });
    });
</script>
<?= $this->endSection() ?>