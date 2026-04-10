<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'BonVoyage'; ?></title>
    
    <!-- Favicons -->
    <link rel="shortcut icon" href="assets/img/Logo/BonVoyage - Square Logo.png" type="image/x-icon">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">

    <!-- CSS Vendor Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/vendors/aos.css" rel="stylesheet">
    <link href="assets/vendors/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendors/swiper-bundle.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Main CSS Files -->
    <link rel="stylesheet" href="assets/css/ageneral.css">
    <?php if (isset($extraCSS)): ?>
        <?php foreach ($extraCSS as $css): ?>
            <link rel="stylesheet" href="assets/css/<?php echo $css; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body class="<?php echo isset($bodyClass) ? $bodyClass : ''; ?>">
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="landing.php">
                <img src="assets/img/Logo/BonVoyage - Long Logo.png" alt="BonVoyageLogo" class="logo-image" style="height: 50px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-3 pt-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="landing.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="itineraries.php">Destinations</a></li>
                    <li class="nav-item"><a class="nav-link" href="about-us.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="contactus.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="partnership.php">Partners</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="log-out.php">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="registration.php">Sign up</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Log in</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <main class="main">
