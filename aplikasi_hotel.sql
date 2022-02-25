-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2022 at 09:53 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int(11) NOT NULL,
  `tipe_kamar` enum('superior','deluxe') NOT NULL,
  `fasilitas` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `tipe_kamar`, `fasilitas`, `gambar`, `deskripsi`, `harga`) VALUES
(1, 'superior', 'Kamar berukuran luas 32m²', 'Superior.jpg', 'Tipe kamar Superior berukuran 32m persegi.', '410000'),
(2, 'superior', 'Kamar mandi shower', 'kamar-mandi-shower.jpg', 'Kamar mandi tipe kamar Superior sudah menggunakan shower.', '410000'),
(3, 'superior', 'Saluran TV Premium', 'tv-premium.jpg', 'Jika Anda bingung ingin melakukan apa di hotel, Anda dapat menonton televisi sembari menikmati empuknya kasur yang disediakan.', '410000'),
(4, 'superior', 'Coffe maker', 'tea-coffee-maker.jpg', 'Kamar tipe Superior juga sudah dilengkapi dengan fasilitas Coffe Maker.', '410000'),
(5, 'superior', 'AC', 'ac.jpg', 'Tersedia AC.', '410000'),
(6, 'superior', 'LED TV 32 inch', 'tv-32inch.jpg', 'Sudah tersedia TV LED 32 inch.', '410000'),
(7, 'superior', 'Internet 4G', 'internet.jpg', 'Tersedia Wi-Fi kualitas 4G.', '410000'),
(8, 'superior', 'Kolam Renang 70m²', 'kolam-renang.jpg', 'kolam renang yang disediakan di hotel juga dirancang untuk menghabiskan waktu bersama keluarga.', '410000'),
(9, 'superior', 'Fasilitas Hotel Spa', 'spa.jpg', 'Memilih hotel dengan fasilitas spa adalah pilihan terbaik jika kamu ingin memanjakan badanmu.', '410000'),
(10, 'superior', 'Pusat Kebugaran', 'gym.jpg', 'Fasilitas gym yang ada di dalam Hotel Hebat dibangun khusus untuk tamu yang menginap di hotel.', '410000'),
(11, 'superior', 'Area Dilarang Merokok', 'no-smoking.jpg', 'Hotel menerapkan kontrak anti rokok sebagai saat check in yang akan membebankan denda besar jika pengunjung ketahuan merokok di dalam kamar.', '410000'),
(12, 'deluxe', 'Kamar berukuran luas 45m²', 'Deluxe.jpg', 'Tipe kamar Superior berukuran 45m persegi.', '450000'),
(13, 'deluxe', 'Kamar mandi shower dan bathtub', 'kamar-mandi-bathtub.jpg', 'Kamar mandi tipe kamar Superior sudah menggunakan shower dan juga sudah termasuk bathtub.', '450000'),
(14, 'deluxe', 'Saluran TV Premium', 'tv-premium.jpg', 'Jika Anda bingung ingin melakukan apa di hotel, Anda dapat menonton televisi sembari menikmati empuknya kasur yang disediakan.', '450000'),
(15, 'deluxe', 'Coffe maker', 'tea-coffee-maker.jpg', 'Kamar tipe Deluxe juga sudah dilengkapi dengan fasilitas Coffe Maker.', '450000'),
(16, 'deluxe', 'AC', 'ac.jpg', 'Tersedia AC.', '450000'),
(17, 'deluxe', 'LED TV 40 inch', 'tv-40inch.jpg', 'Sudah tersedia TV LED 40 inch.', '450000'),
(18, 'deluxe', 'Internet 5G', 'internet.jpg', 'Tersedia Wi-Fi kualitas 5G.', '450000'),
(19, 'deluxe', 'Sauna', 'sauna.jpg', 'Fasilitas yang digemari orang Jepang ini merupakan sebuah ruangan dengan suhu tinggi yang digunakan untuk membuat penggunanya berkeringat.', '450000'),
(20, 'deluxe', 'Kolam Renang 100m²', 'kolam-renang.jpg', 'kolam renang yang disediakan di hotel juga dirancang untuk menghabiskan waktu bersama keluarga.', '450000'),
(21, 'deluxe', 'Fasilitas Hotel Spa', 'spa.jpg', 'Memilih hotel dengan fasilitas spa adalah pilihan terbaik jika kamu ingin memanjakan badanmu.', '450000'),
(22, 'deluxe', 'Pusat Kebugaran', 'gym.jpg', 'Fasilitas gym yang ada di dalam Hotel Hebat dibangun khusus untuk tamu yang menginap di hotel.', '450000'),
(23, 'deluxe', 'Area Khusus Bebas Merokok', 'no-smoking.jpg', 'Hotel menerapkan kontrak anti rokok sebagai saat check in yang akan membebankan denda besar jika pengunjung ketahuan merokok di dalam kamar.', '450000');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `id` int(11) NOT NULL,
  `logo_primary` varchar(255) NOT NULL,
  `logo_secondary` varchar(255) NOT NULL,
  `nama_hotel` varchar(255) NOT NULL,
  `tentang` text NOT NULL,
  `no_rekening` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id`, `logo_primary`, `logo_secondary`, `nama_hotel`, `tentang`, `no_rekening`, `alamat`, `telp`, `email`) VALUES
(2, 'logo-primary.png', 'logo-white.png', 'Hotel Hebatt', 'dikelilingi oleh keindahan pegunungan yang indah, danau dan sawah menghijau. Nikmati                     sore yang hangat dengan berenang di kolam renang dengan pemandangan matahari terbenam yang memukau; Kid\'s Club yang luas                     - menawarkan beragam fasilitas dan kegiatan anak-anak yang akan melengkapi kenyamanan keluarga. Convention Center kami,                     dilengkapi pelayanan lengkap dengan ruang konvensi terbesar di Bandung, mampu mengakomodasi hingga 3.000 delegasi.                     Manfaatkan ruang penyelenggaraan konvensi M.I.C.E ataupun mewujudkan acara pernikahan adat yang mewah', '666-666-666-666', 'Jl. Siliwangi Blk. Kamun No.30, Liangjulang, Kec. Kadipaten, Kabupaten Majalengka, Jawa Barat 45452', '083809192185', 'admin@smkn1kadipaten.sch.id');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id` int(11) NOT NULL,
  `id_stok_kamar` int(11) DEFAULT NULL,
  `jenis_kamar` enum('superior','deluxe') NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `no_kamar` varchar(5) NOT NULL,
  `status` enum('tersedia','dipesan','terisi') NOT NULL,
  `tgl_pemesanan` datetime DEFAULT NULL,
  `tgl_check_out` date DEFAULT NULL,
  `tarif` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id`, `id_stok_kamar`, `jenis_kamar`, `gambar`, `no_kamar`, `status`, `tgl_pemesanan`, `tgl_check_out`, `tarif`) VALUES
(1, 1, 'superior', 'superior.jpg', '01', 'terisi', '2022-02-23 02:29:00', '2022-02-25', '410000'),
(2, 1, 'superior', 'superior.jpg', '02', 'terisi', '2022-02-23 02:29:00', '2022-02-25', '410000'),
(3, 1, 'superior', 'superior.jpg', '03', 'terisi', '2022-02-23 02:34:00', '2022-02-25', '410000'),
(4, 1, 'superior', 'superior.jpg', '04', 'tersedia', NULL, NULL, '410000'),
(5, 1, 'superior', 'superior.jpg', '05', 'tersedia', NULL, NULL, '410000'),
(6, 2, 'deluxe', 'deluxe.jpg', '06', 'terisi', '2022-02-23 02:28:00', '2022-02-25', '450000'),
(7, 2, 'deluxe', 'deluxe.jpg', '07', 'dipesan', '2022-02-23 02:27:00', '2022-02-28', '450000'),
(8, 2, 'deluxe', 'deluxe.jpg', '08', 'dipesan', '2022-02-23 02:27:00', '2022-02-28', '450000'),
(9, 2, 'deluxe', 'deluxe.jpg', '09', 'terisi', '2022-02-23 02:28:00', '2022-02-25', '450000'),
(10, 2, 'deluxe', 'deluxe.jpg', '10', 'dipesan', '2022-02-23 02:27:00', '2022-02-28', '450000'),
(19, 1, 'superior', 'Superior.jpg', '11', 'tersedia', NULL, NULL, '410000'),
(20, 2, 'deluxe', 'deluxe.jpg', '12', 'terisi', '2022-02-23 02:29:00', '2022-02-27', '450000'),
(21, 1, 'superior', 'superior.jpg', '13', 'tersedia', NULL, NULL, '410000'),
(22, 2, 'deluxe', 'deluxe.jpg', '14', 'terisi', '2022-02-23 02:28:00', '2022-02-25', '450000'),
(23, 1, 'superior', 'superior.jpg', '15', 'tersedia', NULL, NULL, '410000'),
(24, 2, 'deluxe', 'deluxe.jpg', '16', 'terisi', '2022-02-23 02:28:00', '2022-02-25', '450000'),
(25, 1, 'superior', 'superior.jpg', '17', 'tersedia', NULL, NULL, '410000'),
(26, 1, 'superior', 'superior.jpg', '18', 'tersedia', NULL, NULL, '410000'),
(27, 2, 'deluxe', 'deluxe.jpg', '19', 'terisi', '2022-02-23 02:28:00', '2022-02-26', '450000'),
(28, 2, 'deluxe', 'deluxe.jpg', '20', 'terisi', '2022-02-23 02:29:00', '2022-02-27', '450000'),
(29, 1, 'superior', 'superior.jpg', '21', 'tersedia', NULL, NULL, '410000'),
(30, 1, 'superior', 'superior.jpg', '22', 'tersedia', NULL, NULL, '410000'),
(31, 2, 'deluxe', 'deluxe.jpg', '23', 'terisi', '2022-02-23 02:28:00', '2022-02-26', '450000'),
(32, 2, 'deluxe', 'deluxe.jpg', '24', 'terisi', '2022-02-23 02:29:00', '2022-02-27', '450000');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `role` enum('admin','resepsionis') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `foto`, `nama`, `email`, `jenis_kelamin`, `username`, `password`, `telp`, `role`) VALUES
(1, 'default-laki-laki.png', 'Dimas Candraa', 'dimasbomz13@gmail.com', 'laki-laki', 'dimas', '8d23cf6c86e834a7aa6eded54c26ce2bb2e74903538c61bdd5d2197997ab2f72', '+6283809192165', 'admin'),
(7, 'default-perempuan.png', 'Sri Aminah', 'aminahsri092@gmail.com', 'perempuan', 'sri', '8d23cf6c86e834a7aa6eded54c26ce2bb2e74903538c61bdd5d2197997ab2f72', '+6283812923195', 'resepsionis');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `telp` varchar(14) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`, `email`, `status`, `username`, `password`, `foto`) VALUES
(14, 'Tiyas Frahesta', 'laki-laki', '97009098', 'Desa Kadipaten', 'tiiyas@gmail.com', '', 'tiiyas', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'default-laki-laki.png');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `tgl_pembayaran` varchar(255) NOT NULL,
  `nama_pembayar` varchar(255) NOT NULL,
  `bank` enum('Mandiri','BCA','BNI','BRI') NOT NULL,
  `no_rekening` varchar(15) NOT NULL,
  `nama_pemilik_kartu` varchar(255) NOT NULL,
  `total_akhir` varchar(25) NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_pemesanan`, `tgl_pembayaran`, `nama_pembayar`, `bank`, `no_rekening`, `nama_pemilik_kartu`, `total_akhir`, `bukti`) VALUES
(37, 114, '23 Februari 2022', 'Tiyas Frahesta', 'BCA', 'asdasd', 'asdasd', '1.800.000,00', '62153a06280e7.jpg'),
(38, 116, '23 Februari 2022', 'Tiyas Frahesta', 'Mandiri', '34567243', 'asdgfsdf', '4.050.000,00', '62153a4f24e8b.jpg'),
(39, 115, '23 Februari 2022', 'Tiyas Frahesta', 'Mandiri', '2312345435', 'asdfghbvnhfghtf', '1.800.000,00', '62153a700b795.jpg'),
(40, 117, '23 Februari 2022', 'Tiyas Frahesta', 'Mandiri', '12321', 'terdfgsdvfs', '820.000,00', '62153a8551664.jpg'),
(41, 119, '23 Februari 2022', 'Tiyas Frahesta', 'Mandiri', '5434234', 'fgdhesrnj', '410.000,00', '62153af4e289a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tgl_pemesanan` datetime NOT NULL,
  `tgl_cek_in` date NOT NULL,
  `tgl_cek_out` date NOT NULL,
  `tipe_kamar` enum('Superior','Deluxe') NOT NULL,
  `harga_permalam` varchar(30) NOT NULL,
  `jumlah_kamar` varchar(2) NOT NULL,
  `nama_pemesan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `durasi_menginap` varchar(10) NOT NULL,
  `total_biaya` varchar(25) NOT NULL,
  `status` enum('belum dibayar','batal','check out','pending','berhasil') NOT NULL,
  `batas_pembayaran` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `id_pelanggan`, `tgl_pemesanan`, `tgl_cek_in`, `tgl_cek_out`, `tipe_kamar`, `harga_permalam`, `jumlah_kamar`, `nama_pemesan`, `alamat`, `telp`, `durasi_menginap`, `total_biaya`, `status`, `batas_pembayaran`) VALUES
(113, 14, '2022-02-23 02:27:00', '2022-02-24', '2022-02-28', 'Deluxe', '450.000,00', '3', 'Tiyas Frahesta', 'Desa Kadipaten', '97009098', '4', '5.400.000,00', 'belum dibayar', '2022-02-24 12:00:00'),
(114, 14, '2022-02-23 02:28:00', '2022-02-24', '2022-02-25', 'Deluxe', '450.000,00', '4', 'Tiyas Frahesta', 'Desa Kadipaten', '97009098', '1', '1.800.000,00', 'berhasil', '2022-02-24 12:00:00'),
(115, 14, '2022-02-23 02:28:00', '2022-02-24', '2022-02-26', 'Deluxe', '450.000,00', '2', 'Tiyas Frahesta', 'Desa Kadipaten', '97009098', '2', '1.800.000,00', 'pending', '2022-02-24 12:00:00'),
(116, 14, '2022-02-23 02:29:00', '2022-02-24', '2022-02-27', 'Deluxe', '450.000,00', '3', 'Tiyas Frahesta', 'Desa Kadipaten', '97009098', '3', '4.050.000,00', 'pending', '2022-02-24 12:00:00'),
(117, 14, '2022-02-23 02:29:00', '2022-02-24', '2022-02-25', 'Superior', '410.000,00', '2', 'Tiyas Frahesta', 'Desa Kadipaten', '97009098', '1', '820.000,00', 'pending', '2022-02-24 12:00:00'),
(118, 14, '2022-02-23 02:30:00', '2022-02-24', '2022-02-28', 'Superior', '410.000,00', '3', 'Tiyas Frahesta', 'Desa Kadipaten', '97009098', '4', '4.920.000,00', 'batal', '2022-02-24 12:00:00'),
(119, 14, '2022-02-23 02:34:00', '2022-02-24', '2022-02-25', 'Superior', '410.000,00', '1', 'Tiyas Frahesta', 'Desa Kadipaten', '97009098', '1', '410.000,00', 'pending', '2022-02-24 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sosial_media`
--

