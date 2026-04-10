<?php
// update_user.php
session_start();
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch user data
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "User not found.";
        exit;
    }
}

// Handle form submission for updating user
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
    $userId = $_GET['id'];
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));

    // Update user in the database
    $stmt = $pdo->prepare("UPDATE users SET username = :username, email = :email, phone = :phone WHERE id = :id");
    $stmt->execute(['username' => $username, 'email' => $email, 'phone' => $phone, 'id' => $userId]);

    // Redirect back to the user table after update
    header("Location: users_table.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update User</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS -->

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #111;
            /* Black background */
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background-color: #fff;
            /* White background for form container */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #ff6600;
            /* Orange color */
            font-size: 30px;
        }

        form {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            /* Dark text for labels */
        }

        input,
        select {
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f4f4f4;
            /* Light gray input background */
            color: #333;
            width: 100%;
        }

        input[type="number"],
        input[type="date"] {
            -moz-appearance: textfield;
            appearance: textfield;
        }

        select {
            background-color: #f4f4f4;
        }

        .btn {
            padding: 12px 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            width: 48%;
            /* Slightly smaller buttons for better layout */
        }

        .btn-update {
            background-color: #ff6600;
            /* Orange */
            color: white;
        }

        .btn-update:hover {
            background-color: #e65c00;
            /* Darker shade on hover */
        }

        .btn-delete {
            background-color: #dc3545;
            /* Red */
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
            /* Darker shade on hover */
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group input,
        .form-group select {
            margin-bottom: 15px;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            /* Place buttons on opposite sides */
            gap: 10px;
            margin-top: 20px;
        }

        .form-footer a {
            display: inline-block;
            text-align: center;
            padding: 12px 18px;
            border-radius: 4px;
            background-color: #e1e1e1;
            /* Light gray */
            color: #333;
            text-decoration: none;
            width: 48%;
            /* Adjust button width to fit in the same row */
        }

        .form-footer a:hover {
            background-color: #ccc;
            /* Slightly darker gray on hover */
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Update User</h2>
        <form action="update_user.php?id=<?php echo htmlspecialchars($user['id']); ?>" method="POST">

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-update">Update</button>
                <a href="partnermodule.php" class="btn btn-delete">Cancel</a>
            </div>
        </form>
    </div>

</body>

</html>