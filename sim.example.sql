-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2024 at 02:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sim`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(150) DEFAULT NULL,
  `harga` int(50) DEFAULT NULL,
  `stok` int(50) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga`, `stok`, `keterangan`, `kategori`) VALUES
('BR001', 'Acer Aspire Lite AL14-31P ', 4500000, 1, 'Intel N100 512GB/8GB Pure Silver (Second Like New)', 'Laptop'),
('BR002', 'ASUS Vivobook A1404 14-inch', 4800000, 1, 'Intel Core i3-1215U with Intel UHD Graphics 256GB / 8GB (Second Like New)', 'Laptop'),
('BR003', 'Original Astro Vgen Flashdisk ', 50000, 25, '32GB Flash Disk USB Waterproof', 'Flashdisk'),
('BR004', 'Original Astro Vgen Flashdisk ', 90000, 25, '64GB Flash Disk USB Waterproof', 'Flashdisk'),
('BR005', 'Lenovo IdeaPad Slim 3i 14IAU7', 6250000, 1, 'Intel Core i3-1215U 512GB / 8GB Abyss Blue (Second Like New)', 'Laptop'),
('BR006', 'Keyboard Mtech Votre USB', 75000, 50, 'Keyboard USB', 'Keyboard'),
('BR007', 'Mouse Votre Kabel Optical Wired ', 25000, 50, 'Mouse Kabel', 'Mouse'),
('BR008', 'Xiaomi Monitor A24i FHD Display', 1500000, 20, '24 inch IPS 100Hz high refresh rate 99% sRGB', 'Monitor'),
('BR009', 'ASUS PC S3401SFF-I54110000T INTEL i5-9400 ', 10000000, 2, '4GB/1TB  GT710  Windows 10', 'PC');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` varchar(8) NOT NULL,
  `id_transaksi` varchar(8) NOT NULL,
  `id_barang` varchar(8) NOT NULL,
  `jumlah_beli` int(10) NOT NULL,
  `subtotal` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(8) NOT NULL,
  `nama` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`) VALUES
('KT001', 'Laptop'),
('KT002', 'PC'),
('KT003', 'Monitor'),
('KT004', 'Printer'),
('KT005', 'LCD'),
('KT006', 'Keyboard'),
('KT007', 'Mouse'),
('KT008', 'Flashdisk'),
('KT009', 'Hardisk'),
('KT010', 'Baterai');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(35) NOT NULL,
  `telpon` varchar(15) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` varchar(7) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `level`) VALUES
('U01', 'admin', 'admin', 'admin'),
('U02', 'manajer', 'manajer', 'manager'),
('U03', 'kasir', 'kasir', 'kasir');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(8) NOT NULL,
  `id_pelanggan` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `id_petugas` varchar(8) NOT NULL,
  `total` int(12) NOT NULL,
  `bayar` int(12) NOT NULL,
  `kembali` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