CREATE TABLE `sosial_media` (
  `id` int(11) NOT NULL,
  `whatsapp` text NOT NULL,
  `instagram` text NOT NULL,
  `facebook` text NOT NULL,
  `twitter` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sosial_media`
--

INSERT INTO `sosial_media` (`id`, `whatsapp`, `instagram`, `facebook`, `twitter`) VALUES
(1, '6283809192165', 'dmscndraa', 'dmscndraaaa', 'dmscndraa');

-- --------------------------------------------------------

--
-- Table structure for table `stok_kamar`
--

CREATE TABLE `stok_kamar` (
  `id_stok_kamar` int(11) NOT NULL,
  `tipe` enum('Superior','Deluxe') NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `jumlah_kamar` varchar(2) NOT NULL,
  `stok` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_kamar`
--

INSERT INTO `stok_kamar` (`id_stok_kamar`, `tipe`, `gambar`, `jumlah_kamar`, `stok`) VALUES
(1, 'Superior', 'superior.jpg', '12', '9'),
(2, 'Deluxe', 'deluxe.jpg', '12', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_stok_kamar` (`id_stok_kamar`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `sosial_media`
--
ALTER TABLE `sosial_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok_kamar`
--
ALTER TABLE `stok_kamar`
  ADD PRIMARY KEY (`id_stok_kamar`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `sosial_media`
--
ALTER TABLE `sosial_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stok_kamar`
--
ALTER TABLE `stok_kamar`
  MODIFY `id_stok_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_ibfk_1` FOREIGN KEY (`id_stok_kamar`) REFERENCES `stok_kamar` (`id_stok_kamar`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
