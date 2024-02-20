-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Lut 2024, 13:52
-- Wersja serwera: 10.4.13-MariaDB
-- Wersja PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `baza_public`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klasy`
--

CREATE TABLE `klasy` (
  `klasa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `Imie` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Nazwisko` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Pesel` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Telefon` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Adres` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koncentratory`
--

CREATE TABLE `koncentratory` (
  `ID_Koncentratora` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Model` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Kiedy_kupiony` date NOT NULL,
  `Za_ile` int(11) NOT NULL,
  `is_ok` tinyint(1) NOT NULL,
  `O2_PSI` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `klasa` text COLLATE utf8_polish_ci NOT NULL,
  `Aktualny_przebieg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `licznik_od`
--

CREATE TABLE `licznik_od` (
  `ID` int(11) NOT NULL,
  `ID_Koncentratora` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Data_od` date NOT NULL,
  `licznik` int(11) NOT NULL,
  `Uwagi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `serwis`
--

CREATE TABLE `serwis` (
  `id` int(11) NOT NULL,
  `ID_Koncentratora` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Data` date NOT NULL,
  `licznik` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Czego` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Uwagi` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sprzedane`
--

CREATE TABLE `sprzedane` (
  `ID` int(11) NOT NULL,
  `ID_Koncentratora` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Data` date NOT NULL,
  `Za_ile` int(11) NOT NULL,
  `Uwagi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypozyczenie_akt`
--

CREATE TABLE `wypozyczenie_akt` (
  `ID_Koncentratora` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Imie` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Nazwisko` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Data_od` date NOT NULL,
  `Pesel` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Okres_wypo` text COLLATE utf8_polish_ci NOT NULL,
  `Cena` int(11) NOT NULL,
  `Uwagi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypozyczenie_zak`
--

CREATE TABLE `wypozyczenie_zak` (
  `id` int(11) NOT NULL,
  `ID_Koncentratora` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Imie` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Nazwisko` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Data_od` date NOT NULL,
  `Data_do` date NOT NULL,
  `Okres_wypo` text COLLATE utf8_polish_ci NOT NULL,
  `Cena` int(11) NOT NULL,
  `Pesel` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Uwagi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klasy`
--
ALTER TABLE `klasy`
  ADD PRIMARY KEY (`klasa`);

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`Pesel`);

--
-- Indeksy dla tabeli `koncentratory`
--
ALTER TABLE `koncentratory`
  ADD PRIMARY KEY (`ID_Koncentratora`);

--
-- Indeksy dla tabeli `licznik_od`
--
ALTER TABLE `licznik_od`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Koncentratora` (`ID_Koncentratora`);

--
-- Indeksy dla tabeli `serwis`
--
ALTER TABLE `serwis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_Koncentratora` (`ID_Koncentratora`);

--
-- Indeksy dla tabeli `sprzedane`
--
ALTER TABLE `sprzedane`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Koncentratora` (`ID_Koncentratora`);

--
-- Indeksy dla tabeli `wypozyczenie_akt`
--
ALTER TABLE `wypozyczenie_akt`
  ADD PRIMARY KEY (`ID_Koncentratora`),
  ADD KEY `Pesel` (`Pesel`);

--
-- Indeksy dla tabeli `wypozyczenie_zak`
--
ALTER TABLE `wypozyczenie_zak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_Koncentratora` (`ID_Koncentratora`),
  ADD KEY `Pesel` (`Pesel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `licznik_od`
--
ALTER TABLE `licznik_od`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `serwis`
--
ALTER TABLE `serwis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `sprzedane`
--
ALTER TABLE `sprzedane`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `wypozyczenie_zak`
--
ALTER TABLE `wypozyczenie_zak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `licznik_od`
--
ALTER TABLE `licznik_od`
  ADD CONSTRAINT `licznik_od_ibfk_1` FOREIGN KEY (`ID_Koncentratora`) REFERENCES `koncentratory` (`ID_Koncentratora`) ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `serwis`
--
ALTER TABLE `serwis`
  ADD CONSTRAINT `serwis_ibfk_1` FOREIGN KEY (`ID_Koncentratora`) REFERENCES `koncentratory` (`ID_Koncentratora`) ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `sprzedane`
--
ALTER TABLE `sprzedane`
  ADD CONSTRAINT `sprzedane_ibfk_1` FOREIGN KEY (`ID_Koncentratora`) REFERENCES `koncentratory` (`ID_Koncentratora`) ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `wypozyczenie_akt`
--
ALTER TABLE `wypozyczenie_akt`
  ADD CONSTRAINT `wypozyczenie_akt_ibfk_1` FOREIGN KEY (`Pesel`) REFERENCES `klienci` (`Pesel`) ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `wypozyczenie_zak`
--
ALTER TABLE `wypozyczenie_zak`
  ADD CONSTRAINT `wypozyczenie_zak_ibfk_1` FOREIGN KEY (`ID_Koncentratora`) REFERENCES `koncentratory` (`ID_Koncentratora`) ON UPDATE CASCADE,
  ADD CONSTRAINT `wypozyczenie_zak_ibfk_2` FOREIGN KEY (`Pesel`) REFERENCES `klienci` (`Pesel`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
