<?php
include 'dbconn.php';

if (isset($_POST['institution_id'])) {
    $institution_id = $_POST['institution_id'];

    $stmt_check_courses = $pdo->prepare("SELECT COUNT(*) FROM courses WHERE institution_id = ?");
    $stmt_check_courses->execute([$institution_id]);
    $course_count = $stmt_check_courses->fetchColumn();

    if ($course_count > 0) {
        echo "<script>alert('There are associated courses with this institution. Please delete the courses first.'); window.location.href = '../view1.php';</script>";
    } else {
        $stmt_delete_institution = $pdo->prepare("DELETE FROM institution WHERE id = ?");
        $stmt_delete_institution->execute([$institution_id]);

        header("Location: ../view1.php");
        exit;
    }
} else {
    header("Location: ../view1.php");
    exit;
}
?>
