<?php
    include '../sql/main_connection.php';

    $course = $_GET['course'];
    $semester = $_GET['semester'];
    $date = $_GET['date'];

    $student_data = mysqli_query($conn, "SELECT student_number, student_name, student_father_name FROM student_info WHERE student_course = '$course' AND student_semester = '$semester'");

    if (mysqli_num_rows($student_data) > 0)
    {
        echo '<form method="POST" action="save_attendance.php">';
        echo '<input type="hidden" name="date" value="' . $date . '">';
        echo '<input type="hidden" name="course" value="' . $course . '">';
        echo '<input type="hidden" name="semester" value="' . $semester . '">';
        echo '<table class="table table-bordered text-center attendance-table">';
        echo '<tr class="heading-row">';
        echo '<th width="30%">Students</th>';
        echo '<th>Father Name</th>';
        echo '<th>Present</th>';
        echo '<th>Absent</th>';
        echo '</tr>';

        while ($student_result = mysqli_fetch_assoc($student_data))
        {
            echo '<tr>';
            echo '<td>' . $student_result['student_name'] . '</td>';
            echo '<td>' . $student_result['student_father_name'] . '</td>';
            echo '<td><input type="radio" name="attendance[' . $student_result['student_number'] . ']" value="Present"></td>';
            echo '<td><input type="radio" name="attendance[' . $student_result['student_number'] . ']" value="Absent"></td>';
            echo '<input type="hidden" name="student_name[' . $student_result['student_number'] . ']" value="' . $student_result['student_name'] . '">';
            echo '</tr>';
        }
        echo '</table>';
        echo '<button type="submit" name="save-attendance" class="btn btn-primary">Save Attendance</button>';
        echo '</form>';
    }
    else
    {
        echo '<p>No students found for this course and semester.</p>';
    }
?>