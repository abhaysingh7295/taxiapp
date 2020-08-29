-- Adminer 4.7.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `accounts_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `account_password_resets`;
CREATE TABLE `account_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `account_password_resets_email_index` (`email`),
  KEY `account_password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `admins` (`id`, `name`, `email`, `mobile`, `password`, `picture`, `language`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'FTF',	'admin@demo.com',	NULL,	'$2y$10$suSPUlfTA3OEuQFDuxt6tujc093yHfzhONAJzXJPYbJMRpC.0ecR2',	NULL,	'en',	NULL,	'2020-06-10 03:51:57',	'2020-07-26 02:24:45'),
(2,	'Demo Dispatcher',	'dispatcher@demo.com',	NULL,	'$2y$10$agfAzcf/V/MITjl1tzNpfu9pdymfspPOYk.T99eqbBT0KetS/0lUK',	NULL,	NULL,	NULL,	'2020-06-10 03:51:57',	'2020-06-10 03:51:57'),
(3,	'Demo account',	'account@demo.com',	NULL,	'$2y$10$VEgu7Kk.iBuB/Uh7wUhHgu8MT34X6ks.PJkc4Of2IHSyWsrbXcHuy',	NULL,	NULL,	NULL,	'2020-06-10 03:51:58',	'2020-06-10 03:51:58'),
(4,	'Demo Dispute',	'dispute@demo.com',	NULL,	'$2y$10$SuAwFCfJpZNs.iScLfdA8u1gmUmXOhSxCUDa8S8Pw9NDVKNNaNifK',	NULL,	NULL,	NULL,	'2020-06-10 03:51:58',	'2020-06-10 03:51:58'),
(5,	'Sub Admin',	'subadmin@demo.com',	NULL,	'$2y$10$kfAlNC38uASxwBq0WobLCeeOw13DjM.UUZkZOiIY7miH6OHm9hn.S',	NULL,	NULL,	NULL,	'2020-07-01 02:33:54',	'2020-07-01 02:42:43'),
(6,	'admin',	'admin@subadmi.com',	NULL,	'$2y$10$EZnMSQTRMTg1gn6W.qP/3uZJuaCuYZg8CE32midGs7IAQqvdYar92',	NULL,	NULL,	NULL,	'2020-07-05 07:16:30',	'2020-07-05 07:16:30'),
(7,	'Darius',	'ftfedinburgh@gmail.com',	NULL,	'$2y$10$/YyErSvwrNMWYKuRukFheuOoWyrpQPIkKho7VfgL2jWut74d5pTUW',	NULL,	NULL,	NULL,	'2020-07-26 04:58:11',	'2020-07-26 04:58:11');

DROP TABLE IF EXISTS `admin_wallet`;
CREATE TABLE `admin_wallet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `transaction_alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_type` int(11) DEFAULT NULL COMMENT '1-commission,2-userrecharge,3-tripdebit,4-providerrecharge,5-providersettle,9-taxcredit,10-discountdebit,11-discountrecharge,12-userreferral,13-providerreferral,14-peakcommission,15-waitingcommission,16-userdispute,17-providerdispute',
  `type` enum('C','D') COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(15,8) NOT NULL DEFAULT '0.00000000',
  `open_balance` double(15,8) NOT NULL DEFAULT '0.00000000',
  `close_balance` double(15,8) NOT NULL DEFAULT '0.00000000',
  `payment_mode` enum('BRAINTREE','CARD','PAYPAL','PAYUMONEY','PAYTM') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `bookingissuestypes`;
CREATE TABLE `bookingissuestypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('user','provider') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `bookingissuestypes` (`id`, `type`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2,	'user',	'fdsdsf',	'active',	'2020-08-07 07:38:16',	'2020-08-07 07:38:16');

DROP TABLE IF EXISTS `cards`;
CREATE TABLE `cards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `last_four` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_default` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `carrentcars`;
CREATE TABLE `carrentcars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `VehiclesTitle` varchar(150) DEFAULT NULL,
  `VehiclesType` int(11) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `VehiclesOverview` longtext,
  `PricePerDay` int(11) DEFAULT NULL,
  `FuelType` varchar(100) DEFAULT NULL,
  `ModelYear` int(6) DEFAULT NULL,
  `SeatingCapacity` int(11) DEFAULT NULL,
  `Vimage1` varchar(120) DEFAULT NULL,
  `AirConditioner` int(11) DEFAULT NULL,
  `PowerDoorLocks` int(11) DEFAULT NULL,
  `AntiLockBrakingSystem` int(11) DEFAULT NULL,
  `BrakeAssist` int(11) DEFAULT NULL,
  `PowerSteering` int(11) DEFAULT NULL,
  `DriverAirbag` int(11) DEFAULT NULL,
  `PassengerAirbag` int(11) DEFAULT NULL,
  `PowerWindows` int(11) DEFAULT NULL,
  `CDPlayer` int(11) DEFAULT NULL,
  `CentralLocking` int(11) DEFAULT NULL,
  `CrashSensor` int(11) DEFAULT NULL,
  `LeatherSeats` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `carrentcars` (`id`, `VehiclesTitle`, `VehiclesType`, `company_id`, `VehiclesOverview`, `PricePerDay`, `FuelType`, `ModelYear`, `SeatingCapacity`, `Vimage1`, `AirConditioner`, `PowerDoorLocks`, `AntiLockBrakingSystem`, `BrakeAssist`, `PowerSteering`, `DriverAirbag`, `PassengerAirbag`, `PowerWindows`, `CDPlayer`, `CentralLocking`, `CrashSensor`, `LeatherSeats`, `created_at`, `updated_at`) VALUES
(1,	'ytb rvtr',	2,	0,	'vtretrvet',	345345,	'Petrol',	3453,	7,	'knowledge_base_bg.jpg',	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	'2017-06-19 11:46:23',	'2017-06-20 18:38:13'),
(2,	'Test Demoy',	2,	0,	'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam nibh. Nunc varius facilisis eros. Sed erat. In in velit quis arcu ornare laoreet. Curabitur adipiscing luctus massa. Integer ut purus ac augue commodo commodo. Nunc nec mi eu justo tempor consectetuer. Etiam vitae nisl. In dignissim lacus ut ante. Cras elit lectus, bibendum a, adipiscing vitae, commodo et, dui. Ut tincidunt tortor. Donec nonummy, enim in lacinia pulvinar, velit tellus scelerisque augue, ac posuere libero urna eget neque. Cras ipsum. Vestibulum pretium, lectus nec venenatis volutpat, purus lectus ultrices risus, a condimentum risus mi et quam. Pellentesque auctor fringilla neque. Duis eu massa ut lorem iaculis vestibulum. Maecenas facilisis elit sed justo. Quisque volutpat malesuada velit. ',	859,	'CNG',	2015,	4,	'car_755x430.png',	1,	1,	1,	1,	1,	1,	1,	NULL,	1,	1,	NULL,	NULL,	'2017-06-19 16:16:17',	'2017-06-21 16:57:11'),
(3,	'Lorem ipsum',	4,	0,	'Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum',	563,	'CNG',	2012,	5,	'featured-img-3.jpg',	1,	1,	1,	1,	1,	1,	NULL,	1,	1,	NULL,	NULL,	NULL,	'2017-06-19 16:18:20',	'2017-06-20 18:40:11'),
(4,	'Lorem ipsum',	1,	1,	'Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum',	5636,	'CNG',	2012,	5,	'featured-img-3.jpg',	1,	1,	1,	1,	1,	1,	1,	1,	1,	NULL,	NULL,	NULL,	'2017-06-19 16:18:43',	'2020-07-05 06:57:18'),
(5,	'ytb rvtr',	1,	1,	'vtretrvet',	345345,	'Petrol',	3453,	7,	'car_755x430.png',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2017-06-20 17:57:09',	'2020-07-05 06:39:17'),
(8,	'sadsads',	1,	1,	'sadsad',	23,	'Petrol',	34344,	31,	NULL,	NULL,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	'2020-07-05 07:06:46',	'2020-07-05 07:17:53');

DROP TABLE IF EXISTS `carrentcartypes`;
CREATE TABLE `carrentcartypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `carrentcartypes` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(6,	'FTF 8 Seater',	'Boot capacity',	'2020-07-26 04:43:33',	'2020-07-26 04:43:33'),
(7,	'FTF 6 Seater',	'Boot capacity',	'2020-07-26 04:44:04',	'2020-07-26 04:44:04'),
(8,	'FTF 4 Seater Super',	'Boot capacity',	'2020-07-26 04:44:27',	'2020-07-26 04:44:27'),
(9,	'FTF 4 Seater',	'Boot capacity',	'2020-07-26 04:44:47',	'2020-07-26 04:44:47');

DROP TABLE IF EXISTS `carrentcompanies`;
CREATE TABLE `carrentcompanies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `city` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `carrentcompanies` (`id`, `name`, `email`, `address`, `city`, `country`, `phone`, `created_at`, `updated_at`) VALUES
(1,	'qwweqweqw',	'sadsa@dsds.com',	'dfg dfgfdg dfhfd',	2,	1,	5676576576,	'2020-07-04 05:00:15',	'2020-07-04 05:15:52');

DROP TABLE IF EXISTS `carrentreservations`;
CREATE TABLE `carrentreservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `VehicleId` int(11) DEFAULT NULL,
  `FromDate` varchar(20) DEFAULT NULL,
  `ToDate` varchar(20) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `carrentreservations` (`id`, `userid`, `VehicleId`, `FromDate`, `ToDate`, `message`, `Status`, `PostingDate`, `created_at`, `updated_at`) VALUES
(1,	1,	2,	'22/06/2017',	'25/06/2017',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco',	1,	'2017-06-19 20:15:43',	NULL,	NULL),
(2,	2,	3,	'30/06/2017',	'02/07/2017',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco',	2,	'2017-06-26 20:15:43',	NULL,	NULL),
(3,	3,	4,	'02/07/2017',	'07/07/2017',	'Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ',	0,	'2017-06-26 21:10:06',	NULL,	NULL),
(4,	2,	4,	'10/07/2020',	'12/07/2020',	'hi',	1,	'2020-07-04 06:13:11',	NULL,	NULL);

DROP TABLE IF EXISTS `chats`;
CREATE TABLE `chats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('up','pu') COLLATE utf8_unicode_ci NOT NULL,
  `delivered` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'India',	NULL,	NULL),
