-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2026 at 05:49 PM
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
-- Database: `techquiz_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'Shashitha Nipun', 'shashithanipun@gmail.com', 'Hi', '2026-09-03 09:14:44'),
(2, 'Shashitha Nipun', 'shashithanipun@gmail.com', '123', '2026-09-03 09:15:04'),
(3, 'Shashitha Nipun', 'shashithanipun07@gmail.com', '12', '2026-09-03 09:15:36'),
(4, 'Shashitha Nipun', 'shashithanipun07@gmail.com', '12', '2026-09-03 09:24:17'),
(7, 'Shashitha Nipun', 'shashithanipun07@gmail.com', '14', '2026-09-03 10:25:26'),
(8, 'shashitha', 'shashithanipun07@gmail.com', 'good', '2026-09-04 19:58:09'),
(9, 'Shashitha Nipun', 'shashithanipun07@gmail.com', 'hello', '2026-09-08 20:10:49'),
(10, 'GiwG', 'Giwg@gmail.com', 'nice work', '2026-09-10 12:58:44'),
(11, 'Shashitha Nipun', 'shashithanipun@gmail.com', 'Good Website', '2026-09-19 22:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `played_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `user_id`, `username`, `category`, `score`, `played_at`) VALUES
(12, 8, 'Gihan', 'GK', 70, '2026-09-04 20:29:02'),
(13, 8, 'Gihan', 'ICT', 90, '2026-09-04 21:06:47'),
(14, 8, 'Gihan', 'SCIENCE', 60, '2026-09-04 21:07:28'),
(24, 11, 'Shashitha', 'GK', 70, '2026-09-08 20:08:18'),
(25, 11, 'Shashitha', 'SCIENCE', 40, '2026-09-08 20:10:20'),
(26, 12, 'GiwG', 'ICT', 30, '2026-09-10 12:57:54'),
(27, 13, 'Shashitha1', 'GK', 60, '2026-09-19 22:05:38'),
(28, 13, 'Shashitha1', 'SCIENCE', 60, '2026-09-19 22:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(11, 'Shashitha', 'shashitha@gmail.com', '$2y$10$uvfTaWRwIyCHTOehk.vX1ON4j./sO9yo.IfVDMhFrEaU4UEet/E.G', '2026-09-08 20:06:52'),
(12, 'GiwG', 'Giwg@gmail.com', '$2y$10$gfTFOYx1YaIzqw66lDEJCeHoxUH/sJB1UAozbi44wNtH7Vg.dhr/m', '2026-09-10 12:56:42'),
(13, 'Shashitha1', 'shashithanipun@gmail.com', '$2y$10$pU9eujpYRHAuE25TMdcmduHEJF8Z7Vyy2W2VkHktk5PDcbvv5pomq', '2026-09-19 22:04:21'),
(14, 'Shashitha2', 'shashitha02@gmail.com', '$2y$10$9Fuk4dsEXKJJY7qm/YCsDeN1CGGmXWB/VEtLvs6FexSDiMxmZrBza', '2026-09-25 10:38:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
