-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Agu 2024 pada 10.23
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_management_waste_bank`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `balance` decimal(15,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `accounts`
--

INSERT INTO `accounts` (`account_id`, `user_id`, `balance`, `created_at`, `updated_at`) VALUES
(2, 2, 6000.00, '2024-08-02 08:02:11', '2024-08-13 08:43:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_price` decimal(10,0) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_price`, `category_image`, `created_at`, `updated_at`) VALUES
(1, 'Plastic', 3000, 'plastic.jpg', '2024-08-02 19:10:20', '2024-08-10 01:10:58'),
(2, 'Paper', 3000, 'paper.webp', '2024-08-02 19:10:20', '2024-08-08 12:42:20'),
(3, 'Metal', 2000, 'images.png', '2024-08-08 12:27:34', '2024-08-08 13:00:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pickups`
--

CREATE TABLE `pickups` (
  `pickup_id` int(11) NOT NULL,
  `account` int(11) DEFAULT NULL,
  `pickup_schedule` datetime DEFAULT NULL,
  `pickup_finished` datetime DEFAULT NULL,
  `pickup_type` enum('Dijemput','Langsung') DEFAULT NULL,
  `pickup_status` enum('Sedang Diperjalanan','Ditolak','Selesai') NOT NULL,
  `waste_weight` double DEFAULT NULL,
  `category` int(11) NOT NULL,
  `waste_condition` varchar(255) DEFAULT NULL,
  `pickup_note` varchar(255) NOT NULL,
  `officer` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pickups`
--

INSERT INTO `pickups` (`pickup_id`, `account`, `pickup_schedule`, `pickup_finished`, `pickup_type`, `pickup_status`, `waste_weight`, `category`, `waste_condition`, `pickup_note`, `officer`, `created_at`, `updated_at`) VALUES
(40, 2, '2024-08-28 07:41:00', '2024-08-13 07:42:31', 'Langsung', 'Selesai', 2, 1, 'baik', 'hati hati', NULL, '2024-08-13 00:42:31', '2024-08-13 08:43:54'),
(41, 2, '2024-08-21 07:42:00', '2024-08-13 07:42:47', 'Langsung', 'Selesai', 0, 2, '-', 'udah', NULL, '2024-08-13 00:42:47', '2024-08-13 00:42:47'),
(63, 2, '2024-08-31 09:11:00', '2024-08-13 09:27:04', 'Dijemput', 'Sedang Diperjalanan', 0, 1, '-', 'wkkkk', NULL, '2024-08-13 02:27:04', '2024-08-13 02:27:04'),
(64, 2, '2024-08-14 09:27:00', '2024-08-13 09:27:52', 'Langsung', 'Selesai', 0, 2, '-', 'huhuhu', NULL, '2024-08-13 02:27:52', '2024-08-13 02:27:52'),
(65, 2, '2024-08-23 09:32:00', '2024-08-13 09:32:53', 'Dijemput', 'Sedang Diperjalanan', 0, 2, '-', 'udah kan', NULL, '2024-08-13 02:32:53', '2024-08-13 02:32:53'),
(66, 2, '2024-08-13 09:33:00', '2024-08-13 09:33:17', 'Langsung', 'Selesai', 0, 3, '-', 'huhu', NULL, '2024-08-13 02:33:17', '2024-08-13 02:33:17'),
(67, 2, '2024-08-29 09:37:00', '2024-08-13 09:37:53', 'Dijemput', 'Sedang Diperjalanan', 0, 1, '-', '', NULL, '2024-08-13 02:37:53', '2024-08-13 02:37:53'),
(68, 2, '2024-08-13 09:38:00', '2024-08-13 09:38:08', 'Langsung', 'Selesai', 0, 2, '-', '', NULL, '2024-08-13 02:38:08', '2024-08-13 02:38:08'),
(69, 2, '2024-08-30 09:39:00', '2024-08-13 09:39:21', 'Dijemput', 'Sedang Diperjalanan', 1, 1, 'baik', 'hahaha', NULL, '2024-08-13 02:39:21', '2024-08-14 19:18:03'),
(70, 2, '2024-08-22 09:39:00', '2024-08-13 09:40:06', 'Langsung', 'Selesai', 0, 1, '-', '', NULL, '2024-08-13 02:40:06', '2024-08-13 02:40:06'),
(71, 2, '2024-08-22 09:39:00', '2024-08-13 09:42:41', 'Langsung', 'Selesai', 0, 1, '-', '', NULL, '2024-08-13 02:42:41', '2024-08-13 02:42:41');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `pickup_view`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `pickup_view` (
`pickup_id` int(11)
,`pickup_schedule` datetime
,`pickup_finished` datetime
,`pickup_type` enum('Dijemput','Langsung')
,`pickup_status` enum('Sedang Diperjalanan','Ditolak','Selesai')
,`waste_weight` double
,`waste_condition` varchar(255)
,`pickup_note` varchar(255)
,`category_id` int(11)
,`category_name` varchar(100)
,`category_price` decimal(10,0)
,`category_image` varchar(255)
,`account_id` int(11)
,`user_id` int(11)
,`full_name` varchar(100)
,`address` varchar(255)
,`rt` char(2)
,`balance` decimal(15,2)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `recent_pickups`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `recent_pickups` (
`category_id` int(11)
,`category_name` varchar(100)
,`category_price` decimal(10,0)
,`category_image` varchar(255)
,`pickup_id` int(11)
,`pickup_schedule` datetime
,`pickup_finished` datetime
,`pickup_type` enum('Dijemput','Langsung')
,`pickup_status` enum('Sedang Diperjalanan','Ditolak','Selesai')
,`waste_weight` double
,`waste_condition` varchar(255)
,`pickup_note` varchar(255)
,`account_id` int(11)
,`balance` decimal(15,2)
,`user_id` int(11)
,`username` varchar(50)
,`full_name` varchar(100)
,`email` varchar(100)
,`family_card_number` varchar(50)
,`phone_number` varchar(20)
,`address` varchar(255)
,`rt` char(2)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2024-08-02 07:46:32', '2024-08-02 07:46:32'),
(2, 'Petugas', '2024-08-02 07:46:32', '2024-08-02 07:46:32'),
(3, 'Warga', '2024-08-02 07:46:32', '2024-08-02 07:46:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `pickup` int(11) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount` double(15,2) DEFAULT NULL,
  `transaction_status` enum('Sedang Diproses','Dibatalkan','Selesai') NOT NULL,
  `transaction_information` varchar(255) DEFAULT NULL,
  `admin` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `pickup`, `transaction_date`, `amount`, `transaction_status`, `transaction_information`, `admin`, `created_at`, `updated_at`) VALUES
