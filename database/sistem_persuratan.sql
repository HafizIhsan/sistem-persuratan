-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2022 at 07:23 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_persuratan`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat_lainnya`
--

CREATE TABLE `jenis_surat_lainnya` (
  `ID_JENIS_SURAT_LAINNYA` tinyint(2) NOT NULL,
  `JENIS_SURAT` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_surat_lainnya`
--

INSERT INTO `jenis_surat_lainnya` (`ID_JENIS_SURAT_LAINNYA`, `JENIS_SURAT`) VALUES
(1, 'Nota Kesepahaman'),
(2, 'Perjanjian Kerjasama'),
(3, 'Berita Acara');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_klasifikasi`
--

CREATE TABLE `kategori_klasifikasi` (
  `KODE` varchar(2) NOT NULL,
  `KATEGORI` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_klasifikasi`
--

INSERT INTO `kategori_klasifikasi` (`KODE`, `KATEGORI`) VALUES
('DL', 'PENDIDIKAN DAN PELATIHAN '),
('HK', 'HUKUM '),
('HM', 'HUBUNGAN MASYARAKAT '),
('IF', 'INFORMATIKA '),
('KA', 'KEARSIPAN '),
('KP', 'KEPEGAWAIAN '),
('KS', 'KONSOLIDASI DAN STATISTIK '),
('KU', 'KEUANGAN '),
('OT', 'ORGANISASI DAN TATA LAKSANA '),
('PK', 'KEPUSTAKAAN '),
('PL', 'PERLENGKAPAN '),
('PR', 'PERENCANAAN '),
('PS', 'PERUMUSAN KEBIJAKAN Dl BIDANG STATISTIK'),
('PW', 'PENGAWASAN '),
('RT', 'KERUMAHTANGGAAN '),
('SS', 'SENSUS PENDUDUK, SENSUS PERTANIAN DAN SENSUS EKONOMI '),
('TS', 'TRANSFORMASI STATISTIK '),
('VS', 'SURVEI ');

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasi_surat`
--

CREATE TABLE `klasifikasi_surat` (
  `ID_KLASIFIKASI_SURAT` int(11) NOT NULL,
  `KODE` varchar(2) NOT NULL,
  `NOMOR_KLASIFIKASI` varchar(6) DEFAULT NULL,
  `KETERANGAN` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klasifikasi_surat`
--

INSERT INTO `klasifikasi_surat` (`ID_KLASIFIKASI_SURAT`, `KODE`, `NOMOR_KLASIFIKASI`, `KETERANGAN`) VALUES
(1, 'KP', '650', 'Surat Perintah Dinas/ Surat Tugas.'),
(2, 'HK', '000', 'Program Legislasi'),
(3, 'HK', '010', 'Bahan/Materi Program Legislasi Nasional dan Instansi.'),
(4, 'HK', '020', 'Program Legislasi Lembaga/lnstansi.'),
(5, 'HK', '100', 'Peraturan Pimpinan Lembaga/Instansi termasuk rancangan awal sampai dengan rancangan akhir dan telaah hukum.'),
(6, 'HK', '110', 'Peraturan Kepala BPS.'),
(7, 'HK', '200', 'Keputusan /Ketetapan Pimpinan Lembaga/Instansi termasuk rancangan awal sampai dengan rancangan akhir dan telaah hukum.'),
(8, 'HK', '300', 'Instruksi Surat Edaran termasuk rancangan awal sampai dengan rancangan akhir dan telaah hukum.'),
(9, 'HK', '310', 'Instruksi/ Surat Edaran Kepala BPS.'),
(10, 'HK', '320', 'Instruksi/ Surat Edaran Pejabat Tinggi Madya dan Pejabat Tinggi Pratama.'),
(11, 'HK', '400', 'Surat Perintah'),
(12, 'HK', '410', 'Surat Perintah Kepala BPS.'),
(13, 'HK', '420', 'Surat Perintah Pejabat Madya.'),
(14, 'HK', '430', 'Surat Perintah Pejabat Pratama.'),
(15, 'HK', '500', 'Pedoman : Standar/ Pedoman/ Prosedur Kerja/ Petunjuk Pelaksanaan/ Petunjuk Teknis yang Bersifat Nasional/Regional/Instansional termasuk rancangan awal sampai dengan rancangan akhir.'),
(16, 'HK', '600', 'Nota Kesepahaman'),
(17, 'HK', '610', 'Nota Kesepahaman Dalam Negeri.'),
(18, 'HK', '620', 'Nota Kesepahaman Luar Negeri.'),
(19, 'HK', '700', 'Dokumentasi Hukum : Undang-undang Peraturan Pemerintah, Keputusan Presiden dan peraturan-peraturan lain di luar produk hukum BPS yang dijadikan referensi.'),
(20, 'HK', '800', 'Sosialisasi/ Penyuluhan / Pembinaan Hijkum'),
(21, 'HK', '810', 'Berkas yang berhubungan dengan kegiatan sosialisasi atau penyuluhan hukum'),
(22, 'HK', '820', 'Laporan hasil pelaksanaan sosialisasi penyuluhan hukum'),
(23, 'HK', '900', 'Bantuan Konsultasi Hukum/Advokasi : Berkas tentang pemberian bantuan/konsultasi hukum (Pidana, Perdata, Tata Usaha Negara, dan Agama).'),
(24, 'HK', '1000', 'Kasus/Sengketa Hukum'),
(25, 'HK', '1010', 'Pidana : Berkas tentang kasus/ sengketa pidana, baik kejahatan maupun pelanggaran.'),
(26, 'HK', '1011', 'Proses verbal mulai dari penyelidikan, penyidikan sampai dengan vonis.'),
(27, 'HK', '1012', 'Berkas pembelaan dan bantuan hukum'),
(28, 'HK', '1013', 'Telaah hukum dan opini hukum.'),
(29, 'HK', '1020', 'Perdata'),
(30, 'HK', '1021', 'Proses gugatan sampai dengan putusan.'),
(31, 'HK', '1022', 'Berkas pembelaan dan bantuan hukum.'),
(32, 'HK', '1023', 'Telaah hukum dan opini hukum'),
(33, 'HK', '1030', 'Tata Usaha Negara'),
(34, 'HK', '1031', 'Proses gugatan sampai dengan putusan.'),
(35, 'HK', '1032', 'Berkas pembelaan dan bantuan hukum.'),
(36, 'HK', '1033', 'Telaah hukum dan opini hukum.'),
(37, 'HK', '1040', 'Arbitrase'),
(38, 'HK', '1041', 'Proses gugatan sampai dengan putusan.'),
(39, 'HK', '1042', 'Berkas pembelaan dan bantuan hukum'),
(40, 'HK', '1043', 'Telaah hukum dan opini hukum.'),
(41, 'OT', '000', 'Organisasi : Meliputi hal-hal yang berkenaan dengan masalah bahan persipan dan penyusunan organisasi BPS dan unit kerja dibawahnya.'),
(42, 'OT', '010', 'Pembentukan Organisasi.'),
(43, 'OT', '020', 'Pengubahan Organisasi,'),
(44, 'OT', '030', 'Pembubaran Organisasi.'),
(45, 'OT', '040', 'Evaluasi Kelembagaan : Meliputi naskah-naskah yang berkaitan dengan penilaian dan penyempurnaan organisasi.'),
(46, 'OT', '050', 'Uraian Jabatan : Meliputi hal-hal yang berkenaan dengan masalah klasifikasi kepegawaian/pekerjaan, penelitian, jabatan dan analisa jabatan'),
(47, 'OT', '100', 'Tata Laksana'),
(48, 'OT', '110', 'Standar Kompetensi Jabatan Struktural dan Fungsional : Meliputi hal-hal yang berkenaan dengan standar kompetensi jabatan struktural dan jabatan fungsional.'),
(49, 'OT', '120', 'Tata Hubungan Kerja : Meliputi hal-hal berkenaan dengan masalah penyusunan tata hubungan kerja baik intern maupun ekstern BPS.'),
(50, 'OT', '130', 'Sistem dan Prosedur : Meliputi hal-hal berkenaan dengan masalah penelaahan tata cara dan metode kegiatan di bidang perstatistikan.'),
(51, 'HM', '000', 'Keprotokolan'),
(52, 'HM', '010', 'Penyelenggaraan acara kedinasan (upacara, pelantikan, peresmian dan jamuan termasuk acara peringatan harihari besar).'),
(53, 'HM', '020', 'Agenda kegiatan pimpinan .'),
(54, 'HM', '030', 'Kunjungan dinas'),
(55, 'HM', '031', 'Kunjungan dinas dalam dan luar negeri.'),
(56, 'HM', '032', 'Kunjungan dinas pimpinan lembaga/instansi.'),
(57, 'HM', '033', 'Kunjungan dinas pejabat lain/ pegawai.'),
(58, 'HM', '040', 'Buku tamu.'),
(59, 'HM', '050', 'Daftar nama/ alamat kantor/pejabat.'),
(60, 'HM', '100', 'Liputan Media Massa : Liputan kegiatan dinas pimpinan acara kedinasan dan peristiwa-peristiwa bidang masing-masing yang diliput oleh media massa (cetak dan elektronik).'),
(61, 'HM', '200', 'Penyajian Informasi Kelembagaan : Penyajian informasi kelembagaan, pengumpulan, pengolahan dan penyajian informasi kelembagaan.'),
(62, 'HM', '210', 'Kliping Koran.'),
(63, 'HM', '220', 'Penerbitan majalah, buletin, koran dan jurnal.'),
(64, 'HM', '230', 'Brosur/leaflet/ poster/plakat.'),
(65, 'HM', '240', 'Pengumuman/pemberitaan.'),
(66, 'HM', '300', 'Hubungan Antar Lembaga'),
(67, 'HM', '310', 'Hubungan antar lembaga pemerintah.'),
(68, 'HM', '320', 'Hubungan dengan organisasi sosial/LSM.'),
(69, 'HM', '330', 'Hubungan dengan perusahaan.'),
(70, 'HM', '340', 'Hubungan dengan perguruan tinggi/ sekolah: magang, Pendidikan Sistem Ganda, Praktek Kerja Lapangan (PKL).'),
(71, 'HM', '350', 'Forum Kehumasan (Bakohumas/ Perhumas).'),
(72, 'HM', '360', 'Hubungan dengan media massa : Siaran pers/konferensi pers/pers release; Kunjungan wartawan/ peliputan; Wawancara.'),
(73, 'HM', '400', 'Dengar Pendapat/Hearing DPR'),
(74, 'HM', '500', 'Penyiapan Bahan Materi Pimpinan'),
(75, 'HM', '600', 'Publikasi Melalui Media Cetak maupun Elektronik'),
(76, 'HM', '700', 'Pameran / Sayembara/ Lomba/ Festival, Pembuatan Spanduk dan Iklan'),
(77, 'HM', '800', 'Penghargaan / Kenang-Kenangan / Cindera Mata'),
(78, 'HM', '900', 'Ucapan Terima Kasih, Ucapan Selamat, Bela Sungkawa, Permohonan Maaf'),
(79, 'DL', '230', 'Teknis');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `ID_PENGGUNA` int(11) NOT NULL,
  `ID_ROLE` tinyint(2) NOT NULL,
  `NAMA` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `NIP` varchar(30) NOT NULL,
  `EMAIL` varchar(30) DEFAULT NULL,
  `NO_HP` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`ID_PENGGUNA`, `ID_ROLE`, `NAMA`, `PASSWORD`, `NIP`, `EMAIL`, `NO_HP`) VALUES
(1, 1, 'Admin', '$2y$10$h2Rue/q4fyfwvf9kOZUQIOzZ4mansHqmo5N8KYOP3cWtX5pqFS9g6', '123456789012345678', 'admin1@gmail.com', '081234567890'),
(2, 2, 'Pegawai', '$2y$10$urOmJ7q1OLRBoWKT2/hg8.v.46rCETvVlF63I3EOXWNqIqiIJU7Dm', '123456789012345677', 'pegawai1@gmail.com', '081234567890');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `ID_ROLE` tinyint(2) NOT NULL,
  `JENIS_PENGGUNA` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`ID_ROLE`, `JENIS_PENGGUNA`) VALUES
(1, 'Administrator'),
(2, 'Pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `ID_SURAT_KELUAR` int(11) NOT NULL,
  `ID_PENGGUNA` int(11) NOT NULL,
  `ID_KLASIFIKASI_SURAT` int(11) NOT NULL,
  `NO_URUT` int(4) NOT NULL,
  `SUB_NO_URUT` int(4) DEFAULT NULL,
  `TANGGAL_SURAT` date NOT NULL,
  `NOMOR_SURAT_KELUAR` varchar(30) DEFAULT NULL,
  `PENERIMA` varchar(30) DEFAULT NULL,
  `TTD` varchar(30) DEFAULT NULL,
  `PERIHAL` varchar(255) DEFAULT NULL,
  `DRAFT_SURAT_KELUAR` varchar(255) DEFAULT NULL,
  `SCAN_SURAT_KELUAR` varchar(255) DEFAULT NULL,
  `STATUS` varchar(30) DEFAULT NULL,
  `KETERANGAN` varchar(255) DEFAULT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`ID_SURAT_KELUAR`, `ID_PENGGUNA`, `ID_KLASIFIKASI_SURAT`, `NO_URUT`, `SUB_NO_URUT`, `TANGGAL_SURAT`, `NOMOR_SURAT_KELUAR`, `PENERIMA`, `TTD`, `PERIHAL`, `DRAFT_SURAT_KELUAR`, `SCAN_SURAT_KELUAR`, `STATUS`, `KETERANGAN`, `CREATED_AT`) VALUES
(1, 1, 67, 16, NULL, '2022-01-10', 'B-016/02410/HM.310/01/2022', ' Biro KTLN, Kemensetneg RI', ' Kepala Biro Humas dan Hukum', 'Permohonan Ijin TB Master Split-Site Program di University Adelaide, Australia an. Rani Dwi A. dan Rizkiyo Gunawan', 'Rani Dwi Ayuningtias - Bagian KSPM.docx', 'Rani Dwi Ayuningtias - Bagian KSPM.pdf', 'Sudah terkirim', NULL, '2022-01-10 04:11:33');

-- --------------------------------------------------------

--
-- Table structure for table `surat_lainnya`
--

CREATE TABLE `surat_lainnya` (
  `ID_SURAT_LAINNYA` int(11) NOT NULL,
  `ID_PENGGUNA` int(11) NOT NULL,
  `ID_JENIS_SURAT_LAINNYA` tinyint(2) NOT NULL,
  `NOMOR_SURAT` varchar(30) NOT NULL,
  `PIHAK_1` varchar(150) NOT NULL,
  `PIHAK_2` varchar(150) NOT NULL,
  `TENTANG` varchar(255) DEFAULT NULL,
  `SCAN_SURAT` varchar(255) DEFAULT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_lainnya`
--

INSERT INTO `surat_lainnya` (`ID_SURAT_LAINNYA`, `ID_PENGGUNA`, `ID_JENIS_SURAT_LAINNYA`, `NOMOR_SURAT`, `PIHAK_1`, `PIHAK_2`, `TENTANG`, `SCAN_SURAT`, `CREATED_AT`) VALUES
(1, 1, 3, '02/HK.610/BA/01/2022', 'Margo Yuwono (Kepala BPS)', 'H. S.N. Prana Putra Sohe (Walikota Lubuk Linggau)', 'Serah Terima Barang Milik Negara', 'BAST LUBUK LINGGAU.pdf', '2022-01-09 18:09:42'),
(2, 1, 1, '15/KS.M/07-XII/2021', 'Margo Yuwono (Kepala BPS)', 'Wimboh Santoso (Ketua Dewan Komisioner Otoritas Jasa Keuangan)', 'Kerja Sama dalam Bidang Statistik dan Sektor Jasa Keuangan', 'MOU-13.2021-Pertukaran Data OJK dan BPS.pdf', '2022-05-15 11:31:07'),
(3, 1, 2, '02/HK.610/PKS/01/2022', 'Margo Yuwono (Kepala BPS)', 'H. S.N. Prana Putra Sohe (Walikota Lubuk Linggau)', 'Hibah barang milik negara berupa tanah bangunan kantor pemerintah, tanah bangunan kantor permanen dan bangunan gedung kantor permanen kepada pemerintah kota lubuk linggau', 'PH lubuk linggau_001.pdf', '2022-05-15 12:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `ID_SURAT_MASUK` int(11) NOT NULL,
  `ID_PENGGUNA` int(11) NOT NULL,
  `NOMOR_SURAT_MASUK` varchar(255) DEFAULT NULL,
  `TANGGAL_TERIMA` date NOT NULL,
  `INSTANSI_PENGIRIM` varchar(255) DEFAULT NULL,
  `PERIHAL` varchar(255) DEFAULT NULL,
  `SCAN_SURAT_MASUK` varchar(255) DEFAULT NULL,
  `URAIAN_PENUGASAN` varchar(255) DEFAULT NULL,
  `PETUGAS` int(11) DEFAULT NULL,
  `STATUS` varchar(50) NOT NULL,
  `TENGGAT_PENUGASAN` timestamp NULL DEFAULT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`ID_SURAT_MASUK`, `ID_PENGGUNA`, `NOMOR_SURAT_MASUK`, `TANGGAL_TERIMA`, `INSTANSI_PENGIRIM`, `PERIHAL`, `SCAN_SURAT_MASUK`, `URAIAN_PENUGASAN`, `PETUGAS`, `STATUS`, `TENGGAT_PENUGASAN`, `CREATED_AT`) VALUES
(1, 1, '433/UN1/DSSDI/SEKDIT/DN/2019', '2019-08-26', 'Direktur Sistem dan Sumber Daya Informasi, UGM', 'Permohonan Kerja Sama Layanan Penyediaan Data Mikro', 'UGM - Bagian KSPM.pdf', 'Tolong dibuatkan draft jawaban surat ini', 1, 'Selesai', '2019-08-28 09:59:00', '2019-08-26 05:09:42');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_surat_lainnya`
--
ALTER TABLE `jenis_surat_lainnya`
  ADD PRIMARY KEY (`ID_JENIS_SURAT_LAINNYA`),
  ADD UNIQUE KEY `JENIS_SURAT_LAINNYA_PK` (`ID_JENIS_SURAT_LAINNYA`);

--
-- Indexes for table `kategori_klasifikasi`
--
ALTER TABLE `kategori_klasifikasi`
  ADD PRIMARY KEY (`KODE`),
  ADD UNIQUE KEY `KATEGORI_KLASIFIKASI_PK` (`KODE`);

--
-- Indexes for table `klasifikasi_surat`
--
ALTER TABLE `klasifikasi_surat`
  ADD PRIMARY KEY (`ID_KLASIFIKASI_SURAT`),
  ADD UNIQUE KEY `KLASIFIKASI_SURAT_PK` (`ID_KLASIFIKASI_SURAT`),
  ADD KEY `MEMILIKI_4_FK` (`KODE`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`ID_PENGGUNA`),
  ADD UNIQUE KEY `PENGGUNA_PK` (`ID_PENGGUNA`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID_ROLE`),
  ADD UNIQUE KEY `ROLE_PK` (`ID_ROLE`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`ID_SURAT_KELUAR`),
  ADD UNIQUE KEY `SURAT_KELUAR_PK` (`ID_SURAT_KELUAR`),
  ADD KEY `MEMBUAT_FK` (`ID_PENGGUNA`),
  ADD KEY `MEMILIKI_3_FK` (`ID_KLASIFIKASI_SURAT`);

--
-- Indexes for table `surat_lainnya`
--
ALTER TABLE `surat_lainnya`
  ADD PRIMARY KEY (`ID_SURAT_LAINNYA`),
  ADD UNIQUE KEY `SURAT_LAINNYA_PK` (`ID_SURAT_LAINNYA`),
  ADD KEY `MENDOKUMENTASI_2_FK` (`ID_PENGGUNA`),
  ADD KEY `MEMILIKI_2_FK` (`ID_JENIS_SURAT_LAINNYA`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`ID_SURAT_MASUK`),
  ADD UNIQUE KEY `SURAT_MASUK_PK` (`ID_SURAT_MASUK`),
  ADD KEY `MENDOKUMENTASI_FK` (`ID_PENGGUNA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_surat_lainnya`
--
ALTER TABLE `jenis_surat_lainnya`
  MODIFY `ID_JENIS_SURAT_LAINNYA` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `klasifikasi_surat`
--
ALTER TABLE `klasifikasi_surat`
  MODIFY `ID_KLASIFIKASI_SURAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `ID_PENGGUNA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `ID_ROLE` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `ID_SURAT_KELUAR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `surat_lainnya`
--
ALTER TABLE `surat_lainnya`
  MODIFY `ID_SURAT_LAINNYA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `ID_SURAT_MASUK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
