# ************************************************************
# Sequel Ace SQL dump
# Version 20046
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 8.0.33)
# Database: musette_user_data
# Generation Time: 2023-06-25 09:23:07 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table currentplaylist
# ------------------------------------------------------------

DROP TABLE IF EXISTS `currentplaylist`;

CREATE TABLE `currentplaylist` (
  `songId` int unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`songId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



# Dump of table himanshuji
# ------------------------------------------------------------

DROP TABLE IF EXISTS `himanshuji`;

CREATE TABLE `himanshuji` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `library` int DEFAULT NULL,
  `album` int DEFAULT NULL,
  `artist` int DEFAULT NULL,
  `currentplaylist` int DEFAULT NULL,
  `plays` int NOT NULL DEFAULT '0',
  `albumorder` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



# Dump of table recentlyplayed
# ------------------------------------------------------------

DROP TABLE IF EXISTS `recentlyplayed`;

CREATE TABLE `recentlyplayed` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `typesid` int DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `time` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `recentlyplayed` WRITE;
/*!40000 ALTER TABLE `recentlyplayed` DISABLE KEYS */;

INSERT INTO `recentlyplayed` (`id`, `typesid`, `type`, `username`, `time`)
VALUES
	(1,15,'album','himanshuji','2023-06-22'),
	(2,15,'album','himanshuji','2023-06-22'),
	(3,15,'album','himanshuji','2023-06-22');

/*!40000 ALTER TABLE `recentlyplayed` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table savedplaylist
# ------------------------------------------------------------

DROP TABLE IF EXISTS `savedplaylist`;

CREATE TABLE `savedplaylist` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(25) DEFAULT NULL,
  `playlistId` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
