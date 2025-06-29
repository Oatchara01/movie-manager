<?php
session_start();

$servername = "db";
$username = "student";
$password = "studentpass";
$dbname = "student_db";

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

// รับค่าจากฟอร์ม
$user = $_POST['username'];
$pass = $_POST['password'];

// ตรวจสอบ username และ password
$sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $user;
header("Location: main.php");
    exit();
} else {
    header("Location: login.php?error=1");
    exit();
}

$conn->close();
?>
