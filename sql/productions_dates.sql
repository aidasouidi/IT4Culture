--
-- Table structure for table `productions_dates`
--

CREATE TABLE IF NOT EXISTS `productions_dates` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `idProduction` int(11) NOT NULL,
  `dateHeure` datetime NOT NULL,
  `commentaire` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productions_dates`
--

INSERT INTO `productions_dates` (`id`, `idProduction`, `dateHeure`, `commentaire`) VALUES
(1, 1, '2022-01-11 19:30:00', 'Première'),
(2, 2, '2022-03-01 19:30:00', 'Première'),
(3, 1, '2022-01-20 19:30:00', ''),
(4, 1, '2022-01-21 19:30:00', ''),
(5, 2, '2022-03-03 11:30:00', 'Matinée'),
(6, 1, '2022-01-15 19:30:00', ''),
(7, 2, '2022-03-06 19:30:00', ''),
(8, 2, '2022-03-08 19:30:00', ''),
(9, 1, '2022-01-13 19:30:00', '');