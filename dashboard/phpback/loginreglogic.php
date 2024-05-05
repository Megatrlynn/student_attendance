<?php
include 'dashboard/phpback/dbconn.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;

            $role_stmt = $pdo->prepare("SELECT role_id FROM users WHERE username = :username");
            $role_stmt->execute(['username' => $username]);
            $role_id = $role_stmt->fetchColumn();

            switch ($role_id) {
                case 1:
                    header("Location: student.php");
                    break;
                case 2:
                    header("Location: lecturer.php");
                    break;
                case 3:
                    header("Location: dashboard/dashboard.php");
                    break;
                default:
                    break;
            }
            exit;
        } else {
            echo "<script>alert('Invalid username or password');</script>";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $selected_role = $_POST['role'];
    $verification_code = $_POST['verification_code'];
    $institution_id = $_POST['institution_id'];

    $stmt_check_user = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt_check_user->execute(['username' => $username]);
    $existingUser = $stmt_check_user->fetch();

    if ($existingUser) {
        echo "<script>alert('Username already taken. Please choose a different username.');</script>";
    } else {
        $verification_codes = [
            'student' => 'STUDENT-IRC2000',
            'lecturer' => 'LECTURER-IRC20199'
        ];

        if (array_key_exists($selected_role, $verification_codes) && $verification_code === $verification_codes[$selected_role]) {
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt_insert_user = $pdo->prepare("INSERT INTO users (username, password, role_id, created_by) VALUES (:username, :password, :role_id, :created_by)");
            $stmt_insert_user->execute(['username' => $username, 'password' => $hashed_password, 'role_id' => null, 'created_by' => 'Self']);
            $lastUserId = $pdo->lastInsertId();

            $stmt_fetch_role_id = $pdo->prepare("SELECT id FROM roles WHERE role_name = :role_name");
            $stmt_fetch_role_id->execute(['role_name' => $selected_role]);
            $role = $stmt_fetch_role_id->fetch();
            $role_id = $role['id'];

            if ($selected_role === 'student') {
                $stmt_insert_student = $pdo->prepare("INSERT INTO students (name, users_id, role_id, institution_id, created_by) VALUES (:name, :user_id, :role_id, :institution_id, :created_by)");
            } elseif ($selected_role === 'lecturer') {
                $stmt_insert_student = $pdo->prepare("INSERT INTO lecturers (name, users_id, role_id, institution_id, created_by) VALUES (:name, :user_id, :role_id, :institution_id, :created_by)");
            }

            $stmt_insert_student->execute(['name' => $name, 'user_id' => $lastUserId, 'role_id' => $role_id, 'institution_id' => $institution_id, 'created_by' => 'Self']);

            $stmt_update_role_id = $pdo->prepare("UPDATE users SET role_id = :role_id WHERE id = :id");
            $stmt_update_role_id->execute(['role_id' => $role_id, 'id' => $lastUserId]);

            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;

            switch ($selected_role) {
                case 'student':
                    header("Location: studentupdate.php");
                    break;
                case 'lecturer':
                    header("Location: lecturerupdate.php");
                    break;
                default:
                    break;
            }
            exit;
        } else {
            echo "<script>alert('Invalid verification code or role.');</script>";
        }
    }
}
?>
