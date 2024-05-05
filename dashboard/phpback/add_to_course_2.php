<?php
include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['lecturer_id']) && isset($_POST['institution_id'])) {
        $lecturer_id = $_POST['lecturer_id'];
        $course_id = $_POST['institution_id'];
        $created_by = $_POST['created_by'];

        $stmt_check = $pdo->prepare("SELECT * FROM lecturer_course WHERE lecturer_id = :lecturer_id AND course_id = :course_id");
        $stmt_check->execute(['lecturer_id' => $lecturer_id, 'course_id' => $course_id]);
        $existing_record = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($existing_record) {
            echo "<script>alert('Lecturer is already enrolled in the course.'); window.location.href = '../view2.php';</script>";
        } else {
            $stmt = $pdo->prepare("INSERT INTO lecturer_course (lecturer_id, course_id, created_by) VALUES (:lecturer_id, :course_id, :created_by)");
            $stmt->execute(['lecturer_id' => $lecturer_id, 'course_id' => $course_id, 'created_by' => $created_by]);

            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Lecturer successfully added to the course.'); window.location.href = '../view2.php';</script>";
            } else {
                echo "<script>alert('Failed to add leturer to the course.'); window.location.href = '../view2.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Lecturer ID or course ID not provided.'); window.location.href = '../view2.php';</script>";
    }
}
?>

