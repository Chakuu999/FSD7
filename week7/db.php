<?php
$host = "student.heraldcollege.edu.np";
$username = "np03cs4a240239";
$password = "ykclzpUO3J";
$database = "np03cs4a240239";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$create_table = "CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) UNIQUE NOT NULL,
    name VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
)";
mysqli_query($conn, $create_table);
?>
