<?php
// Database Configuration
$host = 'localhost';
$db_name = 'bonvoyage';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password);

    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Default fetch mode as associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // If database doesn't exist, maybe it's named differently? 
    // We'll try 'bonvoyage' if 'bondvoyage' fails, but for now we stop.
    die("Connection failed: " . $e->getMessage());
}
