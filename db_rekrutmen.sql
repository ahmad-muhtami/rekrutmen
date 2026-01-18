-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jan 2026 pada 14.07
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
(14, 76, '2026-01-14 19:42:00', 'Hadir', ''),
(15, 119, '2026-01-14 19:56:00', 'Hadir', '');

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
(1, 2, 1, 1, 'Arabica asam, Robusta pahit.'),
(2, 2, 2, 1, 'Mengatur grind size dan dosis.'),
(3, 3, 3, 2, 'Mendengarkan, meminta maaf, dan memberi solusi.'),
(4, 4, 4, 3, 'CapCut, Canva, dan Adobe Premiere.'),
(5, 10, 4, 4, 'Figma, Canva, Adobe Ilustrator, Adobe Premier');

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
(1, 3, NULL, 1, '082111222333', 'aktif', '2026-01-14'),
(2, 5, NULL, 4, '082111222334', 'aktif', '2026-01-14'),
(3, 4, NULL, 2, '082111222335', 'aktif', '2026-01-14'),
(10, 2, NULL, 1, '081234567890', 'aktif', '2026-01-14');

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
(3, 5, 'Magang Social Media', '2026-01-01', '2026-02-07', 'Kesempatan magang bagi kreatif muda.', 'Paham tren sosmed, punya laptop sendiri, domisili Kalsel.');

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
(8, 1, '2026-01-01', 3000000.00, 0.00, 0.00, 3000000.00),
(9, 2, '2026-01-01', 1500000.00, 0.00, 0.00, 1500000.00),
(10, 3, '2026-01-01', 3000000.00, 0.00, 0.00, 3000000.00),
(11, 10, '2026-01-01', 3000000.00, 0.00, 0.00, 3000000.00);

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
(2, 'Siti Aminah', 'sitiaminah', '827ccb0eea8a706c4c34a16891f84e7b', '081234567890', 'karyawan'),
(3, 'Budi Santoso', 'budisantoso', '827ccb0eea8a706c4c34a16891f84e7b', '081234567891', 'pelamar'),
(4, 'Rina Wati', 'rinawati', '827ccb0eea8a706c4c34a16891f84e7b', '081234567892', 'pelamar'),
(5, 'Joko Anwar', 'jokoanwar', '827ccb0eea8a706c4c34a16891f84e7b', '081234567893', 'pelamar'),
(10, 'khahirunnisa', 'khairunnisa', '827ccb0eea8a706c4c34a16891f84e7b', '08963276423', 'pelamar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id` bigint(20) NOT NULL,
  `lowongan_id` bigint(20) DEFAULT NULL,
  `pertanyaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pertanyaan`
--

INSERT INTO `pertanyaan` (`id`, `lowongan_id`, `pertanyaan`) VALUES
(1, 1, 'Apa perbedaan Arabica dan Robusta?'),
(2, 1, 'Jelaskan cara kalibrasi espresso!'),
(3, 2, 'Bagaimana cara menghadapi pelanggan yang komplain?'),
(4, 3, 'Sebutkan tools editing yang kamu kuasai!');

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
(1, 2, 1, '6371010101010001', 'Banjarmasin', '2000-05-15', '25', 'Perempuan', 'Islam', 'Jl. Sultan Adam, Banjarmasin Utara', 'siti.aminah@gmail.com', 'contoh-cv1.pdf', 'diterima', 'Selamat anda telah diterima bekerja', '2025-12-05', '2026-01-14'),
(2, 3, 2, '6372010101010002', 'Martapura', '2003-08-20', '22', 'Laki-laki', 'Islam', 'Jl. A. Yani Km 38, Martapura', 'budi.santoso@gmail.com', 'contoh-cv2.pdf', 'diproses', 'Sedang tahap interview', '2025-12-25', '2026-01-10'),
(3, 4, 3, '6372010101010003', 'Banjarbaru', '2004-02-10', '21', 'Perempuan', 'Kristen', 'Jl. Karang Anyar, Banjarbaru', 'rina.wati@gmail.com', 'contoh-cv3.pdf', 'diterima', 'Selamat bergabung', '2026-01-05', '2026-01-10'),
(4, 10, 3, '6538257382523', 'Amuntai, Hulu Sungai Utara', '2001-02-12', '24', 'Perempuan', 'Islam', 'JL. Wengga, No.2, Kel. Kemuning, Kec. Banjarbaru Selatan, Kota Banjarbaru, 70713', 'khairunnisa@gmail.com', '1768394044_contoh-cv1.pdf', 'menunggu', NULL, '2026-01-14', '2026-01-14');

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
(1, 1, '2026-01-01', 'Shift 1', '07.00 - 15.00'),
(2, 1, '2026-01-02', 'Shift 1', '07.00 - 15.00'),
(3, 1, '2026-01-03', 'Shift 2', '15.00 - 23.00'),
(4, 1, '2026-01-04', 'Libur', '-'),
(5, 1, '2026-01-05', 'Shift 1', '07.00 - 15.00'),
(6, 1, '2026-01-06', 'Shift 2', '15.00 - 23.00'),
(7, 1, '2026-01-07', 'Lembur', '07.00 - 23.00'),
(8, 1, '2026-01-08', 'Libur', '-'),
(9, 1, '2026-01-09', 'Shift 2', '15.00 - 23.00'),
(10, 1, '2026-01-10', 'Shift 2', '15.00 - 23.00'),
(11, 1, '2026-01-11', 'Shift 1', '07.00 - 15.00'),
(12, 1, '2026-01-12', 'Shift 1', '07.00 - 15.00'),
(13, 1, '2026-01-13', 'Lembur', '08.00 - 23.00'),
(14, 1, '2026-01-14', 'Shift 2', '15.00 - 23.00'),
(15, 1, '2026-01-15', 'Libur', '-'),
(16, 1, '2026-01-16', 'Shift 2', '15.00 - 23.00'),
(17, 1, '2026-01-17', 'Shift 2', '15.00 - 23.00'),
(18, 1, '2026-01-18', 'Shift 2', '15.00 - 23.00'),
(19, 1, '2026-01-19', 'Lembur', '08.00 - 23.00'),
(20, 1, '2026-01-20', 'Shift 1', '07.00 - 15.00'),
(21, 1, '2026-01-21', 'Shift 2', '15.00 - 23.00'),
(22, 1, '2026-01-22', 'Lembur', '08.00 - 23.00'),
(23, 1, '2026-01-23', 'Shift 1', '07.00 - 15.00'),
(24, 1, '2026-01-24', 'Shift 1', '07.00 - 15.00'),
(25, 1, '2026-01-25', 'Shift 1', '07.00 - 15.00'),
(26, 1, '2026-01-26', 'Shift 1', '07.00 - 15.00'),
(27, 1, '2026-01-27', 'Shift 1', '07.00 - 15.00'),
(28, 1, '2026-01-28', 'Shift 1', '07.00 - 15.00'),
(29, 1, '2026-01-29', 'Shift 1', '07.00 - 15.00'),
(30, 1, '2026-01-30', 'Shift 1', '07.00 - 15.00'),
(31, 1, '2026-01-31', 'Shift 1', '07.00 - 15.00'),
(63, 2, '2026-01-01', 'Shift 2', '14.30 - 23.00'),
(64, 2, '2026-01-02', 'Shift 1', '08.00 - 15.30'),
(65, 2, '2026-01-03', 'Lembur', '07.00 - 23.00'),
(66, 2, '2026-01-04', 'Libur', '-'),
(67, 2, '2026-01-05', 'Shift 2', '14.30 - 23.00'),
(68, 2, '2026-01-06', 'Shift 1', '07.00 - 15.00'),
(69, 2, '2026-01-07', 'Shift 2', '14.30 - 23.00'),
(70, 2, '2026-01-08', 'Shift 1', '08.00 - 15.30'),
(71, 2, '2026-01-09', 'Libur', '-'),
(72, 2, '2026-01-10', 'Shift 1', '07.00 - 15.00'),
(73, 2, '2026-01-11', 'Shift 2', '14.30 - 23.00'),
(74, 2, '2026-01-12', 'Shift 2', '14.30 - 23.00'),
(75, 2, '2026-01-13', 'Shift 2', '14.30 - 23.00'),
(76, 2, '2026-01-14', 'Shift 1', '07.00 - 15.00'),
(77, 2, '2026-01-15', 'Shift 1', '07.00 - 15.00'),
(78, 2, '2026-01-16', 'Shift 1', '07.00 - 15.00'),
(79, 2, '2026-01-17', 'Shift 1', '07.00 - 15.00'),
(80, 2, '2026-01-18', 'Shift 1', '07.00 - 15.00'),
(81, 2, '2026-01-19', 'Shift 1', '07.00 - 15.00'),
(82, 2, '2026-01-20', 'Shift 1', '07.00 - 15.00'),
(83, 2, '2026-01-21', 'Shift 1', '07.00 - 15.00'),
(84, 2, '2026-01-22', 'Shift 1', '07.00 - 15.00'),
(85, 2, '2026-01-23', 'Shift 1', '07.00 - 15.00'),
(86, 2, '2026-01-24', 'Shift 1', '07.00 - 15.00'),
(87, 2, '2026-01-25', 'Shift 1', '07.00 - 15.00'),
(88, 2, '2026-01-26', 'Shift 1', '07.00 - 15.00'),
(89, 2, '2026-01-27', 'Shift 1', '07.00 - 15.00'),
(90, 2, '2026-01-28', 'Shift 1', '07.00 - 15.00'),
(91, 2, '2026-01-29', 'Shift 1', '07.00 - 15.00'),
(92, 2, '2026-01-30', 'Shift 1', '07.00 - 15.00'),
(93, 2, '2026-01-31', 'Shift 1', '07.00 - 15.00'),
(94, 1, '2026-01-01', 'Shift 1', '07.00 - 15.00'),
(95, 1, '2026-01-02', 'Shift 1', '07.00 - 15.00'),
(96, 1, '2026-01-03', 'Shift 2', '15.00 - 23.00'),
(97, 1, '2026-01-04', 'Libur', '-'),
(98, 1, '2026-01-05', 'Shift 1', '07.00 - 15.00'),
(99, 1, '2026-01-06', 'Shift 2', '15.00 - 23.00'),
(100, 1, '2026-01-07', 'Lembur', '07.00 - 23.00'),
(101, 2, '2026-01-01', 'Shift 2', '15.00 - 23.00'),
(102, 2, '2026-01-02', 'Shift 2', '15.00 - 23.00'),
(103, 2, '2026-01-03', 'Shift 1', '07.00 - 15.00'),
(104, 2, '2026-01-04', 'Shift 1', '07.00 - 15.00'),
(105, 2, '2026-01-05', 'Libur', '-'),
(106, 10, '2026-01-01', 'Shift 2', '14.30 - 23.00'),
(107, 10, '2026-01-02', 'Lembur', '08.00 - 23.00'),
(108, 10, '2026-01-03', 'Shift 2', '14.30 - 23.00'),
(109, 10, '2026-01-04', 'Shift 1', '07.00 - 15.00'),
(110, 10, '2026-01-05', 'Libur', '-'),
(111, 10, '2026-01-06', 'Lembur', '08.00 - 23.00'),
(112, 10, '2026-01-07', 'Shift 2', '14.30 - 23.00'),
(113, 10, '2026-01-08', 'Shift 1', '08.00 - 15.30'),
(114, 10, '2026-01-09', 'Shift 1', '07.00 - 15.00'),
(115, 10, '2026-01-10', 'Shift 2', '14.30 - 23.00'),
(116, 10, '2026-01-11', 'Lembur', '08.00 - 23.00'),
(117, 10, '2026-01-12', 'Shift 2', '14.30 - 23.00'),
(118, 10, '2026-01-13', 'Libur', '-'),
(119, 10, '2026-01-14', 'Shift 1', '07.00 - 15.00'),
(120, 10, '2026-01-15', 'Shift 2', '14.30 - 23.00'),
(121, 10, '2026-01-16', 'Shift 1', '07.00 - 15.00'),
(122, 10, '2026-01-17', 'Shift 2', '14.30 - 23.00'),
(123, 10, '2026-01-18', 'Shift 2', '14.30 - 23.00'),
(124, 10, '2026-01-19', 'Shift 1', '07.00 - 15.00'),
(125, 10, '2026-01-20', 'Shift 1', '07.00 - 15.00'),
(126, 10, '2026-01-21', 'Shift 2', '14.30 - 23.00'),
(127, 10, '2026-01-22', 'Libur', '-'),
(128, 10, '2026-01-23', 'Shift 2', '14.30 - 23.00'),
(129, 10, '2026-01-24', 'Shift 1', '07.00 - 15.00'),
(130, 10, '2026-01-25', 'Shift 2', '14.30 - 23.00'),
(131, 10, '2026-01-26', 'Shift 2', '14.30 - 23.00'),
(132, 10, '2026-01-27', 'Shift 1', '07.00 - 15.00'),
(133, 10, '2026-01-28', 'Shift 1', '07.00 - 15.00'),
(134, 10, '2026-01-29', 'Libur', '-'),
(135, 10, '2026-01-30', 'Shift 1', '07.00 - 15.00'),
(136, 10, '2026-01-31', 'Shift 1', '07.00 - 15.00'),
(137, 3, '2026-01-01', 'Shift 1', '07.00 - 15.00'),
(138, 3, '2026-01-02', 'Lembur', '08.00 - 23.00'),
(139, 3, '2026-01-03', 'Shift 1', '07.00 - 15.00'),
(140, 3, '2026-01-04', 'Shift 2', '14.30 - 23.00'),
(141, 3, '2026-01-05', 'Libur', '-'),
(142, 3, '2026-01-06', 'Shift 2', '14.30 - 23.00'),
(143, 3, '2026-01-07', 'Shift 1', '07.00 - 15.00'),
(144, 3, '2026-01-08', 'Shift 2', '14.30 - 23.00'),
(145, 3, '2026-01-09', 'Shift 2', '14.30 - 23.00'),
(146, 3, '2026-01-10', 'Libur', '-'),
(147, 3, '2026-01-11', 'Shift 2', '14.30 - 23.00'),
(148, 3, '2026-01-12', 'Shift 2', '14.30 - 23.00'),
(149, 3, '2026-01-13', 'Shift 1', '07.00 - 15.00'),
(150, 3, '2026-01-14', 'Shift 1', '07.00 - 15.00'),
(151, 3, '2026-01-15', 'Shift 1', '07.00 - 15.00'),
(152, 3, '2026-01-16', 'Shift 2', '14.30 - 23.00'),
(153, 3, '2026-01-17', 'Libur', '-'),
(154, 3, '2026-01-18', 'Shift 1', '07.00 - 15.00'),
(155, 3, '2026-01-19', 'Shift 2', '14.30 - 23.00'),
(156, 3, '2026-01-20', 'Shift 2', '14.30 - 23.00'),
(157, 3, '2026-01-21', 'Shift 1', '07.00 - 15.00'),
(158, 3, '2026-01-22', 'Lembur', '08.00 - 23.00'),
(159, 3, '2026-01-23', 'Libur', '-'),
(160, 3, '2026-01-24', 'Shift 1', '07.00 - 15.00'),
(161, 3, '2026-01-25', 'Shift 1', '07.00 - 15.00'),
(162, 3, '2026-01-26', 'Lembur', '08.00 - 23.00'),
(163, 3, '2026-01-27', 'Shift 2', '14.30 - 23.00'),
(164, 3, '2026-01-28', 'Shift 1', '07.00 - 15.00'),
(165, 3, '2026-01-29', 'Shift 1', '07.00 - 15.00'),
(166, 3, '2026-01-30', 'Libur', '-'),
(167, 3, '2026-01-31', 'Shift 1', '07.00 - 15.00');

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
  ADD KEY `karyawan_id` (`karyawan_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `bidang_pekerjaan`
--
ALTER TABLE `bidang_pekerjaan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `insentif`
--
ALTER TABLE `insentif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `lowongan_kerja`
--
ALTER TABLE `lowongan_kerja`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `penggajihan`
--
ALTER TABLE `penggajihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `rekrutmen`
--
ALTER TABLE `rekrutmen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

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
  ADD CONSTRAINT `fk_karyawan_pengguna` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
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
  ADD CONSTRAINT `shift_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
