-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jul 2023 pada 13.37
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
-- Database: `sistem_kompensasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$R4kVi3wSRhNp83PZJ3BxyuTt8inCt7cyI5fZN/PqBDVmK7pv1NTO.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kompensasi`
--

CREATE TABLE `kompensasi` (
  `id` int(11) NOT NULL,
  `id_pengawas` int(11) NOT NULL,
  `kegiatan` varchar(255) DEFAULT NULL,
  `nim` varchar(20) NOT NULL,
  `jam` time NOT NULL,
  `tanggal` date NOT NULL,
  `validasi` enum('Belum Diperiksa','Valid','Tidak Valid') NOT NULL,
  `status` enum('Belum Diperiksa','Diterima','Ditolak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `kompensasi`
--

INSERT INTO `kompensasi` (`id`, `id_pengawas`, `kegiatan`, `nim`, `jam`, `tanggal`, `validasi`, `status`) VALUES
(3, 2, 'Angkat Barang', 'C030322063', '20:24:00', '2023-07-17', 'Belum Diperiksa', 'Belum Diperiksa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `semester` int(11) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `username_pengawas` varchar(255) DEFAULT NULL,
  `jumlah_alpha` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `username`, `nim`, `password`, `nama`, `jenis_kelamin`, `jurusan`, `prodi`, `semester`, `kelas`, `nohp`, `username_pengawas`, `jumlah_alpha`) VALUES
(1, 'riko', '3102321', '$2y$10$4pQYDBtcUGWVCjs88CHjt.whhmdGCObAVyP/Htiv6H03TmqymSYoG', 'Riko Putra', 'Laki-laki', 'Teknik Elektro', 'Program STudi Contoh', 5, '4C', '0812234123', 'rikia', 8),
(2, 'aldi', 'C030322063', '$2y$10$xJIHmPY5IuC6WhBVzhCWqe9Bw0oBMAinW6IZrIDwsFs8CvDlyZtNi', 'Aldi Randera', 'Laki-laki', 'Teknik Elektro', 'Teknik Informatika', 2, '2B', '08965758488', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengawas`
--

CREATE TABLE `pengawas` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_wa` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `pengawas`
--

INSERT INTO `pengawas` (`id`, `username`, `password`, `nama`, `no_wa`) VALUES
(1, 'rikia', '$2y$10$1uRr/fmKlNbd3zvj4m.UTeGbVC1wDSD6p4vqPiGGq9pyQeWmaggEW', 'Adit', '089912312412'),
(2, 'novi', '$2y$10$J1hc3MgWR58zbxgJBuK4Q.H/Q3GLtArE18u0lYLhcqfhf89vtgpRe', 'Novia Aldera', '08948495993'),
(3, 'reno', '$2y$10$o1Ta9e0IXJauV93sSvEA7e17mubrIZx5NJvRxXskp7tD1v752t4Ou', 'Reno Wijaya', '089575647473');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kompensasi`
--
ALTER TABLE `kompensasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengawas`
--
ALTER TABLE `pengawas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kompensasi`
--
ALTER TABLE `kompensasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengawas`
--
ALTER TABLE `pengawas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
