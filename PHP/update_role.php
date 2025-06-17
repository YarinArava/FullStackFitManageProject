<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_POST['user_id'] ?? null;
    $new_role = $_POST['new_role'] ?? null;

    if ($user_id && $new_role) {
        $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->bind_param("si", $new_role, $user_id);
        $stmt->execute();
    }

    header("Location: adminPanel.php");
    exit;
}
?>
