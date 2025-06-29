<?php
if (isset($_GET['id'])) {
    $conn = new mysqli("db", "student", "studentpass", "student_db");
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM movies WHERE id = $id");
}
header("Location: list_major.php");
exit;
?>

