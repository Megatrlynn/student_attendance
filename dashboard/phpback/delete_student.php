<?php
include 'dbconn.php';
if (isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    $stmt_get_user_id = $pdo->prepare("SELECT users_id FROM students WHERE id = :student_id");
    $stmt_get_user_id->execute(['student_id' => $student_id]);
    $user_id = $stmt_get_user_id->fetchColumn();

    $stmt_delete_student = $pdo->prepare("DELETE FROM students WHERE id = :student_id");
    $stmt_delete_student->execute(['student_id' => $student_id]);

    if ($user_id) {
        $stmt_delete_user = $pdo->prepare("DELETE FROM users WHERE id = :user_id");
        $stmt_delete_user->execute(['user_id' => $user_id]);
    }

    header("Location: ../view3.php");
    exit;
} else {
    header("Location: ../view3.php");
    exit;
}
?>
