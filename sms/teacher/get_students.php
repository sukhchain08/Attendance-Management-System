<?php
    // get_students.php (Modified SQL Query)
    include '../sql/main_connection.php';

    if (isset($_GET['course_name']) && !empty($_GET['course_name'])) {
        $courseName = mysqli_real_escape_string($conn, $_GET['course_name']); // Sanitize course input
        $semester = isset($_GET['semester']) ? mysqli_real_escape_string($conn, $_GET['semester']) : ''; // Sanitize semester input

        $sql = "SELECT * FROM student_info WHERE student_course = '$courseName'";
        if ($semester !== '' && $semester !== 'all') {
            $sql .= " AND student_semester = '$semester'";
        }

        $student_query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($student_query) > 0) {
            echo "<form method='POST' action='save_semester.php'>";
            echo "<table class='table table-bordered text-center'>";
            echo "<tr><th>Student Name</th><th>Father Name</th><th>Previous Semester</th><th>Edit Semester</th></tr>";

            while ($student = mysqli_fetch_assoc($student_query)) {
                echo "<tr>";
                echo "<td>" . $student['student_name'] . "</td>";
                echo "<td>" . $student['student_father_name'] . "</td>";
                echo "<td> Semester - " . $student['student_semester'] . "</td>";
                echo "<td>"; // Add Semester column
                echo "<select name='semester_" . $student['student_number'] . "' class='edit-input ms-0'>"; // Unique name for each student
                echo "<option value=''>Select Semester</option>";
                for ($i = 1; $i <= 6; $i++) {
                    echo "<option value='" . $i . "' " . ($student['student_semester'] == $i ? 'selected' : '') . ">" . $i . "</option>";
                }
                echo "</select>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
            echo "<input type='submit' class='btn btn-primary' name='update-semester' value='Update Semester'>";
            echo "</form>";
        } else {
            echo "<tr><td colspan='4'>No student found for this course";
            if ($semester !== '' && $semester !== 'all') {
                echo " and semester " . $semester;
            } else if ($semester === 'all') {
                echo " with any semester assigned";
            }
            echo ".</td></tr>";
        }
    } else {
        echo "<p>Please select a course.</p>";
    }
?>