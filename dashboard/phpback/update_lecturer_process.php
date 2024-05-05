<?php
include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['lecturer_id'])) {
    $lecturer_id = $_POST['lecturer_id'];

    $name = $_POST['name'];
    $institution_id = $_POST['institution_id'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt_update_lecturer = $pdo->prepare("UPDATE lecturers SET name = :name, institution_id = :institution_id, phone = :phone, email = :email WHERE id = :lecturer_id");
    $stmt_update_lecturer->execute(['name' => $name, 'institution_id' => $institution_id, 'phone' => $phone, 'email' => $email, 'lecturer_id' => $lecturer_id]);

    $stmt_update_user = $pdo->prepare("UPDATE users SET username = :username, password = :password WHERE id = (SELECT users_id FROM lecturers WHERE id = :lecturer_id)");
    $stmt_update_user->execute(['username' => $username, 'password' => $hashed_password, 'lecturer_id' => $lecturer_id]);

    header("Location: ../view2.php?update_success=1");
    exit;
} else {
    header("Location: ../view2.php?error=1");
    exit;
}
?>
