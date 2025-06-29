<?php
session_start();        // เรียกใช้ session
session_destroy();      // ล้าง session ทั้งหมด

// กลับไปหน้า login
header("Location: login.php");
exit();
