<?php   
    include '../include/admin_privacy.php';
    include '../sql/main_connection.php';

    if(isset($_POST['add-teacher']))
    {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $course = $_POST['course'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $address = $_POST['address'];

        $_SESSION['teacher_number'] = $number;

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $number_exists = false;

            // Check number
            $check_number = "SELECT teacher_number FROM `teacher_info` WHERE teacher_number = '$number'";
            $number_result = $conn->query($check_number);
            if($number_result->num_rows > 0) 
            {
                echo "<script>alert('Phone Number is already exist! Try with different phone number')</script>";
                echo "<script>window.open('add-teacher.php', '_self')</script>";
                $number_exists = true;
            }
    
            // Only insert if number are unique
            if (!$number_exists)
            {
                $result = mysqli_query($conn, "INSERT INTO `teacher_info`(`teacher_name`, `teacher_password`, `teacher_number`, `teacher_email`, `teacher_course`, `teacher_gender`, `teacher_dob`, `teacher_address`) VALUES ('$name', '$password', '$number', '$email', '$course', '$gender', '$dob', '$address')");
                if($result)
                {
                    echo "<script>alert('New teacher added Successfull')</script>";
                    echo "<script>window.open('dashboard.php', '_self')</script>";
                }
                else
                {
                    echo "Failed to add new teacher";
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
    <title>Add New Teacher</title>
</head>
<body>
    <?php include '../include/admin-sidebar.php'; ?>

    <section class="dashboard-middle-area">
        <h4 class="admin-name">Hello, Admin</h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="../admin/logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination"><p style="color: #1264a3;">Admin / </p> <p><a href="dashboard.php" style="color:#1264a3;">Dashboard</a> / </p> <a href="add-teacher.php">Add Teacher</a></pre> <hr>
        <p class="add-new-student">Add New Teacher</p>
        <div class="teacher-table">
            <form method="POST">
                <table class="table table-bordered">
                    <tr>
                        <th class="add-student-heading" width="33%">Name</th>
                        <td><input type="text" name="name" placeholder="Teacher Name" class="add-student-value" autocomplete="off" minlength="3" pattern="^[A-Za-z\s]+$" required></td>
                    </tr>
                    <tr>
                        <th class="add-student-heading">Password</th>
                        <td><input type="password" name="password" placeholder="Password for Teacher" class="add-student-value" minlength="6" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <th class="add-student-heading">Mobile Number</th>
                        <td><input type="text" name="number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10" placeholder="Mobile Number" class="add-student-value respo-input" pattern="^[6-9][0-9]{9}$" minlength="10" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <th class="add-student-heading">Email</th>
                        <td><input type="email" name="email" placeholder="Enter email address" class="add-student-value"  autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <th class="add-student-heading">Course</th>
                        <td>
                            <select name="course" class="add-student-value">
                                <option value="">Course Name</option>
                                <?php 
                                    include '../sql/main_connection.php';
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
                            <select name="gender" class="add-student-value" required>
                                <option value="">Gender</option>
                                <option value="Male">Male</option> 
                                <option value="Female">Female</option>
                            </select> 
                        </td>
                    </tr>
                    <tr>
                        <th class="add-student-heading">DOB</th>
                        <td><input class="add-student-value" placeholder="Date of Birth" onfocus="(this.type='date')" onblur="if(!this.value) this.type='text'" name="dob"></td>
                    </tr>
                    <tr>
                        <th class="add-student-heading">Address</th>
                        <td><input name="address" class="add-student-value" placeholder="Address" autocomplete="off"></td>
                    </tr>
                </table>
                <input type="submit" value="Create Account" name="add-teacher" class="btn btn-primary">
            </form>
        </div>
    </section>
</body>
</html>