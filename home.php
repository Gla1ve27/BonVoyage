<?php
require('includes/db.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch current user details
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT first_name, last_name, profile_pic_path FROM user_profiles WHERE user_id = ?");
$stmt->bindParam(1, $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Default profile picture if not set
$profile_pic = $user['profile_pic_path'] ?: 'uploads/profile/default_profile_pic.jpg';

// Fetch all tours from the database, including host profile picture
$tours_stmt = $pdo->prepare("
    SELECT t.tour_name AS title, 
           t.destination_description AS description, 
           t.departure_date AS date, 
           t.img1 AS image,
           t.joiner_counts AS participants_count, 
           CONCAT(p.first_name, ' ', p.last_name) AS host_name,
           p.profile_pic_path AS host_profile_pic 
    FROM server_tours t 
    JOIN user_profiles p ON t.user_id = p.user_id 
    ORDER BY t.departure_date DESC
");
$tours_stmt->execute();
$tours = $tours_stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch online contacts
$contacts_stmt = $pdo->prepare("
    SELECT a.id, p.first_name, p.middle_name, p.last_name, p.profile_pic_path, a.online
    FROM users a
    JOIN user_profiles p ON a.id = p.user_id
    WHERE a.id != :current_user_id AND a.online = 1  -- Check if user is online
");
$contacts_stmt->execute(['current_user_id' => $user_id]);
$onlineContacts = $contacts_stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all users from the accounts table excluding the logged-in user
$stmt = $pdo->prepare("SELECT a.id, p.first_name, p.middle_name, p.last_name, p.profile_pic_path, a.online 
                       FROM users a 
                       JOIN user_profiles p ON a.id = p.user_id 
                       WHERE a.id != :current_user_id"); // Exclude the logged-in user
$stmt->execute(['current_user_id' => $user_id]);
$allContacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>News Feed • BondVoyage</title>

    <!-- External Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Style -->
    <link rel="stylesheet" href="assets/css/home_fb.css">
    <link rel="shortcut icon" href="assets/Logo/BonVoyage - Square Logo.png" type="image/x-icon">
</head>

<body>

    <!-- Sticky Navbar -->
    <nav class="navbar navbar-expand-lg bg-white border-bottom fixed-top py-2 shadow-sm">
        <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <a class="navbar-brand" href="home.php">
                    <img src="assets/img/Logo/BonVoyage - Long Logo.png" alt="Logo" style="height: 35px;">
                </a>
                <div class="search-wrapper position-relative d-none d-md-block">
                    <form method="POST" action="profile.php">
                        <i class='bx bx-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary'></i>
                        <input type="text" name="search" class="form-control border-0 bg-light rounded-pill ps-5 py-2" placeholder="Search BondVoyage" style="width: 250px;">
                    </form>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2 gap-md-4">
                <a href="home.php" class="btn btn-light rounded-circle p-2 fs-5 d-none d-md-flex" title="Home"><i class='bx bxs-home-circle text-orange' style="color: #ff6200;"></i></a>
                <a href="chats.php" class="btn btn-light rounded-circle p-2 fs-5" title="Messenger"><i class='bx bxs-message-square-dots'></i></a>
                <a href="#" class="btn btn-light rounded-circle p-2 fs-5" title="Notifications"><i class='bx bxs-bell'></i></a>
                <div class="dropdown">
                    <button class="btn btn-light rounded-pill d-flex align-items-center gap-2 border p-1 pe-2 shadow-sm" data-bs-toggle="dropdown">
                        <img src="<?php echo htmlspecialchars($profile_pic); ?>" class="rounded-circle border" style="width: 32px; height: 32px; object-fit: cover;">
                        <i class='bx bx-chevron-down fs-5'></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 p-2" style="border-radius: 12px; min-width: 200px;">
                        <li><a class="dropdown-item rounded-3 mb-1 fw-bold" href="profile.php?id=<?php echo $user_id; ?>"><i class='bx bx-user-circle me-2'></i><?php echo htmlspecialchars($user['first_name']); ?></a></li>
                        <li>
                            <hr class="dropdown-divider mx-2">
                        </li>
                        <li><a class="dropdown-item rounded-3 mb-1" href="home.php"><i class='bx bx-home-alt me-2'></i>News Feed</a></li>
                        <li><a class="dropdown-item rounded-3 mb-1" href="landing.php"><i class='bx bx-home-alt me-2'></i>Home</a></li>
                        <li><a class="dropdown-item rounded-3 mb-1" href="settings.php"><i class='bx bx-cog me-2'></i>Settings</a></li>
                        <li><a class="dropdown-item rounded-3 text-danger" href="log-out.php"><i class='bx bx-log-out me-2'></i>Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="newsfeed-container">
        <!-- LEFT SIDEBAR -->
        <aside class="sidebar-left">
            <a href="profile.php?id=<?php echo $user_id; ?>" class="sidebar-item">
                <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="">
                <span><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></span>
            </a>
            <a href="#" class="sidebar-item">
                <i class='bx bxs-user-detail' style="color: #1877f2;"></i>
                <span>Find Friends</span>
            </a>
            <a href="#" class="sidebar-item">
                <i class='bx bxs-group' style="color: #2abba7;"></i>
                <span>Groups</span>
            </a>
            <a href="#" class="sidebar-item">
                <i class='bx bxs-calendar-event' style="color: #f35369;"></i>
                <span>Events</span>
            </a>
            <a href="#" class="sidebar-item">
                <i class='bx bxs-bookmark' style="color: #e24dc5;"></i>
                <span>Saved</span>
            </a>
            <a href="#" class="sidebar-item">
                <i class='bx bxs-flag-alt' style="color: #ff7e29;"></i>
                <span>Pages</span>
            </a>
            <hr class="mx-3 my-2 text-secondary">
            <p class="px-3 mb-1 text-secondary fw-bold small">Your Shortcuts</p>
            <a href="#" class="sidebar-item">
                <i class='bx bxs-car' style="color: #ff6200;"></i>
                <span>My Bookings</span>
            </a>
            <a href="uploadTour.php" class="sidebar-item">
                <i class='bx bxs-plus-circle' style="color: #45bd62;"></i>
                <span>Host a Tour</span>
            </a>
        </aside>

        <!-- MAIN FEED -->
        <main class="main-feed">
            <!-- Create Post Box -->
            <div class="create-post-card">
                <div class="create-post-top">
                    <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="">
                    <div class="create-post-input" onclick="location.href='uploadTour.php'">
                        What's on your mind, <?php echo htmlspecialchars($user['first_name']); ?>?
                    </div>
                </div>
                <div class="create-post-actions">
                    <div class="post-action-btn"><i class='bx bxs-video-plus fs-4'></i>Live Video</div>
                    <div class="post-action-btn"><i class='bx bxs-image-add fs-4'></i>Photo/Video</div>
                    <div class="post-action-btn"><i class='bx bxs-smile fs-4'></i>Feeling/Activity</div>
                </div>
            </div>

            <!-- Posts List -->
            <div class="posts-list">
                <?php if (!empty($tours)): ?>
                    <?php foreach ($tours as $tour): ?>
                        <div class="fb-post-card">
                            <div class="fb-post-header">
                                <div class="fb-post-user-info">
                                    <img src="<?php echo htmlspecialchars($tour['host_profile_pic'] ?: 'uploads/profile/default_profile_pic.jpg'); ?>" alt="">
                                    <div class="fb-post-name-time">
                                        <h5><?php echo htmlspecialchars($tour['host_name']); ?></h5>
                                        <span><?php echo date('F j, Y', strtotime($tour['date'])); ?> • <i class='bx bx-world'></i></span>
                                    </div>
                                </div>
                                <button class="btn btn-link text-secondary p-1"><i class='bx bx-dots-horizontal-rounded fs-4'></i></button>
                            </div>

                            <div class="fb-post-content">
                                <p class="mb-2 fw-bold" style="color: #ff6200;"><?php echo htmlspecialchars($tour['title']); ?></p>
                                <p><?php echo htmlspecialchars($tour['description']); ?></p>
                            </div>

                            <img src="<?php echo htmlspecialchars($tour['image']); ?>" class="fb-post-image" alt="Tour Photo">

                            <div class="fb-post-stats">
                                <div class="likes-preview d-flex align-items-center gap-1">
                                    <i class='bx bxs-like text-primary fs-5'></i>
                                    <i class='bx bxs-heart text-danger fs-5'></i>
                                    <span>24 Likes</span>
                                </div>
                                <div>
                                    <span><?php echo htmlspecialchars($tour['participants_count']); ?> Joiners • 15 Shares</span>
                                </div>
                            </div>

                            <div class="fb-post-footer">
                                <div class="fb-post-action"><i class='bx bx-like fs-4'></i>Like</div>
                                <div class="fb-post-action" onclick="location.href='messenger.php'"><i class='bx bx-message-square-rounded fs-4'></i>Comment</div>
                                <div class="fb-post-action fw-bold" style="color: #ff6200;"><i class='bx bxs-navigation fs-4'></i>Join Tour</div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="bg-white p-5 text-center text-muted rounded shadow-sm">
                        <i class='bx bx-spreadsheet fs-1 d-block mb-3'></i>
                        <p>No tours available in your feed yet.</p>
                        <a href="uploadTour.php" class="btn btn-orange text-white" style="background:#ff6200;">Be the first to host!</a>
                    </div>
                <?php endif; ?>
            </div>
        </main>

        <!-- RIGHT SIDEBAR -->
        <aside class="sidebar-right">
            <div class="contacts-header">
                <h6>Contacts</h6>
                <div class="d-flex gap-2">
                    <i class='bx bxs-video-plus fs-5'></i>
                    <i class='bx bx-search fs-5'></i>
                    <i class='bx bx-dots-horizontal-rounded fs-5'></i>
                </div>
            </div>

            <div class="contacts-list mt-2">
                <?php foreach ($allContacts as $contact): ?>
                    <div class="contact-item" onclick="location.href='messenger.php?receiver_id=<?php echo $contact['id']; ?>'">
                        <div class="contact-avatar-wrapper">
                            <img src="<?php echo htmlspecialchars($contact['profile_pic_path'] ?: 'uploads/profile/default_profile_pic.jpg'); ?>" class="contact-avatar" alt="">
                            <?php if ($contact['online']): ?>
                                <div class="online-dot"></div>
                            <?php endif; ?>
                        </div>
                        <span class="contact-name"><?php echo htmlspecialchars($contact['first_name'] . ' ' . $contact['last_name']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <hr class="mx-3 my-3 text-secondary">
            <div class="px-3">
                <h6 class="text-secondary fw-bold small mb-3">Group Conversations</h6>
                <a href="#" class="sidebar-item p-2">
                    <i class='bx bxs-plus-circle fs-3 text-secondary'></i>
                    <span>Create New Group</span>
                </a>
            </div>
        </aside>
    </div>

    <!-- Bootstrap & Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/ageneral.js"></script>

</body>

</html>