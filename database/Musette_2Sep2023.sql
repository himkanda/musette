CREATE DATABASE  IF NOT EXISTS `musette_app_data` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `musette_app_data`;
-- MySQL dump 10.13  Distrib 8.0.33, for macos13 (arm64)
--
-- Host: localhost    Database: musette_app_data
-- ------------------------------------------------------
-- Server version	8.0.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `albums` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `artist` int NOT NULL,
  `genre` int NOT NULL,
  `artworkPath` varchar(500) NOT NULL,
  `Year` int DEFAULT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albums`
--

LOCK TABLES `albums` WRITE;
/*!40000 ALTER TABLE `albums` DISABLE KEYS */;
INSERT INTO `albums` VALUES (1,'Bacon and Eggs',2,4,'assets/images/artwork/clearday.jpg',1975,'2018-12-02 17:21:42'),(2,'Energy',5,7,'assets/images/artwork/energy.jpg',2006,'2018-12-02 17:21:42'),(3,'Summer Hits',3,1,'assets/images/artwork/goinghigher.jpg',2000,'2018-12-02 17:21:42'),(4,'The movie soundtrack',2,9,'assets/images/artwork/funkyelement.jpg',2018,'2018-12-02 17:21:42'),(5,'Best of the Worst',1,3,'assets/images/artwork/popdance.jpg',1990,'2018-12-02 17:21:42'),(6,'Hello World',3,6,'assets/images/artwork/ukulele.jpg',2005,'2018-12-02 17:21:42'),(7,'Best beats',4,7,'assets/images/artwork/sweet.jpg',2007,'2018-12-02 17:21:42'),(8,'Melodrama',6,2,'assets/images/artwork/melodrama.png',2017,'2018-12-02 17:21:42'),(9,'24K Magic',7,5,'assets/images/artwork/24KMagic.png',2016,'2018-12-02 17:21:42'),(10,'Red',8,10,'assets/images/artwork/red.jpg',2012,'2018-12-02 17:21:42'),(11,'Speak Now',8,10,'assets/images/artwork/speak_now.png',2010,'2018-12-02 17:21:42'),(12,'MANIA',9,11,'assets/images/artwork/mania.jpg',2018,'2018-12-02 17:21:42'),(13,'Asphalt 8',10,13,'assets/images/artistpic/Asphalt-8.png',2000,'2018-12-02 17:21:42'),(14,'Asphalt 9',10,13,'assets/images/artistpic/asphalt 2.png',2002,'2018-12-02 17:21:42'),(15,'Youngblood',11,2,'assets/images/artwork/youngblood.png',2018,'2018-12-02 17:21:42'),(17,'1989',8,2,'assets/images/artwork/1989.png',2014,'2018-12-02 18:56:26'),(18,'21',17,2,'assets/images/artwork/21.jpg',2011,'2018-12-03 15:31:18'),(20,'AM',25,14,'assets/images/artwork/AM.jpg',2013,'2018-12-03 17:59:36'),(21,'In a World Like This',27,2,'assets/images/artwork/Backstreet_Boys_-_In_a_World_Like_This_(Official_album_cover).png',2013,'2018-12-03 18:13:59');
/*!40000 ALTER TABLE `albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artists` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `country` varchar(25) NOT NULL,
  `artistpic` varchar(100) NOT NULL,
  `artistinfo` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artists`
--

