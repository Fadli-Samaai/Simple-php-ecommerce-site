-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2022 at 02:05 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `next_gen_supply`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_first_name` varchar(30) NOT NULL,
  `customer_last_name` varchar(30) NOT NULL,
  `customer_phone` varchar(12) NOT NULL,
  `customer_email` varchar(30) NOT NULL,
  `customer_address` varchar(50) NOT NULL,
  `customer_sa_id` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_first_name`, `customer_last_name`, `customer_phone`, `customer_email`, `customer_address`, `customer_sa_id`) VALUES
(1, 'Clair', 'McLellan', '0655532099', 'cmclellan0@gmail.com', '1 Banding Circle', '6499969069363'),
(2, 'Helaina', 'MacKnockiter', '0675401515', 'hmacknockiter1@gmail.com', '78 Grayhawk Hill', '8453934219900'),
(3, 'Shelden', 'Manshaw', '0636708332', 'smanshaw3@gmail.com', '44 Graceland Junction', '0228813005826'),
(4, 'Denni', 'D\'Onisi', '0672036585', 'ddonisi4@gmail.com', '65 Waxwing Avenue', '3086886996492'),
(5, 'Dagny', 'Kollas', '0622937960', 'dkollas5@gmail.com', '6 Havey Street', '1086607438590'),
(6, 'Ferrell', 'Dewan', '0627481166', 'fdewan65@gmail.com', '8 Elmside Circle', '7392716606676'),
(7, 'Kathie', 'Curnnokk', '0636481713', 'kcurnnokk7@gmail.com', '3 Kinsman Way', '6600013498335'),
(8, 'Phillie', 'Normanvell', '0614937179', 'pnormanvell8@gmail.com', '7 Washington Court', '5752209958717'),
(9, 'Noak', 'Tonkin', '0690144468', 'ntonkin9@gmail.com', '15 Twin Pines Junction', '6510543211711'),
(10, 'Biron', 'Luxen', '0663370595', 'bluxena@gmail.com', '3 Elmside Junction', '3643289471385'),
(11, 'fadli', 'samaai', '0645281468', 'fs@gmail.com', '32 dave rd', '0321569874521'),
(12, 'jack', 'wilder', '0685426514', 'jackw@gmail.com', '50 Clive Rd', '0215965425830'),
(13, 'Fayaad', ' Allie', '0645381468', 'fayaadal@gmail.com', '2 Jupiter Rd', '0301569374521'),
(14, 'Siddeeq', 'Rabin', '0685421514', 'siddeeqr@gmail.com', '10 jack Rd', '0315965425839'),
(15, 'Imraan', 'Allie', '0615295438', 'ImraanA@gmail.com', '35 Avro Avenue', '0202921365215');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`order_id`, `product_id`, `unit_price`) VALUES
(1, 2, '11999.90'),
(2, 1, '7999.00'),
(2, 3, '11999.95'),
(3, 1, '7999.00'),
(3, 3, '11999.95'),
(4, 5, '8500.00'),
(5, 1, '7999.00'),
(5, 3, '11999.95'),
(6, 2, '11999.90'),
(7, 3, '11999.95'),
(7, 4, '6759.00'),
(8, 1, '7999.00'),
(8, 2, '11999.90'),
(8, 3, '11999.95'),
(8, 4, '6759.00'),
(8, 5, '8500.00'),
(9, 4, '6759.00'),
(10, 1, '7999.00'),
(10, 4, '6759.00'),
(11, 2, '11999.90'),
(11, 5, '8500.00'),
(12, 2, '11999.90'),
(12, 3, '11999.95'),
(13, 4, '6759.00'),
(14, 5, '8500.00'),
(15, 1, '7999.00'),
(15, 3, '11999.95'),
(16, 1, '7999.00'),
(16, 2, '11999.90'),
(16, 3, '11999.95'),
(16, 5, '8500.00'),
(17, 4, '6759.00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`) VALUES
(1, 1, '2022-04-22'),
(2, 2, '2022-04-25'),
(3, 3, '2022-04-26'),
(4, 4, '2022-05-05'),
(5, 5, '2022-05-06'),
(6, 6, '2022-05-13'),
(7, 7, '2022-05-13'),
(8, 8, '2022-05-16'),
(9, 9, '2022-05-20'),
(10, 10, '2022-05-23'),
(11, 11, '2022-05-23'),
(12, 12, '2022-06-01'),
(13, 13, '2022-06-05'),
(14, 14, '2022-06-05'),
(15, 2, '2022-06-06'),
(16, 15, '2022-06-06'),
(17, 8, '2022-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `units_in_stock` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `units_in_stock`, `unit_price`) VALUES
(1, 'Xbox Series S', 58, '7999.00'),
(2, 'Xbox Series X', 48, '11999.90'),
(3, 'Playstation 5 disc', 72, '11999.95'),
(4, 'Nintendo Switch', 22, '6759.00'),
(5, 'Playstation 5 digital', 51, '8500.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;