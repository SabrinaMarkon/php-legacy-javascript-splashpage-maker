-- MySQL dump 10.13  Distrib 5.5.40, for Linux (x86_64)
--
-- Host: localhost    Database: phpsites_demosplashpagesite
-- ------------------------------------------------------
-- Server version	5.5.40-cll

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adminnavigation`
--

DROP TABLE IF EXISTS `adminnavigation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminnavigation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adminnavtitle` varchar(255) NOT NULL,
  `adminnavurl` varchar(255) NOT NULL,
  `adminnavwindow` varchar(255) NOT NULL DEFAULT '_top',
  `adminnavenabled` varchar(4) NOT NULL DEFAULT 'yes',
  `adminnavsequence` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminnavigation`
--

LOCK TABLES `adminnavigation` WRITE;
/*!40000 ALTER TABLE `adminnavigation` DISABLE KEYS */;
INSERT INTO `adminnavigation` (`id`, `adminnavtitle`, `adminnavurl`, `adminnavwindow`, `adminnavenabled`, `adminnavsequence`) VALUES (1,'MAIN SITE','http://demosplashpagesite.phpsitescripts.com','_blank','yes',1),(2,'ADMIN MAIN','controlpanel.php','_top','yes',2),(3,'SITE SETTINGS','sitecontrol.php','_top','yes',3),(4,'MEMBER ACCOUNTS','membercontrol.php','_top','yes',4),(5,'SPLASHPAGE CONTROL','splashpagecontrol.php','_top','yes',5),(6,'EDIT PAGE HTML','editpages.php','_top','yes',6),(7,'LOG OUT','index.php?action=logout','_top','yes',7);
/*!40000 ALTER TABLE `adminnavigation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adminnotes`
--

DROP TABLE IF EXISTS `adminnotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminnotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL DEFAULT '',
  `htmlcode` longtext NOT NULL,
  KEY `index` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminnotes`
--

LOCK TABLES `adminnotes` WRITE;
/*!40000 ALTER TABLE `adminnotes` DISABLE KEYS */;
INSERT INTO `adminnotes` (`id`, `name`, `htmlcode`) VALUES (1,'Admin Notes','Jack');
/*!40000 ALTER TABLE `adminnotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adminsettings`
--

DROP TABLE IF EXISTS `adminsettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminsettings` (
  `name` varchar(255) NOT NULL,
  `setting` varchar(255) NOT NULL,
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminsettings`
--

LOCK TABLES `adminsettings` WRITE;
/*!40000 ALTER TABLE `adminsettings` DISABLE KEYS */;
INSERT INTO `adminsettings` (`name`, `setting`) VALUES ('row1','x'),('adminuserid','Admin'),('adminpassword','admin'),('adminmemberuserid','YOUR MEMBER USERID IN THE SITE'),('adminname','YOUR NAME'),('domain','http://demosplashpagesite.phpsitescripts.com'),('sitename','Splashpage Creator and Management Demo'),('adminemail','YOUR ADMIN SUPPORT EMAIL'),('editpageshtmleditor','yes');
/*!40000 ALTER TABLE `adminsettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adminsplashpages`
--

DROP TABLE IF EXISTS `adminsplashpages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminsplashpages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `foldername` varchar(255) NOT NULL,
  `splashpagehtml` longtext NOT NULL,
  `paymentbuttoncode` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminsplashpages`
--

LOCK TABLES `adminsplashpages` WRITE;
/*!40000 ALTER TABLE `adminsplashpages` DISABLE KEYS */;
INSERT INTO `adminsplashpages` (`id`, `name`, `foldername`, `splashpagehtml`, `paymentbuttoncode`) VALUES (2,'Spashpage Test','FolderTest','<link rel=\"stylesheet\" type=\"text/css\" href=\"http://demosplashpagesite.phpsitescripts.com/styles.css\"><link href=\"/styles.css\" rel=\"stylesheet\" type=\"text/css\" /><link href=\"/styles.css\" rel=\"stylesheet\" type=\"text/css\" /><link href=\"/styles.css\" rel=\"stylesheet\" type=\"text/css\" /><link href=\"/styles.css\" rel=\"stylesheet\" type=\"text/css\" /><link href=\"/styles.css\" rel=\"stylesheet\" type=\"text/css\" /><link href=\"/styles.css\" rel=\"stylesheet\" type=\"text/css\" /><link href=\"/styles.css\" rel=\"stylesheet\" type=\"text/css\" /><p align=\"center\"><font size=\"6\" color=\"#FF0000\" face=\"tahoma,arial,helvetica,sans-serif\">testing</font></p><p align=\"center\">~AFFILIATE_URL~</p><p align=\"center\">&nbsp;~PAYMENT_BUTTON_CODE~</p><p>&nbsp;</p><p>&nbsp;</p>','<b>Paste your PayPal button code here. Members can change this to their own PayPal button.</b>');
/*!40000 ALTER TABLE `adminsplashpages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(64) NOT NULL DEFAULT '',
  `iso_code2` char(2) NOT NULL DEFAULT '',
  `iso_code3` char(3) NOT NULL DEFAULT '',
  `reserved1` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`country_id`),
  KEY `IDX_COUNTRIES_NAME` (`country_name`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`country_id`, `country_name`, `iso_code2`, `iso_code3`, `reserved1`) VALUES (1,'Afghanistan','AF','AFG',0),(2,'Albania','AL','ALB',0),(3,'Algeria','DZ','DZA',0),(4,'American Samoa','AS','ASM',0),(5,'Andorra','AD','AND',0),(6,'Angola','AO','AGO',0),(7,'Anguilla','AI','AIA',0),(8,'Antarctica','AQ','ATA',0),(9,'Antigua and Barbuda','AG','ATG',0),(10,'Argentina','AR','ARG',0),(11,'Armenia','AM','ARM',0),(12,'Aruba','AW','ABW',0),(13,'Australia','AU','AUS',0),(14,'Austria','AT','AUT',0),(15,'Azerbaijan','AZ','AZE',0),(16,'Bahamas','BS','BHS',0),(17,'Bahrain','BH','BHR',0),(18,'Bangladesh','BD','BGD',0),(19,'Barbados','BB','BRB',0),(20,'Belarus','BY','BLR',0),(21,'Belgium','BE','BEL',0),(22,'Belize','BZ','BLZ',0),(23,'Benin','BJ','BEN',0),(24,'Bermuda','BM','BMU',0),(25,'Bhutan','BT','BTN',0),(26,'Bolivia','BO','BOL',0),(27,'Bosnia and Herzegowina','BA','BIH',0),(28,'Botswana','BW','BWA',0),(29,'Bouvet Island','BV','BVT',0),(30,'Brazil','BR','BRA',0),(31,'British Indian Ocean Territory','IO','IOT',0),(32,'Brunei Darussalam','BN','BRN',0),(33,'Bulgaria','BG','BGR',0),(34,'Burkina Faso','BF','BFA',0),(35,'Burundi','BI','BDI',0),(36,'Cambodia','KH','KHM',0),(37,'Cameroon','CM','CMR',0),(38,'Canada','CA','CAN',0),(39,'Cape Verde','CV','CPV',0),(40,'Cayman Islands','KY','CYM',0),(41,'Central African Republic','CF','CAF',0),(42,'Chad','TD','TCD',0),(43,'Chile','CL','CHL',0),(44,'China','CN','CHN',0),(45,'Christmas Island','CX','CXR',0),(46,'Cocos (Keeling) Islands','CC','CCK',0),(47,'Colombia','CO','COL',0),(48,'Comoros','KM','COM',0),(49,'Congo','CG','COG',0),(50,'Cook Islands','CK','COK',0),(51,'Costa Rica','CR','CRI',0),(52,'Cote D\'Ivoire','CI','CIV',0),(53,'Croatia','HR','HRV',0),(54,'Cuba','CU','CUB',0),(55,'Cyprus','CY','CYP',0),(56,'Czech Republic','CZ','CZE',0),(57,'Denmark','DK','DNK',0),(58,'Djibouti','DJ','DJI',0),(59,'Dominica','DM','DMA',0),(60,'Dominican Republic','DO','DOM',0),(61,'East Timor','TP','TMP',0),(62,'Ecuador','EC','ECU',0),(63,'Egypt','EG','EGY',0),(64,'El Salvador','SV','SLV',0),(65,'Equatorial Guinea','GQ','GNQ',0),(66,'Eritrea','ER','ERI',0),(67,'Estonia','EE','EST',0),(68,'Ethiopia','ET','ETH',0),(69,'Falkland Islands (Malvinas)','FK','FLK',0),(70,'Faroe Islands','FO','FRO',0),(71,'Fiji','FJ','FJI',0),(72,'Finland','FI','FIN',0),(73,'France','FR','FRA',0),(74,'France, Metropolitan','FX','FXX',0),(75,'French Guiana','GF','GUF',0),(76,'French Polynesia','PF','PYF',0),(77,'French Southern Territories','TF','ATF',0),(78,'Gabon','GA','GAB',0),(79,'Gambia','GM','GMB',0),(80,'Georgia','GE','GEO',0),(81,'Germany','DE','DEU',0),(82,'Ghana','GH','GHA',0),(83,'Gibraltar','GI','GIB',0),(84,'Greece','GR','GRC',0),(85,'Greenland','GL','GRL',0),(86,'Grenada','GD','GRD',0),(87,'Guadeloupe','GP','GLP',0),(88,'Guam','GU','GUM',0),(89,'Guatemala','GT','GTM',0),(90,'Guinea','GN','GIN',0),(91,'Guinea-bissau','GW','GNB',0),(92,'Guyana','GY','GUY',0),(93,'Haiti','HT','HTI',0),(94,'Heard and Mc Donald Islands','HM','HMD',0),(95,'Honduras','HN','HND',0),(96,'Hong Kong','HK','HKG',0),(97,'Hungary','HU','HUN',0),(98,'Iceland','IS','ISL',0),(99,'India','IN','IND',0),(100,'Indonesia','ID','IDN',0),(101,'Iran (Islamic Republic of)','IR','IRN',0),(102,'Iraq','IQ','IRQ',0),(103,'Ireland','IE','IRL',0),(104,'Israel','IL','ISR',0),(105,'Italy','IT','ITA',0),(106,'Jamaica','JM','JAM',0),(107,'Japan','JP','JPN',0),(108,'Jordan','JO','JOR',0),(109,'Kazakhstan','KZ','KAZ',0),(110,'Kenya','KE','KEN',0),(111,'Kiribati','KI','KIR',0),(112,'Korea','KP','PRK',0),(114,'Kuwait','KW','KWT',0),(115,'Kyrgyzstan','KG','KGZ',0),(116,'Lao People\'s Democratic Republic','LA','LAO',0),(117,'Latvia','LV','LVA',0),(118,'Lebanon','LB','LBN',0),(119,'Lesotho','LS','LSO',0),(120,'Liberia','LR','LBR',0),(121,'Libyan Arab Jamahiriya','LY','LBY',0),(122,'Liechtenstein','LI','LIE',0),(123,'Lithuania','LT','LTU',0),(124,'Luxembourg','LU','LUX',0),(125,'Macau','MO','MAC',0),(126,'Macedonia','MK','MKD',0),(127,'Madagascar','MG','MDG',0),(128,'Malawi','MW','MWI',0),(129,'Malaysia','MY','MYS',0),(130,'Maldives','MV','MDV',0),(131,'Mali','ML','MLI',0),(132,'Malta','MT','MLT',0),(133,'Marshall Islands','MH','MHL',0),(134,'Martinique','MQ','MTQ',0),(135,'Mauritania','MR','MRT',0),(136,'Mauritius','MU','MUS',0),(137,'Mayotte','YT','MYT',0),(138,'Mexico','MX','MEX',0),(139,'Micronesia, Federated States of','FM','FSM',0),(140,'Moldova, Republic of','MD','MDA',0),(141,'Monaco','MC','MCO',0),(142,'Mongolia','MN','MNG',0),(143,'Montserrat','MS','MSR',0),(144,'Morocco','MA','MAR',0),(145,'Mozambique','MZ','MOZ',0),(146,'Myanmar','MM','MMR',0),(147,'Namibia','NA','NAM',0),(148,'Nauru','NR','NRU',0),(149,'Nepal','NP','NPL',0),(150,'Netherlands','NL','NLD',0),(151,'Netherlands Antilles','AN','ANT',0),(152,'New Caledonia','NC','NCL',0),(153,'New Zealand','NZ','NZL',0),(154,'Nicaragua','NI','NIC',0),(155,'Niger','NE','NER',0),(156,'Nigeria','NG','NGA',0),(157,'Niue','NU','NIU',0),(158,'Norfolk Island','NF','NFK',0),(159,'Northern Mariana Islands','MP','MNP',0),(160,'Norway','NO','NOR',0),(161,'Oman','OM','OMN',0),(162,'Pakistan','PK','PAK',0),(163,'Palau','PW','PLW',0),(164,'Panama','PA','PAN',0),(165,'Papua New Guinea','PG','PNG',0),(166,'Paraguay','PY','PRY',0),(167,'Peru','PE','PER',0),(168,'Philippines','PH','PHL',0),(169,'Pitcairn','PN','PCN',0),(170,'Poland','PL','POL',0),(171,'Portugal','PT','PRT',0),(172,'Puerto Rico','PR','PRI',0),(173,'Qatar','QA','QAT',0),(174,'Reunion','RE','REU',0),(175,'Romania','RO','ROM',0),(176,'Russian Federation','RU','RUS',0),(177,'Rwanda','RW','RWA',0),(178,'Saint Kitts and Nevis','KN','KNA',0),(179,'Saint Lucia','LC','LCA',0),(180,'Saint Vincent and the Grenadines','VC','VCT',0),(181,'Samoa','WS','WSM',0),(182,'San Marino','SM','SMR',0),(183,'Sao Tome and Principe','ST','STP',0),(184,'Saudi Arabia','SA','SAU',0),(185,'Senegal','SN','SEN',0),(186,'Seychelles','SC','SYC',0),(187,'Sierra Leone','SL','SLE',0),(188,'Singapore','SG','SGP',0),(189,'Slovakia (Slovak Republic)','SK','SVK',0),(190,'Slovenia','SI','SVN',0),(191,'Solomon Islands','SB','SLB',0),(192,'Somalia','SO','SOM',0),(193,'South Africa','ZA','ZAF',0),(194,'South Georgia','GS','SGS',0),(195,'Spain','ES','ESP',0),(196,'Sri Lanka','LK','LKA',0),(197,'St. Helena','SH','SHN',0),(198,'St. Pierre and Miquelon','PM','SPM',0),(199,'Sudan','SD','SDN',0),(200,'Suriname','SR','SUR',0),(201,'Svalbard and Jan Mayen Islands','SJ','SJM',0),(202,'Swaziland','SZ','SWZ',0),(203,'Sweden','SE','SWE',0),(204,'Switzerland','CH','CHE',0),(205,'Syrian Arab Republic','SY','SYR',0),(206,'Taiwan','TW','TWN',0),(207,'Tajikistan','TJ','TJK',0),(208,'Tanzania, United Republic of','TZ','TZA',0),(209,'Thailand','TH','THA',0),(210,'Togo','TG','TGO',0),(211,'Tokelau','TK','TKL',0),(212,'Tonga','TO','TON',0),(213,'Trinidad and Tobago','TT','TTO',0),(214,'Tunisia','TN','TUN',0),(215,'Turkey','TR','TUR',0),(216,'Turkmenistan','TM','TKM',0),(217,'Turks and Caicos Islands','TC','TCA',0),(218,'Tuvalu','TV','TUV',0),(219,'Uganda','UG','UGA',0),(220,'Ukraine','UA','UKR',0),(221,'United Arab Emirates','AE','ARE',0),(222,'United Kingdom','GB','GBR',0),(223,'United States','US','USA',0),(224,'United States Minor Outlying Islands','UM','UMI',0),(225,'Uruguay','UY','URY',0),(226,'Uzbekistan','UZ','UZB',0),(227,'Vanuatu','VU','VUT',0),(228,'Vatican City State (Holy See)','VA','VAT',0),(229,'Venezuela','VE','VEN',0),(230,'Viet Nam','VN','VNM',0),(231,'Virgin Islands (British)','VG','VGB',0),(232,'Virgin Islands (U.S.)','VI','VIR',0),(233,'Wallis and Futuna Islands','WF','WLF',0),(234,'Western Sahara','EH','ESH',0),(235,'Yemen','YE','YEM',0),(236,'Yugoslavia','YU','YUG',0),(237,'Zaire','ZR','ZAR',0),(238,'Zambia','ZM','ZMB',0),(239,'Zimbabwe','ZW','ZWE',0);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membernavigation`
--

DROP TABLE IF EXISTS `membernavigation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membernavigation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `membernavtitle` varchar(255) NOT NULL,
  `membernavurl` varchar(255) NOT NULL,
  `membernavwindow` varchar(255) NOT NULL DEFAULT '_top',
  `membernavenabled` varchar(4) NOT NULL DEFAULT 'yes',
  `membernavsequence` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membernavigation`
--

LOCK TABLES `membernavigation` WRITE;
/*!40000 ALTER TABLE `membernavigation` DISABLE KEYS */;
INSERT INTO `membernavigation` (`id`, `membernavtitle`, `membernavurl`, `membernavwindow`, `membernavenabled`, `membernavsequence`) VALUES (1,'ACCOUNT','members.php','_top','yes',1),(2,'PROFILE','profile.php','_top','yes',2),(3,'SPLASHPAGES','splashpages.php','_top','yes',3),(4,'DELETE ACCOUNT','delete.php','_top','yes',4),(5,'LOG OUT','http://demosplashpagesite.phpsitescripts.com','_top','yes',5);
/*!40000 ALTER TABLE `membernavigation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `signupdate` datetime NOT NULL,
  `signupip` varchar(255) NOT NULL,
  `verified` varchar(4) NOT NULL DEFAULT 'no',
  `verifieddate` datetime NOT NULL,
  `referid` varchar(255) NOT NULL,
  `lastlogin` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` (`id`, `userid`, `password`, `firstname`, `lastname`, `email`, `signupdate`, `signupip`, `verified`, `verifieddate`, `referid`, `lastlogin`) VALUES (1,'demomember','demopass','Demo','Member','webmaster@pearlsofwealth.com','2014-09-14 00:00:00','127.0.0.1','yes','2014-09-14 00:00:00','','2015-04-27 22:17:25');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membersplashpages`
--

DROP TABLE IF EXISTS `membersplashpages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membersplashpages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `foldername` varchar(255) NOT NULL,
  `splashpagehtml` longtext NOT NULL,
  `paymentbuttoncode` longtext NOT NULL,
  `memberurl` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membersplashpages`
--

LOCK TABLES `membersplashpages` WRITE;
/*!40000 ALTER TABLE `membersplashpages` DISABLE KEYS */;
INSERT INTO `membersplashpages` (`id`, `userid`, `name`, `foldername`, `splashpagehtml`, `paymentbuttoncode`, `memberurl`) VALUES (8,'demomember','Spashpage Test','FolderTest','<link href=\"/styles.css\" type=\"text/css\" rel=\"stylesheet\" /><link href=\"/styles.css\" type=\"text/css\" rel=\"stylesheet\" /><link href=\"/styles.css\" type=\"text/css\" rel=\"stylesheet\" /><link href=\"/styles.css\" type=\"text/css\" rel=\"stylesheet\" /><link href=\"/styles.css\" type=\"text/css\" rel=\"stylesheet\" /><link href=\"/styles.css\" type=\"text/css\" rel=\"stylesheet\" /><link href=\"/styles.css\" type=\"text/css\" rel=\"stylesheet\" /><link href=\"/styles.css\" type=\"text/css\" rel=\"stylesheet\" /><p align=\"center\"><font color=\"#FF0000\" face=\"tahoma,arial,helvetica,sans-serif\" size=\"6\">testing</font></p><p align=\"center\">~AFFILIATE_URL~</p><p align=\"center\">&nbsp;~PAYMENT_BUTTON_CODE~</p><p align=\"center\">&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p><span style=\"white-space: pre\" class=\"Apple-tab-span\">	</span><title></title></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><h2 style=\"text-align: center\">PTC HUB Presents</h2><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><h2 style=\"text-align: center\">EVOLUTION</h2><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p style=\"text-align: center\"><span style=\"font-size: 26px\"><b>Of Financial Freedom</b></span></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p style=\"text-align: center\">Get Paid To Click&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p style=\"text-align: center\">Advertise&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p style=\"text-align: center\">And So Much More...</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><div><br /></div>','<b>Paste your PayPal button code here. Members can change this to their own PayPal button.</b>','www.ptchub.info');
/*!40000 ALTER TABLE `membersplashpages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `htmlcode` longtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id`, `name`, `htmlcode`) VALUES (1,'Home Page','test'),(2,'Login Page',''),(3,'Members Area Main Page','linknk&ntilde;n&ntilde;knm&ntilde;lmn&ntilde;lm&ntilde;ojp9u jupi vygi'),(4,'Members Area Profile Page',''),(5,'Members Area Splashpages',''),(6,'Registration Page',''),(7,'Thank You Page - New Member Signup',''),(8,'Terms and Conditions','');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'phpsites_demosplashpagesite'
--

--
-- Dumping routines for database 'phpsites_demosplashpagesite'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-30  9:49:21
