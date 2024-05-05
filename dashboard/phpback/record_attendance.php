<?php
// Include the database connection file
include 'dbconn.php';

// Retrieve course ID and lecturer name from the form submission
$course_id = $_POST['course_id'] ?? null;
$lecturer_name = $_POST['lecturer_name'] ?? null;

// Check if course ID and lecturer name are provided
if ($course_id && $lecturer_name) {
    // Get the current date
    $current_date = date("Y-m-d");

    // Prepare the SQL statement for insertion
    $stmt = $pdo->prepare("INSERT INTO student_attendance (course_id, student_id, date, attendance, lecturer_id, created_by) VALUES (?, ?, ?, ?, ?, ?)");

    // Loop through the attendance data submitted via checkboxes
    foreach ($_POST['attendance'] as $student_id => $attendance) {
        // Check if both attendance option checkboxes are checked
        if (in_array('attended', $attendance) && in_array('not_attended', $attendance)) {
            // If both are checked, set attendance to 'attended'
            $attendance_value = 'attended';
        } elseif (in_array('attended', $attendance)) {
            // If 'attended' checkbox is checked, set attendance to 'attended'
            $attendance_value = 'attended';
        } elseif (in_array('not_attended', $attendance)) {
            // If 'not_attended' checkbox is checked, set attendance to 'not_attended'
            $attendance_value = 'not_attended';
        } else {
            // If neither checkbox is checked, skip this student
            continue;
        }

        // Insert the attendance record into the database
        $stmt->execute([$course_id, $student_id, $current_date, $attendance_value, $lecturer_id, $lecturer_name]);
    }

    // Redirect back to the lecturer.php page
    header("Location: ../../lecturer.php");
    exit;
} else {
    // If course ID or lecturer name is missing, redirect back to the previous page with an error message
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=1");
    exit;
}
?>
