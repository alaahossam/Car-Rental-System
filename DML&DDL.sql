-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 30, 2022 at 12:10 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `fname` varchar(25) DEFAULT NULL,
  `lname` varchar(25) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`fname`, `lname`, `email`, `password`) VALUES
('EL-COMPANY EL-MASRIA', 'Letegara El Sayarat', 'admin@admin.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_plate_id` varchar(10) NOT NULL,
  `brand_name` varchar(30) DEFAULT NULL,
  `brand_model` varchar(30) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `img` text DEFAULT NULL,
  `Type` varchar(255) DEFAULT NULL,
  `automatic` char(1) DEFAULT NULL,
  `out_of_service` char(1) DEFAULT '0',
  `hourse_power` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_plate_id`, `brand_name`, `brand_model`, `color`, `year`, `office_id`, `price`, `img`, `Type`, `automatic`, `out_of_service`, `hourse_power`) VALUES
('Alex14755', 'BMW', 'x6', 'black', 2020, 3, 1900, 'BMW_X6.jpg', 'suv', '1', '0', 450),
('hnjm', 'BMW', '320i', 'blue', 2016, 14, 115, 'BMW_320i.jpg', 'sedan', '0', '1', 122);

-- --------------------------------------------------------

--
-- Table structure for table `car_status`
--

CREATE TABLE `car_status` (
  `car_plate_id` varchar(255) NOT NULL,
  `out_of_service_start_date` date NOT NULL,
  `out_of_service_end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car_status`
--

INSERT INTO `car_status` (`car_plate_id`, `out_of_service_start_date`, `out_of_service_end_date`) VALUES
('hnjm', '2022-12-30', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `office_id` int(11) NOT NULL,
  `office_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`office_id`, `office_name`, `location`) VALUES
(1, 'El-se7s ll-sayarat', 'Alexandria'),
(2, 'Agance El-Hag Sayed', 'Newyork'),
(3, 'Agance El-Nour', 'Germany'),
(4, 'Agance El-Nas', 'Austria'),
(5, 'Agance El-Hag Sayed', 'Germany'),
(13, 'Agance el magd', 'Russia'),
(14, 'soma', 'egypt'),
(15, 'so', 'egypt'),
(16, 'koooooo', 'egypt'),
(17, 'ssssssssssssssssssss', 'Alexandria'),
(18, 'kaza', 'morocco');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `reservation_date` date DEFAULT NULL,
  `pick_up_date` date NOT NULL,
  `return_date` date NOT NULL,
  `car_plate_id` varchar(10) NOT NULL,
  `ssn` varchar(14) NOT NULL,
  `office_id` int(11) DEFAULT NULL,
  `payment` char(1) DEFAULT NULL,
  `paid_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `reservation_date`, `pick_up_date`, `return_date`, `car_plate_id`, `ssn`, `office_id`, `payment`, `paid_at`) VALUES
(18, '2022-12-30', '2023-02-03', '2023-02-28', 'Alex14755', '30101100100111', 3, 'F', '2023-02-03'),
(12, '2022-12-12', '2022-12-30', '2022-12-31', 'Alex14755', '30101100100121', 3, 'T', '2022-12-28'),
(10, '2022-12-29', '2023-01-02', '2023-01-05', 'Alex14755', '30101100100121', 3, 'T', '2022-12-29'),
(11, '2022-12-29', '2023-01-08', '2023-01-11', 'Alex14755', '30101100100121', 3, 'T', '2022-12-30'),
(13, '2022-12-29', '2023-01-18', '2023-01-19', 'Alex14755', '30101100100121', 3, 'T', '2022-12-29'),
(14, '2022-12-29', '2023-01-20', '2023-01-21', 'Alex14755', '30101100100121', 3, 'T', '2022-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ssn` varchar(14) NOT NULL,
  `fname` varchar(25) DEFAULT NULL,
  `lname` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ssn`, `fname`, `lname`, `email`, `password`, `age`, `gender`, `phone`) VALUES
('30101100100111', 'Ahmed', 'Hassan', 'ahmed@gmail.com', 'ahmed', 21, 'M', '01010101010'),
('30101100100121', 'Kiro', 'Gayed', 'kiro@gmail.com', 'kiro', 21, 'M', '01010101011'),
('30101100100141', 'Ahmed', 'Falah', 'falah@gmail.com', 'falah', 21, 'M', '01010101013'),
('30101100100311', 'Alaa', 'Hossam', 'alaa@gmail.com', 'alaa', 21, 'F', '01010101012');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_plate_id`),
  ADD KEY `car_ibfk_1` (`office_id`);

--
-- Indexes for table `car_status`
--
ALTER TABLE `car_status`
  ADD PRIMARY KEY (`car_plate_id`,`out_of_service_start_date`) USING BTREE;

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`office_id`,`location`) USING BTREE;

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`car_plate_id`,`ssn`,`pick_up_date`,`return_date`),
  ADD UNIQUE KEY `reservation_id` (`reservation_id`),
  ADD KEY `reservation_ibfk_2` (`ssn`),
  ADD KEY `reservation_ibfk_3` (`office_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ssn`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`office_id`) REFERENCES `office` (`office_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `car_status`
--
ALTER TABLE `car_status`
  ADD CONSTRAINT `car_status_ibfk_1` FOREIGN KEY (`car_plate_id`) REFERENCES `car` (`car_plate_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `car_status_ibfk_2` FOREIGN KEY (`car_plate_id`) REFERENCES `car` (`car_plate_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`car_plate_id`) REFERENCES `car` (`car_plate_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`ssn`) REFERENCES `users` (`ssn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`office_id`) REFERENCES `office` (`office_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
