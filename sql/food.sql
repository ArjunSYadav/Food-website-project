-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2022 at 09:39 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catid` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_product` int(11) NOT NULL,
  `cat_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `cat_name`, `cat_product`, `cat_image`) VALUES
(1, 'Pizza', 2, 'pizza-banner.jpg'),
(2, 'Burger', 2, 'burger001.png'),
(3, 'Sandwich', 1, 'sandwiches-01.jpg'),
(4, 'Noodle', 1, 'noodel-01.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dish_cart`
--

CREATE TABLE `dish_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dish_detail_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dish_cart`
--

INSERT INTO `dish_cart` (`cart_id`, `user_id`, `dish_detail_id`, `qty`, `added_on`) VALUES
(1, 0, 2, 1, '2021-12-30 18:34:00'),
(2, 0, 2, 1, '2021-12-30 18:34:00'),
(3, 0, 2, 1, '2021-12-30 18:34:00'),
(4, 0, 2, 1, '2021-12-30 18:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pr_id` int(11) NOT NULL,
  `pr_name` varchar(50) NOT NULL,
  `pr_desc` text NOT NULL,
  `pr_cat_id` int(11) NOT NULL,
  `pr_price` int(20) NOT NULL,
  `author` int(11) NOT NULL,
  `pr_img` varchar(50) NOT NULL,
  `veg_or_non` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pr_id`, `pr_name`, `pr_desc`, `pr_cat_id`, `pr_price`, `author`, `pr_img`, `veg_or_non`) VALUES
(1, 'Tandoori Paneer', '                                                                                                                Spiced paneer, Onion, Green Capsicum & Red Paprika in Tandoori Sauce                                                                                                                ', 1, 259, 1, '1639984185-Pizza1.jpg', 0),
(2, 'Burger', '                For every one burger!                ', 2, 50, 1, '1644139157-burger001.png', 1),
(3, 'Sandwich-paneer-cheese', 'Sandwich with paneer and mouth watering cheese,that melt in your mouth.', 3, 49, 1, '1644139657-sandwiches-01.jpg', 0),
(4, 'Manchow Noodle', 'Noodle for your taste bud will blow your  mind. ', 4, 120, 1, '1644139932-noodel-01.jpg', 0),
(5, 'Chicken-patty Burger', 'Chicken-patty burger with multiple dipping sauce.', 2, 99, 1, '1644140135-chicken-burger01.jpg', 1),
(6, 'Pizza chicken  meat', 'Delicious chicken on your pizza just the way you want.', 1, 135, 1, '1644140320-non-veg-pizza-01.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_pass` varchar(200) NOT NULL,
  `user_roll` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `first_name`, `last_name`, `user_name`, `user_pass`, `user_roll`) VALUES
(1, '', 'Sumit', 'singh', 'Sumit_singh', '948fab37aeaa563cfa7f009d836ead8d', 1),
(2, 'arjunsingh@gmail.com', 'Arjun kumar', 'yadav', 'arjun_yadav', '948fab37aeaa563cfa7f009d836ead8d', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE `user_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pr_id` int(11) NOT NULL,
  `pay` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`id`, `user_id`, `pr_id`, `pay`, `quantity`, `order_date`) VALUES
(1, 2, 1, 259, 1, '2021-12-29 13:20:30'),
(2, 2, 1, 777, 3, '2021-12-29 13:20:58'),
(3, 2, 1, 259, 1, '2021-12-29 13:22:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `dish_cart`
--
ALTER TABLE `dish_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pr_id`),
  ADD KEY `id` (`pr_id`),
  ADD KEY `id_2` (`pr_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dish_cart`
--
ALTER TABLE `dish_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_order`
--
ALTER TABLE `user_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
