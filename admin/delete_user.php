<?php
// delete_user.php
session_start();
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $userId = $_POST['id'];

    // Delete user from the database
    $stmt = $pdo->prepare("DELETE FROM user_accounts WHERE id = :id");
    $stmt->execute(['id' => $userId]);

    // Redirect back to the user table after deletion
    header("Location: partnerModule.php");
    exit;
}
