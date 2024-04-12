-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 12. dub 2024, 08:05
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `web_skola`
--
CREATE DATABASE IF NOT EXISTS web_skola;
-- --------------------------------------------------------

--
-- Struktura tabulky `clanky`
--
USE web_skola;

CREATE TABLE `clanky` (
  `id` int(11) NOT NULL,
  `kategorie` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sub_name` varchar(255) DEFAULT NULL,
  `cas_konani` datetime DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `img_file_name` varchar(255) NOT NULL,
  `slag` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `clanky`
--

INSERT INTO `clanky` (`id`, `kategorie`, `name`, `sub_name`, `cas_konani`, `text`, `img_file_name`, `slag`, `active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 'Den otevřených dveří', 'toto je ohledně dnu otevřených dveří', '2024-02-23 09:23:25', 'tento je text ohledně dnu otevřených dveří', '', '', 1, 1, '2024-02-05 09:24:41', 2, '2024-02-05 10:24:16'),
(2, 1, 'Den otevřených dveří', 'toto je ohledně dnu otevřených dveří', '2024-02-23 09:23:25', 'tento je text ohledně dnu otevřených dveří', '', '', 1, 1, '2024-02-05 09:24:41', 1, '2024-02-05 09:24:41'),
(3, 1, 'Tadeas', 'test', '2024-04-23 08:23:12', 'tady bude text', '', '', 1, 1, '2024-02-05 10:01:50', 1, '2024-02-05 10:01:50'),
(4, 1, 'Tadeas', 'test', '2024-04-23 08:23:12', 'tady bude text', '', '', 1, 2, '2024-02-05 10:09:59', 2, '2024-02-05 10:09:59'),
(5, 1, 'Filip', 'Aloha', '2024-02-23 09:23:25', 'dawdw', 'dawdawd', 'neexistuje', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `dostupnost`
--

CREATE TABLE `dostupnost` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `dostupnost`
--

INSERT INTO `dostupnost` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Ředitel'),
(3, 'Edit');

-- --------------------------------------------------------

--
-- Struktura tabulky `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `images`
--

INSERT INTO `images` (`id`, `file_name`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Škola', 1, '2024-02-05 09:23:21', 2, '2024-02-05 10:24:27'),
(2, 'Škola', 1, '2024-02-05 09:23:21', 1, '2024-02-05 09:23:21'),
(3, 'test', 1, '2024-02-05 10:02:13', 1, '2024-02-05 10:02:13'),
(4, 'test', 2, '2024-02-05 10:10:41', 2, '2024-02-05 10:10:41');

-- --------------------------------------------------------

--
-- Struktura tabulky `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sub_kategori_to` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `kategorie`
--

INSERT INTO `kategorie` (`id`, `name`, `sub_kategori_to`, `active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Activity', 'main', 1, 1, '2024-02-05 09:21:09', 1, '2024-02-05 10:23:09'),
(2, 'Bakalář', 'main', 1, 1, '2024-02-05 09:21:09', 1, '2024-02-05 09:21:09'),
(3, 'Tadeas', 'text', 1, 1, '2024-02-05 10:08:03', 1, '2024-02-05 10:08:03'),
(4, 'Filip', 'main', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `link_name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `links`
--

INSERT INTO `links` (`id`, `link_name`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Škola', 1, '2024-02-05 09:23:03', 2, '2024-02-05 10:24:07'),
(2, 'Škola', 1, '2024-02-05 09:23:03', 1, '2024-02-05 09:23:03'),
(3, 'text', 1, '2024-02-05 10:02:47', 1, '2024-02-05 10:02:47'),
(4, 'text', 2, '2024-02-05 10:10:34', 2, '2024-02-05 10:10:34');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

CREATE TABLE `uzivatele` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sur_name` varchar(255) DEFAULT NULL,
  `dostupnost` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `uzivatele`
--

INSERT INTO `uzivatele` (`id`, `username`, `password`, `name`, `sur_name`, `dostupnost`, `active`, `token`) VALUES
(1, 'Tadeas', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Tadeáš', 'Jahoda', 1, 1, '2977fcc5c52847faf021dc860005421b89f72fa8'),
(2, 'Filip', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Lojka', 'Lojka', 3, 1, 'e31ee28fba393a2792448269b3fb0784a7a1068f'),
(3, 'Tadeas', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Tadeas', 'Lojka', 3, 1, NULL),
(10, 'Filip', '123', 'Filip', 'Lojka', 1, 1, NULL),
(11, 'Filip', '123', 'Filip', 'Lojka', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `workers`
--

CREATE TABLE `workers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sur_name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `workers`
--

INSERT INTO `workers` (`id`, `name`, `sur_name`, `title`, `job`, `phone_number`, `email`, `active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Tadeas', 'Jahoda', 'Maker', 'Back-end', '725 461 181', 'tadeas.jahoda@sos-jh.cz', 1, 1, '2024-02-05 09:27:03', 1, '2024-02-05 10:17:17'),
(2, 'Samuel Daniel', 'Herejk', 'Maker', 'Front-end', '234 234 234', 'daniel.herejk@sos-jh.cz', 1, 1, '2024-02-05 09:27:03', 1, '2024-02-05 09:27:03'),
(3, 'Tadeas', 'Lojka', 'Friend', 'Manga-maker', '234 131 232', 'filip.lojka@sos-jh.cz', 1, 1, '2024-02-05 09:59:29', 1, '2024-02-05 09:59:29'),
(4, 'Tadeas', 'Jahoda', 'Bc.', 'back-end', '123', 'jahoda@jahoda', 1, NULL, NULL, NULL, NULL),
(5, 'Tadeas', 'Jahoda', 'Bc.', 'back-end', '123', 'jahoda@jahoda', 1, NULL, NULL, NULL, NULL),
(6, 'Tadeas', 'Jahoda', 'Bc.', 'back-end', '123', 'jahoda@jahoda', 1, NULL, NULL, NULL, NULL),
(7, 'Tadeas', 'Jahoda', 'Bc.', 'back-end', '123', 'jahoda@jahoda', 1, NULL, NULL, NULL, NULL),
(8, 'Filip', 'Jahoda', 'Mgr.', 'back-end', '123', 'jahoda@seznam.cz', 1, NULL, NULL, NULL, NULL),
(9, 'Filip', 'Jahoda', 'Mgr.', 'back-end', '123', 'jahoda@seznam.cz', 1, NULL, NULL, NULL, NULL);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `clanky`
--
ALTER TABLE `clanky`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `kategorie` (`kategorie`);

--
-- Indexy pro tabulku `dostupnost`
--
ALTER TABLE `dostupnost`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexy pro tabulku `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexy pro tabulku `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexy pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dostupnost` (`dostupnost`);

--
-- Indexy pro tabulku `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `clanky`
--
ALTER TABLE `clanky`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `dostupnost`
--
ALTER TABLE `dostupnost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pro tabulku `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pro tabulku `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `clanky`
--
ALTER TABLE `clanky`
  ADD CONSTRAINT `clanky_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `uzivatele` (`id`),
  ADD CONSTRAINT `clanky_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `uzivatele` (`id`),
  ADD CONSTRAINT `clanky_ibfk_3` FOREIGN KEY (`kategorie`) REFERENCES `kategorie` (`id`);

--
-- Omezení pro tabulku `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `uzivatele` (`id`),
  ADD CONSTRAINT `images_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `uzivatele` (`id`);

--
-- Omezení pro tabulku `kategorie`
--
ALTER TABLE `kategorie`
  ADD CONSTRAINT `kategorie_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `uzivatele` (`id`),
  ADD CONSTRAINT `kategorie_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `uzivatele` (`id`);

--
-- Omezení pro tabulku `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `links_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `uzivatele` (`id`),
  ADD CONSTRAINT `links_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `uzivatele` (`id`);

--
-- Omezení pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD CONSTRAINT `uzivatele_ibfk_1` FOREIGN KEY (`dostupnost`) REFERENCES `dostupnost` (`id`);

--
-- Omezení pro tabulku `workers`
--
ALTER TABLE `workers`
  ADD CONSTRAINT `workers_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `uzivatele` (`id`),
  ADD CONSTRAINT `workers_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `uzivatele` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
