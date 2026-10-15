-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2026 at 10:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_donors_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_requests`
--

CREATE TABLE `blood_requests` (
  `id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `units` int(11) NOT NULL DEFAULT 1,
  `hospital` varchar(150) NOT NULL,
  `city` varchar(100) NOT NULL,
  `contact_phone` varchar(15) NOT NULL,
  `urgency` varchar(20) NOT NULL DEFAULT 'Normal',
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_requests`
--

INSERT INTO `blood_requests` (`id`, `donor_id`, `patient_name`, `blood_group`, `units`, `hospital`, `city`, `contact_phone`, `urgency`, `status`, `created_at`) VALUES
(1, 1, 'priya', 'B+', 2, 'sion hospital', 'mumbai', '8108916904', 'Urgent', 'Pending', '2026-10-13 07:38:57'),
(2, 2, 'priya', 'B+', 1, 'sion hospital', 'mumbai', '8108916904', 'Normal', 'Pending', '2026-10-13 08:08:14');

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `city` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `full_name`, `age`, `gender`, `blood_group`, `phone`, `city`, `email`, `password`, `created_at`) VALUES
(1, 'Shalu Shrivastav', 18, 'Female', 'B+', '8108916906', 'mumbai', 'shalushrivastav532@gmail.com', '$2y$10$XIOvrpoqu.BjDBj.7D5Wfet.ihnhdP81G.M8wwyZrjHgG7BOZ/ndu', '2026-10-13 07:32:53'),
(2, 'priya vadeti', 19, 'Female', 'B+', '8108916906', 'mumbai', 'priyavadeti2007@gmail.com', '$2y$10$nVlMiNGuCmjoW52dyv40q.hyP.dugyl3SjQxn5JEshztAXGffb2OS', '2026-10-13 08:06:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donor_id` (`donor_id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blood_requests`
--
ALTER TABLE `blood_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD CONSTRAINT `blood_requests_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `donors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
