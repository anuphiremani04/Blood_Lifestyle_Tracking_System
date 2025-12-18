-- Create table for hospital-to-hospital blood requests
CREATE TABLE IF NOT EXISTS `hospitalrequest` (
  `reqid` int(11) NOT NULL AUTO_INCREMENT,
  `from_hid` int(11) NOT NULL,
  `to_hid` int(11) NOT NULL,
  `bg` varchar(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `status` varchar(100) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`reqid`),
  KEY `from_hid` (`from_hid`),
  KEY `to_hid` (`to_hid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

