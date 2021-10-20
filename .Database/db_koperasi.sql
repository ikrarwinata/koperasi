-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Okt 2021 pada 01.09
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
-- Database: `db_koperasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ambil_simpanan`
--

CREATE TABLE `ambil_simpanan` (
  `id_ambilsimpanan` int(11) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `saldo` bigint(15) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` bigint(15) NOT NULL,
  `timestamps` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cicilan`
--

CREATE TABLE `cicilan` (
  `id_cicilan` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `id_jenissimpanpinjam` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jml_pinjaman` bigint(15) NOT NULL,
  `lama_angsuran` int(11) NOT NULL,
  `angsuran_ke` int(11) NOT NULL,
  `total_bayar` bigint(15) NOT NULL,
  `sisa_pinjaman` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenissimpan_pinjam`
--

CREATE TABLE `jenissimpan_pinjam` (
  `id_jenissimpanpinjam` int(11) NOT NULL,
  `nasabah` enum('masyarakat','anggota') NOT NULL,
  `jenis` enum('simp_berjangka','simp_biasa') NOT NULL,
  `bunga_simpanan` int(3) NOT NULL,
  `bunga_pinjaman` int(3) NOT NULL,
  `denda_pinjaman` int(3) NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenissimpan_pinjam`
--

INSERT INTO `jenissimpan_pinjam` (`id_jenissimpanpinjam`, `nasabah`, `jenis`, `bunga_simpanan`, `bunga_pinjaman`, `denda_pinjaman`, `keterangan`) VALUES
(1, 'masyarakat', 'simp_berjangka', 1, 1, 3, 'a');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelola_nasabah`
--

CREATE TABLE `kelola_nasabah` (
  `id_nasabah` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `ttl` date NOT NULL,
  `jekel` enum('pria','wanita') NOT NULL,
  `agama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `pndidikan_terakhir` varchar(40) NOT NULL,
  `pekerjaan` varchar(40) NOT NULL,
  `id_jenissimpanpinjam` int(11) NOT NULL,
  `penghasilan_perbulan` bigint(15) NOT NULL,
  `foto_ktp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelola_nasabah`
--

INSERT INTO `kelola_nasabah` (`id_nasabah`, `username`, `nama`, `no_hp`, `ttl`, `jekel`, `agama`, `alamat`, `pndidikan_terakhir`, `pekerjaan`, `id_jenissimpanpinjam`, `penghasilan_perbulan`, `foto_ktp`) VALUES
(4, 'nasabah', 'nasabah', 'nasabah', '2021-09-29', 'pria', 'Islam', 'qwdqw', 'Sarjana', 'wiraswasta', 1, 123123, 'uploads/kelola_nasabah/1634603442_fbbb23a1bbc7fc5d4314.png'),
(5, 'nasabah2', 'nasabah2', 'nasabah2', '2021-09-28', 'pria', 'Islam', 'qwdqw', 'SMA', 'Pelajar/Mahasiswa', 1, 500000, 'uploads/kelola_nasabah/1634715436_1d6f236d26bf9287876f.png');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `saldo_nasabah`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `saldo_nasabah` (
`id_tambahsimpanan` int(11)
,`id_nasabah` int(11)
,`saldo` bigint(20)
,`tanggal` date
,`nominal` bigint(20)
,`jenis_transaksi` varchar(3)
,`timestamps` int(11)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tambah_pinjaman`
--

CREATE TABLE `tambah_pinjaman` (
  `id_pinjaman` int(11) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `id_jenissimpanpinjam` int(11) NOT NULL,
  `jumlah_pinjaman` bigint(15) NOT NULL,
  `sisa` bigint(15) NOT NULL DEFAULT 0,
  `lama_angsuran` int(11) NOT NULL,
  `total_angsuran` bigint(15) NOT NULL,
  `awal_pembayaran` date NOT NULL,
  `akhir_pembayaran` date NOT NULL,
  `jaminan` varchar(40) NOT NULL,
  `tgl_pencairan` date NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tambah_simpanan`
--

CREATE TABLE `tambah_simpanan` (
  `id_tambahsimpanan` int(11) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `saldo` bigint(15) NOT NULL,
  `id_jenissimpanpinjam` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` bigint(15) NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 0,
  `timestamps` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `hak_akses` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `hak_akses`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Administrator'),
(4, 'nasabah', '3021bbb509429dde8ad1fc522448d56c', 'nasabah', 'Nasabah'),
(5, 'admin2', 'c84258e9c39059a89ab77d846ddab909', 'admin2', 'Administrator'),
(6, 'nasabah2', '91f064115d30c3b3550e08da554264c7', 'nasabah2', 'Nasabah');

-- --------------------------------------------------------

--
-- Struktur untuk view `saldo_nasabah`
--
DROP TABLE IF EXISTS `saldo_nasabah`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `saldo_nasabah`  AS SELECT `tambah_simpanan`.`id_tambahsimpanan` AS `id_tambahsimpanan`, `tambah_simpanan`.`id_nasabah` AS `id_nasabah`, `tambah_simpanan`.`saldo` AS `saldo`, cast(`tambah_simpanan`.`tanggal` as date) AS `tanggal`, `tambah_simpanan`.`nominal` AS `nominal`, 'add' AS `jenis_transaksi`, `tambah_simpanan`.`timestamps` AS `timestamps` FROM `tambah_simpanan` WHERE `tambah_simpanan`.`valid` = 1 ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ambil_simpanan`
--
ALTER TABLE `ambil_simpanan`
  ADD PRIMARY KEY (`id_ambilsimpanan`);

--
-- Indeks untuk tabel `cicilan`
--
ALTER TABLE `cicilan`
  ADD PRIMARY KEY (`id_cicilan`);

--
-- Indeks untuk tabel `jenissimpan_pinjam`
--
ALTER TABLE `jenissimpan_pinjam`
  ADD PRIMARY KEY (`id_jenissimpanpinjam`);

--
-- Indeks untuk tabel `kelola_nasabah`
--
ALTER TABLE `kelola_nasabah`
  ADD PRIMARY KEY (`id_nasabah`);

--
-- Indeks untuk tabel `tambah_pinjaman`
--
ALTER TABLE `tambah_pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`);

--
-- Indeks untuk tabel `tambah_simpanan`
--
ALTER TABLE `tambah_simpanan`
  ADD PRIMARY KEY (`id_tambahsimpanan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ambil_simpanan`
--
ALTER TABLE `ambil_simpanan`
  MODIFY `id_ambilsimpanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `cicilan`
--
ALTER TABLE `cicilan`
  MODIFY `id_cicilan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenissimpan_pinjam`
--
ALTER TABLE `jenissimpan_pinjam`
  MODIFY `id_jenissimpanpinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kelola_nasabah`
--
ALTER TABLE `kelola_nasabah`
  MODIFY `id_nasabah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tambah_pinjaman`
--
ALTER TABLE `tambah_pinjaman`
  MODIFY `id_pinjaman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tambah_simpanan`
--
ALTER TABLE `tambah_simpanan`
  MODIFY `id_tambahsimpanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
