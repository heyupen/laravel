-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: forge
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.18.04.1

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
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banca` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomeintestatario` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cognomeintestatario` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contocarta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mesescadenza` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annoscadenza` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cab` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipologiapagamento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idtipologiacliente` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pivacf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `indirizzo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localita` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comune` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provincia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stato` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Telecom64 International LLC','9960903','haifojw0','info@telecom64.com','','','','','','','','','','','','1','2','212','','10000000000','9 East Loockerman St., Suite 3A','Dover','comune estero','EE','Italia','19901','2018-07-10 09:18:32','2018-07-10 09:18:32'),(2,'Merito Srl','1484707','06gh0s85','sergio.rossi@meritoconcorsi.it','','','','','','','','','','','','5','2','3457352348','','02290620992','Piazza Colombo, 4/15','Genova','GENOVA','GE','Italia','16121','2018-07-12 16:23:38','2018-07-12 16:23:38'),(3,'Alltre S.r.l.','8681149','6w2uu0dw','info@all3.biz','','','','','','','','','','','','1','2','0109848688','0109848628','01785430990','Piazza De Marini, 1/24 C','Genova','GENOVA','GE','Italia','16124','2019-09-24 15:39:05','2019-09-24 15:39:05');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2018_03_27_134232_create_users_table',1),(2,'2018_03_30_024832_create_clients_table',1),(3,'2018_03_30_024856_create_offers_table',1),(4,'2018_03_30_024857_create_service_categories_table',1),(5,'2018_03_30_024859_create_services_table',1),(6,'2018_03_30_151337_create_offer_service_table',1),(7,'2018_03_31_123644_alter_offer_table_status',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer_service`
--

DROP TABLE IF EXISTS `offer_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offer_service` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `offer_id` int(10) unsigned NOT NULL,
  `service_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offer_service_offer_id_foreign` (`offer_id`),
  KEY `offer_service_service_id_foreign` (`service_id`),
  CONSTRAINT `offer_service_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`),
  CONSTRAINT `offer_service_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer_service`
--

