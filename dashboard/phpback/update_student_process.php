<?php

include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    $name = $_POST['name'];
    $institution_id = $_POST['institution_id'];
    $reg_no = $_POST['reg_no'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt_update_student = $pdo->prepare("UPDATE students SET name = :name, institution_id = :institution_id, reg_no = :reg_no WHERE id = :student_id");
    $stmt_update_student->execute(['name' => $name, 'institution_id' => $institution_id, 'reg_no' => $reg_no, 'student_id' => $student_id]);

    $stmt_update_user = $pdo->prepare("UPDATE users SET username = :username, password = :password WHERE id = (SELECT users_id FROM students WHERE id = :student_id)");
    $stmt_update_user->execute(['username' => $username, 'password' => $hashed_password, 'student_id' => $student_id]);

    header("Location: ../view3.php?update_success=1");
    exit;
} else {
    header("Location: ../view3.php?error=1");
    exit;
}
?>