(2,	'US',	NULL,	NULL),
(4,	'dfsaaa',	'2020-07-02 06:18:16',	'2020-07-06 00:27:30'),
(6,	'Canada',	'2020-07-26 12:59:16',	'2020-07-26 12:59:16');

DROP TABLE IF EXISTS `custom_pushes`;
CREATE TABLE `custom_pushes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `send_to` enum('ALL','USERS','PROVIDERS') COLLATE utf8_unicode_ci NOT NULL,
  `condition` enum('ACTIVE','LOCATION','RIDES','AMOUNT') COLLATE utf8_unicode_ci NOT NULL,
  `condition_data` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sent_to` int(11) NOT NULL DEFAULT '0',
  `schedule_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `custom_pushes` (`id`, `send_to`, `condition`, `condition_data`, `message`, `sent_to`, `schedule_at`, `created_at`, `updated_at`) VALUES
(1,	'USERS',	'ACTIVE',	'HOUR',	'asdsad',	0,	NULL,	'2020-07-08 11:47:43',	'2020-07-08 11:47:43'),
(2,	'USERS',	'ACTIVE',	'HOUR',	'xzcxzc',	0,	NULL,	'2020-07-08 11:48:21',	'2020-07-08 11:48:21');

DROP TABLE IF EXISTS `dispatchers`;
CREATE TABLE `dispatchers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dispatchers_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `dispatcher_password_resets`;
CREATE TABLE `dispatcher_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `dispatcher_password_resets_email_index` (`email`),
  KEY `dispatcher_password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `disputes`;
CREATE TABLE `disputes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dispute_type` enum('user','provider') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `dispute_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `disputes` (`id`, `dispute_type`, `dispute_name`, `status`, `created_at`, `updated_at`) VALUES
(11,	'provider',	'Issues with signal reception',	'active',	'2020-07-23 06:16:27',	'2020-07-23 06:16:27'),
(12,	'provider',	'Cancelled or cleared job early by mistake',	'active',	'2020-07-23 06:19:34',	'2020-07-23 06:19:34'),
(13,	'provider',	'Showing wrong Trip distance',	'active',	'2020-07-23 06:19:50',	'2020-07-23 06:19:50'),
(14,	'provider',	'Others',	'active',	'2020-07-23 06:20:35',	'2020-07-23 06:20:35');

DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('DRIVER','VEHICLE') COLLATE utf8_unicode_ci NOT NULL,
  `is_expiredate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `documents` (`id`, `name`, `type`, `is_expiredate`, `created_at`, `updated_at`) VALUES
(10,	'Bank Statement',	'DRIVER',	0,	'2020-08-01 07:17:19',	'2020-08-01 07:17:19'),
(11,	'PHC Driving Badge',	'DRIVER',	0,	'2020-08-01 07:20:11',	'2020-08-01 07:20:11'),
(12,	'DVLA Driving Licence',	'DRIVER',	0,	'2020-08-01 07:20:42',	'2020-08-01 07:20:42'),
(13,	'DVLA Electronic Code',	'DRIVER',	1,	'2020-08-01 07:21:09',	'2020-08-07 04:20:39'),
(14,	'Permission letter',	'VEHICLE',	1,	'2020-08-01 07:29:50',	'2020-08-07 03:00:25'),
(15,	'Insurance Certificate',	'VEHICLE',	1,	'2020-08-01 07:30:17',	'2020-08-07 03:00:19'),
(16,	'PHC Certificate of Compliance',	'VEHICLE',	1,	'2020-08-01 07:31:06',	'2020-08-07 03:00:11'),
(17,	'Vehicle Registration Logbook V5C or New Owner Slip',	'VEHICLE',	1,	'2020-08-01 07:32:32',	'2020-08-07 01:00:55');

