<?php session_start(); if (!isset($_SESSION['logged_in'])) { header("Location: login.php"); exit(); } ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>เพิ่มข้อมูลนักศึกษา</title>
  <style>
    <?php include "style.css"; // ถ้าคุณแยกไฟล์ CSS แนะนำให้ใช้ ?>
  </style>
</head>
<body>
  <div class="container">
    <h2>เพิ่มข้อมูลนักศึกษา</h2>
    <form method="POST" action="insert.php" enctype="multipart/form-data">
      <label>รหัสนักศึกษา:</label>
      <input type="text" name="student_id" required>

      <label>ชื่อ:</label>
      <input type="text" name="firstname" required>

      <label>นามสกุล:</label>
      <input type="text" name="lastname" required>

      <label>ชื่อเล่น:</label>
      <input type="text" name="nickname" required>

      <label>อัปโหลดรูป:</label>
      <input type="file" name="photo">

      <input type="submit" value="บันทึกข้อมูล">
    </form>
    <br>
    <a href="main.php">← กลับหน้าหลัก</a>
  </div>
</body>
</html>

