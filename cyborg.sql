-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Št 19.Jún 2025, 08:31
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
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `hráči`
--

INSERT INTO `hráči` (`id`, `first_name`, `last_name`, `Email`, `password`, `role`) VALUES
(16, 'alma', 'jancsi', 'asd@asd.com', '$2y$10$H997HNudPOL4Aunp01KO2.gol6TIEbnynUnHMjnBkUWFE.dUn5bje', 'admin'),
(18, 'luki', 'nagy', 'em@em.com', '$2y$10$JCAQuchCj7ZQ5xyNLAaoWe152GDLIvS5Zme/Hf0wNrn9im/lXwAQ2', 'user'),
(20, 'zoltan', 'Miklos', 'zoli@zoli.com', '$2y$10$Ca02Qu0LWFBRu7lmqoElSe4fB8EgUdF3XpU9JwH4tEelyaq3zTsva', 'admin');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
