<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

$servername = "db";
$username = "student";
$password = "studentpass";
$dbname = "student_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

$id = $_GET['id'];

// ค้นหารูปเดิมก่อนลบ
$photoResult = $conn->query("SELECT photo FROM students WHERE id=$id");
if ($photoResult->num_rows > 0) {
    $row = $photoResult->fetch_assoc();
    if ($row['photo']) {
        $filePath = "uploads/" . $row['photo'];
        if (file_exists($filePath)) {
            unlink($filePath); // ลบไฟล์รูป
        }
    }
}

// ลบข้อมูลจาก DB
$conn->query("DELETE FROM students WHERE id=$id");

$conn->close();
header("Location: list.php");
exit();
?>
