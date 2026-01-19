-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jan 2026 pada 09.08
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rekrutmen`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `waktu_absen` datetime DEFAULT current_timestamp(),
  `keterangan` enum('Hadir','Sakit','Izin','Tidak Hadir') DEFAULT 'Hadir',
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `shift_id`, `waktu_absen`, `keterangan`, `catatan`) VALUES
(16, 186, '2026-01-19 11:19:00', 'Hadir', 'Training'),
(17, 187, '2026-01-20 11:20:00', 'Hadir', 'Training'),
(18, 188, '2026-01-21 11:21:00', 'Hadir', 'Training'),
(19, 230, '2026-01-01 13:22:00', 'Hadir', ''),
(20, 231, '2026-01-02 13:23:00', 'Hadir', ''),
(21, 232, '2026-01-03 13:23:00', 'Hadir', ''),
(22, 233, '2026-01-04 13:23:00', 'Hadir', ''),
(23, 234, '2026-01-05 13:23:00', 'Hadir', ''),
(24, 236, '2026-01-07 13:24:00', 'Hadir', ''),
(25, 261, '2026-01-01 13:24:00', 'Hadir', ''),
(26, 262, '2026-01-02 13:24:00', 'Hadir', ''),
(27, 263, '2026-01-03 13:24:00', 'Hadir', ''),
(28, 265, '2026-01-05 13:25:00', 'Hadir', ''),
(29, 266, '2026-01-06 13:25:00', 'Hadir', ''),
(30, 267, '2026-01-07 13:25:00', 'Hadir', ''),
(31, 200, '2026-01-02 13:33:00', 'Hadir', ''),
(32, 201, '2026-01-03 13:34:00', 'Hadir', ''),
(33, 202, '2026-01-04 13:34:00', 'Hadir', ''),
(34, 203, '2026-01-05 13:34:00', 'Hadir', ''),
(35, 204, '2026-01-06 13:34:00', 'Hadir', ''),
(36, 205, '2026-01-07 13:34:00', 'Hadir', ''),
(37, 237, '2026-01-08 13:38:00', 'Sakit', ''),
(38, 268, '2026-01-08 13:38:00', 'Hadir', ''),
(39, 238, '2026-01-09 13:39:00', 'Hadir', ''),
(40, 269, '2026-01-09 13:39:00', 'Hadir', ''),
(41, 207, '2026-01-09 13:39:00', 'Hadir', ''),
(42, 239, '2026-01-10 13:39:00', 'Hadir', ''),
(43, 270, '2026-01-10 13:40:00', 'Hadir', ''),
(44, 208, '2026-01-10 13:40:00', 'Hadir', ''),
(45, 240, '2026-01-11 13:41:00', 'Hadir', ''),
(46, 271, '2026-01-11 13:41:00', 'Hadir', ''),
(47, 209, '2026-01-11 13:41:00', 'Hadir', ''),
(48, 241, '2026-01-12 13:41:00', 'Hadir', ''),
(49, 272, '2026-01-12 13:41:00', 'Hadir', ''),
(50, 210, '2026-01-12 13:41:00', 'Izin', ''),
(51, 273, '2026-01-13 13:42:00', 'Hadir', ''),
(52, 211, '2026-01-13 13:42:00', 'Hadir', ''),
(53, 243, '2026-01-14 13:42:00', 'Hadir', ''),
(54, 274, '2026-01-14 13:43:00', 'Hadir', ''),
(55, 212, '2026-01-14 13:43:00', 'Hadir', ''),
(56, 244, '2026-01-15 13:43:00', 'Hadir', ''),
(57, 213, '2026-01-15 13:43:00', 'Hadir', ''),
(58, 245, '2026-01-16 13:44:00', 'Izin', ''),
(59, 276, '2026-01-16 13:44:00', 'Hadir', ''),
(60, 214, '2026-01-16 13:44:00', 'Hadir', ''),
(61, 246, '2026-01-17 13:47:00', 'Hadir', ''),
(62, 277, '2026-01-17 13:47:00', 'Hadir', ''),
(63, 215, '2026-01-17 13:47:00', 'Hadir', ''),
(64, 247, '2026-01-18 13:47:00', 'Hadir', ''),
(65, 278, '2026-01-18 13:47:00', 'Hadir', ''),
(66, 216, '2026-01-18 13:48:00', 'Hadir', ''),
(67, 279, '2026-01-19 13:48:00', 'Hadir', ''),
(68, 217, '2026-01-19 13:48:00', 'Hadir', ''),
(69, 249, '2026-01-20 13:49:00', 'Hadir', ''),
(70, 280, '2026-01-20 13:49:00', 'Hadir', ''),
(71, 218, '2026-01-20 13:49:00', 'Hadir', ''),
(72, 250, '2026-01-21 13:50:00', 'Hadir', ''),
(73, 281, '2026-01-21 13:50:00', 'Hadir', ''),
(74, 219, '2026-01-21 13:50:00', 'Hadir', ''),
(75, 251, '2026-01-22 13:50:00', 'Hadir', ''),
(76, 282, '2026-01-22 13:50:00', 'Hadir', ''),
(79, 252, '2026-01-23 13:54:00', 'Hadir', ''),
(80, 283, '2026-01-23 13:54:00', 'Hadir', ''),
(81, 221, '2026-01-23 13:54:00', 'Hadir', ''),
(82, 190, '2026-01-23 13:54:00', 'Hadir', ''),
(83, 253, '2026-01-24 13:55:00', 'Hadir', ''),
(84, 284, '2026-01-24 13:55:00', 'Hadir', ''),
(85, 222, '2026-01-24 13:55:00', 'Hadir', ''),
(86, 191, '2026-01-24 13:56:00', 'Hadir', ''),
(87, 254, '2026-01-25 13:56:00', 'Hadir', ''),
(88, 285, '2026-01-25 13:56:00', 'Hadir', ''),
(89, 223, '2026-01-25 13:56:00', 'Hadir', ''),
(90, 192, '2026-01-25 13:56:00', 'Hadir', ''),
(91, 286, '2026-01-26 13:57:00', 'Hadir', ''),
(92, 224, '2026-01-26 13:57:00', 'Hadir', ''),
(93, 193, '2026-01-26 13:58:00', 'Hadir', ''),
(94, 256, '2026-01-27 13:58:00', 'Hadir', ''),
(95, 287, '2026-01-27 13:58:00', 'Hadir', ''),
(96, 225, '2026-01-27 13:58:00', 'Hadir', ''),
(97, 194, '2026-01-27 13:58:00', 'Hadir', ''),
(98, 257, '2026-01-28 13:59:00', 'Hadir', ''),
(99, 288, '2026-01-28 13:59:00', 'Hadir', ''),
(100, 226, '2026-01-28 13:59:00', 'Hadir', ''),
(101, 195, '2026-01-28 13:59:00', 'Hadir', ''),
(102, 258, '2026-01-29 14:00:00', 'Hadir', ''),
(103, 289, '2026-01-29 14:00:00', 'Hadir', ''),
(104, 196, '2026-01-29 14:00:00', 'Hadir', ''),
(105, 259, '2026-01-30 14:01:00', 'Hadir', ''),
(106, 290, '2026-01-30 14:01:00', 'Hadir', ''),
(107, 228, '2026-01-30 14:01:00', 'Hadir', ''),
(108, 260, '2026-01-31 14:01:00', 'Sakit', ''),
(109, 291, '2026-01-31 14:01:00', 'Hadir', ''),
(110, 229, '2026-01-31 14:01:00', 'Hadir', ''),
(111, 198, '2026-01-31 14:01:00', 'Hadir', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang_pekerjaan`
--

