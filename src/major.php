<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("db", "student", "studentpass", "student_db");
    $title = $_POST['title'];
    $year = $_POST['year'];
    $imdb = $_POST['imdb'];
    $rt = $_POST['rt'];

    $poster = null;

if (!empty($_FILES['poster']['name'])) {
    $target_dir = "posters/"; // โฟลเดอร์ที่อยู่ใน host แล้ว mount เข้ามา

$original_name = basename($_FILES["poster"]["name"]);
$safe_name = preg_replace('/[^A-Za-z0-9\.\-_]/', '_', $original_name);
$poster = uniqid() . "_" . $safe_name;
$target_file = $target_dir . $poster;

// 📤 ย้ายไฟล์จาก temp ไปยัง posters/
if (!move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file)) {
    die("เกิดข้อผิดพลาดในการอัปโหลดโปสเตอร์ภาพยนตร์");
}
}

    $stmt = $conn->prepare("INSERT INTO movies (title, release_year, imdb_score, rt_score, poster) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sidds", $title, $year, $imdb, $rt, $poster);
    $stmt->execute();
    header("Location: list_major.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>เพิ่มข้อมูลภาพยนตร์</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        form {
            background: #fff;
            padding: 20px;
            width: 400px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label, input, button {
            display: block;
            width: 100%;
            margin-bottom: 15px;
        }
        button {
            background-color: #4a90e2;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #357ab8;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #4a90e2;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <h2 style="text-align:center;">➕ เพิ่มข้อมูลภาพยนตร์</h2>
        <label>ชื่อเรื่อง:</label>
        <input type="text" name="title" required>

        <label>ปีที่ฉาย:</label>
        <input type="number" name="year" required>

        <label>คะแนน IMDB:</label>
        <input type="number" step="0.1" name="imdb" required>

        <label>คะแนน RT:</label>
        <input type="number" step="0.1" name="rt" required>

        <label>โปสเตอร์:</label>
        <input type="file" name="poster">

        <button type="submit">บันทึก</button>
        <a href="main.php" class="back-link">← กลับหน้าหลัก</a>
    </form>
</body>
</html>
