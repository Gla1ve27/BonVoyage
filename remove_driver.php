<?php
require_once 'includes/db.php';
// remove_driver.php

if (isset($_POST['driver_id'])) {
    $driver_id = $_POST['driver_id'];

    try {
        // Prepare the query to delete the driver from the database
        $stmt = $pdo->prepare("DELETE FROM server_drivers WHERE driver_id = ?");
        $stmt->execute([$driver_id]);

        // Redirect to the driver list page or display a message
        header("Location: partnermodule.php");
        exit();
    } catch (PDOException $e) {
        // If there is an error with the query
        echo "<p style='color: red;'>Error deleting driver: " . $e->getMessage() . "</p>";
    }
}
?>
