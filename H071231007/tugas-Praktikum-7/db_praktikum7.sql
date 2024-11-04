-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2024 at 08:52 AM
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
-- Database: `db_praktikum7`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `prodi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `name`, `nim`, `prodi`) VALUES
(1, 'Ananta', '007', 'SIsfo'),
(3, 'Aipun', '0000001', 'Ballon D\'Or'),
(6, 'Pakcik', '1008', 'Studi Luar Angkasa');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','mahasiswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$HcNmlX4OFQQFNSDpnjL45.09xSH6dI1DeXe6m7ecDGqrFG4pEU8fa', 'admin'),
(2, 'havyasi', '$2y$10$HP1rDqIHdW0zFyUk/8RHe..vm87BrtpHyFIoUve0WMAnxiXR9vbxy', 'mahasiswa'),
(3, 'gisda', '$2y$10$ZykEB2GXgOpRBk3EJpZLReWvEB4QSoCpQl12APXyOVWVCdYeQCUVi', 'mahasiswa'),
(4, 'pichin', '$2y$10$XkxyZraSTfVebcemMdumSOF7MOxI3I3Xg.JvUJuVp1j/Hr7gbO6Zq', 'mahasiswa'),
(5, 'Waskita', '$2y$10$R6oYXh/gfJ9.Vf1K4Buy6OmIwaXbak9ZOsmernDHp7YS0iUwvvvWa', 'mahasiswa'),
(6, 'Pakcik', '$2y$10$637jpYK/hdsz7nMw3dNeg.bGLEzQWg.tL7VfuPL6B22SGvl6xljpi', 'mahasiswa'),
(7, 'nanda', '$2y$10$BZxz7yUHVAWGCMVd72FEde/gBxUDgHo2J2JU3.XVOpE9KDHDKJpQq', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
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
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
