<?php
require('includes/db.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php"); // Redirect to login if not logged in
  exit;
}

// Fetch current user details
$current_user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT first_name, last_name, profilepic FROM personalinformation WHERE id = ?");
$stmt->bindParam(1, $current_user_id);
$stmt->execute();
$currentUser = $stmt->fetch(PDO::FETCH_ASSOC);

// Default profile picture if not set
$current_profile_pic = $currentUser['profilepic'] ?: 'uploads/profile/default_profile_pic.jpg';

// Get user ID from URL
$user_id = isset($_GET['id']) ? intval($_GET['id']) : null;

$searchResults = [];

// Handle search functionality
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
  $searchTerm = trim($_POST['search']);

  // Prepare SQL query to search for users by ID, username, or name
  $sql = "SELECT a.id, a.username, p.first_name, p.middle_name, p.last_name, p.profilepic 
            FROM accounts a 
            JOIN personalinformation p ON a.id = p.id
            WHERE a.id LIKE :searchTerm OR a.username LIKE :searchTerm OR 
                  CONCAT(p.first_name, ' ', p.middle_name, ' ', p.last_name) LIKE :searchTerm";

  $stmt = $pdo->prepare($sql);
  $stmt->execute(['searchTerm' => "%" . $searchTerm . "%"]); // Use wildcard for searching
  $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if ($user_id) {
  // Fetch user data
  $stmt = $pdo->prepare("SELECT first_name, middle_name, last_name, birthday, age, city, profilepic FROM personalinformation WHERE id = ?");
  $stmt->bindParam(1, $user_id);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    // User data exists
    $full_name = trim($user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name']);
    $profile_pic = $user['profilepic'] ?: 'uploads/profile/default_profile_pic.jpg';
    $city = htmlspecialchars($user['city']) ?: 'Unknown';
    $age = htmlspecialchars($user['age']) ?: 'Unknown';
    $birthday = htmlspecialchars($user['birthday']) ?: 'Unknown';

    if ($birthday !== 'Unknown') {
      $dateTime = new DateTime($birthday);
      $formatted_birthday = $dateTime->format('F j, Y');
    } else {
      $formatted_birthday = 'Unknown';
    }

    // Fetch user's phone number if logged in
    $phone = 'Unknown';
    if (isset($_SESSION['user_id'])) {
      $stmt = $pdo->prepare("SELECT phone FROM accounts WHERE id = ?");
      $stmt->bindParam(1, $user_id);
      $stmt->execute();
      $userAccount = $stmt->fetch(PDO::FETCH_ASSOC);
      $phone = $userAccount ? htmlspecialchars($userAccount['phone']) : 'Unknown';
    }

    $stmt = $pdo->prepare("SELECT sender_id, message, created_at FROM messenger WHERE receiver_id = ? ORDER BY created_at DESC");
    $stmt->bindParam(1, $current_user_id);
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Fetch tours with host name
    $stmt = $pdo->prepare("SELECT t.title, t.description, t.image, t.date, CONCAT(a.first_name, ' ', a.middle_name, ' ', a.last_name) AS host_name, t.participants_count 
                                FROM tours t 
                                JOIN personalinformation a ON t.user_id = a.id 
                                WHERE t.user_id = ?");
    $stmt->bindParam(1, $user_id);
    $stmt->execute();
    $tours = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } else {
    // User not found
    $error_message = "User not found.";
  }
} else {
  // Invalid request
  header("Location: profile1.php");
  exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="assets/Logo/BonVoyage - Square Logo.png" type="image/x-icon">
  <link rel="stylesheet" href="adminLogin.css">
  <link rel="stylesheet" href="ageneral.css">

  <!-- Bootstrap Import Link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <!-- Importat link of Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="uploadTour.css" />
  <link rel="stylesheet" href="ageneral.css" />
  <link rel="stylesheet" href="assets/css/profile.css" />

  <title>BonVoyage - Profile</title>
  <style>
    /* Messenger Modal Styles */
    .chat-container {
      max-height: 400px;
      overflow-y: auto;
    }

    .chat-messages {
      margin-bottom: 20px;
    }

    .message {
      display: flex;
      align-items: flex-start;
      margin-bottom: 10px;
    }

    .message.left .message-content {
      background-color: #f1f1f1;
      border-radius: 8px;
      padding: 8px 15px;
      max-width: 70%;
    }

    .message.right .message-content {
      background-color: #4CAF50;
      color: white;
      border-radius: 8px;
      padding: 8px 15px;
      max-width: 70%;
    }

    .message-img {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .message-input-container {
      display: flex;
      align-items: center;
    }

    #messageInput {
      flex: 1;
      margin-right: 10px;
    }
  </style>
</head>

<body>
  <!--Navigation Bar-->
  <nav class="navbar navbar-expand-lg mb-4">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="assets/img/Logo/BonVoyage - Long Logo.png" alt="BonVoyageLogo" class="logo-image">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-3 pt-2 mb-lg-0">
          <li class="nav-item"></li>
          <div class="nav-profile d-flex">
            <button><i class='bx bx-cog'></i></button>
            <button class="notif-button"><i class='bx bx-bell notif-btn-icon'>
                <p class="notif-counter">12</p>
              </i></button>
            <button class="profile-btn">
              <img src="<?php echo htmlspecialchars($current_profile_pic); ?>" alt="profile" class="rounded-circle" style="width: 30px; height: 30px;"><i class='bx bx-menu'></i></button>
            <div class="profile-options">
              <a href="log-out.php">
                <button><i class='bx bx-log-out'></i>Log Out</button>
                <a href="home.php">
                  <button><i class='bx bx-user-circle'></i>Home</button>
                </a>
                <a href="chats.php">
                  <button><i class='bx bxs-chat'></i>Messages</button>
                </a>
            </div>
            <div class="notification-list">
              <h5 class="mb-1">Notifications <span>12</span></h5>
              <div class="notif-container">
                <!-- Example Notification -->
                <div class="add-friend-notif">
                  <div class="img-container">
                    <img src="assets/profilePicture/aronjeric.jpg" alt="profile">
                    <span class="notif-icon" style="background-color: #f36e01;">
                      <i class='bx bxs-user'></i>
                    </span>
                  </div>
                  <div class="notif-content">
                    <p><span style="font-weight: bold;">Aron Jeric Cao</span> sent you a friend request.</p>
                    <div class="btn-container">
                      <button class="accept-btn">Accept</button>
                      <button class="decline-btn">Decline</button>
                    </div>
                  </div>
                </div>
                <!-- Add more notifications as needed -->
              </div>
            </div>
          </div>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container head">
    <div class="row">
      <div class="col-md-12">
        <div class="profile-container">
          <div class="cover-photo cover-container">
            <button class="change-cover-btn">Change Cover</button>
          </div>
          <div class="display-picture">
            <a href="#">
              <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile Photo">
            </a>
          </div>
          <div class="profile-name">
            <h2><?php echo htmlspecialchars($full_name); ?></h2>
            <p><strong>3.1K Friends</strong></p>
            <p>Joined 32 Tours around the Philippines</p>
          </div>
          <div class="profile-actions">
            <button class="message-btn" data-bs-toggle="modal" data-bs-target="#messageModal">Message</button>
            <button class="add-btn">Add Friend</button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="container main">
    <div class="container leftside-bio">
      <div class="Bio">
        <p>I can do all things through Christ who strengthens me. Philippians 4:13</p>
      </div>
      <div class="AboutMe">
        <h3>About Me</h3>
        <p>Age: <strong><?php echo $age; ?></strong></p>
        <p>Birthday: <strong><?php echo $formatted_birthday; ?></strong></p>
        <p>Lives in: <strong><?php echo $city; ?></strong></p>
        <?php if (isset($_SESSION['user_id'])): ?>
          <p>Phone Number: <strong><?php echo $phone; ?></strong></p>
        <?php endif; ?>
      </div>
      <div class="Friends">
        <h3>Friends</h3>
        <div class="container bonfriends">
          <div class="row mb-2">
            <div class="col-md-4">
              <img src="assets/images/ELIJAH.jpg" class="friends-img">
              <p>Elijah Arizobal</p>
            </div>
            <div class="col-md-4">
              <img src="assets/images/Marc.jpg" class="friends-img">
              <p>Marc John Badua</p>
            </div>
            <div class="col-md-4">
              <img src="assets/images/ARON.jpg" class="friends-img">
              <p>Aron Jeric Cao</p>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4">
              <img src="assets/images/Gello.jpg" class="friends-img">
              <p>Louise Cabana</p>
            </div>
            <div class="col-md-4">
              <img src="assets/images/jhi.jpg" class="friends-img">
              <p>Jhilou Lian Carpizo</p>
            </div>
            <div class="col-md-4">
              <img src="assets/images/cid.jpg" class="friends-img">
              <p>El Cid Apalisok</p>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4">
              <img src="assets/images/gwen.jpg" class="friends-img">
              <p>Gwen Flores</p>
            </div>
            <div class="col-md-4">
              <img src="assets/images/marielle.jpg" class="friends-img">
              <p>Marielle Festejo</p>
            </div>
            <div class="col-md-4">
              <img src="assets/images/jorgie.jpg" class="friends-img">
              <p>Jorgie Mae Jamison</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container findpeople">
        <h3>Find Other People</h3>
        <form method="post" action="">
          <div class="input-group rounded">
            <input type="search" name="search" class="form-control rounded" placeholder="User ID or User Name" aria-label="Search" aria-describedby="search-addon" />
            <span class="input-group-text border-1" id="search-addon">
              <i class="fa fa-user-plus"></i>
            </span>
            <button type="submit" class="btn btn-primary">Search</button> <!-- Retained button -->
          </div>
        </form>
        <div class="search-results">
          <?php if (!empty($searchResults)): ?>
            <h4>Search Results:</h4>
            <ul style="list-style-type: none; padding: 0;">
              <?php foreach ($searchResults as $user): ?>
                <li style="margin-bottom: 10px;">
                  <div class="profile">
                    <a href="profile.php?id=<?php echo htmlspecialchars($user['id']); ?>" style="text-decoration: none; color: inherit;"> <!-- Link to the user's profile -->
                      <img src="<?php echo htmlspecialchars($user['profilepic'] ?: 'uploads/profile/default_profile_pic.jpg'); ?>" alt="Profile Picture" class="profile-img" style="width: 50px; height: 50px; border-radius: 50%;">
                      <div class="user-info" style="display: inline-block; margin-left: 10px;">
                        <strong><?php echo htmlspecialchars($user['username']); ?></strong><br>
                        <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name']); ?>
                      </div>
                    </a>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <?php if (isset($_POST['search'])): ?>
              <p>No results found.</p> <!-- Message only shown if search was attempted -->
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>



    <div class="container rightside">
      <div class="post-card-container">
        <?php if (!empty($tours)): ?>
          <?php foreach ($tours as $tour): ?>
            <div class="post-card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <div class="profile d-flex align-items-center">
                  <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile Picture" class="profile-img" style="width: 50px; height: 50px; border-radius: 50%;">
                  <div class="host-info ms-2">
                    <h4><?php echo htmlspecialchars($tour['host_name']); ?></h4>
                    <p>Travel Host</p>
                  </div>
                </div>
                <div class="date">
                  <?php echo date('F j, Y', strtotime($tour['date'])); ?>
                </div>
              </div>

              <div class="card-image position-relative">
                <img src="<?php echo htmlspecialchars($tour['image']); ?>" alt="Posted Image" class="img-fluid">
                <div class="carousel-controls">
                  <button class="prev-btn">⟨</button>
                  <button class="next-btn">⟩</button>
                </div>
                <div class="people-count">06/10</div>
              </div>

              <div class="card-content">
                <h3><?php echo htmlspecialchars($tour['title']); ?></h3>
                <p><?php echo htmlspecialchars($tour['description']); ?></p>
                <div class="tour-action">
                  <button class="info-btn">i</button>
                  <button class="join-btn">Join the Tour</button>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No tours available.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
  </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="messageModalLabel">Send a Message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="chat-container">
            <div class="messages">
              <!-- Example Message -->
              <div class="message">
                <strong>Aron Jeric Cao:</strong>
                <p>Hello! How are you?</p>
              </div>
              <!-- You can dynamically add more messages here -->
            </div>
            <div class="message-input">
              <textarea class="form-control" rows="3" placeholder="Type your message..."></textarea>
              <button class="btn btn-primary mt-2">Send</button>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Send Message</button>
        </div>
      </div>
    </div>
  </div>


  <script src="ageneral.js"></script>
  <?php
  include('footer.html');
  ?>
  <script>
    document.querySelector('.btn-primary').addEventListener('click', function() {
      let message = document.querySelector('textarea').value;

      if (message.trim() !== '') {
        // Send message via AJAX
        fetch('send_message.php', {
          method: 'POST',
          body: JSON.stringify({
            message: message
          }),
          headers: {
            'Content-Type': 'application/json'
          }
        }).then(response => response.json()).then(data => {
          if (data.success) {
            // Append the message to the modal
            let newMessage = document.createElement('div');
            newMessage.classList.add('message');
            newMessage.innerHTML = `<strong>You:</strong><p>${message}</p>`;
            document.querySelector('.messages').appendChild(newMessage);
          }
        });
      }
    });
  </script>
</body>

</html>