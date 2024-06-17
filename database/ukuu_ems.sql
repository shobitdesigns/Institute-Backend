/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - ukuu_ems
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ukuu_ems` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `ukuu_ems`;

/*Table structure for table `activity_logs` */

DROP TABLE IF EXISTS `activity_logs`;

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` text DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `action_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `activity_logs` */

insert  into `activity_logs`(`id`,`action`,`module`,`module_id`,`message`,`action_by`,`created_at`,`updated_at`) values 
(1,'created','leave',1,'Archana has created leave from \'2024-06-11\' to \'2024-06-11\'',6,'2024-06-11 05:06:21','2024-06-11 05:06:21'),
(2,'created','leave',3,'Raman has created leave from \'2024-06-13\' to \'2024-06-15\'',2,'2024-06-11 06:07:56','2024-06-11 06:07:56'),
(3,'created','leave',6,'Raman has created leave from \'2024-06-12\' to \'2024-06-12\'',2,'2024-06-11 06:20:40','2024-06-11 06:20:40');

/*Table structure for table `attendance` */

DROP TABLE IF EXISTS `attendance`;

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `leaving_time` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `attendance` */

insert  into `attendance`(`id`,`user_id`,`attendance_date`,`arrival_time`,`leaving_time`,`created_at`,`updated_at`) values 
(14,1,'2024-05-11','16:26:20','18:00:20','2024-05-13 12:06:01','2024-05-11 10:56:27'),
(15,1,'2024-05-13','09:00:00',NULL,'2024-05-13 10:06:40','2024-05-13 03:49:09'),
(16,2,'2024-05-13','09:21:59',NULL,'2024-05-13 03:51:59','2024-05-13 03:51:59'),
(17,4,'2024-05-13','09:22:32',NULL,'2024-05-13 03:52:32','2024-05-13 03:52:32'),
(18,5,'2024-05-13','09:23:01',NULL,'2024-05-13 03:53:01','2024-05-13 03:53:01'),
(19,6,'2024-05-13','09:23:21',NULL,'2024-05-13 03:53:21','2024-05-13 03:53:21'),
(20,2,'2024-06-03','09:33:52',NULL,'2024-06-03 04:03:52','2024-06-03 04:03:52'),
(21,4,'2024-06-03','09:34:13',NULL,'2024-06-03 04:04:13','2024-06-03 04:04:13'),
(23,1,'2024-06-03','09:56:05','09:56:14','2024-06-03 09:56:14','2024-06-03 04:26:14');

/*Table structure for table `documents` */

DROP TABLE IF EXISTS `documents`;

CREATE TABLE `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `aadhar_card` text DEFAULT NULL,
  `bank_document` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `documents` */

insert  into `documents`(`id`,`user_id`,`aadhar_card`,`bank_document`,`created_at`,`updated_at`) values 
(1,4,'Shobit_aadhar_card_1715411813.pdf','Shobit_bank_document_1715411813.pdf','2024-05-11 12:46:53','2024-05-11 07:16:53'),
(2,2,'Raman_aadhar_card_1715412177.pdf','Raman_bank_document_1715412177.pdf','2024-05-11 07:22:57','2024-05-11 07:22:57');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `leaves` */

DROP TABLE IF EXISTS `leaves`;

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `leave_type` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `leaves` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1);

/*Table structure for table `modules` */

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `modules` */

insert  into `modules`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'user','2024-03-11 13:13:35','2024-03-11 07:43:35'),
(3,'employee','2024-06-03 04:11:58','2024-06-03 04:11:58');

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `permission_role` */

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `permission_role` */

insert  into `permission_role`(`id`,`role_id`,`permission_id`) values 
(2,3,4);

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`description`,`module_id`,`created_at`,`updated_at`) values 
(1,'management',NULL,1,'2024-03-11 13:14:32','2024-03-11 07:44:32'),
(4,'management',NULL,3,'2024-06-03 04:12:16','2024-06-03 04:12:16');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `role_user` */

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `role_user` */

insert  into `role_user`(`id`,`user_id`,`role_id`) values 
(1,2,3),
(2,6,3);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`description`,`created_at`,`updated_at`) values 
(1,'admin',NULL,'2024-03-11 07:41:11','2024-03-11 07:41:11'),
(3,'employee',NULL,'2024-05-10 15:46:24','2024-03-11 07:47:02');

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `settings` */

insert  into `settings`(`id`,`name`,`logo`,`created_at`,`updated_at`) values 
(1,'UKUU CMS','logo_1715404877.jpeg','2024-05-11 10:51:17','2024-05-11 05:21:17');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `super_admin` int(11) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `contact_number` varchar(60) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`super_admin`,`profile_pic`,`contact_number`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'avinash','avinash@gmail.com',NULL,'$2y$12$XwMucxK7P34wktT3Vx/yaeSw5/G1Y3fNV1dRPm3.xz7OL4YODpjSu',NULL,1,NULL,NULL,'2024-05-10 15:25:19','2024-05-10 15:25:21',NULL),
(2,'raman','raman@gmail.com',NULL,'$2y$10$JEQNW/5O/9HHSsCb/wRWFOBdGQLZnjZR72YXX6qpXxjJlpS8OEmge',NULL,NULL,'user_1715404247.jpeg','8989898989','2024-05-11 05:10:47','2024-05-11 06:41:47',NULL),
(4,'shobit','shobit@gmail.com',NULL,'$2y$10$tYDWWTH35GrdTyA.Tt86X.BDnG6NcObIqGQFEslo9BYbBUaT0OlbK',NULL,NULL,'user_1715411632.webp','8787878787','2024-05-11 05:55:10','2024-05-11 07:13:52',NULL),
(5,'satyam','satyam@gmail.com',NULL,'$2y$10$XJZwP5cM85ba8eW1A0eDfOhAlK397yv33PnIlgVlaUcVuHd0YwJEC',NULL,NULL,NULL,'8989898989','2024-05-13 03:50:29','2024-05-13 03:50:29',NULL),
(6,'archana','archana@gmail.com',NULL,'$2y$10$bSnfsrpa0hAtoTRLELBaaObSA6DVapVqsd2oHs6B0fNvW3WKWA4km',NULL,NULL,NULL,'8989898898','2024-05-13 03:51:01','2024-05-13 03:51:01',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
