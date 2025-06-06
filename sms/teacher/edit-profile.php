<?php
    include '../include/teacher-privacy.php';
    include '../sql/main_connection.php';
    $teacher_number = $_SESSION['number'];

    $data = mysqli_query($conn, "SELECT * FROM `teacher_info` WHERE teacher_number = '$teacher_number'");
    $result = mysqli_fetch_assoc($data);

    if (isset($_POST['update-detail'])) {
        $number = $_POST['number'];
        $email = $_POST['email'];

        // Check if the phone number has changed
        if ($number != $result['teacher_number']) // Important comparison!
        { 
            // Only if the number changed, perform the duplicate check
            $check_number = "SELECT teacher_number FROM `teacher_info` WHERE teacher_number = '$number'";
            $number_result = $conn->query($check_number);

            if ($number_result->num_rows > 0) 
            {
                echo "<script>alert('Phone Number is already exist! Try with different phone number')</script>";
                echo "<script>window.open('edit-profile.php', '_self')</script>";
                exit(); // Stop processing to prevent the update
            }
        }

        // If the number is the same OR the number is new and doesn't exist, proceed with the update
        $is_update = mysqli_query($conn, "UPDATE `teacher_info` SET `teacher_number`='$number', `teacher_email`='$email' WHERE teacher_number='$teacher_number'");

        if ($is_update) 
        {
            $_SESSION['number'] = $number; // Update session only after successful database update
            echo "<script>alert('Update Success')</script>";
            echo "<script>window.open('profile.php', '_self')</script>";
        } 
        else 
        {
            echo "<script>alert('Update Failed')</script>";
            echo "<script>window.open('profile.php', '_self')</script>";
            exit();
        }

        $update_number_from_attendance = mysqli_query($conn, "UPDATE `attendance` SET `teacher_number`='$number' WHERE teacher_number = '$teacher_number'");
        if($update_number_from_attendance)
        {
            echo "<script>alert('Number Changed')</script>";
        }
        else
        {
            echo "Error: " . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/links.php'; ?>
    <link rel="stylesheet" href="../styles/teacher-dashboard-style.css">
    <link rel="stylesheet" href="teacher-responsive.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <?php include '../include/teacher-sidebar.php'; ?>

    <section class="dashboard-middle-area">
        <h4 class="teacher-name">Hello, <?php echo $result['teacher_name']; ?></h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination"><p style="color: #1264a3;">Teacher / </p> <a href="dashboard.php" style="color: #1264a3;">Dashboard</a> / <a href="profile.php" style="color: #1264a3;">Teacher Profile</a> / <a href="edit-profile.php">Edit Profile</a></pre> <hr>
        <h4 class="update-heading py-2">Update Details</h4>
        
        <div class="student-profile">
            <form method="POST">
                <table class="table table-bordered">
                    <tr>
                        <th class="edit-heading" width="33%">Name</th>
                        <td><input type="text" readonly value="<?php echo $result['teacher_name']; ?>" autocomplete="off" class="edit-input" name="name" minlength="3" pattern="^[A-Za-z\s]+$"></td>
                    </tr>
                    <tr>
                        <th class="edit-heading" width="33%">Number</th>
                        <td><input type="text" value="<?php echo $result['teacher_number']; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' autocomplete="off" class="edit-input" name="number" pattern="^[6-9][0-9]{9}$" minlength="10" maxlength="10"></td>
                    </tr>
                    <tr>
                        <th class="edit-heading" width="33%">Email</th>
                        <td><input type="email" value="<?php echo $result['teacher_email']; ?>" autocomplete="off" class="edit-input" name="email"></td>
                    </tr>
                    <tr>
                        <th class="edit-heading" width="33%">Course</th>
                        <td><input type="text" value="<?php echo $result['teacher_course']; ?>" autocomplete="off" class="edit-input" name="email" disabled></td>
                    </tr>
                    <tr>
                        <th class="edit-heading" width="33%">DOB</th>
                        <td><input type="text" value="<?php echo $result['teacher_dob']; ?>" onfocus="(this.type='date')" onblur="if(!this.value) this.type='text'" autocomplete="off" class="edit-input" name="dob" disabled></td>
                    </tr>
                    <tr>
                        <th class="edit-heading" width="33%">Address</th>
                        <td><input type="text" value="<?php echo $result['teacher_address']; ?>" autocomplete="off" class="edit-input" name="address" disabled></td>
                    </tr>
                </table>
                <input type="submit" value="Save Changes" onclick="return confirm('Are you sure to update details?')" name="update-detail" class="btn btn-primary">
            </form>
        </div>        
    </section>  
</body>
</html>
