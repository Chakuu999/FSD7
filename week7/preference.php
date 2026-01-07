<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['theme'])) {
    $theme_value = $_POST['theme'];
    setcookie('theme', $theme_value, time() + 86400 * 30, "/");
    $_COOKIE['theme'] = $theme_value;
}

$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : "light";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Preferences - Student Grade Portal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="<?php echo $theme; ?>">
    <div class="container">
        <h2>Preferences</h2>
        <span class="theme-badge">Current: <?php echo ucfirst($theme); ?> Mode</span>
        
        <form method="POST" action="">
            <div class="theme-options">
                <label class="theme-option <?php echo ($theme == "light") ? "selected" : ""; ?>">
                    <input type="radio" name="theme" value="light" <?php echo ($theme == "light") ? "checked" : ""; ?>>
                    ☀️ Light Mode
                </label>
                <label class="theme-option <?php echo ($theme == "dark") ? "selected" : ""; ?>">
                    <input type="radio" name="theme" value="dark" <?php echo ($theme == "dark") ? "checked" : ""; ?>>
                    🌙 Dark Mode
                </label>
            </div>
            <button type="submit">Save Preference</button>
        </form>
        
        <a href="dashboard.php" class="back-link">Back to Dashboard</a>
    </div>
    
    <script>
        const themeRadios = document.querySelectorAll('input[name="theme"]');
        const body = document.body;
        const themeBadge = document.querySelector('.theme-badge');
        const themeOptions = document.querySelectorAll('.theme-option');
        
        themeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                body.classList.remove('light', 'dark');
                body.classList.add(this.value);
                
                themeBadge.textContent = '🎨 Current: ' + (this.value.charAt(0).toUpperCase() + this.value.slice(1)) + ' Mode';
                
                themeOptions.forEach(option => {
                    option.classList.remove('selected');
                });
                this.closest('.theme-option').classList.add('selected');
            });
        });
    </script>
</body>
</html>
