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
    <title>Teacher Profile</title>
</head>
<body>
    <?php include '../include/teacher-sidebar.php'; ?>

    <section class="dashboard-middle-area">
        <h4 class="teacher-name">Hello, <?php echo $result['teacher_name']; ?></h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination"><p style="color: #1264a3;">Teacher / </p> <a href="dashboard.php" style="color: #1264a3;">Dashboard</a> / <a href="profile.php">Teacher Profile</a></pre> <hr>
        <div class="edit-detail-link pt-2">
            <i class='fa-solid fa-pen-to-square pe-2'></i>
            <a href="edit-profile.php" style="color: #006bff">Edit Details</a>
        </div>

        <div class="student-profile">
            <table class="table table-bordered">
                <tr>
                    <th class="student-heading" width="33%">Name:</th>
                    <td class="student-value"><?php echo $result['teacher_name']; ?></td>
                </tr>
                <tr>
                    <th class="student-heading">Number:</th>
                    <td class="student-value"><?php echo $result['teacher_number']; ?></td>
                </tr>
                <tr>
                    <th class="student-heading">Email:</th>
                    <td class="student-value"><?php echo $result['teacher_email']; ?></td>
                </tr>
                <tr>
                    <th class="student-heading">Course:</th>
                    <td class="student-value"><?php echo $result['teacher_course']; ?></td>
                </tr>
                <tr>
                    <th class="student-heading">DOB:</th>
                    <td class="student-value"><?php echo $result['teacher_dob']; ?></td>
                </tr>
                <tr>
                    <th class="student-heading">Address:</th>
                    <td class="student-value"><?php echo $result['teacher_address']; ?></td>
                </tr>
            </table>
        </div>
    </section>
</body>
</html>