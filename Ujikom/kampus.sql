-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Agu 2023 pada 10.27
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kampus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_beasiswa`
--

CREATE TABLE `tb_beasiswa` (
  `id_mhs` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `no` varchar(32) NOT NULL,
  `semester` varchar(32) NOT NULL,
  `ipk` varchar(11) NOT NULL,
  `beasiswa` varchar(64) NOT NULL,
  `berkas` varchar(64) NOT NULL,
  `status_ajuan` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_beasiswa`
--

INSERT INTO `tb_beasiswa` (`id_mhs`, `nama`, `email`, `no`, `semester`, `ipk`, `beasiswa`, `berkas`, `status_ajuan`) VALUES
(27, 'Nenda Alfadil', 'nendaseputra@gmail.com', '089689516416', 'Semester 4', '3.98', 'Beasiswa Non Akademi', 'catatan.png', 'Diterima'),
(37, 'Yumas Bekti ', 'yumas@gmail.com', '089767822666', 'Semester 5', '3.27', 'Beasiswa LPDP', 'pyramid.jpg', 'Belum di Verifikasi'),
(38, 'Fajrin', 'abdushobarudin9@gmail.com', '089689516416', 'Pilih Semester', '3.27', 'Pilih Beasiswa', 'Nenda AlfadilSeputra-CCNAv7-3-TI-2021-certificate (1)_page-0001.', 'Belum di Verifikasi'),
(39, 'NENDA ALFADIL SEPUTRA ', 'baenenda130@gmail.com', '0828333333333', 'Pilih Semester', '3.38', 'Pilih Beasiswa', 'card.png', 'Belum di Verifikasi'),
(40, 'NENDA ALFADIL SEPUTRA ', 'baenenda130@gmail.com', '0897766788222', 'Pilih Semester', '3.24', 'Pilih Beasiswa', 'Nenda AlfadilSeputra-CCNAv7-3-TI-2021-certificate (1)_page-0001.', 'Belum di Verifikasi'),
(41, 'sandi', 'abiyanth12@gmail.com', '0878383838383', 'Semester 5', '3.38', 'Pilih Beasiswa', 'profile.png', 'Belum di Verifikasi'),
(42, 'Nara', 'naratama@gmail.com', '08976888336', 'Semester 5', '3.01', 'Beasiswa Unggulan', 'card.png', 'Belum di Verifikasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pilihan_beasiswa`
--

CREATE TABLE `tb_pilihan_beasiswa` (
  `id_beasiswa` int(11) NOT NULL,
  `beasiswa` varchar(32) NOT NULL,
  `status_beasiswa` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pilihan_beasiswa`
--

INSERT INTO `tb_pilihan_beasiswa` (`id_beasiswa`, `beasiswa`, `status_beasiswa`) VALUES
(9, 'Beasiswa BIM', 'Aktif'),
(11, 'Beasiswa Kominfo', 'Aktif'),
(14, 'Beasiswa Unggulan', 'Aktif'),
(15, 'Beasiswa Non Akademik', 'Tidak Aktif'),
(21, 'Beasiswa LPDP', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_beasiswa`
--
ALTER TABLE `tb_beasiswa`
  ADD PRIMARY KEY (`id_mhs`);

--
-- Indeks untuk tabel `tb_pilihan_beasiswa`
--
ALTER TABLE `tb_pilihan_beasiswa`
  ADD PRIMARY KEY (`id_beasiswa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_beasiswa`
--
ALTER TABLE `tb_beasiswa`
  MODIFY `id_mhs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `tb_pilihan_beasiswa`
--
ALTER TABLE `tb_pilihan_beasiswa`
  MODIFY `id_beasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
