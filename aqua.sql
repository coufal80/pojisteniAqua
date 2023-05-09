-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 09. kvě 2023, 11:11
-- Verze serveru: 10.4.24-MariaDB
-- Verze PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `aqua`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `sluzby`
--

CREATE TABLE `sluzby` (
  `sluzba_id` int(11) NOT NULL,
  `titulek` varchar(225) COLLATE utf8mb4_czech_ci NOT NULL,
  `obsah` text COLLATE utf8mb4_czech_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL,
  `popisek` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL,
  `klicova_slova` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `sluzby`
--

INSERT INTO `sluzby` (`sluzba_id`, `titulek`, `obsah`, `url`, `popisek`, `klicova_slova`) VALUES
(1, 'Úvod', '<p>Vítejte na stránkách pojišťovny AQUA</p>\r\n<p>Naše pojišťovna se specializuje na utopení, vytopení, netopení, potopení a jiné utrpení</p>', 'uvod', 'Úvodní popisek na webu pojišťovny AQUA', 'úvod, web, aqua'),
(2, 'Pojištění proti utonutí', '<p>Tato služba se uzavírá s výš uvedným.......</p>', 'pojisteni-utonuti', 'Živelné pojištění', 'pojištění, utonutí, voda'),
(3, 'Pojištění proti vytopení', '<p>Tato služba se zaměřuje na.....</p>', 'pojisteni-vytopeni', 'Živelné pojištění', 'pojištění, vytopení, voda'),
(5, 'Pojištění proti přetopení', '<p>Přetápíte? Pojistěte si nízké ceny .....</p>', 'pojisteni-pretopeni', 'Živelné pojištění', 'pojištění, přetopení, voda'),
(6, 'Pojištění proti utrpení', '<p>Netrpte, budeme trpět za Vás...</p>', 'pojisteni-utrpeni', 'Bolestivé pojištění', 'pojištění, bolest'),
(7, 'Pojištění proti vysušení', '<p>Dovolujeme si vám představit nejnovější službu proti vysušení....</p>', 'pojisteni-vysuseni', 'Živelné pojištění', 'Vysušení');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

CREATE TABLE `uzivatele` (
  `uzivatele_id` int(11) NOT NULL,
  `jmeno` varchar(30) COLLATE utf8mb4_czech_ci NOT NULL,
  `prijmeni` varchar(30) COLLATE utf8mb4_czech_ci NOT NULL,
  `rodne_cislo` varchar(10) COLLATE utf8mb4_czech_ci NOT NULL,
  `telefon` varchar(15) COLLATE utf8mb4_czech_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_czech_ci NOT NULL,
  `adresa` varchar(30) COLLATE utf8mb4_czech_ci NOT NULL,
  `mesto` varchar(30) COLLATE utf8mb4_czech_ci NOT NULL,
  `kod_sluby` varchar(20) COLLATE utf8mb4_czech_ci NOT NULL,
  `jmeno_sluby` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL,
  `url` varchar(250) COLLATE utf8mb4_czech_ci NOT NULL,
  `heslo` varchar(100) COLLATE utf8mb4_czech_ci NOT NULL,
  `sluzba` varchar(250) COLLATE utf8mb4_czech_ci NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `uzivatele`
--

INSERT INTO `uzivatele` (`uzivatele_id`, `jmeno`, `prijmeni`, `rodne_cislo`, `telefon`, `email`, `adresa`, `mesto`, `kod_sluby`, `jmeno_sluby`, `url`, `heslo`, `sluzba`, `admin`) VALUES
(29, 'Lukáš', 'coufal', '89898798', '552548995', 'email@email.cz', 'adresa', 'mesto', '523', 'Sluzba proti utopení', 'lukas-coufal', '$2y$10$r.AKmgBJ.KDQziU6G.gI2OTaazwGl9Hinjs5i3eZqJoAF2gJ.s9jm', 'celý výpis služby', 1),
(30, 'max', 'maximus', '7852654', '777555333', 'nemam', 'nebydli', '', '', '', '', '$2y$10$xWrudcolNWZLoxFw/ojWZu3l/mHZxOCLkWd2C/7oGFL6sIQB4fiie', '', 0),
(32, 'Čtvrťák', 'Čtvrtý', '78965412', '888666999', 'nemám', 'Bydlím 89', 'Vedle', '', '', '', '$2y$10$LcMVLswCJwzesVvXskhDleGWpB5MparcJcc3.OAqj7qCHgieR9JSW', '', 0),
(33, 'Pátek', 'Patovson', '0000001236', '+420999666888', 'admi@admin.cz', 'Nabydlov 6', 'Nikde', '', '', '', '$2y$10$RFWso0gH2haOolH4Ro7ILuqjD4y0g8RJrsT.M/HTkW7XiE.9wcjUW', '', 0),
(34, 'admin', '', '', '', '', '', '', '', '', '', '$2y$10$pSQq.UW5mUr0FKtJiJl9xuM90TbJL5XjnmK3e4Qj6TkbQyEcE8eqq', '', 1),
(36, 'středa', 'středa', 'středa', 'středa', 'středa', 'středa', 'středa', '', '', '', '$2y$10$oSNU3zTv1JtRoI50AQ04demWaS8WrgaND7vG9XIWksZXblEIeEoRq', '', 0);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `sluzby`
--
ALTER TABLE `sluzby`
  ADD PRIMARY KEY (`sluzba_id`);

--
-- Indexy pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`uzivatele_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `sluzby`
--
ALTER TABLE `sluzby`
  MODIFY `sluzba_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `uzivatele_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
