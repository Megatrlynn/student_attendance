<?php
if (isset($_POST['lecturer_id'])) {
    $lecturer_id = $_POST['lecturer_id'];

    $stmt_fetch_lecturer = $pdo->prepare("SELECT * FROM lecturers WHERE id = :lecturer_id");
    $stmt_fetch_lecturer->execute(['lecturer_id' => $lecturer_id]);
    $lecturer = $stmt_fetch_lecturer->fetch(PDO::FETCH_ASSOC);

    $stmt_fetch_user = $pdo->prepare("SELECT username, password FROM users WHERE id = (SELECT users_id FROM lecturers WHERE id = :lecturer_id)");
    $stmt_fetch_user->execute(['lecturer_id' => $lecturer['id']]);
    $user = $stmt_fetch_user->fetch(PDO::FETCH_ASSOC);

    if ($lecturer && $user) {  
    } else {
        echo "Lecturer not found";
    }
} else {
    echo "Lecturer ID not provided";
}
?>