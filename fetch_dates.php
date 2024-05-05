<?php
include 'dashboard/phpback/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['course_id'])) {
    $courseId = $_POST['course_id'];

    $stmt = $pdo->prepare("SELECT DISTINCT date FROM student_attendance WHERE course_id = ?");
    $stmt->execute([$courseId]);
    $dates = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo json_encode($dates);
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Invalid request."));
}
?>
