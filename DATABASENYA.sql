-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 29, 2024 at 03:16 PM
-- Server version: 8.0.33-cll-lve
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kingspe1_kingpedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `tipe` enum('INFORMASI','PERINGATAN','PENTING','UPDATE','DEPOSIT') COLLATE utf8mb3_swedish_ci NOT NULL,
  `subjek` text COLLATE utf8mb3_swedish_ci NOT NULL,
  `konten` text COLLATE utf8mb3_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `date`, `time`, `tipe`, `subjek`, `konten`) VALUES
(1, '2024-01-26', '20:08:32', 'INFORMASI', 'SCRIPT SMM DAN PPOB SIAP PAKAI', 'Free Script Smm Dan Ppob Bebas Bug Dan Error Siap Pakai Untuk Bisnis Kamu Tanpa Perlu Koding Mahir Karna Instalasi Dan Intregras Sangat Mudah Serba Admin');

-- --------------------------------------------------------

--
-- Table structure for table `bot_whatsapp`
--

CREATE TABLE `bot_whatsapp` (
  `id` int NOT NULL,
  `nomer_hp` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `token_wa` varchar(250) COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `bot_whatsapp`
--

INSERT INTO `bot_whatsapp` (`id`, `nomer_hp`, `token_wa`, `status`) VALUES
(1, '083xxxxx', 'sK9DQYQ7', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `id` int NOT NULL,
  `kode_deposit` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `payment` varchar(250) NOT NULL,
  `nomor_pengirim` varchar(250) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `jumlah_transfer` int NOT NULL,
  `get_saldo` varchar(250) NOT NULL,
  `status` enum('Success','Pending','Error') NOT NULL,
  `place_from` varchar(50) NOT NULL DEFAULT 'WEB',
  `date` date NOT NULL,
  `tripay_link` varchar(255) DEFAULT NULL,
  `time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_bank`
--

CREATE TABLE `deposit_bank` (
  `id` int NOT NULL,
  `kode_deposit` varchar(250) NOT NULL,
  `merchant_ref` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `jenis_saldo` varchar(225) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `payment` varchar(250) NOT NULL,
  `nomor_pengirim` varchar(250) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `fee` varchar(128) NOT NULL,
  `jumlah_transfer` int NOT NULL,
  `get_saldo` varchar(250) NOT NULL,
  `status` enum('Success','Pending','Error','') NOT NULL,
  `place_from` varchar(50) NOT NULL DEFAULT 'WEB',
  `date` date NOT NULL,
  `time` time NOT NULL,
  `checkout_url` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_tsel`
--

CREATE TABLE `deposit_tsel` (
  `id` int NOT NULL,
  `kode_deposit` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `payment` varchar(250) NOT NULL,
  `nomor_pengirim` varchar(250) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `jumlah_transfer` int NOT NULL,
  `get_saldo` varchar(250) NOT NULL,
  `status` enum('Success','Pending','Error','') NOT NULL,
  `place_from` varchar(50) NOT NULL DEFAULT 'WEB',
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_voucher`
--

CREATE TABLE `deposit_voucher` (
  `id` int NOT NULL,
  `kode_deposit` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `payment` varchar(250) NOT NULL,
  `nomor_pengirim` varchar(250) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `jumlah_transfer` int NOT NULL,
  `get_saldo` varchar(250) NOT NULL,
  `status` enum('Success','Pending','Error','') NOT NULL,
  `place_from` varchar(50) NOT NULL DEFAULT 'WEB',
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `halaman`
--

CREATE TABLE `halaman` (
  `id` int NOT NULL,
  `konten` text NOT NULL,
  `update_terakhir` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `halaman`
--

INSERT INTO `halaman` (`id`, `konten`, `update_terakhir`) VALUES
(1, '                                <table class=\"table table-bordered dt-responsive nowrap\" style=\"border-collapse: collapse; border-spacing: 0; width: 100%;\">\r\n                                    <tbody>\r\n\r\n                                    <tr>\r\n                                        <td align=\"center\">\r\n                                            <a href=\"https://www.facebook.com/\" class=\"btn btn-primary btn-bordred btn-rounded waves-effect waves-light\" target=\"BLANK\"><i class=\"mdi mdi-facebook\"></i> Facebook</a>\r\n                                        </td>\r\n                                        <td align=\"center\">\r\n                                            <a href=\"https://api.whatsapp.com/send?phone=6283191910986&text=Hallo%20Admin\" class=\"btn btn-primary btn-bordred btn-rounded waves-effect waves-light\" target=\"BLANK\"><i class=\"mdi mdi-whatsapp\"></i> Whatsapp</a>\r\n                                        </td>\r\n<table class=\"table table-bordered dt-responsive nowrap\" style=\"border-collapse: collapse; border-spacing: 0; width: 100%;\">\r\n                                    <tbody>\r\n<td align=\"center\">\r\n                                            <a href=\"https://Instagram.com/hery_flasher\" class=\"btn btn-primary btn-bordred btn-rounded waves-effect waves-light\" target=\"BLANK\"><i class=\"mdi mdi-instagram\"></i> Instagram</a>\r\n</td>\r\n                                    </tr>   \r\n                                    </tbody>\r\n                                </table>\r\n                                \r\n', '2019-01-21 00:00:00'),
(2, '<p>Layanan yang disediakan oleh Feedback panel telah ditetapkan kesepakatan-kesepakatan berikut.</p><br />\n										<p><b>1. Umum</b><br />\n										<br />Dengan mendaftar dan menggunakan layanan feedback panel, Anda secara otomatis menyetujui semua ketentuan layanan kami. Kami berhak mengubah ketentuan layanan ini tanpa pemberitahuan terlebih dahulu. Anda diharapkan membaca semua ketentuan layanan kami sebelum membuat pesanan.<br />\n										<br />Penolakan: feedback panel tidak akan bertanggung jawab jika Anda mengalami kerugian dalam bisnis Anda.<br />\n										<br />Kewajiban: feedback panel tidak bertanggung jawab jika Anda mengalami suspensi akun atau penghapusan kiriman yang dilakukan oleh Instagram, Twitter, Facebook, Youtube, dan lain-lain.<br />\n										<br /><b>2. Layanan</b><br />\n										<br />Kewajiban: feedback panel hanya digunakan untuk media promosi sosial media dan membantu meningkatkan penampilan akun Anda saja.<br />\n										<br />Kewajiban: feedback panel tidak menjamin pengikut baru Anda berinteraksi dengan Anda, kami hanya menjamin bahwa Anda mendapat pengikut yang Anda beli.<br />\n										<br />Kewajiban: feedback panel tidak menerima permintaan pembatalan/pengembalian dana setelah pesanan masuk ke sistem kami. Kami memberikan pengembalian dana yang sesuai jika pesanan tida dapat diselesaikan.</p>', '2019-01-21 00:00:00'),
(3, '<h4>Apa Itu Feedback panel?</h4>Sebuah platform bisnis yang menyediakan berbagai layanan social media marketing yang bergerak terutama di Indonesia.<br />\nDengan bergabung bersama kami, Anda dapat menjadi penyedia jasa social media atau reseller social media seperti jasa penambah Followers, Likes, dll.<br />\nSaat ini tersedia berbagai layanan untuk social media terpopuler seperti Instagram, Facebook, Twitter, Youtube, dll.<br />\n<br />\n<h4>Bagaimana cara mendaftar di Feedback Panel ?</h4> Anda dapat menghubungi Admin <a href=\"/halaman/kontak-kami\">Kontak</a><br />\n<br />\n<h4>Bagaimana cara membuat Pesanan ?</h4>Untuk membuat pesanan sangatlah mudah, Anda hanya perlu masuk terlebih dahulu ke akun Anda dan menuju halaman <b>Pemesanan</b> dengan mengklik menu yang sudah tersedia. Selain itu Anda juga dapat melakukan pemesanan melalui request API.<br />\n<br />\n<h4>Bagaimana cara melakukan Pengisian Saldo ?</h4>Untuk melakukan pengisian saldo, Anda hanya perlu masuk terlebih dahulu ke akun Anda dan menuju halaman deposit dengan mengklik menu yang sudah tersedia. Kami menyediakan deposit melalui bank dan pulsa.									', '2019-01-21 00:00:00'),
(4, '<center><h4><b> PENJELASAN STATUS DI<br>Sosmed Plus </b></h4>\n										<p>\n<br>										<br>\n<span class=\"badge badge-warning\">PENDING</span> :<br> Pesanan/deposit sedang dalam antian di server										\n<br>\n</br>\n<span class=\"badge badge-info\">PROCESSING</span> :<br> Pesanan sedang dalam proses										\n<br>\n</br>\n<span class=\"badge badge-success\">SUCCESS</span> :<br> Pesanan telah berhasil										\n<br>\n</br>\n<span class=\"badge badge-danger\">PARTIAL</span> :<br> Pesanan hanya masuk sebagian. Dan anda hanya akan membayar layanan yang masuk saja										\n<br>\n</br>\n<span class=\"badge badge-danger\">ERROR</span> :<br> Pesanan di batalkan/Terjadi Kesalahan Sistem, dan saldo akan otomatis kembali ke akun.										<br>										<br>\n</br>\n</center>\n<span class=\"badge badge-kece\">Refill/Guaranteed</span> : Refill adalah isi ulang. Jika anda membeli layanan refill dan ternyata dalam beberapa hari followers berkurang, maka akan otomatis di refill/di isi ulang. <b>Tapi harap di ketahui, Server hanya akan mengisi ulang jika followers yang berkurang adalah followers yang di beli dengan layanan refill.</b></p>                                ', '2019-01-21 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `harga_pendaftaran`
--

CREATE TABLE `harga_pendaftaran` (
  `id` int NOT NULL,
  `level` varchar(50) NOT NULL,
  `harga` double NOT NULL,
  `bonus` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `harga_pendaftaran`
--

INSERT INTO `harga_pendaftaran` (`id`, `level`, `harga`, `bonus`) VALUES
(1, 'Member', 0, 0),
(2, 'Agen', 20000, 10000),
(3, 'Reseller', 40000, 20000),
(4, 'Admin', 80000, 40000);

-- --------------------------------------------------------

--
-- Table structure for table `history_saldo`
--

CREATE TABLE `history_saldo` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `aksi` enum('Penambahan Saldo','Pengurangan Saldo') NOT NULL,
  `nominal` double NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_saldo`
--

INSERT INTO `history_saldo` (`id`, `username`, `aksi`, `nominal`, `pesan`, `date`, `time`) VALUES
(1, 'demo123', 'Pengurangan Saldo', 16.9, 'Pemesanan Sosial Media Dengan Order ID 0163353', '2024-01-26', '20:02:48'),
(2, 'demo123', 'Pengurangan Saldo', 21035, 'Order ID 2944425 Token Listrik', '2024-01-30', '09:38:16'),
(3, 'demo123', 'Pengurangan Saldo', 101175, 'Order ID 8327963 Saldo E-Money', '2024-02-02', '21:36:54'),
(4, 'demo123', 'Pengurangan Saldo', 51250, 'Order ID 4433788 Saldo E-Money', '2024-02-02', '21:39:49'),
(5, 'demo123', 'Penambahan Saldo', 51250, 'Pengembalian Dana. Order ID 4433788', '2024-02-02', '21:42:45'),
(6, 'demo123', 'Pengurangan Saldo', 21035, 'Order ID 5938378 Token Listrik', '2024-02-02', '21:43:46'),
(7, 'demo123', 'Pengurangan Saldo', 26160, 'Order ID 4504622 Saldo E-Money', '2024-02-02', '22:06:23'),
(8, 'demo123', 'Pengurangan Saldo', 21160, 'Order ID 7232677 Saldo E-Money', '2024-02-02', '22:07:29'),
(9, 'masuk123', 'Penambahan Saldo', 10932, 'Mendapatkan Saldo Isi Saldo Via Virtual-Account BRIVA Dengan Kode Isi Saldo : DS1855224LJWVEV2OI8OYQEU', '2024-03-28', '13:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_layanan`
--

CREATE TABLE `kategori_layanan` (
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `kode` varchar(250) COLLATE utf8mb4_swedish_ci NOT NULL,
  `tipe` varchar(250) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pulsa`
--

CREATE TABLE `kategori_pulsa` (
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `kode` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `tipe` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `kategori_pulsa`
--

INSERT INTO `kategori_pulsa` (`id`, `nama`, `kode`, `tipe`) VALUES
(1, 'Data Indosat ', 'Data Indosat ', 'Data'),
(2, 'Aktivasi Perdana Axis Bronet', 'Aktivasi Perdana Axis Bronet', 'Aktivasi Perdana'),
(3, 'Aktivasi Perdana Indosat Freedom Combo', 'Aktivasi Perdana Indosat Freedom Combo', 'Aktivasi Perdana'),
(4, 'Aktivasi Perdana Telkomsel Jawa Tengah - DIY', 'Aktivasi Perdana Telkomsel Jawa Tengah - DIY', 'Aktivasi Perdana'),
(5, 'Aktivasi Perdana SmartFREN Unlimited Nonstop', 'Aktivasi Perdana SmartFREN Unlimited Nonstop', 'Aktivasi Perdana'),
(6, 'Pulsa Axis ', 'Pulsa Axis ', 'Pulsa'),
(7, 'E-Money BRI Brizzi ', 'E-Money BRI Brizzi ', 'E-Money'),
(8, 'Data Axis Bronet', 'Data Axis Bronet', 'Data'),
(9, 'E-Money Bukalapak ', 'E-Money Bukalapak ', 'E-Money'),
(10, 'Pulsa by.U ', 'Pulsa by.U ', 'Pulsa'),
(11, 'E-Money DANA ', 'E-Money DANA ', 'E-Money'),
(12, 'E-Money Mandiri E-Toll ', 'E-Money Mandiri E-Toll ', 'E-Money'),
(13, 'Games Free Fire ', 'Games Free Fire ', 'Games'),
(14, 'Games Garena ', 'Games Garena ', 'Games'),
(15, 'E-Money Grab ', 'E-Money Grab ', 'E-Money'),
(16, 'Games Hago ', 'Games Hago ', 'Games'),
(17, 'Pulsa Indosat ', 'Pulsa Indosat ', 'Pulsa'),
(18, 'TV K-VISION dan GOL ', 'TV K-VISION dan GOL ', 'TV'),
(19, 'E-Money LinkAja ', 'E-Money LinkAja ', 'E-Money'),
(20, 'Masa Aktif Telkomsel ', 'Masa Aktif Telkomsel ', 'Masa Aktif'),
(21, 'Games Mobile LegendS ', 'Games Mobile LegendS ', 'Games'),
(22, ' XL ', ' XL ', 'Paket Sms Telpon'),
(23, 'E-Money OVO ', 'E-Money OVO ', 'E-Money'),
(24, 'E-Money Gopay Customer', 'E-Money Gopay Customer', 'E-Money'),
(25, 'Token PLN ', 'Token PLN ', 'PLN'),
(26, 'Games PUBG Mobile ', 'Games PUBG Mobile ', 'Games'),
(27, 'E-Money Shopee Pay ', 'E-Money Shopee Pay ', 'E-Money'),
(28, 'Pulsa SmartFREN ', 'Pulsa SmartFREN ', 'Pulsa'),
(29, 'Data SmartFREN ', 'Data SmartFREN ', 'Data'),
(30, 'Pulsa Telkomsel ', 'Pulsa Telkomsel ', 'Pulsa'),
(31, 'Data Telkomsel ', 'Data Telkomsel ', 'Data'),
(32, 'Pulsa Telkomsel Transfer', 'Pulsa Telkomsel Transfer', 'Pulsa'),
(33, 'Pulsa Tri ', 'Pulsa Tri ', 'Pulsa'),
(34, ' Telkomsel ', ' Telkomsel ', 'Paket Sms Telpon'),
(35, 'Data Tri ', 'Data Tri ', 'Data'),
(36, 'Voucher Axis ', 'Voucher Axis ', 'Voucher'),
(37, 'Voucher SmartFREN ', 'Voucher SmartFREN ', 'Voucher'),
(38, 'Voucher Telkomsel ', 'Voucher Telkomsel ', 'Voucher'),
(39, 'Data XL ', 'Data XL ', 'Data'),
(40, 'Pulsa XL ', 'Pulsa XL ', 'Pulsa');

-- --------------------------------------------------------

--
-- Table structure for table `kontak_kami`
--

CREATE TABLE `kontak_kami` (
  `id` int NOT NULL,
  `nama` text NOT NULL,
  `alamat` text NOT NULL,
  `facebook` text NOT NULL,
  `instagram` text NOT NULL,
  `whatsapp` text NOT NULL,
  `telegram` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `layanan_pascabayar`
--

CREATE TABLE `layanan_pascabayar` (
  `id` int NOT NULL,
  `service_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `provider_id` varchar(50) NOT NULL,
  `operator` varchar(50) NOT NULL,
  `layanan` text NOT NULL,
  `admin` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `komisi` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `status` enum('Normal','Gangguan') NOT NULL,
  `provider` varchar(50) NOT NULL,
  `tipe` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `layanan_pulsa`
--

CREATE TABLE `layanan_pulsa` (
  `id` int NOT NULL,
  `service_id` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `provider_id` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `operator` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `layanan` text COLLATE utf8mb3_swedish_ci NOT NULL,
  `harga` double NOT NULL,
  `harga_api` double NOT NULL,
  `profit` double NOT NULL,
  `multi` enum('Ya','Tidak') COLLATE utf8mb3_swedish_ci NOT NULL,
  `status` enum('Normal','Gangguan') COLLATE utf8mb3_swedish_ci NOT NULL,
  `provider` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `tipe` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `catatan` text COLLATE utf8mb3_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `layanan_pulsa`
--

INSERT INTO `layanan_pulsa` (`id`, `service_id`, `provider_id`, `operator`, `layanan`, `harga`, `harga_api`, `profit`, `multi`, `status`, `provider`, `tipe`, `catatan`) VALUES
(1, '1', '1', 'Data Indosat ', 'Indosat 100 MB / 30 Hari', 1880, 880, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Indosat 100MB 30 Hari'),
(2, '2', '10', 'Data Indosat ', 'Indosat 4 GB / 30 Hari', 24305, 23305, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'kuota 4GB 30 hari'),
(3, '3', '11', 'Data Indosat ', 'Indosat 5 GB / 30 Hari', 27525, 26525, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'KUOTA 5GB 30 hari'),
(4, '4', '13', 'Data Indosat ', 'Indosat 8 GB / 30 Hari', 34125, 33125, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Kuota 8GB 30 hari'),
(5, '5', '14', 'Data Indosat ', 'Indosat 10 GB / 30 Hari', 41525, 40525, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Kuota 10GB 30 hari'),
(6, '6', '2', 'Data Indosat ', 'Indosat 200 MB / 30 Hari', 2640, 1640, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Indosat 200MB 30 Hari'),
(7, '7', '3', 'Data Indosat ', 'Indosat 300 MB / 30 Hari', 3630, 2630, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Indosat 300MB 30 Hari'),
(8, '8', '4', 'Data Indosat ', 'Indosat 400 MB / 30 Hari', 4255, 3255, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Indosat 400 MB 30 Hari'),
(9, '9', '5', 'Data Indosat ', 'Indosat 500 MB / 30 Hari', 5605, 4605, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Indosat 500MB 30 Hari'),
(10, '10', '6', 'Data Indosat ', 'Indosat 750 MB / 30 Hari', 7075, 6075, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Indosat 750MB 30 Hari'),
(11, '11', '7', 'Data Indosat ', 'Indosat 1 GB / 30 Hari', 9125, 8125, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'KUOTA 1GB 30 hari'),
(12, '12', '8', 'Data Indosat ', 'Indosat 2 GB / 30 Hari', 17100, 16100, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'KUOTA 2GB 30 hari'),
(13, '13', '9', 'Data Indosat ', 'Indosat 3 GB / 30 Hari', 20995, 19995, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'KUOTA 3GB 30 hari'),
(14, '14', 'Aktivasi-axis3gb', 'Aktivasi Perdana Axis Bronet', 'Aktivasi Perdana Axis Bronet 3 GB 60 Hari', 20610, 19610, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Aktivasi Perdana', 'Perdana Bronet 3GB + Kuota di Kota-mu 60hr'),
(15, '15', 'Aktivasi-perdanaaxis60hr', 'Aktivasi Perdana Axis Bronet', 'Aktivasi Perdana Axis Bronet 1.5 GB / 60 Hari', 16205, 15205, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Aktivasi Perdana', 'SP Bronet 1.5GB National/ 2GB BIGBRO/ 3GB BIGBRO 2.5/ 3GB BOY/ 4GB BIGB OY 60hr'),
(16, '16', 'Aktivasi-perdanaindo30hr', 'Aktivasi Perdana Indosat Freedom Combo', 'Aktivasi Perdana Indosat Freedom Combo 6 GB 30 Hari', 35325, 34325, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Aktivasi Perdana', 'Aktivasi Perdana Indosat Freedom Combo 6 GB 30 Hari'),
(17, '17', 'Aktivasi-perdanatlkm30hr', 'Aktivasi Perdana Telkomsel Jawa Tengah - DIY', 'Aktivasi Perdana Telkomsel Jawa Tengah - DIY InternetMAX Lite 4 GB Prime 30 Hari', 21210, 20210, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Aktivasi Perdana', 'Aktivasi Perdana Telkomsel Jawa Tengah - DIY InternetMAX Lite 4 GB Prime 30 Hari'),
(18, '18', 'Aktivasi-Smartfren2gb', 'Aktivasi Perdana SmartFREN Unlimited Nonstop', 'Aktivasi Perdana Smartfren Unlimited Nonstop 2 GB', 11895, 10895, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Aktivasi Perdana', '2 GB 24 jam, akses nonstop, gratis nelpon semua smartfren, berlaku 10 Hari. Produk ini untuk aktivasi perdana.'),
(19, '19', 'Axis-10', 'Pulsa Axis ', 'Axis 10.000', 11790, 10790, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Axis Rp 10.000'),
(20, '20', 'Axis-15', 'Pulsa Axis ', 'Axis 15.000', 15980, 14980, 1000, 'Tidak', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Axis Rp 15.000'),
(21, '21', 'Axis-5', 'Pulsa Axis ', 'Axis 5.000', 6770, 5770, 1000, 'Tidak', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Axis Rp 5.000'),
(22, '22', 'Axis-50', 'Pulsa Axis ', 'Axis 50.000', 50805, 49805, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Axis Rp 50.000'),
(23, '23', 'Axis100', 'Pulsa Axis ', 'Axis 100.000', 99775, 98775, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Axis Rp 100.000'),
(24, '24', 'BRIZZ1', 'E-Money BRI Brizzi ', 'BRIZZI 20.000', 21200, 20200, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Saldo BRIZZI 20.000. Wajib update saldo setelah pengisian sukses.'),
(25, '25', 'BRIZZ2', 'E-Money BRI Brizzi ', 'BRIZZI 50.000', 51200, 50200, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Saldo BRIZZI 50.000. Wajib update saldo setelah pengisian sukses.'),
(26, '26', 'BRIZZ3', 'E-Money BRI Brizzi ', 'BRIZZI 100.000', 101200, 100200, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Saldo BRIZZI 100.000. Wajib update saldo setelah pengisian sukses.'),
(27, '27', 'BRIZZ4', 'E-Money BRI Brizzi ', 'BRIZZI 150.000', 151300, 150300, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Saldo BRIZZI 150.000. Wajib update saldo setelah pengisian sukses.'),
(28, '28', 'BRONET3gb', 'Data Axis Bronet', 'Axis Data BRONET 3 GB 30 Hari', 15300, 14300, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'AIGO Bronet 24Jam 3GB + Kuota di Kota-mu 30hr'),
(29, '29', 'BRONET8gb', 'Data Axis Bronet', 'Axis Data BRONET 8 GB 30 Hari', 32525, 31525, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'AIGO Bronet 24Jam 8GB + Kuota di Kota-mu 30hr'),
(30, '30', 'Bukalapak20', 'E-Money Bukalapak ', 'Bukalapak 20.000', 22250, 21250, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Saldo Bukalapak 20.000, input nomor hp terdaftar di Bukalapak.'),
(31, '31', 'byu15', 'Pulsa by.U ', 'by.U 15.000', 16035, 15035, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'pulsa by.U Rp 15.000'),
(32, '32', 'byu5', 'Pulsa by.U ', 'by.U 5.000', 6080, 5080, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'pulsa by.U Rp 5.000'),
(33, '33', 'DANA1', 'E-Money DANA ', 'DANA 10.000', 11155, 10155, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(34, '34', 'DANA10', 'E-Money DANA ', 'DANA 40.000', 41175, 40175, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(35, '35', 'DANA11', 'E-Money DANA ', 'DANA 50.000', 51250, 50250, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(36, '36', 'DANA12', 'E-Money DANA ', 'DANA 70.000', 71175, 70175, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(37, '37', 'DANA13', 'E-Money DANA ', 'DANA 75.000', 76175, 75175, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(38, '38', 'DANA14', 'E-Money DANA ', 'DANA 100.000', 101175, 100175, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(39, '39', 'DANA2', 'E-Money DANA ', 'DANA 11.000', 12225, 11225, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(40, '40', 'DANA3', 'E-Money DANA ', 'DANA 12.000', 13225, 12225, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(41, '41', 'DANA5', 'E-Money DANA ', 'DANA 15.000', 16250, 15250, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(42, '42', 'DANA6', 'E-Money DANA ', 'DANA 20.000', 21160, 20160, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(43, '43', 'DANA7', 'E-Money DANA ', 'DANA 25.000', 26160, 25160, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(44, '44', 'DANA8', 'E-Money DANA ', 'DANA 30.000', 31175, 30175, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(45, '45', 'DANA9', 'E-Money DANA ', 'DANA 35.000', 36675, 35675, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(46, '46', 'DANAv4', 'E-Money DANA ', 'DANA 13.000', 14225, 13225, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(47, '47', 'E-Toll1', 'E-Money Mandiri E-Toll ', 'Mandiri E-Toll 20.000', 22260, 21260, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Wajib update saldo setelah pengisian sukses.'),
(48, '48', 'E-Toll10', 'E-Money Mandiri E-Toll ', 'Mandiri E-Toll 400.000', 401990, 400990, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Wajib update saldo setelah pengisian sukses.'),
(49, '49', 'E-Toll2', 'E-Money Mandiri E-Toll ', 'Mandiri E-Toll 25.000', 27260, 26260, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Wajib update saldo setelah pengisian sukses.'),
(50, '50', 'E-Toll3', 'E-Money Mandiri E-Toll ', 'Mandiri E-Toll 30.000', 32275, 31275, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Wajib update saldo setelah pengisian sukses.'),
(51, '51', 'E-Toll4', 'E-Money Mandiri E-Toll ', 'Mandiri E-Toll 40.000', 42275, 41275, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Wajib update saldo setelah pengisian sukses.'),
(52, '52', 'E-Toll5', 'E-Money Mandiri E-Toll ', 'Mandiri E-Toll 50.000', 51375, 50375, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Wajib update saldo setelah pengisian sukses.'),
(53, '53', 'E-Toll6', 'E-Money Mandiri E-Toll ', 'Mandiri E-Toll 75.000', 76525, 75525, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Wajib update saldo setelah pengisian sukses.'),
(54, '54', 'E-Toll7', 'E-Money Mandiri E-Toll ', 'Mandiri E-Toll 100.000', 101375, 100375, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Wajib update saldo setelah pengisian sukses.'),
(55, '55', 'E-Toll8', 'E-Money Mandiri E-Toll ', 'Mandiri E-Toll 200.000', 203025, 202025, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Wajib update saldo setelah pengisian sukses.'),
(56, '56', 'E-Toll9', 'E-Money Mandiri E-Toll ', 'Mandiri E-Toll 300.000', 303025, 302025, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Wajib update saldo setelah pengisian sukses.'),
(57, '57', 'Fire1', 'Games Free Fire ', 'Free Fire 5 Diamond', 1785, 785, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 5 Diamond'),
(58, '58', 'Fire10', 'Games Free Fire ', 'Free Fire 55 Diamond', 8430, 7430, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 55 Diamond'),
(59, '59', 'Fire11', 'Games Free Fire ', 'Free Fire 60 Diamond', 9181, 8181, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 60 Diamond'),
(60, '60', 'Fire12', 'Games Free Fire ', 'Free Fire 70 Diamond', 9758, 8758, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 70 Diamond'),
(61, '61', 'Fire13', 'Games Free Fire ', 'Free Fire 75 Diamond', 10332, 9332, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 75 Diamond'),
(62, '62', 'Fire15', 'Games Free Fire ', 'Free Fire 90 Diamond', 12664, 11664, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 90 Diamond'),
(63, '63', 'Fire16', 'Games Free Fire ', 'Free Fire 95 Diamond', 13462, 12462, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 95 Diamond'),
(64, '64', 'Fire17', 'Games Free Fire ', 'Free Fire 100 Diamond', 14035, 13035, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 100 Diamond'),
(65, '65', 'Fire18', 'Games Free Fire ', 'Free Fire 120 Diamond', 15778, 14778, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 120 Diamond'),
(66, '66', 'Fire19', 'Games Free Fire ', 'Free Fire 130 Diamond', 17352, 16352, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 130 Diamond'),
(67, '67', 'Fire20', 'Games Free Fire ', 'Free Fire 140 Diamond', 18487, 17487, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 140 Diamond'),
(68, '68', 'Fire33', 'Games Free Fire ', 'Free Fire 180 Diamond', 24345, 23345, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 180 Diamond'),
(69, '69', 'Fire34', 'Games Free Fire ', 'Free Fire 190 Diamond', 25105, 24105, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 190 Diamond'),
(70, '70', 'Fire35', 'Games Free Fire ', 'Free Fire 300 Diamond', 40305, 39305, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 300 Diamond'),
(71, '71', 'Fire36', 'Games Free Fire ', 'Free Fire 405 Diamond', 50001, 49001, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 405 Diamond'),
(72, '72', 'Fire37', 'Games Free Fire ', 'Free Fire 500 Diamond', 64689, 63689, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 500 Diamond'),
(73, '73', 'Fire38', 'Games Free Fire ', 'Free Fire 545 Diamond', 76600, 75600, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 545 Diamond'),
(74, '74', 'Fire39', 'Games Free Fire ', 'Free Fire 565 Diamond', 69426, 68426, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 565 Diamond'),
(75, '75', 'Fire4', 'Games Free Fire ', 'Free Fire 15 Diamond', 3412, 2412, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 15 Diamond'),
(76, '76', 'Fire41', 'Games Free Fire ', 'Free Fire 80 Diamond', 11110, 10110, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 80 Diamond'),
(77, '77', 'Fire6', 'Games Free Fire ', 'Free Fire 25 Diamond', 5125, 4125, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 25 Diamond'),
(78, '78', 'Fire7', 'Games Free Fire ', 'Free Fire 30 Diamond', 5786, 4786, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 30 Diamond'),
(79, '79', 'Fire8', 'Games Free Fire ', 'Free Fire 40 Diamond', 7562, 6562, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 40 Diamond'),
(80, '80', 'Fire9', 'Games Free Fire ', 'Free Fire 50 Diamond', 7370, 6370, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 50 Diamond'),
(81, '81', 'Free-Fire12', 'Games Free Fire ', 'Free Fire 12 Diamond', 3544, 2544, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 12 Diamond'),
(82, '82', 'Free-Fire140', 'Games Free Fire ', 'Free Fire 140 Diamond', 18170, 17170, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 140 Diamond'),
(83, '83', 'Free-Fire20', 'Games Free Fire ', 'Free Fire 20 Diamond', 4189, 3189, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 20 Diamond'),
(84, '84', 'Free-Fire5', 'Games Free Fire ', 'Free Fire 5 Diamond', 1835, 835, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Free Fire 5 Diamond'),
(85, '85', 'Garena1', 'Games Garena ', 'Garena 33 Shell', 10404, 9404, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Tujuan = ID garena'),
(86, '86', 'Garena2', 'Games Garena ', 'Garena 66 Shell', 20065, 19065, 1000, 'Tidak', 'Normal', 'DIGIFLAZZ', 'Games', 'Tujuan = ID garena'),
(87, '87', 'Garena3', 'Games Garena ', 'Garena 165 Shell', 45828, 44828, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Tujuan = ID garena'),
(88, '88', 'Garena4', 'Games Garena ', 'Garena 330 Shell', 92025, 91025, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Tujuan = ID garena'),
(89, '89', 'Grab1', 'E-Money Grab ', 'Grab penumpang 20.000', 21985, 20985, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(90, '90', 'Grab2', 'E-Money Grab ', 'Grab penumpang 25.000', 26985, 25985, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(91, '91', 'Grab3', 'E-Money Grab ', 'Grab penumpang 40.000', 42050, 41050, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(92, '92', 'Grab4', 'E-Money Grab ', 'Grab penumpang 50.000', 52050, 51050, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(93, '93', 'Grab5', 'E-Money Grab ', 'Grab penumpang 75.000', 77050, 76050, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(94, '94', 'Grab6', 'E-Money Grab ', 'Grab penumpang 100.000', 102050, 101050, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(95, '95', 'Grab7', 'E-Money Grab ', 'Grab penumpang 150.000', 152050, 151050, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(96, '96', 'Grab8', 'E-Money Grab ', 'Grab penumpang 200.000', 202125, 201125, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(97, '97', 'Grab9', 'E-Money Grab ', 'Grab penumpang 500.000', 501825, 500825, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(98, '98', 'Hago1', 'Games Hago ', 'Hago 5 Diamonds', 2550, 1550, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Masukkan Player ID Hago Anda'),
(99, '99', 'Hago2', 'Games Hago ', 'Hago 10 Diamonds', 3995, 2995, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Masukkan Player ID Hago Anda'),
(100, '100', 'Hago3', 'Games Hago ', 'Hago 20 Diamonds', 6885, 5885, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Masukkan Player ID Hago Anda'),
(101, '101', 'Hago4', 'Games Hago ', 'Hago 25 Diamonds', 8330, 7330, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Masukkan Player ID Hago Anda'),
(102, '102', 'Hago5', 'Games Hago ', 'Hago 30 Diamonds', 9775, 8775, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Masukkan Player ID Hago Anda'),
(103, '103', 'Hago6', 'Games Hago ', 'Hago 45 Diamonds', 14115, 13115, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Masukkan Player ID Hago Anda'),
(104, '104', 'Hago7', 'Games Hago ', 'Hago 100 Diamonds', 30025, 29025, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Masukkan Player ID Hago Anda'),
(105, '105', 'Hago8', 'Games Hago ', 'Hago 150 Diamonds', 44475, 43475, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Masukkan Player ID Hago Anda'),
(106, '106', 'Hago9', 'Games Hago ', 'Hago 375 Diamonds', 109500, 108500, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'Masukkan Player ID Hago Anda'),
(107, '107', 'Indosa-100', 'Pulsa Indosat ', 'Indosat 100.000', 98682, 97682, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Indosat Rp 100.000'),
(108, '108', 'Indosa-20', 'Pulsa Indosat ', 'Indosat 20.000', 20780, 19780, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Indosat Rp 20.000'),
(109, '109', 'Indosa-200', 'Pulsa Indosat ', 'Indosat 200.000', 186625, 185625, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Indosat Rp 200.000'),
(110, '110', 'Indosa-25', 'Pulsa Indosat ', 'Indosat 25.000', 25870, 24870, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Indosat Rp 25.000'),
(111, '111', 'Indosa-5', 'Pulsa Indosat ', 'Indosat 5.000', 6725, 5725, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Indosat Rp 5.000'),
(112, '112', 'Indosa-50', 'Pulsa Indosat ', 'Indosat 50.000', 50394, 49394, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Indosat Rp 50.000'),
(113, '113', 'K-Vision', 'TV K-VISION dan GOL ', 'K-Vision  GOL Paket CLING (CL01)  30 Hari', 10505, 9505, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'TV', 'Siaran National Geographic, Nat Geo Wild, My Family, My Cinema, MTV, Rock , Kids TV, dll'),
(114, '114', 'LinkAja4', 'E-Money LinkAja ', 'LinkAja Rp 40.000', 41410, 40410, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(115, '115', 'LinkAja5', 'E-Money LinkAja ', 'LinkAja Rp 50.000', 51405, 50405, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(116, '116', 'LinkAja6', 'E-Money LinkAja ', 'LinkAja Rp 60.000', 61405, 60405, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(117, '117', 'LinkAja7', 'E-Money LinkAja ', 'LinkAja Rp 65.000', 66350, 65350, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(118, '118', 'LinkAja8', 'E-Money LinkAja ', 'LinkAja Rp 80.000', 81405, 80405, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', '-'),
(119, '119', 'masaktif-Telkomsel5hri', 'Masa Aktif Telkomsel ', 'Telkomsel Tambah Masa Aktif Kartu 5 Hari', 3320, 2320, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Masa Aktif', 'Telkomsel Tambah Masa Aktif Kartu 5 Hari'),
(120, '120', 'MOBILELEGEND1', 'Games Mobile LegendS ', 'MOBILELEGEND - 3 Diamond', 2200, 1200, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(121, '121', 'MOBILELEGEND10', 'Games Mobile LegendS ', 'MOBILELEGEND - 36 Diamond', 10178, 9178, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(122, '122', 'MOBILELEGEND100', 'Games Mobile LegendS ', 'MOBILELEGEND - 6050 Diamond', 1470425, 1469425, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(123, '123', 'MOBILELEGEND11', 'Games Mobile LegendS ', 'MOBILELEGEND - 42 Diamond', 10629, 9629, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(124, '124', 'MOBILELEGEND111', 'Games Mobile LegendS ', 'MOBILELEGEND - 5532 Diamond', 1337278, 1336278, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(125, '125', 'MOBILELEGEND12', 'Games Mobile LegendS ', 'MOBILELEGEND - 44 Diamond', 12270, 11270, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(126, '126', 'MOBILELEGEND13', 'Games Mobile LegendS ', 'MOBILELEGEND - 45 Diamond', 13084, 12084, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(127, '127', 'MOBILELEGEND14', 'Games Mobile LegendS ', 'MOBILELEGEND - 56 Diamond', 14000, 13000, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(128, '128', 'MOBILELEGEND15', 'Games Mobile LegendS ', 'MOBILELEGEND - 59 Diamond', 15545, 14545, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(129, '129', 'MOBILELEGEND16', 'Games Mobile LegendS ', 'MOBILELEGEND - 60 Diamond', 16910, 15910, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(130, '130', 'MOBILELEGEND17', 'Games Mobile LegendS ', 'MOBILELEGEND - 70 Diamond', 17090, 16090, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(131, '131', 'MOBILELEGEND18', 'Games Mobile LegendS ', 'MOBILELEGEND - 74 Diamond', 21746, 20746, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(132, '132', 'MOBILELEGEND19', 'Games Mobile LegendS ', 'MOBILELEGEND - 85 Diamond', 22600, 21600, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(133, '133', 'MOBILELEGEND20', 'Games Mobile LegendS ', 'MOBILELEGEND - 86 Diamond', 19915, 18915, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(134, '134', 'MOBILELEGEND21', 'Games Mobile LegendS ', 'MOBILELEGEND - 100 Diamond', 26355, 25355, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(135, '135', 'MOBILELEGEND22', 'Games Mobile LegendS ', 'MOBILELEGEND - 112 Diamond', 26149, 25149, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(136, '136', 'MOBILELEGEND24', 'Games Mobile LegendS ', 'MOBILELEGEND - 153 Diamond', 39723, 38723, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(137, '137', 'MOBILELEGEND25', 'Games Mobile LegendS ', 'MOBILELEGEND - 170 Diamond', 43910, 42910, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(138, '138', 'MOBILELEGEND26', 'Games Mobile LegendS ', 'MOBILELEGEND - 172 Diamond', 38515, 37515, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(139, '139', 'MOBILELEGEND27', 'Games Mobile LegendS ', 'MOBILELEGEND - 185 Diamond', 41952, 40952, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(140, '140', 'MOBILELEGEND28', 'Games Mobile LegendS ', 'MOBILELEGEND - 222 Diamond', 51692, 50692, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(141, '141', 'MOBILELEGEND29', 'Games Mobile LegendS ', 'MOBILELEGEND - 240 Diamond', 54700, 53700, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(142, '142', 'MOBILELEGEND3', 'Games Mobile LegendS ', 'MOBILELEGEND - 5 Diamond', 2391, 1391, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(143, '143', 'MOBILELEGEND30', 'Games Mobile LegendS ', 'MOBILELEGEND - 257 Diamond', 57395, 56395, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(144, '144', 'MOBILELEGEND31', 'Games Mobile LegendS ', 'MOBILELEGEND - 284 Diamond', 63400, 62400, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(145, '145', 'MOBILELEGEND32', 'Games Mobile LegendS ', 'MOBILELEGEND - 296 Diamond', 67198, 66198, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(146, '146', 'MOBILELEGEND33', 'Games Mobile LegendS ', 'MOBILELEGEND - 344 Diamond', 75980, 74980, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(147, '147', 'MOBILELEGEND333', 'Games Mobile LegendS ', 'MOBILELEGEND - 4830 Diamond', 1112000, 1111000, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(148, '148', 'MOBILELEGEND34', 'Games Mobile LegendS ', 'MOBILELEGEND - 355 Diamond', 90650, 89650, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(149, '149', 'MOBILELEGEND35', 'Games Mobile LegendS ', 'MOBILELEGEND - 370 Diamond', 93903, 92903, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(150, '150', 'MOBILELEGEND36', 'Games Mobile LegendS ', 'MOBILELEGEND - 408 Diamond', 101485, 100485, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(151, '151', 'MOBILELEGEND37', 'Games Mobile LegendS ', 'MOBILELEGEND - 429 Diamond', 94860, 93860, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(152, '152', 'MOBILELEGEND38', 'Games Mobile LegendS ', 'MOBILELEGEND - 514 Diamond', 129480, 128480, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(153, '153', 'MOBILELEGEND39', 'Games Mobile LegendS ', 'MOBILELEGEND - 568 Diamond', 121625, 120625, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(154, '154', 'MOBILELEGEND4', 'Games Mobile LegendS ', 'MOBILELEGEND - 12 Diamond', 4276, 3276, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(155, '155', 'MOBILELEGEND40', 'Games Mobile LegendS ', 'MOBILELEGEND - 600 Diamond', 149850, 148850, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(156, '156', 'MOBILELEGEND5', 'Games Mobile LegendS ', 'MOBILELEGEND - 14 Diamond', 4220, 3220, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(157, '157', 'MOBILELEGEND55', 'Games Mobile LegendS ', 'MOBILELEGEND - 1412 Diamond', 301950, 300950, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(158, '158', 'MOBILELEGEND6', 'Games Mobile LegendS ', 'MOBILELEGEND - 19 Diamond', 6150, 5150, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(159, '159', 'MOBILELEGEND66', 'Games Mobile LegendS ', 'MOBILELEGEND - 1220 Diamond', 265070, 264070, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(160, '160', 'MOBILELEGEND7', 'Games Mobile LegendS ', 'MOBILELEGEND - 28 Diamond', 7410, 6410, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(161, '161', 'MOBILELEGEND706', 'Games Mobile LegendS ', 'MOBILELEGEND - 706 Diamond', 174100, 173100, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(162, '162', 'MOBILELEGEND777', 'Games Mobile LegendS ', 'MOBILELEGEND - 1000 Diamond', 220745, 219745, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(163, '163', 'MOBILELEGEND8', 'Games Mobile LegendS ', 'MOBILELEGEND - 30 Diamond', 8859, 7859, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(164, '164', 'MOBILELEGEND9', 'Games Mobile LegendS ', 'MOBILELEGEND - 33 Diamond', 9732, 8732, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'no pelanggan = gabungan antara user_id dan zone_id'),
(165, '165', 'Nelponxl50Menit', ' XL ', 'XL Nelpon Sesama 350 Menit + Operator Lain 50 Menit - 7 Hari', 12250, 11250, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Paket Sms Telpon', 'AnyNet Nelp 350Mnt+50Mnt(Offnet), 7hr'),
(166, '166', 'OVO1', 'E-Money OVO ', 'OVO 10.000', 10224, 9224, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'OVO 10.000'),
(167, '167', 'OVO10', 'E-Money OVO ', 'OVO 60.000', 61750, 60750, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'OVO 60.000'),
(168, '168', 'OVO11', 'E-Money OVO ', 'OVO 70.000', 71750, 70750, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'OVO 70.000'),
(169, '169', 'OVO12', 'E-Money OVO ', 'OVO 80.000', 81750, 80750, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'OVO 80.000'),
(170, '170', 'OVO13', 'E-Money OVO ', 'OVO 90.000', 91750, 90750, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'OVO 90.000'),
(171, '171', 'OVO14', 'E-Money OVO ', 'OVO 100.000', 101750, 100750, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'OVO 100.000'),
(172, '172', 'OVO15', 'E-Money OVO ', 'OVO 150.000', 158500, 157500, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'OVO 150.000'),
(173, '173', 'OVO2', 'E-Money OVO ', 'OVO 15.000', 16750, 15750, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'OVO 15.000'),
(174, '174', 'OVO3', 'E-Money OVO ', 'OVO 20.000', 21750, 20750, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'OVO 20.000'),
(175, '175', 'OVO4', 'E-Money OVO ', 'OVO 25.000', 26750, 25750, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'OVO 25.000'),
(176, '176', 'OVO5', 'E-Money OVO ', 'OVO 30.000', 31750, 30750, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'OVO 30.000'),
(177, '177', 'OVO6', 'E-Money OVO ', 'OVO 35.000', 36750, 35750, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'OVO 35.000'),
(178, '178', 'OVO7', 'E-Money OVO ', 'OVO 40.000', 41750, 40750, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'OVO 40.000'),
(179, '179', 'OVO8', 'E-Money OVO ', 'OVO 45.000', 46750, 45750, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'OVO 45.000'),
(180, '180', 'OVO9', 'E-Money OVO ', 'OVO 50.000', 51750, 50750, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'OVO 50.000'),
(181, '181', 'Pay1', 'E-Money Gopay Customer', 'Go Pay 10.000', 11280, 10280, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Masukan no HP'),
(182, '182', 'Pay10', 'E-Money Gopay Customer', 'Go Pay 55.000', 56275, 55275, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Masukan no HP'),
(183, '183', 'Pay11', 'E-Money Gopay Customer', 'Go Pay 60.000', 61275, 60275, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Masukkan no HP'),
(184, '184', 'Pay12', 'E-Money Gopay Customer', 'Go Pay 65.000', 66275, 65275, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Masukkan no HP'),
(185, '185', 'Pay13', 'E-Money Gopay Customer', 'Go Pay 70.000', 71775, 70775, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Masukan no HP'),
(186, '186', 'Pay14', 'E-Money Gopay Customer', 'Go Pay 75.000', 76475, 75475, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Masukan no HP'),
(187, '187', 'Pay15', 'E-Money Gopay Customer', 'Go Pay 80.000', 81475, 80475, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Masukkan no HP'),
(188, '188', 'Pay16', 'E-Money Gopay Customer', 'Go Pay 85.000', 86475, 85475, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Masukkan no HP'),
(189, '189', 'Pay17', 'E-Money Gopay Customer', 'Go Pay 90.000', 91475, 90475, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Masukkan no HP'),
(190, '190', 'Pay18', 'E-Money Gopay Customer', 'Go Pay 95.000', 96475, 95475, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Masukkan no HP'),
(191, '191', 'Pay19', 'E-Money Gopay Customer', 'Go Pay 100.000', 101475, 100475, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Masukan no HP'),
(192, '192', 'Pay2', 'E-Money Gopay Customer', 'Go Pay 15.000', 16775, 15775, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Masukan no HP'),
(193, '193', 'Pay3', 'E-Money Gopay Customer', 'Go Pay 20.000', 21285, 20285, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Masukan no HP'),
(194, '194', 'Pay4', 'E-Money Gopay Customer', 'Go Pay 25.000', 26460, 25460, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Masukan no HP'),
(195, '195', 'Pay5', 'E-Money Gopay Customer', 'Go Pay 30.000', 31475, 30475, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Masukan no HP'),
(196, '196', 'Pay6', 'E-Money Gopay Customer', 'Go Pay 35.000', 36475, 35475, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Masukan no HP'),
(197, '197', 'Pay7', 'E-Money Gopay Customer', 'Go Pay 40.000', 41775, 40775, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Masukan no HP'),
(198, '198', 'Pay9', 'E-Money Gopay Customer', 'Go Pay 50.000', 51475, 50475, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'Masukan no HP'),
(199, '199', 'PLN', 'Token PLN ', 'PLN 5.000', 7830, 6830, 1000, 'Ya', 'Gangguan', 'DIGIFLAZZ', 'PLN', 'masukkan nomor meter/id pelanggan'),
(200, '200', 'PLN10', 'Token PLN ', 'PLN 10.000', 12830, 11830, 1000, 'Ya', 'Gangguan', 'DIGIFLAZZ', 'PLN', 'masukkan nomor meter/id pelanggan'),
(201, '201', 'PLN10100', 'Token PLN ', 'PLN 100.000', 101050, 100050, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'PLN', 'masukkan nomor meter/id pelanggan'),
(202, '202', 'PLN1015', 'Token PLN ', 'PLN 15.000', 16635, 15635, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'PLN', 'masukkan nomor meter/id pelanggan'),
(203, '203', 'PLN1020', 'Token PLN ', 'PLN 20.000', 21035, 20035, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'PLN', 'masukkan nomor meter/id pelanggan'),
(204, '204', 'PLN1050', 'Token PLN ', 'PLN 50.000', 51050, 50050, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'PLN', 'masukkan nomor meter/id pelanggan'),
(205, '205', 'PUBG1', 'Games PUBG Mobile ', 'PUBG MOBILE 16 UC', 6400, 5400, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 16 UC'),
(206, '206', 'PUBG10', 'Games PUBG Mobile ', 'PUBG MOBILE 131 UC', 30169, 29169, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 131 UC'),
(207, '207', 'PUBG11', 'Games PUBG Mobile ', 'PUBG MOBILE 150 UC', 37043, 36043, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 150 UC'),
(208, '208', 'PUBG12', 'Games PUBG Mobile ', 'PUBG MOBILE 156 UC', 36024, 35024, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 156 UC'),
(209, '209', 'PUBG13', 'Games PUBG Mobile ', 'PUBG MOBILE 210 UC', 39915, 38915, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 210 UC'),
(210, '210', 'PUBG15', 'Games PUBG Mobile ', 'PUBG MOBILE 263 UC', 53517, 52517, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 263 UC'),
(211, '211', 'PUBG16', 'Games PUBG Mobile ', 'PUBG MOBILE 500 UC', 94072, 93072, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 500 UC'),
(212, '212', 'PUBG17', 'Games PUBG Mobile ', 'PUBG MOBILE 700 UC', 139025, 138025, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 700 UC'),
(213, '213', 'PUBG18', 'Games PUBG Mobile ', 'PUBG MOBILE 750 UC', 140955, 139955, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 750 UC'),
(214, '214', 'PUBG19', 'Games PUBG Mobile ', 'PUBG MOBILE 825 UC', 152622, 151622, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 825 UC'),
(215, '215', 'PUBG2', 'Games PUBG Mobile ', 'PUBG MOBILE 26 UC', 6832, 5832, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 26 UC'),
(216, '216', 'PUBG20', 'Games PUBG Mobile ', 'PUBG MOBILE 1100 UC', 199261, 198261, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 1100 UC'),
(217, '217', 'PUBG21', 'Games PUBG Mobile ', 'PUBG MOBILE 1250 UC', 233141, 232141, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 1250 UC'),
(218, '218', 'PUBG22', 'Games PUBG Mobile ', 'PUBG MOBILE 1750 UC', 292526, 291526, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 1750 UC'),
(219, '219', 'PUBG23', 'Games PUBG Mobile ', 'PUBG MOBILE 2500 UC', 453500, 452500, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 2500 UC'),
(220, '220', 'PUBG24', 'Games PUBG Mobile ', 'PUBG MOBILE 3500 UC', 584026, 583026, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 3500 UC'),
(221, '221', 'PUBG25', 'Games PUBG Mobile ', 'PUBG MOBILE 5000 UC', 793928, 792928, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 5000 UC'),
(222, '222', 'PUBG4', 'Games PUBG Mobile ', 'PUBG MOBILE 50 UC', 12511, 11511, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 50 UC'),
(223, '223', 'PUBG5', 'Games PUBG Mobile ', 'PUBG MOBILE 70 UC', 13670, 12670, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 70 UC'),
(224, '224', 'PUBG6', 'Games PUBG Mobile ', 'PUBG MOBILE 100 UC', 25123, 24123, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 100 UC'),
(225, '225', 'PUBG7', 'Games PUBG Mobile ', 'PUBG MOBILE 105 UC', 24343, 23343, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 105 UC'),
(226, '226', 'PUBG9', 'Games PUBG Mobile ', 'PUBG MOBILE 125 UC', 32626, 31626, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Games', 'PUBG MOBILE 125 UC'),
(227, '227', 'SHOPEE1', 'E-Money Shopee Pay ', 'SHOPEE PAY 10.000', 11805, 10805, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'SHOPEE PAY 10.000'),
(228, '228', 'SHOPEE2', 'E-Money Shopee Pay ', 'SHOPEE PAY 15.000', 16815, 15815, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'SHOPEE PAY 15.000'),
(229, '229', 'SHOPEE3', 'E-Money Shopee Pay ', 'SHOPEE PAY 20.000', 21010, 20010, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'SHOPEE PAY 20.000'),
(230, '230', 'SHOPEE4', 'E-Money Shopee Pay ', 'SHOPEE PAY 25.000', 26810, 25810, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'SHOPEE PAY 25.000'),
(231, '231', 'SHOPEE5', 'E-Money Shopee Pay ', 'SHOPEE PAY 50.000', 51825, 50825, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'SHOPEE PAY 50.000'),
(232, '232', 'SHOPEE6', 'E-Money Shopee Pay ', 'SHOPEE PAY 75.000', 76730, 75730, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'SHOPEE PAY 75.000'),
(233, '233', 'SHOPEE7', 'E-Money Shopee Pay ', 'SHOPEE PAY 100.000', 101825, 100825, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'E-Money', 'SHOPEE PAY 100.000'),
(234, '234', 'Smartfren-10', 'Pulsa SmartFREN ', 'Smartfren 10.000', 10795, 9795, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Smart Rp 10.000'),
(235, '235', 'Smartfren-100', 'Pulsa SmartFREN ', 'Smartfren 100.000', 96995, 95995, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Smart Rp 100.000'),
(236, '236', 'Smartfren-15', 'Pulsa SmartFREN ', 'Smartfren 15.000', 15640, 14640, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Smart Rp 15.000'),
(237, '237', 'Smartfren-20', 'Pulsa SmartFREN ', 'Smartfren 20.000', 20590, 19590, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Smart Rp 20.000'),
(238, '238', 'Smartfren-25', 'Pulsa SmartFREN ', 'Smartfren 25.000', 25435, 24435, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Smart Rp 25.000'),
(239, '239', 'Smartfren-5', 'Pulsa SmartFREN ', 'Smartfren 5.000', 5905, 4905, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Smart Rp 5.000'),
(240, '240', 'Smartfren-50', 'Pulsa SmartFREN ', 'Smartfren 50.000', 49300, 48300, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Smart Rp 50.000'),
(241, '241', 'Smartfren-500', 'Pulsa SmartFREN ', 'Smartfren 500.000', 489025, 488025, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Smart Rp 500.000'),
(242, '242', 'Smartfren-60', 'Pulsa SmartFREN ', 'Smartfren 60.000', 59635, 58635, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Smart Rp 60.000'),
(243, '243', 'Smartfren1', 'Data SmartFREN ', 'Smartfren Internet 10.000', 11993, 10993, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Kuota Internet sebesar 10rb selama 7 hari'),
(244, '244', 'Smartfren10', 'Data SmartFREN ', 'Smartfren Data 3 GB / 5 Hari', 11920, 10920, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Smartfren Data 3 GB / 5 Hari'),
(245, '245', 'Smartfren11', 'Data SmartFREN ', 'Smartfren 2 GB / 7 Hari', 9430, 8430, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', '1GB Kuota Utama + 1GB Kuota Chat'),
(246, '246', 'Smartfren12', 'Data SmartFREN ', 'Smartfren 2.5 GB / 7 Hari', 12800, 11800, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', '1.5GB Kuota Utama + 1GB Kuota Chat'),
(247, '247', 'Smartfren13', 'Data SmartFREN ', 'Smartfren 4 GB / 14 Hari', 17365, 16365, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', '2GB Regular + 2GB Malam'),
(248, '248', 'Smartfren14', 'Data SmartFREN ', 'Smartfren 8 GB / 14 Hari', 37800, 36800, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', '4GB Regular + 4GB Malam'),
(249, '249', 'Smartfren16', 'Data SmartFREN ', 'Smartfren 16 GB / 30 Hari', 52225, 51225, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', '8GB Regular + 8GB Malam'),
(250, '250', 'Smartfren2', 'Data SmartFREN ', 'Smartfren Internet 20.000', 19610, 18610, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Kuota Internet sebesar 20rb selama 30 hari'),
(251, '251', 'Smartfren3', 'Data SmartFREN ', 'Smartfren Internet 30.000', 27625, 26625, 1000, 'Ya', 'Gangguan', 'DIGIFLAZZ', 'Data', 'Kuota Internet sebesar 30rb selama 30 hari'),
(252, '252', 'Smartfren4', 'Data SmartFREN ', 'Smartfren Internet 100.000', 101025, 100025, 1000, 'Ya', 'Gangguan', 'DIGIFLAZZ', 'Data', 'Kuota Internet sebesar 100rb selama 30 hari'),
(253, '253', 'Smartfren5', 'Data SmartFREN ', 'Smartfren Internet 150.000', 150025, 149025, 1000, 'Ya', 'Gangguan', 'DIGIFLAZZ', 'Data', 'Kuota Internet sebesar 150rb selama 30 hari'),
(254, '254', 'Smartfren6', 'Data SmartFREN ', 'Smartfren Internet 200.000', 200025, 199025, 1000, 'Ya', 'Gangguan', 'DIGIFLAZZ', 'Data', 'Kuota Internet sebesar 200.000 selama 30 hari'),
(255, '255', 'Smartfren7', 'Data SmartFREN ', 'Smartfren Data 1 GB / 3 Hari', 5765, 4765, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Smartfren Data 1 GB / 3 Hari'),
(256, '256', 'Smartfren9', 'Data SmartFREN ', 'Smartfren Data 2 GB / 3 Hari', 8805, 7805, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Smartfren Data 2 GB / 3 Hari'),
(257, '257', 'Telkomsel-10', 'Pulsa Telkomsel ', 'Telkomsel 10.000', 11190, 10190, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Telkomsel Rp 10.000'),
(258, '258', 'Telkomsel-100', 'Pulsa Telkomsel ', 'Telkomsel 100.000', 99498, 98498, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Telkomsel 100.000'),
(259, '259', 'Telkomsel-15', 'Pulsa Telkomsel ', 'Telkomsel 15.000', 15860, 14860, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Telkomsel Rp 15.000'),
(260, '260', 'Telkomsel-150', 'Pulsa Telkomsel ', 'Telkomsel 150.000', 150667, 149667, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Telkomsel Rp 150.000'),
(261, '261', 'Telkomsel-20', 'Pulsa Telkomsel ', 'Telkomsel 20.000', 20790, 19790, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Telkomsel Rp 20.000'),
(262, '262', 'Telkomsel-200', 'Pulsa Telkomsel ', 'Telkomsel 200.000', 200802, 199802, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Telkomsel Rp 200.000'),
(263, '263', 'Telkomsel-25', 'Pulsa Telkomsel ', 'Telkomsel 25.000', 25780, 24780, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Telkomsel Rp 25.000'),
(264, '264', 'Telkomsel-30', 'Pulsa Telkomsel ', 'Telkomsel 30.000', 30740, 29740, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Telkomsel Rp 30.000'),
(265, '265', 'Telkomsel-50', 'Pulsa Telkomsel ', 'Telkomsel 50.000', 50610, 49610, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Telkomsel 50.000'),
(266, '266', 'Telkomsel-70', 'Pulsa Telkomsel ', 'Telkomsel 70.000', 70485, 69485, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Telkomsel Rp 70.000'),
(267, '267', 'Telkomsel-res-5', 'Pulsa Telkomsel ', 'Telkomsel 5.000', 6210, 5210, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Telkomsel Rp 5.000'),
(268, '268', 'telkomsel-ress-5', 'Pulsa Telkomsel ', 'Telkomsel 5.000', 6250, 5250, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Telkomsel Rp 5.000'),
(269, '269', 'Telkomsel15', 'Data Telkomsel ', 'Telkomsel Data 3 GB + 12 GB Videomax / 30 Hari', 51250, 50250, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Berlaku nasional, masa aktif 30 Hari'),
(270, '270', 'Telkomsel3', 'Data Telkomsel ', 'Telkomsel Data 1 GB + 2 GB Game / 30 Hari', 24760, 23760, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Flash 1GB + 2GB Game (30 hari)'),
(271, '271', 'Telkomsel35', 'Data Telkomsel ', 'Telkomsel Data 7 GB + 28 GB Videomax / 30 Hari', 104225, 103225, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Berlaku nasional, masa aktif 30 Hari'),
(272, '272', 'Telkomsel5', 'Data Telkomsel ', 'Telkomsel Data 1 GB + 5 GB Ruang Guru / 30 Hari', 26525, 25525, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'masa aktif 30 hr'),
(273, '273', 'Telkomsel6gb', 'Data Telkomsel ', 'Telkomsel Data 1 GB + 5 GB Videomax / 30 Hari', 24900, 23900, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Berlaku nasional, masa aktif 30 Hari'),
(274, '274', 'tf-Telkomsel5', 'Pulsa Telkomsel Transfer', 'Telkomsel Pulsa Transfer 5.000', 6505, 5505, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Telkomsel Rp 5.000 ( Tidak menambah masa aktif)'),
(275, '275', 'Three10', 'Pulsa Tri ', 'Three 10.000', 11373, 10373, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Three Rp 10.000'),
(276, '276', 'Three100', 'Pulsa Tri ', 'Three 100.000', 98887, 97887, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Three Rp 100.000'),
(277, '277', 'Three15', 'Pulsa Tri ', 'Three 15.000', 15883, 14883, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Three Rp 15.000'),
(278, '278', 'Three2', 'Pulsa Tri ', 'Three 2.000', 3296, 2296, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Three Rp 2.000'),
(279, '279', 'Three20', 'Pulsa Tri ', 'Three 20.000', 20724, 19724, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Three Rp 20.000'),
(280, '280', 'Three25', 'Pulsa Tri ', 'Three 25.000', 25604, 24604, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Three Rp 25.000'),
(281, '281', 'Three40', 'Pulsa Tri ', 'Three 40.000', 40513, 39513, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Three Rp 40.000'),
(282, '282', 'Three5', 'Pulsa Tri ', 'Three 5.000', 6503, 5503, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Three Rp 5.000'),
(283, '283', 'Three75', 'Pulsa Tri ', 'Three 75.000', 74825, 73825, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Three Rp 75.000'),
(284, '284', 'tlp-telkomsel50', ' Telkomsel ', 'Telkomsel Telepon 50.000', 57650, 56650, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Paket Sms Telpon', 'Telepon 1200 menit sesama, 100 menit semua op 15 Hari (sesuai zona)'),
(285, '285', 'tlp-telkomsel80', ' Telkomsel ', 'Telkomsel Telepon 80.000', 79000, 78000, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Paket Sms Telpon', 'Telepon 2000 menit sesama, 100 menit semua op 30 Hari (sesuai zona)'),
(286, '286', 'Tri1', 'Data Tri ', 'Tri Data 750 MB / 14 Hari', 5855, 4855, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Tri Data 750 MB / 14 Hari'),
(287, '287', 'Tri10', 'Data Tri ', 'Tri Data 2 GB / 30 Hari', 12960, 11960, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Tri Data 2 GB / 30 Hari'),
(288, '288', 'Tri12', 'Data Tri ', 'Tri Data 10 GB / 30 Hari', 45850, 44850, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Kuota 10GB ( 2G/3G/4G ) 24 JAM masa aktif 30 hari'),
(289, '289', 'Tri13', 'Data Tri ', 'Tri Data 15 GB / 30 Hari', 62626, 61626, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Kuota 15GB ( 2G/3G/4G ) 24 JAM masa aktif 30 hari'),
(290, '290', 'Tri14', 'Data Tri ', 'Tri Data 20 GB / 30 Hari', 69425, 68425, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Kuota 20GB ( 2G/3G/4G ) 24 JAM masa aktif 30 hari'),
(291, '291', 'Tri15', 'Data Tri ', 'Tri Data 33 GB / 30 Hari', 91325, 90325, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', '33 GB nasional 24 jam, 30 hari'),
(292, '292', 'Tri16', 'Data Tri ', 'Tri Data 22 GB + Unlimited YouTube dan VIU / 30 Hari', 70945, 69945, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'cek di web https://tri.co.id/AOn-Unlimited-22GB'),
(293, '293', 'Tri2', 'Data Tri ', 'Tri Data 1 GB / 14 Hari', 11710, 10710, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Tri Data 1 GB / 14 Hari'),
(294, '294', 'Tri3', 'Data Tri ', 'Tri Data 1.5 GB / 14 Hari', 10885, 9885, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Tri Data 1.5 GB / 14 Hari'),
(295, '295', 'Tri4', 'Data Tri ', 'Tri Data 2.5 GB / 14 Hari', 14950, 13950, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Tri Data 2.5 GB / 14 Hari'),
(296, '296', 'Tri5', 'Data Tri ', 'Tri Data 4 GB / 14 Hari', 26985, 25985, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Tri Data 4 GB / 14 Hari'),
(297, '297', 'Tri6', 'Data Tri ', 'Tri Data 100 MB / 30 Hari', 1660, 660, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Tri Data 100 MB / 30 Hari'),
(298, '298', 'Tri7', 'Data Tri ', 'Tri Data 200 MB / 30 Hari', 2455, 1455, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Tri Data 200 MB / 30 Hari'),
(299, '299', 'Tri8', 'Data Tri ', 'Tri Data 500 MB / 30 Hari', 4705, 3705, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Tri Data 500 MB / 30 Hari'),
(300, '300', 'Tri9', 'Data Tri ', 'Tri Data 1 GB / 30 Hari', 7540, 6540, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'Tri Data 1 GB / 30 Hari'),
(301, '301', 'Voc1', 'Voucher Axis ', 'Voucher AIGO 1 GB / 30 Hari', 14360, 13360, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Voucher', '1 GB All Jaringan Berlaku 24 Jam Masa Aktif 30 Hari'),
(302, '302', 'Voc2', 'Voucher Axis ', 'Voucher AIGO 1 GB / 30 Hari', 16999, 15999, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Voucher', '1 GB All Jaringan Berlaku 24 Jam Masa Aktif 30 Hari'),
(303, '303', 'Voc3', 'Voucher Axis ', 'Voucher AIGO 2 GB / 30 Hari', 24360, 23360, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Voucher', '2 GB All Jaringan Berlaku 24 Jam Masa Aktif 30 Hari. Setelah mendapat SN, ketik *838*kodevoucher# untuk mengaktifkan paket'),
(304, '304', 'VocSmart', 'Voucher SmartFREN ', 'Voucher Smartfren Data 2.5 GB / 7 Hari', 12105, 11105, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Voucher', '1.5GB Kuota Utama + 1GB Kuota Chat'),
(305, '305', 'Voucher1', 'Voucher Telkomsel ', 'Voucher Telkomsel Data 1.5 GB 3 Hari', 8105, 7105, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Voucher', '1,5 GB, 3 Hari. perhatikan zona dan regional.'),
(306, '306', 'Voucher3', 'Voucher Telkomsel ', 'Voucher Telkomsel Data 2.5 GB / 5 Hari', 12489, 11489, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Voucher', '2,5GB, 5 HARI. perhatikan zona dan regional.'),
(307, '307', 'Voucher4', 'Voucher Telkomsel ', 'Voucher Telkomsel Data 3.5 GB / 7 Hari', 19349, 18349, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Voucher', '3,5GB, 7 HARI. perhatikan zona dan regional.'),
(308, '308', 'Voucher5', 'Voucher Telkomsel ', 'Voucher Telkomsel Data 14 GB / 30 Hari', 75275, 74275, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Voucher', '12GB + 2GB OMG, 30 HARI. perhatikan zona dan regional.'),
(309, '309', 'XL1', 'Data XL ', 'XL Data 100 MB / 30 Hari', 3865, 2865, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', '100MB 30 Hari'),
(310, '310', 'Xl10', 'Pulsa XL ', 'Xl 10.000', 11635, 10635, 1000, 'Tidak', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Xl Rp 10.000'),
(311, '311', 'Xl100', 'Pulsa XL ', 'Xl 100.000', 99950, 98950, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Xl Rp 100.000'),
(312, '312', 'XL101', 'Data XL ', 'XL Data 6 GB 30 Hari', 56500, 55500, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'DRP DATA 6 GB, 2G3G4G, 30D'),
(313, '313', 'XL11', 'Data XL ', 'XL Data 8 GB 30 Hari', 77500, 76500, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'DRP DATA 8 GB, 2G3G4G, 30D'),
(314, '314', 'Xl15', 'Pulsa XL ', 'Xl 15.000', 15800, 14800, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Xl Rp 15.000'),
(315, '315', 'Xl150', 'Pulsa XL ', 'Xl 150.000', 150525, 149525, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Xl Rp 150.000');
INSERT INTO `layanan_pulsa` (`id`, `service_id`, `provider_id`, `operator`, `layanan`, `harga`, `harga_api`, `profit`, `multi`, `status`, `provider`, `tipe`, `catatan`) VALUES
(316, '316', 'XL2', 'Data XL ', 'XL Data 500 MB 30 Hari', 4850, 3850, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'DRP DATA 500 MB, 2G3G4G, 30D'),
(317, '317', 'Xl25', 'Pulsa XL ', 'Xl 25.000', 25990, 24990, 1000, 'Tidak', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Xl Rp 25.000'),
(318, '318', 'XL3', 'Data XL ', 'XL Data 800 MB 30 Hari', 7150, 6150, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'DRP DATA 800 MB, 2G3G4G, 30D'),
(319, '319', 'XL4', 'Data XL ', 'XL Data 1 GB 30 Hari', 8210, 7210, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'DRP DATA 1 GB, 2G3G4G, 30D'),
(320, '320', 'Xl5', 'Pulsa XL ', 'Xl 5.000', 6770, 5770, 1000, 'Tidak', 'Normal', 'DIGIFLAZZ', 'Pulsa', 'Pulsa Xl Rp 5.000'),
(321, '321', 'XL51', 'Data XL ', 'XL Data 2 GB 30 Hari', 14410, 13410, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'DRP DATA 2 GB, 2G3G4G, 30D'),
(322, '322', 'XL6', 'Data XL ', 'XL Data 3 GB 30 Hari', 22615, 21615, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'DRP DATA 3 GB, 2G3G4G, 30D'),
(323, '323', 'XL7', 'Data XL ', 'XL Data 4 GB 30 Hari', 27025, 26025, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'DRP DATA 4 GB, 2G3G4G, 30D'),
(324, '324', 'XL9', 'Data XL ', 'XL Data 5 GB 30 Hari', 36145, 35145, 1000, 'Ya', 'Normal', 'DIGIFLAZZ', 'Data', 'DRP DATA 5 GB, 2G3G4G, 30D');

-- --------------------------------------------------------

--
-- Table structure for table `layanan_sosmed`
--

CREATE TABLE `layanan_sosmed` (
  `id` int NOT NULL,
  `service_id` int NOT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `layanan` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `min` int NOT NULL,
  `max` int NOT NULL,
  `harga` double NOT NULL,
  `harga_api` double NOT NULL,
  `profit` double NOT NULL,
  `status` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_swedish_ci NOT NULL,
  `provider_id` int NOT NULL,
  `provider` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `tipe` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `aksi` enum('Login','Logout') NOT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `username`, `aksi`, `ip`, `date`, `time`) VALUES
(1, 'masuk123', 'Logout', '36.72.217.154', '2024-03-29', '14:38:45'),
(2, 'admin123', 'Login', '36.72.217.154', '2024-03-29', '14:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `metode_depo`
--

CREATE TABLE `metode_depo` (
  `id` int NOT NULL,
  `provider` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `tipe` enum('Bank','Pulsa Transfer') NOT NULL,
  `min` double NOT NULL,
  `max` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metode_depo`
--

INSERT INTO `metode_depo` (`id`, `provider`, `nama`, `rate`, `tujuan`, `tipe`, `min`, `max`) VALUES
(2, 'BCA', 'BCA', '1', 'BCA : 4372554171 A/N agus riyanto', 'Bank', 10000, 999999999),
(20, 'DANA', 'DANA MANUAL', '1', 'DANA : 083191910986 A/N agus riyanto', 'Bank', 10000, 999999999);

-- --------------------------------------------------------

--
-- Table structure for table `metode_depo1`
--

CREATE TABLE `metode_depo1` (
  `id` int NOT NULL,
  `jenis_saldo` enum('Saldo') NOT NULL,
  `minimal_deposit` varchar(250) NOT NULL,
  `tipe` enum('Pulsa','Bank','EMoney','EPayment','ECurrency','Virtual-Account','Convenience-Store') NOT NULL,
  `provider` varchar(255) NOT NULL,
  `jalur` enum('Auto','Manual') NOT NULL,
  `nama` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `tujuan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metode_depo1`
--

INSERT INTO `metode_depo1` (`id`, `jenis_saldo`, `minimal_deposit`, `tipe`, `provider`, `jalur`, `nama`, `rate`, `keterangan`, `tujuan`) VALUES
(39, 'Saldo', '10000', 'Virtual-Account', 'BRIVA', 'Auto', 'BRI Virtual Account ', '1', 'ON', 'Yabgroup'),
(41, 'Saldo', '10000', 'Virtual-Account', 'BNIVA', 'Auto', 'BNI Virtual Account ', '1', 'ON', 'Yabgroup'),
(43, 'Saldo', '10000', 'Virtual-Account', 'CIMBNIAGA', 'Auto', 'CIMB Virtual Account ', '1', 'ON', 'Yabgroup'),
(45, 'Saldo', '10000', 'Virtual-Account', 'MANDIRIVA', 'Auto', 'Mandiri Virtual Account ', '1', 'ON', 'Yabgroup'),
(47, 'Saldo', '5000', 'Convenience-Store', 'ALFAMART', 'Auto', 'Alfamart ( Online 24 Jam )', '1', 'ON', 'Yabgroup'),
(53, 'Saldo', '10000', 'EMoney', 'OVO', 'Auto', 'OVO ( Online 24 Jam )', '1', 'OFF', 'Yabgroup'),
(106, 'Saldo', '10000', 'EMoney', 'QRIS', 'Auto', 'QRIS Auto ( Online 24 Jam )', '1', 'ON', 'Yabgroup'),
(107, 'Saldo', '10000', 'Virtual-Account', 'PERMATAVA', 'Auto', 'Permata Virtual Account ', '1', 'ON', 'Yabgroup'),
(108, 'Saldo', '10000', 'Virtual-Account', 'MAYBANK', 'Auto', 'MayBank Virtual Account ', '1', 'ON', 'Yabgroup');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_game`
--

CREATE TABLE `pembelian_game` (
  `id` int NOT NULL,
  `oid` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `poid` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `user` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `service` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `price` double NOT NULL,
  `data` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `zoneid` varchar(255) COLLATE utf8mb3_swedish_ci NOT NULL,
  `status` enum('Pending','Processing','Error','Success') COLLATE utf8mb3_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `place_from` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL DEFAULT 'WEB',
  `provider` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `refund` enum('0','1') COLLATE utf8mb3_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_pulsa`
--

CREATE TABLE `pembelian_pulsa` (
  `id` int NOT NULL,
  `oid` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `provider_oid` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `user` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `layanan` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `harga` double NOT NULL,
  `profit` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `target` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `no_meter` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `keterangan` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `status` enum('Pending','Processing','Error','Partial','Success') COLLATE utf8mb3_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `place_from` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL DEFAULT 'WEB',
  `provider` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `refund` enum('0','1') COLLATE utf8mb3_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `pembelian_pulsa`
--

INSERT INTO `pembelian_pulsa` (`id`, `oid`, `provider_oid`, `user`, `layanan`, `harga`, `profit`, `target`, `no_meter`, `keterangan`, `status`, `date`, `time`, `place_from`, `provider`, `refund`) VALUES
(1, '2944425', '2944425', 'demo123', 'PLN 20.000', 21035, '1000', '525043061624', '', '5289-3289-8699-6828-1803/AGUSRIYANTO/R1M/900/13,50.', 'Success', '2024-01-30', '09:38:16', 'Website', 'DIGIFLAZZ', '0'),
(2, '8327963', '8327963', 'demo123', 'DANA 100.000', 101175, '1000', '083191910986', '', 'dana - 083191910986/DANATOPUP AGUX RIYXX/Reff: 145125187', 'Success', '2024-02-02', '21:36:54', 'Website', 'DIGIFLAZZ', '0'),
(3, '4433788', '4433788', 'demo123', 'DANA 50.000', 51250, '0', '083191910986', '', '', 'Error', '2024-02-02', '21:39:49', 'Website', 'DIGIFLAZZ', '1'),
(4, '5938378', '5938378', 'demo123', 'PLN 20.000', 21035, '1000', '525043061624', '', '3598-9944-1102-3744-4471/AGUSRIYANTO/R1M/900 VA/13,5', 'Success', '2024-02-02', '21:43:46', 'Website', 'DIGIFLAZZ', '0'),
(5, '4504622', '4504622', 'demo123', 'DANA 25.000', 26160, '1000', '083191910986', '', 'DANA/AGUX-RIYXXXX/25000/Ref:2024020210121481030100166025565251826', 'Success', '2024-02-02', '22:06:23', 'Website', 'DIGIFLAZZ', '0'),
(6, '7232677', '7232677', 'demo123', 'DANA 20.000', 21160, '1000', '083191910986', '', 'DANA/AGUX-RIYXXXX/20000/Ref:2024020210121481030100166025565218479', 'Success', '2024-02-02', '22:07:29', 'Website', 'DIGIFLAZZ', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_sosmed`
--

CREATE TABLE `pembelian_sosmed` (
  `id` int NOT NULL,
  `oid` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `provider_oid` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `user` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `layanan` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `target` text COLLATE utf8mb3_swedish_ci NOT NULL,
  `jumlah` int NOT NULL,
  `remains` varchar(10) COLLATE utf8mb3_swedish_ci NOT NULL,
  `start_count` varchar(10) COLLATE utf8mb3_swedish_ci NOT NULL,
  `harga` double NOT NULL,
  `profit` double NOT NULL,
  `status` enum('Pending','Processing','In Progress','Error','Partial','Canceled','Completed','Success') COLLATE utf8mb3_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `provider` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `place_from` enum('Website','API') COLLATE utf8mb3_swedish_ci NOT NULL,
  `refund` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesan_tiket`
--

CREATE TABLE `pesan_tiket` (
  `id` int NOT NULL,
  `id_tiket` int NOT NULL,
  `pengirim` enum('Member','team-support') COLLATE utf8mb3_swedish_ci NOT NULL,
  `user` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `pesan` text COLLATE utf8mb3_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `update_terakhir` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `pesan_tiket`
--

INSERT INTO `pesan_tiket` (`id`, `id_tiket`, `pengirim`, `user`, `pesan`, `date`, `time`, `update_terakhir`) VALUES
(3, 5, 'team-support', 'admin123', 'masuk', '2023-03-06', '15:23:35', '2023-03-06 15:23:35'),
(4, 6, 'team-support', 'kingpedia', 'OK', '2023-06-15', '22:23:00', '2023-06-15 22:23:00'),
(5, 6, 'Member', 'kingpedia', 'done', '2023-06-16', '00:51:34', '2023-06-16 00:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `pesan_tsel`
--

CREATE TABLE `pesan_tsel` (
  `id` int NOT NULL,
  `isi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `status` enum('UNREAD','READ') NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

CREATE TABLE `provider` (
  `id` int NOT NULL,
  `code` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `link` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `api_key` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `api_id` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `secret_key` varchar(250) COLLATE utf8mb3_swedish_ci NOT NULL,
  `profit` varchar(10) COLLATE utf8mb3_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`id`, `code`, `link`, `api_key`, `api_id`, `secret_key`, `profit`) VALUES
(1, 'ZAYNFLAZZ', 'https://zaynflazz.com/api/sosial-media', 'KU5fTIfxo6q', '-', '', '1.3'),
(14, 'DIGIFLAZZ', 'https://api.digiflazz.com/v1/transaction', '5222-b25f-5d41-a38d-93cffcd3a6b2', 'gozogYKNxD', 'dev-9bded8c0-11ed-9316-cd0afb07f6a0', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_transfer`
--

CREATE TABLE `riwayat_transfer` (
  `id` int NOT NULL,
  `pengirim` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `penerima` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `jumlah` double NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting_web`
--

CREATE TABLE `setting_web` (
  `id` int NOT NULL,
  `short_title` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `deskripsi_web` text NOT NULL,
  `ig_akun` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `facebook_akun` varchar(50) NOT NULL,
  `wa_number` varchar(13) NOT NULL,
  `email_akun` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `daftar_reseller` varchar(100) NOT NULL,
  `logo_web` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_web`
--

INSERT INTO `setting_web` (`id`, `short_title`, `title`, `deskripsi_web`, `ig_akun`, `date`, `time`, `facebook_akun`, `wa_number`, `email_akun`, `twitter`, `daftar_reseller`, `logo_web`) VALUES
(1, 'YAB-GROUP NUSANTARA', 'YAB-GROUP NUSANTARA  PPOB Pulsa, token, data dll', 'YAB-GROUP NUSANTARA adalah Sebuah platform bisnis yang menyediakan berbagai layanan pulsa, paket data, token PLN dan multi media marketing yang bergerak terutama di Indonesia.', '', '2019-01-03', '16:06:10', '', '6283191910986', 'yabgroup123@gmail.com', '', '150000', 'https://kingspedia.com/assets/images/logo-b.png');

-- --------------------------------------------------------

--
-- Table structure for table `set_online_users`
--

CREATE TABLE `set_online_users` (
  `id` int NOT NULL,
  `admin` varchar(50) NOT NULL,
  `staff` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_online_users`
--

INSERT INTO `set_online_users` (`id`, `admin`, `staff`, `user`) VALUES
(1, '0', '4', '39');

-- --------------------------------------------------------

--
-- Table structure for table `set_top_pengguna`
--

CREATE TABLE `set_top_pengguna` (
  `id` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `nominal` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_top_pengguna`
--

INSERT INTO `set_top_pengguna` (`id`, `nama`, `jumlah`, `nominal`) VALUES
(1, 'satu', '1', '1000'),
(2, 'dua', '1000', '40000');

-- --------------------------------------------------------

--
-- Table structure for table `set_total_pengguna`
--

CREATE TABLE `set_total_pengguna` (
  `id` int NOT NULL,
  `pengguna` varchar(50) NOT NULL,
  `pesanan` varchar(100) NOT NULL,
  `layanan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_total_pengguna`
--

INSERT INTO `set_total_pengguna` (`id`, `pengguna`, `pesanan`, `layanan`) VALUES
(1, '500', '300', '1992');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `facebook` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `wa` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `level` enum('Developers','Admin','Resseler','Agen') COLLATE utf8mb3_swedish_ci NOT NULL,
  `link_fb` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `tugas` text COLLATE utf8mb3_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id` int NOT NULL,
  `user` varchar(50) NOT NULL,
  `subjek` varchar(250) NOT NULL,
  `pesan` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `update_terakhir` datetime NOT NULL,
  `status` enum('Pending','Responded','Waiting','Closed') NOT NULL,
  `this_user` int NOT NULL,
  `this_admin` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` text COLLATE utf8mb3_swedish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb3_swedish_ci DEFAULT NULL,
  `nomer` varchar(20) COLLATE utf8mb3_swedish_ci NOT NULL,
  `pin` varchar(6) COLLATE utf8mb3_swedish_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `saldo` int NOT NULL,
  `pemakaian_saldo` double NOT NULL,
  `level` enum('Member','Agen','Admin','Developers','Reseller') COLLATE utf8mb3_swedish_ci NOT NULL,
  `status` enum('Aktif','Tidak Aktif') COLLATE utf8mb3_swedish_ci NOT NULL,
  `api_key` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `uplink` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `update_nama` int NOT NULL,
  `random_kode` varchar(20) COLLATE utf8mb3_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `nomer`, `pin`, `username`, `password`, `saldo`, `pemakaian_saldo`, `level`, `status`, `api_key`, `uplink`, `date`, `time`, `update_nama`, `random_kode`) VALUES
(1, 'admin', 'admin@gmail.com', '0678678678', '0', 'admin123', '$2y$10$6EfsmPSL14qWYk/ulw03X.jYe.LEjmW6x9yf3kJ9d6xpSJ9cReWyy', 0, 0, 'Developers', 'Aktif', 'c8deicAP7IjC1tBEBdL6MRYzjJ5cWxRFjKnk45tVxg', 'Pendaftaran Gratis', '0000-00-00', '00:00:00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `voucher_deposit`
--

CREATE TABLE `voucher_deposit` (
  `id` int NOT NULL,
  `voucher` varchar(50) NOT NULL,
  `saldo` varchar(250) NOT NULL,
  `status` enum('active','sudah di redeem') NOT NULL,
  `user` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `yabgroup`
--

CREATE TABLE `yabgroup` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `api_key` varchar(250) NOT NULL,
  `secret_key` varchar(300) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `yabgroup`
--

INSERT INTO `yabgroup` (`id`, `nama`, `api_key`, `secret_key`, `url`) VALUES
(1, 'YABGROUP', 'isi apikey', 'isi secretkey', 'https://yab-group.com/api/sanbox/create');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bot_whatsapp`
--
ALTER TABLE `bot_whatsapp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit_bank`
--
ALTER TABLE `deposit_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `halaman`
--
ALTER TABLE `halaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `harga_pendaftaran`
--
ALTER TABLE `harga_pendaftaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_saldo`
--
ALTER TABLE `history_saldo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_layanan`
--
ALTER TABLE `kategori_layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_pulsa`
--
ALTER TABLE `kategori_pulsa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak_kami`
--
ALTER TABLE `kontak_kami`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan_pulsa`
--
ALTER TABLE `layanan_pulsa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan_sosmed`
--
ALTER TABLE `layanan_sosmed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metode_depo`
--
ALTER TABLE `metode_depo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metode_depo1`
--
ALTER TABLE `metode_depo1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian_game`
--
ALTER TABLE `pembelian_game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian_pulsa`
--
ALTER TABLE `pembelian_pulsa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian_sosmed`
--
ALTER TABLE `pembelian_sosmed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan_tiket`
--
ALTER TABLE `pesan_tiket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan_tsel`
--
ALTER TABLE `pesan_tsel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_transfer`
--
ALTER TABLE `riwayat_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_web`
--
ALTER TABLE `setting_web`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `set_online_users`
--
ALTER TABLE `set_online_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `set_top_pengguna`
--
ALTER TABLE `set_top_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `set_total_pengguna`
--
ALTER TABLE `set_total_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher_deposit`
--
ALTER TABLE `voucher_deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yabgroup`
--
ALTER TABLE `yabgroup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bot_whatsapp`
--
ALTER TABLE `bot_whatsapp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposit_bank`
--
ALTER TABLE `deposit_bank`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `halaman`
--
ALTER TABLE `halaman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `harga_pendaftaran`
--
ALTER TABLE `harga_pendaftaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `history_saldo`
--
ALTER TABLE `history_saldo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kategori_layanan`
--
ALTER TABLE `kategori_layanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_pulsa`
--
ALTER TABLE `kategori_pulsa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `kontak_kami`
--
ALTER TABLE `kontak_kami`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `layanan_pulsa`
--
ALTER TABLE `layanan_pulsa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT for table `layanan_sosmed`
--
ALTER TABLE `layanan_sosmed`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `metode_depo`
--
ALTER TABLE `metode_depo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `metode_depo1`
--
ALTER TABLE `metode_depo1`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `pembelian_game`
--
ALTER TABLE `pembelian_game`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembelian_pulsa`
--
ALTER TABLE `pembelian_pulsa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pembelian_sosmed`
--
ALTER TABLE `pembelian_sosmed`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesan_tiket`
--
ALTER TABLE `pesan_tiket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesan_tsel`
--
ALTER TABLE `pesan_tsel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provider`
--
ALTER TABLE `provider`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `riwayat_transfer`
--
ALTER TABLE `riwayat_transfer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting_web`
--
ALTER TABLE `setting_web`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `set_online_users`
--
ALTER TABLE `set_online_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `set_top_pengguna`
--
ALTER TABLE `set_top_pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `set_total_pengguna`
--
ALTER TABLE `set_total_pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `voucher_deposit`
--
ALTER TABLE `voucher_deposit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `yabgroup`
--
ALTER TABLE `yabgroup`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
