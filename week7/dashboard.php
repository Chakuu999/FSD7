<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : "light";

$student_name = $_SESSION['student_name'];
$student_id = $_SESSION['student_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Student Grade Portal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="<?php echo $theme; ?>">
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($student_name); ?>!</h2>
        
        <div class="student-info">
            <p><strong>Student ID:</strong> <?php echo htmlspecialchars($student_id); ?></p>
            <span class="theme-badge"><?php echo ucfirst($theme); ?> Mode</span>
        </div>
        
        <h3>Navigation</h3>
        <ul class="nav-list">
            <li><a href="dashboard.php" class="nav-link">Dashboard</a></li>
            <li><a href="preference.php" class="nav-link">Preferences</a></li>
            <li><a href="logout.php" class="nav-link logout-btn">Logout</a></li>
        </ul>
    </div>
</body>
</html>
