-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 24, 2019 at 04:23 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE `buy` (
  `buy_id` int(11) NOT NULL,
  `buy_date` datetime NOT NULL,
  `net_price` decimal(6,2) NOT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `buy_detail`
--

CREATE TABLE `buy_detail` (
  `buy_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'อาหาร'),
(3, 'เครื่องดื่ม');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_lastname` varchar(50) DEFAULT NULL,
  `customer_address` varchar(100) DEFAULT NULL,
  `customer_tel` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL,
  `customer_picture` varchar(100) DEFAULT NULL,
  `customer_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_lastname`, `customer_address`, `customer_tel`, `create_date`, `customer_picture`, `customer_type`) VALUES
(1, 'สมศรี', 'มีชัย', '114/33 หมู่ที่ 1, ตำบลเสม็ด อำเภอเมืองชลบุรี จังหวัดชลบุรี, 20000', '026390064', '2019-01-05 00:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(50) NOT NULL,
  `employee_lastname` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_name`, `employee_lastname`, `username`, `password`) VALUES
(1, 'Administrator', '', 'admin', '81dc9bdb52d04dc20036dbd8313ed055'),
(8, 'Employee First', '', 'emp1', '81dc9bdb52d04dc20036dbd8313ed055'),
(10, 'xxx', '', 'xxx', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_no` varchar(45) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_cost` decimal(6,2) DEFAULT NULL,
  `product_normal_price` decimal(6,2) DEFAULT NULL,
  `product_vip_price` decimal(6,2) DEFAULT NULL,
  `product_amount` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_no`, `product_name`, `product_cost`, `product_normal_price`, `product_vip_price`, `product_amount`, `category_id`) VALUES
(1, '0100278000101', 'เลย์', '3.00', '6.00', '5.00', 99, 1),
(2, '0100278000101', 'เลย์', '4.00', '7.00', '6.00', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `return`
--

CREATE TABLE `return` (
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `return_type` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `sale_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sale_date` datetime DEFAULT NULL,
  `net_price` decimal(6,2) NOT NULL,
  `net_discount` decimal(6,2) DEFAULT NULL,
  `sale_status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sale_detail`
--

CREATE TABLE `sale_detail` (
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `discount` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`buy_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `buy_detail`
--
ALTER TABLE `buy_detail`
  ADD PRIMARY KEY (`buy_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `return`
--
ALTER TABLE `return`
  ADD PRIMARY KEY (`sale_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`,`customer_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `sale_detail`
--
ALTER TABLE `sale_detail`
  ADD PRIMARY KEY (`sale_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buy`
--
ALTER TABLE `buy`
  MODIFY `buy_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buy`
--
ALTER TABLE `buy`
  ADD CONSTRAINT `buy_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `buy_detail`
--
ALTER TABLE `buy_detail`
  ADD CONSTRAINT `buy_detail_ibfk_1` FOREIGN KEY (`buy_id`) REFERENCES `buy` (`buy_id`),
  ADD CONSTRAINT `buy_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `return`
--
ALTER TABLE `return`
  ADD CONSTRAINT `return_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `return_ibfk_2` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`sale_id`);

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `sale_detail`
--
ALTER TABLE `sale_detail`
  ADD CONSTRAINT `sale_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `sale_detail_ibfk_2` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`sale_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
