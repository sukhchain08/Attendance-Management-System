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
    <title>Add Semester</title>
</head>
<body>
    <?php include '../include/teacher-sidebar.php'; ?>
    <section class="dashboard-middle-area">
        <h4 class="teacher-name">Hello, <?php echo $result['teacher_name']; ?></h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination"><p style="color: #1264a3;">Teacher / </p> <a href="dashboard.php" style="color: #1264a3;">Dashboard</a> / <a href="add-semester.php">Add Semester</a></pre> <hr>
        <div class="selection">
            <div class="select">
                <p>Select Course</p>
                <select name="course_name" id="course_name" class="edit-input ms-0">
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
                <p>Select Semester</p>
                <select name="semester" id="semester" class="edit-input ms-0">
                    <option value="">Semester</option>
                    <option value="all">Show All Students</option>
                    <option value="0">Semester - 0</option>
                    <?php
                        for($semester = 1; $semester <= 6; $semester++) {
                            echo "<option value='" . $semester . "'>Semester - " . $semester . "</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="student-profile mt-3" id="attendanceTableContainer">
        </div>
    </section>

    <script>
        // Only trigger updateTable when the semester selection changes
        document.getElementById('semester').addEventListener('change', updateTable);

        function updateTable() {
            var courseName = document.getElementById('course_name').value;
            var semester = document.getElementById('semester').value;
            var container = document.getElementById('attendanceTableContainer');

            // Only make the request if a course is selected AND a semester is selected
            if (courseName && semester) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        container.innerHTML = xhr.responseText;
                    }
                };
                xhr.open('GET', 'get_students.php?course_name=' + encodeURIComponent(courseName) + '&semester=' + encodeURIComponent(semester), true);
                xhr.send();
            } else {
                container.innerHTML = ''; // Clear the table if either is not selected
            }
        }

        // Optionally, you can add logic to clear the student table if the course is changed
        document.getElementById('course_name').addEventListener('change', function() {
            document.getElementById('attendanceTableContainer').innerHTML = '';
            // Optionally reset the semester dropdown to its default state
            document.getElementById('semester').value = '';
        });
    </script>
</body>
</html>