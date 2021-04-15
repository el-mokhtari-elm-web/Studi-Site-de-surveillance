-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 15, 2021 at 04:15 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_elmmonitor`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `id` int(11) NOT NULL,
  `last_name` varchar(33) NOT NULL,
  `first_name` varchar(33) NOT NULL,
  `email_admin` varchar(33) NOT NULL,
  `pass_admin` varchar(33) NOT NULL,
  `level_right` varchar(33) NOT NULL,
  `date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `last_name`, `first_name`, `email_admin`, `pass_admin`, `level_right`, `date_creation`) VALUES
(1, 'youssef', 'el mokhtari', 'josyassin@gmail.com', 'c11fa46c4291e28af68fba6c407f2430', 'high', '2021-03-22');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(33) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `code_id` int(33) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `specialitys` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `last_name`, `first_name`, `code_id`, `nationality`, `date_of_birth`, `specialitys`) VALUES
(121, 'el mokhtari', 'youssef', 59, 'Française', '1977-02-05', 3),
(122, 'el bokhtari', 'baghdad', 1159, 'Allemande', '1986-10-22', 3),
(123, 'gesippe', 'terenzio', 2, 'Française', '2013-02-06', 2),
(124, 'abraha', 'takhdir', 522, 'Française', '1985-09-16', 2),
(125, 'mahfoud', 'kidiri', 182222, 'Française', '2011-10-12', 2),
(126, 'zafir', 'mbarek', 223333, 'Française', '2007-08-18', 2),
(127, 'tomy', 'likes', 225959, 'Française', '1998-01-28', 2),
(128, 'el makhri', 'didine', 2269, 'Française', '2011-11-17', 2),
(129, 'luc', 'derfont', 223355, 'Espagnole', '2009-06-15', 2),
(130, 'quevrain', 'mickael', 3399, 'Française', '2005-10-13', 2);

-- --------------------------------------------------------

--
-- Table structure for table `agents_active`
--

