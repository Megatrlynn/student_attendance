<?php
include 'dbconn.php';
if (isset($_POST['course_id'])) {
    $course_id = $_POST['course_id'];

    $stmt_delete_course = $pdo->prepare("DELETE FROM courses WHERE id = :course_id");
    $stmt_delete_course->execute(['course_id' => $course_id]);

    header("Location: ../view4.php");
    exit;
} else {
    header("Location: ../view4.php");
    exit;
}
?>
