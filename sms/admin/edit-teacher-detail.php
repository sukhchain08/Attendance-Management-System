<!-- Update Query  -->
<?php
    include '../include/admin_privacy.php';
    include '../sql/main_connection.php';

    error_reporting(0);
    $serial_no = $_GET['sr'];
    $data = mysqli_query($conn, "SELECT * FROM teacher_info where sr_no = '$serial_no'");
    $result = mysqli_fetch_assoc($data);

    // Store form data in session variables
    if (isset($_POST['update-detail'])) 
    {
        $name = $_POST['name'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $address = $_POST['address'];

        $_SESSION['name'] = $name;
        $_SESSION['number'] = $number;
        $_SESSION['email'] = $email;
        $_SESSION['dob'] = $dob;
        $_SESSION['address'] = $address;

        if ($number != $result['teacher_number']) 
        
        {
            $check_number = "SELECT teacher_number FROM `teacher_info` WHERE teacher_number = '$number'";
            $number_result = $conn->query($check_number);

            if ($number_result->num_rows > 0) {
                echo "<script>alert('Phone Number is already exist! Try with different phone number')</script>";
                // Redirect without clearing the form data
                echo "<script>window.location.href='edit-teacher-detail.php?sr=$serial_no';</script>";  // Preserve sr_no
                exit();
            }
        }

        // Update Query 
        $is_update = mysqli_query($conn, "UPDATE `teacher_info` SET `teacher_name`='$name', `teacher_number`='$number', `teacher_email`='$email', `teacher_dob`='$dob', `teacher_address`='$address' WHERE sr_no='$serial_no'");

        if ($is_update) 
        {
            unset($_SESSION['name'], $_SESSION['number'], $_SESSION['email'],  $_SESSION['dob'], $_SESSION['address']); // Clear session data after successful update
            echo "<script>alert('Update Success')</script>";
            echo "<script>window.open('manage-teachers.php', '_self')</script>";
        } 
        else 
        {
            echo "<script>alert('Update Failed')</script>";
            echo "<script>window.open('manage-teachers.php', '_self')</script>";
            exit();
        }

        $update_number_from_attendance = mysqli_query($conn, "UPDATE `attendance` SET `teacher_number`='$number' WHERE teacher_number = '{$result['teacher_number']}'");
        if($update_number_from_attendance)
        {
            echo "<script>alert('Number Changed')</script>";
        }
        else
        {
            echo "Error: " . mysqli_error($conn);
        }
    } 

    else 
    {
    // This block is crucial. Fetch data only if form is not submitted.
        $query = "SELECT * FROM teacher_info where sr_no = '$serial_no'";
        $data = mysqli_query($conn, $query);
        $result = mysqli_fetch_assoc($data);

        // Populate session variables with existing data on initial load
        if (!isset($_SESSION['name'])) { // Only set if not already set by form submission.
            $_SESSION['name'] = $result['teacher_name'];
            $_SESSION['number'] = $result['teacher_number'];
            $_SESSION['email'] = $result['teacher_email'];
            $_SESSION['dob'] = $result['teacher_dob'];
            $_SESSION['address'] = $result['teacher_address'];
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
    <title>Edit Teacher Profile</title>
</head>
<body class="hide-overflow-section">
    <?php include '../include/admin-sidebar.php'; ?>

    <!-- Middle Section  -->
    <section class="dashboard-middle-area">
        <h4 class="admin-name">Hello, Admin</h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="../admin/logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination"><p style="color: #1264a3">Admin / </p> <p><a href="dashboard.php" style="color:#1264a3;">Dashboard</a> / </p> <p><a href="manage-teachers.php" style="color: #1264a3;">Manage Teachers</a> / </p> <p>Edit Teacher Details</p></pre> <hr>
        <h4 class="update-heading">Update Details</h4>
        <div class="teacher-table">
            <form method="POST">
                <table class="table table-bordered">
                    <tr>
                        <th class="edit-heading" width="35%">Name</th>
                        <td><input type="text" value="<?php echo $result['teacher_name']; ?>" autocomplete="off" class="edit-input" minlength="3" pattern="^[A-Za-z\s]+$" name="name"></td>
                    </tr>
                    <tr>
                        <th class="edit-heading">Number</th>
                        <td><input type="text" value="<?php echo $result['teacher_number']; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' autocomplete="off" class="edit-input" name="number" pattern="^[6-9][0-9]{9}$" minlength="10" maxlength="10"></td>
                    </tr>
                    <tr>
                        <th class="edit-heading">Email</th>
                        <td><input type="email" value="<?php echo $result['teacher_email']; ?>" autocomplete="off" class="edit-input" name="email"></td>
                    </tr>
                    <tr>
                        <th class="edit-heading">DOB</th>
                        <td><input value="<?php echo $result['teacher_dob']; ?>"class="edit-input" placeholder="Date of Birth" onfocus="(this.type='date')" onblur="if(!this.value) this.type='text'" name="dob"></td>
                    </tr>
                    <tr>
                        <th class="edit-heading">Address</th>
                        <td><input value="<?php echo $result['teacher_address']; ?>" name="address" class="edit-input" autocomplete="off"></td>
                    </tr>
                </table>
                <input type="submit" value="Save Changes" onclick='return confirm("Are you sure to update values?")' name="update-detail" class="btn btn-primary">
            </form>
        </div>
    </section>
</body>
</html>
