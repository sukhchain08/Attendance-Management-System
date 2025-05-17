<?php 
    include '../include/student-privacy.php';
    include '../sql/main_connection.php';

    $student_number = $_SESSION['number'];

    $data = mysqli_query($conn, "SELECT * FROM `student_info` WHERE student_number = '$student_number'");
    $result = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/links.php'; ?>
    <link rel="stylesheet" href="../styles/student-dashboard-style.css">
    <link rel="stylesheet" href="student-responsive.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
</head>
<body>
    <?php include '../include/student-sidebar.php'; ?>

    <section class="dashboard-middle-area">

        <h4 class="student-name">Hello, <?php echo $result['student_name']; ?></h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination"><p style="color:#1264a3;">Student / </p> <a href="dashboard.php">Dashboard</a></pre> <hr>
        
        <div style="display: flex; flex-wrap: wrap;">
            <!-- Profile Div  -->
            <span class="respo-dashboard-link mb-3 pe-5">
                <a href="profile.php" class="linkss">
                    <div class="student-container">
                        <div class="top">
                            <p>Welcome, <?php echo $result['student_name']; ?></p>
                        </div> 
                        <div class="bottom">
                            <p>View Profile</p>
                            <p> > </p>     
                        </div>
                    </div>
                </a>
            </span>
            <!-- Change Password Div  -->
            <span class="respo-dashboard-link mb-3 pe-5" style="display: none;">
                <a href="change-password.php" class="linkss">
                    <div class="student-container">
                        <div class="top" style="background-color:rgb(122, 28, 28)">
                            <p>Change Password</p>
                        </div> 
                        <div class="bottom" style="background-color:rgb(133, 29, 29)">
                            <p>Click Here</p>
                            <p> > </p>
                        </div>
                    </div>
                </a>
            </span>
            <!-- Check Attendance Div -->
            <span class="respo-dashboard-link pe-5" style="display: none;">
                <a href="attendance.php" class="linkss">
                    <div class="student-container">
                        <div class="top" style="background-color:rgb(17, 114, 48)">
                            <p>Check Attendance</p>
                        </div> 
                        <div class="bottom" style="background-color:rgb(29, 139, 64)">
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
</html>