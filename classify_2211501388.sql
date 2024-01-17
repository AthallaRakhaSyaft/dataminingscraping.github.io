# Host: localhost  (Version 5.5.5-10.4.28-MariaDB)
# Date: 2023-11-30 07:31:51
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "classify_2211501388"
#

DROP TABLE IF EXISTS `classify_2211501388`;
CREATE TABLE `classify_2211501388` (
  `data_bersih` tinytext NOT NULL,
  `id_actual` varchar(3) DEFAULT NULL,
  `id_predicted` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Data for table "classify_2211501388"
#

