<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

$pageTitle = "Sign Up - BonVoyage";
$extraCSS = ['registration.css'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $phone = trim($_POST['phoneNumber']);

    // Personal Info
    $first_name = trim($_POST['fName']);
    $last_name = trim($_POST['lName']);
    $middle_name = trim($_POST['mName']);
    $suffix = $_POST['suffix'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];

    // Address Info
    $address_number = trim($_POST['addressNum']);
    $street_name = trim($_POST['street']);
    $building_name = trim($_POST['building']);
    $building_details = trim($_POST['buildingDetails']);
    $country = trim($_POST['country']);
    $region = trim($_POST['region']);
    $city = trim($_POST['city']);
    $postal_code = trim($_POST['postalCode']);

    // Secure File Uploads
    $valid_id = uploadFile($_FILES['valid_id'], 'assets/img/uploads/valid_id/');
    $profile_pic = uploadFile($_FILES['profilepic'], 'assets/img/uploads/profiles/');

    if ($valid_id['status'] && $profile_pic['status']) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $pdo->beginTransaction();
        try {
            // Insert into users
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password, phone, role) VALUES (?, ?, ?, ?, 'user')");
            $stmt->execute([$username, $email, $hashed_password, $phone]);
            $user_id = $pdo->lastInsertId();

            // Insert into user_profiles
            $stmt = $pdo->prepare("INSERT INTO user_profiles 
                (user_id, first_name, last_name, middle_name, suffix, age, gender, birthday, address_number, street_name, bldg_name, bldg_details, country, region, city, postal_code, valid_id_path, profile_pic_path) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $user_id,
                $first_name,
                $last_name,
                $middle_name,
                $suffix,
                $age,
                $gender,
                $birthday,
                $address_number,
                $street_name,
                $building_name,
                $building_details,
                $country,
                $region,
                $city,
                $postal_code,
                $valid_id['path'],
                $profile_pic['path']
            ]);

            $pdo->commit();
            header("Location: login.php?registered=1");
            exit();
        } catch (Exception $e) {
            $pdo->rollBack();
            $error = "Registration failed: " . $e->getMessage();
        }
    } else {
        $error = "Upload error: " . ($valid_id['message'] ?? $profile_pic['message']);
    }
}

include 'includes/header.php';
?>

<div class="registration-section py-5">
    <div class="container bg-white shadow rounded p-4">
        <div class="row">
            <div class="col-lg-8">
                <form action="registration.php" method="POST" enctype="multipart/form-data" class="registration-form">
                    <h2 class="mb-4">Create Your Account</h2>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <!-- Personal Information -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">First Name</label>
                            <input type="text" name="fName" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="lName" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Age</label>
                            <input type="number" name="age" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Birthday</label>
                            <input type="date" name="birthday" class="form-control" required>
                        </div>
                    </div>

                    <!-- Account Info -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phoneNumber" class="form-control" required>
                        </div>
                    </div>

                    <!-- Files -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Valid ID</label>
                            <input type="file" name="valid_id" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" name="profilepic" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">REGISTER NOW</button>
                </form>
            </div>
            <div class="col-lg-4 d-none d-lg-block">
                <div class="h-100 d-flex flex-column justify-content-center text-center p-4 bg-light rounded">
                    <img src="assets/img/Logo/BonVoyage - Square Logo.png" alt="Logo" class="mb-4 mx-auto" style="width: 150px;">
                    <h3>Join the Adventure</h3>
                    <p class="text-muted">Register today and explore thousands of destinations across the Philippines.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
