-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 24, 2025 at 04:58 PM
-- Server version: 8.0.40-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(4, 'mohit.a@avdevs.com', '$2y$10$ILhy9qrcyfOgGfZpCbH2cuMQsZYUntqpl1uHyvqHenqeNcmLSN2OC'),
(6, 'mohit.a1@avdevs.com', '$2y$10$.Glh/bL0L2PC1br4poUFv.Gq2igv9RpQHJYCktUYhTDA3kEfUN3.a'),
(7, 'mohit@gmail.com', '$2y$10$wR2u3Akt/wsLnL.tX5kw1uYuRjzMesKU/4EGOoYgYObXHYkRGJjP2'),
(8, 'Mohit@avdes1.com', '$2y$10$6Evhbc3JZ5Avv5m08RpsYuq7DFpVFTI/loifYeS4Ygr4v5G8UAfzq'),
(9, 'mohit.a@avdevs2.com', '$2y$10$kcaZ0J1awL7Je76mCq9UBePoxIgjkshKMBgsLlL2jJYxqtsToM6q2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
