<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $stmt_fetch_user = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt_fetch_user->execute(['username' => $username]);
    $user = $stmt_fetch_user->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $users_id = $user['id'];
        $stmt_fetch_lecturer = $pdo->prepare("SELECT * FROM lecturers WHERE users_id = :users_id");
        $stmt_fetch_lecturer->execute(['users_id' => $users_id]);
        $lecturer = $stmt_fetch_lecturer->fetch(PDO::FETCH_ASSOC);

        if ($lecturer) {
            $stmt_fetch_institutions = $pdo->query("SELECT id, name FROM institution");
            $institutions = $stmt_fetch_institutions->fetchAll(PDO::FETCH_ASSOC);
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $lecturer_id = $_POST['lecturer_id'];
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $institution_id = $_POST['institution_id'];

                $stmt_update_lecturer = $pdo->prepare("UPDATE lecturers SET name = :name, phone = :phone, email = :email, institution_id = :institution_id WHERE id = :lecturer_id");
                $stmt_update_lecturer->execute(['name' => $name, 'phone' => $phone, 'email' => $email, 'institution_id' => $institution_id, 'lecturer_id' => $lecturer_id]);

                header ("Location: lecturer.php");
                exit;
            }
        } else {
            echo "Lecturer data not found for the logged-in user.";
        }
    } else {
        echo "User data not found for the logged-in user.";
    }
} else {
    echo "Session not active or username not set.";
}
?>