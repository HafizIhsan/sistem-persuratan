<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Surat Keluar</h1>

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
                            foreach ($surat_keluar as $i) {
                                $year[] = date('Y', strtotime($i['TANGGAL_SURAT']));
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
                        <label for="filterStatus" class="col-form-label">Status</label>
                        <select id="filterStatus" class="form-control custom-select-sm">
                            <option selected>Semua</option>
                            <option>Pengajuan</option>
                            <option>Belum terkirim</option>
                            <option>Sudah terkirim</option>
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
                        <!-- <a href="dokumentasi_surat_keluar" class="btn btn-success btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Tambah</span>
                        </a> -->
                        <button type="button" class="btn btn-success btn-icon-split btn-sm ml-1" data-toggle="modal" data-target="#exportModal">
                            <span class="icon text-white-50">
                                <i class="fas fa-file-excel"></i>
                            </span>
                            <span class="text">Export</span>
                        </button>

                        <!-- Export Modal -->
                        <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-gradient-secondary">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">Export Data Surat Keluar</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="<?= base_url('SuratKeluarController/surat_keluar_excel') ?>" method="POST">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="pilihTahun" class="col-form-label mr-3">Pilih Tahun</label>
                                                <select id="pilihTahun" class="form-control custom-select-sm" name="tahun">
                                                    <option selected>Semua</option>
                                                    <?php
                                                    foreach ($surat_keluar as $i) {
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
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                            <button class="btn btn-primary" type="submit">Export</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive table-hover">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Surat</th>
                                    <th>Pembuat</th>
                                    <th>Penerima</th>
                                    <th>TTD</th>
                                    <th>Perihal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($surat_keluar as $key => $surat_keluar) : ?>
                                    <?php for ($i = 0; $i < count($pengguna); $i++) {
                                        if ($surat_keluar['ID_PENGGUNA'] === $pengguna[$i]['ID_PENGGUNA']) {
                                            $nama = $pengguna[$i]['NAMA'];
                                        }
                                    } ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td><?= date('d-m-Y', strtotime($surat_keluar['CREATED_AT'])) ?></td>
                                        <td><?= $nama ?></td>
                                        <td><?= $surat_keluar['PENERIMA'] ?></td>
                                        <td><?= $surat_keluar['TTD'] ?></td>
                                        <td><?= $surat_keluar['PERIHAL'] ?></td>
                                        <td class="d-flex justify-content-center">
                                            <?php
                                            if ($surat_keluar['STATUS'] == 'Pengajuan') {
                                                echo "<span class='badge badge-pill badge-secondary'>" . $surat_keluar['STATUS'] . "</span>";
                                            } else if ($surat_keluar['STATUS'] == 'Belum terkirim') {
                                                echo "<span class=' badge badge-pill badge-warning'>" . $surat_keluar['STATUS'] . "</span>";
                                            } else if ($surat_keluar['STATUS'] == 'Sudah terkirim') {
                                                echo "<span class='badge badge-pill badge-success'>" . $surat_keluar['STATUS'] . "</span>";
                                            } else if ($surat_keluar['STATUS'] == 'Dibatalkan') {
                                                echo "<span class='badge badge-pill badge-danger'>" . $surat_keluar['STATUS'] . "</span>";
                                            } ?>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <?php if ($surat_keluar['SCAN_SURAT_KELUAR'] == NULL) { ?>
                                                    <a href="<?= base_url('uploads/dokumentasi/' . $surat_keluar['SCAN_SURAT_KELUAR']) ?>" class="btn btn-success btn-icon-split btn-sm disabled" target="_blank">
                                                        <span class="icon">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </a>
                                                <?php } else { ?>
                                                    <a href="<?= base_url('uploads/dokumentasi/' . $surat_keluar['SCAN_SURAT_KELUAR']) ?>" class="btn btn-success btn-icon-split btn-sm disable" target="_blank">
                                                        <span class="icon">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </a>
                                                <?php } ?>

                                                <a href="#" class="btn btn-secondary btn-icon-split btn-sm ml-2" data-toggle="modal" data-target="#editModal-<?= $surat_keluar['ID_SURAT_KELUAR'] ?>" id="edit-<?= $surat_keluar['ID_SURAT_KELUAR'] ?>">
                                                    <span class="icon">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-danger btn-icon-split btn-sm ml-2" data-toggle="modal" data-target="#hapusModal-<?= $surat_keluar['ID_SURAT_KELUAR'] ?>">
                                                    <span class="icon">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-primary btn-icon-split btn-sm ml-2" data-toggle="modal" data-target="#detailModal-<?= $surat_keluar['ID_SURAT_KELUAR'] ?>">
                                                    <span class="text">Detail</span>
                                                </a>
                                            </div>
                                            <p hidden><?= $surat_keluar['NOMOR_SURAT_KELUAR'] ?></p>
                                        </td>
                                    </tr>

                                    <!-- Hapus Modal -->
                                    <div class="modal fade" id="hapusModal-<?= $surat_keluar['ID_SURAT_KELUAR'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <a class="btn btn-primary" href="<?= base_url('data_surat_keluar/delete/' . $surat_keluar['ID_SURAT_KELUAR']) ?>">Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Detail Modal -->
                                    <div class="modal fade" id="detailModal-<?= $surat_keluar['ID_SURAT_KELUAR'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <?php if ($surat_keluar['SCAN_SURAT_KELUAR'] == NULL) { ?>
                                                                    <span class='badge badge-danger'>Belum Ada</span>
                                                                <?php } else { ?>
                                                                    <a href="<?= base_url('uploads/dokumentasi/' . $surat_keluar['SCAN_SURAT_KELUAR']) ?>" class="btn btn-success btn-icon-split" target="_blank">
                                                                        <span class="icon text-white-50">
                                                                            <i class="fas fa-eye"></i>
                                                                        </span>
                                                                        <span class="text">Lihat</span>
                                                                    </a>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="form-group col-2">
                                                                <label for="detailDraft" class="col-form-label">Draft :</label>
                                                                <a href="<?= base_url('uploads/draft/' . $surat_keluar['DRAFT_SURAT_KELUAR']) ?>" class="btn btn-success btn-icon-split">
                                                                    <span class="icon text-white-50">
                                                                        <i class="fas fa-arrow-down"></i>
                                                                    </span>
                                                                    <span class="text">Unduh</span>
                                                                </a>
                                                            </div>
                                                            <div class="form-group col-8">
                                                                <label for="detailNomorSurat" class="col-form-label">Nomor Surat :</label>
                                                                <input name='detailNomorSurat' type="text" class="form-control" id="detailNomorSurat" value="<?= $surat_keluar['NOMOR_SURAT_KELUAR'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-4">
                                                                <label for="detailTanggalTerima" class="col-form-label">Tanggal Surat :</label>
                                                                <input name='detailTanggalTerima' type="text" class="form-control" id="detailTanggalTerima" value="<?= date('d-m-Y', strtotime($surat_keluar['CREATED_AT'])) ?>" readonly>
                                                            </div>
                                                            <div class="form-group col-5">
                                                                <label for="detailPengirim" class="col-form-label">Pembuat Surat :</label>
                                                                <input name='detailPengirim' type="text" class="form-control" id="detailPengirim" value="<?= $nama ?>" readonly>
                                                            </div>
                                                            <div class="form-group col-3">
                                                                <label for="detailStatus" class="col-form-label">Status Surat :</label>
                                                                <?php
                                                                if ($surat_keluar['STATUS'] == 'Pengajuan') {
                                                                    echo "<div class='bg-secondary btn-icon-split form-control'>";
                                                                } else if ($surat_keluar['STATUS'] == 'Belum terkirim') {
                                                                    echo "<div class='bg-warning btn-icon-split form-control'>";
                                                                } else if ($surat_keluar['STATUS'] == 'Sudah terkirim') {
                                                                    echo "<div class='bg-success btn-icon-split form-control'>";
                                                                } else if ($surat_keluar['STATUS'] == 'Dibatalkan') {
                                                                    echo "<div class='bg-danger btn-icon-split form-control'>";
                                                                } ?>
                                                                <span class="text text-white"><?= $surat_keluar['STATUS'] ?></span>
                                                                <?php echo "</div>" ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-6">
                                                                <label for="detailPenerima" class="col-form-label">Penerima :</label>
                                                                <input name='detailPenerima' type="text" class="form-control" id="detailPenerima" value="<?= $surat_keluar['PENERIMA'] ?>" readonly>
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label for="detailTTD" class="col-form-label">TTD :</label>
                                                                <input name='detailTTD' type="text" class="form-control" id="detailTTD" value="<?= $surat_keluar['TTD'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="detailPerihal" class="col-form-label">Perihal :</label>
                                                            <textarea name='detailPerihal' class="form-control" id="detailPerihal" rows="3" style="resize: none;" readonly><?= $surat_keluar['PERIHAL'] ?></textarea>
                                                        </div>
                                                        <?php if ($surat_keluar['STATUS'] == 'Dibatalkan') { ?>
                                                            <div class="form-group">
                                                                <label for="detailKeterangan" class="col-form-label">Alasan Pembatalan Surat :</label>
                                                                <textarea name='detailKeterangan' class="form-control" id="detailKeterangan" rows="3" style="resize: none;" readonly><?= $surat_keluar['KETERANGAN'] ?></textarea>
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
                                    <div class="modal fade" id="editModal-<?= $surat_keluar['ID_SURAT_KELUAR'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-gradient-secondary">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Informasi Surat Keluar</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url('data_surat_keluar/edit/' . $surat_keluar['ID_SURAT_KELUAR']) ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <div class="modal-body">
                                                        <?php
                                                        if (session()->getFlashData('error')) {
                                                            $error = session()->getFlashData('error');
                                                            if ($surat_keluar['ID_SURAT_KELUAR'] == $error['id']) {
                                                        ?>
                                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <?= $error['error'] ?>
                                                                    <button id="closeAlert" type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        <div class="form-row">
                                                            <div class="form-group col-6">
                                                                <label for="detailNomorSurat" class="col-form-label">Nomor Surat :</label>
                                                                <input onkeydown="return event.key != 'Enter';" name='nomor_surat' type="text" class="form-control" id="detailNomorSurat" value="<?= $surat_keluar['NOMOR_SURAT_KELUAR'] ?>" readonly>
                                                            </div>
                                                            <div class="form-group col-3">
                                                                <label for="detailTanggalSurat" class="col-form-label">Tanggal Surat :</label>
                                                                <input onkeydown="return event.key != 'Enter';" name='tanggal_surat' type="text" class="form-control" id="detailTanggalSurat" value="<?= date('d-m-Y', strtotime($surat_keluar['CREATED_AT'])) ?>" readonly>
                                                            </div>
                                                            <div class="form-group col-3">
                                                                <label for="detailPembuat" class="col-form-label">Pembuat Surat :</label>
                                                                <input onkeydown="return event.key != 'Enter';" name='pengirim' type="text" class="form-control" id="detailPembuat" value="<?= $nama ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-6">
                                                                <label for="detailPenerima" class="col-form-label">Penerima :</label>
                                                                <input onkeydown="return event.key != 'Enter';" name='penerima' type="text" class="form-control" id="detailPenerima" value="<?= $surat_keluar['PENERIMA'] ?>" required>
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label for="detailTTD" class="col-form-label">TTD :</label>
                                                                <input onkeydown="return event.key != 'Enter';" name='ttd' type="text" class="form-control" id="detailTTD" value="<?= $surat_keluar['TTD'] ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="detailPerihal" class="col-form-label">Perihal :</label>
                                                            <textarea name='perihal' class="form-control" id="detailPerihal" rows="3" style="resize: none;" required><?= $surat_keluar['PERIHAL'] ?></textarea>
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
                                <?php
                                    $nama = NULL;
                                endforeach;
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
                table.columns(6).search(status).draw();
            } else {
                table.columns(6).search('').draw();
            }
        })

        <?php
        if (session()->getFlashData('error')) {
            $error = session()->getFlashData('error');
        ?>
            $('#edit-<?= $error['id'] ?>').trigger('click');
        <?php
        }
        ?>
    });

    // setTimeout("CallButton()", 2000);

    // function CallButton() {
    //     document.getElementById("closeAlert").click();
    // }

    $(document).ready(function() {
        $('#dataTable').DataTable({
            bDestroy: true,
            "initComplete": function(settings, json) {
                $("#dataTable").wrap("<div style='overflow:auto; width:100%;position:relative; max-height:47vh;'></div>");
            },
            scrollCollapse: true,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
            }
        });
    });
</script>
<?= $this->endSection() ?>