<?php 
    include '../include/admin_privacy.php';
    include '../sql/main_connection.php';

    if(isset($_POST['add-student']))
    {
        $student_name = $_POST['student_name'];
        $student_password = $_POST['student_password'];
        $student_course = $_POST['student_course'];
        $student_number = $_POST['student_number'];
        $father_name = $_POST['father_name'];
        $student_gender = $_POST['student_gender'];
        $address = $_POST['address'];

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $number_exists = false;

            // Check number
            $check_number = "SELECT student_number FROM `student_info` WHERE student_number = '$student_number'";
            $number_result = $conn->query($check_number);
            if($number_result->num_rows > 0) 
            {
                echo "<script>alert('Phone Number is already exist! Try with different phone number')</script>";
                echo "<script>window.open('add-student.php', '_self')</script>";
                $number_exists = true;
            }
    
            // Only insert if number are unique
            if (!$number_exists)
            {
                $result = mysqli_query($conn, "INSERT INTO `student_info`(`student_name`, `student_password`, `student_course`,`student_number`, `student_father_name`, `student_gender`, `student_address`) VALUES ('$student_name', '$student_password', '$student_course', '$student_number',  '$father_name', '$student_gender', '$address')");
                if($result)
                {
                    echo "<script>alert('New student added Successfully')</script>";
                    echo "<script>window.open('dashboard.php', '_self')</script>";
                }
                else
                {
                    echo "<script>alert('Failed to add new student')</script>";
                    echo "<script>window.open('add-student.php', '_self')</script>";
                }
            }
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
    <title>Add New Student</title>
</head>
<body class="hide-overflow-section">
    <?php include '../include/admin-sidebar.php'; ?>

    <section class="dashboard-middle-area">
        <h4 class="admin-name">Hello, Admin</h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="../admin/logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination"><p style="color: #1264a3;">Admin / </p> <p><a href="dashboard.php" style="color:#1264a3;">Dashboard</a> / </p> <a href="add-student.php">Add New Student</a></pre> <hr>
        <p class="add-new-student">Add New Student</p>
        <div class="student-table">
            <form method="POST">
                <table class="table table-bordered">
                    <tr>
                        <th class="add-student-heading" width="33%">Name</th>
                        <td><input type="text" name="student_name" placeholder="Student Name" class="add-student-value" autocomplete="off" minlength="3" pattern="^[A-Za-z\s]+$" required></td>
                    </tr>
                    <tr>
                        <th class="add-student-heading">Password</th>
                        <td><input type="password" name="student_password" placeholder="Password for Student" class="add-student-value" minlength="6" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <th class="add-student-heading">Mobile Number</th>
                        <td><input type="text" name="student_number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10" placeholder="Phone Number" class="add-student-value respo-input" pattern="^[6-9][0-9]{9}$" minlength="10" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <th class="add-student-heading">Father's Name</th>
                        <td><input type="text" name="father_name" placeholder="Father's Name" class="add-student-value respo-input" minlength="3" autocomplete="off" required></td>
                    </tr>
                    
                    <tr>
                        <th class="add-student-heading">Course</th>
                        <td>
                            <select name="student_course" class="add-student-value" required>
                                <option value="">Course Name</option>
                                <?php 
                                    $query = "SELECT * FROM course_info";
                                    $data = mysqli_query($conn, $query);
                                    $total = mysqli_num_rows($data);

                                    if($total != 0)
                                    {
                                        // Odo tak while loop chale jado tak record khatam ni ho jande
                                        while($result = mysqli_fetch_assoc($data))   
                                        {
                                            echo 
                                            "
                                                <option>".$result['course_name']."</option>
                                            ";
                                        }
                                    }
                                ?>
                            </select>           
                        </td>
                    </tr>
                    <tr>
                        <th class="add-student-heading">Gender</th>
                        <td>
                            <select name="student_gender" class="add-student-value" required>
                                <option value="">Gender</option>
                                <option value="Male">Male</option> 
                                <option value="Female">Female</option>
                            </select> 
                        </td>
                    </tr>
                    <tr>
                        <th class="add-student-heading">Address</th>
                        <td><input type="text" name="address" placeholder="Enter Address" class="add-student-value"  autocomplete="off" required></td>
                    </tr>
                </table>
                <input type="submit" value="Create Account" name="add-student" class="btn btn-primary">
            </form>
        </div>
    </section>
</body>
</html>