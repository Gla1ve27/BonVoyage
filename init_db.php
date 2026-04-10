<?php
require_once 'includes/db.php';

try {
    // 1. Create Messenger Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `messenger` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `sender_id` int(11) NOT NULL,
        `receiver_id` int(11) NOT NULL,
        `message` text NOT NULL,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        KEY `sender_id` (`sender_id`),
        KEY `receiver_id` (`receiver_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // 2. Create Server Tours Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `server_tours` (
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
        KEY `user_id` (`user_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    echo "Successfully created/verified Messenger and Server Tours tables!";
} catch (PDOException $e) {
    echo "Error creating tables: " . $e->getMessage();
}
