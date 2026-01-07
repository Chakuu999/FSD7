<?php
require_once 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    $query = "INSERT INTO students (student_id, name, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $student_id, $name, $hashed_password);
    
    if (mysqli_stmt_execute($stmt)) {
        $message = "Registration successful!";
        header("refresh:2;url=login.php");
    } else {
        $message = "Registration failed: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}
?>

<?php
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : "light";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="<?php echo $theme; ?>">
    <div class="form-container">
        <h2>Student Registration</h2>
        
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="student_id">Student ID</label>
                <input type="text" id="student_id" name="student_id" required>
            </div>
            
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Register</button>
        </form>
        
        <div class="auth-link">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>
</body>
</html>
