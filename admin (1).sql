-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2024 at 09:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2'),
(3, 'bhoomika', '7c222fb2927d828af22f592134e8932480637c0d'),
(4, 'isha', 'a7d579ba76398070eae654c30ff153a4c273272a'),
(5, 'bhavna', '1f82c942befda29b6ed487a51da199f78fce7f05'),
(6, 'nennn', '1a8b0470424de470048804afb56321a51e8cec17'),
(7, 'anju', '8b6994f41317045b20af5f80f412b40279ba9da5');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(4, 3, 2, 'pizza', 200, 1, '1082011.jpg'),
(5, 3, 3, 'sandwich', 432, 1, 'home-img-3.png'),
(6, 4, 2, 'pizza', 200, 1, '1082011.jpg'),
(7, 5, 1, 'burger ', 200, 1, 'b5b8fdc69450664acbaa4d6533d65134.jpg'),
(8, 5, 12, 'bhoomika', 2, 1, 'drink-5.png');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(2, 3, 'amishachouhan', 'amishachouhanrajput@gmail.com', '2345098763', 'taste is so delicious'),
(3, 3, 'bhoomika', 'bhavna123@gmail.com', '9876345677', 'hmmmmmm');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 2, 'dzg', '2345678', 'kjhgf@gmai.com', 'credit card', 'gh, jg, jg, jgj, hgj, g, jg - 21212', 'pizza (200 x 1) - burger  (200 x 1) - ', 400, '2024-05-02', 'completed'),
(2, 3, 'anjana', '7653789567', 'anjana@gmail.com', 'cash on delivery', '23, 23, university, gneshnagr, udaipur, rajasthan, india - 313313', 'burger  (200 x 1) - ', 200, '2024-05-05', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`) VALUES
(1, 'burger ', 'main dish', 200, 'b5b8fdc69450664acbaa4d6533d65134.jpg'),
(2, 'pizza', 'fast food', 200, '1082011.jpg'),
(3, 'sandwich', 'main dish', 432, 'home-img-3.png'),
(5, 'smootie', 'drinks', 150, 'pexels-photo-2480828.webp'),
(6, 'green smootie', 'drinks', 200, 'pexels-photo-1346347.jpeg'),
(7, 'choco pastry', 'desserts', 120, 'pexels-photo-291528.jpeg'),
(9, 'Donut', 'desserts', 230, 'pexels-photo-7474254.jpeg'),
(10, 'Fries', 'fast food', 120, 'pexels-photo-6941028.webp'),
(11, 'berry dessert', 'desserts', 200, 'pexels-photo-1132558.jpeg'),
(12, 'bhoomika', 'drinks', 2, 'drink-5.png'),
(13, 'chezy ramen', 'fast food', 250, 'dish-3.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(1, 'bhoomika', 'itzz.a.chouhan@gmail.com', '1456765432', '7c222fb2927d828af22f592134e8932480637c0d', ''),
(2, 'dzg', 'kjhgf@gmai.com', '2345678', '7c222fb2927d828af22f592134e8932480637c0d', 'gh, jg, jg, jgj, hgj, g, jg - 21212'),
(3, 'anjana', 'anjana@gmail.com', '7653789567', 'ffb882084c612ea7721531afd4c45d7b1f59bffd', '23, 23, university, gneshnagr, udaipur, rajasthan, india - 313313'),
(4, 'yash', 'amishachouhanrajput@gmail.com', '8478475', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', ''),
(5, 'sid', 'sidharth@gmail.com', '7850016609', '76730bab9774f7cfb3d00121deb3106e97cf04cd', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
