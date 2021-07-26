CREATE DATABASE IF NOT EXISTS wifi_vendor;

USE wifi_vendor;

DROP TABLE IF EXISTS `controller`;
CREATE TABLE IF NOT EXISTS `controller` (
  `id` int(11) NOT NULL,
  `controller_ip` varchar(25) NOT NULL,
  `controller_port` int(4) NOT NULL,
  `controller_username` varchar(30) NOT NULL,
  `controller_password` varchar(30) NOT NULL,
  `controller_siteid` varchar(20) NOT NULL,
  `controller_version` varchar(10) NOT NULL,
  `flag` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `controller_ip` (`controller_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `controller` (`id`, `controller_ip`, `controller_port`, `controller_username`, `controller_password`, `controller_siteid`, `controller_version`, `flag`) VALUES
(0, 'https://192.168.11.13', 8443, 'admin', 'sysadmin321546', 'default', '5.1.8', 0);

DROP TABLE IF EXISTS `galileo`;
CREATE TABLE IF NOT EXISTS `galileo` (
  `id` int(11) NOT NULL,
  `galileo_ip` varchar(20) NOT NULL,
  `galileo_status` varchar(10) NOT NULL,
  UNIQUE KEY `galileo_ip` (`galileo_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `galileo` (`id`, `galileo_ip`, `galileo_status`) VALUES
(1, '192.168.8.100', 'Online');


DROP TABLE IF EXISTS `printer`;
CREATE TABLE IF NOT EXISTS `printer` (
  `id` int(11) NOT NULL,
  `printer_ip` varchar(25) NOT NULL,
  `printer_port` int(11) NOT NULL,
  `printer_paper` datetime NOT NULL,
  `paper_length` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `printer_ip` (`printer_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `printer` (`id`, `printer_ip`, `printer_port`, `printer_paper`, `paper_length`) VALUES
(0, '192.168.8.6', 9100, '2019-03-21 00:00:00', 700);

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `user_type` varchar(30) NOT NULL,
  `user_status` varchar(15) NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`user_id`, `name`, `user_name`, `user_pass`, `user_type`, `user_status`, `date_updated`) VALUES
(4, 'Admin', 'wifiadmin', '$2y$10$nn6xsy1JSYe4mCctMDVo8u5SCFlwgnXdv4pXqevKzJWPyaRYub3ee', 'admin', 'Active', '2018-11-22 16:40:00');


DROP TABLE IF EXISTS `voucher`;
CREATE TABLE IF NOT EXISTS `voucher` (
  `voucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_duration` int(11) NOT NULL,
  `bandwidth_limit` int(11) NOT NULL,
  `bandwidth` int(11) NOT NULL,
  `voucher_logo` varchar(30) NOT NULL,
  `voucher_steps` text NOT NULL,
  `voucher_notes` text NOT NULL,
  `flag` int(1) NOT NULL,
  PRIMARY KEY (`voucher_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `voucher` (`voucher_id`, `voucher_duration`, `bandwidth_limit`, `bandwidth`, `voucher_logo`, `voucher_steps`, `voucher_notes`, `flag`) VALUES
(0, 30, 200, 3072, 'c6ANnbh0chQL1IZ.png', '1. Connect to Wifi(La Vie in the Sky Guest).\r\n2. Open your browser.\r\n3.Enter your Voucher Code below.', 'Enjoy Wifi! ', 0);

DROP TABLE IF EXISTS `voucher_record`;
CREATE TABLE IF NOT EXISTS `voucher_record` (
  `record_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher` varchar(25) NOT NULL,
  `voucher_type` varchar(15) NOT NULL,
  `record_date` datetime NOT NULL,
  `flag` int(11) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7434 DEFAULT CHARSET=latin1;

COMMIT;