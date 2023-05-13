-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2023 at 04:23 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id`, `nama`) VALUES
(8, 'Women'),
(9, 'Accessories'),
(10, 'Men');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nama_pemesan` varchar(45) DEFAULT NULL,
  `alamat_pemesan` varchar(255) DEFAULT NULL,
  `no_hp` varchar(25) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `jumlah_pesanan` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `produk_id`, `tanggal`, `nama_pemesan`, `alamat_pemesan`, `no_hp`, `email`, `jumlah_pesanan`, `deskripsi`) VALUES
(20, 24, '2023-05-13', 'Fulan Logan', 'Flower 91', '087775551116', 'sdjngflsfgn@gmail.com', 1, 'Diharapkan bertanya di fitur chat untuk barang ready stoknya, Karena Barang tiap hari Update --'),
(21, 25, '2023-05-12', 'Full Moon', 'Gas 41', '0899771634182', 'skip@gmail.com', 3, 'The collapse plugin supports horizontal collapsing. Add the .collapse-horizontal modifier class to transition the width instead of height and set a width on the immediate child element.');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kategori_produk_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `ketersediaan_stok` enum('habis','tersedia') DEFAULT 'tersedia',
  `harga_jual` double DEFAULT NULL,
  `harga_beli` double DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `min_stok` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kategori_produk_id`, `nama`, `harga`, `foto`, `detail`, `ketersediaan_stok`, `harga_jual`, `harga_beli`, `stok`, `min_stok`, `deskripsi`) VALUES
(24, 10, 'Sportstyle Air RIVEIGN AMB Sepatu Sneakers Pria Cassual Shoes', 79000, 'cLflaebMFxXxWtOHttiU.png', 'Sneakers Soft Bottom Riveign Sportstyle\r\nPola: warna solid\r\nBahan atas: kanvas lainnya\r\nBentuk tumit: lainnya\r\nTinggi tumit: tumit rendah (1-3CM)\r\nFungsi: berpori, tahan aus lainnya\r\nGaya: santai\r\nBerat kotor: 0.5Kg\r\nBahan sol: karet\r\nElemen populer: Totem benang jahit\r\nGaya: tren remaja                     ', 'tersedia', NULL, NULL, NULL, NULL, NULL),
(25, 10, 'Sepatu Sneakers Pria Casual FREISTON Gaya Korea Import', 95000, 'doju9JbeogBGp3fbJnor.png', 'Cocok untuk olahraga: Umum\r\nGaya pemakaian: sepatu panjang\r\nUsia yang berlaku: Remaja (15-40 tahun)\r\nBantalan busa lembut menyediakan kenyamanan ringan\r\nMemadukan bahan yang ringan dan empuk\r\nFitur : Anti Slip Sol Rubbernya membuatnya tidak licin\r\nCocok Digunakan Untuk : Kuliah, Kerja, Traveling\r\nCocok Digunakan Dicuaca : Musim Panas Ready Size\r\nUkuran: 39, 40, 41, 42, 43\r\nFashion Element: Shallow', 'tersedia', NULL, NULL, NULL, NULL, NULL),
(26, 10, 'Sportstyle Air RIVEIGN AMB Sepatu Sneakers Pria Cassual Shoes', 89000, '2cwKQ7efEqnoRWGOQPxP.png', 'Sneakers Soft Bottom Riveign Sportstyle\r\nPola: warna solid\r\nBahan atas: kanvas lainnya\r\nBentuk tumit: lainnya\r\nTinggi tumit: tumit rendah (1-3CM)\r\nFungsi: berpori, tahan aus lainnya\r\nFitur : Anti Slip Sol Rubbernya membuatnya tidak licin\r\nCocok Digunakan Untuk : Kuliah, Kerja, Traveling\r\nCocok Digunakan Dicuaca : Musim Panas Ready Size\r\nUkuran: 39, 40, 41, 42, 43\r\nFashion Element: Shallow', 'tersedia', NULL, NULL, NULL, NULL, NULL),
(27, 10, 'Kaos Polos Vision Baju Oversize Pria Baju Polos Pria', 41900, 'Cj1Eofm4Y1d8vp8X3Dbw.png', 'KAOS OVERSIZE UNISEX\r\n(COWOK ATAU CEWEK)\r\n\r\nBaju Oversize \r\nBahan polister voxy \r\n(90 % polister ,10 % PE)\r\n\r\nPilihan Ukuran\r\nSize S : Lingkar dada 98cm Panjang 64cm\r\n\r\nSize M : Lingkar dada 102cm Panjang 66cm\r\n\r\nSize L : Lingkar dada 108cm Panjang 69cm \r\n\r\nSize XL : Lingkar dada 112cm Panjang 72cm\r\n\r\nSize XXL : Lingkar dada 118cm Panjang 75cm\r\n\r\nSize XXXL : Lingkar dada 128cm Panjang 77cm\r\n\r\nbagi yang ingin oversize model lengan panjang', 'tersedia', NULL, NULL, NULL, NULL, NULL),
(28, 10, 'Joger Training Sign sporty style gym running jogging hiking kerenn abiz kantong zipper / resleting', 61760, 'M4SbxcyABkIwaRywIGHf.png', 'Spesifikasi Produk :\r\n\r\n\r\n- Cocok Untuk Pria dan Wanita\r\n\r\n\r\n- Bahan : terry premium\r\n\r\nHangat Tebal dan Menyerap Keringat \r\n\r\n\r\n- Menggunakan Tali Pinggang\r\n\r\n\r\n- Ada Saku Kanan Kiri \r\n\r\n\r\nCELANA JOGGER PANTS PANJANG POLOS PRIA WANITA\r\n\r\n\r\n\r\nUkuran Produk :\r\n\r\n\r\n1. Ukuran M \r\n\r\n\r\n- Panjang celana: 90 cm\r\n\r\n\r\n- Lingkar pinggang: melar hingga -+ 94cm\r\n\r\n\r\n2. Ukuran L \r\n\r\n\r\n- Panjang celana: 92 cm\r\n\r\n\r\n- Lingkar pinggang: melar hingga -+ 102cm\r\n\r\n\r\n3. Ukuran XL \r\n\r\n\r\n- Panjang celana: 94 cm\r\n\r\n\r\n- Lingkar pinggang: melar hingga -+110cm\r\n\r\n\r\n4 Ukuran XXL\r\n\r\n\r\n-panjang celana 96cm\r\n\r\n\r\n-lingkar pinggang melar hingga -+115 cm\r\n\r\n\r\n\r\nPilihan Warna: \r\n\r\n\r\n- Hitam Garis Putih \r\n\r\n\r\n- Abu Tua Garis Hitam\r\n\r\n\r\n- Abu muda Garis Hitam\r\n\r\n\r\n- Navy Garis Putih\r\n\r\n\r\n\r\nCara Perawatan :\r\n\r\n\r\n- Gunakan detergen yang lembut\r\n\r\n\r\n- Jangan gunakan pemutih', 'tersedia', NULL, NULL, NULL, NULL, NULL),
(29, 8, 'baju atasan wanita terbaru CAMELA outer cardigan/ cardigan wanita/ outerweare/ atasan terbaru 2022/ tunik trend/ others/ outer/ cardigan / cardigan muslim wanita/cardigan muslim', 4500000, 'QTCXjLU95TwImEks53M5.png', 'informationBrand: ONLY \r\n\r\nShoulder: French collar\r\n\r\nDetail: Pure cotton\r\n\r\nFabrlc: Satin/lace/skin-friendly lining\r\n\r\nBack:Sexy back/shapeshifting\r\n\r\ninformationhickness index: Moderate\r\n\r\nsoftness index: soft\r\n\r\nelastic index: Micro play\r\n\r\nslim index: Repair the body\r\n', 'tersedia', NULL, NULL, NULL, NULL, NULL),
(30, 9, 'Topi Laken Fedora Import', 299643, 'H2GY0mYY9ShdFs94ODHo.png', 'Topi Laken fedora\r\nBahan: laken import 100%\r\nKwalitas no.1\r\n&quot; THE ROLLING HAT IS THE BEST&quot;\r\nsize: \r\nS: 56-57cm\r\nM: 58-59cm\r\nL: 60-61cm\r\nXL: 62-63cm\r\nSize diukur dari lingkar kepala\r\nStandart size M\r\n- untuk pemesanan mohon sertakan size nya\r\n- foto sudah real pitc', 'tersedia', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$9raD1Be89ijhligS1kQKSeFVfO1FHj50X1TM.QP/Ha9FdomCyGA/u');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk` (`produk_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama` (`nama`),
  ADD KEY `kategori_produk` (`kategori_produk_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `produk` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `kategori_produk` FOREIGN KEY (`kategori_produk_id`) REFERENCES `kategori_produk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
