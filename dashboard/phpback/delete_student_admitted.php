<?php
include 'dbconn.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the student_id is set
    if (isset($_POST['student_id'])) {
        $student_id = $_POST['student_id'];

        // Prepare and execute the SQL query to delete records
        $stmt = $pdo->prepare("DELETE FROM student_course WHERE student_id = :student_id");
        $stmt->execute(['student_id' => $student_id]);

        // Check if any rows were affected
        if ($stmt->rowCount() > 0) {
            echo "Records related to student with ID $student_id have been deleted successfully.";
        } else {
            echo "No records found for student with ID $student_id.";
        }
    } else {
        echo "Student ID not provided.";
    }
}
?>
