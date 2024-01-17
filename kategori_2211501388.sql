# Host: localhost  (Version 5.5.5-10.4.28-MariaDB)
# Date: 2023-11-30 07:29:46
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "kategori_2211501388"
#

DROP TABLE IF EXISTS `kategori_2211501388`;
CREATE TABLE `kategori_2211501388` (
  `id_kategori` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nm_kategori` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Data for table "kategori_2211501388"
#

INSERT INTO `kategori_2211501388` VALUES (1,'Ekonomi'),(2,'Hukum'),(3,'Politik');
