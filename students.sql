-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2025 at 05:06 PM
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
-- Database: `student_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `province` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `gender`, `dob`, `province`, `district`, `note`) VALUES
(1, 'dsfsdfa', 'Female', '1111-11-11', 'Kakeo', 'Bati', 'dsfdfdas'),
(2, 'Muoyheak', 'Male', '2222-11-12', 'Kandal', 'Koh Thom', 'sdfsdf'),
(3, 'sadfsa', 'Male', '1111-11-11', 'Kandal', 'Kakkhmao', 'sadfasd'),
(4, 'Muoyhak', 'Female', '2222-02-22', 'Kakeo', 'Bati', 'dsfsdf'),
(9, 'sdfasf', 'Male', '4444-12-04', 'Kandal', 'Kakkhmao', 'I love you!'),
(10, 'Heng', 'Male', '1111-11-11', 'Kakeo', 'Kiri Vong', 'adsfdsf'),
(11, 'Muoyhak', 'Male', '2222-02-22', 'Kakeo', 'Bati', 'sdfd'),
(12, 'Muoyhakk', 'Male', '2222-02-22', 'Kakeo', 'Bati', 'sdfd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
