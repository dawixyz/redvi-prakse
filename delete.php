<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: index.php");
    exit;
}

include "database.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Deleted Successfully<br>";
        echo "<a href='admin_dashboard.php'>Back to admin dashboard</a>";
    } else {
        echo "ERROR: Could not delete record.";
    }

    $stmt->close();
} else {
    echo "Invalid ID.";
}

 header("Location: admin_dashboard.php");

$conn->close();
?>
