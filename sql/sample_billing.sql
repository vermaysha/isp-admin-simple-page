-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2022 at 01:46 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sample_billing`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `username` varchar(50) NOT NULL,
  `id_reseller` varchar(50) NOT NULL,
  `nama_client` varchar(50) NOT NULL,
  `alamat_client` varchar(50) NOT NULL,
  `no_wa_client` varchar(50) NOT NULL,
  `paket_client` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`username`, `id_reseller`, `nama_client`, `alamat_client`, `no_wa_client`, `paket_client`) VALUES
('cra1', 'resellerA', 'Client reseller A 1', 'Jl Mangga Dua Raya Pus Grosir Mangga Dua Bl', '+628987654321', 10),
('crA10', 'resellerA', 'Client Reseller A 10', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 10),
('crA11', 'resellerA', 'Client Reseller A 11', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 30),
('cra2', 'resellerA', 'Client reseller A 2', 'Jl Pemuda 3 D, Sumatera Barat', '+628987654321', 20),
('cra3', 'resellerA', 'Client reseller A 3', 'Jl Margomulyo Industri I/14, Jawa Timur', '+628987654321', 30),
('cra4', 'resellerA', 'Client reseller A 4', 'Jl Tuwowo Rejo VI/31, Jawa Timur', '+628987654321', 50),
('cra5', 'resellerA', 'Client reseller A 5', 'Alam Sutera, Pakulonan, Serpong, Tanggerang Selata', '+628987654321', 100),
('crA6', 'resellerA', 'Client Reseller A 6', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 20),
('crA7', 'resellerA', 'Client Reseller A 7', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 20),
('crA8', 'resellerA', 'Client Reseller A 8', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 10),
('crA9', 'resellerA', 'Client Reseller A 9', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 10),
('crb1', 'resellerB', 'Client reseller B 1', 'Jl Salemba Raya 41, Dki Jakarta', '+62875432123', 20),
('crB10', 'resellerB', 'Client Reseller B 10', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 20),
('crB11', 'resellerB', 'Client Reseller B 11', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 20),
('crB12', 'resellerB', 'Client Reseller B 12', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 30),
('crb2', 'resellerB', 'Client reseller B 2', 'Jl Kom L Yos Sudarso 39, Sumatera Utara', '+628765456787654', 50),
('crb3', 'resellerB', 'Client reseller B 3', 'Jl Wastukencana 51, Jawa Barat', '+628765345643', 100),
('crb4', 'resellerB', 'Client reseller B 4', 'Jl Pulau Alor 10, Bali', '+6287654345678', 20),
('crb5', 'resellerB', 'Client reseller B 5', 'Jl Anggrek Cendrawasih XI 28, Dki Jakarta', '+62876787654345', 30),
('crB6', 'resellerB', 'Client Reseller B 6', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 10),
('crB7', 'resellerB', 'Client Reseller B 7', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 10),
('crB8', 'resellerB', 'Client Reseller B 8', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 10),
('crB9', 'resellerB', 'Client Reseller B 9', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 20),
('crc1', 'resellerC', 'Client reseller C 1', 'Jl Letjen Suprapto Graha Cempaka Mas Bl D/12 A, Dk', '+6298787656234', 10),
('crC10', 'resellerC', 'Client Reseller C 10', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 10),
('crC11', 'resellerC', 'Client Reseller C 11', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 10),
('crC12', 'resellerC', 'Client Reseller C 12', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 15),
('crC13', 'resellerC', 'Client Reseller C 13', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 15),
('crc2', 'resellerC', 'Client reseller C 2', 'Jl KH Samanhudi Metro Atom Plaza Bl AKS 1/11, Dki ', '+6298785434523456', 5),
('crc3', 'resellerC', 'Client reseller C 3', 'Jl Wastukencana 51, Jawa Barat', '+6298976564348', 20),
('crc4', 'resellerC', 'Client reseller C 4', 'Jl Pulau Alor 10, Bali', '+6287874564567', 15),
('crc5', 'resellerC', 'Client reseller C 5', 'Jl Anggrek Cendrawasih XI 28, Dki Jakarta', '+628182837635453', 10),
('crC6', 'resellerC', 'Client Reseller C 6', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 5),
('crC7', 'resellerC', 'Client Reseller C 7', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 5),
('crC8', 'resellerC', 'Client Reseller C 8', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 5),
('crC9', 'resellerC', 'Client Reseller C 9', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 10),
('crD1', 'resellerD', 'Client Reseller D 1', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 10),
('crD10', 'resellerD', 'Client Reseller D 10', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 30),
('crD11', 'resellerD', 'Client Reseller D 11', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 20),
('crD2', 'resellerD', 'Client Reseller D 2', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 10),
('crD3', 'resellerD', 'Client Reseller D 3', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 15),
('crD4', 'resellerD', 'Client Reseller D 4', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 5),
('crD5', 'resellerD', 'Client Reseller D 5', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 10),
('crD6', 'resellerD', 'Client Reseller D 6', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 10),
('crD7', 'resellerD', 'Client Reseller D 7', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 10),
('crD8', 'resellerD', 'Client Reseller D 8', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 15),
('crD9', 'resellerD', 'Client Reseller D 9', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 20),
('crE1', 'resellerE', 'Client Reseller E 1', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 5),
('crE10', 'resellerE', 'Client Reseller E 10', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 15),
('crE11', 'resellerE', 'Client Reseller E 11', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 20),
('crE12', 'resellerE', 'Client Reseller E 12', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 20),
('crE13', 'resellerE', 'Client Reseller E 13', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 20),
('crE14', 'resellerE', 'Client Reseller E 14', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 20),
('crE15', 'resellerE', 'Client Reseller E 15', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 20),
('crE2', 'resellerE', 'Client Reseller E 2', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 5),
('crE3', 'resellerE', 'Client Reseller E 3', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 5),
('crE4', 'resellerE', 'Client Reseller E 4', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 10),
('crE5', 'resellerE', 'Client Reseller E 5', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 10),
('crE6', 'resellerE', 'Client Reseller E 6', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 10),
('crE7', 'resellerE', 'Client Reseller E 7', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 15),
('crE8', 'resellerE', 'Client Reseller E 8', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 15),
('crE9', 'resellerE', 'Client Reseller E 9', 'Jl P Jayakarta 141, Dki Jakarta', '+62883267426572', 15);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(15) NOT NULL,
  `parent` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `level`, `parent`) VALUES
('admin', '123', 'admin', ''),
('cra1', '123', 'client', 'resellerA'),
('crA10', '123', 'client', 'resellerA'),
('crA11', '123', 'client', 'resellerA'),
('cra2', '123', 'client', 'resellerA'),
('cra3', '123', 'client', 'resellerA'),
('cra4', '123', 'client', 'resellerA'),
('cra5', '123', 'client', 'resellerA'),
('crA6', '123', 'client', 'resellerA'),
('crA7', '123', 'client', 'resellerA'),
('crA8', '123', 'client', 'resellerA'),
('crA9', '123', 'client', 'resellerA'),
('crb1', '123', 'client', 'resellerB'),
('crB10', '123', 'client', 'resellerB'),
('crB11', '123', 'client', 'resellerB'),
('crB12', '123', 'client', 'resellerB'),
('crb2', '123', 'client', 'resellerB'),
('crb3', '123', 'client', 'resellerB'),
('crb4', '123', 'client', 'resellerB'),
('crb5', '123', 'client', 'resellerB'),
('crB6', '123', 'client', 'resellerB'),
('crB7', '123', 'client', 'resellerB'),
('crB8', '123', 'client', 'resellerB'),
('crB9', '123', 'client', 'resellerB'),
('crc1', '123', 'client', 'resellerC'),
('crC10', '123', 'client', 'resellerC'),
('crC11', '123', 'client', 'resellerC'),
('crC12', '123', 'client', 'resellerC'),
('crC13', '123', 'client', 'resellerC'),
('crc2', '123', 'client', 'resellerC'),
('crc3', '123', 'client', 'resellerC'),
('crc4', '123', 'client', 'resellerC'),
('crc5', '123', 'client', 'resellerC'),
('crC6', '123', 'client', 'resellerC'),
('crC7', '123', 'client', 'resellerC'),
('crC8', '123', 'client', 'resellerC'),
('crC9', '123', 'client', 'resellerC'),
('crD1', '123', 'client', 'resellerD'),
('crD10', '123', 'client', 'resellerD'),
('crD11', '123', 'client', 'resellerD'),
('crD2', '123', 'client', 'resellerD'),
('crD3', '123', 'client', 'resellerD'),
('crD4', '123', 'client', 'resellerD'),
('crD5', '123', 'client', 'resellerD'),
('crD6', '123', 'client', 'resellerD'),
('crD7', '123', 'client', 'resellerD'),
('crD8', '123', 'client', 'resellerD'),
('crD9', '123', 'client', 'resellerD'),
('crE1', '123', 'client', 'resellerE'),
('crE10', '123', 'client', 'resellerE'),
('crE11', '123', 'client', 'resellerE'),
('crE12', '123', 'client', 'resellerE'),
('crE13', '123', 'client', 'resellerE'),
('crE14', '123', 'client', 'resellerE'),
('crE15', '123', 'client', 'resellerE'),
('crE2', '123', 'client', 'resellerE'),
('crE3', '123', 'client', 'resellerE'),
('crE4', '123', 'client', 'resellerE'),
('crE5', '123', 'client', 'resellerE'),
('crE6', '123', 'client', 'resellerE'),
('crE7', '123', 'client', 'resellerE'),
('crE8', '123', 'client', 'resellerE'),
('crE9', '123', 'client', 'resellerE'),
('resellerA', '123', 'reseller', ''),
('resellerB', '123', 'reseller', ''),
('resellerC', '123', 'reseller', ''),
('resellerD', '123', 'reseller', ''),
('resellerE', '123', 'reseller', '');

-- --------------------------------------------------------

--
-- Table structure for table `paket_reseller`
--

CREATE TABLE `paket_reseller` (
  `id_paket` int(20) NOT NULL,
  `id_reseller` varchar(50) NOT NULL,
  `paket` int(5) NOT NULL,
  `harga` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket_reseller`
