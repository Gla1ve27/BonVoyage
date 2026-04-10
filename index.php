<?php

/**
 * BondVoyage Entry Point
 */
session_start();

// Determine where to send the user
if (isset($_SESSION['user_id'])) {
    header("Location: landing.php");
} else {
    header("Location: landing.php"); // Or login.php if you want them to log in first
}
exit();
