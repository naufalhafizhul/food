-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2022 at 05:39 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'anril', 'anril123', 'Anril Pratama');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Sayur Berkuah'),
(2, 'Osengan'),
(5, 'Ayam/Ikan');

-- --------------------------------------------------------

--
-- Table structure for table `mode_bayar`
--

CREATE TABLE `mode_bayar` (
  `id_mode` int(11) NOT NULL,
  `mode_bayar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mode_bayar`
--

INSERT INTO `mode_bayar` (`id_mode`, `mode_bayar`) VALUES
(1, 'Transfer Bank'),
(2, 'OVO'),
(3, 'Bayar Di Tempat');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(5) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Kelurahan Ratu Jaya', 7000),
(2, 'Kelurahan Pondok Jaya', 3000),
(3, 'Kelurahan Pondok Terong', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`) VALUES
(2, 'kiky@gmail.com', 'kiky123', 'muhammad Rizki', '08193322333'),
(3, 'anrilpratama@gmail.com', 'anril123', 'anrik', '08193388110'),
(4, 'afriza@gmail.com', 'afriza123', 'afriza', '08193388111');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(3, 24, 'Kiko', 'madiri', 12000, '0000-00-00', '20210715120657contoh.PNG'),
(4, 27, 'Ikan Kuning', 'madiri', 41500, '0000-00-00', '2021-07-15172752endog1.jpg'),
(5, 26, 'Sop Sayur', 'madiri', 34500, '2021-07-15', '2021-07-15172949Corrugated-Cartons.png'),
(6, 25, 'kiky', 'madiri', 55000, '2021-07-16', '20210716101825desain.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `mode_bayar` varchar(100) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `mode_bayar`, `alamat_pengiriman`, `status_pembelian`) VALUES
(1, 1, 1, '2021-07-11', 20000, '', '', 'pending'),
(18, 1, 2, '2021-07-14', 13500, '', '', 'pending'),
(19, 1, 1, '2021-07-14', 20500, '', '', 'pending'),
(20, 1, 1, '2021-07-14', 29000, 'OVO', '', 'pending'),
(21, 2, 3, '2021-07-15', 15500, 'Transfer Bank', 'JL. Raya Citayam', 'pending'),
(22, 2, 3, '2021-07-15', 15500, 'Transfer Bank', 'Jl. Pondok Kiki', 'pending'),
(23, 2, 1, '2021-07-15', 17000, 'Transfer Bank', 'citayam', 'pending'),
(24, 2, 2, '2021-07-15', 12000, 'Bayar Di Tempat', 'sdasd', 'pending'),
(25, 2, 1, '2021-07-15', 55000, 'OVO', 'citaya', 'Pesan Diterima'),
(26, 2, 2, '2021-07-15', 34500, 'OVO', 'fafa', 'Pesan Diterima'),
(27, 2, 1, '2021-07-15', 41500, 'Transfer Bank', 'ssatiya', 'Pesanan Diterima'),
(28, 2, 2, '2021-07-25', 13000, 'Transfer Bank', 'citayam', 'pending'),
(29, 2, 1, '2021-08-11', 10000, 'OVO', 'citayam', 'pending'),
(30, 2, 1, '2021-08-14', 10000, 'OVO', 'Depok2', 'pending'),
(31, 2, 3, '2021-08-16', 35000, 'OVO', 'cipayung', 'pending'),
(32, 2, 2, '2021-08-16', 26000, 'OVO', 'Depok3', 'pending'),
(33, 2, 3, '2021-08-16', 51000, 'Transfer Bank', 'depok3', 'pending'),
(34, 2, 2, '2021-08-16', 21000, 'Transfer Bank', 'depok4', 'pending'),
(35, 2, 3, '2021-09-04', 45000, 'Transfer Bank', 'Jl Raya citayam', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `subharga`) VALUES
(1, 1, 1, 12, 0),
(2, 1, 2, 1, 0),
(3, 16, 4, 1, 0),
(4, 16, 2, 1, 0),
(5, 16, 5, 1, 0),
(6, 17, 4, 1, 0),
(7, 17, 2, 1, 0),
(8, 18, 2, 1, 0),
(9, 18, 3, 1, 0),
(10, 19, 2, 1, 1500),
(11, 19, 4, 1, 12000),
(12, 20, 2, 2, 3000),
(13, 20, 3, 1, 9000),
(14, 20, 4, 1, 10000),
(15, 21, 2, 1, 1500),
(16, 21, 3, 1, 9000),
(17, 22, 2, 1, 1500),
(18, 22, 3, 1, 9000),
(19, 23, 4, 1, 10000),
(20, 24, 3, 1, 9000),
(21, 25, 5, 3, 30000),
(22, 25, 3, 2, 18000),
(23, 26, 3, 3, 27000),
(24, 26, 2, 3, 4500),
(25, 27, 2, 3, 4500),
(26, 27, 4, 3, 30000),
(27, 28, 4, 1, 10000),
(28, 29, 2, 2, 3000),
(29, 0, 3, 1, 9000),
(30, 0, 2, 1, 1500),
(31, 0, 3, 2, 18000),
(32, 0, 3, 2, 18000),
(33, 30, 2, 2, 3000),
(34, 31, 7, 2, 30000),
(35, 32, 7, 1, 15000),
(36, 32, 6, 1, 8000),
(37, 33, 7, 2, 30000),
(38, 33, 6, 2, 16000),
(39, 34, 6, 1, 8000),
(40, 34, 4, 1, 10000),
(41, 35, 2, 2, 30000),
(42, 35, 5, 1, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `des_produk` text NOT NULL,
  `stok_produk` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `foto_produk`, `des_produk`, `stok_produk`) VALUES
(2, 5, 'Gepuk Daging', 15000, '106031365_2744112932541139_6802449043900772305_n.jpg', 'Gepuk Daging diplih dari daging khas dalam yang dicampur dengan rempah bumbu dan parutan lengkuas.', 8),
(3, 5, 'Pesmol Tongkol', 5000, '106378506_314860809545151_3611344719635447977_n.jpg', 'Pesmol Tonkol dipilih dari ikan tongkol segar dicampur dengan bumbu kuning. Bumbu terdiri dari bawang putih, bawah merah,kunyit, kemiri dan jahe yang dihaluskan. Dimasak dengan cara bumbum yang di oseng terlebih dahulu.', 20),
(4, 2, 'Cah Kangkung', 10000, 'IMG-20210713-WA0006.jpg', 'Cah kangkung atau oseng kangkung dibuat dengan bumbu yang terdiri dari bawang putih, bawah merah, terasi, cabai dan irisan bawang bombay.', 5),
(5, 5, 'Tuna Asam Manis', 10000, 'IMG-20210713-WA0007.jpg', 'Terbuat Dari daging tuna filet segar yang dicampur dengan tempung terigu dan maizena. Diolah menggunakan saos tomat dan bawang bombay yang diiris.', 14),
(6, 2, 'Urap sayur', 10000, 'IMG-20210713-WA0010.jpg', 'Terbuat dari sayuran yang terdiri dari wortel, toge, kol dan kangkung. Dicampur dengan bumbu urap yang terdiri dari kelapa parut dan bumbu lainnya.', 10),
(7, 2, 'Mie Goreng', 10000, 'IMG-20210713-WA0014.jpg', 'Mie Goreng dcampur dengan sayuran sawi, baso sosis dan telur.', 10),
(8, 1, 'Gulai Daun Singkong', 10000, 'IMG-20210713-WA0031.jpg', 'Daun Sinkong yang direbus dicampur dengan santan, ditaburi ikan teri dan  bumbu lainnya', 10),
(9, 2, 'Oseng Daun dan bunga paya ', 10000, 'IMG-20210713-WA0021.jpg', 'Daun dan bunga paya direbus dicampur dengan bumbu yang dihaluskan di beri terasi bakar.', 10),
(10, 2, 'Ule Utek oncom', 8000, 'IMG-20210713-WA0025.jpg', 'Dibuat dari oncom merah yang dicampur dengan kemangi, serai, bumbum rajang, dibeli campuran cabe pedas.', 5),
(11, 5, 'Ayam Kecap Saus Tiram', 10000, 'IMG-20210713-WA0024.jpg', 'Diolah dari ayam, kecap, saos tiram, saos tomat dan bawang bombay.', 15),
(12, 5, 'Ikan Kembung Sambal', 10000, 'IMG-20210713-WA0026.jpg', 'Diolah dari ikan kembung banjar yang dicampur dengan bumbu cabai yang dihaluskan.', 10),
(13, 5, 'Cumi Asin Cabai Hijau', 15000, 'IMG-20210713-WA0019.jpg', 'Diolah dari cumi telur asin yang dicampur dengan bumbu yang diris dan taburan jagung pipil.', 10),
(14, 1, 'Sayur Asem', 10000, 'WhatsApp Image 2021-08-29 at 16.07.19.jpeg', 'Terdiri dari sayuran kacang panjang,melinjo,labu,pepaya dan kacang merah.', 10),
(15, 1, 'Gulai Kacang Panjang Tahu', 15000, 'WhatsApp Image 2021-08-29 at 16.07.54.jpeg', 'Terdiri dari kacang panjang, santan dan tahu.', 10),
(16, 2, 'Jengkol Balado', 15000, 'WhatsApp Image 2021-08-29 at 16.11.12.jpeg', 'Diolah dari jengkol yang digoreng dicampur dengan cabai dan bumbu yang dihaluskan.', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `mode_bayar`
--
ALTER TABLE `mode_bayar`
  ADD PRIMARY KEY (`id_mode`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mode_bayar`
--
ALTER TABLE `mode_bayar`
  MODIFY `id_mode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
