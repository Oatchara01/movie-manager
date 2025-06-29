<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>หน้าหลัก</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #b0d0ff, #e0c3fc);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .main-container {
      background-color: white;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      width: 360px;
      text-align: center;
    }
    h2 {
      color: #333;
      margin-bottom: 24px;
    }
    .menu-button {
      display: block;
      background-color: #4b80f9;
      color: white;
      padding: 12px;
      margin: 12px 0;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      text-decoration: none;
      transition: background-color 0.3s;
    }
    .menu-button:hover {
      background-color: #375fcb;
    }
    .logout {
      margin-top: 20px;
      font-size: 14px;
    }
    .logout a {
      color: #d70000;
      text-decoration: none;
    }
    .logout a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="main-container">
    <h2>ยินดีต้อนรับ, <?= $_SESSION['username'] ?></h2>

    <a class="menu-button" href="form.php">➕ เพิ่มข้อมูลนักศึกษา</a>
    <a class="menu-button" href="list.php">📋 ดูข้อมูลนักศึกษา</a>

    <a class="menu-button" href="major.php">➕ เพิ่มข้อมูลภาพยนต์</a>
    <a class="menu-button" href="list_major.php">📋 ดูข้อมูลภาพยนต์</a>


    <div class="logout">
      <a href="logout.php">ออกจากระบบ</a>
    </div>
  </div>
</body>
</html>

