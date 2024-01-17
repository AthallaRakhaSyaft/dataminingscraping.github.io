# Host: localhost  (Version 5.5.5-10.4.28-MariaDB)
# Date: 2023-11-30 07:30:29
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "galert_data_2211501388"
#

DROP TABLE IF EXISTS `galert_data_2211501388`;
CREATE TABLE `galert_data_2211501388` (
  `galert_id` varchar(300) NOT NULL DEFAULT '',
  `galert_title` tinytext DEFAULT NULL,
  `galert_link` tinytext DEFAULT NULL,
  `galert_update` tinytext DEFAULT NULL,
  PRIMARY KEY (`galert_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Data for table "galert_data_2211501388"
#

INSERT INTO `galert_data_2211501388` VALUES ('tag:google.com,2005:reader/user/15184189448141550031/state/com.google/alerts/13992085059311248893','Google Alert - Politik','','2023-11-29T16:36:27Z'),('tag:google.com,2005:reader/user/15184189448141550031/state/com.google/alerts/3930286811085934833','Google Alert - Hukum','','2023-11-29T16:30:42Z'),('tag:google.com,2005:reader/user/15184189448141550031/state/com.google/alerts/6717174291739697944','Google Alert - Ekonomi','','2023-11-29T15:59:23Z');
