-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2025 at 08:17 PM
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
-- Database: `dbelvis1`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `movie_id` int(255) NOT NULL,
  `nr_tickets` int(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `is_approved` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `movie_id`, `nr_tickets`, `date`, `is_approved`, `time`) VALUES
(3, 2, 1, 2, '2022-12-16', 'true', '19:00');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(255) NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `movie_desc` varchar(255) NOT NULL,
  `movie_quality` varchar(255) NOT NULL,
  `movie_rating` int(255) NOT NULL,
  `movie_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `movie_name`, `movie_desc`, `movie_quality`, `movie_rating`, `movie_image`) VALUES
(1, 'Zgjoi', 'Hoping to provide for their families, struggling widows start a business to sell a local food product. Together, they find healing and solace in the new venture, but their will to live independently is soon met with hostility.', '3D', 10, 'zgjoi.jpg'),
(2, 'Fast and Furious', 'Fast & Furious is a media franchise centered on a series of action films that are largely concerned with illegal street racing, heists, spies and family. The franchise also includes short films, a television series, live shows, video games and theme park ', '2D', 7, 'fastandfurious.jpg'),
(3, 'VENOM', 'Journalist Eddie Brock is trying to take down Carlton Drake, the notorious and brilliant founder of the Life Foundation. While investigating one of Drake\'s experiments, Eddie\'s body merges with the alien Venom -- leaving him with superhuman strength and p', '6D', 7, 'venom.png');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_purchases`
--

CREATE TABLE `ticket_purchases` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_type` varchar(50) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `ticket_type` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_ticket` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_purchases`
--

INSERT INTO `ticket_purchases` (`id`, `user_id`, `event_type`, `event_name`, `ticket_type`, `quantity`, `price_per_ticket`, `total_price`, `purchase_date`) VALUES
(1, 9, 'Football Matches', 'City FC vs United', 'Regular', 2, 40.00, 80.00, '2025-06-10 18:09:17'),
(2, 9, 'Football Matches', 'City FC vs United', 'Premium', 1, 80.00, 80.00, '2025-06-10 18:09:17'),
(3, 9, 'Football Matches', 'City FC vs United', 'Regular', 2, 40.00, 80.00, '2025-06-10 18:09:47'),
(4, 9, 'Football Matches', 'City FC vs United', 'Premium', 1, 80.00, 80.00, '2025-06-10 18:09:47'),
(5, 10, 'Music Festivals', 'Summer Beats Festival', 'General', 2, 60.00, 120.00, '2025-06-10 18:15:14'),
(6, 10, 'Music Festivals', 'Summer Beats Festival', 'VIP', 1, 150.00, 150.00, '2025-06-10 18:15:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `emri` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL,
  `is_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `emri`, `username`, `email`, `password`, `confirm_password`, `is_admin`) VALUES
(1, 'Arlinda', 'arlinda', 'arlindaosmani00@gmail.com', 'arlinda', '$2y$10$0VBVvKNyxIl9OA00/FRmrep7atIIE/SoLXGEoXcjNmF.4ZV6b3NIG', 'true'),
(2, 'iljas', 'iljas', 'iljas@iljas.com', '$2y$10$erk7uFn0RpqhC6g3VX.XcuyU3CVkOanelghahzqjmdtxeFwfEgQQO', '$2y$10$2XuH6X04NLc/jwMhciX8OOccIfFHom7oi6o2PSh82Z8BnINw.nu2O', ''),
(3, 'linda', 'linda', 'linda@linda.com', '$2y$10$pzATPYrl/LDDmFp8DIxalOrvUNT2RL4.I3pFbRjGrsUE8L/xH9O32', '$2y$10$q.HH1oolBta2lTtF/uCIGu2lwLhoHvKoWljOfqV1TAB5ER44EAQUG', 'true'),
(4, 'Elvis', 'elvisemerllahu', 'elvis@gmail.com', '$2y$10$4NYl29s7GooZy2oa9xxWBuio3RnercmtmCsofhu53Y7jTLKMK1edC', '$2y$10$R8sGCwhiejcX7z4Hlr32u.1X8r0YktBy9CeQFKt0.izLHkWkZwSya', ''),
(5, 'Elvis', 'elvisi', 'elvis@gmail.com', '$2y$10$gMS/mKI8yBcrKsaebRm1eOJc5jNEyxbN6iCyo09O.RdXuXhcyA/pW', '$2y$10$jvbq1Hyy4svCXyI6fUpFMO3MuDnaPeIhNghUwjd9Swy1MKs9agOaC', ''),
(6, '', 'elvisemerllahu', 'elvisemerllahu12@gmail.com', '$2y$10$93kT09OtcVpvqkOLnWVnWOk86ze5pmlg0UFWgZdLLgKgn1p3iAFr.', '', ''),
(7, '', 'elvisemerllahu', 'elvisemerllahu12@gmail.com', '$2y$10$pPPvyPv4J4u.B61Zq.lyg.RZmszxhyq1YTFpPSwTg2XNWEhu7AKZO', '', ''),
(8, '', 'elvisemerllahu', 'elvisemerllahu12@gmail.com', '$2y$10$n2GymZxQil5YiYOeHQCMP.D5meMrjkPP1D5R/lh7aqOPTVTZymXOC', '', ''),
(9, '', 'erit', 'govori@gmail', '$2y$10$dc3llkjhPHOAv5uTVBW6O.pKXw3tGj033y.oJ5q5nAHnpJb.BscKS', '', ''),
(10, '', 'donjeta', 'donjeta@gmail.com', '$2y$10$0JoujCEmBN2s2UMe07Rw/.ceA73T3tryLTAXv2Ns1M3ZpPxju93D.', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_purchases`
--
ALTER TABLE `ticket_purchases`
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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket_purchases`
--
ALTER TABLE `ticket_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
