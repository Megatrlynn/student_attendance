<?php
include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['student_id']) && isset($_POST['institution_id'])) {
        $student_id = $_POST['student_id'];
        $course_id = $_POST['institution_id'];
        $created_by = $_POST['created_by'];

        $stmt_dates = $pdo->prepare("SELECT DISTINCT date FROM student_attendance WHERE course_id = ?");
        $stmt_dates->execute([$course_id]);
        $attendance_dates = $stmt_dates->fetchAll(PDO::FETCH_COLUMN);

        $current_date = date('Y-m-d');
        $existing_attendance_date = in_array($current_date, $attendance_dates);

        if (!$existing_attendance_date) {
            foreach ($attendance_dates as $date) {
                if ($date != $current_date) {
                    $stmt_insert = $pdo->prepare("INSERT INTO student_attendance (student_id, course_id, date, attendance, created_by) VALUES (:student_id, :course_id, :date, 'Not Attended', :created_by)");
                    $stmt_insert->execute(['student_id' => $student_id, 'course_id' => $course_id, 'date' => $date, 'created_by' => $created_by]);
                }
            }
        }

        $stmt_check = $pdo->prepare("SELECT * FROM student_course WHERE student_id = :student_id AND course_id = :course_id");
        $stmt_check->execute(['student_id' => $student_id, 'course_id' => $course_id]);
        $existing_record = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($existing_record) {
            echo "<script>alert('Student is already enrolled in the course.'); window.location.href = '../view3.php';</script>";
        } else {
            $stmt = $pdo->prepare("INSERT INTO student_course (student_id, course_id, created_by) VALUES (:student_id, :course_id, :created_by)");
            $stmt->execute(['student_id' => $student_id, 'course_id' => $course_id, 'created_by' => $created_by]);

            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Student successfully added to the course.'); window.location.href = '../view3.php';</script>";
            } else {
                echo "<script>alert('Failed to add student to the course.'); window.location.href = '../view3.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Student ID or course ID not provided.'); window.location.href = '../view3.php';</script>";
    }
}
?>
