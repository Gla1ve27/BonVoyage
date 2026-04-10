<?php

/**
 * Global utility functions for BondVoyage
 */

/**
 * Cleanly handle file uploads with validation
 */
function uploadFile($file, $targetDir, $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'])
{
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return ['status' => false, 'message' => 'No file uploaded or upload error.'];
    }

    $fileName = basename($file['name']);
    $fileSize = $file['size'];
    $fileTmp = $file['tmp_name'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validate extension
    if (!in_array($fileExt, $allowedExtensions)) {
        return ['status' => false, 'message' => 'Invalid file type. Allowed: ' . implode(', ', $allowedExtensions)];
    }

    // Validate size (e.g., 5MB max)
    if ($fileSize > 5 * 1024 * 1024) {
        return ['status' => false, 'message' => 'File too large (Max 5MB).'];
    }

    // Create directory if not exists
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Unique file name to prevent overwriting
    $newFileName = uniqid('bv_', true) . '.' . $fileExt;
    $targetPath = $targetDir . $newFileName;

    if (move_uploaded_file($fileTmp, $targetPath)) {
        return ['status' => true, 'path' => $targetPath];
    }

    return ['status' => false, 'message' => 'Failed to move uploaded file.'];
}

/**
 * Sanitize output
 */
function h($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
