-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 22. Jul 2019 um 17:09
-- Server-Version: 10.3.16-MariaDB
-- PHP-Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `perschkeprojekt`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `anmeldung`
--

CREATE TABLE `anmeldung` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_german2_ci NOT NULL,
  `pwd` varchar(200) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `anmeldung`
--

INSERT INTO `anmeldung` (`id`, `name`, `pwd`) VALUES
(1, 'admin', 'e22a63fb76874c99488435f26b117e37');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `titel` varchar(200) COLLATE utf8_german2_ci NOT NULL,
  `beschreibung` varchar(200) COLLATE utf8_german2_ci NOT NULL,
  `prio` int(11) NOT NULL,
  `enddate` varchar(200) COLLATE utf8_german2_ci NOT NULL,
  `status` varchar(200) COLLATE utf8_german2_ci NOT NULL,
  `tasklistid` varchar(200) COLLATE utf8_german2_ci NOT NULL,
  `creator` varchar(200) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `task`
--

INSERT INTO `task` (`id`, `titel`, `beschreibung`, `prio`, `enddate`, `status`, `tasklistid`, `creator`) VALUES
(371, 'Obst', 'Bananen, Apfel, Birnen, Kirschen', 2, 'leer', 'offen', '243', 'admin'),
(372, 'Fleisch', 'Pute, Schwein', 3, 'leer', 'offen', '243', 'admin'),
(373, 'Backwaren', 'Laugenweckle, Brezeln', 4, 'leer', 'verspaeteterledigt', '243', 'admin'),
(374, 'Schuhe', 'Keine Beschreibung vorhanden!', 1, 'leer', 'offen', '243', 'admin'),
(383, 'Spaghetti', 'Keine Beschreibung vorhanden!', 4, '2019-07-21', 'offen', '244', 'admin'),
(384, 'Schnitzel mit Pommes', 'Keine Beschreibung vorhanden!', 1, 'leer', 'offen', '244', 'admin'),
(385, 'Wurstsalat', 'Keine Beschreibung vorhanden!', 1, 'leer', 'offen', '244', 'admin'),
(386, 'Badputzen', 'Keine Beschreibung vorhanden!', 1, 'leer', 'erledigt', '245', 'admin'),
(388, 'Flur', 'Keine Beschreibung vorhanden!', 1, '2019-07-12', 'erledigt', '245', 'admin'),
(389, 'Terrasse wischen', 'Keine Beschreibung vorhanden!', 1, 'leer', 'offen', '245', 'admin');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tasklist`
--

CREATE TABLE `tasklist` (
  `id` int(11) NOT NULL,
  `name` mediumtext COLLATE utf8_german2_ci NOT NULL,
  `creator` mediumtext COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `tasklist`
--

INSERT INTO `tasklist` (`id`, `name`, `creator`) VALUES
(243, 'Einkaufen', 'admin'),
(244, 'Kochen', 'admin'),
(245, 'Putzen', 'admin');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `anmeldung`
--
ALTER TABLE `anmeldung`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indizes für die Tabelle `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tasklist`
--
ALTER TABLE `tasklist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `anmeldung`
--
ALTER TABLE `anmeldung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT für Tabelle `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=392;

--
-- AUTO_INCREMENT für Tabelle `tasklist`
--
ALTER TABLE `tasklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
