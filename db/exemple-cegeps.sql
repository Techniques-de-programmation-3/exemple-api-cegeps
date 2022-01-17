-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 17, 2022 at 04:11 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exemple-cegeps`
--

-- --------------------------------------------------------

--
-- Table structure for table `cegeps`
--

CREATE TABLE `cegeps` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `noCivique` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rue` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ville` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `code_postal` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `longitude` decimal(12,10) NOT NULL,
  `lattitude` decimal(12,10) NOT NULL,
  `liste_programmes` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cegeps`
--

INSERT INTO `cegeps` (`id`, `nom`, `noCivique`, `rue`, `ville`, `code_postal`, `longitude`, `lattitude`, `liste_programmes`) VALUES
(1, 'Cégep de Trois-Rivières', '3175', 'Boulevard Laviolette', 'Trois-Rivières', 'G8Z 1E9', '-72.5696601000', '46.3587765000', 'Développement Web (Front-end);Techniques de l\'informatique'),
(2, 'Cégep de Victoriaville', '475', 'Rue Notre Dame E', 'Victoriaville', 'G6P 4B3', '-71.9458311000', '46.0596359000', 'AEC Robotique et vision artificielle\'; Techniques de l\'informatique;...'),
(5, 'Cégep de Thetford', '671', 'Bd Frontenac O', 'Thetford Mines', 'G6G 1N1', '-71.3252487000', '46.0984790000', ' Techniques de l\'informatique;...');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cegeps`
--
ALTER TABLE `cegeps`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cegeps`
--
ALTER TABLE `cegeps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
