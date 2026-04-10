<?php
// delete_person.php
session_start();
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $userId = $_POST['id'];

    // Delete user from the database
    $stmt = $pdo->prepare("DELETE FROM user_profiles WHERE user_id = :id");
    $stmt->execute(['id' => $userId]);

    // Redirect back to the personal information table after deletion
    header("Location: personal_info_table.php");
    exit;
}
