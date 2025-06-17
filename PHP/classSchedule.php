<?php
include '../db.php';

$days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
$times = ['08:00', '10:00', '17:00'];

$schedule = [];
foreach ($days as $day) {
    foreach ($times as $time) {
        $schedule[$day][$time] = [];
    }
}

$query = "SELECT c.*, COUNT(r.id) as reg_count 
          FROM classes c 
          LEFT JOIN class_registrations r ON c.id = r.class_id 
          GROUP BY c.id";

$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $day = date('l', strtotime($row['date']));
    $time = substr($row['time'], 0, 5); // convert '03:20:00' → '03:20'

    // Only place if valid
    if (in_array($day, $days) && in_array($time, $times)) {
        $row['registered'] = $row['reg_count'];
        $schedule[$day][$time][] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Class Schedule - FitManage</title>
    <link rel="stylesheet" href="../FitManage_CSS.css"/>
    <link rel="stylesheet" href="../CSS/classScheduleCSS.css"/>
</head>
<body>
<header>
    <div class="header-background4"></div>
    <h1 class="main-title">Class Schedule</h1>
    <img src="../images/FitManageLogo.jpg" alt="Site Logo">
</header>

<nav>
    <a href="../index.html">Home</a>
    <a href="../HrefPages/Register.html">Register here</a>
    <a href="TraineeDashboard.php">Trainee Dashboard</a>
    <a href="AddClass.php">Trainer Dashboard</a>
    <a href="adminPanel.php">Admin Panel</a>
    <a href="../HrefPages/AboutUs.html">About Us</a>
</nav>

<main>
    <table>
        <thead>
            <tr>
                <th>Time</th>
                <?php foreach ($days as $day): ?>
                    <th><?= $day ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($times as $time): ?>
                <tr>
                    <td><?= $time ?></td>
                    <?php foreach ($days as $day): ?>
                        <td>
                            <?php foreach ($schedule[$day][$time] as $class): ?>
                                <b><?= htmlspecialchars($class['title']) ?></b> - <?= htmlspecialchars($class['instructor']) ?><br>
                                <small><?= htmlspecialchars($class['description']) ?></small><br>
                                <small>Level: <?= htmlspecialchars($class['level']) ?> | Location: <?= htmlspecialchars($class['location']) ?></small><br>
                                
                                <?php if ($class['registered'] < $class['max_trainees']): ?> <!-- Block the register if it already full-->
                                    <form method="POST" action="register_to_class.php">
                                        <input type="hidden" name="class_id" value="<?= $class['id'] ?>">
                                        <input type="text" name="trainee_name" placeholder="Your name" required>
                                        <input type="email" name="trainee_email" placeholder="Your email (optional)">
                                        <button type="submit">Register</button>
                                    </form>
                                <?php else: ?>
                                    <p style="color:red; font-weight:bold;">Class is full</p>
                                <?php endif; ?>

                                
                                <span><?= $class['registered'] ?>/<?= $class['max_trainees'] ?> participants</span>
                                <br><br>
                            <?php endforeach; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<footer>
    <p>Phone: (+972)52-123-4567 | Email: info@fitmanage.com</p>
</footer>
</body>
</html>