DROP TABLE IF EXISTS `driverfareissuetypes`;
CREATE TABLE `driverfareissuetypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('user','provider') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `driverfareissuetypes` (`id`, `type`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2,	'provider',	'adssad',	'active',	'2020-08-07 06:50:11',	'2020-08-07 06:50:11');

DROP TABLE IF EXISTS `driver_request_disputes`;
CREATE TABLE `driver_request_disputes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `dispute_type` enum('user','provider') COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `dispute_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dispute_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refund_amount` double(10,2) NOT NULL DEFAULT '0.00',
  `status` enum('open','closed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'open',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `eventcontacts`;
CREATE TABLE `eventcontacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `favourite_locations`;
CREATE TABLE `favourite_locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` double(15,8) DEFAULT NULL,
  `longitude` double(15,8) DEFAULT NULL,
  `type` enum('home','work','recent','others') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'others',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `ltm_translations`;
CREATE TABLE `ltm_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL DEFAULT '0',
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_04_02_193005_create_translations_table',	1),
(2,	'2014_10_12_000000_create_users_table',	1),
(3,	'2014_10_12_100000_create_password_resets_table',	1),
(4,	'2015_08_25_172600_create_settings_table',	1),
(5,	'2016_06_01_000001_create_oauth_auth_codes_table',	1),
(6,	'2016_06_01_000002_create_oauth_access_tokens_table',	1),
(7,	'2016_06_01_000003_create_oauth_refresh_tokens_table',	1),
(8,	'2016_06_01_000004_create_oauth_clients_table',	1),
(9,	'2016_06_01_000005_create_oauth_personal_access_clients_table',	1),
(10,	'2016_12_03_000000_create_payu_payments_table',	1),
(11,	'2016_12_03_000000_create_permission_tables',	1),
(12,	'2017_01_11_180503_create_admins_table',	1),
(13,	'2017_01_11_180511_create_providers_table',	1),
(14,	'2017_01_11_181312_create_cards_table',	1),
(15,	'2017_01_11_181357_create_chats_table',	1),
(16,	'2017_01_11_181558_create_promocodes_table',	1),
(17,	'2017_01_11_182454_create_provider_documents_table',	1),
(18,	'2017_01_11_182536_create_provider_services_table',	1),
(19,	'2017_01_11_182649_create_user_requests_table',	1),
(20,	'2017_01_11_182717_create_request_filters_table',	1),
(21,	'2017_01_11_182738_create_service_types_table',	1),
(22,	'2017_01_25_172422_create_documents_table',	1),
(23,	'2017_01_31_122021_create_provider_devices_table',	1),
(24,	'2017_02_02_192703_create_user_request_ratings_table',	1),
(25,	'2017_02_06_080124_create_user_request_payments_table',	1),
(26,	'2017_02_14_135859_create_provider_profiles_table',	1),
(27,	'2017_02_21_131429_create_promocode_usages_table',	1),
(28,	'2017_06_17_151030_create_dispatchers_table',	1),
(29,	'2017_06_17_151031_create_dispatcher_password_resets_table',	1),
(30,	'2017_06_20_154148_create_accounts_table',	1),
(31,	'2017_06_20_154149_create_account_password_resets_table',	1),
(32,	'2017_08_03_194354_create_custom_pushes_table',	1),
(33,	'2017_09_01_190333_create_wallet_passbooks_table',	1),
(34,	'2017_09_01_190355_create_promocode_passbooks_table',	1),
(35,	'2017_09_26_160101_create_favourite_locations_table',	1),
(36,	'2018_06_29_174517_create_works_table',	1),
(37,	'2018_09_07_151624_create_admin_wallet_table',	1),
(38,	'2018_09_07_151631_create_user_wallet_table',	1),
(39,	'2018_09_07_151636_create_provider_wallet_table',	1),
(40,	'2018_09_14_160535_create_wallet_requests_table',	1),
(41,	'2018_09_24_164552_create_provider_cards_table',	1),
(42,	'2018_09_27_195450_create_eventcontacts_table',	1),
(43,	'2018_12_07_132532_create_referral_histroy_table',	1),
(44,	'2018_12_07_132536_create_referral_earnings_table',	1),
(45,	'2018_12_18_171537_create_reasons_table',	1),
(46,	'2018_12_27_125550_create_request_waiting_time_table',	1),
(47,	'2018_12_27_125553_create_service_peak_hours_table',	1),
(48,	'2018_12_27_125556_create_peak_hours_table',	1),
(49,	'2019_01_07_135142_create_disputes_table',	1),
(50,	'2019_01_07_135145_create_user_request_disputes_table',	1),
(51,	'2019_01_07_135146_create_user_request_lost_items_table',	1),
(52,	'2019_01_07_135148_create_notifications_table',	1),
(53,	'2019_01_28_145133_create_push_subscriptions_table',	1),
(54,	'2019_01_31_104045_create_payment_logs_table',	1);

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1,	'App\\Admin',	1),
(2,	'App\\Admin',	2),
(4,	'App\\Admin',	3),
(3,	'App\\Admin',	4),
(5,	'App\\Admin',	5),
(5,	'App\\Admin',	6),
(5,	'App\\Admin',	7);

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notify_type` enum('all','user','provider') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'all',
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expiry_date` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `notifications` (`id`, `notify_type`, `image`, `description`, `expiry_date`, `status`, `created_at`, `updated_at`) VALUES
(1,	'user',	'http://bhanushainfosoft.live/taxiapp/public/uploads/eadcd2601b327dc5c0008b44c33b44b6eb24b12f.png',	'Test notification',	'2020-07-08 05:59:00',	'active',	'2020-07-06 00:30:26',	'2020-07-06 00:30:26');

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `scopes` text COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1,	NULL,	'TaxiApp Personal Access Client',	'kXGNm2JF22nwSXMNnCgOWz6qb9GTQY8ZdKrQKDFf',	'http://localhost',	1,	0,	0,	'2020-06-10 03:52:39',	'2020-06-10 03:52:39'),
(2,	NULL,	'TaxiApp Password Grant Client',	'P9JbCzNtpCTYePdjHHr7pewjECHgXzoCYoTATQ8J',	'http://localhost',	0,	1,	0,	'2020-06-10 03:52:39',	'2020-06-10 03:52:39');

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1,	1,	'2020-06-10 03:52:39',	'2020-06-10 03:52:39');

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `payment_logs`;
CREATE TABLE `payment_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_wallet` int(11) NOT NULL DEFAULT '0',
  `user_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user or provider',
  `payment_mode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL COMMENT 'user id or provider id',
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `transaction_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Random code generated during payment',
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Foreign key of the user request or wallet table',
  `response` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `payu_payments`;
CREATE TABLE `payu_payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payable_id` int(10) unsigned DEFAULT NULL,
  `payable_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txnid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mihpayid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `discount` double NOT NULL DEFAULT '0',
  `net_amount_debit` double NOT NULL DEFAULT '0',
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unmappedstatus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_ref_num` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bankcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cardnum` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_on_card` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `issuing_bank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `peak_hours`;
CREATE TABLE `peak_hours` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `peak_hours` (`id`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1,	'20:12:00',	'09:40:00',	'2020-07-05 09:14:08',	'2020-07-05 09:14:08');

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `permissions` (`id`, `name`, `display_name`, `guard_name`, `group_name`, `status`, `created_at`, `updated_at`) VALUES
(1,	'dashboard-menus',	'Box Menus',	'admin',	'Dashboard',	1,	NULL,	NULL),
(2,	'wallet-summary',	'Wallet Summary',	'admin',	'Dashboard',	1,	NULL,	NULL),
(3,	'recent-rides',	'Recent Rides',	'admin',	'Dashboard',	1,	NULL,	NULL),
(4,	'dispatcher-panel',	'Dispatcher Menu',	'admin',	'Dispatcher Panel',	1,	NULL,	NULL),
(5,	'dispatcher-panel-add',	'Add Rides',	'admin',	'Dispatcher Panel',	1,	NULL,	NULL),
(6,	'dispute-list',	'Fare Issues list',	'admin',	'Fare Issues',	1,	NULL,	NULL),
(7,	'dispute-create',	'Create Fare Issues',	'admin',	'Fare Issues',	1,	NULL,	NULL),
(8,	'dispute-edit',	'Edit Fare Issues',	'admin',	'Fare Issues',	1,	NULL,	NULL),
(9,	'dispute-delete',	'Delete Fare Issues Type',	'admin',	'Fare Issues',	1,	NULL,	NULL),
(10,	'heat-map',	'Heat Map',	'admin',	'Map',	0,	NULL,	NULL),
(11,	'god-eye',	'God\'s Eye',	'admin',	'Map',	0,	NULL,	NULL),
(12,	'user-list',	'User list',	'admin',	'Users',	1,	NULL,	NULL),
(13,	'user-history',	'User History',	'admin',	'Users',	1,	NULL,	NULL),
(14,	'user-create',	'Create User',	'admin',	'Users',	1,	NULL,	NULL),
(15,	'user-edit',	'Edit User',	'admin',	'Users',	1,	NULL,	NULL),
(16,	'user-delete',	'Delete User',	'admin',	'Users',	1,	NULL,	NULL),
(17,	'provider-list',	'Driver list',	'admin',	'Drivers',	1,	NULL,	NULL),
(18,	'provider-create',	'Create Driver',	'admin',	'Drivers',	1,	NULL,	NULL),
(19,	'provider-edit',	'Edit Driver',	'admin',	'Drivers',	1,	NULL,	NULL),
(20,	'provider-delete',	'Delete Driver',	'admin',	'Drivers',	1,	NULL,	NULL),
(21,	'provider-status',	'Driver Status',	'admin',	'Drivers',	1,	NULL,	NULL),
(22,	'provider-history',	'Ride History',	'admin',	'Drivers',	1,	NULL,	NULL),
(23,	'provider-statements',	'Statements',	'admin',	'Drivers',	1,	NULL,	NULL),
(24,	'provider-services',	'Driver Services',	'admin',	'Drivers',	1,	NULL,	NULL),
(25,	'provider-service-update',	'Driver Service Update',	'admin',	'Drivers',	1,	NULL,	NULL),
(26,	'provider-service-delete',	'Driver Service Delete',	'admin',	'Drivers',	1,	NULL,	NULL),
(27,	'provider-documents',	'Driver Documents',	'admin',	'Drivers',	1,	NULL,	NULL),
(28,	'provider-document-edit',	'Driver Document Edit',	'admin',	'Drivers',	1,	NULL,	NULL),
(29,	'provider-document-delete',	'Driver Document Delete',	'admin',	'Drivers',	1,	NULL,	NULL),
(30,	'dispatcher-list',	'Dispatcher list',	'admin',	'Dispatcher',	0,	NULL,	NULL),
(31,	'dispatcher-create',	'Create Dispatcher',	'admin',	'Dispatcher',	0,	NULL,	NULL),
(32,	'dispatcher-edit',	'Edit Dispatcher',	'admin',	'Dispatcher',	0,	NULL,	NULL),
(33,	'dispatcher-delete',	'Delete Dispatcher',	'admin',	'Dispatcher',	0,	NULL,	NULL),
(34,	'account-manager-list',	'Account Manager list',	'admin',	'Account Manager',	0,	NULL,	NULL),
(35,	'account-manager-create',	'Create Account Manager',	'admin',	'Account Manager',	0,	NULL,	NULL),
(36,	'account-manager-edit',	'Edit Account Manager',	'admin',	'Account Manager',	0,	NULL,	NULL),
(37,	'account-manager-delete',	'Delete Account Manager',	'admin',	'Account Manager',	0,	NULL,	NULL),
(38,	'dispute-manager-list',	'Dispute Manager list',	'admin',	'Dispute Manager',	0,	NULL,	NULL),
(39,	'dispute-manager-create',	'Create Dispute Manager',	'admin',	'Dispute Manager',	0,	NULL,	NULL),
(40,	'dispute-manager-edit',	'Edit Dispute Manager',	'admin',	'Dispute Manager',	0,	NULL,	NULL),
(41,	'dispute-manager-delete',	'Delete Dispute Manager',	'admin',	'Dispute Manager',	0,	NULL,	NULL),
(42,	'statements',	'Statements',	'admin',	'Statements',	1,	NULL,	NULL),
(43,	'settlements',	'Settlements',	'admin',	'Settlements',	1,	NULL,	NULL),
(44,	'ratings',	'Ratings',	'admin',	'Ratings',	1,	NULL,	NULL),
(45,	'ride-history',	'Ride History',	'admin',	'Rides',	1,	NULL,	NULL),
(46,	'ride-delete',	'Delete Ride',	'admin',	'Rides',	1,	NULL,	NULL),
(47,	'schedule-rides',	'Schedule Rides',	'admin',	'Rides',	0,	NULL,	NULL),
(48,	'promocodes-list',	'Promocodes List',	'admin',	'Promocodes',	1,	NULL,	NULL),
(49,	'promocodes-create',	'Create Promocode',	'admin',	'Promocodes',	1,	NULL,	NULL),
(50,	'promocodes-edit',	'Edit Promocode',	'admin',	'Promocodes',	1,	NULL,	NULL),
(51,	'promocodes-delete',	'Delete Promocode',	'admin',	'Promocodes',	1,	NULL,	NULL),
(52,	'service-types-list',	'Service Types List',	'admin',	'Service Types',	1,	NULL,	NULL),
(53,	'service-types-create',	'Create Service Type',	'admin',	'Service Types',	1,	NULL,	NULL),
(54,	'service-types-edit',	'Edit Service Type',	'admin',	'Service Types',	1,	NULL,	NULL),
(55,	'service-types-delete',	'Delete Service Type',	'admin',	'Service Types',	1,	NULL,	NULL),
(56,	'peak-hour-list',	'Peak Hour List',	'admin',	'Service Types',	1,	NULL,	NULL),
(57,	'peak-hour-create',	'Create Peak Hour',	'admin',	'Service Types',	1,	NULL,	NULL),
(58,	'peak-hour-edit',	'Edit Peak Hour',	'admin',	'Service Types',	1,	NULL,	NULL),
(59,	'peak-hour-delete',	'Delete Peak Hour',	'admin',	'Service Types',	1,	NULL,	NULL),
(60,	'documents-list',	'Documents List',	'admin',	'Documents',	1,	NULL,	NULL),
(61,	'documents-create',	'Create Document',	'admin',	'Documents',	1,	NULL,	NULL),
(62,	'documents-edit',	'Edit Document',	'admin',	'Documents',	1,	NULL,	NULL),
(63,	'documents-delete',	'Delete Document',	'admin',	'Documents',	1,	NULL,	NULL),
(64,	'cancel-reasons-list',	'Cancel Reason List',	'admin',	'Booking Cancel Reasons',	1,	NULL,	NULL),
(65,	'cancel-reasons-create',	'Create Reason',	'admin',	'Booking  Cancel Reasons',	1,	NULL,	NULL),
(66,	'cancel-reasons-edit',	'Edit Reason',	'admin',	'Booking  Cancel Reasons',	1,	NULL,	NULL),
(67,	'cancel-reasons-delete',	'Delete Reason',	'admin',	'Booking  Cancel Reasons',	1,	NULL,	NULL),
(68,	'notification-list',	'Notifications List',	'admin',	'Notifications',	1,	NULL,	NULL),
(69,	'notification-create',	'Create Notification',	'admin',	'Notifications',	1,	NULL,	NULL),
(70,	'notification-edit',	'Edit Notification',	'admin',	'Notifications',	1,	NULL,	NULL),
(71,	'notification-delete',	'Delete Notification',	'admin',	'Notifications',	1,	NULL,	NULL),
(72,	'lost-item-list',	'Lost Item List',	'admin',	'Lost Items',	1,	NULL,	NULL),
(73,	'lost-item-create',	'Create Lost Item',	'admin',	'Lost Items',	1,	NULL,	NULL),
(74,	'lost-item-edit',	'Edit Lost Item',	'admin',	'Lost Items',	1,	NULL,	NULL),
(75,	'role-list',	'Role list',	'admin',	'Role',	1,	NULL,	NULL),
(76,	'role-create',	'Create Role',	'admin',	'Role',	1,	NULL,	NULL),
(77,	'role-edit',	'Edit Role',	'admin',	'Role',	1,	NULL,	NULL),
(78,	'role-delete',	'Delete Role',	'admin',	'Role',	1,	NULL,	NULL),
(79,	'sub-admin-list',	'Sub Admins List',	'admin',	'Sub Admins',	1,	NULL,	NULL),
(80,	'sub-admin-create',	'Create Sub Admin',	'admin',	'Sub Admins',	1,	NULL,	NULL),
(81,	'sub-admin-edit',	'Edit Sub Admin',	'admin',	'Sub Admins',	1,	NULL,	NULL),
(82,	'sub-admin-delete',	'Delete Sub Admin',	'admin',	'Sub Admins',	1,	NULL,	NULL),
(83,	'payment-history',	'Payment History List',	'admin',	'Payment',	1,	NULL,	NULL),
(84,	'payment-settings',	'Payment Settings List',	'admin',	'Payment',	1,	NULL,	NULL),
(85,	'site-settings',	'Site Settings',	'admin',	'Settings',	1,	NULL,	NULL),
(86,	'account-settings',	'Account Settings',	'admin',	'Settings',	1,	NULL,	NULL),
(87,	'transalations',	'Translations',	'admin',	'Settings',	1,	NULL,	NULL),
(88,	'change-password',	'Change Password',	'admin',	'Settings',	1,	NULL,	NULL),
(89,	'cms-pages',	'CMS Pages',	'admin',	'Pages',	0,	NULL,	NULL),
(90,	'help',	'Help',	'admin',	'Pages',	0,	NULL,	NULL),
(91,	'custom-push',	'Custom Push',	'admin',	'Others',	1,	NULL,	NULL),
(92,	'db-backup',	'DB Backup',	'admin',	'Others',	0,	NULL,	NULL),
(93,	'vehiclechecklist',	'Vehicle Checklist',	'admin',	'Drivers',	1,	NULL,	NULL),
(94,	'driver-redflag',	'Driver Red Flag',	'admin',	'Drivers',	1,	NULL,	NULL),
(95,	'driver-orangeflag',	'Driver Orange Flag',	'admin',	'Drivers',	1,	NULL,	NULL),
(96,	'country',	'Country List',	'admin',	'City Management',	1,	NULL,	NULL),
(97,	'city',	'City list',	'admin',	'City Management',	1,	NULL,	NULL),
(98,	'company',	'Company list',	'admin',	'Company Car Rent',	1,	NULL,	NULL),
(99,	'cartype',	'Car Type List',	'admin',	'City Management',	1,	NULL,	NULL),
(100,	'cars',	'Cars List',	'admin',	'City Management',	1,	NULL,	NULL),
(101,	'reservations',	'Reservations',	'admin',	'Company Car Rent',	1,	NULL,	NULL),
(102,	'vehicles',	'vehicles list',	'admin',	'Drivers',	1,	NULL,	NULL),
(103,	'luggage',	'luggage List',	'admin',	'Drivers',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `promocodes`;
CREATE TABLE `promocodes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `promo_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `percentage` double(5,2) NOT NULL DEFAULT '0.00',
  `max_amount` double(10,2) NOT NULL DEFAULT '0.00',
  `promo_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expiration` datetime NOT NULL,
  `status` enum('ADDED','EXPIRED') COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `promocodes` (`id`, `promo_code`, `percentage`, `max_amount`, `promo_description`, `expiration`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	'CPD01',	10.00,	50.00,	'10% off, Max discount is 50',	'2020-08-10 09:22:15',	'ADDED',	NULL,	'2020-06-10 03:52:15',	'2020-06-10 03:52:15'),
(2,	'CPD02',	20.00,	75.00,	'20% off, Max discount is 75',	'2020-08-10 09:22:15',	'ADDED',	NULL,	'2020-06-10 03:52:15',	'2020-06-10 03:52:15'),
(3,	'gfdgfd',	10.00,	200.00,	'10% off! Maximum discount amount R$200',	'2020-07-01 15:08:00',	'ADDED',	NULL,	'2020-07-01 04:08:24',	'2020-07-01 04:08:24'),
(4,	'DISA021',	20.00,	200.00,	'20% off! Maximum discount amount R$200',	'2020-07-10 21:10:00',	'ADDED',	NULL,	'2020-07-03 10:11:43',	'2020-07-03 10:11:43'),
(5,	'fh',	12.00,	998.00,	'12% off! Maximum discount amount R$1000',	'2020-08-20 14:53:00',	'ADDED',	NULL,	'2020-08-20 03:53:28',	'2020-08-20 03:53:28');

DROP TABLE IF EXISTS `promocode_passbooks`;
CREATE TABLE `promocode_passbooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `promocode_id` int(11) NOT NULL,
  `status` enum('ADDED','USED','EXPIRED') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `promocode_usages`;
CREATE TABLE `promocode_usages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `promocode_id` int(11) NOT NULL,
  `status` enum('ADDED','USED','EXPIRED') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `providers`;
CREATE TABLE `providers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('MALE','FEMALE') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'MALE',
  `country_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `licenseno` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rating` decimal(4,2) NOT NULL DEFAULT '5.00',
  `status` enum('document','card','onboarding','approved','banned','balance') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'document',
  `is_check_documnet` int(11) NOT NULL DEFAULT '0',
  `is_agree_add_company_logo_on_car` int(11) NOT NULL DEFAULT '0',
  `is_full_time_work` int(11) NOT NULL DEFAULT '0',
  `is_part_time_work` int(11) NOT NULL DEFAULT '0',
  `is_ready_for_schedule_job` int(11) NOT NULL DEFAULT '0',
  `is_orenge_flag` int(11) NOT NULL DEFAULT '0',
  `is_red_flag` int(11) NOT NULL DEFAULT '0',
  `latitude` double(15,8) DEFAULT NULL,
  `longitude` double(15,8) DEFAULT NULL,
  `stripe_acc_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stripe_cust_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paypal_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_by` enum('manual','facebook','google') COLLATE utf8_unicode_ci NOT NULL,
  `social_unique_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `otp` mediumint(9) NOT NULL DEFAULT '0',
  `wallet_balance` double(10,2) NOT NULL DEFAULT '0.00',
  `referral_unique_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qrcode_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `providers_email_unique` (`email`),
  UNIQUE KEY `providers_mobile_unique` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `providers` (`id`, `first_name`, `last_name`, `email`, `gender`, `country_code`, `mobile`, `country`, `city`, `address`, `licenseno`, `password`, `avatar`, `rating`, `status`, `is_check_documnet`, `is_agree_add_company_logo_on_car`, `is_full_time_work`, `is_part_time_work`, `is_ready_for_schedule_job`, `is_orenge_flag`, `is_red_flag`, `latitude`, `longitude`, `stripe_acc_id`, `stripe_cust_id`, `paypal_email`, `login_by`, `social_unique_id`, `otp`, `wallet_balance`, `referral_unique_id`, `qrcode_url`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Driver',	'Demo',	'driver@demo.com',	'MALE',	'+73',	'998020787',	0,	0,	'',	'',	'$2y$10$GB74MF5GBBo61pVytUQjuOuVhPSVbnB9wU7ry2ql86i0ea7MrpAwK',	'http://lorempixel.com/512/512/business/Moob',	5.00,	'document',	0,	0,	0,	0,	0,	0,	1,	-17.54608680,	-39.73949170,	NULL,	NULL,	NULL,	'manual',	NULL,	0,	0.00,	NULL,	NULL,	NULL,	'2020-06-10 03:52:13',	'2020-08-21 07:06:33'),
(2,	'Driver',	'Test',	'driver@mail.com',	'MALE',	'+55',	'1478523696',	1,	1,	'sadsadsad',	'sasdsad',	'$2y$10$fTYLx0gJoHNo5kBIO4wTzuoJWLylk68Vj8t2NiZwFjShYnQieXAv6',	NULL,	5.00,	'document',	0,	0,	0,	0,	0,	0,	0,	NULL,	NULL,	NULL,	NULL,	NULL,	'manual',	NULL,	0,	0.00,	'8795F7',	'uploads/1593685520162676352_1478523696.png',	'aYLONzhdZfhLEuygE8P3s0iMhY8iTVtMz1TUeByZDgM3KZLah1jZ0ecWX3hh',	'2020-06-10 07:00:50',	'2020-07-02 04:55:20'),
(3,	'Rocky',	'Rocky',	'Rocky@mail.com',	'MALE',	'India',	'9632587412',	1,	1,	'Indore, Madhya Pradesh, India',	'121325asasa',	'$2y$10$lMXNfVUMLY6A5zORW/FjT.tCVPmO/OaRwqhJn30ojHtEOm4w/QLfS',	NULL,	5.00,	'document',	0,	0,	0,	0,	0,	0,	0,	NULL,	NULL,	NULL,	NULL,	NULL,	'manual',	NULL,	0,	0.00,	NULL,	'uploads/1593685413964920194_9632587412.png',	NULL,	'2020-06-17 05:33:44',	'2020-07-02 04:53:33'),
(4,	'sk',	'shukla',	'skshukla@ymail.com',	'MALE',	'9565432328',	'8548555288',	2,	0,	'near street block 2/5 ',	'GDJ51115dh',	'$2y$10$1LxQ9eSSHu8Slv0x2UnuzOUMhCDQ8YQf75XXIoEdj0ZvEfEJTh0U.',	'provider/profile/7uP6UDt7s0avykRLSQ1gFFB57EXIqdaeJ5HdIGmL.png',	5.00,	'document',	1,	1,	1,	1,	1,	0,	1,	NULL,	NULL,	NULL,	NULL,	NULL,	'manual',	NULL,	0,	0.00,	NULL,	'uploads/1594014932754020765_8548555288.png',	NULL,	'2020-07-06 00:25:32',	'2020-08-20 07:26:53');

DROP TABLE IF EXISTS `provider_cards`;
CREATE TABLE `provider_cards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `last_four` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_default` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `provider_devices`;
CREATE TABLE `provider_devices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` int(11) NOT NULL,
  `udid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sns_arn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` enum('android','ios') COLLATE utf8_unicode_ci NOT NULL,
  `jwt_token` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `provider_documents`;
CREATE TABLE `provider_documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` int(11) NOT NULL,
  `document_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('ASSESSING','ACTIVE') COLLATE utf8_unicode_ci NOT NULL,
  `expires_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `provider_documents` (`id`, `provider_id`, `document_id`, `url`, `unique_id`, `status`, `expires_at`, `created_at`, `updated_at`) VALUES
(5,	4,	'13',	'provider/documents/4/DVLAElectronicCode.jpeg',	NULL,	'ASSESSING',	NULL,	'2020-08-07 04:20:58',	'2020-08-08 01:38:03'),
(6,	4,	'10',	'provider/documents/4/BankStatement.jpeg',	NULL,	'ASSESSING',	NULL,	'2020-08-08 01:06:25',	'2020-08-20 01:20:05');

DROP TABLE IF EXISTS `provider_profiles`;
CREATE TABLE `provider_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` int(11) NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_secondary` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `provider_services`;
CREATE TABLE `provider_services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` int(11) NOT NULL,
  `service_type_id` int(11) NOT NULL,
  `status` enum('active','offline','riding','hold','balance') COLLATE utf8_unicode_ci NOT NULL,
  `service_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `service_model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `provider_services` (`id`, `provider_id`, `service_type_id`, `status`, `service_number`, `service_model`, `created_at`, `updated_at`) VALUES
(1,	1,	1,	'active',	'2',	NULL,	'2020-06-10 03:52:13',	'2020-07-24 00:27:37'),
(2,	2,	1,	'active',	'UK5246',	'jaguar',	'2020-06-10 07:00:50',	'2020-07-17 01:48:29'),
(3,	3,	1,	'active',	'3213SADSAD',	'123456',	'2020-06-17 05:33:44',	'2020-07-02 04:53:33'),
(4,	4,	3,	'active',	'2',	NULL,	'2020-07-06 00:25:33',	'2020-07-22 07:27:21');

DROP TABLE IF EXISTS `provider_wallet`;
CREATE TABLE `provider_wallet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `transaction_alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` enum('C','D') COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(15,8) NOT NULL DEFAULT '0.00000000',
  `open_balance` double(15,8) NOT NULL DEFAULT '0.00000000',
  `close_balance` double(15,8) NOT NULL DEFAULT '0.00000000',
  `payment_mode` enum('BRAINTREE','CARD','PAYPAL','PAYUMONEY','PAYTM') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `push_subscriptions`;
CREATE TABLE `push_subscriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guard` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_id` int(10) unsigned DEFAULT NULL,
  `endpoint` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `public_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `push_subscriptions_endpoint_unique` (`endpoint`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `reasons`;
CREATE TABLE `reasons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('USER','PROVIDER') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'USER',
  `reason` text COLLATE utf8_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `reasons` (`id`, `type`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(1,	'PROVIDER',	'Take long time to reach pickup point',	0,	'2020-06-10 03:52:14',	'2020-06-10 03:52:14'),
(2,	'',	'Heavy Traffic',	0,	'2020-06-10 03:52:14',	'2020-06-10 03:52:14'),
(3,	'',	'User choose wrong location',	0,	'2020-06-10 03:52:14',	'2020-06-10 03:52:14'),
(4,	'',	'My reason not listed',	0,	'2020-06-10 03:52:14',	'2020-06-10 03:52:14'),
(5,	'',	'User Unavailable',	0,	'2020-06-10 03:52:14',	'2020-06-10 03:52:14'),
(6,	'',	'My reason not listed',	0,	'2020-06-10 03:52:14',	'2020-06-10 03:52:14'),
(7,	'',	'Unable to contact driver',	0,	'2020-06-10 03:52:14',	'2020-06-10 03:52:14'),
(8,	'',	'Expected a shoter wait time',	0,	'2020-06-10 03:52:14',	'2020-06-10 03:52:14'),
(9,	'',	'Driver denied to come and pikcup',	0,	'2020-06-10 03:52:14',	'2020-06-10 03:52:14'),
(10,	'',	'Driver denied to go to destination',	0,	'2020-06-10 03:52:14',	'2020-06-10 03:52:14'),
(11,	'',	'Driver Charged Extra',	0,	'2020-06-10 03:52:14',	'2020-06-10 03:52:14');

DROP TABLE IF EXISTS `referral_earnings`;
CREATE TABLE `referral_earnings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `referrer_id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1-user,2-provider',
  `amount` double(10,2) NOT NULL DEFAULT '0.00',
  `count` mediumint(9) NOT NULL DEFAULT '0',
  `referral_histroy_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `referral_histroy`;
CREATE TABLE `referral_histroy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `referrer_id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1-user,2-provider',
  `referral_id` int(11) NOT NULL,
  `referral_data` longtext COLLATE utf8_unicode_ci,
  `status` enum('P','C') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'C',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `request_filters`;
CREATE TABLE `request_filters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `request_waiting_time`;
CREATE TABLE `request_waiting_time` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `ended_at` timestamp NULL DEFAULT NULL,
  `waiting_mins` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1,	'ADMIN',	'admin',	NULL,	NULL),
(2,	'DISPATCHER',	'admin',	NULL,	NULL),
(3,	'DISPUTE',	'admin',	NULL,	NULL),
(4,	'ACCOUNT',	'admin',	NULL,	NULL),
(5,	'SUBADMIN',	'admin',	'2020-06-12 01:27:49',	'2020-07-01 02:41:00'),
(6,	'Darius',	'admin',	'2020-08-01 09:16:32',	'2020-08-01 09:16:32');

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1,	1),
(2,	1),
(3,	1),
(4,	1),
(5,	1),
(6,	1),
(7,	1),
(8,	1),
(9,	1),
(12,	1),
(13,	1),
(14,	1),
(15,	1),
(16,	1),
(17,	1),
(18,	1),
(19,	1),
(20,	1),
(21,	1),
(22,	1),
(23,	1),
(24,	1),
(25,	1),
(26,	1),
(27,	1),
(28,	1),
(29,	1),
(42,	1),
(43,	1),
(44,	1),
(45,	1),
(46,	1),
(48,	1),
(49,	1),
(50,	1),
(51,	1),
(52,	1),
(53,	1),
(54,	1),
(55,	1),
(56,	1),
(57,	1),
(58,	1),
(59,	1),
(60,	1),
(61,	1),
(62,	1),
(63,	1),
(64,	1),
(65,	1),
(66,	1),
(67,	1),
(68,	1),
(69,	1),
(70,	1),
(71,	1),
(72,	1),
(73,	1),
(74,	1),
(75,	1),
(76,	1),
(77,	1),
(78,	1),
(79,	1),
(80,	1),
(81,	1),
(82,	1),
(83,	1),
(84,	1),
(85,	1),
(86,	1),
(87,	1),
(88,	1),
(91,	1),
(93,	1),
(94,	1),
(95,	1),
(96,	1),
(97,	1),
(98,	1),
(99,	1),
(100,	1),
(101,	1),
(102,	1),
(103,	1),
(4,	2),
(5,	2),
(91,	2),
(6,	3),
(7,	3),
(8,	3),
(9,	3),
(91,	3),
(1,	4),
(2,	4),
(3,	4),
(47,	4),
(91,	4),
(1,	5),
(12,	5),
(13,	5),
(14,	5),
(15,	5),
(16,	5),
(17,	5),
(18,	5),
(19,	5),
(20,	5),
(21,	5),
(22,	5),
(23,	5),
(24,	5),
(25,	5),
(26,	5),
(27,	5),
(28,	5),
(93,	5),
(1,	6),
(3,	6);

