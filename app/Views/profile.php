<?php if (session()->get('id_role') == 1) { ?>
    <?= $this->extend('layouts/admin') ?>
<?php } else if (session()->get('id_role') == 2) { ?>
    <?= $this->extend('layouts/pegawai') ?>
<?php }  ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?= base_url() ?>/assets/img/akun.png" alt="Admin" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4><?= $pengguna[0]['NAMA'] ?></h4>
                                <p class="text-secondary mb-3"><?= session()->get('role') ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nama</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $pengguna[0]['NAMA'] ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">NIP</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $pengguna[0]['NIP'] ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">No. HP</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $pengguna[0]['NO_HP'] ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $pengguna[0]['EMAIL'] ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <button id="ubah_password" class="btn btn-primary" data-toggle="modal" data-target="#editModal">Ubah Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <button id="trigger" onclick="<?php if (session()->getFlashData('error') || session()->getFlashData('success')) : ?> $('#ubah_password').trigger('click'); <?php endif; ?>" hidden>Trigger</button>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-secondary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Ubah Password</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
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
                <form action="<?= base_url('profile/ubah_password/' . session()->get('id_pengguna')) ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <input type="email" name="email" value="<?= $pengguna[0]['EMAIL'] ?>" hidden>
                        <div class="form-group row">
                            <label for="password_lama" class="col-5 col-form-label">Password Lama</label>
                            <div class="col-7">
                                <input class="form-control" type="password" name="password_lama" id="password_lama" placeholder="Password lama" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_baru" class="col-5 col-form-label">Password Baru</label>
                            <div class="col-7">
                                <input class="form-control" type="password" name="password_baru" id="password_baru" placeholder="Password baru" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="verif_password" class="col-5 col-form-label">Verifikasi Password Baru</label>
                            <div class="col-7">
                                <input class="form-control" type="password" name="verif_password" id="verif_password" placeholder="Verifikasi password baru" required>
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
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#trigger').trigger('click');
    });
</script>
<?= $this->endSection() ?>