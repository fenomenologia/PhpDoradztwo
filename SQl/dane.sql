-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 04, 2025 at 05:22 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kwestionariusz`
--

--
-- Dumping data for table `doradca`
--

INSERT INTO `doradca` (`id`, `email`, `haslo`, `czy_aktywny`, `data_utworzenia`, `czy_admin`, `nazwisko`, `imie`) VALUES
(1, 'jakubsiedlarz@gmail.com', '$2a$12$oBqVhCxYEbA22Leyn/boVujUlZCHVxsbNayi4RJ91WvD.VtiN4OXe', 1, '2025-03-11', 1, NULL, NULL),
(2, 'danielstepien@gmail.com', '$2a$12$oBqVhCxYEbA22Leyn/boVujUlZCHVxsbNayi4RJ91WvD.VtiN4OXe', 1, '2025-03-11', 0, NULL, NULL),
(3, 'lukaszgrygiel@gmail.com', '$2a$12$oBqVhCxYEbA22Leyn/boVujUlZCHVxsbNayi4RJ91WvD.VtiN4OXe', 1, '2025-03-11', 0, NULL, NULL),
(4, 'alicjaszczygiel@gmail.com', '$2a$12$oBqVhCxYEbA22Leyn/boVujUlZCHVxsbNayi4RJ91WvD.VtiN4OXe', 1, '2025-03-11', 0, NULL, NULL),
(5, 'czeslawsarota@gmail.com', '$2a$12$oBqVhCxYEbA22Leyn/boVujUlZCHVxsbNayi4RJ91WvD.VtiN4OXe', 1, '2025-03-11', 0, NULL, NULL);

--
-- Dumping data for table `doradztwo`
--

INSERT INTO `doradztwo` (`id`, `id_klienta`, `id_doradcy`, `data`, `id_status`, `rodzaj_doradztwa`) VALUES
(40, 36, 1, NULL, 1, NULL),
(41, 37, 1, NULL, 1, NULL),
(42, 38, 1, NULL, 1, NULL),
(43, 39, 2, NULL, 1, NULL),
(44, 40, 2, NULL, 1, NULL),
(45, 41, 2, NULL, 1, NULL);

--
-- Dumping data for table `klient`
--

INSERT INTO `klient` (`id`, `email`, `haslo`, `status`, `data_utworzenia`, `imie`, `nazwisko`) VALUES
(36, 'jankowalski@o2.pl', '$2a$12$cWUtHGWDLXLWoo2ZWDZOo.MZg3Tv5oTcI2WDUX1RYEAYx6QMTHk1G', 1, '2025-05-04', 'Jan', 'Kowalski'),
(37, 'michalowski@gmail.com', '$2a$12$cWUtHGWDLXLWoo2ZWDZOo.MZg3Tv5oTcI2WDUX1RYEAYx6QMTHk1G', 1, '2025-05-04', 'Micha³', 'Micha³owski'),
(38, 'maciekkowalski@o2.pl', '$2a$12$cWUtHGWDLXLWoo2ZWDZOo.MZg3Tv5oTcI2WDUX1RYEAYx6QMTHk1G', 1, '2025-05-04', 'Maciej', 'Kowalski'),
(39, 'marekkowalski@o2.pl', '$2a$12$cWUtHGWDLXLWoo2ZWDZOo.MZg3Tv5oTcI2WDUX1RYEAYx6QMTHk1G', 1, '2025-05-04', 'Marek', 'Kowalski'),
(40, 'nowakjan@gmail.com', '$2a$12$cWUtHGWDLXLWoo2ZWDZOo.MZg3Tv5oTcI2WDUX1RYEAYx6QMTHk1G', 1, '2025-05-04', 'Jan', 'Nowak'),
(41, 'mateuszwisniewski@gmail.con', '$2a$12$cWUtHGWDLXLWoo2ZWDZOo.MZg3Tv5oTcI2WDUX1RYEAYx6QMTHk1G', 1, '2025-05-04', 'Mateusz', 'Wiœniewski');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
