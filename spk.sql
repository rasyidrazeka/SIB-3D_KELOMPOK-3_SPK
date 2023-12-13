-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Des 2023 pada 07.09
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tab_alternatif`
--

CREATE TABLE `tab_alternatif` (
  `id_alternatif` int(10) NOT NULL,
  `nama_alternatif` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tab_alternatif`
--

INSERT INTO `tab_alternatif` (`id_alternatif`, `nama_alternatif`) VALUES
(1, 'A1'),
(2, 'A2'),
(3, 'A3'),
(4, 'A4'),
(5, 'A5'),
(6, 'A6'),
(7, 'A7'),
(8, 'A8'),
(9, 'A9'),
(10, 'A10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tab_kriteria`
--

CREATE TABLE `tab_kriteria` (
  `id_kriteria` int(10) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `bobot` float NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tab_kriteria`
--

INSERT INTO `tab_kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`, `status`) VALUES
(1, 'Anggota RT', 0.2, 'Benefit'),
(2, 'Anggota RT balita dan anak sekolah', 0.2, 'Benefit'),
(3, 'Status', 0.15, 'Benefit'),
(4, 'Tanggungan Lansia', 0.15, 'Benefit'),
(5, 'Tempat Tinggal', 0.1, 'Benefit'),
(6, 'Pendapatan', 0.1, 'Cost'),
(7, 'status PKH', 0.1, 'Benefit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tab_topsis`
--

CREATE TABLE `tab_topsis` (
  `id_alternatif` varchar(10) NOT NULL,
  `id_kriteria` int(10) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tab_topsis`
--

INSERT INTO `tab_topsis` (`id_alternatif`, `id_kriteria`, `nilai`) VALUES
('1', 1, 1),
('1', 2, 1),
('1', 3, 0),
('1', 4, 1),
('1', 5, 0.1),
('1', 6, 0.1),
('1', 7, 1),
('10', 1, 0.3),
('10', 2, 0),
('10', 3, 0.589),
('10', 4, 1),
('10', 5, 0.432),
('10', 6, 0.1),
('10', 7, 1),
('2', 1, 0.789),
('2', 2, 0),
('2', 3, 0),
('2', 4, 1),
('2', 5, 0.978),
('2', 6, 0.897),
('2', 7, 1),
('3', 1, 0.565),
('3', 2, 1),
('3', 3, 0),
('3', 4, 1),
('3', 5, 0.432),
('3', 6, 0.1),
('3', 7, 0),
('4', 1, 0.789),
('4', 2, 0),
('4', 3, 1),
('4', 4, 0),
('4', 5, 0.735),
('4', 6, 0.1),
('4', 7, 1),
('5', 1, 0.565),
('5', 2, 0),
('5', 3, 0),
('5', 4, 1),
('5', 5, 0.978),
('5', 6, 0.899),
('5', 7, 0),
('6', 1, 0.487),
('6', 2, 0),
('6', 3, 0),
('6', 4, 1),
('6', 5, 0.1),
('6', 6, 0.1),
('6', 7, 1),
('7', 1, 0.685),
('7', 2, 1),
('7', 3, 0),
('7', 4, 0),
('7', 5, 0.978),
('7', 6, 0.908),
('7', 7, 1),
('8', 1, 0.487),
('8', 2, 0),
('8', 3, 1),
('8', 4, 0),
('8', 5, 0.978),
('8', 6, 1),
('8', 7, 0),
('9', 1, 0.2),
('9', 2, 1),
('9', 3, 0),
('9', 4, 1),
('9', 5, 0.978),
('9', 6, 0.897),
('9', 7, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tab_alternatif`
--
ALTER TABLE `tab_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `tab_kriteria`
--
ALTER TABLE `tab_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `tab_topsis`
--
ALTER TABLE `tab_topsis`
  ADD PRIMARY KEY (`id_alternatif`,`id_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tab_topsis`
--
ALTER TABLE `tab_topsis`
  ADD CONSTRAINT `tab_topsis_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `tab_kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
