delimiter $$

CREATE TABLE `buoy_device` (
  `latitude` decimal(18,12) NOT NULL,
  `longitude` decimal(18,12) NOT NULL,
  `device_id` int(11) NOT NULL,
  PRIMARY KEY (`latitude`,`longitude`,`device_id`),
  KEY `fk_buoy_device_1` (`device_id`),
  CONSTRAINT `fk_buoy_device_1` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1$$

