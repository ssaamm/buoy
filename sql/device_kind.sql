delimiter $$

CREATE TABLE `device_kind` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `dimension0_name` varchar(255) NOT NULL,
      `dimension1_name` varchar(255) DEFAULT NULL,
      `device_name` varchar(255) NOT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `device_name_UNIQUE` (`device_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1$$