DROP TABLE IF EXISTS `service_peak_hours`;
CREATE TABLE `service_peak_hours` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_type_id` int(11) NOT NULL,
  `peak_hours_id` int(11) NOT NULL,
  `min_price` double(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `service_types`;
CREATE TABLE `service_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marker` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `capacity` int(11) NOT NULL DEFAULT '0',
  `fixed` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `minute` int(11) NOT NULL,
  `hour` int(11) DEFAULT NULL,
  `distance` int(11) NOT NULL,
  `calculator` enum('MIN','HOUR','DISTANCE','DISTANCEMIN','DISTANCEHOUR') COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `waiting_free_mins` int(11) NOT NULL DEFAULT '0',
  `waiting_min_charge` double(10,2) NOT NULL DEFAULT '0.00',
  `intercitytripsamountdiscount` double(10,2) NOT NULL,
  `intercitytripextracharges` double(10,2) NOT NULL,
  `seheduletripamountdiscountwaitingtime` double(10,2) NOT NULL,
  `seheduletripextracharges` double(10,2) NOT NULL,
  `airportpickup` double(10,2) NOT NULL,
  `airportpickdropoff` double(10,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `normaltripsextracharges` double(10,2) NOT NULL,
  `normaltripsamountdiscount` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `service_types` (`id`, `name`, `provider_name`, `image`, `marker`, `capacity`, `fixed`, `price`, `minute`, `hour`, `distance`, `calculator`, `description`, `waiting_free_mins`, `waiting_min_charge`, `intercitytripsamountdiscount`, `intercitytripextracharges`, `seheduletripamountdiscountwaitingtime`, `seheduletripextracharges`, `airportpickup`, `airportpickdropoff`, `status`, `normaltripsextracharges`, `normaltripsamountdiscount`, `created_at`, `updated_at`) VALUES
(1,	'Sedan',	'Driver',	'http://bhanushainfosoft.live/taxiapp/public/asset/img/cars/sedan.png',	'http://bhanushainfosoft.live/taxiapp/public/asset/img/cars/sedan_marker.png',	0,	20,	10,	0,	NULL,	1,	'DISTANCE',	NULL,	0,	0.00,	0.00,	0.00,	0.00,	0.00,	0.00,	0.00,	1,	0.00,	0.00,	'2020-06-10 03:51:59',	'2020-06-10 03:51:59'),
(2,	'Hatchback',	'Driver',	'http://bhanushainfosoft.live/taxiapp/public/asset/img/cars/hatchback.png',	'http://bhanushainfosoft.live/taxiapp/public/asset/img/cars/hatchback_marker.png',	0,	20,	10,	0,	NULL,	1,	'DISTANCE',	NULL,	0,	0.00,	0.00,	0.00,	0.00,	0.00,	0.00,	0.00,	1,	0.00,	0.00,	'2020-06-10 03:51:59',	'2020-06-10 03:51:59'),
(3,	'SUV',	'Driver',	'http://bhanushainfosoft.live/taxiapp/public/asset/img/cars/suv.png',	'http://bhanushainfosoft.live/taxiapp/public/asset/img/cars/suv_marker.png',	0,	20,	10,	0,	NULL,	1,	'DISTANCE',	NULL,	0,	0.00,	0.00,	0.00,	0.00,	0.00,	0.00,	0.00,	1,	0.00,	0.00,	'2020-06-10 03:51:59',	'2020-06-10 03:51:59'),
(4,	'Limousine',	'Driver',	'http://bhanushainfosoft.live/taxiapp/public/asset/img/cars/limo.png',	'http://bhanushainfosoft.live/taxiapp/public/asset/img/cars/limo_marker.png',	0,	20,	10,	0,	NULL,	1,	'DISTANCE',	NULL,	0,	0.00,	0.00,	0.00,	0.00,	0.00,	0.00,	0.00,	1,	0.00,	0.00,	'2020-06-10 03:51:59',	'2020-06-10 03:51:59');

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `settings_key_index` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1,	'demo_mode',	'0'),
(2,	'help',	'<p>Support</p>'),
(3,	'page_privacy',	'<p></p>'),
(4,	'terms',	'<p></p>'),
(5,	'cancel',	'<p></p>');

DROP TABLE IF EXISTS `states`;
CREATE TABLE `states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `states` (`id`, `name`, `country_id`, `created_at`, `updated_at`) VALUES
(1,	'MP',	1,	NULL,	NULL),
(2,	'UP',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `tblbooking`;
CREATE TABLE `tblbooking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userEmail` varchar(100) DEFAULT NULL,
  `VehicleId` int(11) DEFAULT NULL,
  `FromDate` varchar(20) DEFAULT NULL,
  `ToDate` varchar(20) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tblbooking` (`id`, `userEmail`, `VehicleId`, `FromDate`, `ToDate`, `message`, `Status`, `PostingDate`) VALUES
(1,	'test@gmail.com',	2,	'22/06/2017',	'25/06/2017',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco',	1,	'2017-06-19 20:15:43'),
(2,	'test@gmail.com',	3,	'30/06/2017',	'02/07/2017',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco',	2,	'2017-06-26 20:15:43'),
(3,	'test@gmail.com',	4,	'02/07/2017',	'07/07/2017',	'Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ',	0,	'2017-06-26 21:10:06'),
(4,	'abhaysingh7295@gmail.com',	4,	'10/07/2020',	'12/07/2020',	'hi',	1,	'2020-07-04 06:13:11');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_mode` enum('BRAINTREE','CASH','CARD','PAYPAL','PAYPAL-ADAPTIVE','PAYUMONEY','PAYTM') COLLATE utf8_unicode_ci NOT NULL,
  `user_type` enum('INSTANT','NORMAL') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NORMAL',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('MALE','FEMALE') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'MALE',
  `country_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_type` enum('android','ios') COLLATE utf8_unicode_ci NOT NULL,
  `login_by` enum('manual','facebook','google') COLLATE utf8_unicode_ci NOT NULL,
  `social_unique_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` double(15,8) DEFAULT NULL,
  `longitude` double(15,8) DEFAULT NULL,
  `stripe_cust_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wallet_balance` double(8,2) NOT NULL DEFAULT '0.00',
  `rating` decimal(4,2) NOT NULL DEFAULT '5.00',
  `otp` mediumint(9) NOT NULL DEFAULT '0',
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qrcode_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referral_unique_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referal_count` mediumint(9) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `city` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_mobile_unique` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `payment_mode`, `user_type`, `email`, `gender`, `country_code`, `mobile`, `password`, `picture`, `device_token`, `device_id`, `device_type`, `login_by`, `social_unique_id`, `latitude`, `longitude`, `stripe_cust_id`, `wallet_balance`, `rating`, `otp`, `language`, `qrcode_url`, `referral_unique_id`, `referal_count`, `remember_token`, `status`, `city`, `country`, `created_at`, `updated_at`) VALUES
(1,	'User',	'Demo',	'BRAINTREE',	'NORMAL',	'User@demo.com',	'MALE',	'+73',	'998020787',	'$2y$10$Y5IHWUKVbLa131u.MVjtBeVeVehtVLFv7uEwuEsvUFFaxhsVPWLHi',	'http://lorempixel.com/512/512/business/Moob',	NULL,	NULL,	'android',	'manual',	NULL,	NULL,	NULL,	NULL,	0.00,	5.00,	0,	NULL,	'uploads/1592301235720877982_998020787.png',	NULL,	0,	NULL,	'approved',	0,	0,	'2020-06-10 03:52:11',	'2020-06-16 04:23:55'),
(2,	'Rider',	'Test',	'CASH',	'NORMAL',	'rider@mail.com',	'FEMALE',	'+55',	'1478523693',	'$2y$10$ivE4s910mgvZ7fBKp43aION881tZnOmKqlXfsNh0oNo7XzuAUsCQq',	'user/profile/Zf64dpdxhatTyOF6ReGdb399ibuQ7cQlAEhZpDHJ.jpeg',	NULL,	NULL,	'android',	'manual',	NULL,	NULL,	NULL,	NULL,	0.00,	5.00,	0,	NULL,	'uploads/15923012281548766863_1478523693.png',	'419D75',	0,	'l52WQF7Q2roc67TzxJIBbBAQDSQGA3fBI4GsPH0BoD49A8WUwEy8g1yInVw0',	'approved',	0,	0,	'2020-06-10 06:58:22',	'2020-06-16 04:26:51'),
(3,	'New ',	'New ',	'CASH',	'NORMAL',	'new@new.com',	'FEMALE',	'+91',	'9632587412',	'$2y$10$19OBCYFpHRPBku3Lm2Fwo.l7qzALX6OFtlY5Txebm2AgZgivF05yi',	'user/profile/KXDwJRFIUdJ4rtpZKdlN0YdiDKA7mDi2cBf2n2OJ.jpeg',	NULL,	NULL,	'android',	'manual',	NULL,	NULL,	NULL,	NULL,	0.00,	5.00,	0,	NULL,	'uploads/1593959955293939579_9632587412.png',	NULL,	0,	NULL,	'banned',	1,	1,	'2020-06-16 02:11:46',	'2020-07-05 09:09:15'),
(7,	'nikhil',	'shukla',	'CASH',	'NORMAL',	'shukla25@ymail.com',	'MALE',	'+91',	'5698245585',	'$2y$10$7SK1a28E8uk6ARLbW3g5runI2ApsIwEhVNooK5Ihzzb3acWtFwepy',	'user/profile/3fFmVMWKbqn9tsEG5ULWvyMSn3dj8BPDZe0eeq26.jpeg',	NULL,	NULL,	'android',	'manual',	NULL,	NULL,	NULL,	NULL,	0.00,	5.00,	0,	NULL,	'uploads/15940142091644857609_5698245585.png',	NULL,	0,	NULL,	'banned',	2,	1,	'2020-07-06 00:13:29',	'2020-08-20 04:49:11');

