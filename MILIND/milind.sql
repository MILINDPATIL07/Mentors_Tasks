-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2022 at 10:08 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `milind`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `gender`, `hobbies`, `password`) VALUES
(1, 'milind', 'milind@gmail.com', 'Male', 'Cricket,Singing,Swimming', 'Pass@123'),
(2, 'vishal', 'vishal@gmail.com', 'Male', 'Cricket', 'Pass@123'),
(3, 'chaitanya', 'chaitanya@gmail.com', 'Male', 'Cricket,Singing,Swimming,Shopping', 'Pass@123'),
(4, 'ash', 'ash@gmail.com', 'Male', 'Singing,Shopping', 'Pass@123');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` enum('Yes','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `active`) VALUES
(1, 'Mobile', 'Yes'),
(2, 'Laptops', 'Yes'),
(3, 'Cars', 'No'),
(4, 'Headphones', 'No'),
(5, 'milind', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `images` varchar(255) NOT NULL,
  `createdbyuser` varchar(255) NOT NULL,
  `active` enum('Yes','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `p_name`, `category_id`, `images`, `createdbyuser`, `active`) VALUES
(1, 'Samsung', 1, 'S22.jpeg', 'testuser@kcsitglobal.com', 'Yes'),
(2, 'Oneplus', 1, 'oneplus.jpeg', 'testuser@kcsitglobal.com', 'Yes'),
(3, 'Motorola', 1, 'motorolag.jpeg', 'testuser@kcsitglobal.com', 'Yes'),
(4, 'Dell', 2, 'dell.jpeg', 'testuser@kcsitglobal.com', 'Yes'),
(6, 'Hp', 2, 'hp.jpeg', 'testuser@kcsitglobal.com', 'No'),
(7, 'Harrier', 3, 'Harrier.jpeg', 'testuser@kcsitglobal.com', 'Yes'),
(8, 'i20', 3, 'i20.jpeg', 'testuser@kcsitglobal.com', 'Yes'),
(9, 'Sports', 3, 'sports.jpeg', 'testuser@kcsitglobal.com', 'No'),
(10, 'ash', 5, 'bg.jpg', 'testuser@kcsitglobal.com', 'No'),
(11, 'testq', 5, 'iphone.jpeg', 'testuser@kcsitglobal.com', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`id`, `email`, `password`) VALUES
(1, 'testuser@kcsitglobal.com', 'secret');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
