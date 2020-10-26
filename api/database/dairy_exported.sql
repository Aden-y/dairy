-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2020 at 02:25 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dairy`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) NOT NULL,
  `county` varchar(50) NOT NULL,
  `subcounty` varchar(50) NOT NULL,
  `ward` varchar(50) NOT NULL,
  `place` varchar(50) NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `county`, `subcounty`, `ward`, `place`, `user_id`) VALUES
(4, 'Nakuru', 'Naivasha', 'Nakuru', 'Longonot Mountain', 4),
(5, 'Nandi', 'Kipkelion', 'Nandi', 'Marata Sewage', 5),
(6, 'Bomet', 'Kilalel', 'Bomet', 'Mifugo saccos', 6),
(7, 'Kisumu', 'Nyando', 'Kisumu', 'Karanda School', 7),
(8, 'Nairobi', 'Nyando', 'Nairobi', 'Agro farmers', 8),
(9, 'Kisumu', 'Nyando', 'Kisumu', 'Agro farmers', 9),
(11, 'Kisumu', 'Nyando', 'Kisumu', 'Agro farmers', 11),
(12, 'Nakuru', 'Njoro', 'Nakuru', 'Njokerio Slams', 12),
(13, 'WA', 'WA', 'WA', 's', 13),
(14, 'WA', 'WA', 'WA', 'gghhh', 14);

-- --------------------------------------------------------

--
-- Table structure for table `agrovets`
--

CREATE TABLE `agrovets` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agrovets`
--

INSERT INTO `agrovets` (`id`, `user_id`, `name`, `verified`) VALUES
(1, 4, 'Ukulima Bora Agrovet', 0);

-- --------------------------------------------------------

--
-- Table structure for table `agrovet_items`
--

CREATE TABLE `agrovet_items` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `agrovet_id` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `added_on` datetime NOT NULL,
  `unit_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agrovet_items`
--

INSERT INTO `agrovet_items` (`id`, `name`, `category`, `description`, `agrovet_id`, `quantity`, `added_on`, `unit_price`) VALUES
(1, 'Thuder', 'Insectiside', 'Thunger pest controle insetiside', 1, 256, '2020-05-04 19:37:07', 800),
(2, 'Triaticks', 'pestiside', 'Ticks pestiside 250ml', 1, 200, '2020-05-05 20:32:01', 250),
(3, 'Milk Powder', 'Dairy Feed', 'Milk salt', 1, 200, '2020-05-08 11:29:11', 2000),
(4, 'Quality Feeds', 'Animal Feeds', 'Quality 20kg well died and packed feeds.', 1, 1000, '2020-05-08 12:11:53', 200);

-- --------------------------------------------------------

--
-- Table structure for table `collection_point`
--

CREATE TABLE `collection_point` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `county` varchar(30) NOT NULL,
  `subcounty` varchar(30) NOT NULL,
  `ward` varchar(30) NOT NULL,
  `status` enum('Closed','Open') NOT NULL DEFAULT 'Closed',
  `registered_on` date NOT NULL,
  `attendant` bigint(20) DEFAULT NULL,
  `unit_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collection_point`
--

INSERT INTO `collection_point` (`id`, `name`, `county`, `subcounty`, `ward`, `status`, `registered_on`, `attendant`, `unit_price`) VALUES
(1, 'Dairy Daily Station', 'Nakuru', 'Njoro', 'Njokerio', 'Closed', '2020-05-04', 13, 80.03),
(2, 'Dairy Center', 'Nairobi', 'Subcounty', 'Ward', 'Closed', '2020-05-08', 11, 150);

-- --------------------------------------------------------

--
-- Table structure for table `farmer_account`
--

