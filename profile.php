<?php
require('includes/db.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

// Fetch current user details
$current_user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT first_name, last_name, profile_pic_path FROM user_profiles WHERE user_id = ?");
$stmt->bindParam(1, $current_user_id);
$stmt->execute();
$currentUser = $stmt->fetch(PDO::FETCH_ASSOC);

$current_profile_pic = $currentUser['profile_pic_path'] ?: 'uploads/profile/default_profile_pic.jpg';
$user_id = isset($_GET['id']) ? intval($_GET['id']) : $current_user_id;
$searchResults = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
  $searchTerm = trim($_POST['search']);
  $sql = "SELECT a.id, a.username, p.first_name, p.middle_name, p.last_name, p.profile_pic_path 
            FROM users a 
            JOIN user_profiles p ON a.id = p.user_id
            WHERE a.id LIKE :searchTerm OR a.username LIKE :searchTerm OR 
                  CONCAT(p.first_name, ' ', p.middle_name, ' ', p.last_name) LIKE :searchTerm";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['searchTerm' => "%" . $searchTerm . "%"]);
  $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if ($user_id) {
  $stmt = $pdo->prepare("SELECT first_name, middle_name, last_name, birthday, age, city, profile_pic_path FROM user_profiles WHERE user_id = ?");
  $stmt->bindParam(1, $user_id);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($user) {
    $full_name = trim($user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name']);
    $profile_pic = $user['profile_pic_path'] ?: 'uploads/profile/default_profile_pic.jpg';
    $city = htmlspecialchars($user['city']) ?: 'Unknown';
    $age = htmlspecialchars($user['age']) ?: 'Unknown';
    $birthday = htmlspecialchars($user['birthday']) ?: 'Unknown';
    $formatted_birthday = ($birthday !== 'Unknown') ? (new DateTime($birthday))->format('F j, Y') : 'Unknown';

    $phone = 'Unknown';
    $stmt = $pdo->prepare("SELECT phone FROM users WHERE id = ?");
    $stmt->bindParam(1, $user_id);
    $stmt->execute();
    $userAccount = $stmt->fetch(PDO::FETCH_ASSOC);
    $phone = $userAccount ? htmlspecialchars($userAccount['phone']) : 'Unknown';

    try {
      $stmt = $pdo->prepare("SELECT t.tour_name as title, t.destination_description as description, t.img1 as image, t.departure_date as date, CONCAT(a.first_name, ' ', a.middle_name, ' ', a.last_name) AS host_name, t.joiner_counts AS participants_count 
                                    FROM server_tours t 
                                    JOIN user_profiles a ON t.user_id = a.user_id 
                                    WHERE t.user_id = ?");
      $stmt->bindParam(1, $user_id);
      $stmt->execute();
      $tours = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      $tours = [];
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="assets/Logo/BonVoyage - Square Logo.png" type="image/x-icon">
  <link rel="stylesheet" href="assets/css/ageneral.css">
  <link rel="stylesheet" href="assets/css/uploadTour.css" />
  <link rel="stylesheet" href="assets/css/profile.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>BonVoyage - Profile</title>
  <style>
    body {
      padding-top: 70px !important;
      margin: 0 !important;
    }

    .nav-fixed-top {
      position: fixed !important;
      top: 0 !important;
      width: 100%;
      z-index: 1050;
    }

    .text-orange {
      color: #ff6200 !important;
    }
  </style>
</head>

<body>
  <!-- Sticky Navbar -->
  <nav class="navbar navbar-expand-lg bg-white border-bottom nav-fixed-top py-2 shadow-sm">
    <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center gap-3">
        <a class="navbar-brand" href="home.php">
          <img src="assets/img/Logo/BonVoyage - Long Logo.png" alt="Logo" style="height: 35px;">
        </a>
        <div class="search-wrapper position-relative d-none d-md-block">
          <form method="POST" action="profile.php">
            <i class='bx bx-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary'></i>
            <input type="text" name="search" class="form-control border-0 bg-light rounded-pill ps-5 py-2" placeholder="Search BondVoyage" style="width: 250px;" value="<?php echo htmlspecialchars($_POST['search'] ?? ''); ?>">
          </form>
        </div>
      </div>

      <div class="d-flex align-items-center gap-2 gap-md-4">
        <a href="home.php" class="btn btn-light rounded-circle p-2 fs-5 d-none d-md-flex" title="Home"><i class='bx bxs-home-circle'></i></a>
        <a href="chats.php" class="btn btn-light rounded-circle p-2 fs-5" title="Messenger"><i class='bx bxs-message-square-dots'></i></a>
        <a href="#" class="btn btn-light rounded-circle p-2 fs-5" title="Notifications">
          <div class="position-relative">
            <i class='bx bxs-bell'></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 8px; padding: 0.3em 0.5em;">12</span>
          </div>
        </a>
        <div class="dropdown">
          <button class="btn btn-light rounded-pill d-flex align-items-center gap-2 border p-1 pe-2 shadow-sm" data-bs-toggle="dropdown">
            <img src="<?php echo htmlspecialchars($current_profile_pic); ?>" class="rounded-circle border" style="width: 32px; height: 32px; object-fit: cover;">
            <i class='bx bx-chevron-down fs-5'></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 p-2" style="border-radius: 12px; min-width: 200px;">
            <li><a class="dropdown-item rounded-3 mb-1 fw-bold" href="profile.php?id=<?php echo $current_user_id; ?>"><i class='bx bx-user-circle me-2'></i><?php echo htmlspecialchars($currentUser['first_name']); ?></a></li>
            <li>
              <hr class="dropdown-divider mx-2">
            </li>
            <li><a class="dropdown-item rounded-3 mb-1" href="home.php"><i class='bx bx-home-alt me-2'></i>News Feed</a></li>
            <li><a class="dropdown-item rounded-3 mb-1" href="landing.php"><i class='bx bx-home-alt me-2'></i>Home</a></li>
            <li><a class="dropdown-item rounded-3 mb-1" href="chats.php"><i class='bx bx-message-square-dots me-2'></i>Messages</a></li>
            <li><a class="dropdown-item rounded-3 text-danger" href="log-out.php"><i class='bx bx-log-out me-2'></i>Log Out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- Profile Header Section -->
  <div class="container head">
    <div class="profile-container">
      <div class="cover-photo">
        <button class="change-cover-btn">
          Change Cover <i class='bx bxs-image'></i>
        </button>
      </div>

      <div class="display-picture">
        <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile Photo">
      </div>

      <div class="profile-info-row">
        <div class="profile-name-text">
          <h2><?php echo htmlspecialchars($full_name); ?></h2>
          <div class="friend-count">125 Friends</div>
          <div class="joined-tours">Joined 35 Tours around the Philippines</div>
        </div>

        <div class="profile-actions-btns">
          <?php if ($user_id != $current_user_id): ?>
            <a href="messenger.php?receiver_id=<?php echo $user_id; ?>" class="message-btn text-decoration-none d-flex align-items-center justify-content-center">Message</a>
            <button class="add-btn">Add Friend</button>
          <?php else: ?>
            <button class="message-btn" onclick="location.href='settings.php'">Edit Profile</button>
            <button class="add-btn">Share Profile</button>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>


  <div class="main">
    <div class="leftside-bio">
      <!-- Bio Section -->
      <div class="Bio">
        <p>"Jobs fill your pocket, but adventures fill your soul." - "To Travel is to Live."</p>
        <span class="bio-label">Bio</span>
      </div>

      <!-- About Me Section -->
      <div class="AboutMe">
        <h3>About Me</h3>
        <div class="about-item">
          Studies at <strong>Technological Institute of the Philippines</strong>
        </div>
        <div class="about-item">
          Went to <strong>Malolos, Bulacan</strong>
        </div>
        <div class="about-item">
          Lives in <strong>Taytay, Rizal</strong>
        </div>
        <?php if (isset($age) && $age != 'Unknown'): ?>
          <div class="about-item">
            Age: <strong><?php echo htmlspecialchars($age); ?></strong>
          </div>
        <?php endif; ?>
      </div>

      <!-- Friends Section -->
      <div class="Friends">
        <h3>Friends</h3>
        <div class="friends-grid">
          <div class="friend-item">
            <img src="assets/images/ELIJAH.jpg" class="friends-img">
            <span class="friend-name">Elijah Arizobal</span>
          </div>
          <div class="friend-item">
            <img src="assets/images/Gello.jpg" class="friends-img">
            <span class="friend-name">Louise Cabana</span>
          </div>
          <div class="friend-item">
            <img src="assets/images/ARON.jpg" class="friends-img">
            <span class="friend-name">Aron Jeric Cao</span>
          </div>
          <div class="friend-item">
            <img src="assets/images/Marc.jpg" class="friends-img">
            <span class="friend-name">Marc John Badua</span>
          </div>
          <div class="friend-item">
            <img src="assets/images/jhi.jpg" class="friends-img">
            <span class="friend-name">Jhilou Lian Carpizo</span>
          </div>
          <div class="friend-item">
            <img src="assets/images/cid.jpg" class="friends-img">
            <span class="friend-name">El Cid Apalisok</span>
          </div>
          <div class="friend-item">
            <img src="assets/images/gwen.jpg" class="friends-img">
            <span class="friend-name">Gwen Flores</span>
          </div>
          <div class="friend-item">
            <img src="assets/images/marielle.jpg" class="friends-img">
            <span class="friend-name">Marielle Festejo</span>
          </div>
          <div class="friend-item">
            <img src="assets/images/jorgie.jpg" class="friends-img">
            <span class="friend-name">Jorgie Mae Jamison</span>
          </div>
        </div>
      </div>

      <!-- Find Other People Section -->
      <div class="findpeople">
        <h3>Find other People</h3>
        <form method="post" action="">
          <div class="search-input-group">
            <input type="search" name="search" class="search-field" placeholder="User ID or User Name" value="<?php echo htmlspecialchars($_POST['search'] ?? ''); ?>">
            <button type="submit" class="search-submit-btn">
              <i class='bx bxs-user-plus'></i>
            </button>
          </div>
        </form>

        <?php if (!empty($searchResults)): ?>
          <div class="search-results mt-3">
            <ul class="list-unstyled">
              <?php foreach ($searchResults as $sUser): ?>
                <li class="mb-2">
                  <a href="profile.php?id=<?php echo $sUser['id']; ?>" class="d-flex align-items-center text-decoration-none text-dark">
                    <img src="<?php echo htmlspecialchars($sUser['profile_pic_path'] ?: 'uploads/profile/default_profile_pic.jpg'); ?>" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                    <div style="font-size: 13px;">
                      <strong><?php echo htmlspecialchars($sUser['username']); ?></strong><br>
                      <small class="text-muted"><?php echo htmlspecialchars($sUser['first_name'] . ' ' . $sUser['last_name']); ?></small>
                    </div>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
      </div>
    </div>



    <div class="container rightside">
      <h3 class="tours-title">Tours, Vacations, and Activities</h3>
      <div class="post-card-container">
        <?php if (!empty($tours)): ?>
          <?php foreach ($tours as $tour): ?>
            <div class="post-card mb-4">
              <div class="card-header">
                <div class="d-flex align-items-center">
                  <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Host" class="profile-img-header">
                  <div class="host-info">
                    <h4><?php echo htmlspecialchars($tour['host_name']); ?></h4>
                    <p>Travel Host</p>
                  </div>
                </div>
                <div class="card-date">
                  <?php echo date('F j, Y', strtotime($tour['date'])); ?>
                </div>
              </div>

              <div class="card-image">
                <img src="<?php echo htmlspecialchars($tour['image']); ?>" alt="Tour Image">
                <div class="carousel-controls">
                  <button class="carousel-arrow">⟨</button>
                  <button class="carousel-arrow">⟩</button>
                </div>
                <div class="people-count">
                  <i class='bx bxs-user'></i> <?php echo htmlspecialchars($tour['participants_count'] ?? '06/10'); ?>
                </div>
              </div>

              <div class="card-content">
                <div class="title-row">
                  <h3 class="tour-title-text"><?php echo htmlspecialchars($tour['title']); ?></h3>
                  <div class="title-actions">
                    <button class="info-btn"><i class='bx bxs-info-circle'></i></button>
                    <button class="join-btn">Join the Tour</button>
                  </div>
                </div>
                <p class="card-description"><?php echo htmlspecialchars($tour['description']); ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="text-center py-5 text-muted">
            <i class='bx bx-images fs-1 d-block mb-3'></i>
            <p>No tours available yet.</p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  </div>
  </div>

  <script src="assets/js/ageneral.js"></script>
  <?php
  include('includes/footer.php');
  ?>
</body>

</html>