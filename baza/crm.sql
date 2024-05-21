-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 01:29 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `klijenti`
--

CREATE TABLE `klijenti` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klijenti`
--

INSERT INTO `klijenti` (`id`, `name`, `email`, `phone`, `company_id`, `created_at`) VALUES
(1, 'Pera', 'pera@gmail.com', ' 3816153481', 7, '2024-05-17 18:10:35'),
(4, 'klijent', 'kk@gmail.com', '21324', 1, '2024-05-20 01:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `kompanije`
--

CREATE TABLE `kompanije` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `tax_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kompanije`
--

INSERT INTO `kompanije` (`id`, `name`, `email`, `logo`, `address`, `tax_id`, `created_at`) VALUES
(1, 'test', 'test@gmail.com', '', '123', '123876', '2024-05-17 15:14:44'),
(7, 'Firmetina', 'f@gmail.com', 'member_photos/firmetina.jpg', 'ficfiric', '123876', '2024-05-17 16:20:18'),
(10, 'IT', 'it@gmail.com', 'member_photos/it_centar.jpg', 'Cara Dušana 90/3, 18000 Niš', '104471950', '2024-05-20 01:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `is_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `name`, `email`, `username`, `password`, `created_at`, `is_admin`) VALUES
(5, 'Perica', 'p@gmail.com', 'Peki', '$2y$10$EP45Oiu1ugRr9PbKVfbhZOSHdmmbZlWbPrE77tTfwp3K2EwvKupOy', '2024-05-15', 1),
(6, 'test', 'test@gmail.com', 'test', '$2y$10$l83GuVBo.TS6ocW7X7aZ/ONQ2rrejl6Cq2IHlIfCSolqNSNdrSIrW', '2024-05-15', 1),
(17, 'Milos', 'mimi@gmail.com', 'Milos77', '$2y$10$kZQONWXoX9IWVNgljpVTIuvOOzxyRc2pWgynB9ZVAPPyzN9Hd51ui', '2024-05-18', 2),
(28, 'Ivana', 'i@gmail.com', 'ivca', '$2y$10$.r6vNKnmI5f7/7wAWQ8iEuWtgVmQq523DjlT1xrploNR6e/5YLXsK', '2024-05-21', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `klijenti`
--
ALTER TABLE `klijenti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kompanije`
--
ALTER TABLE `kompanije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klijenti`
--
ALTER TABLE `klijenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kompanije`
--
ALTER TABLE `kompanije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