CREATE TABLE `farmer_account` (
  `id` bigint(20) NOT NULL,
  `farmer_id` bigint(20) NOT NULL,
  `balance` double NOT NULL DEFAULT 0,
  `divident` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmer_account`
--

INSERT INTO `farmer_account` (`id`, `farmer_id`, `balance`, `divident`) VALUES
(1, 6, 23825.22, 0),
(2, 7, 17855.85, 0);

-- --------------------------------------------------------

--
-- Table structure for table `farmer_account_transaction_logs`
--

CREATE TABLE `farmer_account_transaction_logs` (
  `id` bigint(20) NOT NULL,
  `farmer_account_id` bigint(20) NOT NULL,
  `type` enum('Debit','Credit') NOT NULL,
  `amount` double NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmer_account_transaction_logs`
--

INSERT INTO `farmer_account_transaction_logs` (`id`, `farmer_account_id`, `type`, `amount`, `description`, `date`) VALUES
(1, 1, 'Credit', 4001.5, 'Submission of 50 litres of milk to Dairy Daily Station collection station at a price of Ksh.80.03 per litre', '2020-05-04 18:10:04'),
(2, 1, 'Credit', 4001.5, 'Submission of 50 litres of milk to Dairy Daily Station collection station at a price of Ksh.80.03 per litre', '2020-05-04 18:10:12'),
(3, 2, 'Credit', 4001.5, 'Submission of 50 litres of milk to Dairy Daily Station collection station at a price of Ksh.80.03 per litre', '2020-05-08 13:16:03'),
(4, 2, 'Credit', 11604.35, 'Submission of 145 litres of milk to Dairy Daily Station collection station at a price of Ksh.80.03 per litre', '2020-05-08 13:16:11'),
(5, 1, 'Credit', 5922.22, 'Submission of 74 litres of milk to Dairy Daily Station collection station at a price of Ksh.80.03 per litre', '2020-05-08 13:32:27'),
(6, 2, 'Credit', 2250, 'Submission of 15 litres of milk to Dairy Center collection station at a price of Ksh.150 per litre', '2020-07-17 15:53:24'),
(7, 1, 'Credit', 4500, 'Submission of 30 litres of milk to Dairy Center collection station at a price of Ksh.150 per litre', '2020-07-17 16:33:13'),
(8, 1, 'Credit', 3000, 'Submission of 20 litres of milk to Dairy Center collection station at a price of Ksh.150 per litre', '2020-07-17 16:34:18'),
(9, 1, 'Credit', 1500, 'Submission of 10 litres of milk to Dairy Center collection station at a price of Ksh.150 per litre', '2020-07-17 16:34:52'),
(10, 1, 'Credit', 900, 'Submission of 6 litres of milk to Dairy Center collection station at a price of Ksh.150 per litre', '2020-07-17 16:35:46');

-- --------------------------------------------------------

--
-- Table structure for table `milk_collections`
--

CREATE TABLE `milk_collections` (
  `id` bigint(20) NOT NULL,
  `farmer_id` bigint(20) NOT NULL,
  `unit_price` double NOT NULL,
  `quantity` double NOT NULL,
  `point_id` bigint(20) NOT NULL,
  `received_by` bigint(20) NOT NULL,
  `received_at` datetime NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `milk_collections`
--

INSERT INTO `milk_collections` (`id`, `farmer_id`, `unit_price`, `quantity`, `point_id`, `received_by`, `received_at`, `amount`) VALUES
(1, 6, 80.03, 50, 1, 11, '2020-05-04 18:05:50', 4001.5),
(2, 6, 80.03, 50, 1, 11, '2020-05-04 18:07:27', 4001.5),
(3, 6, 80.03, 50, 1, 11, '2020-05-04 18:08:20', 4001.5),
(4, 6, 80.03, 50, 1, 11, '2020-05-04 18:10:04', 4001.5),
(5, 6, 80.03, 50, 1, 11, '2020-05-04 18:10:12', 4001.5),
(6, 7, 80.03, 50, 1, 11, '2020-05-08 13:16:03', 4001.5),
(7, 7, 80.03, 145, 1, 11, '2020-05-08 13:16:11', 11604.35),
(8, 6, 80.03, 74, 1, 11, '2020-05-08 13:32:27', 5922.22),
(9, 7, 150, 15, 2, 11, '2020-07-17 15:53:24', 2250),
(10, 6, 150, 30, 2, 11, '2020-07-17 16:33:13', 4500),
(11, 6, 150, 20, 2, 11, '2020-07-17 16:34:17', 3000),
(12, 6, 150, 10, 2, 11, '2020-07-17 16:34:52', 1500),
(13, 6, 150, 6, 2, 11, '2020-07-17 16:35:46', 900);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `farmer_id` bigint(20) NOT NULL,
  `made_on` datetime NOT NULL,
  `status` enum('In-Process','Complete') DEFAULT 'In-Process'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `farmer_id`, `made_on`, `status`) VALUES
(1, 6, '2020-05-05 21:43:06', 'In-Process'),
(2, 6, '2020-05-05 21:43:13', 'In-Process'),
(3, 6, '2020-07-17 19:19:52', 'In-Process'),
(4, 6, '2020-07-17 19:21:51', 'In-Process');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `quantity` double NOT NULL,
  `unit_price` double NOT NULL,
  `amount` double NOT NULL,
  `status` enum('In-Process','Cancelled','Complete') DEFAULT 'In-Process'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `quantity`, `unit_price`, `amount`, `status`) VALUES
