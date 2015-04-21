delimiter $$

CREATE TABLE `buoy` (
  `latitude` decimal(18,12) NOT NULL,
  `longitude` decimal(18,12) NOT NULL,
  `elevation` int(11) NOT NULL,
  `depth` int(11) NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`latitude`,`longitude`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1$$
