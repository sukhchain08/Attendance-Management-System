<?php 
    include '../include/teacher-privacy.php';
    include '../sql/main_connection.php';
    $teacher_number = $_SESSION['number'];

    // Query for fetch teacher details
    $data = mysqli_query($conn, "SELECT * FROM `teacher_info` WHERE teacher_number = '$teacher_number'");
    $result = mysqli_fetch_assoc($data);
    
    // Query for fetch teacher subject details
    $subject_data = mysqli_query($conn, "SELECT * FROM `teacher_subjects` WHERE teacher_number = '$teacher_number'");
    $subject_result = mysqli_fetch_assoc($subject_data);

    // Query for checking student result is already exist or not
    $name_data = mysqli_query($conn, "SELECT * FROM `result`");
    $name_result = mysqli_fetch_assoc($name_data);

    // Jado Submit button te click hove
    if(isset($_POST['add-result']))
    {
        $course = $_POST['course'];
        $name = $_POST['name'];
        $subj1 = $_POST['subj1'];
        $subj2 = $_POST['subj2'];
        $subj3 = $_POST['subj3'];
        $publish_date = date('y-m-d');

        // Check if student name already exists
        $check_result = mysqli_query($conn, "SELECT COUNT(*) FROM `result` WHERE student_name = '$name' AND course = '$course'");
        $count = mysqli_fetch_array($check_result)[0];
        if($count > 0)
        {
            echo "<script>alert('Result already published for $name.')</script>";
            echo "<script>window.open('add-result.php', '_self')</script>"; // Stay on add-result page
        }
        else 
        {
            //Query for add result
            $store_result = mysqli_query($conn, "INSERT INTO `result`(`course`, `student_name`, `subject1`, `subject2`, `subject3`, `publish_date`) VALUES ('$course', '$name', '$subj1', '$subj2', '$subj3', '$publish_date')");
        
            if($store_result)
            {
                echo "<script>alert('Result Published')</script>";
                echo "<script>window.open('add-result.php', '_self')</script>";
            }
            else 
            {
                echo "<script>alert('Failed')</script>";
                echo "<script>window.open('add-result.php', '_self')</script>";
            } 
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
    <title>Add Result</title>
</head>
<body>
    <?php include '../include/teacher-sidebar.php'; ?>

    <section class="dashboard-middle-area">
        <h4 class="teacher-name">Hello, <?php echo $result['teacher_name'] ?></h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination"><p style="color:#1264a3;">Teacher / </p> <a href="dashboard.php" style="color: #1264a3;">Dashboard</a> / <a href="add-result.php" style="color: #1264a3;">Add Result</a></pre> <hr>
        <p class="update-heading">Add Result</p>
        <div class="student-table">
            <form method="POST">
                <table class="table table-bordered">
                    <tr>
                        <th class="edit-heading" width="33%">Course Name</th>
                        <td><input value="<?php echo $result['teacher_course']; ?>" name="course" autocomplete="off" class="edit-input" readonly></td>
                    </tr>
                    <tr>
                        <th class="edit-heading">Student Name</th>
                        <td>
                            <select name="name" class="edit-input respo-input" required>
                                <option value="">Select Student</option>
                                <?php 
                                    $student_query = "SELECT student_name FROM student_info WHERE student_course = '{$result['teacher_course']}'";
                                    $student_data = mysqli_query($conn, $student_query);
                                    $total_students = mysqli_num_rows($student_data);

                                    if($total_students != 0)
                                    {
                                        // Odo tak while loop chale jado tak record khatam ni ho jande
                                        while($student_result = mysqli_fetch_assoc($student_data))   
                                        {
                                            echo 
                                            "
                                                <option>".$student_result['student_name']."</option>
                                            ";
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="edit-heading"><?php echo $subject_result['subject1']; ?></th>
                        <td>
                            <input type="text" name="subj1" pattern="[1-7][0-9]" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="2" class="edit-input" autocomplete="off" placeholder="Marks out of 75" required>
                        </td>
                    </tr>
                    <tr>
                        <th class="edit-heading"><?php echo $subject_result['subject2']; ?></th>
                        <td>
                            <input type="text" name="subj2" pattern="[0-7][0-9]" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="2" class="edit-input" autocomplete="off" placeholder="Marks out of 75" required>
                        </td>
                    </tr>
                    <tr>
                        <th class="edit-heading"><?php echo $subject_result['subject3']; ?></th>
                        <td>
                            <input type="text" name="subj3" pattern="[0-7][0-9]" autocomplete="off" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="2" class="edit-input" placeholder="Marks out of 75" required>
                        </td>
                    </tr>
                </table>
                <input type="submit" value="Add Result" name="add-result" class="btn btn-primary">
            </form>
        </div>
    </section>
</body>
</html>