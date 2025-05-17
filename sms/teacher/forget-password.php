<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/links.php' ?>
    <link rel="stylesheet" href="../styles/forget-password.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
</head>
<body>
    <h1>Forget Password</h1>
    <div class="form">
        <form method="POST">
            <p>Enter Mobile Number</p>
            <div class="input-div">
                <i class="fa-solid fa-lock"></i><input type="text" name="number" autocomplete="off" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10" placeholder="Enter your number" required>
            </div>

            <p>Enter Email Address</p>
            <div class="input-div">
                <i class="fa-solid fa-lock"></i><input type="email" name="email" placeholder="Enter your email" autocomplete="off">
            </div>

            <p>Enter Date of Birth</p>
            <div class="input-div">
                <i class="fa-solid fa-lock"></i><input type="text" name="dob" placeholder="Date of Birth" onfocus="(this.type='date')" onblur="if(!this.value) this.type='text'" required>
            </div>

            <input type="submit" value="Verify Details" name="get-password" class="btn btn-primary same">   
            <div class="mb-2"><a href="login.php" class="mb-3">Click here for login</a></div>
        </form>
        <?php 
            include '../sql/main_connection.php';
            error_reporting(0);

            if(isset($_POST['get-password']))
            {
                $number = $_POST['number'];
                $email = $_POST['email'];
                $dob = $_POST['dob'];

                $query = mysqli_query($conn, "SELECT * FROM `teacher_info` WHERE teacher_number = '$number'");
                $result = mysqli_fetch_assoc($query);

                // it execute when number is correct 
                if($result['teacher_number'] == $number)
                {
                    // it execute when email address is correct 
                    if($result['teacher_email'] == $email)
                    {
                        // it execute when dob is correct 
                        if($result['teacher_dob'] == $dob)
                        {
                            echo "Your password is: ". "<b>" .$result['teacher_password']. "</b>";
                            exit();
                        }
                        else
                        {
                            echo "Invalid DOB";
                        }
                    }
                    else
                    {
                        echo "Invalid Email Adrress";
                        exit();
                    }
                }
                else
                {
                    echo "Invalid Phone Number";
                    exit();
                }
            }
        ?>
    </div>  
</body>
</html>