LOCK TABLES `offer_service` WRITE;
/*!40000 ALTER TABLE `offer_service` DISABLE KEYS */;
INSERT INTO `offer_service` VALUES (1,1,5,NULL,NULL),(2,1,80,NULL,NULL),(3,1,80,NULL,NULL),(5,1,4,NULL,NULL);
/*!40000 ALTER TABLE `offer_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pdf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `client_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('In creazione','Creata','Firmata') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Creata',
  PRIMARY KEY (`id`),
  KEY `offers_user_id_foreign` (`user_id`),
  KEY `offers_client_id_foreign` (`client_id`),
  CONSTRAINT `offers_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `offers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offers`
--

LOCK TABLES `offers` WRITE;
/*!40000 ALTER TABLE `offers` DISABLE KEYS */;
INSERT INTO `offers` VALUES (1,'hEyg9P73mLJTQ3V9ZQv7hu56Nm7Jkb',2,3,'2018-07-10 06:37:33','2019-12-07 21:46:53','Creata'),(2,'fv135VZtUIbFO3BUY1Q9XySPJw54ax',1,1,'2018-07-10 09:18:08','2018-07-10 09:18:32','In creazione'),(3,'lz9Y47QnxnbcIH14u5fE9zAEohJimE',2,NULL,'2019-12-07 22:03:10','2019-12-07 22:03:10','In creazione');
/*!40000 ALTER TABLE `offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_categories`
--

DROP TABLE IF EXISTS `service_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_categories`
--

LOCK TABLES `service_categories` WRITE;
/*!40000 ALTER TABLE `service_categories` DISABLE KEYS */;
INSERT INTO `service_categories` VALUES (1,'Voce voip aziende','2018-07-10 06:37:34','2018-07-10 06:37:34'),(2,'Verde 800 voip','2018-07-10 06:37:34','2018-07-10 06:37:34'),(3,'Verde 800','2018-07-10 06:37:34','2018-07-10 06:37:34'),(4,'Fax to mail','2018-07-10 06:37:34','2018-07-10 06:37:34'),(5,'Virtual disk','2018-07-10 06:37:34','2018-07-10 06:37:34'),(6,'Mail to fax liste','2018-07-10 06:37:34','2018-07-10 06:37:34'),(7,'Numero geografico PRI','2018-07-10 06:37:34','2018-07-10 06:37:34'),(8,'Numero geografico multiplo','2018-07-10 06:37:35','2018-07-10 06:37:35'),(9,'UNlimited SOLO V','2018-07-10 06:37:35','2018-07-10 06:37:35'),(10,'Mobile (ATR)','2018-07-10 06:37:35','2018-07-10 06:37:35'),(11,'Unlimited SOLO D','2018-07-10 06:37:35','2018-07-10 06:37:35'),(12,'Fritz Station','2018-07-10 06:37:35','2018-07-10 06:37:35'),(13,'Backup dati promo','2018-07-10 06:37:35','2018-07-10 06:37:35'),(14,'Backup dati','2018-07-10 06:37:35','2018-07-10 06:37:35');
/*!40000 ALTER TABLE `service_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `mandatory` int(11) DEFAULT NULL,
  `service_category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_service_category_id_foreign` (`service_category_id`),
  CONSTRAINT `services_service_category_id_foreign` FOREIGN KEY (`service_category_id`) REFERENCES `service_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Una tantum attivazione (per linea)',0.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedavoip.pdf',0,1,1,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(2,'null',0.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedavoip.pdf',0,1,1,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(3,'Setup servizio',50.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumverde.pdf',0,1,2,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(4,'Canone mensile',150.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumverde.pdf',0,1,2,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(5,'Canone mensile',150.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumverde.pdf',0,1,3,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(6,'Setup servizio',50.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumverde.pdf',0,1,3,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(7,'Canone mensile numero verde internazionale',150.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumverde.pdf',0,1,3,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(8,'Una tantum attivazione del servizio',500.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumverde.pdf',0,1,3,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(9,'Canone mensile numero verde universale',300.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumverde.pdf',0,1,3,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(10,'Una tantum attivazione del servizio (per 5 paesi)',500.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumverde.pdf',0,1,3,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(11,'Una tantum attivazione del servizio (tutti i paesi)',250.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumverde.pdf',0,2,3,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(12,'Canone annuo servizio fax to mail',120.00,'','',0,1,4,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(13,'Una tantum NP non Telecom',30.00,'','',0,2,4,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(14,'Una tantum attivazione',60.00,'','',0,2,4,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(15,'Canone annuo PROMO 12 mesi',60.00,'','',0,1,4,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(16,'Una tantum NP non Telecom',20.00,'','',0,2,4,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(17,'Canone annuo servizio fax to mail',60.00,'','',0,1,4,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(18,'Una tantum attivazione',30.00,'','',0,2,4,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(19,'Una tantum attivazione fax to mail - PROMO 50',30.00,'','',0,2,4,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(20,'Una tantum attivazione number portability',15.00,'','',0,2,4,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(21,'Canone annuo servizio fax to mail - Ordine n. HCN 1700093 del 31/07/2017',73.75,'','',0,1,4,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(22,'Una tantum attivazione del servizio fax to mail - Ordine n. HCN 1700093 del 31/07/2017',290.00,'','',0,2,4,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(23,'Canone annuo spazio 10GB',60.00,'','',0,1,5,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(24,'Mail to fax liste - fino a 1000 pagine mese',70.00,'','',0,1,6,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(25,'Canone bimestrale numerazione GEO PRI 100 num',580.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumgeo.pdf',0,2,7,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(26,'Una tantum attivazione numerazione GEO PRI',100.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumgeo.pdf',0,2,7,'2018-07-10 06:37:34','2018-07-10 06:37:34'),(27,'Una tantum attivazione number portability GEO PRI',150.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumgeo.pdf',0,2,7,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(28,'Canone bimestrale numerazione GEO PRI 1000 num',580.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumgeo.pdf',0,2,7,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(29,'Canone bimestrale numerazione GEO PRI 10 num',300.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumgeo.pdf',0,2,7,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(30,'Una tantum attivazione numerazione',100.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumgeo.pdf',0,1,8,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(31,'Canone bimestrale numerazione',40.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumgeo.pdf',0,2,8,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(32,'Una tantum attivazione number portability',100.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumgeo.pdf',0,2,8,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(33,'Una tantum attivazione 10 numerazioni',10.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumgeo.pdf',0,1,8,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(34,'Canone mensile 10 numerazioni',30.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedanumgeo.pdf',0,2,8,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(35,'Canone bimestrale servizio UNlimited SOLO V1',60.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,1,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(36,'Traffico prepagato UNlimited SOLO V1',50.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,1,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(37,'Una tantum attivazione UNlimited SOLO V1',70.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,2,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(38,'Una tantum attivazione UNlimited SOLO V1 - sconto 50',35.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,2,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(39,'Canone bimestrale servizio UNlimited SOLO V2',110.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,1,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(40,'Traffico prepagato UNlimited SOLO V2',50.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,1,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(41,'Una tantum attivazione UNlimited SOLO V2',110.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,2,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(42,'Una tantum attivazione UNlimited SOLO V2 - sconto 50',55.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,2,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(43,'Canone bimestrale servizio UNlimited SOLO V3',160.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,1,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(44,'Traffico prepagato UNlimited SOLO V3',50.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,1,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(45,'Una tantum attivazione UNlimited SOLO V3',150.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,2,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(46,'Una tantum attivazione UNlimited SOLO V3 - sconto 50',75.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,2,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(47,'Canone bimestrale servizio UNlimited SOLO V4',210.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,1,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(48,'Traffico prepagato UNlimited SOLO V4',50.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,1,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(49,'Una tantum attivazione UNlimited SOLO V4',190.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,2,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(50,'Una tantum attivazione UNlimited SOLO V4 - sconto 50',95.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,2,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(51,'Canone bimestrale servizio UNlimited SOLO V6',310.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,1,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(52,'Traffico prepagato UNlimited SOLO V6',50.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,1,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(53,'Una tantum attivazione del servizio Unlimited SOLO V6',280.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,2,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(54,'Una tantum attivazione del servizio Unlimited SOLO V6 - sconto 50',140.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,2,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(55,'Canone bimestrale servizio UNlimited SOLO V8',420.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,1,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(56,'Traffico prepagato UNlimited SOLO V8',50.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,1,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(57,'Una tantum attivazione UNlimited SOLO V8',390.00,'','https://www.telecom64.eu/intranet/billing/schedetecniche/schedasolov.pdf',0,2,9,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(58,'Canone bimestrale servizio Mobile voce 400',32.00,'','',0,2,10,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(59,'Canone bimestrale servizio Mobile voce 1000',48.00,'','',0,2,10,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(60,'Canone bimestrale servizio Mobile UNlimited SOLO D Mobile 30GB',58.00,'','',0,2,10,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(61,'Tassa di concessione Governativa',25.82,'','',0,2,10,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(62,'Una tantum attivazione Mobile Voce 400',60.00,'','',0,2,10,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(63,'Una tantum attivazione Mobile Voce 1000',60.00,'','',0,2,10,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(64,'Una tantum attivazione UNlimited SOLO D Mobile',60.00,'','',0,2,10,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(65,'Canone bimestrale servizio UNlimited SOLO D IP',70.00,'','',0,2,10,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(66,'Una tantum attivazione del servizio SOLO D ADSL 12/1',170.00,'','',0,2,11,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(67,'Canone bimestrale servizio SOLO D ADSL 12/1',130.00,'','',0,2,11,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(68,'Una tantum attivazione del servizio SOLO D fibra',210.00,'','',0,2,11,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(69,'Canone bimestrale servizio SOLO D fibra 50/10',170.00,'','',0,2,11,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(70,'Canone bimestrale servizio 4 IP',12.00,'','',0,2,11,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(71,'Canone bimestrale servizio 8 IP',20.00,'','',0,2,11,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(72,'Canone bimestrale servizio 16 IP',36.00,'','',0,2,11,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(73,'Canone bimestrale servizio 1 IP',10.00,'','',0,2,11,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(74,'Una tantum attivazione servizio IP',40.00,'','',0,2,11,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(75,'Canone bimestrale servizio SOLO D HDSL 8/8',1200.00,'','',0,2,11,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(76,'Una tantum attivazione del servizio SOLO D HDSL 8/8',750.00,'','',0,2,11,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(77,'Canone bimestrale servizio SOLO D ADSL Light',98.00,'','',0,2,11,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(78,'Una tantum attivazione del servizio SOLO D  Light',170.00,'','',0,2,11,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(79,'Canone bimestrale servizio SOLO D fibra 100/20',188.00,'','',0,2,11,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(80,'Una tantum attivazione del servizio SOLO D HDSL 2/2',250.00,'','',0,2,11,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(81,'Canone bimestrale servizio SOLO D HDSL 2/2',360.00,'','',0,2,11,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(82,'Una tantum attivazione Fritz Station',190.00,'','',0,1,12,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(83,'Traffico prepagato Fritz Station',50.00,'','',0,1,12,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(84,'Canone bimestrale servizio Fritz Station',130.00,'','',0,1,12,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(85,'Canone bimestrale servizio Fritz Station',190.00,'','',0,1,12,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(86,'Una tantum attivazione Fritz Station',210.00,'','',0,1,12,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(87,'Canone bimestrale servizio Fritz Station',178.00,'','',0,1,12,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(88,'Canone bimestrale servizio Fritz Station',238.00,'','',0,1,12,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(89,'Canone bimestrale backup dati 50GB',72.00,'','',0,2,13,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(90,'Canone bimestrale backup dati 100GB',72.00,'','',0,2,13,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(91,'Canone bimestrale backup dati 200GB',130.00,'','',0,2,13,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(92,'Canone bimestrale backup dati 20GB',50.00,'','',0,2,13,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(93,'Backup dati 100GB',118.00,'','',0,2,14,'2018-07-10 06:37:35','2018-07-10 06:37:35'),(94,'Backup dati 200GB',198.00,'','',0,2,14,'2018-07-10 06:37:35','2018-07-10 06:37:35');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agenzia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `limit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'2439005','eyJpdiI6InV0b1hzV0RQQjB6NnVqWFoycUsxbVE9PSIsInZhbHVlIjoibjJzTHl5MVwvM1BJRm5hd2hKb3BPNHc9PSIsIm1hYyI6ImI3NTE5MTRjNzg3MWViMjRjYzlhZDJjNDBmN2UwMzIwNjZkYTMzZmMxMTdhNDViODcyMGZmODk5OWNjOGJhMjgifQ==','aw4nux4zeR7PlJZuoQUlW3Mm5HYQYfmXTGPF9nlYexVmlpdrk8REFJvI7SBNVGdEd2qHzfglhV8kIrjCqd08adEYOuoQf0Dj70wY',NULL,'Manuel Tadini','T4Tech','manuel.tadini@t4tech.it','manuel.tadini@t4tech.it','2018-07-09 09:53:11','2018-07-13 16:48:02'),(2,'4551872','eyJpdiI6IlhUZXlqemtFQjRUeWlMd0pBY0srMUE9PSIsInZhbHVlIjoibDdsWWllaTRJR2MrWURNOTU3UHpOQT09IiwibWFjIjoiMTgyZjE5ZWNlNGMxMWNlNDk2N2M1MjVjYjExYjFkMzEzOWY5MmY5MmI3NzkwYThlMmI1NGU4NzBiYTdjNzdhNSJ9','o2TNbmpMp52ays9ii1oAseRUSi9dapq1KLDJ3xXxbOrFKsAvdv36ThkFlYOKmQvDRRbxgrUqQhErnJ9Ejnyq8Tf8rIJpXGFdImyD',NULL,'Francesco Guarnaccia','Alltre S.r.l.','fguarnaccia@all3.biz','fguarnaccia@all3.biz','2018-07-10 06:37:22','2019-12-07 21:41:00');
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

-- Dump completed on 2019-12-08 20:58:36
