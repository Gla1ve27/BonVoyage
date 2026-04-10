<?php
// Assuming you have a connection to the database
require '../includes/db.php';

// Check if vehicle_id is passed
if (isset($_POST['vehicle_id'])) {
    $vehicleId = $_POST['vehicle_id'];

    // Prepare and execute the delete query
    $stmt = $pdo->prepare("DELETE FROM server_vehicles WHERE vehicle_id = :vehicle_id");
    $stmt->bindParam(':vehicle_id', $vehicleId);

    try {
        // Execute the delete
        $stmt->execute();

        // Redirect back to the vehicle list page
        header('Location: vehicle_list.php?success=Vehicle deleted successfully');
    } catch (PDOException $e) {
        // Handle the error
        echo "Error deleting vehicle: " . $e->getMessage();
    }
} else {
    echo "No vehicle ID provided.";
}
