<?php
include 'dbconn.php';
if (isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    $stmt_fetch_student = $pdo->prepare("SELECT * FROM students WHERE id = :student_id");
    $stmt_fetch_student->execute(['student_id' => $student_id]);
    $student = $stmt_fetch_student->fetch(PDO::FETCH_ASSOC);

    $stmt_fetch_user = $pdo->prepare("SELECT username, password FROM users WHERE id = (SELECT users_id FROM students WHERE id = :student_id)");
    $stmt_fetch_user->execute(['student_id' => $student['id']]);
    $user = $stmt_fetch_user->fetch(PDO::FETCH_ASSOC);

    if ($student && $user) {
        
    } else {
        echo "student not found";
    }
} else {
    echo "student ID not provided";
}
?>