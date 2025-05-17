<?php 
    include '../include/admin_privacy.php';
    include '../sql/main_connection.php';

    // Show total number of registered students
    $student_data = mysqli_query($conn, "SELECT * FROM student_info");
    $total_student = mysqli_num_rows($student_data);

    // Show total number of course in the collage
    $course_data = mysqli_query($conn, "SELECT * FROM course_info");
    $total_course = mysqli_num_rows($course_data);

    // Show total number of teachers in field
    $teacher_data = mysqli_query($conn, "SELECT * FROM teacher_info");
    $total_teacher = mysqli_num_rows($teacher_data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/links.php'; ?>
    <link rel="stylesheet" href="../styles/admin_dashboard.css">
    <link rel="stylesheet" href="admin-responsive.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body class="hide-overflow-section">
    <?php include '../include/admin-sidebar.php'; ?>

    <section class="dashboard-middle-area">
        <h4 class="admin-name">Hello, Admin</h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="../admin/logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination pb-3"><pb style="color:#1264a3;">Admin / </pb> <a href="dashboard.php">Dashboard</a></pre> <hr>
        <div class="admin-divs-container">
            <a href="total-students.php" class="linkss">
                <div class="same-div">
                    <div class="left" style="background-color: #0b97bb;">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div class="right">
                        <h5>Total Student<br><b><?php echo $total_student; ?></b></h5>
                    </div>
                </div>
            </a>
            <a href="manage-students.php" class="linkss">
                <div class="same-div">
                    <div class="left" style="background-color: #e64846;">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="right">
                        <h5>Manage <br> Students</h5>
                    </div>
                </div>
            </a>
            <a href="add-student.php" class="linkss">
                <div class="same-div">
                    <div class="left" style="background-color: #1f9544;">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div class="right">
                        <h5>Add <br>Student</h5>
                    </div>
                </div>
            </a>
            <a href="total-teachers.php" class="linkss">
                <div class="same-div">
                    <div class="left" style="background-color: #B771E5;">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <div class="right">
                        <h5>Total Teachers<br> <b><?php echo $total_teacher; ?></b> </h5>
                    </div>
                </div>
            </a>
            <a href="manage-teachers.php" class="linkss">
                <div class="same-div">
                    <div class="left" style="background-color: #FCC737;">
                        <i class="fa-solid fa-edit"></i>
                    </div>
                    <div class="right">
                        <h5>Manage<br>Teachers</h5>
                    </div>
                </div>
            </a>
            <a href="add-teacher.php" class="linkss">
                <div class="same-div">
                    <div class="left" style="background-color: #0D92F4;">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div class="right">
                        <h5>Add<br>Teacher</h5>
                    </div>
                </div>
            </a>
            <a href="total-course.php" class="linkss">
                <div class="same-div">
                    <div class="left" style="background-color: #D91656;">
                        <i class="fa-solid fa-file"></i>
                    </div>
                    <div class="right">
                        <h5>Total Course<br> <b><?php echo $total_course; ?></b> </h5>
                    </div>
                </div>
            </a>
            <a href="manage-course.php" class="linkss">
                <div class="same-div">
                    <div class="left" style="background-color: #640D5F;">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div class="right">
                        <h5>Manage<br>Course</h5>
                    </div>
                </div>
            </a>
            <a href="add-course.php" class="linkss">
                <div class="same-div">
                    <div class="left" style="background-color: brown;">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div class="right">
                        <h5>Add<br>Course</h5>
                    </div>
                </div>
            </a>
            <a href="add-subject.php" class="linkss add-subject" style="display: none">
                <div class="same-div">
                    <div class="left" style="background-color: brown;">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <div class="right">
                        <h5>Add<br>Subject</h5>
                    </div>
                </div>
            </a>
        </div>
        <footer class="footer-col" style="display: none;">
            <h4>Develop by <b> Sukhchain Singh</b></h4>
            <div class="social-links">
                <a href=""><i class="fa-brands fa-whatsapp" style="color: #fff;"></i></a>
                <a href="https://www.instagram.com/its.sukhchain08"><i class="fa-brands fa-instagram" style="color: #fff;"></i></a>
            </div>
        </footer>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>