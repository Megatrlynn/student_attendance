<?php
include 'dbconn.php';

$student_name = $_GET['student'];
$course_name = $_GET['course'];
$date = $_GET['date'];
$lecturer_name = $_GET['lecturer'];

$stmt_student = $pdo->prepare("SELECT id FROM students WHERE name = ?");
$stmt_student->execute([$student_name]);
$student = $stmt_student->fetch(PDO::FETCH_ASSOC);
$student_id = $student['id'];

$stmt_course = $pdo->prepare("SELECT id FROM courses WHERE course_name = ?");
$stmt_course->execute([$course_name]);
$course = $stmt_course->fetch(PDO::FETCH_ASSOC);
$course_id = $course['id'];

$stmt_check_attendance = $pdo->prepare("SELECT COUNT(*) AS attendance_count FROM student_attendance WHERE student_id = ? AND course_id = ? AND date = ?");
$stmt_check_attendance->execute([$student_id, $course_id, $date]);
$attendance_info = $stmt_check_attendance->fetch(PDO::FETCH_ASSOC);
$attendance_count = $attendance_info['attendance_count'];

if ($attendance_count == 0) {
    $stmt_lecturer = $pdo->prepare("SELECT id FROM lecturers WHERE name = ?");
    $stmt_lecturer->execute([$lecturer_name]);
    $lecturer = $stmt_lecturer->fetch(PDO::FETCH_ASSOC);
    $lecturer_id = $lecturer['id'];

    $stmt_attendance = $pdo->prepare("INSERT INTO student_attendance (course_id, student_id, date, attendance, lecturer_id, created_by) VALUES (?, ?, ?, 'not attended', ?, ?)");
    $stmt_attendance->execute([$course_id, $student_id, $date, $lecturer_id, $lecturer_name]);

    if ($stmt_attendance->rowCount() > 0) {
        echo "<script>alert('Attendance recorded successfully'); setTimeout(function(){ window.location.href = '../../lecturer.php'; }, 1000);</script>";
    } else {
        echo "<script>alert('Failed to record attendance'); setTimeout(function(){ window.location.href = '../../lecturer.php'; }, 1000);</script>";
    }
} else {
    echo "<script>alert('Student has already been attended for this course on $date'); setTimeout(function(){ window.location.href = '../../lecturer.php'; }, 1000);</script>";
}

if (isset($_GET['redirect'])) {
    $redirect_url = $_GET['redirect'];
    header("Location: $redirect_url");
    exit;
}
?>
