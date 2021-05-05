-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Bulan Mei 2021 pada 08.29
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bang_jago`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `nama_bank` varchar(20) NOT NULL,
  `logo_bank` text NOT NULL,
  `biaya_transfer` bigint(20) NOT NULL,
  `biaya_tarik_tunai` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bank`
--

INSERT INTO `bank` (`id`, `nama_bank`, `logo_bank`, `biaya_transfer`, `biaya_tarik_tunai`, `created_at`, `updated_at`) VALUES
(3, 'BNI', 'img-1619492518-e0e5a7a83dd7b3ac.jpg', 5000, 100000, '2021-04-27 10:01:58', '2021-04-27 10:01:58'),
(4, 'BNI', 'img-1619492655-a25c4ade629929ef.jpg', 5000, 1000002, '2021-04-27 10:04:15', '2021-04-27 10:04:15'),
(5, 'BNI221', 'img-1619505672-3034ec6e84ea278a.png', 5000221, 100000221, '2021-04-27 10:13:34', '2021-04-27 13:41:12'),
(6, 'BNIA', 'img-1619493279-bcb669fbe4ca5acb.jpg', 20000, 100000, '2021-04-27 10:14:39', '2021-04-27 10:14:39'),
(7, 'BNIA', 'img-1619493318-431c23c003836ada.jpg', 20000, 100000, '2021-04-27 10:15:18', '2021-04-27 10:15:18'),
(8, 'BRI', 'img-1619493358-811a74a80eb8cbcc.jpg', 20000, 100000, '2021-04-27 10:15:58', '2021-04-27 10:15:58'),
(9, 'BNIA', 'img-1619493372-2b4117af1ef4c95a.jpg', 20000, 100000, '2021-04-27 10:16:12', '2021-04-27 10:16:12'),
(10, 'BNI', 'img-1619493390-09a59e6f803313a8.jpg', 20000, 100000, '2021-04-27 10:16:30', '2021-04-27 10:16:30'),
(11, 'BNI', 'img-1619493551-b3150262b835f06a.jpg', 5000, 10000, '2021-04-27 10:19:11', '2021-04-27 10:19:11'),
(12, 'BCA', 'img-1620015073-f1171ea88a2d3c4e.png', 5000, 10000, '2021-04-27 10:25:48', '2021-05-03 11:11:14'),
(13, 'BNI', 'img-1619494051-bf4883971a0ce865.jpg', 5000, 10000, '2021-04-27 10:27:31', '2021-04-27 10:27:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank_pelanggan`
--

CREATE TABLE `bank_pelanggan` (
  `id` int(11) NOT NULL,
  `id_bank` int(11) NOT NULL,
  `nomor_rekening` bigint(20) NOT NULL,
  `nama_pemilik` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bank_pelanggan`
--

INSERT INTO `bank_pelanggan` (`id`, `id_bank`, `nomor_rekening`, `nama_pemilik`, `created_at`, `updated_at`) VALUES
(2, 5, 243452, 'Budi', '2021-04-28 10:54:10', '2021-04-30 15:03:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang`
--

CREATE TABLE `cabang` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `provinsi_id` int(11) NOT NULL,
  `kota_id` int(11) NOT NULL,
  `nama_cabang` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `penanggung_jawab` varchar(30) NOT NULL,
  `no_telepon_pic` varchar(20) NOT NULL,
  `jam_operasional` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cabang`
--

INSERT INTO `cabang` (`id`, `users_id`, `provinsi_id`, `kota_id`, `nama_cabang`, `alamat`, `penanggung_jawab`, `no_telepon_pic`, `jam_operasional`, `created_at`, `updated_at`) VALUES
(2, 1, 11, 31, 'Booth Royal a', 'Jl. A Yani', 'Sururin', '2234234', '10:00-17:00', '2021-04-30 15:05:40', '2021-04-30 15:05:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `provinsi_id` int(11) NOT NULL,
  `nama` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinces`
--

CREATE TABLE `provinces` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(30) NOT NULL,
  `permission` mediumtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `nama_role`, `permission`, `created_at`, `updated_at`) VALUES
(4, 'Admin Cabang', '[\"2\",\"3\",\"5\"]', '2021-04-30 10:54:47', '2021-04-30 10:54:47'),
(5, 'Pemilik', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', '2021-04-30 10:55:02', '2021-05-03 11:10:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan`
--

CREATE TABLE `tagihan` (
  `id` int(11) NOT NULL,
  `nama_tagihan` varchar(30) NOT NULL,
  `logo_tagihan` text NOT NULL,
  `biaya_tarik_tunai` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tagihan`
--

INSERT INTO `tagihan` (`id`, `nama_tagihan`, `logo_tagihan`, `biaya_tarik_tunai`, `created_at`, `updated_at`) VALUES
(1, 'PDAM', 'img-1619576197-a3cc70e97fc983b2.jpg', 500002, '2021-04-28 09:16:37', '2021-04-28 09:16:46'),
(2, 'BPJS', 'bpjs', 60000, '2021-04-28 10:55:16', '2021-04-28 10:55:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan_pelanggan`
--

CREATE TABLE `tagihan_pelanggan` (
  `id` int(11) NOT NULL,
  `id_jenis_tagihan` int(11) NOT NULL,
  `nomor_id` bigint(20) NOT NULL,
  `nama_pemilik` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tagihan_pelanggan`
--

INSERT INTO `tagihan_pelanggan` (`id`, `id_jenis_tagihan`, `nomor_id`, `nama_pemilik`, `created_at`, `updated_at`) VALUES
(1, 2, 34534534512, 'Sasa12', '2021-04-28 10:54:52', '2021-04-28 11:00:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_bank`
--

CREATE TABLE `transaksi_bank` (
  `id` int(11) NOT NULL,
  `cabang_id` int(11) NOT NULL,
  `jenis_transaksi` varchar(20) NOT NULL,
  `nomor_transaksi` varchar(50) NOT NULL,
  `nama_bank` varchar(40) NOT NULL,
  `nomor_rekening` bigint(20) NOT NULL,
  `nama_pemilik` varchar(40) NOT NULL,
  `nominal_transfer` bigint(20) NOT NULL,
  `biaya_ongkos` bigint(20) NOT NULL,
  `total` bigint(20) NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_bank`
--

INSERT INTO `transaksi_bank` (`id`, `cabang_id`, `jenis_transaksi`, `nomor_transaksi`, `nama_bank`, `nomor_rekening`, `nama_pemilik`, `nominal_transfer`, `biaya_ongkos`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'transfer', '22042021-00000001', 'BCA', 12345678982, 'Sasa', 100000, 2000, 102000, 'Selesai', '2021-04-28 11:49:30', '2021-04-28 15:27:05'),
(2, 1, 'tarik tunai', '22042021-39483948', 'BRI', 2838249284, 'Budi R', 100000, 4000, 104000, 'Selesai', '2021-04-28 11:49:30', '2021-04-28 15:04:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_tagihan`
--

CREATE TABLE `transaksi_tagihan` (
  `id` int(11) NOT NULL,
  `cabang_id` int(11) NOT NULL,
  `nomor_transaksi` varchar(50) NOT NULL,
  `jenis_tagihan` varchar(20) NOT NULL,
  `nomor_id` bigint(20) NOT NULL,
  `nama_pemilik` varchar(30) NOT NULL,
  `nominal_tagihan` bigint(20) NOT NULL,
  `biaya_ongkos` bigint(20) NOT NULL,
  `total` bigint(20) NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_tagihan`
--

INSERT INTO `transaksi_tagihan` (`id`, `cabang_id`, `nomor_transaksi`, `jenis_tagihan`, `nomor_id`, `nama_pemilik`, `nominal_tagihan`, `biaya_ongkos`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '22042021-39533442', 'PDAM', 123123123, 'Sandi', 200000, 5000, 205000, 'Selesai', '2021-04-28 15:39:52', '2021-04-28 15:52:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `no_telepon`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Zidan R1', 'budi@bangjago.com', '$2y$10$EZKIwRuTxqVWpWEOnmsnn.7suNBGuaWUsluxe3sm4XH5sS/FZJxnm', '1231231', 5, '2021-04-30 10:58:50', '2021-05-03 09:02:50'),
(3, 'Sasa', 'admin@dev.com', '$2y$10$Xq5rSN0zt8mpeufiif9oMu7HR.pDIJCc8lm8wEYnJrTA2mnn6fu9a', '123123', 4, '2021-04-30 15:02:38', '2021-05-03 09:03:18');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bank_pelanggan`
--
ALTER TABLE `bank_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tagihan_pelanggan`
--
ALTER TABLE `tagihan_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_bank`
--
ALTER TABLE `transaksi_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_tagihan`
--
ALTER TABLE `transaksi_tagihan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `bank_pelanggan`
--
ALTER TABLE `bank_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tagihan_pelanggan`
--
ALTER TABLE `tagihan_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi_bank`
--
ALTER TABLE `transaksi_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi_tagihan`
--
ALTER TABLE `transaksi_tagihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
