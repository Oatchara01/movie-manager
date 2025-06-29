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

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

// รับค่าจากฟอร์ม
$id = $_POST['id'];
$student_id = $_POST['student_id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$nickname = $_POST['nickname'];

$photo_update = "";

if (!empty($_FILES['photo']['name'])) {
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $photo_name = uniqid() . "_" . basename($_FILES["photo"]["name"]);
    $target_file = $target_dir . $photo_name;
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
    $photo_update = ", photo='$photo_name'";
}

// อัปเดตข้อมูล
$sql = "UPDATE students 
        SET student_id='$student_id',
            firstname='$firstname',
            lastname='$lastname',
            nickname='$nickname'
            $photo_update
        WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: list.php");
    exit();
} else {
    echo "เกิดข้อผิดพลาด: " . $conn->error;
}

$conn->close();
?>
