<?php 
    include '../include/admin_privacy.php';
    include '../sql/main_connection.php';

    if(isset($_POST['add-course']))
    {
        $name = $_POST['name'];
        $duration = $_POST['duration'];
        $semester = $_POST['semester'];

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $course_exists = false;

            // Check number
            $check_course = "SELECT course_name FROM `course_info` WHERE course_name = '$name'";
            $course_result = $conn->query($check_course);
            if($course_result->num_rows > 0) 
            {
                echo "<script>alert('Course is already exist! Choose different course')</script>";
                echo "<script>window.open('add-course.php', '_self')</script>";
                $course_exists = true;
            }
    
            // Only insert if number are unique
            if (!$course_exists)
            {
                $result = mysqli_query($conn, "INSERT INTO `course_info`(`course_name`, `total_semester`, `course_duration`) VALUES ('$name', '$semester', '$duration')");
                if($result)
                {
                    echo "<script>alert('New course added Successfull')</script>";
                    echo "<script>window.open('dashboard.php', '_self')</script>";
                }
                else
                {
                    echo "Failed to add new course";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/links.php'; ?>
    <link rel="stylesheet" href="../styles/admin_dashboard.css">
    <link rel="stylesheet" href="admin-responsive.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Course</title>
</head>
<body class="hide-overflow-section">
    <?php include '../include/admin-sidebar.php'; ?>

    <section class="dashboard-middle-area">
        <h4 class="admin-name">Hello, Admin</h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="../admin/logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination"><p style="color: #1264a3;">Admin / </p> <p><a href="dashboard.php" style="color:#1264a3;">Dashboard</a> / </p> <a href="add-teacher.php">Add Course</a></pre> <hr>
        <p class="add-new-student">Add New Course</p>
        <div class="teacher-table">
            <form method="POST">
                <table class="table table-bordered">
                    <tr>
                        <th class="add-student-heading" width="33%">Course Name</th>
                        <td><input type="text" name="name" placeholder="Enter Course Name" class="add-student-value respo-input" autocomplete="off" minlength="3" required></td>
                    </tr>
                    <tr>
                        <th class="add-student-heading">Duration</th>
                        <td>
                            <select name="duration" class="add-student-value" required>
                                <option value="">Duration</option>
                                <option value="1 year">1 Year</option> 
                                <option value="2 year">2 Year</option>
                                <option value="3 year">3 Year</option>
                                <option value="4 year">4 Year</option>
                                <option value="5 year">5 Year</option>
                            </select> 
                        </td>
                    </tr>
                    <tr>
                        <th class="add-student-heading">Total Semesters</th>
                        <td>
                            <select name="semester" class="add-student-value" required>
                                <option value="">Total Semester</option>
                                <option value="2">2</option> 
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select> 
                        </td>
                    </tr>
                </table>
                <input type="submit" value="Create Course" name="add-course" class="btn btn-primary">
            </form>
        </div>
    </section>
</body>
</html>