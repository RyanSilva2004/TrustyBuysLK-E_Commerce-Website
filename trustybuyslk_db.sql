-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 24, 2023 at 04:22 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trustybuyslk_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

DROP TABLE IF EXISTS `tbl_account`;
CREATE TABLE IF NOT EXISTS `tbl_account` (
  `acc_id` int NOT NULL AUTO_INCREMENT,
  `acc_type` varchar(40) NOT NULL,
  `acc_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `acc_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `acc_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `acc_gender` varchar(40) NOT NULL,
  PRIMARY KEY (`acc_email`),
  UNIQUE KEY `id` (`acc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`acc_id`, `acc_type`, `acc_name`, `acc_email`, `acc_password`, `acc_gender`) VALUES
(2, 'admin', 'Admin - TrustyBuysLK', 'admin@trustybuys.lk', 'abc123', 'Male'),
(1, 'user', 'Ryan Silva', 'ryansilva2004cr7@gmail.com', '20041115', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

DROP TABLE IF EXISTS `tbl_cart`;
CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `cart_email` varchar(255) DEFAULT NULL,
  `cart_name` varchar(255) DEFAULT NULL,
  `cart_qty` int NOT NULL,
  `cart_price` decimal(10,2) DEFAULT NULL,
  `cart_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `cart_email_` (`cart_email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `cart_email`, `cart_name`, `cart_qty`, `cart_price`, `cart_image`) VALUES
(1, 'ryansilva2004cr7@gmail.com', 'Baseus Bowie H1i Noise-Cancellation Wireless Headphones Cluster Black ', 1, '39.00', 'image_2023-10-21_225008875.png'),
(3, 'ryansilva2004cr7@gmail.com', 'Baseus H1 Bowie Noise Cancelling Wireless Headphone', 1, '37.00', 'image_2023-10-22_161304284.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

DROP TABLE IF EXISTS `tbl_messages`;
CREATE TABLE IF NOT EXISTS `tbl_messages` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `msg_email` varchar(225) NOT NULL,
  `msg_name` varchar(100) NOT NULL,
  `msg_number` varchar(100) NOT NULL,
  `msg_message` varchar(500) NOT NULL,
  PRIMARY KEY (`msg_id`),
  KEY `msg_email` (`msg_email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`msg_id`, `msg_email`, `msg_name`, `msg_number`, `msg_message`) VALUES
(1, 'ryansilva2004cr7@gmail.com', 'Product Review', '0776105834', 'product is good hope to do more business\' with you'),
(2, 'ryansilva2004cr7@gmail.com', 'Ryan Silva', '0776105834', 'Your Products Are Great can i negotiate the price of LP40 pro to $10 a piece since I am planning to buy 10 of them'),
(3, 'lakshikas554@gmail.com', 'Refunding of Product LP40', '0775782778', 'I need to refund and cancel an order since i accidently pressed buy now. please can you consider a refund');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

DROP TABLE IF EXISTS `tbl_orders`;
CREATE TABLE IF NOT EXISTS `tbl_orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `order_email` varchar(225) NOT NULL,
  `order_name` varchar(100) NOT NULL,
  `order_number` varchar(12) NOT NULL,
  `order_method` varchar(50) NOT NULL,
  `order_address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`order_id`),
  KEY `order_email` (`order_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `order_email`, `order_name`, `order_number`, `order_method`, `order_address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 'ryansilva2004cr7@gmail.com', 'Ryan Silva\'s 1st Order', '', 'Cash On Delivery', '47/3 Elehiwatta Road Welisara Ragama', 'Lenovo LP40 Pro Bluetooth 5.1 Wireless Earbuds(1)', 14, '2nd March 2022', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

DROP TABLE IF EXISTS `tbl_products`;
CREATE TABLE IF NOT EXISTS `tbl_products` (
  `prod_id` int NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(100) NOT NULL,
  `prod_price` int NOT NULL,
  `prod_qty` int NOT NULL,
  `prod_image` varchar(100) NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`prod_id`, `prod_name`, `prod_price`, `prod_qty`, `prod_image`) VALUES
(4, 'Baseus Bowie H1i Noise-Cancellation Wireless Headphones Cluster Black ', 39, 5, 'image_2023-10-21_225008875.png'),
(5, 'Lenovo LP40 Pro Bluetooth 5.1 Wireless Earbuds', 14, 10, 'Lenovo-LP40-Pro-Bluetooth-5.1-Wireless-Earbuds.jpg'),
(8, 'JBL Boombox 3 Wi-Fi Speaker', 499, 5, 'image_2023-10-22_160654126.png'),
(9, 'JBL Wave 200TWS', 64, 10, 'image_2023-10-22_161135124.png'),
(10, 'Baseus H1 Bowie Noise Cancelling Wireless Headphone', 37, 5, 'image_2023-10-22_161304284.png'),
(11, 'IPhone 15 Pro Max 256GB', 1399, 3, 'image_2023-10-22_161525390.png'),
(12, 'IPhone 14 Pro 256GB', 999, 2, 'image_2023-10-22_161758009.png');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`cart_email`) REFERENCES `tbl_account` (`acc_email`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD CONSTRAINT `tbl_orders_ibfk_1` FOREIGN KEY (`order_email`) REFERENCES `tbl_account` (`acc_email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
