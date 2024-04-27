-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 04:38 PM
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
-- Database: `carrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `carName` varchar(90) DEFAULT NULL,
  `carId` varchar(90) DEFAULT NULL,
  `year_` varchar(90) DEFAULT NULL,
  `transmission` varchar(90) DEFAULT NULL,
  `seats` varchar(90) DEFAULT NULL,
  `price` varchar(90) DEFAULT NULL,
  `image` varchar(90) DEFAULT NULL,
  `availability` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `carName`, `carId`, `year_`, `transmission`, `seats`, `price`, `image`, `availability`) VALUES
(12, 'volvo', 'Auto', '2001', 'manual', '12', '111', 'gradle.png', 'available'),
(13, 'benz', 'Auto', '2001', 'manual', '3', '111', 'gradle.png', 'available'),
(14, '3', 'Auto', '1234', 'manual', '12', '11111', 'irembo2.jpg', 'available'),
(15, 'volvo', 'Auto', '1234', 'manual', '12', '111', 'iyandikishe.png', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `cust_fullName` varchar(100) DEFAULT NULL,
  `cust_email` varchar(100) DEFAULT NULL,
  `cust_address` varchar(100) DEFAULT NULL,
  `cust_phone` varchar(100) DEFAULT NULL,
  `cust_password` varchar(100) DEFAULT NULL,
  `cust_age` varchar(90) DEFAULT NULL,
  `cust_gender` varchar(90) DEFAULT NULL,
  `status` varchar(90) NOT NULL,
  `image` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `cust_fullName`, `cust_email`, `cust_address`, `cust_phone`, `cust_password`, `cust_age`, `cust_gender`, `status`, `image`) VALUES
(5, 'mmmmo', 'nnn@gmal.com', 'kigal', '1234567890', '12345678', '12', 'female', 'active', ''),
(6, 'mama', 'akarizaesther0@gmail.com', 'rusiiz', '+250782111552', 'sdfghj', '12', 'female', 'non_active', 'gradle.png');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `cust_fullName` varchar(255) NOT NULL,
  `cust_email` varchar(255) NOT NULL,
  `cust_address` varchar(255) DEFAULT NULL,
  `cust_phone` varchar(20) DEFAULT NULL,
  `cust_password` varchar(255) NOT NULL,
  `cust_age` int(11) DEFAULT NULL,
  `cust_gender` enum('male','female') DEFAULT NULL,
  `status` enum('active','non_active') DEFAULT 'active',
  `salary` decimal(10,2) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `image` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `cust_fullName`, `cust_email`, `cust_address`, `cust_phone`, `cust_password`, `cust_age`, `cust_gender`, `status`, `salary`, `department`, `image`) VALUES
(1, 'me', 'niyigenamike3@gmail.com', 'qw', '0782111552', 'dfghj', 12, 'female', 'active', 2000.00, 'accountant', 'gradle.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `carId` int(11) NOT NULL,
  `carImage` varchar(255) NOT NULL,
  `customerId` int(11) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `senderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `carId`, `carImage`, `customerId`, `customerName`, `status`, `date`, `senderId`) VALUES
(1, 0, 'gradle.png', 0, 'me', '0', '2024-04-27 11:16:29', 1),
(2, 13, 'gradle.png', 0, 'me', '0', '2024-04-27 11:18:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
