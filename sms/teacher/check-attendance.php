<?php
    include '../include/teacher-privacy.php';
    include '../sql/main_connection.php';
    $teacher_number = $_SESSION['number'];

    // For show teacher info
    $data = mysqli_query($conn, "SELECT * FROM `teacher_info` WHERE teacher_number = '$teacher_number'");
    $result = mysqli_fetch_assoc($data);

    // Initialize course, semester, and month variables
    $selected_course = isset($_GET['course']) ? $_GET['course'] : '';
    $selected_semester = isset($_GET['semester']) ? $_GET['semester'] : '';
    $selected_month = isset($_GET['month']) ? $_GET['month'] : '';

    // Fetch student detail based on selected course and semester
    if (!empty($selected_course) && !empty($selected_semester) && !empty($selected_month)) {
        $student_data = mysqli_query($conn, "SELECT * FROM student_info WHERE student_course = '$selected_course' AND student_semester = '$selected_semester'");
        $student_row = mysqli_num_rows($student_data);
    } else {
        $student_data = null;
        $student_row = 0;
    }

    $currentMonth = date('F');
    $currentYear = date('Y');
    if (!empty($selected_month)) {
        $currentMonth = date('F', strtotime("{$currentYear}-{$selected_month}-01"));
        $daysInMonth = date('t', strtotime("{$currentYear}-{$selected_month}-01"));
    } else {
        $daysInMonth = date('t');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/links.php'; ?>
    <link rel="stylesheet" href="../styles/teacher-dashboard-style.css">
    <link rel="stylesheet" href="teacher-responsive.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Attendance</title>
</head>
<body>
    <?php include '../include/teacher-sidebar.php'; ?>

    <section class="dashboard-middle-area">
        <h4 class="teacher-name">Hello, <?php echo $result['teacher_name'] ?></h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination"><p style="color: #1264a3;">Teacher / </p> <a href="dashboard.php" style="color: #1264a3;">Dashboard</a> / <a href="check-attendance.php">Check Attendance</a></pre> <hr>
        <p class="update-heading">Check Attendance</p>

        <div class="check-attendance">
            <div class="selection">
                <div class="select">
                    <p>Select Course</p>
                    <select name="course" class="edit-input ms-0" onchange="updateFilters()">
                        <option value="">Course</option>
                        <?php
                            if (!empty($result['teacher_course'])) {
                                echo "<option value='" . htmlspecialchars($result['teacher_course']) . "'" . ($selected_course == $result['teacher_course'] ? ' selected' : '') . ">" . htmlspecialchars($result['teacher_course']) . "</option>";
                            }
                            if (!empty($result['teacher_course_1'])) {
                                echo "<option value='" . htmlspecialchars($result['teacher_course_1']) . "'" . ($selected_course == $result['teacher_course_1'] ? ' selected' : '') . ">" . htmlspecialchars($result['teacher_course_1']) . "</option>";
                            }
                            if (!empty($result['teacher_course_2'])) {
                                echo "<option value='" . htmlspecialchars($result['teacher_course_2']) . "'" . ($selected_course == $result['teacher_course_2'] ? ' selected' : '') . ">" . htmlspecialchars($result['teacher_course_2']) . "</option>";
                            }
                            if (!empty($result['teacher_course_3'])) {
                                echo "<option value='" . htmlspecialchars($result['teacher_course_3']) . "'" . ($selected_course == $result['teacher_course_3'] ? ' selected' : '') . ">" . htmlspecialchars($result['teacher_course_3']) . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="select">
                    <p>Select Semester</p>
                    <select name="semester" class="edit-input ms-0" onchange="updateFilters()">
                        <option value="">Semester</option>
                        <option value="1" <?php if ($selected_semester == '1') echo 'selected'; ?>>1</option>
                        <option value="2" <?php if ($selected_semester == '2') echo 'selected'; ?>>2</option>
                        <option value="3" <?php if ($selected_semester == '3') echo 'selected'; ?>>3</option>
                        <option value="4" <?php if ($selected_semester == '4') echo 'selected'; ?>>4</option>
                        <option value="5" <?php if ($selected_semester == '5') echo 'selected'; ?>>5</option>
                        <option value="6" <?php if ($selected_semester == '6') echo 'selected'; ?>>6</option>
                    </select>
                </div>
                <div class="select">
                    <p>Select Month</p>
                    <select name="month" class="edit-input ms-0" onchange="updateFilters()">
                        <option value="">Month</option>
                        <option value="01" <?php if ($selected_month == '01') echo 'selected'; ?>>January</option>
                        <option value="02" <?php if ($selected_month == '02') echo 'selected'; ?>>February</option>
                        <option value="03" <?php if ($selected_month == '03') echo 'selected'; ?>>March</option>
                        <option value="04" <?php if ($selected_month == '04') echo 'selected'; ?>>April</option>
                        <option value="05" <?php if ($selected_month == '05') echo 'selected'; ?>>May</option>
                        <option value="06" <?php if ($selected_month == '06') echo 'selected'; ?>>June</option>
                        <option value="07" <?php if ($selected_month == '07') echo 'selected'; ?>>July</option>
                        <option value="08" <?php if ($selected_month == '08') echo 'selected'; ?>>August</option>
                        <option value="09" <?php if ($selected_month == '09') echo 'selected'; ?>>September</option>
                        <option value="10" <?php if ($selected_month == '10') echo 'selected'; ?>>October</option>
                        <option value="11" <?php if ($selected_month == '11') echo 'selected'; ?>>November</option>
                        <option value="12" <?php if ($selected_month == '12') echo 'selected'; ?>>December</option>
                    </select>
                </div>
            </div>

            <div class="main-attendance-div mt-5">
                <table class="table table-bordered text-center">
                    <tr>
                        <th colspan="36" class="bg-primary" style="color: #fff;"><?php echo $currentMonth . ' ' . $currentYear; ?></th>
                    </tr>
                    <tr>
                        <th>Students</th>
                        <th>Father Name</th>
                        <?php
                            for ($date = 1; $date <= $daysInMonth; $date++) {
                                echo "<th>$date</th>";
                            }
                        ?>
                        <th>TP</th>
                        <th>TD</th>
                        <th>%</th>
                    </tr>
                    <?php
                        if ($student_data !== null && $student_row > 0) {
                            while ($student_result = mysqli_fetch_assoc($student_data)) {
                                echo "<tr><td>" . $student_result['student_name'] . "</td>";
                                echo "<td>" . $student_result['student_father_name'] . "</td>";
                                // Fetch attendance for each student FOR THE LOGGED-IN TEACHER
                                $presentCount = 0;
                                $absentCount = 0;

                                for ($date = 1; $date <= $daysInMonth; $date++) {
                                    $formattedDate = $currentYear . '-' . date('m', strtotime("{$currentYear}-{$selected_month}-01")) . '-' . sprintf('%02d', $date);
                                    $studentNumber = $student_result['student_number'];

                                    // ADD THE TEACHER_NUMBER CONDITION HERE
                                    $attendanceQuery = mysqli_query($conn, "SELECT status FROM attendance WHERE student_number = '$studentNumber' AND date = '$formattedDate' AND teacher_number = '$teacher_number'");

                                    if (mysqli_num_rows($attendanceQuery) > 0) {
                                        $attendanceResult = mysqli_fetch_assoc($attendanceQuery);
                                        $attendanceStatus = $attendanceResult['status'];
                                        echo "<td>$attendanceStatus</td>";
                                        if ($attendanceStatus == 'Present') {
                                            $presentCount++;
                                        } else if ($attendanceStatus == 'Absent') {
                                            $absentCount++;
                                        }
                                    } else {
                                        echo "<td>-</td>";
                                    }
                                }
                                $totalDays = $presentCount + $absentCount;
                                $percentage = ($totalDays > 0) ? ($presentCount / $totalDays) * 100 : 0;
                                echo "<td>$presentCount</td><td>$totalDays</td><td>" . number_format($percentage, 2) . "%</td></tr>";
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </section>
    <script>
        function updateFilters() {
            var course = document.getElementsByName('course')[0].value;
            var semester = document.getElementsByName('semester')[0].value;
            var month = document.getElementsByName('month')[0].value;
            window.location.href = 'check-attendance.php?course=' + course + '&semester=' + semester + '&month=' + month;
        }
    </script>
</body>
</html>