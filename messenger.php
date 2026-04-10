<?php
require('includes/db.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$current_user_id = $_SESSION['user_id'];

// Fetch current user details
$stmt = $pdo->prepare("SELECT first_name, last_name, profile_pic_path FROM user_profiles WHERE user_id = ?");
$stmt->bindParam(1, $current_user_id);
$stmt->execute();
$currentUser = $stmt->fetch(PDO::FETCH_ASSOC);

if ($currentUser) {
    $current_name = htmlspecialchars($currentUser['first_name'] . ' ' . $currentUser['last_name']);
    $current_profile_pic = htmlspecialchars($currentUser['profile_pic_path'] ?: 'uploads/profile/default_profile_pic.jpg');
} else {
    $current_name = 'Unknown User';
    $current_profile_pic = 'uploads/profile/default_profile_pic.jpg';
}

// Get the selected recipient ID from the URL
$receiver_id = isset($_GET['receiver_id']) ? intval($_GET['receiver_id']) : null;

// Fetch the recipient's details
if ($receiver_id) {
    $stmt = $pdo->prepare("SELECT first_name, last_name, profile_pic_path, age, birthday FROM user_profiles WHERE user_id = ?");
    $stmt->bindParam(1, $receiver_id);
    $stmt->execute();
    $recipient = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($recipient) {
        $recipient_name = htmlspecialchars($recipient['first_name'] . ' ' . $recipient['last_name']);
        $recipient_profile_pic = htmlspecialchars($recipient['profile_pic_path'] ?: 'uploads/profile/default_profile_pic.jpg');
        $recipient_age = htmlspecialchars($recipient['age']);
        $recipient_birthday = htmlspecialchars($recipient['birthday']);
    } else {
        $recipient_name = 'Unknown User';
        $recipient_profile_pic = 'uploads/profile/default_profile_pic.jpg';
        $recipient_age = 'N/A';
        $recipient_birthday = 'N/A';
    }
}

// Handle message sending
if (isset($_POST['send'])) {
    $message = trim($_POST['message']);

    if (!empty($message) && !empty($receiver_id)) {
        $sql = "INSERT INTO messenger(sender_id, receiver_id, message) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$current_user_id, $receiver_id, $message])) {
            header("Location: messenger.php?receiver_id=" . $receiver_id);
            exit();
        } else {
            echo "Error sending message.";
        }
    }
}

// Fetch messages for the selected recipient
$messages = [];
if ($receiver_id) {
    $sql1 = "SELECT m.message, m.created_at, m.sender_id 
             FROM messenger m 
             WHERE (m.sender_id = ? AND m.receiver_id = ?) OR (m.sender_id = ? AND m.receiver_id = ?)
             ORDER BY m.created_at ASC";
    $stmt = $pdo->prepare($sql1);
    $stmt->execute([$current_user_id, $receiver_id, $receiver_id, $current_user_id]);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// For each message, adjust the time from UTC to Manila time
foreach ($messages as &$message) {
    $created_at = new DateTime($message['created_at'], new DateTimeZone('UTC'));  // Assuming your database stores in UTC
    $created_at->setTimezone(new DateTimeZone('Asia/Manila'));  // Convert to Manila Time

    // Format the message time in a readable format
    $message['time'] = $created_at->format('F j, Y, g:i a');  // You can modify this format to your liking
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat App</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="messenger.css">
</head>

<body>
    <div id="container">
        <div>
            <img src="<?php echo $recipient_profile_pic; ?>" alt="Profile Picture">
            <label style="float: left; margin-left: 10px; margin-top: 27px; font-weight: bold;">
                <?php echo $recipient_name; ?>
            </label>
            <span id="info_icon" onclick="openModal()">
                <i class="material-icons">info</i>
            </span>
            <br><br><br>
            <hr>
        </div>
        <div id="chat">
            <?php
            if (!empty($messages)) {
                foreach ($messages as $row) {
                    $message_time = htmlspecialchars($row['time']);  // Display the converted time
                    if ($row['sender_id'] == $current_user_id) {
            ?>
                        <div id="chat_box_main1">
                            <div id="chat_box_message1">
                                <?php echo htmlspecialchars($row['message']); ?>
                            </div>
                            <div style="margin-left: 400px;">
                                <?php echo $message_time; ?>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div id="chat_box_main2">
                            <img style="margin-right: 10px;" src="<?php echo $recipient_profile_pic; ?>">
                            <div id="chat_box_message2">
                                <?php echo htmlspecialchars($row['message']); ?>
                            </div>
                            <div style="margin-left: 120px;">
                                <?php echo $message_time; ?>
                            </div>
                        </div>
            <?php
                    }
                }
            }
            ?>
        </div>
        <div id="message">
            <form action="messenger.php?receiver_id=<?php echo $receiver_id; ?>" method="POST">
                <input type="hidden" name="receiver_id" value="<?php echo $receiver_id; ?>">
                <input id="message_box" type="text" name="message" placeholder="Write message" required>
                <button id="send_icon" type="submit" name="send" style="background: none; border: none;">
                    <img style="width: 70px; height: 57px;" src="send.png" alt="Send">
                </button>
            </form>
        </div>
    </div>

    <!-- Modal for displaying user info -->
    <div id="modal">
        <div id="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>User Information</h2>
            <img src="<?php echo $recipient_profile_pic; ?>" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
            <p><strong>Name:</strong> <?php echo $recipient_name; ?></p>
            <p><strong>Age:</strong> <?php echo $recipient_age; ?></p>
            <p><strong>Birthday:</strong> <?php echo $recipient_birthday; ?></p>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById("modal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("modal").style.display = "none";
        }

        // Close the modal if the user clicks anywhere outside of it
        window.onclick = function(event) {
            if (event.target == document.getElementById("modal")) {
                closeModal();
            }
        }
    </script>
</body>

</html>