<?php
if (isset($_POST['course_id'])) {
    $course_id = $_POST['course_id'];

    $stmt_fetch_course = $pdo->prepare("SELECT * FROM courses WHERE id = :course_id");
    $stmt_fetch_course->execute(['course_id' => $course_id]);
    $course = $stmt_fetch_course->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Course not found";
}
?>