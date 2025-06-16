-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Po 16.Jún 2025, 14:54
-- Verzia serveru: 10.4.32-MariaDB
-- Verzia PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `cyborg`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `hráči`
--

CREATE TABLE `hráči` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `hráči`
--

INSERT INTO `hráči` (`id`, `first_name`, `last_name`, `Email`, `password`) VALUES
(1, '', '', '', ''),
(2, 'Ármin', 'Rukovánsky', 'alma@gmail.com', ''),
(3, 'jani', 'Rukovánsky', 'ala@gmail.com', ''),
(4, 'Monika', 'Rukovansky', 'rukoarmin@gmail.com', ''),
(5, 'Jancsi', 'Alma', 'eghrgh@fdf.com', '$2y$10$Y5rkWjppWRW8./5ncmP9eeh4T7QEqhk0cFLViRU7I5fYAquhLTp3K'),
(6, 'luki', 'velky', 'abhzs@gs.com', '$2y$10$SNu0xTzSkouNrAmI7RgqjeX/LgKiqGirshDdd8Ly13iZ7ij.5PYNq');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `hráči`
--
ALTER TABLE `hráči`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `hráči`
--
ALTER TABLE `hráči`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