DROP TABLE IF EXISTS `user_requests`;
CREATE TABLE `user_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `braintree_nonce` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider_id` int(11) NOT NULL DEFAULT '0',
  `current_provider_id` int(11) NOT NULL,
  `service_type_id` int(11) NOT NULL,
  `promocode_id` int(11) NOT NULL,
  `rental_hours` int(11) DEFAULT NULL,
  `status` enum('SEARCHING','CANCELLED','ACCEPTED','STARTED','ARRIVED','PICKEDUP','DROPPED','COMPLETED','SCHEDULED') COLLATE utf8_unicode_ci NOT NULL,
  `cancelled_by` enum('NONE','USER','PROVIDER') COLLATE utf8_unicode_ci NOT NULL,
  `cancel_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_mode` enum('BRAINTREE','CASH','CARD','PAYPAL','PAYPAL-ADAPTIVE','PAYUMONEY','PAYTM') COLLATE utf8_unicode_ci NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `is_track` enum('YES','NO') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO',
  `estimated_fare` double(10,2) NOT NULL,
  `distance` double(15,8) NOT NULL,
  `travel_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit` enum('Kms','Miles') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Kms',
  `otp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s_latitude` double(15,8) NOT NULL,
  `s_longitude` double(15,8) NOT NULL,
  `d_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `d_latitude` double(15,8) DEFAULT NULL,
  `d_longitude` double(15,8) DEFAULT NULL,
  `track_distance` double(15,8) NOT NULL DEFAULT '0.00000000',
  `track_latitude` double(15,8) NOT NULL DEFAULT '0.00000000',
  `track_longitude` double(15,8) NOT NULL DEFAULT '0.00000000',
  `destination_log` longtext COLLATE utf8_unicode_ci,
  `is_drop_location` tinyint(1) NOT NULL DEFAULT '1',
  `is_instant_ride` tinyint(1) NOT NULL DEFAULT '0',
  `is_dispute` tinyint(1) NOT NULL DEFAULT '0',
  `assigned_at` timestamp NULL DEFAULT NULL,
  `schedule_at` timestamp NULL DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `finished_at` timestamp NULL DEFAULT NULL,
  `is_scheduled` enum('YES','NO') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO',
  `user_rated` tinyint(1) NOT NULL DEFAULT '0',
  `provider_rated` tinyint(1) NOT NULL DEFAULT '0',
  `use_wallet` tinyint(1) NOT NULL DEFAULT '0',
  `surge` tinyint(1) NOT NULL DEFAULT '0',
  `route_key` longtext COLLATE utf8_unicode_ci NOT NULL,
  `nonce` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `user_request_disputes`;
CREATE TABLE `user_request_disputes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `dispute_type` enum('user','provider') COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `dispute_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dispute_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refund_amount` double(10,2) NOT NULL DEFAULT '0.00',
  `status` enum('open','closed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'open',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `user_request_lost_items`;
CREATE TABLE `user_request_lost_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `lost_item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comments` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comments_by` enum('user','admin') COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('open','closed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'open',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `user_request_payments`;
CREATE TABLE `user_request_payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `promocode_id` int(11) DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_mode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fixed` double(10,2) NOT NULL DEFAULT '0.00',
  `distance` double(10,2) NOT NULL DEFAULT '0.00',
  `minute` double(10,2) NOT NULL DEFAULT '0.00',
  `hour` double(10,2) NOT NULL DEFAULT '0.00',
  `commision` double(10,2) NOT NULL DEFAULT '0.00',
  `commision_per` double(5,2) NOT NULL DEFAULT '0.00',
  `discount` double(10,2) NOT NULL DEFAULT '0.00',
  `discount_per` double(5,2) NOT NULL DEFAULT '0.00',
  `tax` double(10,2) NOT NULL DEFAULT '0.00',
  `tax_per` double(5,2) NOT NULL DEFAULT '0.00',
  `wallet` double(10,2) NOT NULL DEFAULT '0.00',
  `is_partial` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-No,1-Yes',
  `cash` double(10,2) NOT NULL DEFAULT '0.00',
  `card` double(10,2) NOT NULL DEFAULT '0.00',
  `online` double(10,2) NOT NULL DEFAULT '0.00',
  `surge` double(10,2) NOT NULL DEFAULT '0.00',
  `toll_charge` double(10,2) NOT NULL DEFAULT '0.00',
  `round_of` double(10,2) NOT NULL DEFAULT '0.00',
  `peak_amount` double(10,2) NOT NULL DEFAULT '0.00',
  `peak_comm_amount` double(10,2) NOT NULL DEFAULT '0.00',
  `total_waiting_time` int(11) NOT NULL DEFAULT '0',
  `waiting_amount` double(10,2) NOT NULL DEFAULT '0.00',
  `waiting_comm_amount` double(10,2) NOT NULL DEFAULT '0.00',
  `tips` double(10,2) NOT NULL DEFAULT '0.00',
  `total` double(10,2) NOT NULL DEFAULT '0.00',
  `payable` double(8,2) NOT NULL DEFAULT '0.00',
  `provider_commission` double(8,2) NOT NULL DEFAULT '0.00',
  `provider_pay` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `user_request_ratings`;
CREATE TABLE `user_request_ratings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `user_rating` int(11) NOT NULL DEFAULT '0',
  `provider_rating` int(11) NOT NULL DEFAULT '0',
  `user_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `user_wallet`;
CREATE TABLE `user_wallet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `transaction_alias` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` enum('C','D') COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(15,8) NOT NULL DEFAULT '0.00000000',
  `open_balance` double(15,8) NOT NULL DEFAULT '0.00000000',
  `close_balance` double(15,8) NOT NULL DEFAULT '0.00000000',
  `payment_mode` enum('BRAINTREE','CARD','PAYPAL','PAYUMONEY','PAYTM') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `vehicleluggages`;
CREATE TABLE `vehicleluggages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NumberPassengers` varchar(250) NOT NULL,
  `LargeLuggages` varchar(250) NOT NULL,
  `SmallLuggages` varchar(250) NOT NULL,
  `seattype` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `vehicleluggages` (`id`, `NumberPassengers`, `LargeLuggages`, `SmallLuggages`, `seattype`, `created_at`, `updated_at`) VALUES
(4,	'Up to 4',	'2',	'1',	2,	'0000-00-00 00:00:00',	'2020-07-26 08:05:43'),
(5,	'Up to 4',	'1',	'Up to 3',	1,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(6,	'Up to 4',	'0',	'Up to 5',	1,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `make` varchar(250) NOT NULL,
  `model` varchar(250) NOT NULL,
  `color` varchar(250) NOT NULL,
  `registrationNumber` varchar(250) NOT NULL,
  `registration_expire` date NOT NULL,
  `PHCLicenceNumber` varchar(250) NOT NULL,
  `PHCLicenceNumberExpire` date DEFAULT NULL,
  `is_logo` int(11) NOT NULL DEFAULT '0',
  `is_ft` int(11) NOT NULL DEFAULT '0',
  `is_pt` int(11) NOT NULL DEFAULT '0',
  `is_schedule` int(11) NOT NULL DEFAULT '0',
  `is_notes` int(11) NOT NULL DEFAULT '0',
  `is_induction` int(11) NOT NULL DEFAULT '0',
  `is_companyscar` int(11) NOT NULL DEFAULT '0',
  `seatType` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `vehicles` (`id`, `make`, `model`, `color`, `registrationNumber`, `registration_expire`, `PHCLicenceNumber`, `PHCLicenceNumberExpire`, `is_logo`, `is_ft`, `is_pt`, `is_schedule`, `is_notes`, `is_induction`, `is_companyscar`, `seatType`, `created_at`, `updated_at`) VALUES
(2,	'ASAS',	'Asas',	'Red',	'ASAS',	'0000-00-00',	'ASAs',	NULL,	1,	1,	1,	1,	0,	1,	1,	1,	'2020-07-18 07:36:55',	'2020-08-07 01:18:37');

DROP TABLE IF EXISTS `vehicle_documents`;
CREATE TABLE `vehicle_documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `document_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('ASSESSING','ACTIVE') COLLATE utf8_unicode_ci NOT NULL,
  `expires_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `vehicle_seattypes`;
CREATE TABLE `vehicle_seattypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `vehicle_seattypes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'FTF 4 seaters',	'2020-07-18 10:18:30',	NULL),
(2,	'FTF 4 seaters super',	'2020-07-18 10:18:30',	NULL),
(3,	'FTF 6 seaters',	'2020-07-18 10:18:30',	NULL),
(4,	'FTF 8 seaters',	'2020-07-18 10:18:30',	NULL);

DROP TABLE IF EXISTS `wallet_passbooks`;
CREATE TABLE `wallet_passbooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` enum('CREDITED','DEBITED') COLLATE utf8_unicode_ci NOT NULL,
  `via` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `wallet_requests`;
CREATE TABLE `wallet_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `request_from` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user,provider',
  `from_id` int(11) NOT NULL,
  `from_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` enum('C','D') COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(15,8) NOT NULL DEFAULT '0.00000000',
  `send_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'online,offline',
  `send_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-Pendig,1-Approved,2-cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `works`;
CREATE TABLE `works` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `work` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- 2020-08-29 10:25:01
