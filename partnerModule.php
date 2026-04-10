<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';

if (!isset($_SESSION['employee_id'])) {
    header("Location: login.php");
    exit;
}

$employeeId = $_SESSION['employee_id'];
$successMessage = "";
$errorMessage = "";
$profileUpdateSuccess = "";
$profileUpdateError = "";

try {
    $stmt = $pdo->prepare("SELECT * FROM admin_accounts a JOIN admin_personalinfo p ON a.employee_id = p.employee_id WHERE a.employee_id = :employee_id");
    $stmt->execute(['employee_id' => $employeeId]);
    $accountData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$accountData) {
        die("No account data found for this employee.");
    }

    $carCount = $pdo->query("SELECT COUNT(*) FROM server_vehicles")->fetchColumn();
    $driverCount = $pdo->query("SELECT COUNT(*) FROM server_drivers")->fetchColumn();
    $clientCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();

    $userAccounts = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    $userPersonalInfo = $pdo->query("SELECT * FROM user_profiles")->fetchAll(PDO::FETCH_ASSOC);
    $vehicles = $pdo->query("SELECT * FROM server_vehicles")->fetchAll(PDO::FETCH_ASSOC);
    $drivers = $pdo->query("SELECT * FROM server_drivers")->fetchAll(PDO::FETCH_ASSOC);
    $tours = $pdo->query("SELECT * FROM trips")->fetchAll(PDO::FETCH_ASSOC); // Mapping tours to trips

    $firstName = $accountData['first_name'];
    $middleName = $accountData['middle_name'] ?? '';
    $lastName = $accountData['last_name'];
    $homeAddress = $accountData['home_address'];
    $userName = $accountData['user_name'];
    $email = $accountData['email'];
    $profilePicture = $accountData['profile_picture'];
    $profilePicturePath = $profilePicture ? "assets/img/uploads/profile/" . $profilePicture : "assets/img/uploads/profile/default.png";
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

// Form Handlers
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formType = $_POST['formType'] ?? '';

    if ($formType == 'profile') {
        // ... Profile update logic ...
    } elseif ($formType == 'driver') {
        // ... Add driver logic ...
    } elseif ($formType == 'vehicle') {
        // ... Add vehicle logic ...
    }
}

$pageTitle = "Partner Dashboard - BondVoyage";
$extraCSS = ['partnerModule.css', 'ageneral.css', 'uploadtour.css'];
include 'includes/header.php';
?>

<div class="container mainContainer mt-5pt">
    <div class="sideMenu">
        <img src="<?= h($profilePicturePath) ?>" alt="admin-profile">
        <h5><?= h($firstName . ' ' . $lastName) ?></h5>
        <div class="ButtonContainer">
            <button onclick="showSection('dashSummary')"><i class='bx bxs-dashboard'></i>Dashboard</button>
            <button onclick="showSection('editProfile')"><i class='bx bxs-edit-alt'></i>Edit Profile</button>
            <button onclick="showSection('uploadedTours')"><i class='bx bx-landscape'></i>Tours</button>
            <button onclick="showSection('driverList')"><i class='bx bxs-id-card'></i>Drivers</button>
            <button onclick="showSection('carList')"><i class='bx bxs-car-wash'></i>Cars</button>
            <button onclick="showSection('userInfos')"><i class='bx bxs-user'></i>Users</button>
        </div>
    </div>

    <div class="mainContent">
        <section class="dashSummary section active">
            <h3>Dashboard Summary</h3>
            <div class="summaryContainer">
                <!-- Counters as before -->
                <div class="revContainer sumcon">
                    <h5>REVENUE</h5>
                    <p>₱85,300</p>
                </div>
                <div class="availCars sumcon">
                    <h5>CARS</h5>
                    <p><?= $carCount ?></p>
                </div>
                <div class="availDrivers sumcon">
                    <h5>DRIVERS</h5>
                    <p><?= $driverCount ?></p>
                </div>
                <div class="totClients sumcon">
                    <h5>CLIENTS</h5>
                    <p><?= $clientCount ?></p>
                </div>
            </div>
        </section>

        <section class="editProfile section">
            <h3>Edit Profile</h3>
            <!-- Profile form as before but with consistent paths -->
        </section>

        <section class="uploadedTours section">
            <h3>Tours</h3>
            <div class="tourContainer">
                <?php foreach ($tours as $tour): ?>
                    <div class="tourWrapper">
                        <img src="<?= h($tour['image_path']) ?>" alt="Tour" style="width:100%">
                        <h5><?= h($tour['title']) ?></h5>
                        <p><?= h($tour['location']) ?></p>
                    </div>
                <?php endforeach; ?>
                <button onclick="location.href='uploadTour.php'">Add New Tour +</button>
            </div>
        </section>

        <section class="driverList section">
            <h3>Drivers</h3>
            <div class="driverWrppers">
                <?php foreach ($drivers as $d): ?>
                    <div class="driverContainer">
                        <p><?= h($d['first_name'] . ' ' . $d['last_name']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <button onclick="showSection('addNewDriver')">Add Driver +</button>
        </section>

        <!-- Other sections like addNewDriver, addNewVehicle, userInfos etc. -->
    </div>
</div>

<script>
    function showSection(sectionClass) {
        document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
        const target = document.querySelector('.' + sectionClass);
        if (target) target.classList.add('active');
    }
</script>

<?php include 'includes/footer.php'; ?>