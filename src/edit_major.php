<?php
$conn = new mysqli("db", "student", "studentpass", "student_db");

if (!isset($_GET['id'])) {
    echo "ไม่พบรหัสภาพยนตร์"; exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM movies WHERE id = $id";
$result = $conn->query($sql);
$movie = $result->fetch_assoc();

if (!$movie) {
    echo "ไม่พบข้อมูลภาพยนตร์"; exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูลภาพยนตร์</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 40px;
        }
        h2 {
            color: #333;
        }
        form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        img {
            margin-top: 10px;
            max-height: 150px;
            border: 1px solid #ddd;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <h2>แก้ไขข้อมูลภาพยนตร์</h2>

    <form action="update_major.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $movie['id'] ?>">

        <label>ชื่อเรื่อง</label>
        <input type="text" name="title" value="<?= htmlspecialchars($movie['title']) ?>" required>

        <label>ปีที่ฉาย</label>
        <input type="number" name="year" value="<?= $movie['release_year'] ?>" required>

        <label>คะแนน IMDB</label>
        <input type="text" name="imdb" value="<?= $movie['imdb_score'] ?>" required>

        <label>คะแนน Rotten Tomatoes</label>
        <input type="text" name="rt" value="<?= $movie['rt_score'] ?>" required>

        <label>โปสเตอร์เดิม</label><br>
        <?php if (!empty($movie['poster'])): ?>
            <img src="posters/<?= $movie['poster'] ?>" alt="โปสเตอร์เดิม">
        <?php else: ?>
            <p>ไม่มีโปสเตอร์</p>
        <?php endif; ?>

        <label>อัปโหลดโปสเตอร์ใหม่ (ไม่เลือก = ใช้ของเดิม)</label>
        <input type="file" name="poster">

        <button type="submit">บันทึกการแก้ไข</button>
    </form>
</body>
</html>
