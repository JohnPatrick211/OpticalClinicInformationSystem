

CREATE TABLE `tbl_appointment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_schedule_id` int(11) NOT NULL,
  `appointment_number` int(11) NOT NULL,
  `reason_for_appointment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `appointment_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `tbl_audit_trail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `tbl_appointmentreport` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(255) DEFAULT NULL,
  `doctor_id` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `reason` longtext DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `tbl_billingtray` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `tbl_branch` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branchname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `tbl_category` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `tbl_certification` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `doctor_id` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `impressions` longtext DEFAULT NULL,
  `diagnosis` longtext DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `tbl_discount` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pwd_discount` decimal(8,2) NOT NULL DEFAULT 0.12,
  `senior_discount` decimal(8,2) NOT NULL DEFAULT 0.12,
  `minimum_purchase` decimal(8,2) NOT NULL,
  `discount_percentage` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `tbl_doctor` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `specialty` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `tbl_doctorschedule` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `doctor_schedule_date` date NOT NULL,
  `doctor_schedule_day` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') COLLATE utf8_unicode_ci NOT NULL,
  `doctor_schedule_start_time` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_schedule_end_time` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `tbl_prescription` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(255) DEFAULT NULL,
  `prescription` longtext DEFAULT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `branchname` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `tbl_product` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `productname` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `reorder` int(11) NOT NULL,
  `orig_price` decimal(8,2) NOT NULL,
  `selling_price` decimal(8,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `markup` decimal(8,2) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `tbl_sales` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_no` int(5) unsigned NOT NULL,
  `productname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `wholesale_discount_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `senior_pwd_discount_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(8,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `tbl_service` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `servicename` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `orig_price` decimal(8,2) NOT NULL,
  `selling_price` decimal(8,2) NOT NULL,
  `markup` decimal(8,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `tbl_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_role` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `validid` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `birthdate` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `civilstatus` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `archive_status` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_appointment (`id`, `doctor_id`, `patient_id`, `doctor_schedule_id`, `appointment_number`, `reason_for_appointment`, `appointment_time`, `status`, `created_at`, `updated_at`) VALUES 
('7','15','8','8','1008','Sample Appointment 2','3:00 AM - 5:00 AM','Completed','','');

INSERT INTO tbl_appointment (`id`, `doctor_id`, `patient_id`, `doctor_schedule_id`, `appointment_number`, `reason_for_appointment`, `appointment_time`, `status`, `created_at`, `updated_at`) VALUES 
('14','12','4','1','1004','sa','12:00 PM - 2:00 PM','Completed','','');

INSERT INTO tbl_appointment (`id`, `doctor_id`, `patient_id`, `doctor_schedule_id`, `appointment_number`, `reason_for_appointment`, `appointment_time`, `status`, `created_at`, `updated_at`) VALUES 
('23','12','8','1','1008','My eyes are hurt','12:00 PM - 2:00 PM','Completed','','');

INSERT INTO tbl_appointment (`id`, `doctor_id`, `patient_id`, `doctor_schedule_id`, `appointment_number`, `reason_for_appointment`, `appointment_time`, `status`, `created_at`, `updated_at`) VALUES 
('25','16','4','9','1004','My head hurts','12:00 PM - 2:00 AM','Completed','','');

INSERT INTO tbl_appointment (`id`, `doctor_id`, `patient_id`, `doctor_schedule_id`, `appointment_number`, `reason_for_appointment`, `appointment_time`, `status`, `created_at`, `updated_at`) VALUES 
('26','16','4','9','1004','My eyes are red','12:00 PM - 2:00 AM','Completed','','');

INSERT INTO tbl_appointment (`id`, `doctor_id`, `patient_id`, `doctor_schedule_id`, `appointment_number`, `reason_for_appointment`, `appointment_time`, `status`, `created_at`, `updated_at`) VALUES 
('33','12','4','1','1004','3333333','12:00 PM - 2:00 PM','Completed','','');

INSERT INTO tbl_appointment (`id`, `doctor_id`, `patient_id`, `doctor_schedule_id`, `appointment_number`, `reason_for_appointment`, `appointment_time`, `status`, `created_at`, `updated_at`) VALUES 
('34','15','4','8','1004','sample appointment 3','3:00 AM - 5:00 AM','Completed','','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('51','Cladie Mae Baudillo','Patient','Login','login','2022-07-31 07:07:14','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('52','Cladie Mae Baudillo','Patient','Logout','logout','2022-07-31 07:07:32','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('53','System Admin','System Admin','Login','login','2022-07-31 07:07:37','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('54','System Admin','System Admin','Schedule Maintenance','Update Schedule Sucessfully','2022-07-31 07:07:02','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('55','System Admin','System Admin','Schedule Maintenance','Update Schedule Sucessfully','2022-07-31 07:07:07','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('56','System Admin','System Admin','Schedule Maintenance','Update Schedule Sucessfully','2022-07-31 07:07:28','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('57','System Admin','System Admin','Service Maintenance','Deleted Successfully Service id9','2022-07-31 07:07:40','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('58','System Admin','System Admin','Schedule Maintenance','Deleted Successfully Schedule id9','2022-07-31 07:07:41','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('59','System Admin','System Admin','Logout','logout','2022-07-31 07:07:53','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('60','Cladie Mae Baudillo','Patient','Login','login','2022-07-31 07:07:00','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('61','Cladie Mae Baudillo','Patient','Logout','logout','2022-07-31 07:07:38','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('62','System Admin','System Admin','Login','login','2022-07-31 07:07:42','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('63','System Admin','System Admin','Archive','Retrieve Doctor Account Successfully ID number: 16','2022-07-31 07:07:58','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('64','System Admin','System Admin','User Maintenance','Archive','2022-07-31 07:07:13','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('65','System Admin','System Admin','User Maintenance','Add','2022-07-31 08:07:11','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('66','System Admin','System Admin','User Maintenance','Archive','2022-07-31 08:07:19','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('67','System Admin','System Admin','Archive','Retrieve Secretary Account Successfully ID number: 28','2022-07-31 08:07:31','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('68','System Admin','System Admin','User Maintenance','Archive','2022-07-31 08:07:43','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('69','System Admin','System Admin','Logout','logout','2022-07-31 08:07:47','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('70','System Admin','System Admin','Login','login','2022-07-31 08:07:59','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('71','System Admin','System Admin','User Maintenance','Archive','2022-07-31 08:07:16','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('72','System Admin','System Admin','Archive','Retrieve Staff Account Successfully ID number: 14','2022-07-31 08:07:30','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('73','System Admin','System Admin','Logout','logout','2022-07-31 09:07:25','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('74','Cladie Mae Baudillo','Patient','Login','login','2022-07-31 09:07:32','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('75','Cladie Mae Baudillo','Patient','Logout','logout','2022-07-31 09:07:41','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('76','Wyns Alvez','Patient','Login','login','2022-07-31 09:07:47','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('77','Wyns Alvez','Patient','Logout','logout','2022-07-31 09:07:43','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('78','System Admin','System Admin','Login','login','2022-07-31 09:07:48','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('79','System Admin','System Admin','Schedule Maintenance','Update Schedule Sucessfully','2022-07-31 09:07:03','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('80','System Admin','System Admin','Schedule Maintenance','Update Schedule Sucessfully','2022-07-31 09:07:10','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('81','System Admin','System Admin','Logout','logout','2022-07-31 09:07:14','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('82','Wyns Alvez','Patient','Login','login','2022-07-31 09:07:23','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('83','Wyns Alvez','Patient','Patient Appointment List','Cancel Appointment','2022-07-31 09:07:02','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('84','Wyns Alvez','Patient','Patient Appointment List','Cancel Appointment','2022-07-31 09:07:06','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('85','Wyns Alvez','Patient','Patient Appointment List','Cancel Appointment','2022-07-31 09:07:17','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('86','Wyns Alvez','Patient','Patient Appointment List','Cancel Appointment','2022-07-31 09:07:20','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('87','Wyns Alvez','Patient','Patient Appointment List','Cancel Appointment','2022-07-31 09:07:23','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('88','Wyns Alvez','Patient','Patient Appointment List','Cancel Appointment','2022-07-31 09:07:25','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('89','Wyns Alvez','Patient','Logout','logout','2022-07-31 09:07:42','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('90','System Admin','System Admin','Login','login','2022-07-31 09:07:47','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('91','System Admin','System Admin','Appointment Approval','Appointment Approved','2022-07-31 09:07:18','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('92','System Admin','System Admin','Billing','Billing Success','2022-07-31 09:07:27','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('93','System Admin','System Admin','Billing','Billing Success','2022-07-31 09:07:13','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('94','System Admin','System Admin','Logout','logout','2022-07-31 10:07:04','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('95','Cladie Mae Baudillo','Patient','Login','login','2022-07-31 10:07:10','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('96','Cladie Mae Baudillo','Patient','Logout','logout','2022-07-31 10:07:20','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('97','System Admin','System Admin','Login','login','2022-07-31 10:07:24','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('98','System Admin','System Admin','Logout','logout','2022-07-31 10:07:15','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('99','System Admin','System Admin','Login','login','2022-07-31 01:07:40','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('100','System Admin','System Admin','Logout','logout','2022-07-31 01:07:11','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('101','Wyns Alvez','Patient','Login','login','2022-07-31 01:07:28','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('102','Wyns Alvez','Patient','Logout','logout','2022-07-31 01:07:23','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('103','System Admin','System Admin','Login','login','2022-07-31 01:07:51','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('104','System Admin','System Admin','Logout','logout','2022-07-31 01:07:18','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('105','Cladie Mae Baudillo','Patient','Login','login','2022-07-31 01:07:24','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('106','System Admin','System Admin','Login','login','2022-08-15 02:08:38','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('107','System Admin','System Admin','Logout','logout','2022-08-15 02:08:19','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('108','John Adrian Ramos','Patient','Login','login','2022-08-15 02:08:08','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('109','John Adrian Ramos','Patient','Logout','logout','2022-08-15 02:08:27','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('110','Cladie Mae Baudillo','Patient','Login','login','2022-08-15 02:08:36','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('111','Cladie Mae Baudillo','Patient','Logout','logout','2022-08-15 02:08:18','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('112','System Admin','System Admin','Login','login','2022-08-15 02:08:23','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('113','System Admin','System Admin','User Maintenance','update','2022-08-15 02:08:28','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('114','System Admin','System Admin','User Maintenance','update','2022-08-15 02:08:25','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('115','System Admin','System Admin','Schedule Maintenance','Update Schedule Sucessfully','2022-08-15 02:08:46','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('116','System Admin','System Admin','Logout','logout','2022-08-15 02:08:54','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('117','John Adrian Ramos','Patient','Login','login','2022-08-15 02:08:07','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('118','John Adrian Ramos','Patient','Logout','logout','2022-08-15 02:08:10','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('119','System Admin','System Admin','Login','login','2022-08-15 02:08:17','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('120','System Admin','System Admin','Schedule Maintenance','Update Schedule Sucessfully','2022-08-15 02:08:21','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('121','System Admin','System Admin','Appointment Schedule','Appointment Completed','2022-08-15 02:08:10','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('122','System Admin','System Admin','Logout','logout','2022-08-15 02:08:53','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('123','John Adrian Ramos','Patient','Login','login','2022-08-15 02:08:01','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('124','John Adrian Ramos','Patient','Logout','logout','2022-08-15 04:08:10','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('125','System Admin','System Admin','Login','login','2022-08-15 04:08:17','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('126','System Admin','System Admin','Appointment Approval','Appointment Approved','2022-08-15 04:08:37','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('127','System Admin','System Admin','Schedule Maintenance','Update Schedule Sucessfully','2022-08-15 04:08:10','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('128','System Admin','System Admin','Appointment Schedule','Appointment Completed','2022-08-15 04:08:41','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('129','System Admin','System Admin','Logout','logout','2022-08-15 04:08:46','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('130','John Adrian Ramos','Patient','Login','login','2022-08-15 04:08:55','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('131','John Adrian Ramos','Patient','Logout','logout','2022-08-15 04:08:31','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('132','System Admin','System Admin','Login','login','2022-08-15 04:08:44','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('133','System Admin','System Admin','Patient Approval','Patient Approved, Patient NameJohn Adrian Ramos2','2022-08-15 04:08:25','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('134','System Admin','System Admin','Patient Approval','Patient Rejected','2022-08-15 05:08:34','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('135','System Admin','System Admin','Logout','logout','2022-08-15 05:08:57','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('136','System Admin','System Admin','Login','login','2022-08-15 05:08:14','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('137','System Admin','System Admin','Patient Approval','Patient Rejected','2022-08-15 05:08:27','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('138','System Admin','System Admin','Logout','logout','2022-08-15 05:08:31','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('139','System Admin','System Admin','Login','login','2022-08-15 05:08:37','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('140','System Admin','System Admin','Product Maintenance','Add Product Successfully','2022-08-15 05:08:22','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('141','System Admin','System Admin','Billing','Billing Success','2022-08-15 05:08:01','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('142','System Admin','System Admin','Billing','Billing Success','2022-08-15 05:08:01','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('143','System Admin','System Admin','Service Maintenance','Add Service Successfully','2022-08-15 05:08:37','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('144','System Admin','System Admin','Login','login','2022-08-16 02:08:24','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('145','System Admin','System Admin','User Maintenance','update','2022-08-16 02:08:05','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('146','System Admin','System Admin','User Maintenance','update','2022-08-16 03:08:52','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('147','System Admin','System Admin','User Maintenance','update','2022-08-16 03:08:47','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('148','System Admin','System Admin','User Maintenance','update','2022-08-16 03:08:54','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('149','System Admin','System Admin','User Maintenance','update','2022-08-16 03:08:19','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('150','System Admin','System Admin','User Maintenance','update','2022-08-16 03:08:27','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('151','System Admin','System Admin','Schedule Maintenance','Update Schedule Sucessfully','2022-08-16 03:08:51','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('152','System Admin','System Admin','User Maintenance','update','2022-08-16 03:08:43','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('153','System Admin','System Admin','User Maintenance','update','2022-08-16 03:08:47','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('154','System Admin','System Admin','Branch Maintenance','Update Branch Sucessfully','2022-08-16 03:08:55','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('155','System Admin','System Admin','Branch Maintenance','Update Branch Sucessfully','2022-08-16 03:08:03','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('156','System Admin','System Admin','Logout','logout','2022-08-16 03:08:02','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('157','John Adrian Ramos','Patient','Login','login','2022-08-16 04:08:38','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('158','Earl De Guzman','Doctor','Login','login','2022-08-18 01:08:28','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('159','Earl De Guzman','Doctor','Logout','logout','2022-08-18 01:08:14','');

INSERT INTO tbl_audit_trail (`id`, `name`, `user_type`, `module`, `action`, `created_at`, `updated_at`) VALUES 
('160','System Admin','System Admin','Login','login','2022-08-18 01:08:20','');

INSERT INTO tbl_appointmentreport (`id`, `patient_id`, `doctor_id`, `branch_id`, `reason`, `date`, `day`, `time`, `status`, `created_at`, `updated_at`) VALUES 
('3','4','12','2','sa','2022-07-19','Tuesday','12:00 PM - 2:00 PM','Completed','','');

INSERT INTO tbl_appointmentreport (`id`, `patient_id`, `doctor_id`, `branch_id`, `reason`, `date`, `day`, `time`, `status`, `created_at`, `updated_at`) VALUES 
('4','8','15','1','Sample Appointment 2','2022-07-19','Tuesday','3:00 AM - 5:00 AM','Completed','','');

INSERT INTO tbl_appointmentreport (`id`, `patient_id`, `doctor_id`, `branch_id`, `reason`, `date`, `day`, `time`, `status`, `created_at`, `updated_at`) VALUES 
('5','4','16','1','My head hurts','2022-07-27','Wednesday','12:00 PM - 2:00 AM','Completed','','');

INSERT INTO tbl_appointmentreport (`id`, `patient_id`, `doctor_id`, `branch_id`, `reason`, `date`, `day`, `time`, `status`, `created_at`, `updated_at`) VALUES 
('6','4','16','1','My eyes are red','2022-07-27','Wednesday','12:00 PM - 2:00 AM','Completed','','');

INSERT INTO tbl_appointmentreport (`id`, `patient_id`, `doctor_id`, `branch_id`, `reason`, `date`, `day`, `time`, `status`, `created_at`, `updated_at`) VALUES 
('7','4','12','2','3333333','2022-08-15','Monday','12:00 PM - 2:00 PM','Completed','','');

INSERT INTO tbl_appointmentreport (`id`, `patient_id`, `doctor_id`, `branch_id`, `reason`, `date`, `day`, `time`, `status`, `created_at`, `updated_at`) VALUES 
('8','4','15','1','sample appointment 3','2022-08-15','Monday','3:00 AM - 5:00 AM','Completed','','');

INSERT INTO tbl_branch (`id`, `branchname`, `address`, `created_at`, `updated_at`) VALUES 
('1','Remo Optical & Contact Lens Clinic','Ermita, Balayan','2022-03-21 19:40:40','2022-03-21 19:40:40');

INSERT INTO tbl_branch (`id`, `branchname`, `address`, `created_at`, `updated_at`) VALUES 
('2','Balayan Clinic','Nasugbu, Balayan','2022-03-21 19:40:40','2022-03-21 19:40:40');

INSERT INTO tbl_category (`id`, `name`, `created_at`, `updated_at`) VALUES 
('1','Medicine','2022-03-21 19:40:40','2022-03-21 19:40:40');

INSERT INTO tbl_category (`id`, `name`, `created_at`, `updated_at`) VALUES 
('2','Food','2022-03-21 19:40:40','2022-03-21 19:40:40');

INSERT INTO tbl_certification (`id`, `patient_id`, `branch_id`, `doctor_id`, `date`, `impressions`, `diagnosis`, `remarks`, `created_at`, `updated_at`) VALUES 
('1','4','1','12','2022-07-26 03:26:54','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum','2022-07-26 03:26:54','2022-07-26 03:26:54');

INSERT INTO tbl_certification (`id`, `patient_id`, `branch_id`, `doctor_id`, `date`, `impressions`, `diagnosis`, `remarks`, `created_at`, `updated_at`) VALUES 
('2','8','2','12','2022-07-26 05:34:24','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','2022-07-26 05:34:24','2022-07-26 05:34:24');

INSERT INTO tbl_discount (`id`, `pwd_discount`, `senior_discount`, `minimum_purchase`, `discount_percentage`, `created_at`, `updated_at`) VALUES 
('1','0.13','0.12','10000.00','0.20','2022-06-06 04:16:30','2022-06-22 02:46:10');

INSERT INTO tbl_doctor (`id`, `doctor_id`, `name`, `specialty`, `created_at`, `updated_at`) VALUES 
('1','12','Earl De Guzman','Opthamologist','2022-08-16 02:34:05','2022-08-16 02:34:05');

INSERT INTO tbl_doctor (`id`, `doctor_id`, `name`, `specialty`, `created_at`, `updated_at`) VALUES 
('2','15','Earl David Bartolo1','Optician','2022-07-27 09:09:04','2022-07-27 09:09:04');

INSERT INTO tbl_doctor (`id`, `doctor_id`, `name`, `specialty`, `created_at`, `updated_at`) VALUES 
('3','16','Aldrin Custodio1','Optometrist','2022-07-27 09:09:14','2022-07-27 09:09:14');

INSERT INTO tbl_doctorschedule (`id`, `doctor_id`, `branch_id`, `doctor_schedule_date`, `doctor_schedule_day`, `doctor_schedule_start_time`, `doctor_schedule_end_time`, `status`, `created_at`, `updated_at`) VALUES 
('1','12','1','2022-08-15','Monday','12:00 PM','2:00 PM','Active','2022-07-11 07:34:08','2022-07-11 07:34:08');

INSERT INTO tbl_doctorschedule (`id`, `doctor_id`, `branch_id`, `doctor_schedule_date`, `doctor_schedule_day`, `doctor_schedule_start_time`, `doctor_schedule_end_time`, `status`, `created_at`, `updated_at`) VALUES 
('8','15','1','2022-08-15','Monday','3:00 AM','5:00 AM','Active','2022-07-12 06:51:17','2022-07-12 06:51:17');

INSERT INTO tbl_prescription (`id`, `patient_id`, `prescription`, `doctor_name`, `branchname`, `date`, `time`, `created_at`, `updated_at`) VALUES 
('2','4','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Earl De Guzman','2','2022-07-19','12:00 PM - 2:00 PM','','');

INSERT INTO tbl_prescription (`id`, `patient_id`, `prescription`, `doctor_name`, `branchname`, `date`, `time`, `created_at`, `updated_at`) VALUES 
('3','8','I Drops','Earl De Guzman','2','2022-07-19','12:00 PM - 2:00 PM','','');

INSERT INTO tbl_prescription (`id`, `patient_id`, `prescription`, `doctor_name`, `branchname`, `date`, `time`, `created_at`, `updated_at`) VALUES 
('4','4','Sample 2a','Earl De Guzman','2','2022-07-19','12:00 PM - 2:00 PM','','');

INSERT INTO tbl_prescription (`id`, `patient_id`, `prescription`, `doctor_name`, `branchname`, `date`, `time`, `created_at`, `updated_at`) VALUES 
('5','8','sa,ple2','Earl David Bartolo1','1','2022-07-19','3:00 AM - 5:00 AM','','');

INSERT INTO tbl_prescription (`id`, `patient_id`, `prescription`, `doctor_name`, `branchname`, `date`, `time`, `created_at`, `updated_at`) VALUES 
('6','4','sample prescription 3','Aldrin Custodio1','1','2022-07-27','12:00 PM - 2:00 AM','','');

INSERT INTO tbl_prescription (`id`, `patient_id`, `prescription`, `doctor_name`, `branchname`, `date`, `time`, `created_at`, `updated_at`) VALUES 
('7','4','Sample Prescription 5','Aldrin Custodio1','1','2022-07-27','12:00 PM - 2:00 AM','','');

INSERT INTO tbl_prescription (`id`, `patient_id`, `prescription`, `doctor_name`, `branchname`, `date`, `time`, `created_at`, `updated_at`) VALUES 
('8','4','Save Prescription','Earl De Guzman','2','2022-08-15','12:00 PM - 2:00 PM','','');

INSERT INTO tbl_prescription (`id`, `patient_id`, `prescription`, `doctor_name`, `branchname`, `date`, `time`, `created_at`, `updated_at`) VALUES 
('9','4','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Earl David Bartolo1','1','2022-08-15','3:00 AM - 5:00 AM','','');

INSERT INTO tbl_product (`id`, `productname`, `qty`, `reorder`, `orig_price`, `selling_price`, `image`, `category_id`, `branch_id`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('9','Sample Product','216','232','1520.00','1672.00','1655347439.jpg','1','1','0.10','1','2022-06-06 07:39:49','2022-06-06 07:39:49');

INSERT INTO tbl_product (`id`, `productname`, `qty`, `reorder`, `orig_price`, `selling_price`, `image`, `category_id`, `branch_id`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('10','asd','42','23','10.00','11.00','1655346779.jpg','1','2','0.10','1','2022-06-06 07:40:31','2022-06-06 07:40:31');

INSERT INTO tbl_product (`id`, `productname`, `qty`, `reorder`, `orig_price`, `selling_price`, `image`, `category_id`, `branch_id`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('14','sample1','232','150','198.00','217.80','','2','1','0.10','1','2022-08-15 05:07:22','2022-08-15 05:07:22');

INSERT INTO tbl_product (`id`, `productname`, `qty`, `reorder`, `orig_price`, `selling_price`, `image`, `category_id`, `branch_id`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('15','sample2','232','150','198.00','217.80','','2','1','0.10','1','2022-08-15 05:07:22','2022-08-15 05:07:22');

INSERT INTO tbl_product (`id`, `productname`, `qty`, `reorder`, `orig_price`, `selling_price`, `image`, `category_id`, `branch_id`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('16','sample3','232','150','198.00','217.80','','2','1','0.10','1','2022-08-15 05:07:22','2022-08-15 05:07:22');

INSERT INTO tbl_product (`id`, `productname`, `qty`, `reorder`, `orig_price`, `selling_price`, `image`, `category_id`, `branch_id`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('17','sample4','232','150','198.00','217.80','','2','1','0.10','1','2022-08-15 05:07:22','2022-08-15 05:07:22');

INSERT INTO tbl_product (`id`, `productname`, `qty`, `reorder`, `orig_price`, `selling_price`, `image`, `category_id`, `branch_id`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('18','sample5','232','150','198.00','217.80','','2','1','0.10','1','2022-08-15 05:07:22','2022-08-15 05:07:22');

INSERT INTO tbl_product (`id`, `productname`, `qty`, `reorder`, `orig_price`, `selling_price`, `image`, `category_id`, `branch_id`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('19','sample6','231','150','198.00','217.80','','2','1','0.10','1','2022-08-15 05:07:22','2022-08-15 05:07:22');

INSERT INTO tbl_product (`id`, `productname`, `qty`, `reorder`, `orig_price`, `selling_price`, `image`, `category_id`, `branch_id`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('20','sample7','231','150','198.00','217.80','','2','1','0.10','1','2022-08-15 05:07:22','2022-08-15 05:07:22');

INSERT INTO tbl_sales (`id`, `user_id`, `product_id`, `branch_id`, `invoice_no`, `productname`, `qty`, `wholesale_discount_amount`, `senior_pwd_discount_amount`, `amount`, `payment_method`, `order_from`, `status`, `created_at`, `updated_at`) VALUES 
('64','8','9','2','10001','Sample Product','3','2127.498','1589.51','5016.00','GCash','walk-in','1','2022-07-07 07:33:31','2022-07-07 07:33:31');

INSERT INTO tbl_sales (`id`, `user_id`, `product_id`, `branch_id`, `invoice_no`, `productname`, `qty`, `wholesale_discount_amount`, `senior_pwd_discount_amount`, `amount`, `payment_method`, `order_from`, `status`, `created_at`, `updated_at`) VALUES 
('65','8','10','2','10005','asd','1','2127.498','1589.51','11.00','GCash','walk-in','1','2022-07-07 07:33:31','2022-07-07 07:33:31');

INSERT INTO tbl_sales (`id`, `user_id`, `product_id`, `branch_id`, `invoice_no`, `productname`, `qty`, `wholesale_discount_amount`, `senior_pwd_discount_amount`, `amount`, `payment_method`, `order_from`, `status`, `created_at`, `updated_at`) VALUES 
('66','8','2','2','10004','Check-Up Katarata','2','2127.498','1589.51','7200.00','GCash','walk-in','1','2022-07-07 07:33:31','2022-07-07 07:33:31');

INSERT INTO tbl_sales (`id`, `user_id`, `product_id`, `branch_id`, `invoice_no`, `productname`, `qty`, `wholesale_discount_amount`, `senior_pwd_discount_amount`, `amount`, `payment_method`, `order_from`, `status`, `created_at`, `updated_at`) VALUES 
('67','4','2','2','10002','Check-Up Katarata','1','0','468','3600.00','Cash','walk-in','1','2022-07-07 07:34:19','2022-07-07 07:34:19');

INSERT INTO tbl_sales (`id`, `user_id`, `product_id`, `branch_id`, `invoice_no`, `productname`, `qty`, `wholesale_discount_amount`, `senior_pwd_discount_amount`, `amount`, `payment_method`, `order_from`, `status`, `created_at`, `updated_at`) VALUES 
('68','8','9','1','10003','Sample Product','1','0','407.64','1672.00','Cash','walk-in','1','2022-07-07 11:51:20','2022-07-07 11:51:20');

INSERT INTO tbl_sales (`id`, `user_id`, `product_id`, `branch_id`, `invoice_no`, `productname`, `qty`, `wholesale_discount_amount`, `senior_pwd_discount_amount`, `amount`, `payment_method`, `order_from`, `status`, `created_at`, `updated_at`) VALUES 
('69','8','5','1','10003','Check-Up Sunglasses','1','0','407.64','1725.00','Cash','walk-in','1','2022-07-07 11:51:20','2022-07-07 11:51:20');

INSERT INTO tbl_sales (`id`, `user_id`, `product_id`, `branch_id`, `invoice_no`, `productname`, `qty`, `wholesale_discount_amount`, `senior_pwd_discount_amount`, `amount`, `payment_method`, `order_from`, `status`, `created_at`, `updated_at`) VALUES 
('75','8','2','1','1','Check-Up Katarata','1','0','632.64','3600.00','Cash','walk-in','1','2022-07-19 07:24:19','2022-07-19 07:24:19');

INSERT INTO tbl_sales (`id`, `user_id`, `product_id`, `branch_id`, `invoice_no`, `productname`, `qty`, `wholesale_discount_amount`, `senior_pwd_discount_amount`, `amount`, `payment_method`, `order_from`, `status`, `created_at`, `updated_at`) VALUES 
('76','8','9','1','1','Sample Product','1','0','632.64','1672.00','Cash','walk-in','1','2022-07-19 07:24:19','2022-07-19 07:24:19');

INSERT INTO tbl_sales (`id`, `user_id`, `product_id`, `branch_id`, `invoice_no`, `productname`, `qty`, `wholesale_discount_amount`, `senior_pwd_discount_amount`, `amount`, `payment_method`, `order_from`, `status`, `created_at`, `updated_at`) VALUES 
('77','4','9','1','12345','Sample Product','1','0','0','1672.00','Cash','walk-in','1','2022-07-19 12:15:41','2022-07-19 12:15:41');

INSERT INTO tbl_sales (`id`, `user_id`, `product_id`, `branch_id`, `invoice_no`, `productname`, `qty`, `wholesale_discount_amount`, `senior_pwd_discount_amount`, `amount`, `payment_method`, `order_from`, `status`, `created_at`, `updated_at`) VALUES 
('78','9','9','1','12341','Sample Product','1','0','0','1672.00','Cash','walk-in','1','2022-07-19 12:16:37','2022-07-19 12:16:37');

INSERT INTO tbl_sales (`id`, `user_id`, `product_id`, `branch_id`, `invoice_no`, `productname`, `qty`, `wholesale_discount_amount`, `senior_pwd_discount_amount`, `amount`, `payment_method`, `order_from`, `status`, `created_at`, `updated_at`) VALUES 
('79','4','9','1','33331','Sample Product','1','0','0','1672.00','Cash','walk-in','1','2022-07-19 12:17:02','2022-07-19 12:17:02');

INSERT INTO tbl_sales (`id`, `user_id`, `product_id`, `branch_id`, `invoice_no`, `productname`, `qty`, `wholesale_discount_amount`, `senior_pwd_discount_amount`, `amount`, `payment_method`, `order_from`, `status`, `created_at`, `updated_at`) VALUES 
('80','4','9','1','12358','Sample Product','1','0','200.64','1672.00','Cash','walk-in','1','2022-07-26 03:01:31','2022-07-26 03:01:31');

INSERT INTO tbl_sales (`id`, `user_id`, `product_id`, `branch_id`, `invoice_no`, `productname`, `qty`, `wholesale_discount_amount`, `senior_pwd_discount_amount`, `amount`, `payment_method`, `order_from`, `status`, `created_at`, `updated_at`) VALUES 
('81','8','9','1','12','Sample Product','1','0','217.36','1672.00','Cash','walk-in','1','2022-07-28 08:05:26','2022-07-28 08:05:26');

INSERT INTO tbl_sales (`id`, `user_id`, `product_id`, `branch_id`, `invoice_no`, `productname`, `qty`, `wholesale_discount_amount`, `senior_pwd_discount_amount`, `amount`, `payment_method`, `order_from`, `status`, `created_at`, `updated_at`) VALUES 
('82','8','9','1','12390','Sample Product','2','0','0','3344.00','Cash','walk-in','1','2022-07-31 09:46:27','2022-07-31 09:46:27');

INSERT INTO tbl_sales (`id`, `user_id`, `product_id`, `branch_id`, `invoice_no`, `productname`, `qty`, `wholesale_discount_amount`, `senior_pwd_discount_amount`, `amount`, `payment_method`, `order_from`, `status`, `created_at`, `updated_at`) VALUES 
('83','4','9','1','12300','Sample Product','10','3344','0','16720.00','Cash','walk-in','1','2022-07-31 09:55:13','2022-07-31 09:55:13');

INSERT INTO tbl_sales (`id`, `user_id`, `product_id`, `branch_id`, `invoice_no`, `productname`, `qty`, `wholesale_discount_amount`, `senior_pwd_discount_amount`, `amount`, `payment_method`, `order_from`, `status`, `created_at`, `updated_at`) VALUES 
('84','4','19','1','23567','sample6','1','0','0','217.80','Cash','walk-in','1','2022-08-15 05:20:01','2022-08-15 05:20:01');

INSERT INTO tbl_sales (`id`, `user_id`, `product_id`, `branch_id`, `invoice_no`, `productname`, `qty`, `wholesale_discount_amount`, `senior_pwd_discount_amount`, `amount`, `payment_method`, `order_from`, `status`, `created_at`, `updated_at`) VALUES 
('85','4','20','1','23567','sample7','1','0','0','217.80','Cash','walk-in','1','2022-08-15 05:20:01','2022-08-15 05:20:01');

INSERT INTO tbl_service (`id`, `servicename`, `branch_id`, `orig_price`, `selling_price`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('2','Check-Up Katarata','2','3000.00','3600.00','0.20','1','2022-06-06 00:43:16','2022-06-06 00:43:16');

INSERT INTO tbl_service (`id`, `servicename`, `branch_id`, `orig_price`, `selling_price`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('5','Check-Up Sunglasses','1','1500.00','1725.00','0.15','1','2022-07-03 06:30:43','2022-07-03 06:30:43');

INSERT INTO tbl_service (`id`, `servicename`, `branch_id`, `orig_price`, `selling_price`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('7','Check Up Katarata','1','10000.00','20000.00','1.00','0','2022-07-19 06:19:50','2022-07-19 06:19:50');

INSERT INTO tbl_service (`id`, `servicename`, `branch_id`, `orig_price`, `selling_price`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('8','sample1','1','200.00','220.00','0.10','1','2022-08-15 05:29:37','2022-08-15 05:29:37');

INSERT INTO tbl_service (`id`, `servicename`, `branch_id`, `orig_price`, `selling_price`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('9','sample2','1','200.00','220.00','0.10','1','2022-08-15 05:29:37','2022-08-15 05:29:37');

INSERT INTO tbl_service (`id`, `servicename`, `branch_id`, `orig_price`, `selling_price`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('10','sample3','1','200.00','220.00','0.10','1','2022-08-15 05:29:37','2022-08-15 05:29:37');

INSERT INTO tbl_service (`id`, `servicename`, `branch_id`, `orig_price`, `selling_price`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('11','sample4','1','200.00','220.00','0.10','1','2022-08-15 05:29:37','2022-08-15 05:29:37');

INSERT INTO tbl_service (`id`, `servicename`, `branch_id`, `orig_price`, `selling_price`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('12','sample5','1','200.00','220.00','0.10','1','2022-08-15 05:29:37','2022-08-15 05:29:37');

INSERT INTO tbl_service (`id`, `servicename`, `branch_id`, `orig_price`, `selling_price`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('13','sample6','1','200.00','220.00','0.10','1','2022-08-15 05:29:37','2022-08-15 05:29:37');

INSERT INTO tbl_service (`id`, `servicename`, `branch_id`, `orig_price`, `selling_price`, `markup`, `status`, `created_at`, `updated_at`) VALUES 
('14','sample7','1','200.00','220.00','0.10','1','2022-08-15 05:29:37','2022-08-15 05:29:37');

INSERT INTO tbl_user (`id`, `name`, `username`, `password`, `user_role`, `email`, `contactno`, `address`, `validid`, `age`, `birthdate`, `gender`, `civilstatus`, `status`, `archive_status`, `branch_id`, `created_at`, `updated_at`) VALUES 
('1','System Admin','admin','12345678','System Admin','cladiebaudillo@gmail.com','091234567811','Dilao, Balayan, Batangas','','23','1999-07-10','Male','Single','','no','','2022-03-21 19:40:40','2022-03-21 19:40:40');

INSERT INTO tbl_user (`id`, `name`, `username`, `password`, `user_role`, `email`, `contactno`, `address`, `validid`, `age`, `birthdate`, `gender`, `civilstatus`, `status`, `archive_status`, `branch_id`, `created_at`, `updated_at`) VALUES 
('4','John Adrian Ramos','adrianramos','wynspogi','Patient','pesojob@gmail.com','09562447724','Milflores Subd., Caloocan, Balayan, Batangas','user-identification/628a28f4462cc.jpg','23','1999-07-10','Male','Married','Approved','no','','2022-08-15 02:33:51','2022-08-15 02:33:51');

INSERT INTO tbl_user (`id`, `name`, `username`, `password`, `user_role`, `email`, `contactno`, `address`, `validid`, `age`, `birthdate`, `gender`, `civilstatus`, `status`, `archive_status`, `branch_id`, `created_at`, `updated_at`) VALUES 
('8','Cladie Mae Baudillo','clads','12345678','Patient','cladiemaebaudillo@gmail.com','09397177710','Canda, Balayan, Batangas','user-identification/628b25d1f1d52.jpg','21','2001-04-06','Female','Single','Approved','no','','2022-05-23 06:12:34','2022-07-31 06:11:22');

INSERT INTO tbl_user (`id`, `name`, `username`, `password`, `user_role`, `email`, `contactno`, `address`, `validid`, `age`, `birthdate`, `gender`, `civilstatus`, `status`, `archive_status`, `branch_id`, `created_at`, `updated_at`) VALUES 
('12','Earl De Guzman','earl','wynspogi211','Doctor','astraalvez@gmail.com','09024515678','Obispo, Tuy, Batangas','','23','2022-06-09','Female','Single','','no','1','2022-08-16 02:34:05','2022-08-16 02:34:05');

INSERT INTO tbl_user (`id`, `name`, `username`, `password`, `user_role`, `email`, `contactno`, `address`, `validid`, `age`, `birthdate`, `gender`, `civilstatus`, `status`, `archive_status`, `branch_id`, `created_at`, `updated_at`) VALUES 
('13','Maria Lalaine Ilang-Ilang','laine','wynspogi211','Secretary','astraalvez@gmail.com','09056789201','sample ','','21','2022-06-23','Female','Single','','no','1','2022-08-16 03:17:47','2022-08-16 03:17:47');

INSERT INTO tbl_user (`id`, `name`, `username`, `password`, `user_role`, `email`, `contactno`, `address`, `validid`, `age`, `birthdate`, `gender`, `civilstatus`, `status`, `archive_status`, `branch_id`, `created_at`, `updated_at`) VALUES 
('14','staff1','staff1','wynspogi211','Staff','pesojob@gmail.com','09234615423','sample 2','','21','2022-06-19','Female','Married','','no','1','2022-08-16 03:15:27','2022-08-16 03:15:27');

INSERT INTO tbl_user (`id`, `name`, `username`, `password`, `user_role`, `email`, `contactno`, `address`, `validid`, `age`, `birthdate`, `gender`, `civilstatus`, `status`, `archive_status`, `branch_id`, `created_at`, `updated_at`) VALUES 
('15','Earl David Bartolo1','earl','wynspogi211','Doctor','astraalvez@gmail.com','09056789201','Obispo, Tuy, Batangas','','45','2009-06-12','Female','Single','','no','1','2022-07-27 09:09:04','2022-07-27 09:09:04');

INSERT INTO tbl_user (`id`, `name`, `username`, `password`, `user_role`, `email`, `contactno`, `address`, `validid`, `age`, `birthdate`, `gender`, `civilstatus`, `status`, `archive_status`, `branch_id`, `created_at`, `updated_at`) VALUES 
('16','Aldrin Custodio1','aldrin','wynspogi211','Doctor','sam@thephilosophicalcoach.com','09056789201','sample 2','','33','2022-07-01','Male','Single','','yes','1','2022-07-27 09:09:14','2022-07-31 07:54:12');

INSERT INTO tbl_user (`id`, `name`, `username`, `password`, `user_role`, `email`, `contactno`, `address`, `validid`, `age`, `birthdate`, `gender`, `civilstatus`, `status`, `archive_status`, `branch_id`, `created_at`, `updated_at`) VALUES 
('28','Maria Baudillo','maria','12345678','Secretary','alvez.046036@balayan.sti.edu.ph','09056789201','sample ','','23','2022-07-01','Female','Married','','yes','2','2022-07-31 08:00:11','2022-07-31 08:00:43');
