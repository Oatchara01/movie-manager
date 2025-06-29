<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>เข้าสู่ระบบ</title>
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
    .login-container {
      background-color: white;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      width: 320px;
    }
    h2 {
      text-align: center;
      color: #333;
    }
    label {
      display: block;
      margin-bottom: 6px;
      color: #555;
    }
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 18px;
      border: 1px solid #ccc;
      border-radius: 8px;
      transition: border 0.3s;
    }
    input[type="text"]:focus, input[type="password"]:focus {
      border-color: #4b80f9;
      outline: none;
    }
    input[type="submit"] {
      width: 100%;
      background-color: #4b80f9;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
    }
    input[type="submit"]:hover {
      background-color: #375fcb;
    }
    .error {
      color: red;
      text-align: center;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>เข้าสู่ระบบ</h2>

    <?php if (isset($_GET['error'])): ?>
      <div class="error">ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง</div>
    <?php endif; ?>

    <form method="POST" action="check_login.php">
      <label for="username">ชื่อผู้ใช้:</label>
      <input type="text" name="username" id="username" required>

      <label for="password">รหัสผ่าน:</label>
      <input type="password" name="password" id="password" required>

      <input type="submit" value="เข้าสู่ระบบ">
    </form>
  </div>
</body>
</html>
