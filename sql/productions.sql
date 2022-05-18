--
-- Table structure for table `productions`
--

CREATE TABLE IF NOT EXISTS `productions` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `intitule` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `compositeur` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productions`
--

INSERT INTO `productions` (`id`, `intitule`, `compositeur`) VALUES
(1, 'Tosca', 'Giuseppe Verdi'),
(3, 'Casse Noisette', 'I. Tchaikovski'),
(4, 'Don Giovanni', 'W.A. Mozart'),
(5, 'Il Barbiere di Siviglia', 'Rossini');
