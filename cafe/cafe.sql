-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2020 at 02:07 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `beverages`
--

CREATE TABLE `beverages` (
  `F_ID` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `images_path` varchar(200) NOT NULL,
  `options` varchar(10) NOT NULL DEFAULT 'ENABLE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beverages`
--

INSERT INTO `beverages` (`F_ID`, `name`, `price`, `description`, `images_path`, `options`) VALUES
(2, 'Coffee', 25, 'concentrated coffee made through finely ground beans.', 'images/coffee.jpg', 'ENABLE'),
(3, 'Tea', 20, 'The simple elixir of tea is of our natural world.', 'images/tea.jpg', 'ENABLE'),
(4, 'Hot Chocolate', 45, ' A combination of cocoa powder and choco chips with Whipped cream ', 'images/hotchocolate.jpg', 'ENABLE');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `userid` int(11) NOT NULL,
  `F_ID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `milkshakes`
--

CREATE TABLE `milkshakes` (
  `F_ID` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `images_path` varchar(200) NOT NULL,
  `options` varchar(10) NOT NULL DEFAULT 'ENABLE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `milkshakes`
--

INSERT INTO `milkshakes` (`F_ID`, `name`, `price`, `description`, `images_path`, `options`) VALUES
(10, 'Choco Chip Shake', 90, 'Choco Chip Shake - a perfect party sweet treat.', 'images/chocochipshake.jpg', 'ENABLE'),
(11, 'KitKat Milkshake', 80, 'Crunch and choclaty kitkat flaovoured milkshake', 'images/kitkatshake.png', 'ENABLE'),
(12, 'Oreo Milkshake', 85, 'Oreo blended shake served with whipped cream, biscuit oreo as topping', 'images/oreoshake.jpg', 'ENABLE'),
(13, 'Vanilla Milkshake', 85, 'Vanilla ice cream blended milkshake with whipped cream', 'images/vanilla shake.jpg', 'ENABLE');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_ID` int(30) NOT NULL,
  `F_ID` int(30) NOT NULL,
  `foodname` varchar(30) NOT NULL,
  `price` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `order_date` date NOT NULL,
  `username` varchar(30) NOT NULL,
  `userid` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_ID`, `F_ID`, `foodname`, `price`, `quantity`, `order_date`, `username`, `userid`) VALUES
(1, 2, 'Coffee', 25, 1, '2020-08-17', 'test', 3),
(2, 2, 'Coffee', 25, 1, '2020-08-17', 'test', 3),
(3, 2, 'Coffee', 25, 1, '2020-08-17', 'test', 3),
(4, 2, 'Coffee', 25, 1, '2020-08-17', 'test', 3),
(5, 3, 'Tea', 20, 1, '2020-08-17', 'test', 3),
(6, 4, 'Hot Chocolate', 45, 1, '2020-08-17', 'test', 3),
(7, 2, 'Coffee', 25, 1, '2020-08-17', 'test', 3),
(8, 3, 'Tea', 20, 1, '2020-08-17', 'test', 3),
(9, 4, 'Hot Chocolate', 45, 1, '2020-08-17', 'test', 3),
(10, 2, 'Coffee', 25, 1, '2020-08-18', 'test', 3),
(11, 3, 'Tea', 20, 1, '2020-08-18', 'test', 3),
(12, 4, 'Hot Chocolate', 45, 1, '2020-08-18', 'test', 3),
(13, 2, 'Coffee', 25, 1, '2020-08-18', 'test', 3),
(14, 3, 'Tea', 20, 1, '2020-08-18', 'test', 3),
(15, 4, 'Hot Chocolate', 45, 1, '2020-08-18', 'test', 3),
(16, 2, 'Coffee', 25, 1, '2020-08-18', 'test', 3),
(17, 3, 'Tea', 20, 1, '2020-08-18', 'test', 3),
(18, 4, 'Hot Chocolate', 45, 1, '2020-08-18', 'test', 3),
(19, 2, 'Coffee', 25, 1, '2020-08-18', 'test', 3),
(20, 3, 'Tea', 20, 1, '2020-08-18', 'test', 3),
(21, 4, 'Hot Chocolate', 45, 1, '2020-08-18', 'test', 3),
(22, 3, 'Tea', 20, 1, '2020-08-18', 'test', 3),
(23, 4, 'Hot Chocolate', 45, 3, '2020-08-18', 'test', 3),
(24, 4, 'Hot Chocolate', 45, 1, '2020-08-21', 'test', 3),
(25, 10, 'Choco Chip Shake', 90, 1, '2020-08-21', 'test', 3),
(26, 4, 'Hot Chocolate', 45, 1, '2020-08-21', 'test', 3),
(27, 4, 'Hot Chocolate', 45, 1, '2020-08-21', 'test', 3),
(28, 4, 'Hot Chocolate', 45, 1, '2020-08-21', 'test', 3),
(29, 3, 'Tea', 20, 1, '2020-08-25', 'test', 3),
(30, 3, 'Tea', 20, 1, '2020-08-25', 'test', 3),
(31, 2, 'Coffee', 25, 1, '2020-08-26', 'test', 4),
(32, 10, 'Choco Chip Shake', 90, 1, '2020-08-26', 'test', 4),
(33, 21, 'Paneer Sandwich', 45, 1, '2020-08-26', 'test', 4),
(34, 32, 'Veg Loaded', 380, 1, '2020-08-26', 'test', 4),
(35, 13, 'Vanilla Milkshake', 85, 2, '2020-08-26', 'test', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pizza`
--

CREATE TABLE `pizza` (
  `F_ID` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `images_path` varchar(200) NOT NULL,
  `options` varchar(10) NOT NULL DEFAULT 'ENABLE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pizza`
--

INSERT INTO `pizza` (`F_ID`, `name`, `price`, `description`, `images_path`, `options`) VALUES
(31, 'Margherita', 300, 'The ever-popular Margherita - loaded with extra cheese of it!', 'images/margherita.jpg', 'ENABLE'),
(32, 'Veg Loaded', 380, 'Pizza Loaded with olives,corn,mushroom,jalapeno and onions', 'images/vegpizza.jpg', 'ENABLE'),
(33, 'Non-Veg Loaded', 430, 'Pizza with Peri-Peri Chicken,Chicken Tikka & Grilled Chicken Rashers', 'images/chickenpizza.jpg', 'ENABLE'),
(34, 'Peppy Paneer', 330, 'Chunky paneer with crisp capsicum and spicy red pepper - quite a mouthful!', 'images/paneerpizza.png', 'ENABLE');

-- --------------------------------------------------------

--
-- Table structure for table `rolls`
--

CREATE TABLE `rolls` (
  `F_ID` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `images_path` varchar(200) NOT NULL,
  `options` varchar(10) NOT NULL DEFAULT 'ENABLE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rolls`
--

INSERT INTO `rolls` (`F_ID`, `name`, `price`, `description`, `images_path`, `options`) VALUES
(41, 'Veg Spring Roll', 80, 'Crispy deep fried snacks filled with a delicious stuffing of lightly spiced and crunchy vegetables.', 'images/springroll.jpg', 'ENABLE'),
(42, 'Paneer Kathi Roll', 80, ' Layered parathas filled with spicy paneer, mixed peppers and sweet caramelized onions', 'images/paneerkathiroll.jpg', 'ENABLE'),
(43, 'Aloo Kathi Roll', 80, 'Rolled paratha with green chutney, potato stuffing, veg salad mix', 'images/alookathiroll.jpg', 'ENABLE'),
(44, 'Chicken Kathi Roll', 85, 'Wheat flour phulkas rolled in with a masaledar chicken tikka and veggies', 'images/chickenkathiroll.jpg', 'ENABLE'),
(45, 'Chicken Shawarma', 90, 'Chicken baked in a yogurt marinade rolled up in kuboos served with mayonnaise', 'images/chickenshawarma.jpg', 'ENABLE');

-- --------------------------------------------------------

--
-- Table structure for table `sandwich`
--

CREATE TABLE `sandwich` (
  `F_ID` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `images_path` varchar(200) NOT NULL,
  `options` varchar(10) NOT NULL DEFAULT 'ENABLE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sandwich`
--

INSERT INTO `sandwich` (`F_ID`, `name`, `price`, `description`, `images_path`, `options`) VALUES
(20, 'Veg Cheese Sandwich', 40, 'Grilled Sandwich with black pepper,cheese,sweet corn and other vegies', 'images/vegsandwich.jpg', 'ENABLE'),
(21, 'Paneer Sandwich', 45, 'Grilled Sandwich with cheese,fresh panneer and vegies', 'images/paneersandwich.jpg', 'ENABLE'),
(22, 'Chicken Sandwich', 50, 'Grilled Sandwich with smoked chicken, cheese, sliced avocado and tomato  ', 'images/chickensandwich.jpg', 'ENABLE');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `firstName`, `lastName`, `username`, `password`, `address`, `phone`) VALUES
(2, 'Vignesh', 'Shanmugam', 'vigneshshanmugam99@gmail.com', '1a52e17fa899cf40fb04cfc42e6352f1', 'B-Type 9/263 48th Street, Sidco Nagar Villivakkam', '9791115076'),
(3, 'test', 'test', 'test@abc.com', 'e1d09b11d23bd7beba194170e4e48f3c', 'B-Type 9/263 48th Street, Sidco Nagar Villivakkam', '12345678900'),
(4, 'test', 'tset', 'test2@abc.com', 'e1d09b11d23bd7beba194170e4e48f3c', 'bfrdqwiqwpeqwpeqe', '446546468');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beverages`
--
ALTER TABLE `beverages`
  ADD PRIMARY KEY (`F_ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beverages`
--
ALTER TABLE `beverages`
  MODIFY `F_ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
