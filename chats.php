<?php
require('includes/db.php');
session_start();

// Set the time zone
date_default_timezone_set('Asia/Manila');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$current_user_id = $_SESSION['user_id'];
$username = $_SESSION['username'] ?? 'User';
$search_query = isset($_POST['search']) ? trim($_POST['search']) : '';
$selected_receiver_id = isset($_GET['receiver_id']) ? intval($_GET['receiver_id']) : null;

// Handle sending message
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message']) && $selected_receiver_id) {
    $msg_text = trim($_POST['message_text']);
    if ($msg_text !== '') {
        $send_stmt = $pdo->prepare("INSERT INTO messenger (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        $send_stmt->execute([$current_user_id, $selected_receiver_id, $msg_text]);
        // Refresh to show new message
        header("Location: chats.php?receiver_id=$selected_receiver_id");
        exit;
    }
}

// Fetch search results if a search query is provided
$searchResults = [];
if ($search_query) {
    $stmt = $pdo->prepare("
        SELECT a.id, a.username, p.first_name, p.last_name, p.profile_pic_path
        FROM users a
        JOIN user_profiles p ON a.id = p.user_id
        WHERE a.id != :current_user_id 
        AND (
            a.username LIKE :search OR 
            p.first_name LIKE :search OR 
            p.last_name LIKE :search
        )
        LIMIT 10
    ");
    $stmt->execute(['search' => "%$search_query%", 'current_user_id' => $current_user_id]);
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch recent chats (Inbox)
$stmt = $pdo->prepare("
    SELECT a.id, a.username, p.first_name, p.last_name, p.profile_pic_path,
           m.message, m.created_at, m.sender_id
    FROM users a
    JOIN user_profiles p ON a.id = p.user_id
    JOIN (
        SELECT *, 
               ROW_NUMBER() OVER (PARTITION BY LEAST(sender_id, receiver_id), GREATEST(sender_id, receiver_id) ORDER BY created_at DESC) AS rn
        FROM messenger 
        WHERE sender_id = :current_user_id OR receiver_id = :current_user_id
    ) m ON (m.sender_id = a.id AND m.receiver_id = :current_user_id) 
         OR (m.receiver_id = a.id AND m.sender_id = :current_user_id)
    WHERE a.id != :current_user_id 
    AND m.rn = 1
    ORDER BY m.created_at DESC
");
$stmt->execute(['current_user_id' => $current_user_id]);
$inboxMessages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch active conversation
$activeMessages = [];
$receiverData = null;
if ($selected_receiver_id) {
    // Get receiver details
    $r_stmt = $pdo->prepare("SELECT a.username, p.first_name, p.last_name, p.profile_pic_path FROM users a JOIN user_profiles p ON a.id = p.user_id WHERE a.id = ?");
    $r_stmt->execute([$selected_receiver_id]);
    $receiverData = $r_stmt->fetch(PDO::FETCH_ASSOC);

    // Get messages
    $m_stmt = $pdo->prepare("
        SELECT * FROM messenger 
        WHERE (sender_id = ? AND receiver_id = ?) 
        OR (sender_id = ? AND receiver_id = ?) 
        ORDER BY created_at ASC
    ");
    $m_stmt->execute([$current_user_id, $selected_receiver_id, $selected_receiver_id, $current_user_id]);
    $activeMessages = $m_stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch current user details for the navbar
$stmt_nav = $pdo->prepare("SELECT first_name, profile_pic_path FROM user_profiles WHERE user_id = ?");
$stmt_nav->execute([$current_user_id]);
$currentUser = $stmt_nav->fetch(PDO::FETCH_ASSOC);
$current_profile_pic = ($currentUser && $currentUser['profile_pic_path']) ? $currentUser['profile_pic_path'] : 'uploads/profile/default_profile_pic.jpg';
$first_name = $currentUser ? $currentUser['first_name'] : 'User';

function formatTime($timestamp)
{
    $time = strtotime($timestamp);
    $now = time();
    $diff = $now - $time;
    if ($diff < 60) return 'now';
    if ($diff < 3600) return floor($diff / 60) . 'm';
    if ($diff < 86400) return floor($diff / 3600) . 'h';
    if ($diff < 604800) return floor($diff / 86400) . 'd';
    return date('M j', $time);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inbox • Chats</title>
    <!-- External Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/chats.css">
    <link rel="shortcut icon" href="assets/Logo/BonVoyage - Square Logo.png" type="image/x-icon">
    <style>
        body {
            padding-top: 70px !important;
            margin: 0 !important;
            background: #fff;
        }

        .nav-fixed-top {
            position: fixed !important;
            top: 0 !important;
            width: 100%;
            z-index: 1050;
        }

        .messenger-wrapper {
            height: calc(100vh - 70px);
            margin: 0 auto;
            border: none;
            border-radius: 0;
            max-width: 100%;
            border-top: 1px solid #dbdbdb;
        }

        .text-orange {
            color: #ff6200 !important;
        }

        /* Modern Scrollbar */
        .chats-list::-webkit-scrollbar,
        .message-bubbles::-webkit-scrollbar {
            width: 6px;
        }

        .chats-list::-webkit-scrollbar-thumb,
        .message-bubbles::-webkit-scrollbar-thumb {
            background: #dbdbdb;
            border-radius: 10px;
        }

        .message-bubbles {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            background: #fff;
        }

        .bubble {
            max-width: 60%;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 15px;
            position: relative;
            line-height: 1.4;
        }

        .bubble.sent {
            align-self: flex-end;
            background: #ff6200;
            color: #fff;
            border-bottom-right-radius: 4px;
        }

        .bubble.received {
            align-self: flex-start;
            background: #efefef;
            color: #262626;
            border-bottom-left-radius: 4px;
        }

        .chat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 20px;
            border-bottom: 1px solid #efefef;
            background: #fff;
        }

        .chat-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chat-user img {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            object-fit: cover;
        }

        .chat-user .name {
            font-weight: 600;
            font-size: 16px;
        }

        .chat-input-area {
            padding: 20px;
            border-top: 1px solid #efefef;
            background: #fff;
        }

        .input-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid #dbdbdb;
            border-radius: 30px;
            padding: 5px 15px;
        }

        .input-wrapper input {
            flex: 1;
            border: none;
            padding: 8px;
            font-size: 14px;
            outline: none;
        }

        .btn-send {
            color: #ff6200;
            font-weight: 700;
            background: none;
            border: none;
            font-size: 14px;
            opacity: 0.5;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-send.active {
            opacity: 1;
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
                        <input type="text" name="search" class="form-control border-0 bg-light rounded-pill ps-5 py-2" placeholder="Search BondVoyage" style="width: 250px;">
                    </form>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2 gap-md-4">
                <a href="home.php" class="btn btn-light rounded-circle p-2 fs-5 d-none d-md-flex" title="Home"><i class='bx bxs-home-circle'></i></a>
                <a href="chats.php" class="btn btn-light rounded-circle p-2 fs-5" title="Messenger"><i class='bx bxs-message-square-dots text-orange'></i></a>
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
                        <li><a class="dropdown-item rounded-3 mb-1 fw-bold" href="profile.php?id=<?php echo $current_user_id; ?>"><i class='bx bx-user-circle me-2'></i><?php echo htmlspecialchars($first_name); ?></a></li>
                        <li>
                            <hr class="dropdown-divider mx-2">
                        </li>
                        <li><a class="dropdown-item rounded-3 mb-1" href="home.php"><i class='bx bx-home-alt me-2'></i>News Feed</a></li>
                        <li><a class="dropdown-item rounded-3 mb-1" href="profile.php"><i class='bx bx-user me-2'></i>My Profile</a></li>
                        <li><a class="dropdown-item rounded-3 text-danger" href="log-out.php"><i class='bx bx-log-out me-2'></i>Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="messenger-wrapper">
        <!-- Sidebar -->
        <aside class="messenger-sidebar">
            <header class="sidebar-header">
                <h1><?php echo htmlspecialchars($username); ?> <i class='bx bx-chevron-down'></i></h1>
                <i class='bx bx-edit fs-4 text-dark' style="cursor: pointer;"></i>
            </header>

            <div class="search-box">
                <form method="post" action="">
                    <div class="search-input-wrapper">
                        <i class='bx bx-search'></i>
                        <input type="text" name="search" class="search-field" placeholder="Search" value="<?php echo htmlspecialchars($search_query); ?>">
                    </div>
                </form>
            </div>

            <div class="chats-list">
                <?php if ($search_query): ?>
                    <div class="px-3 py-2 border-bottom"><small class="text-secondary fw-bold">SEARCH RESULTS</small></div>
                    <?php foreach ($searchResults as $user): ?>
                        <a href="chats.php?receiver_id=<?php echo $user['id']; ?>" class="chat-item <?php echo $selected_receiver_id == $user['id'] ? 'active' : ''; ?>">
                            <img src="<?php echo htmlspecialchars($user['profile_pic_path'] ?: 'uploads/profile/default_profile_pic.jpg'); ?>" class="chat-avatar">
                            <div class="chat-info">
                                <div class="chat-name"><?php echo htmlspecialchars($user['username']); ?></div>
                                <div class="chat-metadata">
                                    <div class="last-message"><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                    <div class="px-3 py-2 border-bottom mt-2"><small class="text-secondary fw-bold">CHATS</small></div>
                <?php endif; ?>

                <?php foreach ($inboxMessages as $user): ?>
                    <a href="chats.php?receiver_id=<?php echo $user['id']; ?>" class="chat-item <?php echo $selected_receiver_id == $user['id'] ? 'active' : ''; ?>">
                        <img src="<?php echo htmlspecialchars($user['profile_pic_path'] ?: 'uploads/profile/default_profile_pic.jpg'); ?>" class="chat-avatar">
                        <div class="chat-info">
                            <div class="chat-name"><?php echo htmlspecialchars($user['username']); ?></div>
                            <div class="chat-metadata">
                                <div class="last-message"><?php echo ($user['sender_id'] == $current_user_id ? 'You: ' : '') . htmlspecialchars($user['message']); ?></div>
                                <span class="chat-dot">•</span>
                                <span class="chat-time"><?php echo formatTime($user['created_at']); ?></span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </aside>

        <!-- Main Content -->
        <?php if ($selected_receiver_id && $receiverData): ?>
            <main class="messenger-content p-0" style="display: flex; flex-direction: column;">
                <div class="chat-header">
                    <div class="chat-user">
                        <img src="<?php echo htmlspecialchars($receiverData['profile_pic_path'] ?: 'uploads/profile/default_profile_pic.jpg'); ?>">
                        <div>
                            <div class="name"><?php echo htmlspecialchars($receiverData['first_name'] . ' ' . $receiverData['last_name']); ?></div>
                            <small class="text-secondary">@<?php echo htmlspecialchars($receiverData['username']); ?></small>
                        </div>
                    </div>
                    <div class="d-flex gap-3 fs-4 text-dark">
                        <i class='bx bx-phone' style="cursor: pointer;"></i>
                        <i class='bx bx-video' style="cursor: pointer;"></i>
                        <i class='bx bx-info-circle' style="cursor: pointer;"></i>
                    </div>
                </div>

                <div class="message-bubbles" id="message-container">
                    <?php if (empty($activeMessages)): ?>
                        <div class="text-center p-5 text-secondary">
                            <img src="<?php echo htmlspecialchars($receiverData['profile_pic_path'] ?: 'uploads/profile/default_profile_pic.jpg'); ?>" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 15px;">
                            <h4><?php echo htmlspecialchars($receiverData['first_name']); ?></h4>
                            <p class="small">BondVoyage Traveler</p>
                            <button class="btn btn-light btn-sm mt-2 fw-bold">View Profile</button>
                        </div>
                    <?php endif; ?>
                    <?php foreach ($activeMessages as $m): ?>
                        <div class="bubble <?php echo $m['sender_id'] == $current_user_id ? 'sent' : 'received'; ?>" title="<?php echo $m['created_at']; ?>">
                            <?php echo htmlspecialchars($m['message']); ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="chat-input-area">
                    <form method="POST" action="chats.php?receiver_id=<?php echo $selected_receiver_id; ?>" class="input-wrapper">
                        <i class='bx bx-smile fs-4'></i>
                        <input type="text" name="message_text" placeholder="Message..." autocomplete="off" required>
                        <button type="submit" name="send_message" class="btn-send active">Send</button>
                    </form>
                </div>
            </main>
        <?php else: ?>
            <main class="messenger-content">
                <div class="placeholder-icon"><i class='bx bx-paper-plane'></i></div>
                <h2>Your Messages</h2>
                <p>Send private photos and messages to a friend or group.</p>
                <button class="btn-send-msg" onclick="document.querySelector('.search-field').focus()">Send Message</button>
            </main>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-scroll chat to bottom
        const container = document.getElementById('message-container');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }

        // Enable/disable send button
        const input = document.querySelector('input[name="message_text"]');
        const btn = document.querySelector('.btn-send');
        if (input && btn) {
            input.addEventListener('input', () => {
                if (input.value.trim() !== '') {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
        }
    </script>
</body>

</html>