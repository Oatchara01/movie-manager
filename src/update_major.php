<?php
$conn = new mysqli("db", "student", "studentpass", "student_db");

$id     = intval($_POST['id']);
$title  = $_POST['title'];
$year   = $_POST['year'];
$imdb   = $_POST['imdb'];
$rt     = $_POST['rt'];
$poster = null;

// ถ้าอัปโหลดโปสเตอร์ใหม่
if (!empty($_FILES['poster']['name'])) {
    $target_dir = "posters/";
    $original_name = basename($_FILES["poster"]["name"]);
    $safe_name = preg_replace('/[^A-Za-z0-9\.\-_]/', '_', $original_name);
    $poster = uniqid() . "_" . $safe_name;
    $target_file = $target_dir . $poster;

    if (!move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file)) {
        die("เกิดข้อผิดพลาดในการอัปโหลดโปสเตอร์");
    }

    // update พร้อมโปสเตอร์ใหม่
    $stmt = $conn->prepare("UPDATE movies SET title=?, release_year=?, imdb_score=?, rt_score=?, poster=? WHERE id=?");
    $stmt->bind_param("sidssi", $title, $year, $imdb, $rt, $poster, $id);
} else {
    // update โดยไม่เปลี่ยนโปสเตอร์
    $stmt = $conn->prepare("UPDATE movies SET title=?, release_year=?, imdb_score=?, rt_score=? WHERE id=?");
    $stmt->bind_param("sidii", $title, $year, $imdb, $rt, $id);
}

$stmt->execute();
header("Location: list_major.php");
exit;
?>
