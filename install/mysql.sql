DROP TABLE IF EXISTS `brew`;
CREATE TABLE IF NOT EXISTS `brew` (
	  `uid` char(38) COLLATE latin1_general_ci NOT NULL,
	  `name` varchar(1200) COLLATE latin1_general_ci NOT NULL,
	  `image` varchar(1200) COLLATE latin1_general_ci NOT NULL,
	  `description` text COLLATE latin1_general_ci NOT NULL,
	  `brewed_on` date NOT NULL,
	  `kegged_on` date NOT NULL,
	  `keg` varchar(255) COLLATE latin1_general_ci NOT NULL,
	  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
	  `notes` text COLLATE latin1_general_ci NOT NULL,
	  PRIMARY KEY (`uid`)
	) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
