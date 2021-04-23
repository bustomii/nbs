-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Apr 2021 pada 10.39
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kpi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `realisasi` float NOT NULL,
  `score` float NOT NULL,
  `score_akhir` float NOT NULL,
  `id_kpi_meta` int(11) NOT NULL,
  `id_hasil_akhir` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_akhir`
--

CREATE TABLE `h_akhir` (
  `id` int(20) NOT NULL,
  `id_kpi` int(20) NOT NULL,
  `nilai_akhir` float NOT NULL,
  `id_karyawan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `posisi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `posisi`) VALUES
(1, 'Bustomi', 'Web Developer'),
(2, 'Yuda', 'Supervisor IT'),
(3, 'Hunn', 'Web Developer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kpi`
--

CREATE TABLE `kpi` (
  `id` int(20) NOT NULL,
  `bidang` varchar(100) NOT NULL,
  `posisi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kpi`
--

INSERT INTO `kpi` (`id`, `bidang`, `posisi`) VALUES
(1, 'IT', 'Web Developer'),
(4, 'IT', 'Android Developer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kpi_meta`
--

CREATE TABLE `kpi_meta` (
  `id` int(20) NOT NULL,
  `key_performance_indicator` text NOT NULL,
  `bobot` float NOT NULL,
  `target` float NOT NULL,
  `id_kpi` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kpi_meta`
--

INSERT INTO `kpi_meta` (`id`, `key_performance_indicator`, `bobot`, `target`, `id_kpi`) VALUES
(1, 'key_performance_indicator 1', 40, 80, 1),
(2, 'key_performance_indicator 2', 40, 90, 1),
(3, 'key_performance_indicator 3', 20, 88, 1),
(5, 'key_performance_indicator 4', 60, 50, 4),
(6, 'key_performance_indicator 5', 90, 80, 4);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kpi_meta` (`id_kpi_meta`),
  ADD KEY `id_h_akhir` (`id_hasil_akhir`);

--
-- Indeks untuk tabel `h_akhir`
--
ALTER TABLE `h_akhir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indeks untuk tabel `kpi`
--
ALTER TABLE `kpi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kpi_meta`
--
ALTER TABLE `kpi_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kpi` (`id_kpi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `h_akhir`
--
ALTER TABLE `h_akhir`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kpi`
--
ALTER TABLE `kpi`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kpi_meta`
--
ALTER TABLE `kpi_meta`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `id_h_akhir` FOREIGN KEY (`id_hasil_akhir`) REFERENCES `h_akhir` (`id`),
  ADD CONSTRAINT `id_kpi_meta` FOREIGN KEY (`id_kpi_meta`) REFERENCES `kpi_meta` (`id`);

--
-- Ketidakleluasaan untuk tabel `h_akhir`
--
ALTER TABLE `h_akhir`
  ADD CONSTRAINT `id_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`);

--
-- Ketidakleluasaan untuk tabel `kpi_meta`
--
ALTER TABLE `kpi_meta`
  ADD CONSTRAINT `id_kpi` FOREIGN KEY (`id_kpi`) REFERENCES `kpi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
