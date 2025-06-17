<?php
include '../db.php';

$class_id = $_POST['class_id'] ?? null;
$name = $_POST['trainee_name'] ?? '';
$email = $_POST['trainee_email'] ?? '';

if ($class_id && $name) {
    $stmt = $conn->prepare("INSERT INTO class_registrations (class_id, trainee_name, trainee_email) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $class_id, $name, $email);

    if ($stmt->execute()) {
        echo "You’ve been registered!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Missing class ID or name.";
}

$conn->close();
?>
