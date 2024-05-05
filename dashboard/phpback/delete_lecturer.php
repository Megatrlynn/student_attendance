<?php
include 'dbconn.php';
if (isset($_POST['lecturer_id'])) {
    $lecturer_id = $_POST['lecturer_id'];

    $stmt_get_user_id = $pdo->prepare("SELECT users_id FROM lecturers WHERE id = :lecturer_id");
    $stmt_get_user_id->execute(['lecturer_id' => $lecturer_id]);
    $user_id = $stmt_get_user_id->fetchColumn();

    $stmt_delete_lecturer = $pdo->prepare("DELETE FROM lecturers WHERE id = :lecturer_id");
    $stmt_delete_lecturer->execute(['lecturer_id' => $lecturer_id]);

    if ($user_id) {
        $stmt_delete_user = $pdo->prepare("DELETE FROM users WHERE id = :user_id");
        $stmt_delete_user->execute(['user_id' => $user_id]);
    }

    header("Location: ../view2.php");
    exit;
} else {
    header("Location: ../view2.php");
    exit;
}
?>
