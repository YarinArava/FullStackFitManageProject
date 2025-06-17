<?php
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"];
    $instructor = $_POST["instructor"];
    $max_trainees = $_POST["max_trainees"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $location = $_POST["location"];
    $level = $_POST["level"];
    $description = $_POST["description"];

    $stmt = $conn->prepare("INSERT INTO classes (title, instructor, max_trainees, date, time, location, level, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisssss", $title, $instructor, $max_trainees, $date, $time, $location, $level, $description);

    if ($stmt->execute()) {
        echo "Class created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
