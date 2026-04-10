<?php
// Assuming you have a connection to the database
require '../includes/db.php';

// Check if the vehicle ID is provided
if (isset($_GET['id'])) {
    $vehicleId = $_GET['id'];

    // Fetch the vehicle data
    $stmt = $pdo->prepare("SELECT * FROM server_vehicles WHERE vehicle_id = :vehicle_id");
    $stmt->bindParam(':vehicle_id', $vehicleId);
    $stmt->execute();
    $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$vehicle) {
        echo "Vehicle not found.";
        exit;
    }
} else {
    echo "No vehicle ID provided.";
    exit;
}

// Handle the form submission for updating the vehicle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicleBrand = htmlspecialchars(trim($_POST['vehicleBrand']));
    $vehicleModel = htmlspecialchars(trim($_POST['vehicleModel']));
    $seatingCapacity = htmlspecialchars(trim($_POST['seatingCapacity']));
    $vehicleType = htmlspecialchars(trim($_POST['vehicleType']));
    $yearModel = htmlspecialchars(trim($_POST['yearModel']));
    $color = htmlspecialchars(trim($_POST['color']));
    $vehiclePhoto = $_FILES['vehiclePhoto']['name'] ?? $vehicle['vehicle_photo']; // Keep the existing photo if not updated

    // Handle the image upload if a new image is provided
    if (isset($_FILES['vehiclePhoto']) && $_FILES['vehiclePhoto']['error'] == 0) {
        $targetDir = "img/vehicles/";
        $targetFile = $targetDir . basename($_FILES['vehiclePhoto']['name']);
        if (move_uploaded_file($_FILES['vehiclePhoto']['tmp_name'], $targetFile)) {
            $vehiclePhoto = basename($_FILES['vehiclePhoto']['name']);
        }
    }

    // Update the vehicle details in the database
    $stmt = $pdo->prepare("
        UPDATE server_vehicles 
        SET vehicle_brand = :vehicle_brand, vehicle_model = :vehicle_model, seating_capacity = :seating_capacity, 
            vehicle_type = :vehicle_type, year_model = :year_model, color = :color, vehicle_photo = :vehicle_photo
        WHERE vehicle_id = :vehicle_id
    ");
    $stmt->bindParam(':vehicle_brand', $vehicleBrand);
    $stmt->bindParam(':vehicle_model', $vehicleModel);
    $stmt->bindParam(':seating_capacity', $seatingCapacity);
    $stmt->bindParam(':vehicle_type', $vehicleType);
    $stmt->bindParam(':year_model', $yearModel);
    $stmt->bindParam(':color', $color);
    $stmt->bindParam(':vehicle_photo', $vehiclePhoto);
    $stmt->bindParam(':vehicle_id', $vehicleId);

    try {
        // Execute the update
        $stmt->execute();

        // Redirect back to the vehicle list page
        header('Location: partnermodule.php');
    } catch (PDOException $e) {
        // Handle the error
        echo "Error updating vehicle: " . $e->getMessage();
    }
}
?>

<!-- Update Vehicle Form -->
<form action="update_vehicle.php?id=<?php echo $vehicle['vehicle_id']; ?>" method="POST" enctype="multipart/form-data">
    <label for="vehicleBrand">Vehicle Brand:</label>
    <input type="text" id="vehicleBrand" name="vehicleBrand" value="<?php echo htmlspecialchars($vehicle['vehicle_brand']); ?>" required><br>

    <label for="vehicleModel">Vehicle Model:</label>
    <input type="text" id="vehicleModel" name="vehicleModel" value="<?php echo htmlspecialchars($vehicle['vehicle_model']); ?>" required><br>

    <label for="seatingCapacity">Seating Capacity:</label>
    <input type="number" id="seatingCapacity" name="seatingCapacity" value="<?php echo htmlspecialchars($vehicle['seating_capacity']); ?>" required><br>

    <label for="vehicleType">Vehicle Type:</label>
    <input type="text" id="vehicleType" name="vehicleType" value="<?php echo htmlspecialchars($vehicle['vehicle_type']); ?>" required><br>

    <label for="yearModel">Year Model:</label>
    <input type="number" id="yearModel" name="yearModel" value="<?php echo htmlspecialchars($vehicle['year_model']); ?>" required><br>

    <label for="color">Color:</label>
    <input type="text" id="color" name="color" value="<?php echo htmlspecialchars($vehicle['color']); ?>" required><br>

    <label for="vehiclePhoto">Vehicle Photo:</label>
    <input type="file" id="vehiclePhoto" name="vehiclePhoto"><br>

    <button type="submit">Update Vehicle</button>
</form>