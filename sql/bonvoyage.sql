-- BondVoyage Comprehensive Database Schema
-- Includes Users, Profiles, Trips, Vehicles, Drivers, and Admin tables

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- USERS & PROFILES (Customer side)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('user', 'admin', 'partner') DEFAULT 'user',
  `online` tinyint(1) DEFAULT 0,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address_number` varchar(20) DEFAULT NULL,
  `street_name` varchar(100) DEFAULT NULL,
  `bldg_name` varchar(100) DEFAULT NULL,
  `bldg_details` varchar(255) DEFAULT NULL,
  `country` varchar(50) DEFAULT 'Philippines',
  `region` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `valid_id_path` varchar(255) DEFAULT NULL,
  `profile_pic_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- TRIPS & INVENTORY
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `trips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  `category` varchar(50) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- PARTNER / ADMIN SIDE (Vehicles & Drivers)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `server_drivers` (
  `driver_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `license_type` varchar(30) DEFAULT NULL,
  `restrictions` varchar(50) DEFAULT NULL,
  `agency_id` varchar(50) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `dl_codes` varchar(50) DEFAULT NULL,
  `years_of_service` int(2) DEFAULT 0,
  PRIMARY KEY (`driver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `server_vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_brand` varchar(50) NOT NULL,
  `vehicle_model` varchar(50) NOT NULL,
  `year_model` int(4) NOT NULL,
  `seating_capacity` int(2) NOT NULL,
  `vehicle_photo` varchar(255) DEFAULT NULL,
  `assigned_driver` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_vehicle_driver` FOREIGN KEY (`assigned_driver`) REFERENCES `server_drivers` (`driver_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- ADMIN ACCOUNTS
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `admin_accounts` (
  `employee_id` varchar(20) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`employee_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `admin_personalinfo` (
  `employee_id` varchar(20) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `home_address` text DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`employee_id`),
  CONSTRAINT `fk_admin_info` FOREIGN KEY (`employee_id`) REFERENCES `admin_accounts` (`employee_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- SAMPLE DATA
-- --------------------------------------------------------

-- Default Admin: admin / admin123
INSERT INTO `users` (`username`, `email`, `password`, `role`) VALUES 
('admin_user', 'admin@bonvoyage.ph', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Sample Trips
INSERT INTO `trips` (`title`, `location`, `region`, `price`, `category`, `image_path`) VALUES
('Chocolate Hills', 'Bohol Province', 'VII', 980.00, 'Nature', 'assets/img/tourImages/chocolate-hills-bohol.jpg'),
('Boracay Beach', 'Kalibo Aklan', 'VI', 2500.00, 'Beach', 'assets/img/tourImages/boracay-beach-aklan.jpg');

-- --------------------------------------------------------
-- MESSAGING SYSTEM
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `messenger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`sender_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`receiver_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- TOURS SYSTEM (Admin/Partner Side)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `server_tours` (
  `tour_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `tour_name` varchar(255) NOT NULL,
  `destination_city` varchar(100) DEFAULT NULL,
  `destination_description` text DEFAULT NULL,
  `departure_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `vehicle_model` varchar(50) DEFAULT NULL,
  `pickup_time` time DEFAULT NULL,
  `landmark_point` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  `max_capacity` int(11) DEFAULT NULL,
  `joiner_counts` int(11) DEFAULT 0,
  `destination_address` text DEFAULT NULL,
  `img1` varchar(255) DEFAULT NULL,
  `img2` varchar(255) DEFAULT NULL,
  `img3` varchar(255) DEFAULT NULL,
  `img4` varchar(255) DEFAULT NULL,
  `destination_name` varchar(255) DEFAULT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `activity_date` date DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `itinerary_image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `pickup_address` text DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tour_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;
