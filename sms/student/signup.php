<?php 
    include '../sql/main_connection.php';

    // when click on submit
    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $father_name = $_POST['father_name'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $course = $_POST['course'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $alt_number = $_POST['alt_number'];
    
        // Check email address or phone number is alraedy eist or not?
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $number_exists = false;
    
            // Check number
            $check_number = "SELECT student_number FROM `student_info` WHERE student_number = '$number'";
            $number_result = $conn->query($check_number);
            if($number_result->num_rows > 0) 
            {
                echo "<script>alert('Phone Number is already exist! Try with different phone number')</script>";
                echo "<script>window.open('signup.php', '_self')</script>";
                $number_exists = true;
            }
    
            // Only insert if number are unique
            if (!$number_exists) 
            {
                $result = mysqli_query($conn, "INSERT INTO `student_info`(`student_name`, `student_father_name`, `student_number`, `student_email`, `student_password`, `student_course`, `student_dob`, `student_gender`, `student_address`, `student_alt_number`) VALUES ('$name','$father_name','$number','$email','$password','$course','$dob','$gender','$address','$alt_number')");
    
                if($result) 
                {
                    echo "<script>alert('Signup Success😊,  Click Ok to Login')</script>";
                    echo "<script>window.open('login.php', '_self')</script>";
                    exit(); 
                } 
                else 
                {
                    echo "Query Failed: " . mysqli_error($conn); 
                }
            } 
            else 
            {
                echo "<script>window.open('signup.php', '_self')</script>"; // Redirect even if only one exists.
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/links.php'; ?>
    <link rel="stylesheet" href="../styles/login-signup-style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Sign Up Form</title>
    <style>
        @media (max-width: 768px) { 
            .logo-heading{
                font-size: 1.2em !important;
                font-weight: 600;
                margin-bottom: 15px;
                position: relative;
                left: 25px !important;
            }
            .admin-heading{
                display: none;
            }
            .login-div i{
                font-size: 1em !important;
                color: #000;
            }
            .login-div button{
                font-size: 1em !important;
                position: relative;
                left: -30px;
                color: #000;
            }
            header{
                background: #fff;
            }
            header .main-admin-heading{
                display: none;
            } 
            form .login-heading{
                color: #000 !important;
                font-size: 1.5em !important;
                color: #0d6ffd !important;
            } 
            header .form-conatiner{
                width: 350px !important;
                left: 0px !important; 
                top: 0px;
            }
            form .same{
                font-size: 14px !important;
                height: 35px;
                width: 43%;
            }
            form .form-submit{
                width: 100% !important;
                font-weight: 600 !important;
                font-size: 16px !important;
                padding: 0px !important;
            }
            form .same-link{
                font-size: 0.9em;
                position: relative;
            }
            form .signup-login-link{
                top: -20px !important;
                left: 45px !important;
            }
        }
    </style>
</head>
<body style="overflow:hidden;">
    <!-- Top nav -->
    <nav class="container-fluid py-3 border-bottom">
        <div class="row">
            <div class="col-lg-4 text-start">
                <span class="text-center">
                    <h4 class="logo-heading text-primary">Bebe Nanaki University <br>College, Mithra</h4>
                </span>
            </div>
            <div class="col-lg-4">
                <span class="text-center admin-heading-div">
                    <h4 class="admin-heading">Student Sign up Form</h4>
                </span>
            </div>
            <div class="col-lg-4">
                <span class="login-div ms-5">
                    <a href="../teacher/login.php"><button class="login-btn"><i class="fa-duotone fa-solid fa-user me-2 fs-4" style="--fa-primary-color: #0d6ffd; --fa-secondary-color: #0d6ffd;"></i>Teacher Login</button></a>
                </span>
            </div>
        </div>
    </nav>

    <!-- Middle header -->
    <header class="container-fluid px-3 py-4">
        <div class="row">
            <div class="col-lg-8 text-center">
                <h1 class="display-1 fw-semibold main-admin-heading">Student Signup <br> Form</h1>
            </div>
            <div class="col-lg-4">
                <div class="form-conatiner ps-3">
                    <form method="post">
                        <p class="text-center mb-4 mt-3 login-heading">Student Signup</p>
                        <div class="inputs">
                            <input type="text" name="name" minlength="3" autocomplete="off" pattern="^[A-Za-z\s]+$" class="same" placeholder="Enter Full name" required>
                            <input type="text" autocomplete="off" name="father_name" class="same" placeholder="Enter Father name" required>
                            <input type="text" autocomplete="off" name="number" class="same" pattern="^[6-9][0-9]{9}$" minlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10" class="same" placeholder="Enter Number" required> 
                            <input type="email" autocomplete="off" name="email" class="same" placeholder="Enter Email" required>
                            <input type="password" name="password" minlength="6" class="same" placeholder="Enter Password" required>
                            <select name="course" class="same" required>
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
                            <input type="text" name="dob" class="same" placeholder="Date of Birth" onfocus="(this.type='date')" onblur="if(!this.value) this.type='text'">
                            <select name="gender" class="same" id="course" required>
                                <option value="">Gender</option>
                                <option value="Male">Male</option> 
                                <option value="Female">Female</option>
                            </select>
                            <input type="text" autocomplete="off" name="address" class="same" placeholder="Enter Address" required>
                            <input type="text" autocomplete="off" name="alt_number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10" class="same" placeholder="Enter Alternate Number" required>    
                            <a href="../admin/login.php" class="admin-link same-link">You are admin?</a>
                            <a href="login.php" class="signup-login-link same-link">Already have a account?</a>
                            <input type="submit" name="submit" value="Submit Here" class="same form-submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>