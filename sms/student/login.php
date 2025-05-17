<?php 
    include '../sql/main_connection.php';

    session_start();

    // Check when form is submitted 
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $number = $_POST['number'];
        $password = $_POST['password'];

        $_SESSION['student_login_success'] = true;

        $_SESSION['number'] = $number;

        // Query to find the uid and password from database
        $sql = "SELECT * FROM `student_info` WHERE student_number = ? AND student_password = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $number, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Checking number and password exist in database??
        if($result->num_rows > 0) {
            echo "<script>window.open('dashboard.php', '_self')</script>";
            exit();
        }
        else {
            echo "<script>alert('Phone number or Password is wrong. Try again')</script>";
            echo "<script>window.open('login.php', '_self')</script>";
            exit();
        }

        $stmt->close();
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/links.php'; ?>
    <link rel="stylesheet" href="../styles/login-signup-style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login Form</title>
    <style>
        @media (max-width: 768px) {
            .logo-heading{
                font-size: 1.2em !important;
                font-weight: 600;
                margin-bottom: 15px;
            }
            .admin-heading{
                display: none;
            }
            .signup-div i{
                font-size: 1em !important;
                color: #000;
            }
            .signup-div button{
                font-size: 1em !important;
                position: relative;
                left: -10px;
                color: #000;
            }
            header{
                background:#fff;
            }
            header .main-admin-heading{
                display: none;
            }   
            header .login-form-conatiner{
                width: 100% !important;
                left: 0px !important; 
                top: -40px;
            }
            form .login-heading{
                color: #000 !important;
                font-size: 1.5em !important;
                color: #0d6ffd !important;
            } 
            form .login_same{
                font-size: 14px !important;
                height: 35px;
                width: 100%;
            }
            form .same-link{
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
    <nav class="container-fluid py-3 border-bottom">
        <div class="row">
            <div class="col-lg-4 text-start">
                <span class="text-center">
                    <h4 class="logo-heading text-primary">Bebe Nanaki University <br>College, Mithra</h4>
                </span>
            </div>
            <div class="col-lg-4">
                <span class="text-center admin-heading-div">
                    <h4 class="admin-heading">Student Login Form</h4>
                </span>
            </div>
            <div class="col-lg-4">
                <span class="signup-div">
                    <a href="signup.php"><button class="signup-btn"><i class="fa-duotone fa-solid fa-user me-2 fs-4" style="--fa-primary-color: #0d6ffd; --fa-secondary-color: #0d6ffd;"></i>Click here for Signup</button></a>
                </span>
            </div>
        </div>
    </nav>

    <header class="container-fluid px-3 py-4">
        <div class="row">
            <div class="col-lg-8 text-center">
                <h1 class="fw-semibold main-admin-heading">Student Login <br>Form</h1>
            </div>
            <div class="col-lg-4">
                <div class="login-form-conatiner ps-3">
                    <form method="POST">
                        <p class="text-center mb-4 mt-3 login-heading">Student Login</p>
                        <div class="inputs">
                            <input type="text" name="number" class="login_same" autocomplete="off" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10" class="same" placeholder="Enter your number" required> 
                            <input type="password" name="password" autocomplete="off" class="login_same" placeholder="Enter your password" required>
                            <a href="signup.php" class="admin-link same-link">Not have an account?</a>
                            <a href="../admin/login.php" class="login-link same-link">You are admin?</a>
                            <a href="forget-password.php" class="forget-password same-link">Forget Password?</a>
                            <a href="../teacher/login.php" class="teacher-link same-link">You are teacher?</a>
                            <input type="submit" name="login" value="Login" class="same login-form-submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
</body>
</html>