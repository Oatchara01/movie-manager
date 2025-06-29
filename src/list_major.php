<?php
$conn = new mysqli("db", "student", "studentpass", "student_db");
$result = $conn->query("SELECT * FROM movies");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>รายการภาพยนตร์</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        th {
            background-color: #4a90e2;
            color: white;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }
        img {
            max-width: 100px;
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

<h2 style="text-align:center;">📋 รายการภาพยนตร์</h2>

<table>
    <tr>
        <th>โปสเตอร์</th>
        <th>ชื่อเรื่อง</th>
        <th>ปีที่ฉาย</th>
        <th>IMDB</th>
        <th>RT</th>
<th>จัดการ</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td>
            <?php if ($row['poster']): ?>
                <img src="posters/<?= htmlspecialchars($row['poster']) ?>">
            <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= $row['release_year'] ?></td>
        <td><?= $row['imdb_score'] ?></td>
        <td><?= $row['rt_score'] ?></td>
 <td>
                    <a class="button" href="edit_major.php?id=<?= $row['id'] ?>">แก้ไข</a>
                    <a class="button delete" href="delete_major.php?id=<?= $row['id'] ?>" onclick="return confirm('ยืนยันการลบ?')">ลบ</a>
                </td>   
 </tr>
    <?php endwhile; ?>
</table>

<a href="main.php" class="back-link">← กลับหน้าหลัก</a>

</body>
</html>
