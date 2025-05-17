<!-- Update Query  -->
<?php
    include '../include/admin_privacy.php';
    include '../sql/main_connection.php';

    error_reporting(0);
    $serial_no = $_GET['sr'];
    $data = mysqli_query($conn, "SELECT * FROM course_info where sr_no = '$serial_no'");
    $result = mysqli_fetch_assoc($data);

    // Store form data in session variables

    if (isset($_POST['update-detail'])) 
    {
        $semester = $_POST['semester'];
        $duration = $_POST['duration'];

        $_SESSION['semester'] = $semester;
        $_SESSION['duration'] = $duration;

        // Update Query 
        $query = mysqli_query($conn, "UPDATE `course_info` SET  `total_semester`='$semester', `course_duration`='$duration' WHERE sr_no='$serial_no'");

        if ($query) 
        {
            unset( $_SESSION['semester'], $_SESSION['duration']); // Clear session data after successful update
            echo "<script>alert('Update Success')</script>";
            echo "<script>window.open('manage-course.php', '_self')</script>";
            exit();
        } 
        else 
        {
            echo "<script>alert('Update Failed')</script>";
            echo "<script>window.open('manage-course.php', '_self')</script>";
            exit();
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
    <title>Edit Courses</title>
</head>
<body class="hide-overflow-section">
    <?php include '../include/admin-sidebar.php'; ?>

    <!-- Middle Section  -->
    <section class="dashboard-middle-area">
        <h4 class="admin-name">Hello, Admin</h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="../admin/logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination"><p style="color: #1264a3">Admin / </p> <p><a href="dashboard.php" style="color:#1264a3;">Dashboard</a> / </p> <p><a href="manage-course.php" style="color: #1264a3;">Manage Courses</a> / </p> <p>Edit Course Details</p></pre> <hr>
        <h4 class="update-heading">Update Details</h4>
        <div class="teacher-table">
            <form method="POST">
                <table class="table table-bordered">
                    <tr>
                        <th class="edit-heading" width="35%">Course Name</th>
                        <td><input type="text" disabled value="<?php echo $result['course_name']; ?>" autocomplete="off" class="edit-input respo-input" minlength="3" name="name"></td>
                    </tr>
                    <tr>
                        <th class="edit-heading">Total Semesters</th>
                        <td>
                            <select class="edit-input respo-input" name="semester">
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
                    <tr>
                        <th class="edit-heading" >Duration</th>
                        <td>
                            <select class="edit-input" name="duration">
                                <option value="1 Year">1 Year</option>
                                <option value="2 Year">2 Year</option>
                                <option value="3 Year">3 Year</option>
                                <option value="4 Year">4 Year</option>
                                <option value="5 Year">5 Year</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <input type="submit" value="Save Changes" onclick='return confirm("Are you sure to update values?")' name="update-detail" class="btn btn-primary">
            </form>
        </div>
    </section>
</body>
</html>