(1, 1, 1, 4, 800, 3200, 'Complete'),
(2, 1, 2, 4, 250, 1000, 'In-Process'),
(3, 2, 1, 4, 800, 3200, 'In-Process'),
(4, 2, 2, 4, 250, 1000, 'Complete'),
(5, 3, 2, 1, 250, 250, 'Complete'),
(6, 3, 3, 1, 2000, 2000, 'Complete'),
(7, 3, 4, 1, 200, 200, 'Complete'),
(8, 4, 1, 1, 800, 800, 'Complete'),
(9, 4, 4, 1, 200, 200, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `national_id` int(11) NOT NULL,
  `type` enum('Admin','Farmer','Vet','Agrovet','Employee') DEFAULT NULL,
  `registered_on` datetime NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phone`, `national_id`, `type`, `registered_on`, `password`) VALUES
(4, 'Kigocho', 'Joseph', 'agrovet@dairy.com', '071456879', 14522, 'Agrovet', '2020-05-03 15:19:47', '$2y$10$tRKL.XERpuF2VaW87tSN0uto/LFkQ0y0uPBwnAo1m4z9udTpkxo.u'),
(5, 'Kipchoge', 'Leonard', 'vet@dairy.com', '0745897456', 47856, 'Vet', '2020-05-03 15:23:11', '$2y$10$A7p29HQ2jsK0P2y5/zJlyeC4PV36ub8YEmrfbjXo1zYVkugrjX0w2'),
(6, 'Victor', 'Kiplangat', 'farmer@dairy.com', '0745747496', 78912, 'Farmer', '2020-05-03 15:26:19', '$2y$10$Lg5oq6Zb/DUwnpk1L1gI3.pMWeWfEjuEs/MJSU9HkhBpaggWwDrrK'),
(7, 'Joakim', 'Adeny', 'test@dairy.com', 'test@dairy.com', 4578, 'Farmer', '2020-05-03 16:08:24', '$2y$10$KXhHBvAvqRpiJpyx/kvljO/J9Pv3/dF8UA3ao96PCzjmQaHoWiHke'),
(8, 'Joakim', 'Adeny', 'admin@dairy.1com', '0717474676', 147856, 'Admin', '2020-05-04 15:33:21', '$2y$10$L6FpRYFmpEmeF7TgHSF4x.ePpT8sX3aPUGN0v0zYMlL0PD3CD0ddC'),
(9, 'Joakim', 'Adeny', 'admin@dairy.com', '0717474676', 965823, 'Admin', '2020-05-04 15:35:42', '$2y$10$WGbJOgxnOlovGiqjyAw3O.cM6XhUtCM6IRj7Rfln99qqQoajLba/m'),
(11, 'Joakim', 'Adeny', 'employee@dairy.com', '0717474676', 965893, 'Employee', '2020-05-04 16:08:04', '$2y$10$bOpjvUS9KYXIuEVrXo12SuNCrAJzmlpwQLClKxo7Zo1LQyPQ.4gwG'),
(12, 'Mwanainchi', 'Vet', 'mwananchi@vet.com', '0796452145', 475896, 'Vet', '2020-05-06 12:46:19', '$2y$10$kxnNcRHjpHe3Z26AA/Z0vuwQkTCW6luug4SYMGeMQf2XSOwlA2OMq'),
(13, 'Joakim', 'Adeny', 'princejoachime@gmail.com', '0717174676', 78888, 'Employee', '2020-05-08 16:38:12', '$2y$10$da7un75cxQ47OYwL31dHXujRCg7sWs0eO/aFZ8nu6kvb6IhxgZQbS'),
(14, 'Joakim', 'Adeny', 'admin@gmail.com', '0717174656', 47558, 'Admin', '2020-05-08 16:41:07', '$2y$10$d5pyEXXxGXNfn1MpB2/ItOlZqT5qVm.KZpLqb5GaAZj8ziznwN3rW');

-- --------------------------------------------------------

--
-- Table structure for table `vets`
--

CREATE TABLE `vets` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vets`
--

INSERT INTO `vets` (`id`, `user_id`, `specialization`, `verified`) VALUES
(1, 5, 'Dairy Health', 0),
(2, 12, 'Milk quality analysis', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vet_appointments`
--

CREATE TABLE `vet_appointments` (
  `id` bigint(20) NOT NULL,
  `farmer_id` bigint(20) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_on` datetime NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('Pending','Complete','Cancelled','Rejected','Completed') DEFAULT NULL,
  `vet_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vet_appointments`
--

INSERT INTO `vet_appointments` (`id`, `farmer_id`, `category`, `description`, `created_on`, `date`, `status`, `vet_id`) VALUES
(4, 6, 'ticks', 'All my cows are dying', '2020-05-08 21:27:03', '2020-05-20 00:00:00', 'Pending', 12),
(5, 6, 'Cows not feeding', 'Feeding complecations', '2020-05-08 21:33:45', '2020-05-16 00:00:00', 'Complete', 5),
(6, 6, 'Unknown', 'The cow is not breeding', '2020-07-18 04:07:20', '2020-07-25 00:00:00', 'Pending', 5);

-- --------------------------------------------------------

--
-- Table structure for table `vet_feedbacks`
--

CREATE TABLE `vet_feedbacks` (
  `id` bigint(20) NOT NULL,
  `appointment_id` bigint(20) NOT NULL,
  `problem` text NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vet_feedbacks`
--

INSERT INTO `vet_feedbacks` (`id`, `appointment_id`, `problem`, `feedback`) VALUES
(2, 5, 'Feeding complecations', 'This is test'),
(3, 5, 'Feeding complecations', 'This is test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `agrovets`
--
ALTER TABLE `agrovets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `agrovet_items`
--
ALTER TABLE `agrovet_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection_point`
--
ALTER TABLE `collection_point`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendant` (`attendant`);

--
-- Indexes for table `farmer_account`
--
ALTER TABLE `farmer_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmer_id` (`farmer_id`);

--
-- Indexes for table `farmer_account_transaction_logs`
--
ALTER TABLE `farmer_account_transaction_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmer_account_id` (`farmer_account_id`);

--
-- Indexes for table `milk_collections`
--
ALTER TABLE `milk_collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmer_id` (`farmer_id`),
  ADD KEY `point_id` (`point_id`),
  ADD KEY `received_by` (`received_by`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmer_id` (`farmer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vets`
--
ALTER TABLE `vets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `vet_appointments`
--
ALTER TABLE `vet_appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vet_id` (`vet_id`),
  ADD KEY `farmer_id` (`farmer_id`);

--
-- Indexes for table `vet_feedbacks`
--
ALTER TABLE `vet_feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `agrovets`
--
ALTER TABLE `agrovets`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agrovet_items`
--
ALTER TABLE `agrovet_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `collection_point`
--
ALTER TABLE `collection_point`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `farmer_account`
--
ALTER TABLE `farmer_account`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `farmer_account_transaction_logs`
--
ALTER TABLE `farmer_account_transaction_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `milk_collections`
--
ALTER TABLE `milk_collections`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vets`
--
ALTER TABLE `vets`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vet_appointments`
--
ALTER TABLE `vet_appointments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vet_feedbacks`
--
ALTER TABLE `vet_feedbacks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `agrovets`
--
ALTER TABLE `agrovets`
  ADD CONSTRAINT `agrovets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `collection_point`
--
ALTER TABLE `collection_point`
  ADD CONSTRAINT `collection_point_ibfk_1` FOREIGN KEY (`attendant`) REFERENCES `users` (`id`);

--
-- Constraints for table `farmer_account`
--
ALTER TABLE `farmer_account`
  ADD CONSTRAINT `farmer_account_ibfk_1` FOREIGN KEY (`farmer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `farmer_account_transaction_logs`
--
ALTER TABLE `farmer_account_transaction_logs`
  ADD CONSTRAINT `farmer_account_transaction_logs_ibfk_1` FOREIGN KEY (`farmer_account_id`) REFERENCES `farmer_account` (`id`);

--
-- Constraints for table `milk_collections`
--
ALTER TABLE `milk_collections`
  ADD CONSTRAINT `milk_collections_ibfk_1` FOREIGN KEY (`farmer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `milk_collections_ibfk_2` FOREIGN KEY (`point_id`) REFERENCES `collection_point` (`id`),
  ADD CONSTRAINT `milk_collections_ibfk_3` FOREIGN KEY (`received_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`farmer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `agrovet_items` (`id`);

--
-- Constraints for table `vets`
--
ALTER TABLE `vets`
  ADD CONSTRAINT `vets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `vet_appointments`
--
ALTER TABLE `vet_appointments`
  ADD CONSTRAINT `vet_appointments_ibfk_1` FOREIGN KEY (`vet_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `vet_appointments_ibfk_2` FOREIGN KEY (`farmer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `vet_feedbacks`
--
ALTER TABLE `vet_feedbacks`
  ADD CONSTRAINT `vet_feedbacks_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `vet_appointments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
