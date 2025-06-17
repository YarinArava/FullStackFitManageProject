<?php
include("../db.php");

// Approve or delete actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'] ?? null;
    if (isset($_POST['approve'])) {
        mysqli_query($conn, "UPDATE users SET status = 'Active' WHERE id = $user_id");
    } elseif (isset($_POST['delete'])) {
        mysqli_query($conn, "DELETE FROM users WHERE id = $user_id");
    }
}
// Handle role update
if (isset($_POST['change_role'])) {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['new_role'];
    mysqli_query($conn, "UPDATE users SET role = '$new_role' WHERE id = $user_id");
}

// Fetch all users, order by descending
$where = [];
if (!empty($_GET['filter_role'])) {
    $role = mysqli_real_escape_string($conn, $_GET['filter_role']);
    $where[] = "role = '$role'";
}
if (!empty($_GET['filter_status'])) {
    $status = mysqli_real_escape_string($conn, $_GET['filter_status']);
    $where[] = "status = '$status'";
}

$where_clause = $where ? 'WHERE ' . implode(' AND ', $where) : '';
$users = mysqli_query($conn, "SELECT * FROM users $where_clause ORDER BY id ASC");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../CSS/AdminPanelCSS.css" />
    <link rel="stylesheet" href="../FitManage_CSS.css" />
</head>

<body>
<header>
    <div class="header-background4"></div>
    <h1 class="main-title">Admin Panel</h1>
    <img src="../images/FitManageLogo.jpg" alt="Site Logo">
</header>

<nav>
    <a href="../index.html">Home Page</a> 
    <a href="../HrefPages/Register.html">Register here</a>
    <a href="classSchedule.php">Class Schedule</a>  
    <a href="TraineeDashboard.php">Trainee Dashboard</a>  
    <a href="AddClass.php">Trainer Dashboard</a>
    <a href="../HrefPages/AboutUs.html">About Us</a> 
</nav>

<main>
    <h2>Users Overview</h2>
    <form method="GET" style="margin-bottom: 20px;">
    <label for="filter_role">Filter by Role:</label>
    <select name="filter_role" id="filter_role">
        <option value="">-- All Roles --</option>
        <option value="Admin" <?= ($_GET['filter_role'] ?? '') === 'Admin' ? 'selected' : '' ?>>Admin</option>
        <option value="Trainer" <?= ($_GET['filter_role'] ?? '') === 'Trainer' ? 'selected' : '' ?>>Trainer</option>
        <option value="Trainee" <?= ($_GET['filter_role'] ?? '') === 'Trainee' ? 'selected' : '' ?>>Trainee</option>
    </select>

    <label for="filter_status">Filter by Status:</label>
    <select name="filter_status" id="filter_status">
        <option value="">-- All Statuses --</option>
        <option value="Active" <?= ($_GET['filter_status'] ?? '') === 'Active' ? 'selected' : '' ?>>Active</option>
        <option value="Pending" <?= ($_GET['filter_status'] ?? '') === 'Pending' ? 'selected' : '' ?>>Pending</option>
    </select>

    <button type="submit">Apply Filters</button>
    <a href="adminPanel.php" style="margin-left: 10px;">Reset</a>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = mysqli_fetch_assoc($users)): ?>
                <tr>
                    <td><?= $user['id'] ?></td> <!-- ID column stays as number -->

                    <td><?= htmlspecialchars($user['username']) ?></td>

                    <td> <!-- Move the form here for Role change -->
                        <form method="POST" action="adminPanel.php"> <!-- Post back to same page -->
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <select name="new_role" onchange="this.form.submit()">
                                <option value="Trainee" <?= $user['role'] === 'Trainee' ? 'selected' : '' ?>>Trainee</option>
                                <option value="Trainer" <?= $user['role'] === 'Trainer' ? 'selected' : '' ?>>Trainer</option>
                                <option value="Admin" <?= $user['role'] === 'Admin' ? 'selected' : '' ?>>Admin</option>
                            </select>
                            <input type="hidden" name="change_role" value="1" />
                        </form>
                    </td>

                    <td><?= $user['status'] ?></td>

                    <td>
                        <form method="POST" style="display:inline">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <?php if ($user['status'] === 'Pending'): ?>
                                <button class="action-btn" name="approve">Approve</button>
                            <?php endif; ?>
                            <button class="action-btn" name="delete" style="background-color:red">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<footer>
    <p>
        <img src="../images/FitManageLogo.jpg" alt="Small Logo" style="height: 40px; vertical-align: middle;" />
        Phone: (+972)52-123-4567 | Email: yahoo@fitmanage.com | Address: 23 Barzel St, Tel Aviv
    </p>
</footer>
</body>
</html>