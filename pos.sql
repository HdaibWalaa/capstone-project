-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8889
-- Generation Time: Jan 10, 2023 at 06:29 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `cost` float NOT NULL,
  `quantity` int(20) NOT NULL,
  `selling_price` float NOT NULL,
  `image` varchar(30) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `cost`, `quantity`, `selling_price`, `image`, `category`, `created_at`, `updated_at`) VALUES
(57, 'sandwich2', 2, 22, 2, 'image-.23.57.jpeg', '', '2023-01-07 10:06:40', '2023-01-10 16:20:21'),
(58, 'ice mocha', 2, 12, 4.5, 'image-.24.58.jpeg', 'Milk Passed', '2023-01-07 10:53:41', '2023-01-09 17:30:17'),
(60, 'sandwish', 2, 28, 4, 'image-.26.60.jpeg', 'Sandwish', '2023-01-07 11:10:59', '2023-01-10 16:05:36'),
(61, 'ice tea', 1, 3, 3, 'image-.27.61.jpeg', 'Jucie', '2023-01-07 11:15:38', '2023-01-07 11:15:38'),
(62, 'ice american', 2, 8, 3.5, 'image-.28.62.jpeg', 'Coffee', '2023-01-07 11:23:01', '2023-01-10 16:06:13'),
(64, 'capcino', 2, 19, 3.5, 'image-.30.64.jpeg', 'Milk Passed', '2023-01-07 11:30:21', '2023-01-10 12:31:37'),
(65, 'matcha latte', 2.5, 22, 4, 'image-.31.65.jpeg', 'Milk Passed', '2023-01-07 15:46:08', '2023-01-07 15:46:08'),
(66, 'vanilla latte', 2, 22, 3.5, 'image-.32.66.png', 'Milk Passed', '2023-01-07 17:21:53', '2023-01-07 18:09:16'),
(67, 'redvilvet cake', 2, 22, 4, 'image-.33.67.jpeg', 'Desert', '2023-01-08 09:20:24', '2023-01-08 09:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(20) NOT NULL,
  `items_id` int(20) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `quantity` int(20) NOT NULL,
  `price` float NOT NULL,
  `cost` float NOT NULL,
  `total` float NOT NULL,
  `expenses` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `items_id`, `item_name`, `quantity`, `price`, `cost`, `total`, `expenses`, `created_at`, `updated_at`) VALUES
(311, 63, 'esspreso', 2, 2.5, 2, 5, 4, '2023-01-09 17:35:32', '2023-01-09 17:35:32'),
(312, 60, 'sandwish', 3, 4, 2, 12, 6, '2023-01-09 17:35:39', '2023-01-09 17:35:39'),
(314, 64, 'capcino', 3, 3.5, 2, 10.5, 6, '2023-01-10 12:31:37', '2023-01-10 12:31:37'),
(315, 60, 'sandwish', 1, 4, 2, 4, 2, '2023-01-10 14:55:19', '2023-01-10 14:55:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(7) NOT NULL,
  `username` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `permissions` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `display_name`, `email`, `password`, `role`, `permissions`, `image`, `created_at`, `updated_at`) VALUES
