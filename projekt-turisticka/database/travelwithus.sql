-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2026 at 07:06 PM
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
-- Database: `travelwithus`
--

-- --------------------------------------------------------

--
-- Table structure for table `destinacije`
--

CREATE TABLE `destinacije` (
  `id` int(11) NOT NULL,
  `naziv` varchar(100) NOT NULL,
  `cijena` decimal(10,2) NOT NULL,
  `trajanje` int(11) NOT NULL,
  `popust` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinacije`
--

INSERT INTO `destinacije` (`id`, `naziv`, `cijena`, `trajanje`, `popust`) VALUES
(1, 'Pariz', 1200.00, 5, 10),
(2, 'Rim', 950.00, 4, 5),
(3, 'Istanbul', 1800.00, 7, 15);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `ime` varchar(100) NOT NULL,
  `prezime` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefon` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `ime`, `prezime`, `email`, `telefon`, `password`, `role`) VALUES
(2, 'ivana', 'ivic', 'ivana.ivic@gmail.com', '+385976356232', '$2y$10$GAzf3DWlA8HIu9fqM6K6I.7KtRpsvtTQu4jrWXRGNMwY/ac7Xo0mS', 'user'),
(5, 'tonka', 'palic', 'tonka.palc@gmail.com', '976356214', '$2y$10$9KRWCoqb.R34Hq50r990V.OnPOZPbN50oJ/OBl9imVqpcNosI3iIa', 'user'),
(6, 'ana', 'katinić', 'anamarija.katinicsb@gmail.com', '123445', '$2y$10$W/jv8XXgTLpHbQt6k8PlK.q096pFlcXKyXnNA.YCiVENJJdrehqgW', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `rezervacije`
--

CREATE TABLE `rezervacije` (
  `id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `destinacija_id` int(11) NOT NULL,
  `polazak` date DEFAULT NULL,
  `povratak` date DEFAULT NULL,
  `kolicina` int(11) DEFAULT 1,
  `ukupna_cijena` decimal(10,2) DEFAULT NULL,
  `datum_rezervacije` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rezervacije`
--

INSERT INTO `rezervacije` (`id`, `korisnik_id`, `destinacija_id`, `polazak`, `povratak`, `kolicina`, `ukupna_cijena`, `datum_rezervacije`) VALUES
(4, 2, 1, '2026-06-21', '2026-06-30', 1, 2160.00, '2026-06-20 20:28:13'),
(5, 2, 1, '2026-06-21', '2026-06-27', 1, 1440.00, '2026-06-21 11:57:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `destinacije`
--
ALTER TABLE `destinacije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `rezervacije`
--
ALTER TABLE `rezervacije`
  ADD PRIMARY KEY (`id`),
  ADD KEY `korisnik_id` (`korisnik_id`),
  ADD KEY `destinacija_id` (`destinacija_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `destinacije`
--
ALTER TABLE `destinacije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rezervacije`
--
ALTER TABLE `rezervacije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rezervacije`
--
ALTER TABLE `rezervacije`
  ADD CONSTRAINT `rezervacije_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnici` (`id`),
  ADD CONSTRAINT `rezervacije_ibfk_2` FOREIGN KEY (`destinacija_id`) REFERENCES `destinacije` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
