<?php 
    include '../sql/main_connection.php';

    session_start();

    // Check when form is submitted 
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $number = $_POST['number'];
        $password = $_POST['password'];

        $_SESSION['teacher_login_success'] = true;

        $_SESSION['number'] = $number;

        // Query to find the uid and password from database
        $sql = "SELECT * FROM `teacher_info` WHERE teacher_number = ? AND teacher_password = ?";

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
    <link rel="stylesheet" href="../styles/teacher-login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login Form</title>
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
            .admin-div i{
                font-size: 1em !important;
                color: #000;
            }
            .admin-div button{
                font-size: 1em !important;
                position: relative;
                left: -50px;
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
                font-size: 0.8em;
            }
            form .login-form-submit{
                margin-top: 0px;
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
                    <h4 class="admin-heading">Teacher Login Form</h4>
                </span>
            </div>
            <div class="col-lg-4">
                <span class="admin-div">
                    <a href="../admin/login.php"><button class="signup-btn"><i class="fa-duotone fa-solid fa-user me-2 fs-4" style="--fa-primary-color: #0d6ffd; --fa-secondary-color: #0d6ffd;"></i>Admin Login</button></a>
                </span>
            </div>
        </div>
    </nav>

    <header class="container-fluid px-3 py-4">
        <div class="row">
            <div class="col-lg-8 text-center">
                <h1 class="fw-semibold main-admin-heading">Teacher Login <br>Form</h1>
            </div>
            <div class="col-lg-4">
                <div class="login-form-conatiner ps-3">
                    <form method="POST">
                        <p class="text-center mb-4 mt-3 login-heading">Teacher Login</p>
                        <div class="inputs">
                            <input type="text" name="number" class="login_same" autocomplete="off" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10" class="same" placeholder="Enter your number" required> 
                            <input type="password" name="password" autocomplete="off" class="login_same" placeholder="Enter your password" required>
                            <a href="forget-password.php" class="forget-password same-link">Forget Password?</a>
                            <a href="../student/login.php" class="login-link same-link">You are student?</a>
                            <input type="submit" name="login" value="Login" class="same login-form-submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
</body>
</html>