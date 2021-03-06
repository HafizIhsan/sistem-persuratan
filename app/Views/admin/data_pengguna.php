<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pengguna</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive table-hover">
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
                ?>
                <a href="tambah_klasifikasi" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#tambahModal" id="tambahPengguna">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah</span>
                </a>
                <hr>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Role</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pengguna as $key => $pengguna) : ?>
                            <?php for ($i = 0; $i < count($role); $i++) {
                                if ($pengguna['ID_ROLE'] === $role[$i]['ID_ROLE']) {
                                    $jenis_pengguna = $role[$i]['JENIS_PENGGUNA'];
                                }
                            } ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $jenis_pengguna ?></td>
                                <td><?= $pengguna['NAMA'] ?></td>
                                <td><?= $pengguna['NIP'] ?></td>
                                <td><?= $pengguna['EMAIL'] ?></td>
                                <td><?= $pengguna['NO_HP'] ?></td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="#" class="btn btn-secondary btn-icon-split btn-sm" data-toggle="modal" data-target="#editModal-<?= $pengguna['ID_PENGGUNA'] ?>" id="edit-<?= $pengguna['ID_PENGGUNA'] ?>">
                                            <span class="icon">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-icon-split btn-sm ml-2" data-toggle="modal" data-target="#hapusModal-<?= $pengguna['ID_PENGGUNA'] ?>">
                                            <span class="icon">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Klasifikasi Modal -->
                            <div class="modal fade" id="editModal-<?= $pengguna['ID_PENGGUNA'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-gradient-secondary">
                                            <h5 class="modal-title text-white" id="exampleModalLabel">Edit Pengguna</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="<?= base_url('data_pengguna/edit/' . $pengguna['ID_PENGGUNA']) ?>" method="post">
                                            <?= csrf_field(); ?>
                                            <div class="modal-body">
                                                <?php
                                                if (session()->getFlashData('error_edit')) {
                                                    $error = session()->getFlashData('error_edit');
                                                    if ($pengguna['ID_PENGGUNA'] == $error['id']) {
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
                                                        <label for="nama" class="col-form-label">Nama :</label>
                                                        <input name='nama' type="text" class="form-control" id="nama" placeholder="Nama" value="<?= $pengguna['NAMA'] ?>" required>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="email" class="col-form-label">Email :</label>
                                                        <input name='email' type="email" class="form-control" id="email" placeholder="Email" value="<?= $pengguna['EMAIL'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-4">
                                                        <label for="nip" class="col-form-label">NIP :</label>
                                                        <input name='nip' type="text" class="form-control" id="nip" placeholder="NIP" value="<?= $pengguna['NIP'] ?>" required>
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label for="no_hp" class="col-form-label">No. HP :</label>
                                                        <input name='no_hp' type="text" class="form-control" id="no_hp" placeholder="Nomor HP" value="<?= $pengguna['NO_HP'] ?>" required>
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label for="role" class="col-form-label">Role :</label>
                                                        <select name="role" class="form-control" required>
                                                            <option value="<?= $pengguna['ID_ROLE'] ?>"><?= $jenis_pengguna ?></option>
                                                            <?php if ($pengguna['ID_ROLE'] == 1) { ?>
                                                                <option value="2">Pegawai</option>
                                                            <?php } else { ?>
                                                                <option value="1">Administrator</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Hapus Klasifikasi Modal -->
                            <div class="modal fade" id="hapusModal-<?= $pengguna['ID_PENGGUNA'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">??</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Apakah anda yakin ingin menghapus pengguna "<?= $pengguna['NAMA'] ?>"?</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                            <a class="btn btn-primary" href="<?= base_url('data_pengguna/delete/' . $pengguna['ID_PENGGUNA']) ?>">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-secondary">
                    <h5 class="modal-title text-white" id="tambahModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    if (session()->getFlashData('error_tambah')) {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashData('error_tambah') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    }
                    ?>
                    <form id="formPengguna" method="post">
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="nama" class="col-form-label">Nama :</label>
                                    <input name='nama' type="text" class="form-control" id="nama" placeholder="Nama" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="email" class="col-form-label">Email :</label>
                                    <input name='email' type="email" class="form-control" id="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="password" class="col-form-label">Password :</label>
                                    <input name='password' type="password" class="form-control" id="password" placeholder="Password" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="verifPassword" class="col-form-label">Verifikasi Password :</label>
                                    <input name='verifPassword' type="password" class="form-control" id="verifPassword" placeholder="Verifikasi password" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label for="nip" class="col-form-label">NIP :</label>
                                    <input name='nip' type="text" class="form-control" id="nip" placeholder="NIP" required>
                                </div>
                                <div class="form-group col-4">
                                    <label for="no_hp" class="col-form-label">No. HP :</label>
                                    <input name='no_hp' type="text" class="form-control" id="no_hp" placeholder="Nomor HP" required>
                                </div>
                                <div class="form-group col-4">
                                    <label for="role" class="col-form-label">Role :</label>
                                    <select name="role" id="role" class="form-control" placeholder="Pilih role" required>
                                        <option value="" selected>Pilih role</option>
                                        <?php foreach ($role as $key => $role) : ?>
                                            <option value="<?= $role['ID_ROLE'] ?>"><?php echo $role['JENIS_PENGGUNA'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
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

    $(document).ready(function() {
        $('#role').selectize({
            searchField: 'text'
        });

        <?php
        if (session()->getFlashData('error_tambah')) {
        ?>
            $('#tambahPengguna').trigger('click');
        <?php
        }
        ?>

        <?php
        if (session()->getFlashData('error_edit')) {
            $error = session()->getFlashData('error_edit');
        ?>
            $('#edit-<?= $error['id'] ?>').trigger('click');
        <?php
        }
        ?>
    });

    // setTimeout("CallButton()", 2000)

    // function CallButton() {
    //     document.getElementById("closeAlert").click();
    // }
</script>

<?= $this->endSection() ?>