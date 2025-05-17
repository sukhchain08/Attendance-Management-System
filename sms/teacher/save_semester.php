<?php
    include '../sql/main_connection.php';

    if (isset($_POST['update-semester'])) 
    {
        $success = true; // Assume success initially
        $errors = []; // Array to store error messages

        foreach ($_POST as $key => $value) {
            if (strpos($key, 'semester_') === 0 && !empty($value)) 
            {
                $studentNumber = str_replace('semester_', '', $key);
                $semester = mysqli_real_escape_string($conn, $value);

                $update_query = mysqli_query($conn, "UPDATE `student_info` SET `student_semester` = '$semester' WHERE `student_number` = '$studentNumber'");

                if (!$update_query) 
                {
                    $success = false; // Set success to false if any update fails
                    $errors[] = "Failed to update semester for student number: " . $studentNumber . " - " . mysqli_error($conn);
                }
            }
        }

        if ($success) 
        {
            echo "<script>alert('Semesters updated successfully')</script>";
            echo "<script>window.open('add-semester.php', '_self')</script>";//redirect to add-semester page
        } 
        else 
        {
            foreach ($errors as $error) 
            {
                echo "<script>alert('$error')</script>";
            }
            echo "<script>window.open('add-semester.php', '_self')</script>"; //redirect to add-semester page
        }
    } 
    else 
    {
        echo "<script>alert('Invalid request')</script>";
        echo "<script>window.open('add-semester.php', '_self')</script>"; //redirect to add-semester page
    }
?>