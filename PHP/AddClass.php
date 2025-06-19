<?php
include("../db.php");

// Fetch trainers from the users table
$result = mysqli_query($conn, "SELECT username FROM users WHERE role = 'Trainer' AND status = 'Active'");
$instructors = [];
while ($row = mysqli_fetch_assoc($result)) {
    $instructors[] = $row['username'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trainer Dashboard</title>
    <link rel="stylesheet" href="../FitManage_CSS.css">
    <link rel="stylesheet" href="../CSS/AddClass.css">
</head>
<body>
    <header>
        <div class="header-background4"></div>
        <h2 class="main-title">Trainer Dashboard</h2>
        <img src="../images/FitManageLogo.jpg" alt="Site Logo">
    </header>

    <nav>
        <a href="../index.html">Home Page</a>
        <a href="../HrefPages/Register.html">Register here</a>
        <a href="classSchedule.php">Class Schedule</a>
        <a href="TraineeDashboard.php">Trainee Dashboard</a> 
        <a href="adminPanel.php">Admin Panel</a>
        <a href="../HrefPages/AboutUs.html">About Us</a>
    </nav>

    <main class="register-container">
        <form method="POST" action="add_class.php">
            <input type="text" name="title" placeholder="Class Title" required />
            
            <!-- Dynamic dropdown from trainers -->
            <select name="instructor" required>
                <option value="">-- Select Instructor --</option>
                <?php foreach ($instructors as $trainer): ?>
                    <option value="<?= htmlspecialchars($trainer) ?>">
                        <?= htmlspecialchars($trainer) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="number" name="max_trainees" placeholder="Max Trainees" required />
            <input type="date" name="date" required />
            <label for="time">Time:</label>
            
            <select name="time" required> <!-- time restricted to the open of the gym: 8:00 or 10:00 or 17:00 -->
            <option value="">-- Select Time --</option>
            <option value="08:00:00">08:00</option>
            <option value="10:00:00">10:00</option>
            <option value="17:00:00">17:00</option>
            </select>

            <input type="text" name="location" placeholder="Location" />
            <select name="level">
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>

            <textarea name="description" placeholder="Class Description..."></textarea>
            <button type="submit">Create Class</button>
        </form>
    </main>
</body>
</html>
