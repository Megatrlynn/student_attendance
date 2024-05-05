<?php
include 'dashboard/phpback/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['course_id'])) {
    $courseId = $_POST['course_id'];

    $stmt_dates = $pdo->prepare("SELECT DISTINCT date FROM student_attendance WHERE course_id = ?");
    $stmt_dates->execute([$courseId]);
    $dates = $stmt_dates->fetchAll(PDO::FETCH_COLUMN);

    if ($dates) {
        echo "<table id='data-table' style='table-layout: auto;'>";
        echo "<thead><tr><th>No.</th><th>Student</th>";

        foreach ($dates as $date) {
            echo "<th>{$date}</th>";
        }

        echo "</tr></thead><tbody>";

        $stmt_students = $pdo->prepare("SELECT students.id, students.name FROM students INNER JOIN student_attendance ON students.id = student_attendance.student_id WHERE student_attendance.course_id = ? GROUP BY students.id, students.name");
        $stmt_students->execute([$courseId]);
        $students = $stmt_students->fetchAll(PDO::FETCH_ASSOC);

        $index = 1;
        foreach ($students as $student) {
            echo "<tr>";
            echo "<td data-th='No.'>{$index}</td>";
            echo "<td data-th='Student'>{$student['name']}</td>";

            foreach ($dates as $date) {
                $stmt_attendance = $pdo->prepare("SELECT attendance FROM student_attendance WHERE student_id = ? AND course_id = ? AND date = ?");
                $stmt_attendance->execute([$student['id'], $courseId, $date]);
                $attendance = $stmt_attendance->fetchColumn();

                echo "<td data-th='$date'>{$attendance}</td>";
            }

            echo "</tr>";
            $index++;
        }

        echo "</tbody></table>";
    } else {
        echo "<p>No attendance records found for the selected course.</p>";
    }
} else {
    echo "<p>Error: Course ID is required.</p>";
}
?>
<?php
include 'dashboard/phpback/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['course_id'])) {
    $courseId = $_POST['course_id'];

    $stmt_students = $pdo->prepare("SELECT students.id, students.name FROM students INNER JOIN student_course ON students.id = student_course.student_id WHERE student_course.course_id = ?");
    $stmt_students->execute([$courseId]);
    $students = $stmt_students->fetchAll(PDO::FETCH_ASSOC);

    $attendanceData = array();

    foreach ($students as $student) {
        $studentId = $student['id'];

        $stmt_attendance = $pdo->prepare("SELECT 
            SUM(CASE WHEN student_attendance.attendance = 'Attended' THEN 1 ELSE 0 END) AS attended_count,
            SUM(CASE WHEN student_attendance.attendance = 'Not Attended' THEN 1 ELSE 0 END) AS not_attended_count,
            COUNT(DISTINCT student_attendance.date) AS total_dates,
            COUNT(DISTINCT student_attendance.lecturer_id) AS total_lecturers
            FROM student_attendance
            WHERE student_attendance.student_id = ?");
        $stmt_attendance->execute([$studentId]);
        $attendance = $stmt_attendance->fetch(PDO::FETCH_ASSOC);

        $totalAttendance = $attendance['attended_count'] + $attendance['not_attended_count'];
        $attendance['attendance_percentage'] = $totalAttendance > 0 ? round(($attendance['attended_count'] / $totalAttendance) * 100, 2) : 0;

        $eligibility = $attendance['attendance_percentage'] >= 70 ? 'Eligible for exam' : 'Not eligible for exam';
        $badge_color = $eligibility == 'Eligible for exam' ? 'success' : 'danger';

        $attendanceData[] = array_merge($student, $attendance, ['eligibility' => $eligibility, 'badge_color' => $badge_color]);
    }

    $html = "<table id='aggregated-attendance-table' style='table-layout: auto;'>";
    $html .= "<thead><tr><th>No.</th><th>Student</th><th>Attended</th><th>Not Attended</th><th>Total Dates</th><th>Attendance %</th><th>Eligibility</th></tr></thead><tbody>";

    $index = 1;
    foreach ($attendanceData as $data) {
        $html .= "<tr>";
        $html .= "<td data-th='No.'>{$index}</td>";
        $html .= "<td data-th='Student'>{$data['name']}</td>";
        $html .= "<td data-th='Attended'>{$data['attended_count']}</td>";
        $html .= "<td data-th='Not Attended'>{$data['not_attended_count']}</td>";
        $html .= "<td data-th='Total Dates'>{$data['total_dates']}</td>";
        $html .= "<td data-th='Attendance %'>{$data['attendance_percentage']}%</td>";
        $html .= "<td data-th='Eligibility'><span class='badge bg-{$data['badge_color']}'>{$data['eligibility']}</span></td>";
        $html .= "</tr>";
        $index++;
    }

    $html .= "</tbody></table>";

    echo $html;
} else {
    echo "<p>Error: Course ID is required.</p>";
}
?>



