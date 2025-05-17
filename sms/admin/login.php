<!-- Code for admin login  -->
<?php 
    include '../sql/main_connection.php';
    
    session_start();
    
    // Check if form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $admin_uid = $_POST['uid'];
        $admin_password = $_POST['password'];

        $_SESSION['admin_login_success'] = true;

        // Query to find the uid and password from database
        $sql = "SELECT * FROM `admin_info` WHERE uid = ? AND password = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $admin_uid, $admin_password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Checking uid and password exist in database ??
        if($result->num_rows > 0) {
            echo "<script>window.open('../admin/dashboard.php', '_self')</script>";
            exit();
        }
        else {
            echo "<script>alert('Uid or Password is wrong. Try again')</script>";
            echo "<script>window.open('../admin/login.php', '_self')</script>";
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
    <link rel="stylesheet" href="../styles/admin_style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Form</title>
    <style>
        @media (max-width: 768px) {
            body{
                margin-top: 10px;
            }
            nav .sms{
                font-size: 1.2em !important;
                margin-left: -30px !important; 
                border-bottom: 2px solid red !important;
            }
            .logo-heading{
                font-size: 1.2em !important;
                font-weight: 600;
                margin-left: 70px !important;
                margin-bottom: 15px;
            }
            header{
                background:#fff;
            }
            nav .sms-heading{
                left: 50px !important;
                display: none;
            }
            .admin-form{
                border: 1px solid black !important;
                left: -70px !important;
                width: 270px !important;
                height: 250px !important;
                top: 0px !important;
                border-radius: 5px;
            }
            form .login-heading{
                color: #000 !important;
                font-size: 1.5em !important;
            }
            header .main-admin-heading{
                display: none;
            }
            .admin-form .form-control{
                font-size: 14px !important;
                height: 35px;
                width: 100%;
            }
            header .log-btn{
                font-size: 17px;
                font-weight: 600;
                letter-spacing: .6px;
                border: 1px solid #000;
                color: #000;
            }
            #navbarNavDropdown{
                margin: 0px !important;
                padding: 0px !important;
            }
            .dropdown-div{
                width: 80% !important;
                position: relative;
                left: -100px;
                top: 20px;
            }
            .dropdown-menu{
                position: relative !important;
                left: 100px !important;
                top: 15px !important;
            }
            .first-input{
                margin-top: 0px !important;
            }
            .dropdown-toggle{
                font-size: 1.1em !important;
            }
        }
    </style>
</head>
<body>
    <!-- top navbar  -->
    <nav class="navbar navbar-expand-lg border-bottom border-warning-subtle">
        <div class="container-fluid">
            <a class="navbar-brand text-center text-primary fs-4 me-5 ms-3 pe-4 logo-heading" href="">Bebe Nanki University<br> College, Mithra </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>   
            <p class="sms fs-2 fw-medium sms-heading me-4 pe-5">Student Management System</p>
            <div class="collapse navbar-collapse ps-5 ms-5" id="navbarNavDropdown">
                <ul class="navbar-nav ms-5">
                    <li class="nav-item dropdown dropdown-div">
                        <a class="nav-link nav-login-links dropdown-toggle fw-normal text-center text-primary ms-5 mt-1 px-4 border border-primary-subtle rounded-1" style="font-size :20px;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Click here for <br> Student login
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../student/signup.php">Student Sign Up</a></li>
                            <li><a class="dropdown-item border-bottom" style="height:40px" href="../student/login.php">Student Login In</a></li>
                            <li><a class="dropdown-item mt-2" href="../teacher/login.php">Teacher Login</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Middle Header -->
    <header class="px-3 py-4 middle-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 ps-3">
                    <h1 class="display-2 mt-4 fw-semibold text-center main-admin-heading" style="letter-spacing: 1px; line-height:1.5;">Admin Login Form</h1>
                </div>
                <div class="col-lg-6 ps-5">
                    <form method="POST" style="position: relative; left: 130px; top: 50px;" class="admin-form ms-5 border p-3">
                        <pre><h2 class="fw-semibold text-primary text-center text-white login-heading fs-1 mt-2 text-decoration-underline">Admin  Login</h2></pre>
                        <div class="mb-3 mt-5 first-input">
                            <input type="text" autocomplete="off" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="uid" maxlength="6" class="form-control sms-input" id="exampleFormControlInput1" required placeholder="Enter your uid">
                        </div>
                        <div class="mb-3 mt-4">             
                            <input type="password" name="password" class="form-control sms-input" requied id="exampleFormControlInput1" placeholder="Enter Password">
                        </div>
                        <div class="mb-3 mt-4">
                            <input type="submit" name="login" value="Log In" class="btn log-btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>