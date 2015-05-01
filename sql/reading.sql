delimiter $$

CREATE TABLE `reading` (
      `device_id` int(11) NOT NULL,
      `time` datetime NOT NULL,
      `dimension0` decimal(10,0) NOT NULL,
      `dimension1` decimal(10,0) DEFAULT NULL,
      PRIMARY KEY (`device_id`,`time`),
      KEY `fk_reading_1` (`device_id`),
      CONSTRAINT `fk_reading_1` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1$$


