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
    <title>Student Profile</title>
</head>
<body>
    <?php include '../include/student-sidebar.php'; ?>

    <section class="dashboard-middle-area">
        <h4 class="student-name">Hello, <?php echo $result['student_name']; ?></h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination"><p style="color: #1264a3;">Student / </p> <a href="dashboard.php" style="color: #1264a3;">Dashboard</a> / <a href="profile.php">Student Profile</a></pre> <hr>
        <div class="edit-detail-link pt-2">
            <i class='fa-solid fa-pen-to-square pe-2'></i>
            <a href="edit-profile.php" style="color: #006bff">Edit Details</a>
        </div>

        <div class="student-profile">
            <table class="table table-bordered table-responsive">
                <tr>
                    <th class="student-heading" width="33%">Name:</th>
                    <td class="student-value"><?php echo $result['student_name']; ?></td>
                </tr>
                <tr>
                    <th class="student-heading">Father name:</th>
                    <td class="student-value"><?php echo $result['student_father_name']; ?></td>
                </tr>
                <tr>
                    <th class="student-heading">Number:</th>
                    <td class="student-value"><?php echo $result['student_number']; ?></td>
                </tr>
                <tr>
                    <th class="student-heading">Email:</th>
                    <td class="student-value"><?php echo $result['student_email']; ?></td>
                </tr>
                <tr>
                    <th class="student-heading">Course:</th>
                    <td class="student-value"><?php echo $result['student_course']; ?></td>
                </tr>
                <tr>
                    <th class="student-heading">DOB:</th>
                    <td class="student-value"><?php echo $result['student_dob']; ?></td>
                </tr>
                <tr>
                    <th class="student-heading">Address:</th>
                    <td class="student-value"><?php echo $result['student_address']; ?></td>
                </tr>
            </table>
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