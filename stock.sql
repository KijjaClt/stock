-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 25, 2019 at 01:43 PM
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
  `buy_id` varchar(45) NOT NULL,
  `buy_date` date NOT NULL,
  `net_price` decimal(6,2) NOT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buy`
--

INSERT INTO `buy` (`buy_id`, `buy_date`, `net_price`, `contact_id`, `employee_id`) VALUES
('PO-20190220-001', '2019-02-20', '132.00', 5, 1),
('PO-20190220-002', '2019-02-20', '512.00', 5, 1),
('PO-20190226-001', '2019-02-26', '15.00', 5, 1),
('PO-20190325-001', '2019-03-25', '1500.00', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `buy_detail`
--

CREATE TABLE `buy_detail` (
  `buy_id` varchar(45) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buy_detail`
--

INSERT INTO `buy_detail` (`buy_id`, `product_id`, `amount`, `price`) VALUES
('PO-20190220-001', 1, 12, '6.00'),
('PO-20190220-001', 6, 12, '5.00'),
('PO-20190220-002', 7, 64, '8.00'),
('PO-20190226-001', 1, 5, '3.00'),
('PO-20190325-001', 6, 500, '3.00');

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
(3, 'เครื่องดื่ม'),
(6, 'ขนม');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `contact_lastname` varchar(50) DEFAULT NULL,
  `contact_address` varchar(100) DEFAULT NULL,
  `contact_tel` varchar(20) NOT NULL,
  `create_date` date NOT NULL,
  `contact_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_name`, `contact_lastname`, `contact_address`, `contact_tel`, `create_date`, `contact_type`) VALUES
(1, 'สมศรี', 'มีชัย', '114/33 หมู่ที่ 1, ตำบลเสม็ด อำเภอเมืองชลบุรี จังหวัดชลบุรี, 20000', '02-6390064', '2019-01-05', 1),
(5, 'บริษัทเป๊ปซี่-โคล่า (ไทย) เทรดดิ้ง จำกัด', '', '99/9-10 ถนนเชียงใหม่-ลำปาง หมู่ 11 ต.อุโมงค์ อ.เมือง จ.ลำพูน 51150', '053-5698002', '2019-01-24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_name`, `username`, `password`) VALUES
(1, 'Administrator', 'admin', '81dc9bdb52d04dc20036dbd8313ed055'),
(8, 'Employee First', 'emp1', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_no` varchar(45) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_cost` decimal(6,2) DEFAULT NULL,
  `product_price` decimal(6,2) DEFAULT NULL,
  `product_amount` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_no`, `product_name`, `product_cost`, `product_price`, `product_amount`, `category_id`) VALUES
(1, 'P0001', 'เลย์', '3.00', '6.00', 14, 6),
(6, 'P0002', 'ฟริสโต', '3.00', '5.00', 400, 6),
(7, 'P0003', 'โค้ก', '9.00', '15.00', 60, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `sale_id` varchar(45) NOT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `net_price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`sale_id`, `contact_id`, `employee_id`, `sale_date`, `net_price`) VALUES
('SO-20190220-001', 1, 1, '2019-02-20', '38.00'),
('SO-20190220-002', 1, 1, '2019-02-20', '60.00'),
('SO-20190321-001', 1, 1, '2019-03-21', '105.00'),
('SO-20190325-001', 1, 8, '2019-03-25', '500.00');

-- --------------------------------------------------------

--
-- Table structure for table `sale_detail`
--

CREATE TABLE `sale_detail` (
  `sale_id` varchar(45) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale_detail`
--

INSERT INTO `sale_detail` (`sale_id`, `product_id`, `amount`, `price`) VALUES
('SO-20190220-001', 1, 3, '6.00'),
('SO-20190220-001', 6, 4, '5.00'),
('SO-20190321-001', 6, 21, '5.00'),
('SO-20190325-001', 6, 100, '5.00'),
('SO-20190220-002', 7, 4, '15.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`buy_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `contact_id` (`contact_id`);

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
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

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
  ADD PRIMARY KEY (`product_id`) USING BTREE,
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`) USING BTREE,
  ADD KEY `contact_id` (`contact_id`) USING BTREE,
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `sale_detail`
--
ALTER TABLE `sale_detail`
  ADD PRIMARY KEY (`product_id`,`sale_id`) USING BTREE,
  ADD KEY `product_id` (`product_id`),
  ADD KEY `sale_id` (`sale_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buy`
--
ALTER TABLE `buy`
  ADD CONSTRAINT `buy_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `buy_ibfk_2` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`contact_id`) ON UPDATE CASCADE;

--
-- Constraints for table `buy_detail`
--
ALTER TABLE `buy_detail`
  ADD CONSTRAINT `buy_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `buy_detail_ibfk_3` FOREIGN KEY (`buy_id`) REFERENCES `buy` (`buy_id`) ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_ibfk_3` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`contact_id`) ON UPDATE CASCADE;

--
-- Constraints for table `sale_detail`
--
ALTER TABLE `sale_detail`
  ADD CONSTRAINT `sale_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_detail_ibfk_2` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`sale_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
