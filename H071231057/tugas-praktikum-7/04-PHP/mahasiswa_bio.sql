-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 09:23 AM
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
-- Database: `mahasiswa_bio`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(7, 'admincoba', '$2y$10$3fjeE56dapHiP1pus.fMA.wIv6FIR6NSoheObHotFQta8HESyFzTW', 'admincoba123@gmail.com', '2024-10-27 13:15:44'),
(8, 'admin', '$2y$10$v2J9rs353Q8xEQfdmRJxe.lBdTMkQVGa/wmS7plhn/xPZ6A6gAUSa', 'hadsdjkadhs@gmail.com', '2024-10-27 13:38:32'),
(9, 'admin_new', '$2y$10$A.vuxiP2CSuNAbBzYzVq7e6CnJo4pgNfEWQgT27fl5LOINhfgXsoa', 'djkdaljsk@gmail.com', '2024-10-28 07:49:50');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `major` varchar(100) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `hobby` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `username`, `password`, `name`, `gender`, `major`, `faculty`, `hobby`, `created_at`) VALUES
(2, 'mahasiswa2', '$2y$10$qx3R8hVX9aeVAR4MbRjeGuuyWzXBlQnRZOjIc2Ivx1bTZk/WUUlO6', 'filoww', 'Male', 'Ilmu ternak lele', 'Perlelean', 'beternak lele', '2024-10-27 13:14:26'),
(4, 'filo123', '$2y$10$ke0dLYf4.pys9Xeoo1g0L.iCNjvh0xdFKYEddRAcoMm4sNhuuOCE2', 'filo sebastian', 'Male', 'Ilmu fakboy', 'Fakultas buaya', 'Flirting', '2024-10-27 15:40:48'),
(5, 'angkasa', '$2y$10$7HaCuYojY0OUnOgtlFxRd.9XAldu63oONvC1k3uXC0qBQIW4Ozjvq', 'angkasa1', 'Female', 'ilmu buaya', 'Faklutas Fakboy', 'ngoding', '2024-10-27 16:04:41'),
(7, 'kejoy', '$2y$10$4XlMOOoVNJXU.gQo49Q5mOQo7kIkZ503G45MY9ZdItRfzY/.AGCZC', 'kejoy', 'Female', 'Psikologi', 'Medical', 'Senyum manis', '2024-10-27 17:43:04'),
(10, 'keylin', '$2y$10$DM3zE2yJ3lhfCyUsW2dMM.Fro2u1OBrIaMbMkpPB0re4Cxfp9mCuG', 'Keylin', 'Female', 'DKV', 'Fakultas seni rupa dan', 'Draw', '2024-10-27 17:58:41'),
(11, 'reynaldy', '$2y$10$bdAq7g76bVFv3cmgxz4OJePs1hNc.vIRUUD.39yLOxra2K5jX9WXC', 'reynaldy', 'Female', 'Sistem Informasi', 'Teknik', 'Spotify-an', '2024-10-28 07:02:00'),
(12, 'qwerty123', '$2y$10$qiTKngYmqwwc.qWUvL5j3Ovz2Nj6uncjVruapwABdFeZO0f4auU46', 'reynal', 'Male', 'informatika', 'teknik', 'lompat tali', '2024-10-28 07:39:49'),
(13, 'keza-edited', '$2y$10$YUIxpm3VXMXPt2fT79xri.OQIrxp.JBAJJxzZq9ipjZoTiCmhcKPq', 'kezaa', 'Female', 'psikologi', 'medicalty', 'nyanyi', '2024-10-28 07:41:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
