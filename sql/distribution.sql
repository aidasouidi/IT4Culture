--
-- Table structure for table `distribution`
--

CREATE TABLE IF NOT EXISTS `distribution` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `idProduction` int(11) NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `artiste` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  CONSTRAINT idProduction_fk FOREIGN KEY (idProduction) REFERENCES productions (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- index --
CREATE INDEX `distribution_index_2` ON `distribution` (`role`);
CREATE INDEX `distribution_index_3` ON `distribution` (`artiste`);
--
-- Dumping data for table `distribution`
--

INSERT INTO `distribution` (`id`, `idProduction`, `role`, `artiste`) VALUES
(1, 1, 'Tosca', 'Marie Lemieux'),
(2, 1, 'Mario Cavaradossi', 'Anja Harteros'),
(3, 1, 'Scarpia', 'Marcelo Spuente'),
(4, 1, 'Cesare Angelotti', 'Luca Salsi'),
(5, 3, 'Clara', 'Mélanie Hurel'),
(6, 3, 'Le Prince', 'Josua Hoffalt'),
(7, 3, 'Luisa', 'Caroline Bance'),
(8, 3, 'Fritz', 'Axel Ibot');