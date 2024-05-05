<?php
include 'dbconn.php';
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $stmt_fetch_user = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt_fetch_user->execute(['username' => $username]);
    $user = $stmt_fetch_user->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $users_id = $user['id'];
        $stmt_fetch_lecturer = $pdo->prepare("SELECT * FROM students WHERE users_id = :users_id");
        $stmt_fetch_lecturer->execute(['users_id' => $users_id]);
        $student = $stmt_fetch_lecturer->fetch(PDO::FETCH_ASSOC);

        if ($student) {
            $stmt_fetch_institutions = $pdo->query("SELECT id, name FROM institution");
            $institutions = $stmt_fetch_institutions->fetchAll(PDO::FETCH_ASSOC);
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $student_id = $_POST['student_id'];
                $name = $_POST['name'];
                $reg_no = $_POST['reg_no'];
                $institution_id = $_POST['institution_id'];

                $stmt_update_lecturer = $pdo->prepare("UPDATE students SET name = :name, reg_no = :reg_no, institution_id = :institution_id WHERE id = :student_id");
                $stmt_update_lecturer->execute(['name' => $name, 'reg_no' => $reg_no, 'institution_id' => $institution_id, 'student_id' => $student_id]);

                header ("Location: student.php");
                exit;
            }
        } else {
            echo "Student data not found for the logged-in user.";
        }
    } else {
        echo "User data not found for the logged-in user.";
    }
} else {
    echo "Session not active or username not set.";
}
?>