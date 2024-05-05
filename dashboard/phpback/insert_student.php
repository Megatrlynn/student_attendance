<?php
include 'dbconn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST['student_name'];
    $institution_id = $_POST['institution_id'];
    $reg_no = $_POST['reg_no'];
    $created_by = $_POST['created_by'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt_inst = $pdo->prepare("SELECT name FROM institution WHERE id = :id");
    $stmt_inst->execute(['id' => $institution_id]);
    $institution_name = $stmt_inst->fetchColumn();

    $stmt_user = $pdo->prepare("INSERT INTO users (username, password, role_id, created_by) 
                                VALUES (:username, :password, :role_id, :created_by)");
    $stmt_user->execute(['username' => $username,
                        'password' => $password,
                        'role_id' => 1, 
                        'created_by' => $created_by]);
    $user_id = $pdo->lastInsertId();

    $stmt_role = $pdo->prepare("INSERT IGNORE INTO roles (role_name, created_by) 
                                VALUES ('student', :created_by)");
    $stmt_role->execute(['created_by' => $created_by]);

    $stmt_get_role = $pdo->prepare("SELECT id FROM roles WHERE role_name = 'student'");
    $stmt_get_role->execute();
    $role_id = $stmt_get_role->fetchColumn();

    $stmt_student = $pdo->prepare("INSERT INTO students (institution_id, name, reg_no, users_id, role_id, created_by) 
                                   VALUES (:institution_id, :student_name, :reg_no, :users_id, :role_id, :created_by)");
    $stmt_student->execute(['institution_id' => $institution_id, 
                            'student_name' => $student_name, 
                            'reg_no' => $reg_no,
                            'users_id' => $user_id,
                            'role_id' => $role_id,
                            'created_by' => $created_by]);

    echo "<script>alert('Student registered successfully!'); window.location.href = '../dashboard.php';</script>";
}
?>
