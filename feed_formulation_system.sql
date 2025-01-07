-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 05:02 AM
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
-- Database: `feed_formulation_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `cost_analysis`
--

CREATE TABLE `cost_analysis` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `analysis_details` text NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feed_recipes`
--

CREATE TABLE `feed_recipes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feed_name` varchar(100) NOT NULL,
  `ingredients` text NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feed_recipes`
--

INSERT INTO `feed_recipes` (`id`, `user_id`, `feed_name`, `ingredients`, `cost`, `created_at`) VALUES
(2, 1, 'Broiler Starter Feed', 'Corn: 50%, Soybean Meal: 25%, Wheat Bran: 10%, Fish Meal: 5%, Limestone: 2%, Dicalcium Phosphate: 3%, Salt: 1%, Vitamins and Minerals: 4%', 5000.00, '2025-01-07 03:19:27'),
(3, 1, 'Layer Mash', 'Corn: 60%, Soybean Meal: 18%, Wheat Bran: 5%, Oyster Shells: 10%, Salt: 2%, Vitamins and Minerals: 5%', 4800.00, '2025-01-07 03:19:27'),
(4, 1, 'Broiler Grower Feed', 'Corn: 55%, Soybean Meal: 30%, Wheat Bran: 8%, Fish Meal: 5%, Limestone: 2%, Dicalcium Phosphate: 3%, Salt: 1%, Vitamins and Minerals: 3%', 5200.00, '2025-01-07 03:19:27'),
(5, 1, 'Layer Pellet Feed', 'Corn: 58%, Soybean Meal: 20%, Wheat Bran: 12%, Oyster Shells: 6%, Limestone: 2%, Vitamins and Minerals: 2%, Salt: 2%', 5500.00, '2025-01-07 03:19:27'),
(6, 1, 'Broiler Finisher Feed', 'Corn: 60%, Soybean Meal: 25%, Wheat Bran: 5%, Fish Meal: 3%, Limestone: 2%, Dicalcium Phosphate: 3%, Salt: 1%, Vitamins and Minerals: 4%', 5400.00, '2025-01-07 03:19:27'),
(7, 1, 'Starter Crumbles', 'Corn: 55%, Soybean Meal: 30%, Wheat Bran: 5%, Dicalcium Phosphate: 3%, Limestone: 2%, Salt: 1%, Vitamins and Minerals: 4%', 4900.00, '2025-01-07 03:19:27'),
(8, 1, 'Duck Feed', 'Corn: 45%, Soybean Meal: 35%, Wheat Bran: 8%, Fish Meal: 5%, Salt: 2%, Vitamins and Minerals: 5%', 5100.00, '2025-01-07 03:19:28'),
(9, 1, 'Turkey Starter Feed', 'Corn: 60%, Soybean Meal: 25%, Wheat Bran: 5%, Fish Meal: 4%, Limestone: 2%, Salt: 1%, Vitamins and Minerals: 3%', 5300.00, '2025-01-07 03:19:28'),
(10, 1, 'Pullet Grower Feed', 'Corn: 50%, Soybean Meal: 28%, Wheat Bran: 10%, Oyster Shells: 5%, Vitamins and Minerals: 5%, Salt: 2%', 4700.00, '2025-01-07 03:19:28'),
(11, 1, 'Breeder Feed (for Hens)', 'Corn: 55%, Soybean Meal: 25%, Wheat Bran: 10%, Fish Meal: 5%, Limestone: 2%, Dicalcium Phosphate: 2%, Salt: 1%, Vitamins and Minerals: 5%', 5600.00, '2025-01-07 03:19:28'),
(12, 1, 'Cockerel Starter Feed', 'Corn: 58%, Soybean Meal: 30%, Wheat Bran: 6%, Fish Meal: 4%, Limestone: 1%, Salt: 1%, Vitamins and Minerals: 2%', 5000.00, '2025-01-07 03:19:28'),
(13, 1, 'Quail Starter Feed', 'Corn: 50%, Soybean Meal: 25%, Wheat Bran: 15%, Fish Meal: 5%, Salt: 2%, Vitamins and Minerals: 3%', 4800.00, '2025-01-07 03:19:28'),
(14, 1, 'Gamebird Feed', 'Corn: 50%, Soybean Meal: 25%, Wheat Bran: 12%, Fish Meal: 8%, Salt: 2%, Vitamins and Minerals: 3%', 5200.00, '2025-01-07 03:19:28'),
(15, 1, 'Broiler Supplementary Feed', 'Corn: 70%, Soybean Meal: 10%, Wheat Bran: 5%, Fish Meal: 5%, Limestone: 3%, Dicalcium Phosphate: 2%, Salt: 1%, Vitamins and Minerals: 4%', 5500.00, '2025-01-07 03:19:28'),
(16, 1, 'Layer Supplementary Feed', 'Corn: 60%, Soybean Meal: 18%, Wheat Bran: 15%, Oyster Shells: 4%, Limestone: 2%, Vitamins and Minerals: 1%', 4800.00, '2025-01-07 03:19:28'),
(17, 1, 'Poultry Grower Feed', 'Corn: 55%, Soybean Meal: 30%, Wheat Bran: 5%, Fish Meal: 5%, Limestone: 2%, Salt: 1%, Vitamins and Minerals: 2%', 5300.00, '2025-01-07 03:19:28'),
(18, 1, 'Layer Mash (Organic)', 'Corn: 50%, Soybean Meal: 20%, Wheat Bran: 15%, Oyster Shells: 8%, Salt: 2%, Vitamins and Minerals: 5%', 5100.00, '2025-01-07 03:19:28'),
(19, 1, 'Breeder Supplementary Feed', 'Corn: 60%, Soybean Meal: 25%, Wheat Bran: 10%, Fish Meal: 2%, Limestone: 2%, Dicalcium Phosphate: 1%, Salt: 1%', 5500.00, '2025-01-07 03:19:28'),
(20, 1, 'Chick Starter Crumbles', 'Corn: 60%, Soybean Meal: 25%, Wheat Bran: 5%, Fish Meal: 5%, Dicalcium Phosphate: 3%, Salt: 1%, Vitamins and Minerals: 4%', 5000.00, '2025-01-07 03:19:28'),
(21, 1, 'Duck Grower Feed', 'Corn: 50%, Soybean Meal: 25%, Wheat Bran: 15%, Fish Meal: 5%, Salt: 2%, Vitamins and Minerals: 3%', 4900.00, '2025-01-07 03:19:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Basheer Haadi Ajala', 'bashirhaadiy@gmail.com', '$2y$10$qeK14s6gIB20bDFbnGfkbev4.kykMOJvcnf.uZgD/w17WOTup175y', '2025-01-07 02:24:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cost_analysis`
--
ALTER TABLE `cost_analysis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `feed_recipes`
--
ALTER TABLE `feed_recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `cost_analysis`
--
ALTER TABLE `cost_analysis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feed_recipes`
--
ALTER TABLE `feed_recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cost_analysis`
--
ALTER TABLE `cost_analysis`
  ADD CONSTRAINT `cost_analysis_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `feed_recipes`
--
ALTER TABLE `feed_recipes`
  ADD CONSTRAINT `feed_recipes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
