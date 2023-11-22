-- MySQL dump 10.13  Distrib 8.0.30, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: igoupos
-- ------------------------------------------------------
-- Server version	8.0.30-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `brand_id` bigint unsigned NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `accounts_user_id_foreign` (`user_id`),
  KEY `accounts_brand_id_foreign` (`brand_id`),
  CONSTRAINT `accounts_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,2,2,'AdminMarca',0.00,1,'2023-03-03 20:06:37','2023-03-03 20:06:37'),(2,3,2,'Vendedor',0.00,1,'2023-03-03 20:07:01','2023-03-03 20:07:01');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `balances`
--

DROP TABLE IF EXISTS `balances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `balances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` bigint unsigned NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `balance` decimal(8,2) NOT NULL,
  `operation` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `user_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `balances_brand_id_foreign` (`brand_id`),
  CONSTRAINT `balances_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `balances`
--

LOCK TABLES `balances` WRITE;
/*!40000 ALTER TABLE `balances` DISABLE KEYS */;
/*!40000 ALTER TABLE `balances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iccid_prefix` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_name_unique` (`name`),
  KEY `brands_parent_id_foreign` (`parent_id`),
  CONSTRAINT `brands_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Figou',NULL,'Marca principal de IGOU','89521400617',NULL,1,1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(2,'Be Online',1,'Alianza Be Online','89521400619',NULL,1,1,'2023-03-03 19:34:02','2023-03-03 19:34:02');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configurations`
--

DROP TABLE IF EXISTS `configurations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `configurations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'General',
  `is_protected` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `configurations_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configurations`
--

LOCK TABLES `configurations` WRITE;
/*!40000 ALTER TABLE `configurations` DISABLE KEYS */;
INSERT INTO `configurations` VALUES (1,'Sandbox','is_sandbox','true','General',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(2,'Notifications Email','notifications_email','roberto.guzman@leancommerce.mx','General',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(3,'Copomex Token','copomex_token','5b2e78a0-7c7a-4343-a684-64913f730fce','General',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(4,'Copomex Endpoint','copomex_endpoint','https://api.copomex.com/query/info_cp/','General',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(5,'Altan Auth Endpoint','altan_auth_endpoint','https://altanredes-prod.apigee.net/v1/oauth/accesstoken','Altan',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(6,'Altan Token','altan_token','MkdhcmtpenN1Y1d5ajVmRk5aQUNyQWY0d1RuZnEwYWY6a2JDQUVRTW05N3VlR3diRQ','Altan',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(7,'Altan Products Purchase Endpoint','altan_products_purchase_endpoint','https://altanredes-prod.apigee.net/cm/v1/products/purchase','Altan',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(8,'Altan Products Purchase Endpoint Sandbox','altan_products_purchase_endpoint_sandbox','https://altanredes-prod.apigee.net/cm-sandbox/v1/products/purchase','Altan',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(9,'Altan Device Info Endpoint','altan_device_info_endpoint','https://altanredes-prod.apigee.net/cm-360/v1/subscribers/getDeviceInformation','Altan',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(10,'Altan Default Identificator','altan_identificator','imei','Altan',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(11,'Qvantel Offering Endpoint','qvantel_offering_endpoint','https://mapp-figou-prod.qvantel.solutions/uc/v1/offerings','Qvantel',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(12,'Qvantel Offering Endpoint Sandbox','qvantel_offering_endpoint_sandbox','https://mapp-sayco-preprod.qvantel.systems/uc/v1/offerings','Qvantel',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(13,'Qvantel Baskets Endpoint','qvantel_baskets_endpoint','https://mapp-figou-prod.qvantel.solutions/uc/v0/v3/baskets','Qvantel',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(14,'Qvantel Baskets Endpoint Sandbox','qvantel_baskets_endpoint_sandbox','https://mapp-sayco-preprod.qvantel.systems/uc/v0/v3/baskets/','Qvantel',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(15,'Conekta Public API Key','conekta_public_api_key','key_WPMtkTdR3byEcEpuhLmDK05','Payment',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(16,'Conekta Private API Key','conekta_private_api_key','key_7QlMDKXdUviQ2J0MF4129uu','Payment',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(17,'Conekta Public API Key Sandbox','conekta_public_api_key_sandbox','key_C2d43JwSbu14usNnzhDIL8x','Payment',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(18,'Conekta Private API Key Sandbox','conekta_private_api_key_sandbox','key_loKZY2cSjl467KslzRYD32L','Payment',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(19,'Openpay Merchant ID Sandbox','openpay_merchant_id_sandbox','m2j4m875mooh87bjxhzv','Payment',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(20,'Openpay Private Key Sandbox','openpay_private_key_sandbox','sk_25a16f3b4d9b40c9943c064049aa4060','Payment',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(21,'Conekta Public API Key Sandbox','openpay_public_key_sandbox','pk_6ec233a43c294377a2a6b9016acdcb23','Payment',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(22,'Openpay Merchant ID','openpay_merchant_id','m9awzr1utinzflc89siw','Payment',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(23,'Openpay Private Key','openpay_private_key','sk_b0384dca105e4b4989fe4c2712ffd737','Payment',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(24,'Openpay Public API Key','openpay_public_key','pk_8dcd63b64cbe4f019bd8222263564431','Payment',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(25,'SAYCO - external payment and onboarding preprod Endpoint','external_payment_and_onboarding_preprod_endpoint','https://public-webhook-sayco-preprod.qvantel.systems/api/onboarding/customer','Payment',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(26,'SAYCO - external payment and onboarding Prod API Key','external_payment_and_onboarding_Prod_key','Basic YWRtaW46YWRtaW4=','Payment',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(27,'SAYCO - external payment and onboarding prod Endpoint','external_payment_and_onboarding_prod_endpoint','https://public-webhook-figou-prod.qvantel.solutions/api/onboarding/customer','Payment',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(28,'SAYCO - external payment and onboarding preprod API Key','external_payment_and_onboarding_preprod_key','Basic YWRtaW46YWRtaW4=','Payment',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(29,'Qvantel webhook SIM Endpoint','qvantel_webhook_sim_endpoint','https://public-webhook-figou-prod.qvantel.solutions/api/onboarding/customer','Qvantel',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(30,'Qvantel webhook SIM API Key','qvantel_webhook_sim_api_key','Basic YWRtaW46YWRtaW4=','Qvantel',1,'2023-03-03 19:34:02','2023-03-03 19:34:02');
/*!40000 ALTER TABLE `configurations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equivalencies`
--

DROP TABLE IF EXISTS `equivalencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equivalencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `qv_offering_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `altan_offering_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `equivalencies_qv_offering_id_unique` (`qv_offering_id`),
  UNIQUE KEY `equivalencies_altan_offering_id_unique` (`altan_offering_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equivalencies`
--

LOCK TABLES `equivalencies` WRITE;
/*!40000 ALTER TABLE `equivalencies` DISABLE KEYS */;
INSERT INTO `equivalencies` VALUES (1,'PO_SAY_RM_ST_125_125Mi_1500_500M_50_75SMS_2000T_3D_SS','1879958001','2023-03-03 19:34:02','2023-03-03 19:34:02'),(2,'PO_SAY_RM_ST_250_250Mi_3750_1250M_125_125SMS_5000T_7D_SS','1879958002','2023-03-03 19:34:02','2023-03-03 19:34:02'),(3,'PO_SAY_RM_ST_500_500Mi_7500_2500M_250_250SMS_10000T_15D_SS','1879958003','2023-03-03 19:34:02','2023-03-03 19:34:02'),(4,'PO_SAY_RM_ST_750_750Mi_15000_5000M_500_500SMS_20000T_30D_SS','1879958004','2023-03-03 19:34:02','2023-03-03 19:34:02'),(5,'PO_SAY_RM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_30D_SS','1809958029','2023-03-03 19:34:02','2023-03-03 19:34:02'),(6,'PO_SAY_RM_CT_750_750Mi_5000M_250_250SMS_30D_SS','1809958028','2023-03-03 19:34:02','2023-03-03 19:34:02'),(7,'PO_SAY_RM_CT_5000_5000Mi_30000_20000M_5000_5000SMS_50000T_30D_SS','1809958030','2023-03-03 19:34:02','2023-03-03 19:34:02'),(8,'PO_SAY_RM_CT_NB28_750_750Mi_1000M_250_250SMS_300RS_30D_SS','1809858003','2023-03-03 19:34:02','2023-03-03 19:34:02'),(9,'PO_SAY_RM_CT_NB28_750_750Mi_2000M_500_500SMS_500RS_30D_SS','1809858004','2023-03-03 19:34:02','2023-03-03 19:34:02'),(10,'PO_SAY_RM_CT_NB28_750_750Mi_4000M_500_500SMS_2000RS_30D_SS','1809858005','2023-03-03 19:34:02','2023-03-03 19:34:02'),(11,'PO_SAY_RM_CT_750_750Mi_3000_5000M_250_250SMS_30D_SS','1809958031','2023-03-03 19:34:02','2023-03-03 19:34:02');
/*!40000 ALTER TABLE `equivalencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `operacion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint unsigned NOT NULL,
  `client_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_endpoint` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `request` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_order_id_foreign` (`order_id`),
  CONSTRAINT `events_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mails`
--

DROP TABLE IF EXISTS `mails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mails` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` bigint unsigned NOT NULL,
  `driver` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `host` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `port` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `encryption` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mails_brand_id_unique` (`brand_id`),
  CONSTRAINT `mails_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mails`
--

LOCK TABLES `mails` WRITE;
/*!40000 ALTER TABLE `mails` DISABLE KEYS */;
INSERT INTO `mails` VALUES (1,'Default configuration',1,'smtp','smtp.googlemail.com','465','figou.notifica@gmail.com','lrSvi2xeOY5N','ssl','notificaciones@igou.com','POS | IGOU TELECOM','2023-03-03 19:34:02','2023-03-03 19:34:02');
/*!40000 ALTER TABLE `mails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2012_03_26_234845_create_brands_table',1),(2,'2012_04_04_114156_create_roles_table',1),(3,'2014_10_12_000000_create_users_table',1),(4,'2014_10_12_100000_create_password_resets_table',1),(5,'2019_08_19_000000_create_failed_jobs_table',1),(6,'2019_12_14_000001_create_personal_access_tokens_table',1),(7,'2022_02_24_193748_create_portabilities_table',1),(8,'2022_03_26_234849_create_offerings_table',1),(9,'2022_03_28_123731_create_orders_table',1),(10,'2022_03_28_123819_create_balances_table',1),(11,'2022_03_28_123833_create_configurations_table',1),(12,'2022_05_13_114538_create_mails_table',1),(13,'2022_05_27_114020_create_accounts_table',1),(14,'2022_05_27_114336_create_movements_table',1),(15,'2022_06_01_230938_modify_portabilities_table',1),(16,'2023_01_04_211004_create_equivalencies_table',1),(17,'2023_01_25_212850_create_events_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movements`
--

DROP TABLE IF EXISTS `movements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` bigint unsigned NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `operation` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `movements_account_id_foreign` (`account_id`),
  CONSTRAINT `movements_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movements`
--

LOCK TABLES `movements` WRITE;
/*!40000 ALTER TABLE `movements` DISABLE KEYS */;
/*!40000 ALTER TABLE `movements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offerings`
--

DROP TABLE IF EXISTS `offerings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `offerings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `qv_offering_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `promotion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `seller_price` decimal(8,2) NOT NULL,
  `brand_id` bigint unsigned NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `offerings_qv_offering_id_unique` (`qv_offering_id`),
  KEY `offerings_brand_id_foreign` (`brand_id`),
  CONSTRAINT `offerings_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offerings`
--

LOCK TABLES `offerings` WRITE;
/*!40000 ALTER TABLE `offerings` DISABLE KEYS */;
INSERT INTO `offerings` VALUES (1,'PO_BO-RM_ST_250_250Mi_3750_1250M_125_125SMS_5000T_7D_NR','BO 5GB','<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>5GB extra en velocidad reducida</li><li>Vigencia: 7 días</li></ul>','',75.00,75.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(2,'PO_BO-RM_ST_500_500Mi_7500_2500M_250_250SMS_10000T_15D_NR','BO 10GB','<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>10GB de 5G-4G LTE</li><li>10GB extra en velocidad reducida</li><li>Vigencia: 15 días</li></ul>','',125.00,125.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(3,'PO_BO-RM_CT_750_750Mi_5000M_250_250SMS_30D_NR','BO 5GB / 1 mes','<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>WiFi para compartir</li><li>Vigencia: 30 días</li></ul>','',159.00,119.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(4,'PO_BON-RM_CT_750_750Mi_5000M_250_250SMS_30D_NR','BO 5GB / 1 mes +Beneficios','<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>WiFi para compartir</li><li>Vigencia: 30 días</li></ul>','',239.00,159.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(5,'PO_BO-RM_CT_750_750Mi_3000_5000M_250_250SMS_30D_NR','BO 8GB / 1 mes','<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>8GB de 5G-4G LTE</li><li>WiFi para compartir</li><li>Vigencia: 30 días</li></ul>','',209.00,169.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(6,'PO_BON-RM_CT_750_750Mi_3000_5000M_250_250SMS_30D_NR','BO 8GB / 1 mes +Beneficios','<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>8GB de 5G-4G LTE</li><li>WiFi para compartir</li><li>Vigencia: 30 días</li></ul>','',289.00,209.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(7,'PO_BO-RM_ST_750_750Mi_15000_5000M_500_500SMS_20000T_30D_NR','BO 20GB / 1 mes','<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Vigencia: 30 días</li></ul>','',269.00,219.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(8,'PO_BON-RM_ST_750_750Mi_15000_5000M_500_500SMS_20000T_30D_NR','BO 20GB / 1 mes +Beneficios','<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Vigencia: 30 días</li></ul>','',349.00,259.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(9,'PO_BO-RM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_30D_NR','BO 20GB Plus / 1 mes','<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 30 días</li></ul>','',389.00,339.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(10,'PO_BON-RM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_30D_NR','BO 20GB Plus / 1 mes +Beneficios','<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 30 días</li></ul>','',469.00,379.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(11,'PO_BO-RM_CT_5000_5000Mi_30000_20000M_5000_5000SMS_50000T_30D_NR','BO 50GB / 1 mes','<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>50GB de 5G-4G LTE</li><li>50GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 30 días</li></ul>','',599.00,549.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(12,'PO_BON-RM_CT_5000_5000Mi_30000_20000M_5000_5000SMS_50000T_30D_NR','BO 50GB / 1 mes +Beneficios','<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>50GB de 5G-4G LTE</li><li>50GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 30 días</li></ul>','',679.00,589.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(13,'PO_BO-RM_CT_750_750Mi_5000_250_250SMS_6M_R','BO 5GB / 6 meses','<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>5GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 180 días</li></ul>','',699.00,599.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(14,'PO_BON-RM_CT_750_750Mi_5000_250_250SMS_6M_R','BO 5GB / 6 meses +Beneficios','<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>5GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 180 días</li></ul>','',1179.00,979.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(15,'PO_BO-RM_ST_750_750Mi_15000_5000M_500_500SMS_20000T_6M_R','BO 20GB / 6 meses','<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Vigencia: 180 días</li></ul>','',1199.00,1099.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(16,'PO_BON-RM_ST_750_750Mi_15000_5000M_500_500SMS_20000T_6M_R','BO 20GB / 6 meses +Beneficios','<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Vigencia: 180 días</li></ul>','',1679.00,1479.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(17,'PO_BO-RM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_6M_R','BO 20GB Plus / 6 meses','<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 180 días</li></ul>','',1699.00,1599.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(18,'PO_BON-RM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_6M_R','BO 20GB Plus / 6 meses +Beneficios','<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 180 días</li></ul>','',2179.00,1979.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(19,'PO_BO-RM_CT_750_750Mi_5000_250_250SMS_12M_R','BO 5GB / 12 meses','<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>Vigencia: 360 días</li></ul>','',1399.00,1299.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(20,'PO_BON-RM_CT_750_750Mi_5000_250_250SMS_12M_R','BO 5GB / 12 meses +Beneficios','<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>Vigencia: 360 días</li></ul>','',2359.00,2159.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(21,'PO_BO-RM_ST_750_750Mi_15000_5000M_500_500SMS_20000T_12M_R','BO 20GB / 12 meses','<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Vigencia: 360 días</li></ul>','',2299.00,2199.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(22,'PO_BON-RM_ST_750_750Mi_15000_5000M_500_500SMS_20000T_12M_R','BO 20GB / 12 meses +Beneficios','<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Vigencia: 360 días</li></ul>','',3259.00,3059.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(23,'PO_BO-RM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_12M_R','BO 20GB Plus / 12 meses','<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 360 días</li></ul>','',3299.00,3199.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(24,'PO_BON-RM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_12M_R','BO 20GB Plus / 12 meses +Beneficios','<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 360 días</li></ul>','',4259.00,4059.00,2,'normal',1,'2023-03-03 19:34:02','2023-03-03 19:34:02');
/*!40000 ALTER TABLE `offerings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `user_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qv_offering_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `imei` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `msisdn` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birday` date DEFAULT NULL,
  `iccid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outdoor` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `indoor` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `references` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suburb` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_id` bigint unsigned DEFAULT NULL,
  `brand_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Figou',
  `portability_id` bigint unsigned DEFAULT NULL,
  `channel` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pos',
  `total` decimal(8,2) NOT NULL DEFAULT '0.00',
  `seller_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_brand_id_foreign` (`brand_id`),
  KEY `orders_portability_id_foreign` (`portability_id`),
  CONSTRAINT `orders_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_portability_id_foreign` FOREIGN KEY (`portability_id`) REFERENCES `portabilities` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portabilities`
--

DROP TABLE IF EXISTS `portabilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portabilities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `msisdn` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `msisdn_temp` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `iccid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `brand_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `portabilities_user_id_foreign` (`user_id`),
  KEY `portabilities_brand_id_foreign` (`brand_id`),
  CONSTRAINT `portabilities_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  CONSTRAINT `portabilities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portabilities`
--

LOCK TABLES `portabilities` WRITE;
/*!40000 ALTER TABLE `portabilities` DISABLE KEYS */;
/*!40000 ALTER TABLE `portabilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Administrator','2023-03-03 19:34:02','2023-03-03 19:34:02'),(2,'Administrator','2023-03-03 19:34:02','2023-03-03 19:34:02'),(3,'AAA Distributor','2023-03-03 19:34:02','2023-03-03 19:34:02'),(4,'Distributor','2023-03-03 19:34:02','2023-03-03 19:34:02'),(5,'Seller','2023-03-03 19:34:02','2023-03-03 19:34:02'),(6,'Limited','2023-03-03 19:34:02','2023-03-03 19:34:02');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `brand_id` bigint unsigned DEFAULT NULL,
  `primary_brand_id` bigint unsigned DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sales_limit` decimal(8,2) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  KEY `users_brand_id_foreign` (`brand_id`),
  KEY `users_primary_brand_id_foreign` (`primary_brand_id`),
  CONSTRAINT `users_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_primary_brand_id_foreign` FOREIGN KEY (`primary_brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,1,1,'Roberto Guzman','roberto.guzman@leancommerce.mx','2023-03-03 19:34:02','$2y$10$jPNQiy5hnP4Vqk9inlnh1Ob06capgEo5xxG9HX7hJQ8yaSa2yzTCe','OVhV95yt8bYfzmIAIGo9pipKgUepl6zx1tMvqDTaOUE7jSevJ2gEY0T7e1db',1000.00,1,'2023-03-03 19:34:02','2023-03-03 19:34:02'),(2,2,2,2,'AdminMarca','adminmarca@email.com',NULL,'$2y$10$aurnl8IQHgyPyZZsRcjAY.wG4sZ30tAk6VrnC78ENF1wHdiKFz9AW',NULL,10000.00,1,'2023-03-03 20:06:37','2023-03-03 20:06:37'),(3,5,2,2,'Vendedor','vendedor@email.com',NULL,'$2y$10$Q1Hqs70hLYf5xux3zW.jW.D4cH5aIQZHVn.Da6L5g5KWoZhCNinUG','oUjeBToONMdSAKZEj1Xil8sUSpaqZ1q3DDYH6Om77c1tbDMY3Sd2mTZtKSd4',10000.00,1,'2023-03-03 20:07:01','2023-03-03 20:07:01');
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

-- Dump completed on 2023-03-03 20:17:44
