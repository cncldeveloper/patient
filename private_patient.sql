-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 18, 2023 at 09:01 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `private_patient`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `nid_or_birth_cer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `contact_number` char(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(32) NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `thana_or_upazila` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `postcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `name`, `date_of_birth`, `nid_or_birth_cer`, `contact_number`, `email`, `password`, `blood_group`, `thana_or_upazila`, `postcode`, `district`, `created_at`, `updated_at`) VALUES
(5, 'nabil abc', '2023-01-19', '12334545667', '01909902303', 'naboilgh566@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'A-', 'asfd', 'sdf', 'sadf', '2023-01-18 08:52:27', '2023-01-18 08:58:19'),
(6, 'Chanchal Biswas', '2023-01-10', '12334545667', '24827487284', 'mchanchalbd@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'A-', 'asfd', 'sdf', 'aaa', '2023-01-18 08:54:57', '2023-01-18 08:54:57'),
(7, 'CHDL', '2023-01-12', '12334545667', '24242424242', 'root@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'A-', 'asf', 'asfd', 'sdf', '2023-01-18 08:56:19', '2023-01-18 08:56:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
