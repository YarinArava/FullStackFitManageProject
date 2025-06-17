<?php
include '../db.php'; // connect to db in root

// Collect data from form (make sure form uses these name attributes)
$username       = $_POST['username'] ?? '';
$fullName       = $_POST['fullName'] ?? '';
$email          = $_POST['email'] ?? '';
$password       = $_POST['password'] ?? '';
$website        = $_POST['website'] ?? '';
$phone          = $_POST['phone'] ?? '';
$age            = $_POST['age'] ?? '';
$gender         = $_POST['gender'] ?? '';
$role           = $_POST['role'] ?? '';
$fitnessLevel   = $_POST['fitnessLevel'] ?? '';
$favColor       = $_POST['favColor'] ?? '';
$birthDate      = $_POST['birthDate'] ?? '';
$preferredTime  = $_POST['preferredTime'] ?? '';
$country        = $_POST['country'] ?? '';
// Upload profilePic (optional)
$profilePic = '';
$bio            = $_POST['bio'] ?? '';


if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] === UPLOAD_ERR_OK) {
    $targetDir = "../uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir);
    }
    $filename = time() . "_" . basename($_FILES["profilePic"]["name"]);
    $targetPath = $targetDir . $filename;
    if (move_uploaded_file($_FILES["profilePic"]["tmp_name"], $targetPath)) {
        $profilePic = $targetPath;
    }
}

// Prepare SQL
$sql = "INSERT INTO users (
    username, fullName, email, password, website, phone, age, gender,
    role, fitnessLevel, favColor, birthDate, preferredTime, country, bio, profilePic
) VALUES (
    '$username', '$fullName', '$email', '$password', '$website', '$phone', '$age', '$gender',
    '$role', '$fitnessLevel', '$favColor', '$birthDate', '$preferredTime', '$country', '$bio', '$profilePic'
)";

// Run query
if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>