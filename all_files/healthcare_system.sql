-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 04:20 PM
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
-- Database: `healthcare_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `patient_user_id` varchar(100) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `patient_phone_no` varchar(100) NOT NULL,
  `patient_address` varchar(100) NOT NULL,
  `patient_booking_date` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `doctor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `patient_user_id`, `patient_name`, `patient_phone_no`, `patient_address`, `patient_booking_date`, `status`, `doctor`) VALUES
(8, '2', 'Jay-R Tillo', '09514845819', 'upper lamac', '2024-06-04', 'APPROVED', 'Dr. Strange'),
(9, '2', 'asd qwe', '09123', 'upper lamac', '2024-06-29', 'DISAPPROVED', ''),
(10, '2', 'ert ert', '09123', 'ert', '2024-06-19', 'DISAPPROVED', ''),
(11, '4', 'John Smith', '0912312313', 'asdasd', '2024-06-11', 'APPROVED', 'Dr. Ben'),
(12, '4', 'Ana asd1123asd', '091323', 'asd123', '2024-06-13', 'DISAPPROVED', '');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `fullname`, `title`, `username`, `password`) VALUES
(1, 'Strange', 'Physician', 'strange', 'asd123'),
(2, 'Ben', 'sdqweqwe', 'ben', 'ben123');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(11) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `first_name`, `last_name`, `email`, `username`, `password`) VALUES
(1, 'asd', 'asd', 'asd@gmail.com', 'admin', '$2y$10$HQVrZSUw0LiV3eTVHdcQF.JdICxHGS.5oi8LniwbuEDFfzzgU7sgC'),
(3, 'admin', 'admin', 'admin@gmail.com', 'admin', '$2y$10$6Fa/efctQVzj6eDWrGITuO0vAC7Jf6gpmOPhS.G7IKm6j9h9zLqky'),
(4, 'John', 'Smith', 'tillojayr@gmail.com', 'john123', '$2y$10$t5uAwJLH06FG9nFwdsU2zek12fy/Dt5KQv5IuSimeczBJeFD9LZ5m');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
