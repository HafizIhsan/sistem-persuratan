<!DOCTYPE html>
<html lang="en">

<head>
    <title>Panduan - Sistem Persuratan Biro Humas & Hukum BPS</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/vendor/landing-page/assets/images/plane.png" />
    <!-- FontAwesome JS -->
    <script defer src="<?= base_url() ?>/assets/vendor/panduan/assets/fontawesome/js/all.min.js"></script>
    <!-- Global CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/panduan/assets/plugins/prism/prism.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/panduan/assets/plugins/elegant_font/css/style.css">

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="<?= base_url() ?>/assets/vendor/panduan/assets/css/styles.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/landing-page/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/home.css">

</head>

<body class="body-blue">
    <div class="page-wrapper">
        <!-- ******Header****** -->
        <div class="container mb-auto">
            <header class="head my-3">
                <nav class="navbar navbar-expand-lg navbar-light head__custom-nav">
                    <a class="navbar-brand d-flex align-items-center" href="home">
                        <img src="<?= base_url() ?>/assets/vendor/landing-page/assets/images/plane.png" alt="website logo">
                        <span>Sistem Persuratan</span>
                    </a>
                    <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav">
                        <span><i class="fas fa-bars"></i></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="home">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="panduan">Panduan</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
        </div>
        <!--//header-->

        <div class="doc-wrapper">
            <div class="container">
                <div id="doc-header" class="doc-header text-center">
                    <h1 class="doc-title">Panduan</h1>
                    <div class="meta">Sistem Persuratan Biro Humas dan Hukum BPS</div>
                </div>
                <!--//doc-header-->
                <div class="doc-body row">
                    <div class="doc-content col-md-9 col-12 order-1">
                        <div class="content-inner">
                            <section id="pendahuluan-section" class="doc-section">
                                <h2 class="section-title">Pendahuluan</h2>
                                <div class="section-block">
                                    <p>Sistem Persuratan Biro Humas dan Hukum memberikan layanan dalam pengelolaan persuratan di Biro Humas dan Hukum BPS. Fitur yang tersedia, yaitu
                                    </p>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <h6>User Administrator</h6>
                                            <ul class="list">
                                                <li>Dashboard Administrator</li>
                                                <li>Membuat surat keluar</li>
                                                <li>Melihat surat keluar yang pernah dibuat</li>
                                                <li>Penugasan surat masuk</li>
                                                <li>Dokumentasi surat keluar</li>
                                                <li>Dokumentasi surat masuk</li>
                                                <li>Dokumentasi surat lainnya</li>
                                                <li>Kelola data surat</li>
                                                <li>Kelola data pengguna</li>
                                                <li>Kelola data klasifikasi surat</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <h6>User Pegawai</h6>
                                            <ul class="list">
                                                <li>Dashboard Pegawai</li>
                                                <li>Membuat surat keluar baru</li>
                                                <li>Dokumentasi surat keluar</li>
                                                <li>Melihat surat keluar yang pernah dibuat</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!--//doc-section-->
                            <section id="buatSuratKeluar-section" class="doc-section">
                                <h2 class="section-title">Membuat Surat Keluar</h2>
                                <div class="section-block">
                                    <p>Alur dalam pembuatan surat keluar adalah sebagai berikut.
                                    </p>
                                    <ol class="list">
                                        <li>Persiapkan draft surat keluar dengan format file .docx atau .doc dan ukuran maksidmum 1 MB.</li>
                                        <li>Klik "Membuat Surat Keluar".</li>
                                        <li>Isi <span style="font-style: italic;">field</span> <span style="font-weight: bold;"> tanggal surat, klasifikasi surat, ditujukan kepada, ttd,</span> dan <span style="font-weight: bold;">perihal</span> dengan informasi surat yang akan dibuat. Pastikan tidak ada kesalahan dalam memasukkan informasi surat.</li>
                                        <li>Klik tombol <button type="button" class="btn btn-blue btn-sm">Generate</button> untuk mendapatkan nomor surat keluar terbaru.</li>
                                        <li>Salin nomor surat yang didapatkan kemudian masukkan kedalam draft surat keluar yang telah dipersiapkan</li>
                                        <li>Unggah file draft surat keluar yang sudah terisi dengan nomor surat baru melalui <span style="font-style: italic;">field</span> <span style="font-weight: bold;">draft surat keluar</span></li>
                                        <li>Klik <button type="button" class="btn btn-blue btn-sm">Submit</button></li>
                                        <li>Selanjutnya anda sudah dapat mengajukan tanda tangan untuk surat yang sudah anda buat</li>
                                        <li>Anda juga akan mendapatkan email untuk melakukan dokumentasi surat keluar</li>
                                    </ol>
                                    <p>Surat keluar yang sudah dibuat dapat dilihat pada halaman "Surat Keluar Anda"</p>
                                </div>
                                <!--//section-block-->
                            </section>

                            <section id="dokumentasiSurat-section" class="doc-section">
                                <h2 class="section-title">Dokumentasi Surat</h2>
                                <!--//section-block-->
                                <div id="dokumentasiSuratKeluar-section" class="section-block">
                                    <h3>Dokumentasi Surat Keluar</h3>
                                    <p>Setelah membuat surat keluar melalui halaman "Membuat Surat Keluar", anda harus mengunggah scan hasil akhir surat keluar tersebut. Hasil akhir dari surat keluar yaitu surat keluar yang sudah selesai atau sudah ditandatangani.</p>
                                    <ol class="list">
                                        <li>Pertama, scan surat keluar yang akan didokumentasikan. Hasil scan dalam format file .pdf dan ukuran maksimum 1 MB.</li>
                                        <li>Klik "Dokumentasi Surat Keluar" atau dapat juga melalui "Dashboard" lalu klik <button type="submit" class="btn btn-success btn-icon-split btn-sm">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                <span class="text">Dokumentasi</span>
                                            </button> pada tabel "Surat Keluar Belum di Dokumentasi"</li>
                                        <li>Isi <span style="font-style: italic;">field</span> <span style="font-weight: bold;"> nomor surat</span> dan <span style="font-weight: bold;">status surat</span>.</li>
                                        <li>Unggah file scan surat keluar melalui <span style="font-style: italic;">field</span> <span style="font-weight: bold;">dokumentasi surat</span></li>
                                        <li>Klik <button type="button" class="btn btn-blue btn-sm">Submit</button></li>
                                    </ol>
                                    <p>Data surat keluar dapat dilihat pada halaman "Surat Keluar Anda"</p>
                                    <!--//section-block-->
                                </div>

                                <div id="dokumentasiSuratMasuk-section" class="section-block">
                                    <h3>Dokumentasi Surat Masuk</h3>
                                    <p>Dokumentasi surat masuk hanya dapat dilakukan oleh Administrator. Alur dokumentasi surat masuk adalah sebagai berikut.</p>
                                    <ol class="list">
                                        <li>Pertama, scan surat masuk yang akan didokumentasikan. Hasil scan dalam format file .pdf dan ukuran maksimum 1 MB.</li>
                                        <li>Klik "Dokumentasi Surat Masuk"</li>
                                        <li>Isi <span style="font-style: italic;">field</span> <span style="font-weight: bold;"> nomor surat, pengirim, perihal,</span> dan <span style="font-weight: bold;">tanggal terima</span>.</li>
                                        <li>Unggah file scan surat masuk melalui <span style="font-style: italic;">field</span> <span style="font-weight: bold;">dokumentasi surat</span></li>
                                        <li>Jika terdapat penugasan, dapat mengisi <span style="font-style: italic;">field</span> <span style="font-weight: bold;"> petugas, uraian penugasan,</span> dan <span style="font-weight: bold;">tenggat penugasan</span>. Apabila belum ada penugasan, <span style="font-style: italic;">field</span> tersebut dapat dikosongkan.</li>
                                        <li>Klik <button type="button" class="btn btn-blue btn-sm">Submit</button></li>
                                    </ol>
                                    <p>Data surat masuk dapat dilihat pada bagian kelola data untuk "Data Surat Masuk"</p>
                                    <!--//section-block-->
                                </div>

                                <div id="dokumentasiSuratLainnya-section" class="section-block">
                                    <h3>Dokumentasi Surat Lainnya</h3>
                                    <p>Dokumentasi surat lainnya hanya dapat dilakukan oleh Administrator. Surat lainnya terdiri dari tiga jenis surat yaitu Nota Kesepahaman (MoU), Perjanjian Kerja Sama, dan Berita Acara. Alur dokumentasi surat lainnya adalah sebagai berikut.</p>
                                    <ol class="list">
                                        <li>Pertama, scan surat yang akan didokumentasikan. Hasil scan dalam format file .pdf dan ukuran maksimum 1 MB.</li>
                                        <li>Klik "Dokumentasi Surat Lainnya"</li>
                                        <li>Isi <span style="font-style: italic;">field</span> <span style="font-weight: bold;"> jenis surat, nomor surat, pihak pertama, pihak kedua,</span> dan <span style="font-weight: bold;">tentang</span>.</li>
                                        <li>Unggah file scan surat lainnya melalui <span style="font-style: italic;">field</span> <span style="font-weight: bold;">dokumentasi surat</span></li>
                                        <li>Klik <button type="button" class="btn btn-blue btn-sm">Submit</button></li>
                                    </ol>
                                    <p>Data surat lainnya dapat dilihat pada bagian kelola data untuk "Data Surat Lainnya"</p>
                                    <!--//section-block-->
                                </div>
                            </section>

                            <section id="penugasanSuratMasuk-section" class="doc-section">
                                <h2 class="section-title">Penugasan Surat Masuk</h2>
                                <div class="section-block">
                                    <p>Halaman "Penugasan Surat Masuk" menampilkan daftar penugasan surat masuk yang diterima oleh pengguna. Hal yang dapat dilakukan dalam halaman ini adalah sebagai berikut.</p>
                                    <ul class="list">
                                        <li>Memperbaharui status penugasan jika telah selesai dilakukan dengan menekan <button class="btn btn-blue btn-sm">Selesai</button></li>
                                        <li>Memlihat dokumen surat masuk yang ditugaskan dengan menekan <button class="btn-green btn-sm"><span class="icon"><i class="fas fa-eye"></i></span></button></li>
                                        <li>Memlihat detail surat masuk yang ditugaskan dengan menekan <button class="btn btn-primary btn-sm">Detail</button></li>
                                    </ul>
                                </div>
                                <!--//section-block-->
                            </section>

                            <section id="suratKeluarAnda-section" class="doc-section">
                                <h2 class="section-title">Surat Keluar Anda</h2>
                                <div class="section-block">
                                    <p>Halaman "Surat Keluar Anda" menampilkan daftar surat keluar yang dibuat oleh pengguna. Hal yang dapat dilakukan dalam halaman ini adalah sebagai berikut.</p>
                                    <ul class="list">
                                        <li>Memlihat dokumen surat keluar dengan menekan <button class="btn-green btn-sm"><span class="icon"><i class="fas fa-eye"></i></span></button></li>
                                        <li>Memperbaharui status surat dan mengubah data surat keluar dengan menekan <button class="btn-grey btn-sm"><span class="icon"><i class="fas fa-edit"></i></span></button></li>
                                        <li>Memlihat detail surat keluar dengan menekan <button class="btn btn-primary btn-sm">Detail</button></li>
                                        <li>Jika status surat dalam Pengajuan atau Belum terkirim, anda dapat membatalkan surat keluar dengan menekan <button class="btn btn-red btn-sm">Batalkan</button></li>
                                    </ul>
                                </div>
                                <!--//section-block-->
                            </section>

                            <section id="kelolaData-section" class="doc-section">
                                <h2 class="section-title">Kelola Data</h2>
                                <div class="section-block">
                                    <p>Kelola data hanya dapat dilakukan oleh Administrator. Data yang dapat dikelola, yaitu Data Surat, Data Pengguna, dan Data Klasifikasi Surat.</p>
                                </div>
                                <!--//section-block-->
                                <div id="dataSurat-section" class="section-block">
                                    <h3>Data Surat</h3>
                                    <p>Pengelolaan data surat dapat dilakukan pada bagian kelola data "Data Surat". Terdapat tiga jenis data surat yang dapat dikelola, yaitu surat keluar, surat masuk, dan surat lainnya. Hal yang dapat dilakukan dalam bagian ini adalah sebagai berikut.</p>
                                    <ul class="list">
                                        <li>Export surat menjadi Excel dengan menekan <button class="btn btn-green btn-icon-split btn-sm"><span class="icon"><i class="fas fa-file-excel"></i></span><span class="text">Export</span></button></li>
                                        <li>Mengubah data surat dengan menekan <button class="btn-grey btn-sm"><span class="icon"><i class="fas fa-edit"></i></span></button></li>
                                        <li>Menghapus data surat dengan menekan <button class="btn-red btn-sm"><span class="icon"><i class="fas fa-trash"></i></span></button></li>
                                        <li>Memlihat detail surat dengan menekan <button class="btn btn-primary btn-sm">Detail</button></li>
                                        <li>Pada kelola data surat masuk, jika status surat Belum ditugaskan maka akan muncul tombol <button class="btn btn-blue btn-sm">Tambah Penugasan</button></li>
                                    </ul>
                                    <!--//section-block-->
                                </div>

                                <div id="dataPengguna-section" class="section-block">
                                    <h3>Data Pengguna</h3>
                                    <p>Pengelolaan data pengguna dapat dilakukan pada bagian kelola data "Data Pengguna". Hal yang dapat dilakukan dalam bagian ini adalah sebagai berikut.</p>
                                    <ul class="list">
                                        <li>Menambah data pengguna dengan menekan <button class="btn btn-green btn-icon-split btn-sm"><span class="icon"><i class="fas fa-plus"></i></span><span class="text">Tambah</span></button></li>
                                        <li>Mengubah role dan mengubah data pengguna dengan menekan <button class="btn-grey btn-sm"><span class="icon"><i class="fas fa-edit"></i></span></button></li>
                                        <li>Menghapus data pengguna dengan menekan <button class="btn-red btn-sm"><span class="icon"><i class="fas fa-trash"></i></span></button></li>
                                    </ul>
                                    <!--//section-block-->
                                </div>

                                <div id="dataKlasifikasiSurat-section" class="section-block">
                                    <h3>Data Klasifikasi Surat</h3>
                                    <p>Pengelolaan data klasifikasi surat dapat dilakukan pada bagian kelola data "Data Klasifikasi Surat". Hal yang dapat dilakukan dalam bagian ini adalah sebagai berikut.</p>
                                    <ul class="list">
                                        <li>Menambah data klasifikasi surat dengan menekan <button class="btn btn-green btn-icon-split btn-sm"><span class="icon"><i class="fas fa-plus"></i></span><span class="text">Tambah</span></button></li>
                                        <li>Mengubah data klasifikasi surat dengan menekan <button class="btn-grey btn-sm"><span class="icon"><i class="fas fa-edit"></i></span></button></li>
                                        <li>Menghapus data klasifikasi surat dengan menekan <button class="btn-red btn-sm"><span class="icon"><i class="fas fa-trash"></i></span></button></li>
                                        <li>Memlihat detail klasifikasi surat dengan menekan <button class="btn btn-primary btn-sm">Detail</button></li>
                                    </ul>
                                    <!--//section-block-->
                                </div>
                            </section>
                            <!--//doc-section-->
                        </div>
                        <!--//content-inner-->
                    </div>
                    <!--//doc-content-->
                    <div class="doc-sidebar col-md-3 col-12 order-0 d-none d-md-flex">
                        <div id="doc-nav" class="doc-nav">

                            <nav id="doc-menu" class="nav doc-menu flex-column sticky">
                                <a class="nav-link scrollto" href="#pendahuluan-section">Pendahuluan</a>
                                <a class="nav-link scrollto" href="#buatSuratKeluar-section">Membuat Surat Keluar</a>
                                <a class="nav-link scrollto" href="#dokumentasiSurat-section">Dokumentasi Surat</a>
                                <nav class="doc-sub-menu nav flex-column">
                                    <a class="nav-link scrollto" href="#dokumentasiSuratKeluar-section">Dokumentasi Surat Keluar</a>
                                    <a class="nav-link scrollto" href="#dokumentasiSuratMasuk-section">Dokumentasi Surat Masuk</a>
                                    <a class="nav-link scrollto" href="#dokumentasiSuratLainnya-section">Dokumentasi Surat Lainnya</a>
                                </nav>
                                <a class="nav-link scrollto" href="#penugasanSuratMasuk-section">Penugasan Surat Masuk</a>
                                <a class="nav-link scrollto" href="#suratKeluarAnda-section">Surat Keluar Anda</a>
                                <a class="nav-link scrollto" href="#kelolaData-section">Kelola Data</a>
                                <nav class="doc-sub-menu nav flex-column">
                                    <a class="nav-link scrollto" href="#dataSurat-section">Data Surat</a>
                                    <a class="nav-link scrollto" href="#dataPengguna-section">Data Pengguna</a>
                                    <a class="nav-link scrollto" href="#dataKlasifikasiSurat-section">Data Klasifikasi Surat</a>
                                </nav>
                            </nav>
                            <!--//doc-menu-->

                        </div>
                    </div>
                    <!--//doc-sidebar-->
                </div>
                <!--//doc-body-->
            </div>
            <!--//container-->
        </div>
        <!--//doc-wrapper-->

    </div>
    <!--//page-wrapper-->

    <footer id="footer" class="footer text-center">
        <div class="container my-auto">
            <div class="copyright text-center my-auto text-white">
                <span>Copyright &copy; Biro Humas dan Hukum BPS<?= Date('Y') ?> </span>
            </div>
        </div>
        <!--//container-->
    </footer>
    <!--//footer-->


    <!-- Main Javascript -->
    <script type="text/javascript" src="<?= base_url() ?>/assets/vendor/panduan/assets/plugins/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>/assets/vendor/panduan/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>/assets/vendor/panduan/assets/plugins/prism/prism.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>/assets/vendor/panduan/assets/plugins/jquery-scrollTo/jquery.scrollTo.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>/assets/vendor/panduan/assets/plugins/stickyfill/dist/stickyfill.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>/assets/vendor/panduan/assets/js/main.js"></script>

</body>

</html>