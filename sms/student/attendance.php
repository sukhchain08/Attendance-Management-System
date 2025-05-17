<?php
    include '../include/student-privacy.php';
    include '../sql/main_connection.php';
    $student_number = $_SESSION['number'];

    // Student information query
    $data = mysqli_query($conn, "SELECT * FROM `student_info` WHERE student_number = '$student_number'");
    $result = mysqli_fetch_assoc($data);
    $student_name = $result['student_name'];

    $attendanceMessage = ""; // Default message
    $attendanceData = null;  // Default attendance data

    if (isset($_POST['submit_date'])) 
    {
        // Retrieve selected date from the form
        $selected_date = $_POST['attendance_date'];

        // Query to check if attendance exists for the selected date
        $attendance_query = mysqli_query($conn, "SELECT * FROM `attendance` WHERE student_number = '$student_number' AND date = '$selected_date'");

        if (mysqli_num_rows($attendance_query) > 0) 
        {
            // If attendance exists, fetch the data
            $attendanceData = mysqli_fetch_assoc($attendance_query);
        } 
        else 
        {
            // If no attendance data exists for the selected date
            $attendanceMessage = "No attendance for this date.";
        }
    }

    // For calculate total percentage of the student based on the attend classes
    // Calculate total number of status rows
    $attendance = mysqli_query($conn, "SELECT `status` FROM `attendance` WHERE student_number = '$student_number' AND  status = 'Present'");
    $present_row = mysqli_num_rows($attendance);
    
    // Calculate total number of rows
    $total_attendance = mysqli_query($conn, "SELECT * FROM `attendance` WHERE student_number = '$student_number'");
    $total_present_row = mysqli_num_rows($total_attendance);

    if($total_present_row == 0)
    {      
        echo "<script>alert('Attendance not find. Try Again later')</script>";
        echo "<script>window.open('dashboard.php', '_self')</script>";
        exit();
    }
    else
    {
        $total_attendance = $present_row / $total_present_row * 100;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/links.php'; ?>
    <link rel="stylesheet" href="../styles/student-dashboard-style.css">
    <link rel="stylesheet" href="student-responsive.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
</head>
<body>
    <?php include '../include/student-sidebar.php'; ?>

    <section class="dashboard-middle-area">
        <h4 class="student-name">Hello, <?php echo $result['student_name']; ?></h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination"><p style="color: #1264a3;">Student / </p> <a href="dashboard.php" style="color: #1264a3;">Dashboard</a> / <a href="attendance.php">Attendance</a></pre> <hr>
        <span class="update-heading"> Your Attendance</span>
        <b><span class="attendance-perc fs-4">Percentage: <?php echo number_format($total_attendance, 2) . ' %'; ?></b></span> <br><br>
        <div class="attendance-detail">
            <form method="POST">
                <label class="fs-5">Select Date:</label>
                <input type="date" id="attendanceDate" name="attendance_date" class="edit-input ms-0 mt-2" required>
                <button type="submit" name="submit_date" class="btn btn-primary mt-4">Check Attendance</button>
            </form>
        </div>

        <?php if ($attendanceMessage): ?>
            <div class="alert alert-warning mt-4" style="width: 300px; position: relative; top: 20px;">
                <?php echo $attendanceMessage; ?>
            </div>
        <?php elseif ($attendanceData): ?>
            <div class="attendance-info mt-4">
                <p><strong>Attendance for <?php echo $selected_date; ?>:</strong></p>
                <p>Status: <b> <?php echo $attendanceData['status']; ?> </b><!-- You can replace this with your actual attendance status column --> </p>
            </div>
        <?php endif; ?>
    </section>
</body>
</html>