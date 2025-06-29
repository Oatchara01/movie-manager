<?php
$servername = "db";
$username = "student";
$password = "studentpass";
$dbname = "student_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}
echo "<h2>เชื่อมต่อฐานข้อมูลสำเร็จ!</h2>";
$conn->close();
?>
