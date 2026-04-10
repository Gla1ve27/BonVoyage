<?php
session_start();
require_once 'includes/db.php';

if (isset($_SESSION['user_id'])) {
    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];

    // Check if the user is an admin (admin_accounts table)
    $stmt = $pdo->prepare("SELECT * FROM admin_accounts WHERE employee_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);

    if ($stmt->rowCount() > 0) {
        // User is an admin, update admin_accounts table
        $update_stmt = $pdo->prepare("UPDATE admin_accounts SET online = 0 WHERE employee_id = :user_id");
        $update_stmt->bindParam(':user_id', $user_id);
        $update_stmt->execute();
    } else {
        // User is not an admin, check the user_accounts table
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
        $stmt->execute(['user_id' => $user_id]);

        if ($stmt->rowCount() > 0) {
            // User is a regular user, update user_accounts table
            $update_stmt = $pdo->prepare("UPDATE users SET online = 0 WHERE id = :user_id");
            $update_stmt->bindParam(':user_id', $user_id);
            $update_stmt->execute();
        }
    }

    // Destroy the session
    session_destroy();
}

// Redirect to login page after logout
header("Location: login.php");
exit;
