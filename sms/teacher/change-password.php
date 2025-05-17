<?php 
    include '../include/teacher-privacy.php';
    include '../sql/main_connection.php';
    $teacher_number = $_SESSION['number'];
    
    // For show student name on the output screen 
    $data = mysqli_query($conn, "SELECT * FROM `teacher_info` WHERE teacher_number = '$teacher_number'");
    $result = mysqli_fetch_assoc($data);

    // if click on change password button 
    if(isset($_POST['change-password']))
    {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
 
        // select old password from the database 
        $old_password_result = mysqli_query($conn, "SELECT teacher_password FROM `teacher_info` WHERE teacher_number = $teacher_number");
        $old_password_row = mysqli_fetch_assoc($old_password_result);

        // if old password match in the database then this block execute 
        if($old_password_row['teacher_password'] == $old_password)
        {
            // if new password and confirm password match then this block execute 
            if($new_password == $confirm_password)
            {
                echo "<script>confirm('Are you sure to change password?')</script>";
                
                // Query for update password 
                $is_updated = mysqli_query($conn, "UPDATE `teacher_info` SET `teacher_password` = '$new_password' WHERE teacher_number='$teacher_number'");
                
                if($is_updated)
                {
                    echo "<script>alert('Password successfully changed')</script>";
                    echo "<script>window.open('dashboard.php', '_self')</script>";
                    exit();
                }
                else
                {
                    echo "<script>alert('Query Failed')</script>";
                    echo "<script>window.open('dashboard.php', '_self')</script>";
                    exit();
                }
            }
            else
            {
                echo "<script>alert('Confirm Password not match with new password')</script>";
                echo "<script>window.open('change-password.php', '_self')</script>";
                exit();
            }
        }
        else
        {
            echo "<script>alert('Current password not match with your password')</script>";
            echo "<script>window.open('change-password.php', '_self')</script>";
            exit();
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
    <title>Change Password</title>
</head>
<body>
    <?php include '../include/teacher-sidebar.php'; ?>

    <section class="dashboard-middle-area">
        <h4 class="teacher-name">Hello, <?php echo $result['teacher_name']; ?></h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination"><p style="color: #1264a3;">Teacher / </p> <a href="dashboard.php" style="color: #1264a3;">Dashboard</a> / <a href="change-password.php">Change Password</a></pre> <hr>
        <h4 class="update-password-heading py-2 text-end">Update Password</h4>
        <div class="update-password">
            <div class="left-img">
                <img src="../images/change_pass.jpg" class="img-fluid">
            </div>
            <div class="form border p-3">
                <form method="POST">
                    <p>Current Password</p>
                    <div class="input">
                        <i class="fa-solid fa-lock pe-1"></i><input type="password" name="old_password" class="password-input" placeholder="Current Password" required>
                    </div>
                    
                    <p>New Password</p>
                    <div class="input">
                        <i class="fa-solid fa-lock pe-1"></i><input type="password" minlength="6" name="new_password" class="password-input" placeholder="New Password" required>
                    </div>

                    <p>Confirm Password</p>
                    <div class="input">
                        <i class="fa-solid fa-lock pe-1"></i><input type="password" minlength="6" name="confirm_password" class="password-input" placeholder="Confirm Password" required>
                    </div>
                    <input type="submit" value="Change Password" name="change-password" class="btn btn-primary">
                </form>
            </div>
        </div>
    </section>
</body>
</html>