--

INSERT INTO `paket_reseller` (`id_paket`, `id_reseller`, `paket`, `harga`) VALUES
(45, 'resellerA', 10, 100000),
(46, 'resellerA', 20, 200000),
(47, 'resellerA', 30, 300000),
(48, 'resellerA', 50, 500000),
(49, 'resellerA', 100, 1000000),
(50, 'resellerB', 10, 200000),
(51, 'resellerB', 20, 300000),
(52, 'resellerB', 30, 400000),
(53, 'resellerB', 50, 500000),
(54, 'resellerB', 100, 800000),
(55, 'resellerC', 5, 100000),
(56, 'resellerC', 10, 150000),
(57, 'resellerC', 15, 200000),
(58, 'resellerC', 20, 250000),
(59, 'resellerC', 30, 330000),
(60, 'resellerC', 50, 450000),
(61, 'resellerD', 5, 150000),
(62, 'resellerD', 10, 200000),
(63, 'resellerD', 15, 250000),
(64, 'resellerD', 30, 3000000),
(65, 'resellerD', 20, 200000),
(66, 'resellerE', 5, 50000),
(67, 'resellerE', 10, 100000),
(68, 'resellerE', 15, 150000),
(69, 'resellerE', 20, 200000),
(70, 'resellerE', 25, 250000),
(71, 'resellerE', 30, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `reseller`
--

CREATE TABLE `reseller` (
  `id_reseller` int(25) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_instansi` varchar(50) NOT NULL,
  `nama_pemilik` varchar(50) NOT NULL,
  `email_reseller` varchar(50) NOT NULL,
  `alamat_instansi` varchar(225) NOT NULL,
  `no_wa_reseller` varchar(50) NOT NULL,
  `tanggal_pembayaran_bulanan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reseller`
--

INSERT INTO `reseller` (`id_reseller`, `username`, `nama_instansi`, `nama_pemilik`, `email_reseller`, `alamat_instansi`, `no_wa_reseller`, `tanggal_pembayaran_bulanan`) VALUES
(36, 'resellerA', 'Instansi A', 'Reseller A', 'resellerA@instansiA.net', 'Jl H Nawi Raya 21, Dki Jakarta', '8123456789', '0000-00-00'),
(37, 'resellerB', 'Instansi B', 'Reseller B', 'resellerB@instansiB.net', 'Jl Bukit Barisan Dlm 3, Sumatera Utara, 20111, Medan', '8123456789', '0000-00-00'),
(38, 'resellerC', 'Instansi C', 'Reseller C', 'resellerC@instansiC.net', 'Jl Jelambar Brt III 2 CC, Dki Jakarta', '8123456789', '0000-00-00'),
(39, 'resellerD', 'Instansi D', 'Reseller D', 'resellerD@instansiD.net', 'Jl Cempaka 67 A, Jawa Tengah', '812345678', '0000-00-00'),
(40, 'resellerE', 'Instansi E', 'Reseller E', 'resellerE@instansiE.net', 'Jl Kramat Raya 176 Kenari, Dki Jakarta', '8123456789', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pembayaran`
--

CREATE TABLE `riwayat_pembayaran` (
  `id_pembayaran` int(25) NOT NULL,
  `id_reseller` varchar(50) NOT NULL,
  `username_client` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `status_pembayaran` enum('Belum','Lunas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_pembayaran`
--

INSERT INTO `riwayat_pembayaran` (`id_pembayaran`, `id_reseller`, `username_client`, `tanggal`, `status_pembayaran`) VALUES
(44, 'resellerA', 'cra1', '0000-00-00', 'Lunas'),
(45, 'resellerA', 'cra2', '0000-00-00', 'Belum'),
(46, 'resellerA', 'cra3', '0000-00-00', 'Lunas'),
(47, 'resellerA', 'cra4', '0000-00-00', 'Belum'),
(48, 'resellerA', 'cra5', '0000-00-00', 'Lunas'),
(49, 'resellerB', 'crb1', '0000-00-00', 'Belum'),
(50, 'resellerB', 'crb2', '0000-00-00', 'Belum'),
(51, 'resellerB', 'crb3', '0000-00-00', 'Belum'),
(52, 'resellerB', 'crb4', '0000-00-00', 'Belum'),
(53, 'resellerB', 'crb5', '0000-00-00', 'Belum'),
(54, 'resellerC', 'crc1', '0000-00-00', 'Belum'),
(55, 'resellerC', 'crc2', '0000-00-00', 'Belum'),
(56, 'resellerC', 'crc3', '0000-00-00', 'Belum'),
(57, 'resellerC', 'crc4', '0000-00-00', 'Belum'),
(58, 'resellerC', 'crc5', '0000-00-00', 'Belum'),
(59, 'resellerD', 'crD1', '0000-00-00', 'Belum'),
(60, 'resellerD', 'crD2', '0000-00-00', 'Belum'),
(61, 'resellerD', 'crD3', '0000-00-00', 'Belum'),
(62, 'resellerD', 'crD4', '0000-00-00', 'Belum'),
(63, 'resellerD', 'crD5', '0000-00-00', 'Belum'),
(64, 'resellerD', 'crD6', '0000-00-00', 'Belum'),
(65, 'resellerD', 'crD7', '0000-00-00', 'Belum'),
(66, 'resellerD', 'crD8', '0000-00-00', 'Belum'),
(67, 'resellerD', 'crD9', '0000-00-00', 'Belum'),
(68, 'resellerD', 'crD10', '0000-00-00', 'Belum'),
(69, 'resellerD', 'crD11', '0000-00-00', 'Belum'),
(70, 'resellerE', 'crE1', '0000-00-00', 'Belum'),
(71, 'resellerE', 'crE2', '0000-00-00', 'Belum'),
(72, 'resellerE', 'crE3', '0000-00-00', 'Belum'),
(73, 'resellerE', 'crE4', '0000-00-00', 'Belum'),
(74, 'resellerE', 'crE5', '0000-00-00', 'Belum'),
(75, 'resellerE', 'crE6', '0000-00-00', 'Belum'),
(76, 'resellerE', 'crE7', '0000-00-00', 'Belum'),
(77, 'resellerE', 'crE8', '0000-00-00', 'Belum'),
(78, 'resellerE', 'crE9', '0000-00-00', 'Belum'),
(79, 'resellerE', 'crE10', '0000-00-00', 'Belum'),
(80, 'resellerE', 'crE11', '0000-00-00', 'Belum'),
(81, 'resellerE', 'crE12', '0000-00-00', 'Belum'),
(82, 'resellerE', 'crE13', '0000-00-00', 'Belum'),
(83, 'resellerE', 'crE14', '0000-00-00', 'Belum'),
(84, 'resellerE', 'crE15', '0000-00-00', 'Belum'),
(85, 'resellerA', 'crA6', '0000-00-00', 'Belum'),
(86, 'resellerA', 'crA7', '0000-00-00', 'Belum'),
(87, 'resellerA', 'crA8', '0000-00-00', 'Belum'),
(88, 'resellerA', 'crA9', '0000-00-00', 'Belum'),
(89, 'resellerA', 'crA10', '0000-00-00', 'Belum'),
(90, 'resellerA', 'crA11', '0000-00-00', 'Belum'),
(91, 'resellerB', 'crB6', '0000-00-00', 'Belum'),
(92, 'resellerB', 'crB7', '0000-00-00', 'Belum'),
(93, 'resellerB', 'crB8', '0000-00-00', 'Belum'),
(94, 'resellerB', 'crB9', '0000-00-00', 'Belum'),
(95, 'resellerB', 'crB10', '0000-00-00', 'Belum'),
(96, 'resellerB', 'crB11', '0000-00-00', 'Belum'),
(97, 'resellerB', 'crB12', '0000-00-00', 'Belum'),
(98, 'resellerC', 'crC6', '0000-00-00', 'Belum'),
(99, 'resellerC', 'crC7', '0000-00-00', 'Belum'),
(100, 'resellerC', 'crC8', '0000-00-00', 'Belum'),
(101, 'resellerC', 'crC9', '0000-00-00', 'Belum'),
(102, 'resellerC', 'crC10', '0000-00-00', 'Belum'),
(103, 'resellerC', 'crC11', '0000-00-00', 'Belum'),
(104, 'resellerC', 'crC12', '0000-00-00', 'Belum'),
(105, 'resellerC', 'crC13', '0000-00-00', 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_tagihan`
--

CREATE TABLE `riwayat_tagihan` (
  `id_tagihan` int(25) NOT NULL,
  `id_reseller` varchar(50) NOT NULL,
  `id_client` varchar(50) NOT NULL,
  `paket` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `tanggal_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_tagihan`
--

INSERT INTO `riwayat_tagihan` (`id_tagihan`, `id_reseller`, `id_client`, `paket`, `harga`, `tanggal_bayar`) VALUES
(52, 'resellerA', 'cra3', '30', '300000', '2022-12-26'),
(53, 'resellerA', 'cra5', '100', '1000000', '2022-12-26'),
(54, 'resellerA', 'cra1', '10', '100000', '2022-12-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `paket_reseller`
--
ALTER TABLE `paket_reseller`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `reseller`
--
ALTER TABLE `reseller`
  ADD PRIMARY KEY (`id_reseller`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `riwayat_pembayaran`
--
ALTER TABLE `riwayat_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `riwayat_tagihan`
--
ALTER TABLE `riwayat_tagihan`
  ADD PRIMARY KEY (`id_tagihan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `paket_reseller`
--
ALTER TABLE `paket_reseller`
  MODIFY `id_paket` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `reseller`
--
ALTER TABLE `reseller`
  MODIFY `id_reseller` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `riwayat_pembayaran`
--
ALTER TABLE `riwayat_pembayaran`
  MODIFY `id_pembayaran` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `riwayat_tagihan`
--
ALTER TABLE `riwayat_tagihan`
  MODIFY `id_tagihan` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
