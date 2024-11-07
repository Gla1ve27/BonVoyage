<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bonvoyage";

try {
    $pdo = new PDO("mysql:servername=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>