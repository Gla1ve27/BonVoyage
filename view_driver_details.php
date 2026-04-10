<?php
require_once 'includes/db.php';

// view_driver_details.php

// Check if the driver_id is passed in the URL and is a valid integer
if (isset($_GET['driver_id']) && is_numeric($_GET['driver_id'])) {
    $driver_id = (int) $_GET['driver_id'];  // Cast to integer for security and proper comparison

    try {
        // Prepare the SQL query to fetch driver details and their associated vehicle information
        $stmt = $pdo->prepare("
            SELECT d.*, v.vehicle_brand, v.vehicle_model, v.year_model
            FROM server_drivers d
            LEFT JOIN server_vehicles v ON d.driver_id = v.assigned_driver
            WHERE d.driver_id = :driver_id
        ");
        $stmt->bindParam(':driver_id', $driver_id, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the driver and vehicle data
        $driver = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the driver exists in the database
        if ($driver) {
            // Trim any leading or trailing spaces
            $first_name = ucfirst(trim($driver['first_name']));
            $last_name = strtoupper(trim($driver['last_name']));
            $vehicle_details = $driver['vehicle_brand'] . ' ' . $driver['vehicle_model'] . ' ' . $driver['year_model'];

            // Display the driver's details
            echo "<h2>Driver Details</h2>";
            echo "<strong>Driver Name: </strong>" . $first_name . ' ' . $last_name . "<br>";
            echo "<strong>Vehicle: </strong>" . $vehicle_details . "<br>";
            // Optionally, display more details if needed
        } else {
            // Driver not found
            echo "<p style='color: red;'>Driver not found!</p>";
        }
    } catch (PDOException $e) {
        // If there is an error with the database connection or query
        echo "<p style='color: red;'>Error fetching driver details: " . $e->getMessage() . "</p>";
    }
} else {
    // If no valid driver_id is passed in the URL
    echo "<p style='color: red;'>No valid driver ID provided!</p>";
}
?>