(15, 40, '2024-08-13 08:43:53', 6000.00, 'Selesai', '', NULL, '2024-08-13 00:42:32', '2024-08-13 08:43:53'),
(16, 41, '2024-08-13 05:20:16', 0.00, 'Dibatalkan', 'yu', NULL, '2024-08-13 00:42:47', '2024-08-13 05:20:16'),
(17, 66, '0000-00-00 00:00:00', 0.00, 'Sedang Diproses', NULL, NULL, '2024-08-13 02:33:17', '2024-08-13 02:33:17'),
(18, 68, '0000-00-00 00:00:00', 0.00, 'Sedang Diproses', NULL, NULL, '2024-08-13 02:38:08', '2024-08-13 02:38:08'),
(19, 70, '2024-08-13 05:20:38', 0.00, 'Sedang Diproses', '', NULL, '2024-08-13 02:40:08', '2024-08-13 05:20:38'),
(20, 71, '2024-08-13 03:32:03', 0.00, 'Dibatalkan', '', NULL, '2024-08-13 02:42:41', '2024-08-13 03:32:03'),
(36, 69, '2024-08-14 19:18:03', 3000.00, 'Sedang Diproses', NULL, NULL, '2024-08-14 19:18:03', '2024-08-14 19:18:03');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `transaction_view`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `transaction_view` (
`account_id` int(11)
,`user_id` int(11)
,`balance` decimal(15,2)
,`pickup_id` int(11)
,`pickup_schedule` datetime
,`pickup_finished` datetime
,`pickup_type` enum('Dijemput','Langsung')
,`pickup_status` enum('Sedang Diperjalanan','Ditolak','Selesai')
,`waste_weight` double
,`waste_condition` varchar(255)
,`pickup_note` varchar(255)
,`category_id` int(11)
,`category_name` varchar(100)
,`category_price` decimal(10,0)
,`category_image` varchar(255)
,`transaction_id` int(11)
,`transaction_date` timestamp
,`amount` double(15,2)
,`transaction_status` enum('Sedang Diproses','Dibatalkan','Selesai')
,`transaction_information` varchar(255)
,`username` varchar(50)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `family_card_number` varchar(50) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `rt` char(2) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `password_hash`, `email`, `full_name`, `family_card_number`, `phone_number`, `address`, `rt`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'johndoet', '$2y$10$RFA14JUPJQHEh4sTsztbi.15vmRLPrBgJ234VlCt/DD3Clnt2TWja', 'johndoe1@example.com', 'John Doet', '2234567890', '08123456781', '1234 Street', '3', 1, '2024-08-02 08:01:33', '2024-08-11 15:50:29'),
(2, 'janedoe', '$2y$10$jbixbYsmkG0Aqf6LN.LfJep8wdZhllXnfCTSEs5s4p.rtQ0kslEF.', 'janedoet@example.com', 'Jane Doet', '0987654323', '089876543211', '456 Avenued                                                                ', '5', 3, '2024-08-02 08:01:33', '2024-08-13 13:20:47'),
(15, 'Scott', '$2y$10$O1I0F06rF0lZnKju0Q28C.RaYM34C.gfSUaOaupMQVnO7ibMCPx/K', 'carlosreal@gmail.com', 'Carlos Scott', '8888888888888888', '08123456781', 'ututuututut', '5', 2, '2024-08-13 09:39:54', '2024-08-13 09:39:54');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `user_account_roles`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `user_account_roles` (
`user_id` int(11)
,`username` varchar(50)
,`email` varchar(100)
,`full_name` varchar(100)
,`family_card_number` varchar(50)
,`phone_number` varchar(20)
,`address` varchar(255)
,`rt` char(2)
,`role_id` int(11)
,`role_name` varchar(50)
,`account_id` int(11)
,`balance` decimal(15,2)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `pickup_view`
--
DROP TABLE IF EXISTS `pickup_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pickup_view`  AS SELECT `p`.`pickup_id` AS `pickup_id`, `p`.`pickup_schedule` AS `pickup_schedule`, `p`.`pickup_finished` AS `pickup_finished`, `p`.`pickup_type` AS `pickup_type`, `p`.`pickup_status` AS `pickup_status`, `p`.`waste_weight` AS `waste_weight`, `p`.`waste_condition` AS `waste_condition`, `p`.`pickup_note` AS `pickup_note`, `c`.`category_id` AS `category_id`, `c`.`category_name` AS `category_name`, `c`.`category_price` AS `category_price`, `c`.`category_image` AS `category_image`, `a`.`account_id` AS `account_id`, `a`.`user_id` AS `user_id`, `u`.`full_name` AS `full_name`, `u`.`address` AS `address`, `u`.`rt` AS `rt`, `a`.`balance` AS `balance` FROM (((`pickups` `p` join `categories` `c` on(`p`.`category` = `c`.`category_id`)) join `accounts` `a` on(`p`.`account` = `a`.`account_id`)) join `users` `u` on(`a`.`user_id` = `u`.`user_id`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `recent_pickups`
--
DROP TABLE IF EXISTS `recent_pickups`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `recent_pickups`  AS SELECT `categories`.`category_id` AS `category_id`, `categories`.`category_name` AS `category_name`, `categories`.`category_price` AS `category_price`, `categories`.`category_image` AS `category_image`, `pickups`.`pickup_id` AS `pickup_id`, `pickups`.`pickup_schedule` AS `pickup_schedule`, `pickups`.`pickup_finished` AS `pickup_finished`, `pickups`.`pickup_type` AS `pickup_type`, `pickups`.`pickup_status` AS `pickup_status`, `pickups`.`waste_weight` AS `waste_weight`, `pickups`.`waste_condition` AS `waste_condition`, `pickups`.`pickup_note` AS `pickup_note`, `accounts`.`account_id` AS `account_id`, `accounts`.`balance` AS `balance`, `users`.`user_id` AS `user_id`, `users`.`username` AS `username`, `users`.`full_name` AS `full_name`, `users`.`email` AS `email`, `users`.`family_card_number` AS `family_card_number`, `users`.`phone_number` AS `phone_number`, `users`.`address` AS `address`, `users`.`rt` AS `rt` FROM (((`categories` join `pickups` on(`categories`.`category_id` = `pickups`.`category`)) join `accounts` on(`pickups`.`account` = `accounts`.`account_id`)) join `users` on(`accounts`.`user_id` = `users`.`user_id`)) ORDER BY `pickups`.`pickup_schedule` ASC LIMIT 0, 5 ;

-- --------------------------------------------------------

--
-- Struktur untuk view `transaction_view`
--
DROP TABLE IF EXISTS `transaction_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaction_view`  AS SELECT `a`.`account_id` AS `account_id`, `a`.`user_id` AS `user_id`, `a`.`balance` AS `balance`, `p`.`pickup_id` AS `pickup_id`, `p`.`pickup_schedule` AS `pickup_schedule`, `p`.`pickup_finished` AS `pickup_finished`, `p`.`pickup_type` AS `pickup_type`, `p`.`pickup_status` AS `pickup_status`, `p`.`waste_weight` AS `waste_weight`, `p`.`waste_condition` AS `waste_condition`, `p`.`pickup_note` AS `pickup_note`, `c`.`category_id` AS `category_id`, `c`.`category_name` AS `category_name`, `c`.`category_price` AS `category_price`, `c`.`category_image` AS `category_image`, `t`.`transaction_id` AS `transaction_id`, `t`.`transaction_date` AS `transaction_date`, `t`.`amount` AS `amount`, `t`.`transaction_status` AS `transaction_status`, `t`.`transaction_information` AS `transaction_information`, `u`.`username` AS `username` FROM ((((`transactions` `t` join `pickups` `p` on(`t`.`pickup` = `p`.`pickup_id`)) join `categories` `c` on(`p`.`category` = `c`.`category_id`)) join `accounts` `a` on(`p`.`account` = `a`.`account_id`)) join `users` `u` on(`a`.`user_id` = `u`.`user_id`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `user_account_roles`
--
DROP TABLE IF EXISTS `user_account_roles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_account_roles`  AS SELECT `u`.`user_id` AS `user_id`, `u`.`username` AS `username`, `u`.`email` AS `email`, `u`.`full_name` AS `full_name`, `u`.`family_card_number` AS `family_card_number`, `u`.`phone_number` AS `phone_number`, `u`.`address` AS `address`, `u`.`rt` AS `rt`, `r`.`role_id` AS `role_id`, `r`.`role_name` AS `role_name`, `a`.`account_id` AS `account_id`, `a`.`balance` AS `balance` FROM ((`users` `u` join `accounts` `a` on(`u`.`user_id` = `a`.`user_id`)) join `roles` `r` on(`u`.`role_id` = `r`.`role_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indeks untuk tabel `pickups`
--
ALTER TABLE `pickups`
  ADD PRIMARY KEY (`pickup_id`),
  ADD KEY `user_id` (`account`),
  ADD KEY `pickups_ibfk_2` (`officer`),
  ADD KEY `pickups_ibfk_3` (`category`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `transactions_ibfk_1` (`pickup`),
  ADD KEY `transactions_ibfk_2` (`admin`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `family_card_number` (`family_card_number`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pickups`
--
ALTER TABLE `pickups`
  MODIFY `pickup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `pickups`
--
ALTER TABLE `pickups`
  ADD CONSTRAINT `pickups_ibfk_1` FOREIGN KEY (`account`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `pickups_ibfk_2` FOREIGN KEY (`officer`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `pickups_ibfk_3` FOREIGN KEY (`category`) REFERENCES `categories` (`category_id`);

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`pickup`) REFERENCES `pickups` (`pickup_id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`admin`) REFERENCES `accounts` (`account_id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
