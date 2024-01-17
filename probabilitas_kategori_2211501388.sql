# Host: localhost  (Version 5.5.5-10.4.28-MariaDB)
# Date: 2023-11-30 07:31:26
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "probabilitas_kategori_2211501388"
#

DROP TABLE IF EXISTS `probabilitas_kategori_2211501388`;
CREATE TABLE `probabilitas_kategori_2211501388` (
  `id_kategori` int(11) NOT NULL,
  `jml_data` int(11) DEFAULT 0,
  `nilai_probabilitas` float(10,10) DEFAULT 0.0000000000,
  `tmp_nilai` float(10,10) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Data for table "probabilitas_kategori_2211501388"
#

