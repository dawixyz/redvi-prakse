<?php
session_start();
include('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: index.php?error=" . urlencode("Lūdzu ievadi e-pastu un paroli."));
        exit();
    }

    $stmt = mysqli_prepare($conn, "SELECT id, first_name, last_name, password, is_admin FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $id, $first_name, $last_name, $hashed_password, $is_admin);
        mysqli_stmt_fetch($stmt);

     if (password_verify($password, $hashed_password)) {
    $_SESSION['user_id'] = $id;
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['is_admin'] = $is_admin;

    if ($is_admin == 1) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
}

    } else {
        header("Location: index.php");
        exit;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
