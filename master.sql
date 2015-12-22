-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 19 Nov 2015 pada 13.38
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `master`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id_module` int(255) NOT NULL AUTO_INCREMENT,
  `nama_module` varchar(255) NOT NULL,
  `icon_module` varchar(255) NOT NULL,
  `url_module` varchar(255) NOT NULL,
  `parent` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id_module`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data untuk tabel `module`
--

INSERT INTO `module` (`id_module`, `nama_module`, `icon_module`, `url_module`, `parent`, `order`) VALUES
(4, 'Setting', 'wrench icon-white', '', '', 2),
(5, 'Master', 'hdd icon-white', '', '', 3),
(6, 'User', '', 'pengaturan/user', '4', 1),
(7, 'Home', 'home icon-white', 'home', '0', 1),
(12, 'Laporan', 'book icon-white', '#', '', 5),
(16, 'Module', '', 'pengaturan/module', '4', 2),
(18, 'Manajemen', 'play-circle icon-white', '', '', 4),
(19, 'User Level & Akses', '', 'pengaturan/user_level', '4', 3),
(21, 'Keluar', '', 'login/logout', '20', 1),
(27, 'User Profile', '', 'pengaturan/profil', '4', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL,
  `id_level` smallint(2) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_level` (`id_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `status`, `id_level`) VALUES
(1, 'superadmin', '6d1ce7aa0a1d988dc96a2abcd187b45a', 'aktif', 1),
(5, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'aktif', 11),
(6, 'nyobi', '70c5a7cebf7f4b90afeb5b48e3c0b5df', 'aktif', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_akses`
--

CREATE TABLE IF NOT EXISTS `user_akses` (
  `id_level` smallint(2) NOT NULL,
  `id_module` int(255) NOT NULL,
  UNIQUE KEY `id_level_2` (`id_level`,`id_module`),
  KEY `id_level` (`id_level`),
  KEY `id_modul` (`id_module`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_akses`
--

INSERT INTO `user_akses` (`id_level`, `id_module`) VALUES
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 12),
(1, 16),
(1, 18),
(1, 19),
(1, 21),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(11, 4),
(11, 5),
(11, 6),
(11, 7),
(11, 12),
(11, 18),
(11, 21),
(11, 27),
(11, 28),
(11, 29),
(11, 30),
(11, 31),
(11, 32),
(11, 33),
(11, 34),
(11, 35),
(11, 36),
(11, 37),
(11, 38),
(11, 39),
(11, 40),
(11, 41),
(11, 42),
(11, 43),
(11, 44),
(13, 7),
(13, 18),
(13, 21),
(13, 35),
(13, 37),
(13, 44),
(14, 12),
(14, 16),
(14, 21),
(14, 39),
(14, 40),
(14, 41),
(14, 42),
(14, 43);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_level`
--

CREATE TABLE IF NOT EXISTS `user_level` (
  `id_level` smallint(2) NOT NULL AUTO_INCREMENT,
  `level` varchar(255) NOT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data untuk tabel `user_level`
--

INSERT INTO `user_level` (`id_level`, `level`) VALUES
(1, 'Superadmin'),
(11, 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
