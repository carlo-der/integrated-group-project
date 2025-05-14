-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2025 at 01:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(2, 'Apparel'),
(3, 'Electronics'),
(4, 'Entertainment'),
(5, 'Free Stuff'),
(7, 'Garden & Outdoor'),
(8, 'Home Goods'),
(9, 'Sporting Goods'),
(10, 'Pet Supplies'),
(11, 'Hobbies'),
(12, 'Musical Instruments');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id`, `sender_id`, `receiver_id`, `message`, `timestamp`) VALUES
(4, 17, 50, 'I am interested in buying the shoes', '2025-05-14 11:45:53'),
(5, 18, 50, 'I am interested in the shoes', '2025-05-14 11:51:10'),
(6, 18, 50, 'testing', '2025-05-14 11:51:20'),
(7, 50, 18, 'Replying', '2025-05-14 11:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `listed_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('available','sold') NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `seller_id`, `title`, `description`, `price`, `category_id`, `image`, `listed_at`, `status`) VALUES
(26, 50, 'T shirt', 'Black T shirt in size medium, condition is new', 10.00, 2, 'T shirt.jpg', '2025-05-14 10:20:42', 'available'),
(27, 50, 'White Air forces', 'White air forces, mint condition', 90.00, 2, 'air forces.jpg', '2025-05-14 10:29:08', 'available'),
(28, 50, 'Black air forces', 'Black air forces, good condition', 60.00, 2, 'black air forces.jpg', '2025-05-14 10:29:48', 'available'),
(29, 50, 'Panda air forces', 'Panda air forces, brand new', 100.00, 2, 'panda air forces.jpg', '2025-05-14 10:30:33', 'available'),
(30, 50, 'Adidas hat', 'Adidas baseball hat, very good condition', 15.00, 2, 'hat.jpg', '2025-05-14 10:31:32', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `items_id` int(11) NOT NULL,
  `message_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `read_status` enum('unread','read') NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `reviewer_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_role` enum('buyer','seller','admin') NOT NULL DEFAULT 'buyer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `phone_number`, `address`, `created_at`, `updated_at`, `user_role`) VALUES
(17, 'test1', 'test1@test1.com', '$2y$10$.ZJ5XpAoLVtZ2j/15a73QeOibSHxQqDaxNPL5UE/Of.RtiWrNJ1qS', NULL, NULL, '2025-05-12 18:10:37', '2025-05-12 18:10:37', 'buyer'),
(18, 'test2', 'test2@test2.com', '$2y$10$ZN2iB9SSbrcQwbuS/ifE7OckNbrvE7Cxx6TGnCv1nfPKXaWEfBXK2', NULL, NULL, '2025-05-13 10:58:26', '2025-05-13 10:58:26', 'buyer'),
(49, 'newuser', 'newuser@uni.brighton.ac.uk', '$2y$10$a1mML.AChcR2LGGz048skueyT2zjMGJti8eWGdyyibikoa7jnhtyi', NULL, '', '2025-05-14 10:12:36', '2025-05-14 10:12:36', 'buyer'),
(50, 'Rocco', 'Rocco@uni.brighton.ac.uk', '$2y$10$6wNJ6j2YpmgbUpRABuvQwewTbR3NcfRVHizY0NpgD60Z7xRtf7Xzm', NULL, 'Rocco', '2025-05-14 10:18:23', '2025-05-14 10:18:23', 'buyer'),
(51, 'testing1', 'testing1@uni.brighton.ac.uk', '$2y$10$mVRpTnV87v3L2I74TgOnAuD0C91.A8kslp.upxT2JLdCkkn43Hshi', NULL, 'testing', '2025-05-14 10:38:04', '2025-05-14 10:38:04', 'buyer'),
(52, 'test1', 'test1@uni.brighton.ac.uk', '$2y$10$h7hkgcVzAQmrBbU38hyBoOiH4vWh4aIeEG/kC49MeHOtFceA0nfo.', NULL, 'test1', '2025-05-14 10:44:15', '2025-05-14 10:44:15', 'buyer'),
(53, 'test2', 'test2@uni.brighton.ac.uk', '$2y$10$sN1eNOQasKd3BiUdz2arpuuDG7R5sUt4kEALNksJU94FCaLAubgl.', NULL, 'test2', '2025-05-14 10:49:12', '2025-05-14 10:49:12', 'buyer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `items_id` (`items_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `reviewer_id` (`reviewer_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inbox`
--
ALTER TABLE `inbox`
  ADD CONSTRAINT `inbox_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `inbox_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `Items_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `Items_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `Messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `Messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `Messages_ibfk_3` FOREIGN KEY (`items_id`) REFERENCES `items` (`item_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `Reviews_ibfk_1` FOREIGN KEY (`reviewer_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `Reviews_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

