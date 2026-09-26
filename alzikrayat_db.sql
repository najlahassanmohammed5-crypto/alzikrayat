-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2026 at 02:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alzikrayat_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `photo_id`, `user_id`, `comment`, `date_time`) VALUES
(5, 4, 6, ',,,', '2026-09-10 14:23:06'),
(8, 4, 4, 'nice pic', '2026-09-13 11:14:25'),
(11, 8, 12, 'jjjj', '2026-09-23 16:59:42');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `user_id`, `file_name`, `title`, `description`, `date_time`) VALUES
(4, 5, 'photo_6aa2a98d68da0.jpg', 'oooo', '', '2026-09-10 12:58:53'),
(7, 4, 'photo_6aaaacec8e72b.jfif', 'cat', '', '2026-09-16 14:51:24'),
(8, 4, 'photo_6aaaad0438534.jpg', 'cat', '', '2026-09-16 14:51:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `location`, `description`, `occupation`) VALUES
(1, 'ggiuh', 'hguyiuh', 'najhassan20077@gmail.com', '$2y$10$ayZsk6o8xStJQoE5qBEnGuWakZGqRzdu.tZPDaI4ALf2EMDkaBjEW', NULL, NULL, NULL),
(2, 'jkjkk', 'jhjkhkjhk', 'najhassan2002@gmail.com', '$2y$10$DFK.p92ALrYwLbUejXuIcOK3sbEyFxVkjTTa0AFaKuaVhEbq6l1Om', NULL, NULL, NULL),
(3, 'nhbb', 'hassan', 'primehanoon2008@gmail.com', '$2y$10$45fwQQLXBkIWKJuHaYXeC.6uFZzVPdRBXhiCSgiZA2X6N43yLB./i', NULL, NULL, NULL),
(4, 'najlaa', 'hassan', 'najhassan2005@gmail.com', '$2y$10$PkhG6nHQ1GBVtU17gchki.x0dT4Iy0R/oHHeAJBJl/vHyrPt4R8Qu', NULL, NULL, NULL),
(5, 'najlaa', 'hassan', 'najhassan2009@gmail.com', '$2y$10$TspwX7U38g.9eMUIF1LupukKYIzHdbGt3985OguT5NBG2LSqP5fLK', NULL, NULL, NULL),
(6, 'najlaa', 'hassan', 'najhassan2001@gmail.com', '$2y$10$1CdZJgmmW0h5i8AhR4Mvaud5UGkgHyWmvlZQEYhRLZMiSxPKYSXzq', NULL, NULL, NULL),
(7, 'maj', 'has', 'najhassan20066@gmail.com', '$2y$10$IATU6UKqyyxMXRhJH7H1XuaafvFbjPiqN.TrJsmZcuAN3g2nok3Z.', NULL, NULL, NULL),
(8, 'najlaa', 'hassan', 'najhassan2@gmail.com', '$2y$10$lrRbjroMd6G3/roOM1fuBORTxNYVaqFxvfx9znpvbb3yas5dEQgGK', NULL, NULL, NULL),
(9, 'najlaa', 'hassan', 'najhassan20@gmail.com', '$2y$10$gfl2RbKnrJ12bM8ejYoiwuKak6qHx7IvgftO2tzDVOWST4UOSXV6.', NULL, NULL, NULL),
(10, 'najlaa', 'hassan', 'najhassan88@gmail.com', '$2y$10$n/7FQ36zAPtbHZaGNK3YbuzndI5BpZjkU9SkSTfSvpML/LOhA0d2m', NULL, NULL, NULL),
(11, 'najlaa', 'hassan', 'najhassan00@gmail.com', '$2y$10$Vaoot/KNyj7uZOktreDqieZF4UMJloFhw1oypSOVf.ewi8M7oHEze', NULL, NULL, NULL),
(12, 'najlaa', 'hassan', 'najhassan@gmail.com', '$2y$10$2k7spwrZ5XS85411CKDgneIX0fmRBqIZTuOD9RQ/goWJgpLcNJc3u', NULL, NULL, NULL),
(13, 'najlaa', 'hassan', 'najhassan1@gmail.com', '$2y$10$fYfqqrbDA3vM6XsHDry91u.6gYgOX0dy3Xs6AC0vtmU3xWlrEg4I2', NULL, NULL, NULL),
(14, 'najlaa', 'hassan', 'najhassan6@gmail.com', '$2y$10$OZ/AAC84JHHDyU9rfV5tROiMGitKex.cd4dYRN8zNdMfaobCzSgqS', NULL, NULL, NULL),
(15, 'najlaa', 'hassan', 'najhassan000@gmail.com', '$2y$10$u/6SbLvgE3gMRceaCYFUeeD0.QQ.okMQHdCP.qH5/61NjCuE7vV7W', NULL, NULL, NULL),
(16, 'yugil', 'ijijiji', 'najh7@gmail.com', '$2y$10$FCu2Sw7wh2r9EDSdx6Hs7OQd.RE4fKvhVAITUET.rLCcE/aFgRAQC', NULL, NULL, NULL),
(17, 'gyhyh', 'hassan', 'najhassan2007@gmail.com', '$2y$10$4.NT0XsLzLwPqrQyfN9CqOacWhrCDCAK6XhXVWrkBrrggOnEygedi', NULL, NULL, NULL),
(18, 'najlaa', 'hassan', 'najha@gmail.com', '$2y$10$7f8uYcbOzv9ga1CtTT1Jv.9Ee/UttR8kOBQ6EtQ2rjJAlSSQ8xL6S', NULL, NULL, NULL),
(19, 'najlaa', 'hassan', 'najhassan200778@gmail.com', '$2y$10$kNvSsApg6xM9iY724FYSQOrxn//I9jKMZm0lcir6PDzZHrau/8j3G', NULL, NULL, NULL),
(20, 'gyhyh', 'hassan', 'najhassan2007997@gmail.com', '$2y$10$0zLFpWgCFYb83dzYDXiVfuuaasWo/Jz/D.7fHjhAMUC3o.UeYB6bm', NULL, NULL, NULL),
(21, 'najlaa', 'hassan', 'najhassan2002000@gmail.com', '$2y$10$XBINrtDW5xjBA9H9tUhd.eJHVhZ16bLdPKcybAvDfew0c9ULTbb3q', NULL, NULL, NULL),
(22, 'najlaa', 'hassan', 'naj@gmail.com', '$2y$10$At/3T4LesAGV2BiZCo8ncumwriJbn.SucCjrr97Q/FYnlyazH/zwG', NULL, NULL, NULL),
(23, 'yggg', 'iuhl', 'ijkk@gmail.com', '$2y$10$OLHOEzzat9zLo3lRDJqddeRVysuTR4.OVUGbgXxEkU6Z1T6M.EDLO', NULL, NULL, NULL),
(24, 'najlaa', 'hassan', 'najhassan200770@gmail.com', '$2y$10$Vw6QujUq7AoOndGO9MQS5en7/NtnP6q2qCUa7ygjtmChG8/pKhR36', NULL, NULL, NULL),
(25, 'najlaa', 'hassan', 'najhassan98@gmail.com', '$2y$10$cNZeiWGD2leLIYPsil/CC.8DGOEn7RXp55gFyyd1eiaBPDNlh5SNC', NULL, NULL, NULL),
(26, 'najlaa', 'hassan', 'najhassan2007777@gmail.com', '$2y$10$H4n5WTJ9y0eQuX9RHBFAX..pEGEFIKulLaHTBoAVvukhU7qhjEX7.', NULL, NULL, NULL),
(27, 'najlaa', 'hassan', 'najhassan2007799@gmail.com', '$2y$10$L5na6ZF4lNOHSSXyL7VEs.8Qc/mfj5aCiypGTb0xV6GRdQ4gqfRsO', NULL, NULL, NULL),
(28, 'najlaa', 'hassan', 'najhassan20077888@gmail.com', '$2y$10$vvGZiO8yRsUivcO1LtWfYO.VsGq6/YKh4JLXsqi2SXAGlU4nzY27i', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_id` (`photo_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
