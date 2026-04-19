-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2026 at 10:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym67_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `created_at`) VALUES
('GYM67-GLOVE-01', 'Lifting Gloves', 'Accessories', 180000.00, 'Real leather lifting gloves with perfect fit and exceptional durability.', 'images/category-accessories.jpg', '2026-04-18 12:13:42'),
('GYM67-KB-100', 'Premium Kettlebell 16kg', 'Equipment', 750000.00, 'Precision-engineered kettlebell with perfect weight balance and superior grip.', 'images/category-equipment.jpg', '2026-04-18 12:13:42'),
('GYM67-KB-200', 'Premium Kettlebell 24kg', 'Equipment', 950000.00, 'Heavy-duty kettlebell for advanced training and strength building.', 'images/category-equipment.jpg', '2026-04-18 12:13:42'),
('GYM67-PRE-001', 'Pre-Workout Ignite', 'Supplements', 380000.00, 'Smooth energy pre-workout with zero crash and enhanced focus.', 'images/category-supplements.jpg', '2026-04-18 12:13:42'),
('GYM67-SHIRT-01', 'Training Tee', 'Apparel', 250000.00, 'Premium athletic training shirt designed for performance and aesthetics.', 'images/category-apparel.jpg', '2026-04-18 12:13:42'),
('GYM67-SHIRT-02', 'Performance Shorts', 'Apparel', 280000.00, 'Lightweight performance shorts designed for maximum range of motion.', 'images/category-apparel.jpg', '2026-04-18 12:13:42'),
('GYM67-WIP-900', 'Whey Isolate Pro', 'Supplements', 450000.00, 'Premium lab-tested whey protein isolate with clean ingredients and exceptional taste.', 'images/category-supplements.jpg', '2026-04-18 12:13:42'),
('GYM67-WRAP-01', 'Wrist Wraps', 'Accessories', 120000.00, 'Professional-grade wrist wraps for maximum stability and support.', 'images/category-accessories.jpg', '2026-04-18 12:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `reviewer_name` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `reviewer_name`, `rating`, `title`, `body`, `created_at`) VALUES
(1, NULL, 'GYM67-WIP-900', 'Adi Pratama', 5, 'Cleanest protein ever', 'The Whey Isolate Pro is hands down the cleanest protein I\'ve ever used. No bloating, incredible taste, and the results speak for themselves.', '2026-04-18 12:13:42'),
(2, NULL, 'GYM67-KB-100', 'Sarah Chen', 5, 'Premium quality kettlebell', 'Gym67\'s kettlebells feel premium in a way no other brand does. The knurling, the weight balance — everything is dialed in perfectly.', '2026-04-18 12:13:42'),
(3, NULL, 'GYM67-SHIRT-01', 'Reza Mahendra', 5, 'Perfect blend of style and function', 'Finally, a fitness brand that understands aesthetics and function aren\'t mutually exclusive. The training tees are my daily uniform now.', '2026-04-18 12:13:42'),
(4, NULL, 'GYM67-PRE-001', 'Maya Indira', 5, 'Best pre-workout I\'ve tried', 'Ordered the Pre-Workout Ignite and was blown away. Smooth energy, no crash, and the focus is unlike anything I\'ve tried before.', '2026-04-18 12:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `created_at`) VALUES
(1, 'William Sebastian Yonatan', 'william.yonathan.stu@elyon.sch.id', '$2y$10$1QoLxDynAZXm3.Z8wqLp2OrstJWW7gfZ6cQu8cxLgG.tcMVLvs4/m', '2026-04-19 08:41:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
