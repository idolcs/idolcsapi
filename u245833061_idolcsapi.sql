-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2024 at 09:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u245833061_idolcsapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(5) NOT NULL,
  `alias` varchar(10) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `total_sems` int(5) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `alias`, `course_name`, `total_sems`, `created_on`) VALUES
(1, 'cs', 'B.Sc. Computer Science', 6, '2024-03-15 15:04:37'),
(4, 'it', 'B.Sc. Information Technology', 6, '2024-03-15 15:05:09'),
(5, 'mca', 'Masters of Computer Application', 6, '2024-03-15 15:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(5) NOT NULL,
  `subject_id` int(5) NOT NULL,
  `title` varchar(100) NOT NULL,
  `file_id` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `subject_id`, `title`, `file_id`, `description`, `created_on`) VALUES
(1, 5, 'New notes', 'BQACAgUAAx0EeYnYGgADKGX2fPe2Plcsq0I5HxVaWJrn1UduAAK0DQACM56xV29aQqcaQgvnNAQ', 'This is description of notes', '2024-03-17 05:17:42'),
(2, 5, 'New notes', 'BQACAgUAAx0EeYnYGgADKWX2fPvlEz7eqrTslXhPzsQssDbeAAK1DQACM56xV7ncBC6_jpKJNAQ', 'This is description of notes', '2024-03-17 05:17:46'),
(3, 5, 'New notes', 'BQACAgUAAx0EeYnYGgADKmX2fQU2VZujPVvumbta5bE_Y83UAAK2DQACM56xVzSZqbWv9Zt4NAQ', 'This is description of notes', '2024-03-17 05:17:56'),
(4, 5, 'New notes', 'BQACAgUAAx0EeYnYGgADK2X2fSwQydyt1wEiiZqzZkpG5okwAAK3DQACM56xV-HRPe_OFduKNAQ', 'This is description of notes', '2024-03-17 05:18:35'),
(5, 5, 'New notes', 'BQACAgUAAx0EeYnYGgADLGX2fUZtLIk-I9eP9pg4C6WsOAzmAAK4DQACM56xV95_urR5j-6sNAQ', 'This is description of notes', '2024-03-17 05:19:01'),
(6, 5, 'New notes', 'BQACAgUAAx0EeYnYGgADLWX2fV8yQaumHuNYrVzEib4K3cfxAAK5DQACM56xV0ZWK9Lu_JVtNAQ', 'This is description of notes', '2024-03-17 05:19:26'),
(7, 5, 'New notes', 'BQACAgUAAx0EeYnYGgADLmX2fXH9OBILRw1m7r5YgbbIk5SNAAK6DQACM56xV_x2CgABvVOnhzQE', 'This is description of notes', '2024-03-17 05:19:44'),
(8, 5, 'New notes', 'BQACAgUAAx0EeYnYGgADL2X2fY5F7ajMOI-t4vo6pmgBSdRBAAK7DQACM56xV4dEyITOeimTNAQ', 'This is description of notes', '2024-03-17 05:20:13'),
(9, 5, 'New notes', 'BQACAgUAAx0EeYnYGgADMGX2ffBRFMTNP_DH-kKdt3AnLX8LAAK8DQACM56xV9BRJB3hurA-NAQ', 'This is description of notes', '2024-03-17 05:21:51'),
(10, 5, 'New notes', 'BQACAgUAAx0EeYnYGgADMWX2fgkOA26E3B3-GMPIDz8u5VNWAAK9DQACM56xV16jUwrsNUv-NAQ', 'This is description of notes', '2024-03-17 05:22:16'),
(11, 5, 'New notes', 'BQACAgUAAx0EeYnYGgADMmX2gipRY3AQrtjKGPUYnP3S8kyiAAK_DQACM56xV06drfdxK_djNAQ', 'This is description of notes', '2024-03-17 05:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(5) NOT NULL,
  `alias` varchar(10) NOT NULL,
  `course` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `semester` int(2) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `alias`, `course`, `name`, `semester`, `created_on`) VALUES
(1, '102', 1, 'Programming with Python', 1, '2024-03-15 15:29:00'),
(2, '102', 4, 'Programming with Python', 1, '2024-03-16 12:01:18'),
(3, '401', 4, 'Programming with C', 4, '2024-03-16 12:01:48'),
(4, '401 \" OR -', 4, 'Programming with C', 4, '2024-03-16 12:02:22'),
(5, '405 \" --', 4, 'Programming with C', 4, '2024-03-16 12:02:39'),
(6, '999', 5, 'MCA ka BBC', 1, '2024-03-16 14:26:27'),
(7, 'yash', 5, 'Yash bhai ke studies', 1, '2024-03-16 14:28:25'),
(8, 'yashg', 5, 'Yash bhai ke studies', 1, '2024-03-16 15:06:04'),
(9, 'yashg', 5, 'Yash bhai ke studies', 1, '2024-03-16 15:06:06'),
(10, 'yashg', 5, 'Yash bhai ke studies', 1, '2024-03-16 15:06:07'),
(11, 'yashg', 5, 'Yash bhai ke studies', 1, '2024-03-16 15:06:07'),
(12, 'yashg', 5, 'Yash bhai ke studies', 1, '2024-03-16 15:06:07'),
(13, 'yashg', 5, 'Yash bhai ke studies', 1, '2024-03-16 15:06:07'),
(14, 'yashg', 5, 'Yash bhai ke studies', 1, '2024-03-16 15:06:07'),
(15, 'yashg', 5, 'Yash bhai ke studies', 1, '2024-03-16 15:06:07'),
(16, 'yashg', 5, 'Yash bhai ke studies', 1, '2024-03-16 15:06:08'),
(17, 'yashg', 5, 'Yash bhai ke studies', 1, '2024-03-16 15:06:08'),
(18, 'yashg', 5, 'Yash bhai ke studies', 1, '2024-03-16 15:06:08'),
(19, 'yashg', 5, 'Yash bhai ke studies', 1, '2024-03-16 15:06:08'),
(20, 'yashg', 5, 'Yash bhai ke studies', 1, '2024-03-16 15:07:02'),
(21, 'yashg', 4, 'Yash bhai ke studies', 1, '2024-03-16 15:08:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