(1, 'asma', 'asma', 'asma@gmail.com', '$2y$10$sPgMu3CNO7ENO7KBs2e3B.96qPYKIOhUq9suI.FwMg18/4MKcS/o.', 'admin', 'a:12:{i:0;s:9:\"item:read\";i:1;s:11:\"item:create\";i:2;s:11:\"item:update\";i:3;s:11:\"item:delete\";i:4;s:9:\"user:read\";i:5;s:11:\"user:create\";i:6;s:11:\"user:update\";i:7;s:11:\"user:delete\";i:8;s:16:\"transaction:read\";i:9;s:18:\"transaction:create\";i:10;s:18:\"transaction:update\";i:11;s:18:\"transaction:delete\";}', 'profile1.png', '2023-01-10 15:10:57', '2023-01-10 15:10:57'),
(2, 'jozod', 'MR.Ila Swanson', 'lyme@mailinator.com', '$2y$10$sPgMu3CNO7ENO7KBs2e3B.96qPYKIOhUq9suI.FwMg18/4MKcS/o.', 'admin', 'a:12:{i:0;s:9:\"item:read\";i:1;s:11:\"item:create\";i:2;s:11:\"item:update\";i:3;s:11:\"item:delete\";i:4;s:9:\"user:read\";i:5;s:11:\"user:create\";i:6;s:11:\"user:update\";i:7;s:11:\"user:delete\";i:8;s:16:\"transaction:read\";i:9;s:18:\"transaction:create\";i:10;s:18:\"transaction:update\";i:11;s:18:\"transaction:delete\";}', 'image-.admin.jpeg', '2023-01-09 11:58:06', '2023-01-09 11:58:06'),
(4, 'sana', 'mr.sana', 'test@test.com', '$2y$10$.gFeXTbunml6QrWwYaLkv.6u0.eTS7WuHVbuHUsm3T/tz4aKjjUtK', 'seller', 'a:3:{i:0;s:18:\"transaction:create\";i:1;s:18:\"transaction:update\";i:2;s:18:\"transaction:delete\";}', 'image-.wala_hudib.png', '2023-01-10 16:49:20', '2023-01-10 16:49:20'),
(8, 'Oliver', 'MR.Oliver', 'Oliver@gmail.com', '$2y$10$1VtcCv1pmEgzfCIaaNRVNOefg5BlUqubzi3e1InQPGLMs.vcIDOM2', 'admin', 'a:12:{i:0;s:9:\"item:read\";i:1;s:11:\"item:create\";i:2;s:11:\"item:update\";i:3;s:11:\"item:delete\";i:4;s:9:\"user:read\";i:5;s:11:\"user:create\";i:6;s:11:\"user:update\";i:7;s:11:\"user:delete\";i:8;s:16:\"transaction:read\";i:9;s:18:\"transaction:create\";i:10;s:18:\"transaction:update\";i:11;s:18:\"transaction:delete\";}', 'image-.omar.png', '2023-01-09 12:48:37', '2023-01-09 12:48:37'),
(9, 'Elijah', 'MR.Elijah', 'Elijah@gmail.com', '$2y$10$2mArsVRreZha82Z.7DyyUO227DFrh0b8CMTDIg4YbKV8ob4lwV3cm', 'admin', 'a:12:{i:0;s:9:\"item:read\";i:1;s:11:\"item:create\";i:2;s:11:\"item:update\";i:3;s:11:\"item:delete\";i:4;s:9:\"user:read\";i:5;s:11:\"user:create\";i:6;s:11:\"user:update\";i:7;s:11:\"user:delete\";i:8;s:16:\"transaction:read\";i:9;s:18:\"transaction:create\";i:10;s:18:\"transaction:update\";i:11;s:18:\"transaction:delete\";}', 'image-.Elijah.png', '2023-01-09 12:04:34', '2023-01-09 12:04:34'),
(33, 'Garza', 'Illiana Garza', 'IllianaGarza@gmail.com', '$2y$10$.DN1SKztkjUzmFvahCKPLuPt7H885CU4FEEIgL2qqZpRHlQePBh16', 'accountant', 'a:3:{i:0;s:16:\"transaction:read\";i:1;s:18:\"transaction:update\";i:2;s:18:\"transaction:delete\";}', 'image-.Garza.33.png', '2023-01-10 12:22:13', '2023-01-10 12:22:13'),
(34, 'Erickson', 'Imani Erickson', 'ImaniErickson@gmail.com', '$2y$10$0PfV1xjwYlE//8xn.dLFo.yKwQzgp8KmGak9..vK7Neudu3d54ma6', 'porcurement', 'a:2:{i:0;s:11:\"item:update\";i:1;s:11:\"item:delete\";}', 'image-.Erickson.34.jpeg', '2023-01-10 13:05:49', '2023-01-10 13:05:49'),
(35, 'Swanson', 'Ila Swanson', 'IlaSwanson@gmail.com', '$2y$10$/z8XXWbJCYTc6grs8F55bui6I45OjtnC.tpgCRK0G5K.7Lcz/iCm.', 'accountant', 'a:3:{i:0;s:16:\"transaction:read\";i:1;s:18:\"transaction:update\";i:2;s:18:\"transaction:delete\";}', 'image-.Swanson.35.png', '2023-01-10 13:45:51', '2023-01-10 13:45:51'),
(36, 'samar', 'samr', 'samar@gmail.com', '$2y$10$3YqPbS5hvjJODI6NgfR4ruT.14an4BReJMYLB9o7i4xFQJ.TFsi16', 'porcurement', 'a:2:{i:0;s:11:\"item:update\";i:1;s:11:\"item:delete\";}', 'image-.samar.36.png', '2023-01-10 14:52:18', '2023-01-10 14:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `users_transactions`
--

CREATE TABLE `users_transactions` (
  `id` int(20) NOT NULL,
  `transaction_id` int(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_transactions`
--

INSERT INTO `users_transactions` (`id`, `transaction_id`, `user_id`) VALUES
(274, 311, 1),
(275, 312, 1),
(277, 314, 4),
(278, 315, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_transactions`
--
ALTER TABLE `users_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_fid` (`user_id`),
  ADD KEY `transaction_fid` (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users_transactions`
--
ALTER TABLE `users_transactions`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_transactions`
--
ALTER TABLE `users_transactions`
  ADD CONSTRAINT `transaction_fid` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
  ADD CONSTRAINT `user_fid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
