<?php

// nestrada / nav verificeesana


include("database.php");

$code = $_GET['code'] ?? '';
$email = $_GET['email'] ?? '';

if (!$code || !$email) {
    echo "Invalid verification link.";
    exit;
}

// Normalize email
$email = strtolower(trim($email));

// Check if user exists with this code
$stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ? AND verification_code = ?");
mysqli_stmt_bind_param($stmt, "ss", $email, $code);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) === 1) {
    // User found, update verification status
    mysqli_stmt_close($stmt);

    $update_stmt = mysqli_prepare($conn, "UPDATE users SET email_verified_at = NOW(), verification_code = NULL WHERE email = ?");
    mysqli_stmt_bind_param($update_stmt, "s", $email);

    if (mysqli_stmt_execute($update_stmt)) {
        echo " Email verified successfully! You can now log in.";
    } else {
        echo "Error updating verification status.";
    }

    mysqli_stmt_close($update_stmt);
} else {
    echo " Invalid or expired verification link.";
}

mysqli_close($conn);
?>
