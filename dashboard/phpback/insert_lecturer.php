<?php
include 'dbconn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lecturer_name = $_POST['lecturer_name'];
    $institution_id = $_POST['institution_id'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $created_by = $_POST['created_by'];

    $stmt_role = $pdo->prepare("SELECT id FROM roles WHERE role_name = 'lecturer'");
    $stmt_role->execute();
    $role_id = $stmt_role->fetchColumn();

    if (!$role_id) {
        $stmt_insert_role = $pdo->prepare("INSERT INTO roles (role_name, created_by) VALUES ('lecturer', :created_by)");
        $stmt_insert_role->execute(['created_by' => $created_by]);
        $role_id = $pdo->lastInsertId();
    }

    $stmt_user = $pdo->prepare("INSERT INTO users (username, password, role_id, created_by) VALUES (:username, :password, :role_id, :created_by)");
    $stmt_user->execute(['username' => $username, 'password' => $password, 'role_id' => $role_id, 'created_by' => $created_by]);
    $users_id = $pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO lecturers (institution_id, users_id, name, phone, email, role_id, created_by) 
                           VALUES (:institution_id, :users_id, :lecturer_name, :phone, :email, :role_id, :created_by)");
    $stmt->execute(['institution_id' => $institution_id, 
                   'users_id' => $users_id,
                   'lecturer_name' => $lecturer_name, 
                   'phone' => $phone, 
                   'email' => $email,
                   'role_id' => $role_id,
                   'created_by' => $created_by]);

    echo "<script>alert('Lecturer registered successfully!'); window.location.href = '../dashboard.php';</script>";
}
?>
