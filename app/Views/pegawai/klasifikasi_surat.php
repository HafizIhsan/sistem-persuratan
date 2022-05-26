<?= $this->extend('layouts/pegawai') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Klasifikasi Surat</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive table-hover">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Kode</th>
                            <th>Nomor</th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($klasifikasi_surat as $key => $klasifikasi_surat) : ?>
                            <?php for ($i = 0; $i <= count($kategori_klasifikasi); $i++) {
                                if ($klasifikasi_surat['KODE'] === $kategori_klasifikasi[$i]['KODE']) {
                                    $kategori = $kategori_klasifikasi[$i]['KATEGORI'];
                                }
                            } ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $klasifikasi_surat['KODE'] ?></td>
                                <td><?= $klasifikasi_surat['NOMOR_KLASIFIKASI'] ?></td>
                                <td><?= $kategori ?></td>
                                <td><?= $klasifikasi_surat['KETERANGAN'] ?></td>
                            </tr>
                        <?php endforeach;
                        ?>
                    </tbody>
                </table>
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
            scrollY: '47vh',
            scrollCollapse: true,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
            }
        });
    });
</script>

<?= $this->endSection() ?>