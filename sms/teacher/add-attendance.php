<?php
    include '../include/teacher-privacy.php';
    include '../sql/main_connection.php';

    $teacher_number = $_SESSION['number'];

    $data = mysqli_query($conn, "SELECT * FROM `teacher_info` WHERE teacher_number = '$teacher_number'");
    $result = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/links.php'; ?>
    <link rel="stylesheet" href="../styles/teacher-dashboard-style.css">
    <link rel="stylesheet" href="teacher-responsive.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Attendance</title>
</head>
<body>
    <?php include '../include/teacher-sidebar.php'; ?>

    <section class="dashboard-middle-area">
        <h4 class="teacher-name">Hello, <?php echo $result['teacher_name']; ?></h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination"><p style="color:#1264a3;">Teacher / </p> <a href="dashboard.php" style="color: #1264a3;">Dashboard</a> / <a href="add-attendance.php" style="color: #1264a3;">Add Attendance</a></pre> <hr>
        <p class="update-heading">Add Attendance</p>
        <div class="selection">
            <div class="select">
                <p>Course</p>
                <select name="course" id="courseSelect" class="edit-input ms-0">
                    <option value="">Course</option>
                    <?php
                        $course_query = mysqli_query($conn, "SELECT * FROM teacher_info WHERE teacher_number = '$teacher_number'");
                        $course_result = mysqli_fetch_assoc($course_query);
                        if (!empty($result['teacher_course'])) {
                            echo "<option value='" . htmlspecialchars($result['teacher_course']) . "'>" . htmlspecialchars($result['teacher_course']) . "</option>";
                        }
                        if (!empty($result['teacher_course_1'])) {
                            echo "<option value='" . htmlspecialchars($result['teacher_course_1']) . "'>" . htmlspecialchars($result['teacher_course_1']) . "</option>";
                        }
                        if (!empty($result['teacher_course_2'])) {
                            echo "<option value='" . htmlspecialchars($result['teacher_course_2']) . "'>" . htmlspecialchars($result['teacher_course_2']) . "</option>";
                        }
                        if (!empty($result['teacher_course_3'])) {
                            echo "<option value='" . htmlspecialchars($result['teacher_course_3']) . "'>" . htmlspecialchars($result['teacher_course_3']) . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="select">
                <p>Semester</p>
                <select name="semester" id="semesterSelect" class="edit-input ms-0">
                    <option value="">Semester</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </div>
            <div class="select">
                <p>Date</p>
                <input type="date" autocomplete="off" class="edit-input select-input" name="date" id="attendanceDate">
            </div>
        </div>
        <div class="student-profile mt-3" id="attendanceTableContainer">
        </div>
    </section>

    <script>
        function fetchAttendanceTable() {
            var selectedDate = document.getElementById('attendanceDate').value;
            var course = document.getElementById('courseSelect').value;
            var semester = document.getElementById('semesterSelect').value;

            if (selectedDate && course && semester) {
                fetch('get_students_attendance.php?date=' + selectedDate + '&course=' + course + '&semester=' + semester)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('attendanceTableContainer').innerHTML = data;
                    });
            } else {
                document.getElementById('attendanceTableContainer').innerHTML = '';
            }
        }

        document.getElementById('attendanceDate').addEventListener('change', fetchAttendanceTable);
        document.getElementById('courseSelect').addEventListener('change', fetchAttendanceTable);
        document.getElementById('semesterSelect').addEventListener('change', fetchAttendanceTable);
    </script>
</body>
</html>