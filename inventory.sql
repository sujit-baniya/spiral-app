-- -------------------------------------------------------------
-- TablePlus 4.5.0(397)
--
-- https://tableplus.com/
--
-- Database: inventory
-- Generation Time: 2021-10-19 22:07:07.4400
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `inventory_feature_rules`;
CREATE TABLE `inventory_feature_rules` (
  `inventory_feature_id` bigint(20) NOT NULL,
  `rule_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `acl` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `inventory_features`;
CREATE TABLE `inventory_features` (
  `inventory_id` bigint(20) NOT NULL,
  `country` varchar(255) NOT NULL,
  `service_type` varchar(255) DEFAULT NULL,
  `number_type` varchar(255) DEFAULT NULL,
  `fee` decimal(11,4) NOT NULL,
  `period` varchar(255) DEFAULT NULL,
  `interval` int(11) DEFAULT NULL,
  `is_country_restricted` tinyint(1) DEFAULT NULL,
  `callback_url` varchar(255) DEFAULT NULL,
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inventory_features_index_inventory_id_614200825f84c` (`inventory_id`),
  CONSTRAINT `inventory_features_foreign_inventory_id_614200825f843` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `rules`;
CREATE TABLE `rules` (
  `name` varchar(255) NOT NULL,
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `inventory_feature_rules` (`inventory_feature_id`, `rule_id`, `value`, `acl`, `is_active`, `id`, `created_at`, `updated_at`) VALUES
(1, 1, 'NP', 'ALLOW', 1, 1, '2021-10-19 21:44:22', NULL),
(1, 1, 'IN', 'DENY', 1, 2, '2021-10-19 21:44:22', NULL);

INSERT INTO `inventory_features` (`inventory_id`, `country`, `service_type`, `number_type`, `fee`, `period`, `interval`, `is_country_restricted`, `callback_url`, `id`, `created_at`, `updated_at`, `name`) VALUES
(1, 'NP', 'sms', 'LONGCODE', 12.0000, 'MONTH', 1, NULL, NULL, 1, NULL, NULL, 'Test Feature');

INSERT INTO `rules` (`name`, `id`, `created_at`, `updated_at`, `slug`, `description`) VALUES
('Country', 1, '2021-09-15 14:47:05', '2021-09-15 15:06:11', 'country', 'adsd');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;