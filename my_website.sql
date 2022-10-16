-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2022 at 09:07 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_id` int(10) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `gmail` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `profile_pic`, `gmail`, `phone`, `facebook`, `youtube`) VALUES
(1, 'my.jpg', 'jodelmarbeltran1016@gmail.com', '09278706504', 'undermaintenance.php', 'undermaintenance.php');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `image4` varchar(255) DEFAULT NULL,
  `image5` varchar(255) DEFAULT NULL,
  `image6` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `features` varchar(255) DEFAULT NULL,
  `programming_language` varchar(255) DEFAULT NULL,
  `db` varchar(255) DEFAULT NULL,
  `date_created` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `image1`, `image2`, `image3`, `image4`, `image5`, `image6`, `description`, `features`, `programming_language`, `db`, `date_created`, `link`) VALUES
(3, 'InstaLoan', 'Screenshot (293).png', 'Screenshot (294).png', 'Screenshot (296).png', 'Screenshot (297).png', 'Screenshot (298).png', 'Screenshot (299).png', 'Lending site', 'Admin access;User dashboard;Approve loan;Add payment;User access;Apply for a loan; Monitor loan', 'PHP', 'MySQL', 'June 28, 2021', 'undermaintenance.php');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(100) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `percent` int(100) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `percent`, `category`) VALUES
(1, 'C#', 60, 'PL'),
(2, 'Java', 75, 'PL'),
(3, 'Python', 10, 'PL'),
(4, 'PHP', 80, 'Server Side'),
(5, 'SQL', 70, 'Server Side'),
(6, 'Bootstrap', 66, 'Frameworks'),
(9, '.NET', 25, 'Frameworks');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(10) NOT NULL,
  `ip_address` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip_address`) VALUES
(1, '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