CREATE TABLE `bidang_pekerjaan` (
  `id` bigint(20) NOT NULL,
  `bidang_pekerjaan` varchar(255) NOT NULL,
  `jenis_pekerjaan` enum('Part Time','Full Time','Magang') NOT NULL DEFAULT 'Full Time',
  `gaji_pokok` double(10,0) NOT NULL,
  `jobdesk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bidang_pekerjaan`
--

INSERT INTO `bidang_pekerjaan` (`id`, `bidang_pekerjaan`, `jenis_pekerjaan`, `gaji_pokok`, `jobdesk`) VALUES
(1, 'Barista', 'Full Time', 3000000, 'Membuat kopi, melayani pelanggan, menjaga kebersihan bar.'),
(2, 'Kitchen Crew', 'Full Time', 3000000, 'Membuat makanan, melayani pelanggan, menjaga kebersihan bar.'),
(3, 'Waitress/Waiter', 'Part Time', 1500000, 'Mengantar makanan, membersihkan meja, greeting pelanggan.'),
(4, 'Kasir', 'Full Time', 1500000, 'memproses transaksi pembelian pelanggan, melayani pelanggan'),
(5, 'Social Media Intern', 'Magang', 1000000, 'Membuat konten TikTok/IG, admin sosmed.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `insentif`
--

CREATE TABLE `insentif` (
  `id` int(11) NOT NULL,
  `penggajihan_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `insentif`
--

INSERT INTO `insentif` (`id`, `penggajihan_id`, `tanggal`, `total`, `keterangan`) VALUES
(5, 12, '2026-01-19', 30000.00, 'Lembur'),
(6, 15, '2026-01-31', 125000.00, 'Kehadiran Lengkap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `id` int(11) NOT NULL,
  `pelamar_id` bigint(20) DEFAULT NULL,
  `pertanyaan_id` bigint(20) DEFAULT NULL,
  `rekrutmen_id` int(11) DEFAULT NULL,
  `jawaban` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jawaban`
--

INSERT INTO `jawaban` (`id`, `pelamar_id`, `pertanyaan_id`, `rekrutmen_id`, `jawaban`) VALUES
(6, 11, 5, 6, 'Saya adalah pribadi yang disiplin, memiliki ketertarikan besar di bidang kuliner, dan terbiasa bekerja di lingkungan yang cepat. Saya memiliki keahlian dalam persiapan bahan baku (prep work), menjaga konsistensi rasa sesuai resep, serta sangat memperhatikan standar kebersihan dapur. Dengan pengalaman saya sebelumnya, saya terbiasa mengelola station kerja secara mandiri maupun berkolaborasi dengan tim untuk mengejar target pesanan.'),
(7, 11, 6, 6, 'Saya melakukan pengecekan kebersihan station, mencuci tangan sesuai prosedur, memastikan alat masak dalam keadaan steril, serta mengecek kualitas bahan baku dengan prinsip FIFO untuk memastikan kesegaran. Saya melakukan clear-up total: membersihkan sisa makanan, melakukan sanitizing pada permukaan meja kerja, mencuci alat masak, menutup rapat wadah bahan baku, dan memastikan semua peralatan listrik/gas dalam posisi aman sebelum ditinggalkan.'),
(8, 11, 7, 6, 'Saya akan tetap tenang agar tidak terjadi kesalahan fatal. Strategi saya adalah menggunakan sistem FIFO (pesanan pertama dikerjakan lebih dulu), namun melakukan batching (mengerjakan beberapa pesanan yang jenis menu atau bahan bakunya sama sekaligus) agar lebih efisien. Saya juga akan berkomunikasi dengan rekan tim untuk berbagi beban kerja jika ada station yang terlalu penuh, tanpa mengurangi pengecekan akhir pada kualitas platting.'),
(9, 11, 8, 6, 'Pertama, saya segera melapor kepada Head Chef atau Manajer mengenai situasi tersebut agar menu bisa segera \'dimatikan\' di sistem atau dicoret dari menu fisik. Kedua, saya akan berkoordinasi dengan tim Front of House (server/kasir) agar mereka bisa menawarkan menu alternatif yang serupa kepada pelanggan sebelum mereka memesan, sehingga kekecewaan dapat diminimalisir sejak awal.'),
(10, 11, 9, 6, 'Saya akan menegurnya secara sopan dan pribadi (tidak di depan pelanggan atau banyak orang). Saya akan mengingatkan kembali standar presentasi atau resep yang telah ditetapkan perusahaan. Jika makanan tersebut memang belum keluar ke pelanggan, saya akan menyarankan untuk memperbaikinya terlebih dahulu, karena kepuasan pelanggan dan konsistensi kualitas adalah tanggung jawab bersama seluruh tim dapur.'),
(11, 11, 10, 6, 'Saya akan memberikan informasi sedini mungkin kepada tim depan jika ada keterlambatan, tanpa menunggu mereka bertanya. Saya akan menjelaskan alasan singkatnya (misal: antrean panjang atau proses masak tertentu) dan memberikan estimasi waktu yang akurat (misal: \'Pesanan meja 5 siap dalam 7 menit lagi\'). Dengan begitu, tim depan bisa menjelaskan kepada pelanggan secara proaktif dengan nada yang baik'),
(12, 16, 11, 8, 'Tidak Tau'),
(13, 16, 12, 8, 'Tidak Tau'),
(14, 16, 13, 8, 'Tidak tau'),
(15, 16, 14, 8, 'Tidak tau'),
(16, 16, 15, 8, 'Tidak tau'),
(17, 17, 5, 9, 'saya berpengalaman sebagai chef selama 5 tahun'),
(18, 17, 6, 9, 'dijaga kebersihannya'),
(19, 17, 7, 9, 'tetap prioritaskan pemesanan pelanggan'),
(20, 17, 8, 9, 'membeli bahan baku secara langsung'),
(21, 17, 9, 9, 'membereskannya'),
(22, 17, 10, 9, 'secara baik-baik'),
(23, 20, 5, 10, 'Saya adalah pribadi yang mudah berbaur dan cekatan, memiliki pengalaman sebagai kitchen staff selama kurang lebih 2 tahun.'),
(24, 20, 6, 10, 'saya akan memulai dari pekerjaan yang paling mudah untuk dilakukan terlebih dahulu dalam hal menjaga kebersihan area kerja agar tetap bersih dan higenis'),
(25, 20, 7, 10, 'hidangkan terlebih dahulu minuman kepada pelanggan'),
(26, 20, 8, 10, 'menawarkan menu rekomendasi yang mirip'),
(27, 20, 9, 10, 'melakukan evaluasi saat briefing baik saat opening maupun closing kedai'),
(28, 20, 10, 10, 'melakukan komunikasi secara baik-baik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `pengguna_id` bigint(20) DEFAULT NULL,
  `tunjangan_id` bigint(20) DEFAULT NULL,
  `bidang_pekerjaan_id` bigint(20) DEFAULT NULL,
  `nomor_telepon` varchar(20) DEFAULT NULL,
  `status` enum('aktif','tidak aktif') DEFAULT 'aktif',
  `tanggal_bergabung` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id`, `pengguna_id`, `tunjangan_id`, `bidang_pekerjaan_id`, `nomor_telepon`, `status`, `tanggal_bergabung`) VALUES
(11, 11, NULL, 2, '08963643383', 'aktif', '2026-01-19'),
(12, 12, 3, 1, '089352377583', 'aktif', '2025-01-19'),
(13, 13, 1, 2, '0835235325235', 'aktif', '2025-10-19'),
(14, 14, 2, 1, '08325782636', 'aktif', '2025-06-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lampiran`
--

CREATE TABLE `lampiran` (
  `id` int(11) NOT NULL,
  `pelamar_id` bigint(20) DEFAULT NULL,
  `rekrutmen_id` int(11) DEFAULT NULL,
  `lampiran` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lowongan_kerja`
--

CREATE TABLE `lowongan_kerja` (
  `id` bigint(20) NOT NULL,
  `bidang_pekerjaan_id` bigint(20) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `tanggal_buka` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `persyaratan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lowongan_kerja`
--

INSERT INTO `lowongan_kerja` (`id`, `bidang_pekerjaan_id`, `judul`, `tanggal_buka`, `tanggal_berakhir`, `deskripsi`, `persyaratan`) VALUES
(1, 1, 'Lowongan Barista Profesional', '2025-12-01', '2025-12-15', 'Dicari Barista berpengalaman untuk Hatara Coffee.', 'Pria/Wanita, Usia Max 27, Domisili Banjarbaru/Banjarmasin, Pengalaman min 1 tahun.'),
(2, 3, 'Part Time Waitress', '2025-12-20', '2026-01-05', 'Dibutuhkan Waitress paruh waktu untuk shift sore.', 'Wanita, Mahasiswi semester akhir diperbolehkan, Ramah dan Cekatan.'),
(3, 5, 'Magang Social Media', '2026-01-01', '2026-02-07', 'Kesempatan magang bagi kreatif muda.', 'Paham tren sosmed, punya laptop sendiri, domisili Kalsel.'),
(6, 4, 'Lowongan Kasir', '2026-01-01', '2026-01-31', 'Dibutuhkan segera kasir berpengalaman minimal 1 tahun', 'Wanita, Usia Max 27, Domisili Banjarbaru/Martapura, Pengalaman min 1 tahun.'),
(7, 2, 'Lowongan Pekerjaan Kitchen/Chef', '2026-01-01', '2026-01-31', 'Dibutuhkan kitchen staff berpengalaman di bidang pengolahan makanan', 'Pria/Wanita, Domisili Banjarbaru/Banjarmasin, Pengalaman min 1 tahun.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggajihan`
--

CREATE TABLE `penggajihan` (
  `id` int(11) NOT NULL,
  `karyawan_id` int(11) DEFAULT NULL,
  `periode` date DEFAULT current_timestamp(),
  `total_gaji_pokok` decimal(12,2) DEFAULT NULL,
  `tunjangan` decimal(12,2) DEFAULT NULL,
  `total_insentif` decimal(12,2) DEFAULT NULL,
  `total_gaji` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penggajihan`
--

INSERT INTO `penggajihan` (`id`, `karyawan_id`, `periode`, `total_gaji_pokok`, `tunjangan`, `total_insentif`, `total_gaji`) VALUES
(12, 11, '2026-01-01', 3000000.00, 0.00, 30000.00, 3030000.00),
(13, 12, '2026-01-01', 3000000.00, 1250000.00, 0.00, 4250000.00),
(14, 13, '2026-01-01', 3000000.00, 450000.00, 0.00, 3450000.00),
(15, 14, '2026-01-01', 3000000.00, 750000.00, 125000.00, 3875000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nomor_telepon` varchar(255) DEFAULT NULL,
  `role` enum('admin','pelamar','karyawan') NOT NULL DEFAULT 'pelamar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `username`, `password`, `nomor_telepon`, `role`) VALUES
(1, 'Ahmad Muhtami', 'admin', '21232f297a57a5a743894a0e4a801fc3', '089352377583', 'admin'),
(11, 'Muhammad Afrizal', 'afrizal', '827ccb0eea8a706c4c34a16891f84e7b', '08963643383', 'karyawan'),
(12, 'Gusti Riduan', 'riduan', '827ccb0eea8a706c4c34a16891f84e7b', '0863753253223', 'karyawan'),
(13, 'Abdurrahman Fikri', 'fikri', '827ccb0eea8a706c4c34a16891f84e7b', '0877325786235', 'karyawan'),
(14, 'Bayu Saputra', 'bayu', '827ccb0eea8a706c4c34a16891f84e7b', '08325673232', 'karyawan'),
(15, 'Farhan', 'farhan', '827ccb0eea8a706c4c34a16891f84e7b', '0894637285632', 'pelamar'),
(16, 'Siti Rahmah', 'rahmah', '827ccb0eea8a706c4c34a16891f84e7b', '0877325322323', 'pelamar'),
(17, 'agung', 'agung', '827ccb0eea8a706c4c34a16891f84e7b', '08926732621', 'pelamar'),
(20, 'Muhammad Ramadhan', 'ramadhan', '827ccb0eea8a706c4c34a16891f84e7b', '089973423323', 'pelamar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id` bigint(20) NOT NULL,
  `lowongan_id` bigint(20) DEFAULT NULL,
  `pertanyaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pertanyaan`
--

INSERT INTO `pertanyaan` (`id`, `lowongan_id`, `pertanyaan`) VALUES
(5, 7, 'Deksirpsikan diri anda secara singkat, keahlian/pengalaman anda!'),
(6, 7, 'Jelaskan langkah-langkah spesifik yang Anda lakukan saat memulai shift dan mengakhiri shift untuk memastikan area kerja (station) Anda tetap bersih dan higienis!'),
(7, 7, 'Bayangkan situasi saat rush hour (jam sibuk) di mana pesanan makanan menumpuk dan pelanggan mulai tidak sabar. Bagaimana cara Anda mengatur prioritas pengerjaan pesanan agar tetap cepat namun kualitas makanan tetap terjaga sesuai standar?'),
(8, 7, 'Jika di tengah operasional Anda menyadari bahwa stok bahan baku utama untuk menu best-seller tiba-tiba habis karena kesalahan pencatatan, apa tindakan darurat yang akan Anda lakukan untuk meminimalisir kekecewaan pelanggan?'),
(9, 7, 'Jika Anda melihat rekan kerja Anda menyajikan makanan yang tidak sesuai dengan standar presentasi atau resep perusahaan (misalnya porsi kurang atau tampilan berantakan), apa yang akan Anda lakukan?'),
(10, 7, 'Komunikasi antara area dapur dan bar/barista sangat penting di coffee shop. Bagaimana cara Anda mengkomunikasikan keterlambatan pesanan makanan kepada tim depan (front of house) agar mereka bisa menyampaikannya dengan baik kepada pelanggan?'),
(11, 6, 'Jika pada saat closing (tutup toko) Anda menemukan selisih uang di laci kasir (baik itu kurang atau lebih) dibandingkan dengan laporan penjualan di sistem POS (Point of Sales), langkah apa yang akan Anda lakukan untuk menelusuri selisih tersebut dan bagai'),
(12, 6, 'Seorang pelanggan datang dengan keluhan bahwa minuman yang ia terima salah, padahal di struk pesanan sudah tertulis dengan benar. Pelanggan tersebut terlihat kesal. Bagaimana cara Anda menangani situasi ini untuk menenangkan pelanggan sekaligus menjaga na'),
(13, 6, 'Bagaimana cara Anda menawarkan menu tambahan (seperti pastry atau add-on topping) kepada pelanggan yang hanya memesan satu minuman, tanpa terkesan memaksa, agar penjualan toko bisa meningkat? Berikan contoh kalimat yang akan Anda gunakan.'),
(14, 6, 'Jika tiba-tiba sistem kasir (POS) atau mesin EDC mengalami gangguan koneksi internet saat antrean sedang panjang, apa solusi manual atau prosedur darurat yang akan Anda terapkan agar transaksi tetap berjalan lancar dan pelanggan tidak menunggu terlalu lam'),
(15, 6, 'Sebagai kasir, Anda seringkali menjadi wajah pertama yang dilihat pelanggan. Bagaimana cara Anda menjaga keramahan dan senyum saat melayani pelanggan di depan, sambil mendengarkan atau berkoordinasi dengan barista di belakang terkait ketersediaan menu yan'),
(16, 3, 'Bayangkan coffee shop kami akan meluncurkan menu \"Signature Kopi Susu Gula Aren\" baru minggu depan. bagaimana cara anda untuk mempromosikan peluncuran ini agar menarik perhatian audiens muda. Jelaskan hook (daya tarik) utamanya.'),
(17, 3, 'Coffee shop kami memiliki image yang santai, hangat, dan estetik. Tuliskan sebuah caption Instagram yang menarik untuk sebuah foto secangkir Hot Latte di meja dekat jendela saat hujan turun.'),
(18, 3, 'Sebutkan satu tren TikTok atau Reels yang sedang viral saat ini. Bagaimana cara Anda mengadaptasi tren tersebut agar relevan dengan konten coffee shop tanpa menghilangkan identitas brand kami?'),
(20, 3, 'Jika ada pelanggan yang berkomentar negatif di postingan terbaru kami, misalnya: \"Pelayanannya lambat banget dan kopinya asem, nggak recommended!\", bagaimana cara Anda membalas komentar tersebut secara publik di media sosial? Tuliskan draf balasan Anda.'),
(21, 3, 'Aplikasi atau tools apa saja yang biasa Anda gunakan untuk mengedit foto dan video (misalnya: Canva, CapCut, VN, Lightroom, dll)?'),
(22, 2, 'Di coffee shop, waitress adalah orang yang paling sering berinteraksi dengan pelanggan. Bagaimana cara Anda menyapa dan menyambut pelanggan yang baru datang agar mereka merasa nyaman dan dihargai sejak detik pertama?'),
(23, 2, 'Jika seorang pelanggan mengeluh karena pesanannya datang sangat terlambat dan ia sudah mulai marah, kalimat apa yang akan Anda sampaikan untuk meminta maaf?'),
(24, 2, 'Seorang pelanggan bingung memilih menu karena baru pertama kali berkunjung. Bagaimana cara Anda menjelaskan menu unggulan kami dan membantu pelanggan tersebut memilih minuman/makanan yang sesuai dengan selera mereka?'),
(25, 2, 'Saat kondisi toko sedang sangat ramai, Anda melihat ada meja kotor yang belum dibersihkan, pelanggan di meja lain memanggil untuk meminta bill, dan ada pelanggan baru yang masuk. Bagaimana Anda mengatur urutan prioritas tindakan Anda?'),
(26, 2, 'Jika terjadi kesalahan komunikasi yang menyebabkan pesanan salah dibuat, dan pelanggan komplain kepada Anda, bagaimana cara Anda mengomunikasikan hal ini kepada tim Barista atau Kitchen tanpa menimbulkan ketegangan atau saling menyalahkan di depan pelanggan?'),
(27, 1, 'Setiap pagi, profil rasa espresso bisa berubah karena faktor kelembapan atau suhu ruangan. Jelaskan parameter apa saja yang Anda sesuaikan (seperti grind size, dose, atau yield) jika hasil ekstraksi espresso Anda terasa terlalu asam (sour/under-extracted) dan mengalir terlalu cepat.'),
(28, 1, 'Membuat latte art yang indah memang penting, namun tekstur susu jauh lebih utama. Bagaimana cara Anda memastikan konsistensi microfoam yang sempurna untuk cappuccino dibandingkan dengan flat white? Jelaskan juga bagaimana Anda meminimalkan pemborosan susu (milk waste) di setiap shift.'),
(29, 1, 'Jika seorang pelanggan meminta kopi manual brew dengan karakter rasa yang clean dan bright/fruity, variabel apa yang akan Anda fokuskan (suhu air, rasio kopi, atau teknik tuangan)? Mengapa Anda memilih variabel tersebut?'),
(30, 1, 'Saat terjadi antrean panjang (rush hour), bagaimana cara Anda mengatur workflow agar pesanan tetap keluar dengan cepat tanpa mengorbankan kualitas standar latte art atau kebersihan area mesin? Berikan langkah-langkah efisien yang biasa Anda lakukan.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekrutmen`
--

CREATE TABLE `rekrutmen` (
  `id` int(11) NOT NULL,
  `pelamar_id` bigint(20) DEFAULT NULL,
  `lowongan_id` bigint(20) DEFAULT NULL,
  `no_ktp` varchar(25) NOT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `usia` varchar(25) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `agama` varchar(25) DEFAULT NULL,
  `alamat_domisili` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cv` text DEFAULT NULL,
  `status` enum('menunggu','diproses','diterima','ditolak') DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `tanggal` date DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekrutmen`
--

INSERT INTO `rekrutmen` (`id`, `pelamar_id`, `lowongan_id`, `no_ktp`, `tempat_lahir`, `tanggal_lahir`, `usia`, `jenis_kelamin`, `agama`, `alamat_domisili`, `email`, `cv`, `status`, `catatan`, `tanggal`, `updated_at`) VALUES
(6, 11, 7, '2394923908324', 'Banjarbaru', '2000-12-31', '25', 'Laki-laki', 'Islam', 'Jl. Kembang, No. 12, Kota Banjarbaru', 'afrizal@gmail.com', '1768790402_contoh-cv1.pdf', 'diterima', 'Selamat, anda diterima bekerja. Informasi lebih lanjut akan kami sampaikan, silahkan menunggu.', '2026-01-19', '2026-01-19'),
(7, 15, 7, '353726752127', 'Martapura', '2002-04-13', '23', 'Laki-laki', 'Islam', 'Banjarmasin', 'farhan@gmail.com', '1768802736_contoh-cv1.pdf', 'menunggu', NULL, '2026-01-19', '2026-01-19'),
(8, 16, 6, '2363263632632', 'Martapura', '2004-12-22', '21', 'Perempuan', 'Islam', 'Martapura, Sungai Besar', 'rahmah@gmail.com', '1768802885_contoh-cv2.pdf', 'diproses', 'Lamaran anda sedang diproses oleh tim kami', '2026-01-19', '2026-01-19'),
(9, 17, 7, '325325325325', 'Banjarmasin', '1999-12-03', '27', 'Laki-laki', 'Islam', 'Guntung Manggis, Banjarbaru', 'agung@gmail.com', '1768803072_contoh-cv1.pdf', 'diproses', 'Lamaran anda sedang diproses oleh tim kami', '2026-01-19', '2026-01-19'),
(10, 20, 7, '242365732573', 'Banjarmasin', '2001-02-20', '24', 'Laki-laki', 'Islam', 'Sungai Sipai, Martapura', 'ramadhan@gmail.com', '1768808583_contoh-cv1.pdf', 'menunggu', NULL, '2026-01-19', '2026-01-19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `shift`
--

CREATE TABLE `shift` (
  `id` int(11) NOT NULL,
  `karyawan_id` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jenis_shift` enum('Shift 1','Shift 2','Lembur','Libur') NOT NULL,
  `jam_kerja` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `shift`
--

INSERT INTO `shift` (`id`, `karyawan_id`, `tanggal`, `jenis_shift`, `jam_kerja`) VALUES
(168, 11, '2026-01-01', 'Shift 1', '07.00 - 15.00'),
(169, 11, '2026-01-02', 'Libur', '-'),
(170, 11, '2026-01-03', 'Shift 2', '14.30 - 23.00'),
(171, 11, '2026-01-04', 'Shift 1', '07.00 - 15.00'),
(172, 11, '2026-01-05', 'Shift 2', '14.30 - 23.00'),
(173, 11, '2026-01-06', 'Shift 1', '07.00 - 15.00'),
(174, 11, '2026-01-07', 'Shift 2', '14.30 - 23.00'),
(175, 11, '2026-01-08', 'Libur', '-'),
(176, 11, '2026-01-09', 'Shift 1', '07.00 - 15.00'),
(177, 11, '2026-01-10', 'Shift 2', '14.30 - 23.00'),
(178, 11, '2026-01-11', 'Shift 1', '07.00 - 15.00'),
(179, 11, '2026-01-12', 'Shift 2', '14.30 - 23.00'),
(180, 11, '2026-01-13', 'Shift 1', '07.00 - 15.00'),
(181, 11, '2026-01-14', 'Shift 2', '14.30 - 23.00'),
(182, 11, '2026-01-15', 'Libur', '-'),
(183, 11, '2026-01-16', 'Shift 1', '07.00 - 15.00'),
(184, 11, '2026-01-17', 'Shift 2', '14.30 - 23.00'),
(185, 11, '2026-01-18', 'Shift 1', '07.00 - 15.00'),
(186, 11, '2026-01-19', 'Lembur', '08.00 - 23.00'),
(187, 11, '2026-01-20', 'Lembur', '08.00 - 23.00'),
(188, 11, '2026-01-21', 'Lembur', '08.00 - 23.00'),
(189, 11, '2026-01-22', 'Libur', '-'),
(190, 11, '2026-01-23', 'Shift 1', '07.00 - 15.00'),
(191, 11, '2026-01-24', 'Shift 2', '14.30 - 23.00'),
(192, 11, '2026-01-25', 'Shift 1', '07.00 - 15.00'),
(193, 11, '2026-01-26', 'Shift 2', '14.30 - 23.00'),
(194, 11, '2026-01-27', 'Shift 1', '07.00 - 15.00'),
(195, 11, '2026-01-28', 'Shift 2', '14.30 - 23.00'),
(196, 11, '2026-01-29', 'Shift 1', '07.00 - 15.00'),
(197, 11, '2026-01-30', 'Libur', '-'),
(198, 11, '2026-01-31', 'Shift 2', '14.30 - 23.00'),
(199, 12, '2026-01-01', 'Libur', '-'),
(200, 12, '2026-01-02', 'Shift 2', '14.30 - 23.00'),
(201, 12, '2026-01-03', 'Shift 1', '07.00 - 15.00'),
(202, 12, '2026-01-04', 'Lembur', '08.00 - 23.00'),
(203, 12, '2026-01-05', 'Shift 1', '07.00 - 15.00'),
(204, 12, '2026-01-06', 'Shift 2', '14.30 - 23.00'),
(205, 12, '2026-01-07', 'Shift 1', '07.00 - 15.00'),
(206, 12, '2026-01-08', 'Libur', '-'),
(207, 12, '2026-01-09', 'Shift 2', '14.30 - 23.00'),
(208, 12, '2026-01-10', 'Shift 2', '14.30 - 23.00'),
(209, 12, '2026-01-11', 'Shift 2', '14.30 - 23.00'),
(210, 12, '2026-01-12', 'Shift 2', '14.30 - 23.00'),
(211, 12, '2026-01-13', 'Shift 2', '14.30 - 23.00'),
(212, 12, '2026-01-14', 'Shift 2', '14.30 - 23.00'),
(213, 12, '2026-01-15', 'Libur', '-'),
(214, 12, '2026-01-16', 'Shift 2', '14.30 - 23.00'),
(215, 12, '2026-01-17', 'Shift 2', '14.30 - 23.00'),
(216, 12, '2026-01-18', 'Shift 2', '14.30 - 23.00'),
(217, 12, '2026-01-19', 'Shift 2', '14.30 - 23.00'),
(218, 12, '2026-01-20', 'Shift 2', '14.30 - 23.00'),
(219, 12, '2026-01-21', 'Shift 2', '14.30 - 23.00'),
(220, 12, '2026-01-22', 'Libur', '-'),
(221, 12, '2026-01-23', 'Shift 2', '14.30 - 23.00'),
(222, 12, '2026-01-24', 'Shift 2', '14.30 - 23.00'),
(223, 12, '2026-01-25', 'Shift 2', '14.30 - 23.00'),
(224, 12, '2026-01-26', 'Shift 2', '14.30 - 23.00'),
(225, 12, '2026-01-27', 'Shift 2', '14.30 - 23.00'),
(226, 12, '2026-01-28', 'Shift 2', '14.30 - 23.00'),
(227, 12, '2026-01-29', 'Libur', '-'),
(228, 12, '2026-01-30', 'Shift 2', '14.30 - 23.00'),
(229, 12, '2026-01-31', 'Shift 2', '14.30 - 23.00'),
(230, 13, '2026-01-01', 'Shift 2', '14.30 - 23.00'),
(231, 13, '2026-01-02', 'Lembur', '08.00 - 23.00'),
(232, 13, '2026-01-03', 'Shift 1', '08.00 - 15.30'),
(233, 13, '2026-01-04', 'Shift 2', '14.30 - 23.00'),
(234, 13, '2026-01-05', 'Shift 1', '07.00 - 15.00'),
(235, 13, '2026-01-06', 'Libur', '-'),
(236, 13, '2026-01-07', 'Shift 1', '07.00 - 15.00'),
(237, 13, '2026-01-08', 'Lembur', '08.00 - 23.00'),
(238, 13, '2026-01-09', 'Shift 2', '14.30 - 23.00'),
(239, 13, '2026-01-10', 'Shift 2', '14.30 - 23.00'),
(240, 13, '2026-01-11', 'Shift 1', '07.00 - 15.00'),
(241, 13, '2026-01-12', 'Shift 2', '14.30 - 23.00'),
(242, 13, '2026-01-13', 'Libur', '-'),
(243, 13, '2026-01-14', 'Shift 1', '07.00 - 15.00'),
(244, 13, '2026-01-15', 'Lembur', '08.00 - 23.00'),
(245, 13, '2026-01-16', 'Shift 1', '07.00 - 15.00'),
(246, 13, '2026-01-17', 'Lembur', '08.00 - 23.00'),
(247, 13, '2026-01-18', 'Shift 2', '14.30 - 23.00'),
(248, 13, '2026-01-19', 'Libur', '-'),
(249, 13, '2026-01-20', 'Shift 2', '14.30 - 23.00'),
(250, 13, '2026-01-21', 'Shift 1', '07.00 - 15.00'),
(251, 13, '2026-01-22', 'Lembur', '08.00 - 23.00'),
(252, 13, '2026-01-23', 'Shift 1', '07.00 - 15.00'),
(253, 13, '2026-01-24', 'Shift 2', '14.30 - 23.00'),
(254, 13, '2026-01-25', 'Shift 1', '07.00 - 15.00'),
(255, 13, '2026-01-26', 'Libur', '-'),
(256, 13, '2026-01-27', 'Shift 1', '07.00 - 15.00'),
(257, 13, '2026-01-28', 'Shift 2', '14.30 - 23.00'),
(258, 13, '2026-01-29', 'Shift 2', '14.30 - 23.00'),
(259, 13, '2026-01-30', 'Lembur', '08.00 - 23.00'),
(260, 13, '2026-01-31', 'Shift 1', '08.00 - 15.30'),
(261, 14, '2026-01-01', 'Lembur', '08.00 - 23.00'),
(262, 14, '2026-01-02', 'Shift 1', '07.00 - 15.00'),
(263, 14, '2026-01-03', 'Shift 2', '14.30 - 23.00'),
(264, 14, '2026-01-04', 'Libur', '-'),
(265, 14, '2026-01-05', 'Shift 2', '14.30 - 23.00'),
(266, 14, '2026-01-06', 'Shift 1', '07.00 - 15.00'),
(267, 14, '2026-01-07', 'Shift 2', '14.30 - 23.00'),
(268, 14, '2026-01-08', 'Lembur', '08.00 - 23.00'),
(269, 14, '2026-01-09', 'Shift 1', '07.00 - 15.00'),
(270, 14, '2026-01-10', 'Shift 1', '07.00 - 15.00'),
(271, 14, '2026-01-11', 'Shift 1', '07.00 - 15.00'),
(272, 14, '2026-01-12', 'Shift 1', '07.00 - 15.00'),
(273, 14, '2026-01-13', 'Shift 1', '07.00 - 15.00'),
(274, 14, '2026-01-14', 'Shift 1', '07.00 - 15.00'),
(275, 14, '2026-01-15', 'Lembur', '08.00 - 23.00'),
(276, 14, '2026-01-16', 'Shift 1', '07.00 - 15.00'),
(277, 14, '2026-01-17', 'Shift 1', '07.00 - 15.00'),
(278, 14, '2026-01-18', 'Shift 1', '07.00 - 15.00'),
(279, 14, '2026-01-19', 'Shift 1', '07.00 - 15.00'),
(280, 14, '2026-01-20', 'Shift 1', '07.00 - 15.00'),
(281, 14, '2026-01-21', 'Shift 1', '07.00 - 15.00'),
(282, 14, '2026-01-22', 'Lembur', '08.00 - 23.00'),
(283, 14, '2026-01-23', 'Shift 1', '07.00 - 15.00'),
(284, 14, '2026-01-24', 'Shift 1', '07.00 - 15.00'),
(285, 14, '2026-01-25', 'Shift 1', '07.00 - 15.00'),
(286, 14, '2026-01-26', 'Shift 1', '07.00 - 15.00'),
(287, 14, '2026-01-27', 'Shift 1', '07.00 - 15.00'),
(288, 14, '2026-01-28', 'Shift 1', '07.00 - 15.00'),
(289, 14, '2026-01-29', 'Lembur', '08.00 - 23.00'),
(290, 14, '2026-01-30', 'Shift 1', '07.00 - 15.00'),
(291, 14, '2026-01-31', 'Shift 1', '07.00 - 15.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tunjangan`
--

CREATE TABLE `tunjangan` (
  `id` bigint(20) NOT NULL,
  `jenis_tunjangan` varchar(255) NOT NULL,
  `nominal` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tunjangan`
--

INSERT INTO `tunjangan` (`id`, `jenis_tunjangan`, `nominal`) VALUES
(1, 'Masa Kerja 3 Bulan', 450000.00),
(2, 'Masa Kerja 6 Bulan', 750000.00),
(3, 'Masa Kerja 12 Bulan', 1250000.00);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shift_id` (`shift_id`);

--
-- Indeks untuk tabel `bidang_pekerjaan`
--
ALTER TABLE `bidang_pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `insentif`
--
ALTER TABLE `insentif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penggajihan_id` (`penggajihan_id`);

--
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelamar_id` (`pelamar_id`),
  ADD KEY `pertanyaan_id` (`pertanyaan_id`),
  ADD KEY `rekrutmen_id` (`rekrutmen_id`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tunjangan_karyawan` (`tunjangan_id`),
  ADD KEY `fk_bidang_karyawan` (`bidang_pekerjaan_id`),
  ADD KEY `fk_karyawan_pengguna` (`pengguna_id`);

--
-- Indeks untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelamar_id` (`pelamar_id`),
  ADD KEY `rekrutmen_id` (`rekrutmen_id`);

--
-- Indeks untuk tabel `lowongan_kerja`
--
ALTER TABLE `lowongan_kerja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bidang_pekerjaan_id` (`bidang_pekerjaan_id`);

--
-- Indeks untuk tabel `penggajihan`
--
ALTER TABLE `penggajihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penggajihan_ibfk_1` (`karyawan_id`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lowongan_id` (`lowongan_id`);

--
-- Indeks untuk tabel `rekrutmen`
--
ALTER TABLE `rekrutmen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelamar_id` (`pelamar_id`),
  ADD KEY `fk_lowongan_rekrutmen` (`lowongan_id`);

--
-- Indeks untuk tabel `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shift_ibfk_1` (`karyawan_id`);

--
-- Indeks untuk tabel `tunjangan`
--
ALTER TABLE `tunjangan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT untuk tabel `bidang_pekerjaan`
--
ALTER TABLE `bidang_pekerjaan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `insentif`
--
ALTER TABLE `insentif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `lowongan_kerja`
--
ALTER TABLE `lowongan_kerja`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `penggajihan`
--
ALTER TABLE `penggajihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `rekrutmen`
--
ALTER TABLE `rekrutmen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;

--
-- AUTO_INCREMENT untuk tabel `tunjangan`
--
ALTER TABLE `tunjangan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`shift_id`) REFERENCES `shift` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `insentif`
--
ALTER TABLE `insentif`
  ADD CONSTRAINT `insentif_ibfk_1` FOREIGN KEY (`penggajihan_id`) REFERENCES `penggajihan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`pelamar_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_2` FOREIGN KEY (`pertanyaan_id`) REFERENCES `pertanyaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_3` FOREIGN KEY (`rekrutmen_id`) REFERENCES `rekrutmen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `fk_bidang_karyawan` FOREIGN KEY (`bidang_pekerjaan_id`) REFERENCES `bidang_pekerjaan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_karyawan_pengguna` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tunjangan_karyawan` FOREIGN KEY (`tunjangan_id`) REFERENCES `tunjangan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  ADD CONSTRAINT `lampiran_ibfk_1` FOREIGN KEY (`pelamar_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lampiran_ibfk_2` FOREIGN KEY (`rekrutmen_id`) REFERENCES `rekrutmen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `lowongan_kerja`
--
ALTER TABLE `lowongan_kerja`
  ADD CONSTRAINT `lowongan_kerja_ibfk_1` FOREIGN KEY (`bidang_pekerjaan_id`) REFERENCES `bidang_pekerjaan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penggajihan`
--
ALTER TABLE `penggajihan`
  ADD CONSTRAINT `penggajihan_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `pertanyaan_ibfk_1` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongan_kerja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rekrutmen`
--
ALTER TABLE `rekrutmen`
  ADD CONSTRAINT `fk_lowongan_rekrutmen` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongan_kerja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekrutmen_ibfk_1` FOREIGN KEY (`pelamar_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `shift`
--
ALTER TABLE `shift`
  ADD CONSTRAINT `shift_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
