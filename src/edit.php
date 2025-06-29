<?php
session_start();
if (!isset($_SESSION['logged_in'])) { header("Location: login.php"); exit(); }

$conn = new mysqli("db", "student", "studentpass", "student_db");
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM students WHERE id=$id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>แก้ไขข้อมูลนักศึกษา</title>
  <style> <?php include "style.css"; ?> </style>
</head>
<body>
  <div class="container">
    <h2>แก้ไขข้อมูลนักศึกษา</h2>
    <form method="POST" action="update.php" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $row['id'] ?>">

      <label>รหัสนักศึกษา:</label>
      <input type="text" name="student_id" value="<?= $row['student_id'] ?>" required>

      <label>ชื่อ:</label>
      <input type="text" name="firstname" value="<?= $row['firstname'] ?>" required>

      <label>นามสกุล:</label>
      <input type="text" name="lastname" value="<?= $row['lastname'] ?>" required>

      <label>ชื่อเล่น:</label>
      <input type="text" name="nickname" value="<?= $row['nickname'] ?>" required>

      <label>เปลี่ยนรูปใหม่ (ถ้ามี):</label>
      <input type="file" name="photo">
      <?php if ($row["photo"]): ?>
        <img src="uploads/<?= $row["photo"] ?>" class="photo">
      <?php endif; ?>

      <input type="submit" value="บันทึกการแก้ไข">
    </form>
    <br>
    <a href="list.php">← กลับหน้ารายการ</a>
  </div>
</body>
</html>

