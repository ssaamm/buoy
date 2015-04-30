delimiter $$

CREATE TABLE `device` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `device_type` int(11) NOT NULL,
      PRIMARY KEY (`id`),
      KEY `fk_device_1` (`device_type`),
      CONSTRAINT `fk_device_1` FOREIGN KEY (`device_type`) REFERENCES `device_kind` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1$$


