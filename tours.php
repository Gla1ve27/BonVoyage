<?php
// Include the database connection
require_once 'includes/db.php';

// Fetch tour data
try {
    $stmt = $pdo->query("SELECT * FROM server_tours");
    $tours = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tours</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS -->
    <style>
        .tourContainer {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    padding: 20px;
}

.tourWrapper {
    border: 1px solid #ccc;
    border-radius: 8px;
    overflow: hidden;
    width: calc(33% - 20px); /* Adjust width based on your layout */
}

.imageContainer {
    position: relative;
}

.imageContainer img {
    width: 100%;
    height: auto;
    display: block;
}

.imageOverlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
}

.imageOverlay button {
    background-color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
}

.details {
    padding: 15px;
}

.tourName {
    font-size: 1.2em;
    margin: 0;
}

.vehicleName, .driverAssigned, .date {
    margin: 5px 0;
}
    </style>
</head>
<body>
    <div class="tourContainer">
        <?php foreach ($tours as $tour): ?>
            <div class="tourWrapper">
                <!-- Image section -->
                <div class="imageContainer">
                    <img src="<?php echo htmlspecialchars($tour['image_path']); ?>" alt="Tour Image">
                    <div class="imageOverlay">
                        <button>View Information</button>
                    </div>
                </div>
                <!-- Details section -->
                <div class="details">
                    <h5 class="tourName"><?php echo htmlspecialchars($tour['tour_name']); ?></h5>
                    <p class="vehicleName"><?php echo htmlspecialchars($tour['vehicle_name']); ?> <i class='bx bxs-car'></i></p>
                    <p class="driverAssigned">Driver: <?php echo htmlspecialchars($tour['driver_name']); ?></p>
                    <p class="date">Date: <?php echo htmlspecialchars(date('F j, Y', strtotime($tour['tour_date']))); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
