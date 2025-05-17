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
    <title>Teacher Dashboard</title>
</head>
<body>
    <?php include '../include/teacher-sidebar.php'; ?>

    <section class="dashboard-middle-area">
        <h4 class="teacher-name">Hello, <?php echo $result['teacher_name'] ?></h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination"><p style="color:#1264a3;">Teacher / </p> <a href="dashboard.php">Dashboard</a></pre> <hr>
        <div class="main-container">
            <span class="respo-dashboard-link mb-3">
                <a href="profile.php" class="linkss">
                    <div class="teacher-container">
                        <div class="top">
                            <p>Welcome, <?php echo $result['teacher_name']; ?></p>
                        </div> 
                        <div class="bottom">
                            <p>View Profile</p>
                            <p> > </p>
                        </div>
                    </div>
                </a>
            </span>
            <span class="respo-dashboard-link mb-3">
                <a href="add-attendance.php" class="linkss">
                    <div class="teacher-container">
                        <div class="top" style="background-color:rgb(189, 130, 85)">
                            <p>Attendance</p>
                        </div> 
                        <div class="bottom" style="background-color: #B17F59">
                            <p>Add Attendance</p>
                            <p> > </p>
                        </div>
                    </div>
                </a>
            </span>
            <span class="respo-dashboard-link mb-3" style="display: none;">
                <a href="check-attendance.php" class="linkss">
                    <div class="teacher-container">
                        <div class="top" style="background-color: #48A6A7">
                            <p>Check Attendance</p>
                        </div> 
                        <div class="bottom" style="background-color:rgb(44, 144, 146)">
                            <p>Click Here</p>
                            <p> > </p>
                        </div>
                    </div>
                </a>
            </span>
            <span class="respo-dashboard-link mb-3" style="display: none;">
                <a href="add-semester.php" class="linkss">
                    <div class="teacher-container">
                        <div class="top" style="background-color: #8F87F1">
                            <p>Add Student's Semester</p>
                        </div> 
                        <div class="bottom" style="background-color:rgb(119, 109, 223)">
                            <p>Click Here</p>
                            <p> > </p>
                        </div>
                    </div>
                </a>
            </span>
            <span class="respo-dashboard-link mb-3" style="display: none;">
                <a href="change-password.php" class="linkss">
                    <div class="teacher-container">
                        <div class="top" style="background-color: #205781">
                            <p>Change Password</p>
                        </div> 
                        <div class="bottom" style="background-color:rgb(20, 79, 124)">
                            <p>Click Here</p>
                            <p> > </p>
                        </div>
                    </div>
                </a>
            </span>
        </div>
        <footer class="footer-col" style="display: none;">
            <h4>Develop by <b> Sukhchain Singh</b></h4>
            <div class="social-links">
                <a href=""><i class="fa-brands fa-whatsapp" style="color: #fff;"></i></a>
                <a href="https://www.instagram.com/its.sukhchain08"><i class="fa-brands fa-instagram" style="color: #fff;"></i></a>
            </div>
        </footer>
    </section>
</body>
</html>