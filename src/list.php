<?php
session_start();
if (!isset($_SESSION['logged_in'])) { header("Location: login.php"); exit(); }

$conn = new mysqli("db", "student", "studentpass", "student_db");
$result = $conn->query("SELECT * FROM students");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>รายชื่อนักศึกษา</title>
  <style>
    <?php include "style.css"; ?>
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      padding: 8px;
      border-bottom: 1px solid #ccc;
      text-align: center;
    }
  </style>
<script>
function confirmDelete(id) {
  if (confirm("คุณแน่ใจว่าต้องการลบข้อมูลนี้หรือไม่?")) {
    window.location.href = "delete.php?id=" + id;
  }
}
</script>

</head>
<body>
  <div class="container">
    <h2>ข้อมูลนักศึกษา</h2>
    <table>
      <tr>
        <th>รูป</th>
        <th>รหัส</th>
        <th>ชื่อ</th>
        <th>นามสกุล</th>
        <th>ชื่อเล่น</th>
        <th>จัดการ</th>
        <th>ลบข้อมูล</th> 
   </tr>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td>
          <?php if ($row['photo']): ?>
            <img src="uploads/<?= $row['photo'] ?>" class="photo">
          <?php else: ?> - <?php endif; ?>
        </td>
        <td><?= $row['student_id'] ?></td>
        <td><?= $row['firstname'] ?></td>
        <td><?= $row['lastname'] ?></td>
        <td><?= $row['nickname'] ?></td>
        <td><a href="edit.php?id=<?= $row['id'] ?>">แก้ไข</a></td>
        <td><a href="javascript:void(0);" onclick="confirmDelete(<?= $row['id'] ?>)" style="color:red;">ลบ</a></td>  
      </tr>
      <?php endwhile; ?>
    </table>
    <br>
    <a href="main.php">← กลับหน้าหลัก</a>
  </div>
</body>
</html>