CREATE TABLE `agents_active` (
  `id` int(11) NOT NULL,
  `speciality_type` varchar(255) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `mission_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agents_active`
--

INSERT INTO `agents_active` (`id`, `speciality_type`, `agent_id`, `mission_id`) VALUES
(182, 'infiltration', 121, 609),
(183, 'espionnage', 121, NULL),
(184, 'espionnage', 122, NULL),
(185, 'filature', 122, 634),
(186, 'surveillance', 121, NULL),
(187, 'infiltration', 123, 610),
(188, 'espionnage', 123, NULL),
(189, 'infiltration', 122, 618),
(190, 'infiltration', 124, 630),
(191, 'enquete', 124, NULL),
(192, 'infiltration', 125, 631),
(193, 'surveillance', 125, NULL),
(194, 'infiltration', 126, 631),
(195, 'surveillance', 126, NULL),
(196, 'infiltration', 127, NULL),
(197, 'surveillance', 127, NULL),
(198, 'filature', 128, NULL),
(199, 'enquete', 128, NULL),
(200, 'espionnage', 129, NULL),
(201, 'surveillance', 129, NULL),
(202, 'filature', 130, NULL),
(203, 'enquete', 130, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cibles`
--

CREATE TABLE `cibles` (
  `id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `code_name` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `mission_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cibles`
--

INSERT INTO `cibles` (`id`, `last_name`, `first_name`, `code_name`, `nationality`, `date_of_birth`, `mission_id`) VALUES
(8, 'darkama', 'dokra', '5959', 'Japonaise', '1989-07-12', 609),
(9, 'carl', 'didine', 'ZAZARA', 'Américaine', '1976-10-14', 610),
(10, 'el kazar', 'idra', '222200', 'Chinoise', '2002-10-02', 618),
(11, 'anthon', 'fisher', 'EERR57', 'Chinoise', '1999-06-25', 630),
(12, 'romain', 'leglaive', 'HY76554', 'Française', '2004-07-16', 634),
(13, 'mike', 'amiral', 'ffgTRE45', 'Française', '2004-11-13', NULL),
(14, 'yousfi', 'el karach', 'RF5656', 'Japonaise', '2007-10-04', 631),
(15, 'darma', 'lucien', '33UH65', 'Chinoise', '2021-04-22', NULL),
(16, 'alouan', 'ali', 'FFGT54', 'Allemande', '2007-07-05', NULL),
(17, 'zerfi', 'aliou', 'GT56', 'Suisse', '2000-10-11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `code_name` varchar(255) NOT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `mission_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `last_name`, `first_name`, `code_name`, `nationality`, `date_of_birth`, `mission_id`) VALUES
(6, 'el mokhtar', 'said', '2295', 'Française', '1999-06-07', 609),
(7, 'el bakar', 'rachid', '2395', 'Italienne', '1985-11-21', NULL),
(8, 'montana', 'yassin', 'qfdvdsf', 'Française', '2015-10-21', 610),
(9, 'tartar', 'kadirou', '354325', 'Française', '2002-07-12', 618),
(10, 'john', 'doo', 'DOO59', 'Française', '2001-07-05', 630),
(11, 'mac', 'alter', 'DERT59', 'Française', '1997-03-06', 630),
(12, 'james', 'ifri', '25TR59', 'Française', '2002-01-30', 631),
(13, 'zaoui', 'kedira', '222200', 'Française', '1999-11-18', NULL),
(14, 'john', 'casa', 'ED5959', 'Américaine', '2021-04-02', NULL),
(15, 'cricri', 'ludo', 'FR57YH', 'Russe', '1999-06-09', NULL),
(16, 'taï yochiwwa', 'bayakoï', '455900', 'Chinoise', '1967-06-07', 634);

-- --------------------------------------------------------

--
-- Table structure for table `missions`
--

CREATE TABLE `missions` (
  `id` int(33) NOT NULL,
  `title_mission` varchar(255) NOT NULL,
  `objectif_mission` text NOT NULL,
  `code_name` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `agent_s` int(33) NOT NULL,
  `contact_s` int(33) NOT NULL,
  `cible_s` int(33) NOT NULL,
  `mission_type` varchar(255) NOT NULL,
  `statut` varchar(255) DEFAULT NULL,
  `planque_s` int(11) NOT NULL,
  `speciality_type` varchar(255) NOT NULL,
  `date_begin` date NOT NULL,
  `date_finish` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `missions`
--

INSERT INTO `missions` (`id`, `title_mission`, `objectif_mission`, `code_name`, `country`, `agent_s`, `contact_s`, `cible_s`, `mission_type`, `statut`, `planque_s`, `speciality_type`, `date_begin`, `date_finish`) VALUES
(609, 'Infiltration gang', 'infiltrer le gang de Paris', 'qcvqdf', 'France', 1, 1, 1, 'Export', 'En préparation', 1, 'infiltration', '2021-04-18', '2021-04-25'),
(610, 'vol d\'informations', 'récupérer des infos sur une technologie liée au smartphones', 'vdfvfd', 'France', 1, 1, 1, 'Export', 'En préparation', 0, 'infiltration', '2021-04-15', '2021-04-25'),
(618, 'libération otages', 'Libérer des otages à Marseille', 'LIB-INF-13', 'France', 1, 1, 1, 'Export', 'En préparation', 1, 'infiltration', '2021-04-23', '2021-04-25'),
(630, 'Infiltration terrorisme', 'Infiltrer un groupe de terroristes et arreter le groupe et surtout le leader', 'LON-INF-59', 'France', 1, 2, 1, 'Longue', 'En préparation', 1, 'infiltration', '2021-04-15', '2021-04-25'),
(631, 'infiltration banque', 'Infiltrer une banque pour neutraliser des usuriers vereux', 'D5959-INF', 'France', 2, 1, 1, 'Export', 'En préparation', 0, 'infiltration', '2021-04-08', '2021-04-25'),
(634, 'Récuperation infos', 'Récuperer des infos sur une éventuel attaque contre des sociétés Européennes', 'RR55500CHI', 'Chine', 1, 1, 1, 'Export', 'En préparation', 1, 'filature', '2021-04-23', '2021-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `nationalitys`
--

CREATE TABLE `nationalitys` (
  `id` int(11) NOT NULL,
  `nationality_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nationalitys`
--

INSERT INTO `nationalitys` (`id`, `nationality_name`) VALUES
(1, 'Française'),
(2, 'Italienne'),
(3, 'Anglaise'),
(4, 'Allemande'),
(5, 'Russe'),
(6, 'Chinoise'),
(7, 'Japonaise'),
(8, 'Suisse'),
(9, 'Américaine'),
(10, 'Espagnole');

-- --------------------------------------------------------

--
-- Table structure for table `planques`
--

CREATE TABLE `planques` (
  `id` int(33) NOT NULL,
  `code` varchar(255) NOT NULL,
  `location_name` text NOT NULL,
  `country` varchar(255) NOT NULL,
  `speciality_type` varchar(255) NOT NULL,
  `mission_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `planques`
--

INSERT INTO `planques` (`id`, `code`, `location_name`, `country`, `speciality_type`, `mission_id`) VALUES
(5, 'MAU59', 'Maubeuge', 'France', 'Bar', 609),
(6, 'CITYSTREET55', 'Miami', 'Etats Unis', 'Boomker', NULL),
(8, 'HAUT59', 'Hautmont', 'France', 'Bar', 618),
(9, '59', 'Louvroil', 'France', 'Entrepot', 630),
(10, 'ZA-59', 'Louvroil', 'France', 'Maison', NULL),
(11, '2295', 'goussainville', 'France', 'Entrepot', NULL),
(12, '554433', 'clairefontaine', 'France', 'Maison', NULL),
(13, 'taf44', 'pekin', 'Chine', 'Boomker', 634),
(14, 'EE5900', 'taïoli', 'Chine', 'Bar', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `specialitys`
--

CREATE TABLE `specialitys` (
  `id` int(11) NOT NULL,
  `speciality_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `specialitys`
--

INSERT INTO `specialitys` (`id`, `speciality_type`) VALUES
(1, 'infiltration'),
(2, 'espionnage'),
(3, 'filature'),
(4, 'enquete'),
(5, 'surveillance');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agents_active`
--
ALTER TABLE `agents_active`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cibles`
--
ALTER TABLE `cibles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nationalitys`
--
ALTER TABLE `nationalitys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planques`
--
ALTER TABLE `planques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialitys`
--
ALTER TABLE `specialitys`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(33) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `agents_active`
--
ALTER TABLE `agents_active`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `cibles`
--
ALTER TABLE `cibles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `missions`
--
ALTER TABLE `missions`
  MODIFY `id` int(33) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=635;

--
-- AUTO_INCREMENT for table `nationalitys`
--
ALTER TABLE `nationalitys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `planques`
--
ALTER TABLE `planques`
  MODIFY `id` int(33) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `specialitys`
--
ALTER TABLE `specialitys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
