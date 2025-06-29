<?php
ob_start(); // ป้องกัน header error หากมี warning
session_start();

// 🔐 ตรวจสอบ session
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

// 🔌 เชื่อมต่อฐานข้อมูล
$servername = "db";
$username = "student";
$password = "studentpass";
$dbname = "student_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

// 📥 รับข้อมูลจากฟอร์ม
$student_id = $_POST['student_id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$nickname = $_POST['nickname'];

// 🖼 จัดการอัปโหลดรูป
$photo_name = null;

if (!empty($_FILES['photo']['name'])) {
    $target_dir = "uploads/"; // โฟลเดอร์ที่อยู่ใน host แล้ว mount เข้ามา

    // ❗ ไม่ต้องสร้างโฟลเดอร์ผ่าน mkdir ใน container
    // ให้แน่ใจว่าใน host มีโฟลเดอร์ src/uploads และตั้ง chmod 777 แล้ว

    // 🔒 ปรับชื่อไฟล์ให้ปลอดภัย
    $original_name = basename($_FILES["photo"]["name"]);
    $safe_name = preg_replace('/[^A-Za-z0-9\.\-_]/', '_', $original_name);
    $photo_name = uniqid() . "_" . $safe_name;
    $target_file = $target_dir . $photo_name;

    // 📤 ย้ายไฟล์จาก temp ไปยัง uploads/
    if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        die("เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ");
    }
}

// 💾 เพิ่มข้อมูลลงตาราง
$sql = "INSERT INTO students (student_id, firstname, lastname, nickname, photo)
        VALUES ('$student_id', '$firstname', '$lastname', '$nickname', '$photo_name')";

if ($conn->query($sql) === TRUE) {
    header("Location: list.php");
    exit();
} else {
    echo "เกิดข้อผิดพลาด: " . $conn->error;
}

$conn->close();
?>
