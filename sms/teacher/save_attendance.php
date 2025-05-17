<?php
    include '../sql/main_connection.php';
    include '../include/teacher-privacy.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $date = $_POST['date'];
        $course = $_POST['course'];
        $semester = $_POST['semester'];
        $attendance = $_POST['attendance'];
        $studentNames = $_POST['student_name'];
        $teacher_number = $_SESSION['number'];

        foreach ($attendance as $studentNumber => $status) 
        {
            $name = $studentNames[$studentNumber];

            // Check if attendance already exists
            $check = "SELECT * FROM attendance WHERE student_number='$studentNumber' AND date='$date' AND course='$course' AND semester='$semester' AND teacher_number='$teacher_number'";
            $result = mysqli_query($conn, $check);

            if (mysqli_num_rows($result) == 0) 
            {
                // Insert attendance
                $insert = "INSERT INTO attendance (student_number, student_name, date, status, course, semester, teacher_number) VALUES ('$studentNumber', '$name', '$date', '$status', '$course', '$semester', '$teacher_number')";
                mysqli_query($conn, $insert);
            } 
            else 
            {
                echo "<script>alert('Attendance already exists for $name');</script>";
            }
        }
        echo "<script>alert('Attendance process completed'); window.location='add-attendance.php';</script>";
    } 
    else 
    {
        echo "Invalid request.";
    }

    mysqli_close($conn);
?>