LOCK TABLES `artists` WRITE;
/*!40000 ALTER TABLE `artists` DISABLE KEYS */;
INSERT INTO `artists` VALUES (1,'Mickey Mouse','USA','assets/images/artistpic/mickey-mouse.jpg','Mickey Mouse is a funny animal cartoon character and the mascot of The Walt Disney Company. He was created by Walt Disney and Ub Iwerks at the Walt Disney Studios in 1928.'),(2,'Goofy','UK','assets/images/artistpic/goofy.jpg',''),(3,'Bart Simpson','UK','assets/images/artistpic/bart.jpg',''),(4,'Homer','Australia','assets/images/artistpic/homer.jpg',''),(5,'Bruce Lee','China','assets/images/artistpic/bruce-lee.jpg',''),(6,'Lorde','New Zealand','assets/images/artistpic/lorde.jpeg','Ella Marija Lani Yelich-O\'Connor, known professionally as Lorde, is a New Zealand singer, songwriter, and record producer. Born in the Auckland suburb of Takapuna and raised in neighbouring Devonport, New Zealand, she began performing in her early teens. She signed with Universal Music Group in 2009 and was later paired with songwriter and record producer Joel Little. At the age of sixteen, she released her first extended play, The Love Club EP, reaching number two on the national record charts.'),(7,'Bruno Mars','USA','assets/images/artistpic/bruno.jpg','Peter Gene Hernandez, known professionally as Bruno Mars, is an American singer-songwriter, multi-instrumentalist, record producer, and dancer. Born and raised in Honolulu, Hawaii, Mars moved to Los Angeles in 2003 to pursue a musical career. After being dropped by Motown Records, Mars signed a recording contract with Atlantic Records in 2009. In the same year, he co-founded the production team The Smeezingtons, responsible for various successful singles for Mars himself and other artists. In 2016, Shampoo Press & Curl replaced The Smeezingtons on the composition of Mars\' third studio album, 24K Magic.'),(8,'Taylor Swift','USA','assets/images/artistpic/taylor.png','Taylor Alison Swift is an American singer-songwriter. One of the world\'s leading contemporary recording artists, she is known for narrative songs about her personal life, which have received widespread media coverage.'),(9,'Fall Out Boy','USA','assets/images/artistpic/fall.jpg','Fall Out Boy is an American rock band formed in Wilmette, Illinois, a suburb of Chicago, in 2001. The band consists of lead vocalist and rhythm guitarist Patrick Stump, bassist Pete Wentz, lead guitarist Joe Trohman, and drummer Andy Hurley. The band originated from Chicago\'s hardcore punk scene, with which all members were involved at one point. The group was formed by Wentz and Trohman as a pop punk side project of the members\' respective hardcore bands, and Stump joined shortly thereafter. The group went through a succession of drummers before landing Hurley and recording the group\'s debut album, Take This to Your Grave. The album became an underground success and helped the band gain a dedicated fanbase through heavy touring, as well as some moderate commercial success. Take This to Your Grave has commonly been cited as an influential blueprint for pop punk music in the 2000s.'),(10,'Asphalt ','France','assets/images/artistpic/Asphalt-8.png','Asphalt 8 is the greatest car racing game in history of internet.'),(11,'5 Seconds of Summer','Australia','assets/images/artistpic/5 Seconds of Summer.jpg','5 Seconds of Summer, often shortened to 5SOS, are an Australian pop rock band from Sydney, New South Wales, formed in 2011. The group consists of lead vocalist Luke Hemmings, lead guitarist Michael Clifford, bassist Calum Hood, and drummer Ashton Irwin. They were originally YouTube celebrities, posting videos of themselves covering songs from various artists during 2011 and early 2012. They rose to international fame while touring with English band One Direction on their Take Me Home Tour. They have since released three studio albums and headlined three world tours.'),(17,'Adele','UK','assets/images/artistpic/adele.png','Adele Laurie Blue Adkins is an English singer and songwriter. After graduating from the BRIT School for Performing Arts and Technology in 2006, Adele was given a recording contract by XL Recordings after a friend posted her demo on Myspace the same year. In 2007, she received the Brit Awards Critics\' Choice award and won the BBC Sound of 2008 poll. Her debut album, 19, was released in 2008 to commercial and critical success. It is certified seven times platinum in the UK, and three times platinum in the US. The album contains her first song, Hometown Glory, written when she was 16, which is based on her home suburb of West Norwood in London. An appearance she made on Saturday Night Live in late 2008 boosted her career in the US. At the 51st Grammy Awards in 2009, Adele received the awards for Best New Artist and Best Female Pop Vocal Performance.'),(18,'Rihanna','Barbados','assets/images/artistpic/rihanna.jpg','Robyn Rihanna Fenty is a Barbadian singer, businesswoman, diplomat, actress, dancer, and songwriter. Born in Saint Michael, Barbados, and raised in Bridgetown, she was discovered by American record producer Evan Rogers in her home country of Barbados in 2003. Throughout 2004, she recorded demo tapes under the direction of Rogers and signed a recording contract with Def Jam Recordings after auditioning for its then-president, hip hop producer and rapper Jay-Z. In 2005, Rihanna rose to fame with the release of her debut studio album Music of the Sun and its follow-up A Girl like Me, which charted on the top 10 of the US Billboard 200 and respectively produced the successful singles \"Pon de Replay\", \"SOS\" and \"Unfaithful\".'),(25,'Arctic Monkeys','UK','assets/images/artistpic/arcticmonkeys.jpg','Arctic Monkeys are an English rock band formed in 2002 in High Green, a suburb of Sheffield. The band consists of Alex Turner, Matt Helders, Jamie Cook and Nick O\'Malley. Former band member Andy Nicholson left the band in 2006 shortly after their debut album was released.'),(27,'Backstreet Boys','USA','assets/images/artistpic/backstreet-boys.jpg','The Backstreet Boys are an American vocal group, formed in Orlando, Florida in 1993. The group consists of AJ McLean, Howie Dorough, Nick Carter, Kevin Richardson, and Brian Littrell.'),(28,'BeyoncÃ©','USA','assets/images/artistpic/be.jpg','BeyoncÃ© Giselle Knowles-Carter is an American singer, songwriter, actress, record producer, and dancer. Born and raised in Houston, Texas, BeyoncÃ© performed in various singing and dancing competitions as a child. She rose to fame in the late 1990s as lead singer of the R&B girl-group Destiny\'s Child. Managed by her father, Mathew Knowles, the group became one of the best-selling girl groups in history. Their hiatus saw BeyoncÃ©\'s theatrical film debut in Austin Powers in Goldmember (2002) and the release of her first solo album, Dangerously in Love (2003). The album established her as a solo artist worldwide, debuting at number one on the US Billboard 200 chart and earning five Grammy Awards, and featured the Billboard Hot 100 number one singles Crazy in Love and Baby Boy.'),(29,'Coldplay','UK','assets/images/artistpic/avatars-000237271265-7hhnty-t300x300.jpg','Coldplay are a British rock band, formed in 1996 by lead singer and pianist Chris Martin and lead guitarist Jonny Buckland at University College London (UCL). After they formed under the name Pectoralz, Guy Berryman joined the group as bassist and they changed their name to Starfish. Will Champion joined as drummer and backing vocalist, completing the line-up. Creative director and former manager Phil Harvey is often referred to as the fifth member by the band. The band renamed themselves Coldplay in 1998, before recording and releasing three EPs: Safety in 1998 and Brothers & Sisters and The Blue Room in 1999. The Blue Room was their first release on a major label, after signing to Parlophone.'),(30,'Daft Punk','France','assets/images/artistpic/Daft-Punk.jpg','Daft Punk are a French electronic music duo formed in Paris in 1993 by Guy-Manuel de Homem-Christo and Thomas Bangalter. They achieved popularity in the late 1990s as part of the French house movement, and had success in the years following, combining elements of house music with funk, techno, disco, rock and synthpop. They have worn ornate helmets and gloves to assume robot personas in most public appearances since 2001, and rarely grant interviews or appear on television. The duo were managed from 1996 to 2008 by Pedro Winter, the head of Ed Banger Records.');
/*!40000 ALTER TABLE `artists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genres`
--

DROP TABLE IF EXISTS `genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genres`
--

LOCK TABLES `genres` WRITE;
/*!40000 ALTER TABLE `genres` DISABLE KEYS */;
INSERT INTO `genres` VALUES (1,'Rock'),(2,'Pop'),(3,'Hip-hop'),(4,'Rap'),(5,'R&B'),(6,'Classical'),(7,'Techno'),(8,'Jazz'),(9,'Folk'),(10,'Country'),(11,'Electropop'),(12,'Alternative'),(13,'Dance'),(14,'Indie rock');
/*!40000 ALTER TABLE `genres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playlists`
--

DROP TABLE IF EXISTS `playlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `playlists` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `public` tinyint(1) NOT NULL DEFAULT '0',
  `length` int DEFAULT NULL,
  `description` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlists`
--

LOCK TABLES `playlists` WRITE;
/*!40000 ALTER TABLE `playlists` DISABLE KEYS */;
INSERT INTO `playlists` VALUES (33,'taylor\'s bestt','HimanshuK','2018-12-16 12:36:54',1,NULL,NULL),(35,'Lorde\'s best','HimanshuK','2018-12-16 07:24:42',1,NULL,NULL),(36,'bruno\'s best','HimanshuK','2018-11-28 17:12:39',1,NULL,NULL),(37,'best tunes','HimanshuK','2018-12-16 12:38:21',1,NULL,NULL),(38,'goofy','rajiv','2018-11-28 17:20:44',1,NULL,NULL),(39,'piano','rajiv','2018-11-28 17:59:30',1,NULL,NULL),(52,'hiii','HimanshuK','2018-12-16 12:40:07',1,NULL,NULL),(57,'5SOS Songs','himanshuji','2023-09-01 19:28:39',0,NULL,NULL),(61,'best songs','himanshuji','2023-06-21 21:28:34',1,NULL,NULL),(84,'MyLibrary Songs','himanshuji','2023-09-01 19:23:34',1,NULL,NULL),(85,'Slow Tempo','himanshuji','2023-09-01 19:28:04',1,NULL,NULL);
/*!40000 ALTER TABLE `playlists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playlistsongs`
--

DROP TABLE IF EXISTS `playlistsongs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `playlistsongs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `songId` int NOT NULL,
  `playlistId` int NOT NULL,
  `playlistOrder` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=458 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlistsongs`
--

LOCK TABLES `playlistsongs` WRITE;
/*!40000 ALTER TABLE `playlistsongs` DISABLE KEYS */;
INSERT INTO `playlistsongs` VALUES (230,96,33,0),(231,78,33,1),(232,77,33,2),(233,85,33,3),(238,32,35,0),(239,36,35,1),(240,38,35,2),(241,42,35,3),(242,44,35,4),(243,58,36,0),(244,23,37,0),(245,24,37,1),(246,25,37,2),(248,146,37,4),(249,141,37,5),(251,6,38,0),(252,100,39,0),(253,78,35,5),(254,71,33,4),(255,74,33,5),(256,72,33,6),(257,91,33,7),(258,93,33,8),(259,95,33,9),(260,87,33,10),(379,60,52,0),(382,6,37,6),(383,119,52,1),(384,120,52,2),(385,121,52,3),(386,122,52,4),(387,123,52,5),(388,124,52,6),(389,125,52,7),(390,126,52,8),(391,127,52,9),(392,128,52,10),(393,139,52,11),(394,140,52,12),(395,141,52,13),(396,142,52,14),(397,143,52,15),(398,144,52,16),(399,145,52,17),(400,146,52,18),(401,147,52,19),(402,148,52,20),(403,32,52,21),(404,35,52,22),(405,36,52,23),(406,37,52,24),(407,38,52,25),(408,39,52,26),(409,40,52,27),(410,41,52,28),(411,42,52,29),(412,43,52,30),(413,44,52,31),(414,1,122,1),(415,2,122,2),(450,152,57,0),(451,25,84,0),(452,149,84,1),(453,151,84,2),(454,24,84,3),(455,23,84,4),(456,27,84,5),(457,156,84,6);
/*!40000 ALTER TABLE `playlistsongs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `songs`
--

DROP TABLE IF EXISTS `songs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `songs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `artist` int NOT NULL,
  `feat` int DEFAULT NULL,
  `album` int NOT NULL,
  `duration` varchar(8) NOT NULL,
  `path` varchar(500) NOT NULL,
  `albumorder` int NOT NULL,
  `plays` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `songs`
--

LOCK TABLES `songs` WRITE;
/*!40000 ALTER TABLE `songs` DISABLE KEYS */;
INSERT INTO `songs` VALUES (1,'Acoustic Breeze',1,NULL,5,'2:37','assets/music/Bensound/bensound-acousticbreeze.mp3',1,41),(2,'A new beginning',1,NULL,5,'2:35','assets/music/Bensound/bensound-anewbeginning.mp3',2,40),(3,'Better Days',1,NULL,5,'2:33','assets/music/Bensound/bensound-betterdays.mp3',3,43),(4,'Buddy',1,NULL,5,'2:02','assets/music/Bensound/bensound-buddy.mp3',4,29),(5,'Clear Day',1,NULL,5,'1:29','assets/music/Bensound/bensound-clearday.mp3',5,34),(6,'Going Higher',2,NULL,1,'4:04','assets/music/Bensound/bensound-goinghigher.mp3',1,66),(7,'Funny Song',2,NULL,4,'3:07','assets/music/Bensound/bensound-funnysong.mp3',2,37),(8,'Funky Element',2,NULL,1,'3:08','assets/music/Bensound/bensound-funkyelement.mp3',2,41),(9,'Extreme Action',2,NULL,1,'8:03','assets/music/Bensound/bensound-extremeaction.mp3',3,44),(10,'Epic',2,NULL,4,'2:58','assets/music/Bensound/bensound-epic.mp3',3,37),(11,'Energy',2,NULL,1,'2:59','assets/music/Bensound/bensound-energy.mp3',4,63),(12,'Dubstep',2,NULL,1,'2:03','assets/music/Bensound/bensound-dubstep.mp3',5,41),(13,'Happiness',3,NULL,6,'4:21','assets/music/Bensound/bensound-happiness.mp3',5,27),(14,'Happy Rock',3,NULL,6,'1:45','assets/music/Bensound/bensound-happyrock.mp3',4,26),(15,'Jazzy Frenchy',3,NULL,6,'1:44','assets/music/Bensound/bensound-jazzyfrenchy.mp3',3,22),(16,'Little Idea',3,NULL,6,'2:49','assets/music/Bensound/bensound-littleidea.mp3',2,18),(17,'Memories',3,NULL,6,'3:50','assets/music/Bensound/bensound-memories.mp3',1,26),(18,'Moose',4,NULL,7,'2:43','assets/music/Bensound/bensound-moose.mp3',5,21),(19,'November',4,NULL,7,'3:32','assets/music/Bensound/bensound-november.mp3',4,21),(20,'Of Elias Dream',4,NULL,7,'4:58','assets/music/Bensound/bensound-ofeliasdream.mp3',3,22),(21,'Pop Dance',4,NULL,7,'2:42','assets/music/Bensound/bensound-popdance.mp3',2,20),(22,'Retro Soul',4,NULL,7,'3:36','assets/music/Bensound/bensound-retrosoul.mp3',1,35),(23,'Sad Day',5,NULL,2,'2:28','assets/music/Bensound/bensound-sadday.mp3',1,30),(24,'Sci-fi',5,NULL,2,'4:44','assets/music/Bensound/bensound-scifi.mp3',2,52),(25,'Slow Motion',5,NULL,2,'3:26','assets/music/Bensound/bensound-slowmotion.mp3',3,52),(26,'Sunny',5,NULL,2,'2:20','assets/music/Bensound/bensound-sunny.mp3',4,32),(27,'Sweet',5,NULL,2,'5:07','assets/music/Bensound/bensound-sweet.mp3',5,27),(28,'Tenderness ',3,NULL,3,'2:03','assets/music/Bensound/bensound-tenderness.mp3',4,31),(29,'The Lounge',3,NULL,3,'4:16','assets/music/Bensound/bensound-thelounge.mp3 ',3,33),(30,'Ukulele',3,NULL,3,'2:26','assets/music/Bensound/bensound-ukulele.mp3 ',2,42),(31,'Tomorrow',3,NULL,3,'4:54','assets/music/Bensound/bensound-tomorrow.mp3 ',1,45),(32,'Green Light',6,2,8,'3:54','assets/music/Lorde/0001.mp3',1,114),(35,'Sober',6,NULL,8,'3:17','assets/music/Lorde/0002.mp3',2,61),(36,'Homemade Dynamite',6,NULL,8,'3:09','assets/music/Lorde/0003.mp3',3,58),(37,'The Louvre',6,NULL,8,'4:31','assets/music/Lorde/0004.mp3',4,43),(38,'Liability',6,NULL,8,'2:51','assets/music/Lorde/0005.mp3',5,33),(39,'Hard Feelings (Loveless)',6,NULL,8,'6:07','assets/music/Lorde/0006.mp3',6,68),(40,'Sober II (Melodrama)',6,NULL,8,'2:58','assets/music/Lorde/0007.mp3',7,120),(41,'Writer In The Dark',6,NULL,8,'3:36','assets/music/Lorde/0008.mp3',8,48),(42,'Supercut',6,NULL,8,'4:37','assets/music/Lorde/0009.mp3',9,40),(43,'Liability (Reprise)',6,NULL,8,'2:16','assets/music/Lorde/0010.mp3',10,41),(44,'Perfect Places',6,NULL,8,'3:41','https://docs.google.com/uc?export=download&id=11CbjmXCgeO8jxzsb0qL-hUSR5SH1yCvc',11,98),(54,'24K Magic',7,NULL,9,'3:47','assets/music/Bruno/24kmagic.mp3',1,49),(55,'Chunky',7,NULL,9,'03:07','assets/music/Bruno/02-bruno_mars-chunky.mp3',2,17),(56,'Perm',7,NULL,9,'03:30','assets/music/Bruno/03-bruno_mars-perm.mp3',3,30),(57,'Thats What I Like',7,NULL,9,'03:27','assets/music/Bruno/04-bruno_mars-thats_what_i_like.mp3',4,26),(58,'Versace On The Floor',7,NULL,9,'04:21','assets/music/Bruno/05-bruno_mars-versace_on_the_floor.mp3',5,42),(59,'Straight Up And Down',7,NULL,9,'03:18','assets/music/Bruno/06-bruno_mars-straight_up_and_down.mp3',6,14),(60,'Calling All My Lovelies',7,NULL,9,'04:10','assets/music/Bruno/07-bruno_mars-calling_all_my_lovelies.mp3',7,23),(61,'Finesse',7,NULL,9,'03:11','assets/music/Bruno/08 finesse.mp3',8,21),(62,'Too Good To Say Goodbye',7,NULL,9,'04:42','assets/music/Bruno/09 too good to say goodbye.mp3',9,14),(63,'I Knew You Were Trouble.',8,NULL,10,'03:40','assets/music/Taylor/Taylor Swift - I Knew You Were Trouble..mp3',4,18),(64,'Red (Demo)',8,NULL,10,'03:47','assets/music/Taylor/Taylor Swift - Red (Demo).mp3',21,11),(65,'Red',8,NULL,10,'03:43','assets/music/Taylor/Taylor Swift - Red.mp3',2,26),(66,'Sad Beautiful Tragic',8,NULL,10,'04:45','assets/music/Taylor/Taylor Swift - Sad Beautiful Tragic.mp3',12,22),(67,'Starlight',8,NULL,10,'03:41','assets/music/Taylor/Taylor Swift - Starlight.mp3',15,15),(68,'State of Grace (Acoustic Version)',8,NULL,10,'05:23','assets/music/Taylor/Taylor Swift - State of Grace (Acoustic Version).mp3',22,11),(69,'State of Grace',8,NULL,10,'04:56','assets/music/Taylor/Taylor Swift - State of Grace.mp3',1,13),(70,'Stay Stay Stay',8,NULL,10,'03:26','assets/music/Taylor/Taylor Swift - Stay Stay Stay.mp3',9,10),(71,'The Lucky One',8,NULL,10,'04:01','assets/music/Taylor/Taylor Swift - The Lucky One.mp3',13,24),(72,'The Moment I Knew',8,NULL,10,'04:47','assets/music/Taylor/Taylor Swift - The Moment I Knew.mp3',17,25),(73,'Treacherous (Demo)',8,NULL,10,'04:01','assets/music/Taylor/Taylor Swift - Treacherous (Demo).mp3',20,16),(74,'Treacherous',8,NULL,10,'04:03','assets/music/Taylor/Taylor Swift - Treacherous.mp3',3,53),(75,'We Are Never Ever Getting Back Together',8,NULL,10,'03:13','assets/music/Taylor/Taylor Swift - We Are Never Ever Getting Back Together.mp3',8,13),(76,'22',8,NULL,10,'03:52','assets/music/Taylor/Taylor Swift - 22.mp3',6,18),(77,'All Too Well',8,NULL,10,'05:29','assets/music/Taylor/Taylor Swift - All Too Well.mp3',5,33),(78,'Begin Again',8,NULL,10,'03:58','assets/music/Taylor/Taylor Swift - Begin Again.mp3',16,21),(79,'Come Back... Be Here',8,NULL,10,'03:44','assets/music/Taylor/Taylor Swift - Come Back... Be Here.mp3',18,17),(80,'Girl At Home',8,NULL,10,'03:41','assets/music/Taylor/Taylor Swift - Girl At Home.mp3',19,17),(81,'Holy Ground',8,NULL,10,'03:23','assets/music/Taylor/Taylor Swift - Holy Ground.mp3',11,8),(82,'I Almost Do',8,NULL,10,'04:05','assets/music/Taylor/Taylor Swift - I Almost Do.mp3',7,10),(83,'Everything Has Changed',8,NULL,10,'04:06','assets/music/Taylor/Taylor Swift Feat Ed Sheeran - Everything Has Changed.mp3',14,9),(84,'The Last Time',8,NULL,10,'04:59','assets/music/Taylor/Taylor Swift Feat Gary Lightbody - The Last Time.mp3',10,12),(85,'Back To December',8,NULL,11,'04:53','assets/music/Taylor/103-taylor_swift-back_to_december.mp3',3,42),(86,'Speak Now',8,NULL,11,'04:01','assets/music/Taylor/104-taylor_swift-speak_now.mp3',4,11),(87,'Dear John',8,NULL,11,'06:44','assets/music/Taylor/105-taylor_swift-dear_john.mp3',5,43),(88,'Mean',8,NULL,11,'03:58','assets/music/Taylor/106-taylor_swift-mean.mp3',6,16),(89,'The Story Of Us',8,NULL,11,'04:26','assets/music/Taylor/107-taylor_swift-the_story_of_us.mp3',7,38),(90,'Never Grow Up',8,NULL,11,'04:51','assets/music/Taylor/108-taylor_swift-never_grow_up.mp3',8,40),(91,'Enchanted',8,NULL,11,'05:52','assets/music/Taylor/109-taylor_swift-enchanted.mp3',9,47),(92,'Better Than Revenge',8,NULL,11,'03:37','assets/music/Taylor/110-taylor_swift-better_than_revenge.mp3',10,10),(93,'Innocent',8,NULL,11,'05:02','assets/music/Taylor/111-taylor_swift-innocent.mp3',11,26),(94,'Haunted',8,NULL,11,'04:02','assets/music/Taylor/112-taylor_swift-haunted.mp3',12,12),(95,'Last Kiss',8,NULL,11,'06:07','assets/music/Taylor/113-taylor_swift-last_kiss.mp3',13,19),(96,'Long Live',8,NULL,11,'05:18','assets/music/Taylor/114-taylor_swift-long_live.mp3',14,49),(97,'Mine',8,NULL,11,'03:51','assets/music/Taylor/101-taylor_swift-mine.mp3',1,13),(98,'Sparks Fly',8,NULL,11,'04:21','assets/music/Taylor/102-taylor_swift-sparks_fly.mp3',2,17),(99,'Stay Frosty Royal Milk Tea',9,NULL,12,'02:51','assets/music/FallOutBoy/01. Stay Frosty Royal Milk Tea.mp3',1,14),(100,'The Last Of The Real Ones',9,NULL,12,'03:51','assets/music/FallOutBoy/02. The Last Of The Real Ones.mp3',2,28),(101,'Hold Me Tight Or Don\'t',9,NULL,12,'03:31','assets/music/FallOutBoy/03. Hold Me Tight Or Don\'t.mp3',3,18),(102,'Wilson (Expensive Mistakes)',9,NULL,12,'03:37','assets/music/FallOutBoy/04. Wilson (Expensive Mistakes).mp3',4,11),(103,'Church',9,NULL,12,'03:32','assets/music/FallOutBoy/05. Church.mp3',5,30),(104,'Heaven\'s Gate',9,NULL,12,'03:46','assets/music/FallOutBoy/06. Heaven\'s Gate.mp3',6,16),(105,'Champion',9,NULL,12,'03:13','assets/music/FallOutBoy/07. Champion.mp3',7,19),(106,'Sunshine Riptide (feat. Burna Boy)',9,NULL,12,'03:25','assets/music/FallOutBoy/08. Sunshine Riptide (feat. Burna Boy).mp3',8,13),(107,'Young And Menace',9,NULL,12,'03:44','assets/music/FallOutBoy/09. Young And Menace.mp3',9,18),(108,'Bishops Knife Trick',9,NULL,12,'04:23','assets/music/FallOutBoy/10. Bishops Knife Trick.mp3',10,26),(119,'Sean&Bobo 119',10,NULL,13,'04:09','assets/music/Asphalt/Sean&Bobo - 119.mp3',1,26),(120,'Until Dawn',10,NULL,13,'04:48','assets/music/Asphalt/JAEGER - Until Dawn.mp3',1,6),(121,'Barracuda KC4K',10,NULL,13,'05:07','assets/music/Asphalt/KC4K - Barracuda.mp3',1,8),(122,'Leavin MK2',10,NULL,13,'01:43','assets/music/Asphalt/MK2 - Leavin.mp3',1,13),(123,'Shreyas Mehta',10,NULL,13,'02:16','assets/music/Asphalt/shreyas mehta.mp3.mp3',1,15),(124,'Smart Riot Huma Huma',10,NULL,13,'01:54','assets/music/Asphalt/Smart-Riot-Huma-Huma.mp3',1,9),(125,'High Score Teminite & Panda Eyes',10,NULL,13,'04:15','assets/music/Asphalt/Teminite & Panda Eyes - High Score.mp3',1,7),(126,'Hey Now MK2',10,NULL,13,'02:12','assets/music/Asphalt/Hey Now - MK2.mp3',1,4),(127,'HTT PLETHORE VS ENZO FERRARI MAX PRO',10,NULL,13,'02:24','assets/music/Asphalt/HTT PLETHORE VS ENZO FERRARI MAX PRO.mp3',1,6),(128,'Summertime K-391',10,NULL,13,'04:45','assets/music/Asphalt/K-391 - Summertime.mp3',1,8),(139,'Tsunami DVBBS & amp Borgeous ',10,NULL,14,'04:04','assets/music/Asphalt/DVBBS & amp Borgeous - Tsunami.mp3',1,9),(140,'Pyramids DVBBS & Dropgun ',10,NULL,14,'03:20','assets/music/Asphalt/DVBBS & Dropgun - Pyramids.mp3',1,3),(141,'Pulse Electronic music',10,NULL,14,'05:48','assets/music/Asphalt/Electronic Music - Pulse.mp3',1,5),(142,'Epic and Dramatic Trailer Music',10,NULL,14,'02:41','assets/music/Asphalt/Epic and Dramatic Trailer Music.mp3',1,9),(143,'Exclusion - Spacepark',10,NULL,14,'03:48','assets/music/Asphalt/Exclusion - Spacepark.mp3',1,7),(144,'Far Away',10,NULL,14,'01:46','assets/music/Asphalt/Far Away.mp3',1,7),(145,'GTA San Andreas Theme Song ',10,NULL,14,'06:10','assets/music/Asphalt/GTA San Andreas Theme Song Full ! !.mp3',1,4),(146,'Alternate - Vibe tracks',10,NULL,14,'02:53','assets/music/Asphalt/Alternate - Vibe tracks.mp3',1,7),(147,'Blank - Disfigure',10,NULL,14,'03:29','assets/music/Asphalt/Disfigure - Blank.mp3',1,7),(148,'Entropy - Distrion & Alex Skrindo ',10,NULL,14,'03:17','assets/music/Asphalt/Distrion & Alex Skrindo - Entropy.mp3',1,5),(149,'Youngblood',11,NULL,15,'3:24','assets/music/5SOS/01 Youngblood.mp3',1,35),(150,'Want You Back',11,NULL,15,'2:53','assets/music/5SOS/02 Want You Back.mp3',2,13),(151,'Lie To Me',11,NULL,15,'2:31','assets/music/5SOS/03 Lie To Me.mp3',3,21),(152,'Valentine',11,NULL,15,'3:17','assets/music/5SOS/04 Valentine.mp3',4,10),(153,'Talk Fast',11,NULL,15,'3:07','assets/music/5SOS/05 Talk Fast.mp3',5,6),(154,'Moving Along',11,NULL,15,'3:18','assets/music/5SOS/06 Moving Along.mp3',6,8),(155,'If Walls Could Talk',11,NULL,15,'3:02','assets/music/5SOS/07 If Walls Could Talk.mp3',7,12),(156,'Better Man',11,NULL,15,'3:10','assets/music/5SOS/08 Better Man.mp3',8,9),(157,'More',11,NULL,15,'3:14','assets/music/5SOS/09 More.mp3',9,7),(158,'Why Won\'t You Love Me',11,NULL,15,'3:21','assets/music/5SOS/10 Why Won’t You Love Me.mp3',10,2),(159,'Woke Up In Japan',11,NULL,15,'2:37','assets/music/5SOS/11 Woke Up In Japan.mp3',11,4),(160,'Empty Wallets',11,NULL,15,'3:08','assets/music/5SOS/12 Empty Wallets.mp3',12,2),(161,'Ghost Of You',11,NULL,15,'3:18','assets/music/5SOS/13 Ghost Of You.mp3',13,5),(162,'Monster Among Men',11,NULL,15,'3:13','assets/music/5SOS/14 Monster Among Men.mp3',14,4),(163,'Meet You There',11,NULL,15,'3:11','assets/music/5SOS/15 Meet You There.mp3',15,3),(164,'Babylon',11,NULL,15,'3:33','assets/music/5SOS/16 Babylon.mp3',16,7),(165,'Do I Wanna Know',25,NULL,20,'4:33','assets/music/Arctic Monkeys/Do I Wanna Know.mp3',1,31),(166,'Show \'Em (What You\'re Made Of)',27,NULL,21,'03:44','assets/music/Backstreet Boys/Show \'Em (What You\'re Made Of).mp3',1,32);
/*!40000 ALTER TABLE `songs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(32) NOT NULL,
  `signUpDate` datetime NOT NULL,
  `profilePic` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'himansh','Himanshu','Kanda','hylobatin@gmail.com','2c9341ca4cf3d87b9e4eb905d6a3ec45','2018-10-14 00:00:00','assets/images/profile-pics/head_emerald.png'),(3,'rajiv','Rajiv','Raj','Raju@gmail.com','2c9341ca4cf3d87b9e4eb905d6a3ec45','2018-11-22 00:00:00','assets/images/profile-pics/head_emerald.png'),(20,'HimanshuK','Himanshu','Kanda','Himanshu@outlook.com','2c9341ca4cf3d87b9e4eb905d6a3ec45','2023-06-22 00:00:00','assets/images/profile-pics/head_emerald.png');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-09-02 17:58:12
CREATE DATABASE  IF NOT EXISTS `musette_user_data` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `musette_user_data`;
-- MySQL dump 10.13  Distrib 8.0.33, for macos13 (arm64)
--
-- Host: localhost    Database: musette_user_data
-- ------------------------------------------------------
-- Server version	8.0.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `currentplaylist`
--

DROP TABLE IF EXISTS `currentplaylist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `currentplaylist` (
  `songId` int unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`songId`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currentplaylist`
--

LOCK TABLES `currentplaylist` WRITE;
/*!40000 ALTER TABLE `currentplaylist` DISABLE KEYS */;
INSERT INTO `currentplaylist` VALUES (166,'HimanshuK');
/*!40000 ALTER TABLE `currentplaylist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `himanshuk`
--

DROP TABLE IF EXISTS `himanshuk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `himanshuk` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `library` int DEFAULT NULL,
  `album` int DEFAULT NULL,
  `artist` int DEFAULT NULL,
  `plays` int NOT NULL DEFAULT '0',
  `albumorder` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `himanshuk`
--

LOCK TABLES `himanshuk` WRITE;
/*!40000 ALTER TABLE `himanshuk` DISABLE KEYS */;
INSERT INTO `himanshuk` VALUES (1,23,2,5,2,1),(2,24,2,5,0,2),(3,25,2,5,1,3),(4,27,2,5,1,5),(5,149,15,11,7,1),(6,151,15,11,2,3),(7,156,15,11,2,8),(8,166,21,27,2,1);
/*!40000 ALTER TABLE `himanshuk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recentlyplayed`
--

DROP TABLE IF EXISTS `recentlyplayed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recentlyplayed` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `typesid` int DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `time` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recentlyplayed`
--

LOCK TABLES `recentlyplayed` WRITE;
/*!40000 ALTER TABLE `recentlyplayed` DISABLE KEYS */;
INSERT INTO `recentlyplayed` VALUES (1,15,'album','himanshuji','2023-06-22'),(2,15,'album','himanshuji','2023-06-22'),(3,15,'album','himanshuji','2023-06-22'),(4,18,'album','himanshuji','2023-09-01'),(5,18,'album','himanshuji','2023-09-01'),(6,17,'album','himanshuji','2023-09-01'),(7,20,'album','himanshuji','2023-09-01'),(8,53,'playlist','himanshuji','2023-09-01'),(9,20,'album','himanshuji','2023-09-01'),(10,18,'album','himanshuji','2023-09-01'),(11,20,'album','himanshuji','2023-09-01'),(12,15,'album','himanshuji','2023-09-01'),(13,20,'album','himanshuji','2023-09-01'),(14,20,'album','himanshuji','2023-09-01'),(15,20,'album','himanshuji','2023-09-01'),(16,20,'album','himanshuji','2023-09-01'),(17,20,'album','himanshuji','2023-09-01'),(18,15,'album','himanshuji','2023-09-01'),(19,5,'artist','himanshuji','2023-09-02'),(20,11,'artist','himanshuji','2023-09-02'),(21,20,'album','HimanshuK','2023-09-02'),(22,20,'album','HimanshuK','2023-09-02'),(23,15,'album','HimanshuK','2023-09-02'),(24,21,'album','HimanshuK','2023-09-02');
/*!40000 ALTER TABLE `recentlyplayed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `savedplaylist`
--

DROP TABLE IF EXISTS `savedplaylist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `savedplaylist` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(25) DEFAULT NULL,
  `playlistId` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `savedplaylist`
--

LOCK TABLES `savedplaylist` WRITE;
/*!40000 ALTER TABLE `savedplaylist` DISABLE KEYS */;
INSERT INTO `savedplaylist` VALUES (1,'himanshuji',52),(3,'himanshuji',39);
/*!40000 ALTER TABLE `savedplaylist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-09-02 17:58:12
