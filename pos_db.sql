-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2022 at 04:50 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `mobile_cart`
--

CREATE TABLE `mobile_cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `quantity` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mobile_temp_cart`
--

CREATE TABLE `mobile_temp_cart` (
  `temp_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_img` text NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `cost` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `qty_left` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `expiration_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_img`, `product_code`, `product_name`, `description`, `unit`, `cost`, `price`, `qty_left`, `category`, `expiration_date`) VALUES
(1, 'p1.jpg', '5901234123457', 'Royal 1.5 L', 'Coke Test', 'Per Pieces', '10', '15', 88, 'Beverage', '2023-02-09'),
(2, 'p2.jpg', '4501234123433', 'Cheez Curl', 'Snack', 'Per Pieces', '8.50', '9.50', 1000, 'Junk Food', '2025-02-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mobile_cart`
--
ALTER TABLE `mobile_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_temp_cart`
--
ALTER TABLE `mobile_temp_cart`
  ADD PRIMARY KEY (`temp_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mobile_cart`
--
ALTER TABLE `mobile_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mobile_temp_cart`
--
ALTER TABLE `mobile_temp_cart`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
