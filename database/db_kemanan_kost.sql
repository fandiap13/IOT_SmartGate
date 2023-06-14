-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jun 2023 pada 07.10
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kemanan_kost`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota_kost`
--

CREATE TABLE `anggota_kost` (
  `id` int(11) NOT NULL,
  `rfid_code` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anggota_kost`
--

INSERT INTO `anggota_kost` (`id`, `rfid_code`, `nama`) VALUES
(1, '12345', 'fandi aziz pratama');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masuk_kost`
--

CREATE TABLE `masuk_kost` (
  `id` int(11) NOT NULL,
  `anggotaid` int(11) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `masuk_kost`
--

INSERT INTO `masuk_kost` (`id`, `anggotaid`, `tanggal`) VALUES
(1, 1, '2023-05-20 07:51:48'),
(2, 1, '2023-05-20 14:01:10'),
(3, 1, '2023-05-20 17:43:37');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota_kost`
--
ALTER TABLE `anggota_kost`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `masuk_kost`
--
ALTER TABLE `masuk_kost`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota_kost`
--
ALTER TABLE `anggota_kost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `masuk_kost`
--
ALTER TABLE `masuk_kost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
