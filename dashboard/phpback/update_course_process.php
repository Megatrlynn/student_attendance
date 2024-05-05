<?php
include 'dbconn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['course_id'])) {
    $course_id = $_POST['course_id'];

    $course_name = $_POST['course_name'];
    $institution_id = $_POST['institution_id'];
    $course_code = $_POST['course_code'];

    $stmt_update_courses = $pdo->prepare("UPDATE courses SET course_name = :course_name, institution_id = :institution_id, course_code = :course_code WHERE id = :course_id");
    $stmt_update_courses->execute(['course_name' => $course_name, 'institution_id' => $institution_id, 'course_code' => $course_code, 'course_id' => $course_id]);

    header("Location: ../view4.php?update_success=1");
    exit;
} else {
    header("Location: ../view4.php?error=1");
    exit;
}
?>
