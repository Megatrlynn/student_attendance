<?php
include 'dbconn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_name = $_POST['course_name'];
    $institution_id = $_POST['institution_id'];
    $course_code = $_POST['course_code'];
    $created_by = $_POST['created_by'];

    $stmt = $pdo->prepare("INSERT INTO courses (institution_id, course_name, course_code, created_by) 
                           VALUES (:institution_id, :course_name, :course_code, :created_by)");
    $stmt->execute(['institution_id' => $institution_id, 
                   'course_name' => $course_name, 
                   'course_code' => $course_code, 
                   'created_by' => $created_by]);

    echo "<script>alert('Course registered successfully!'); window.location.href = '../dashboard.php';</script>";
}
?>
