/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/ db_koperasi /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE db_koperasi;

DROP TABLE IF EXISTS ambil_simpanan;
CREATE TABLE `ambil_simpanan` (
  `id_ambilsimpanan` int(11) NOT NULL AUTO_INCREMENT,
  `id_nasabah` int(11) NOT NULL,
  `saldo` bigint(15) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` bigint(15) NOT NULL,
  PRIMARY KEY (`id_ambilsimpanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS cicilan;
CREATE TABLE `cicilan` (
  `id_cicilan` int(11) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `id_jenissimpanpinjam` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jml_pinjaman` bigint(15) NOT NULL,
  `lama_angsuran` int(11) NOT NULL,
  `angsuran_ke` int(11) NOT NULL,
  `total_bayar` bigint(15) NOT NULL,
  `sisa_pinjaman` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS jenissimpan_pinjam;
CREATE TABLE `jenissimpan_pinjam` (
  `Id_jenissimpanpinjam` int(11) NOT NULL AUTO_INCREMENT,
  `nasabah` enum('masyarakat','anggota') NOT NULL,
  `jenis` enum('simp_berjangka','simp_biasa') NOT NULL,
  `bunga_simpanan` int(3) NOT NULL,
  `bunga_pinjaman` int(3) NOT NULL,
  `denda_pinjaman` int(3) NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  PRIMARY KEY (`Id_jenissimpanpinjam`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS kelola_nasabah;
CREATE TABLE `kelola_nasabah` (
  `id_nasabah` int(11) NOT NULL AUTO_INCREMENT,
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
  `foto_ktp` text NOT NULL,
  PRIMARY KEY (`id_nasabah`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS tambah_pinjaman;
CREATE TABLE `tambah_pinjaman` (
  `id_pinjaman` int(11) NOT NULL AUTO_INCREMENT,
  `id_nasabah` int(11) NOT NULL,
  `id_jenissimpanpinjam` int(11) NOT NULL,
  `jumlah_pinjaman` bigint(15) NOT NULL,
  `lama_angsuran` int(11) NOT NULL,
  `total_angsuran` bigint(15) NOT NULL,
  `awal_pembayaran` date NOT NULL,
  `akhir_pembayaran` date NOT NULL,
  `jaminan` varchar(40) NOT NULL,
  `tgl_pencairan` date NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pinjaman`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS tambah_simpanan;
CREATE TABLE `tambah_simpanan` (
  `id_tambahsimpanan` int(11) NOT NULL AUTO_INCREMENT,
  `id_nasabah` int(11) NOT NULL,
  `saldo` bigint(15) NOT NULL,
  `id_jenissimpanpinjam` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` bigint(15) NOT NULL,
  PRIMARY KEY (`id_tambahsimpanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS user;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `Hak_akses` varchar(30) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





