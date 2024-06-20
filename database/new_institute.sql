/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - new_institute
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`new_institute` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `new_institute`;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `activity_logs` */

insert  into `activity_logs`(`id`,`action`,`module`,`module_id`,`message`,`action_by`,`created_at`,`updated_at`) values 
(1,'created','leave',1,'Archana has created leave from \'2024-06-11\' to \'2024-06-11\'',6,'2024-06-11 05:06:21','2024-06-11 05:06:21'),
(2,'created','leave',3,'Raman has created leave from \'2024-06-13\' to \'2024-06-15\'',2,'2024-06-11 06:07:56','2024-06-11 06:07:56'),
(3,'created','leave',6,'Raman has created leave from \'2024-06-12\' to \'2024-06-12\'',2,'2024-06-11 06:20:40','2024-06-11 06:20:40'),
(4,'created','leave',8,'Raman has created leave from \'2024-06-12\' to \'2024-06-12\'',2,'2024-06-12 05:23:23','2024-06-12 05:23:23'),
(5,'created','leave',9,'Raman has created leave from \'2024-06-12\' to \'2024-06-12\'',2,'2024-06-12 05:23:42','2024-06-12 05:23:42'),
(6,'created','leave',10,'Raman has created leave from \'2024-06-13\' to \'2024-06-13\'',2,'2024-06-12 05:30:38','2024-06-12 05:30:38'),
(7,'created','leave',11,'Raman has created leave from \'2024-06-13\' to \'2024-06-13\'',2,'2024-06-12 05:31:19','2024-06-12 05:31:19'),
(8,'created','student',6,'Lakhvinder Singh has register ',2,'2024-06-17 10:17:34','2024-06-17 10:17:34');

/*Table structure for table `course_qualifications` */

DROP TABLE IF EXISTS `course_qualifications`;

CREATE TABLE `course_qualifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `qualification_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `course_qualifications` */

insert  into `course_qualifications`(`id`,`course_id`,`qualification_id`) values 
(3,4,1),
(4,4,3),
(6,1,1);

/*Table structure for table `courses` */

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `duration` varchar(60) DEFAULT NULL,
  `mrp` varchar(60) DEFAULT NULL,
  `fix_price` varchar(60) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `courses` */

insert  into `courses`(`id`,`name`,`duration`,`mrp`,`fix_price`,`added_by`,`created_at`,`updated_at`) values 
(1,'COOKING course','6','10000','8000',1,'2024-06-18 10:32:40',NULL),
(4,'Bachelor of Hotel Management (BHM)','12','80000','70000',1,'2024-06-19 04:01:57','2024-06-19 04:01:57');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `permission_role` */

insert  into `permission_role`(`id`,`role_id`,`permission_id`) values 
(3,3,4);

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

/*Table structure for table `qualifications` */

DROP TABLE IF EXISTS `qualifications`;

CREATE TABLE `qualifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qualification` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `qualifications` */

insert  into `qualifications`(`id`,`qualification`,`created_at`,`updated_at`) values 
(1,'10th','2024-06-18 15:57:58','2024-06-18 10:27:58'),
(3,'12th','2024-06-18 09:38:56','2024-06-18 09:38:56');

/*Table structure for table `role_user` */

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `role_user` */

insert  into `role_user`(`id`,`user_id`,`role_id`) values 
(3,4,3),
(5,2,3);

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
(1,'Institute','logo_1718347227.jpeg','2024-06-14 12:10:27','2024-06-14 06:40:27');

/*Table structure for table `student_courses` */

DROP TABLE IF EXISTS `student_courses`;

CREATE TABLE `student_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `monthly_payment` varchar(255) DEFAULT NULL,
  `course_fixed_price` varchar(60) DEFAULT NULL,
  `installment_months` varchar(60) DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `student_courses` */

insert  into `student_courses`(`id`,`student_id`,`course_id`,`added_by`,`monthly_payment`,`course_fixed_price`,`installment_months`,`payment_mode`,`created_at`,`updated_at`) values 
(1,1,1,1,NULL,'8000',NULL,NULL,'2024-06-20 05:57:00','2024-06-20 05:57:00'),
(4,4,4,1,'10000.00','70000','6','installment','2024-06-20 06:47:54','2024-06-20 06:47:54');

/*Table structure for table `student_payments` */

DROP TABLE IF EXISTS `student_payments`;

CREATE TABLE `student_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_course_id` int(11) DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `pay` varchar(60) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `student_payments` */

insert  into `student_payments`(`id`,`student_course_id`,`payment_mode`,`payment_method`,`pay`,`created_at`,`updated_at`) values 
(1,1,'full_pay','offline','8000','2024-06-20 05:57:00','2024-06-20 05:57:00'),
(3,4,'installment','online','10000','2024-06-20 06:47:54','2024-06-20 06:47:54');

/*Table structure for table `students` */

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(60) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tenth_document` varchar(255) DEFAULT NULL,
  `twelfth_document` varchar(255) DEFAULT NULL,
  `aadhaar_document` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `students` */

insert  into `students`(`id`,`unique_id`,`first_name`,`last_name`,`email`,`mobile`,`user_id`,`tenth_document`,`twelfth_document`,`aadhaar_document`,`created_at`,`updated_at`) values 
(1,'J-1001','shobit','thakur','shobit@gmail.com','8989898989',1,'Shobit_student_tenth_document.pdf',NULL,NULL,'2024-06-20 11:27:00','2024-06-20 05:57:00'),
(4,'J-1002','roshan','kumar','roshan@gmail.com','9898989898',1,NULL,NULL,NULL,'2024-06-20 06:47:54','2024-06-20 06:47:54');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `super_admin` tinyint(1) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `contact_number` varchar(60) DEFAULT NULL,
  `10th_document` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`super_admin`,`profile_pic`,`contact_number`,`10th_document`,`created_at`,`updated_at`) values 
(1,'aviansh','avinash@gmail.com',NULL,'$2y$10$HjbFAdY5FzlaqZiJB6m7quGmCeWf4vTZGczOxtuxbDn8upfi3Ki.y',NULL,1,NULL,NULL,NULL,'2024-06-14 06:01:22','2024-06-14 06:01:22'),
(2,'lakhvinder singh','lakhvinder@gmail.com',NULL,'$2y$10$JPA3yfsf7q5oToAiMia2NOXZYUu/OrlPgTMzHujiZbiKOObWJMjki',NULL,NULL,'user_1718347473.jpg','0987654321',NULL,'2024-06-14 06:44:33','2024-06-14 06:45:13');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
