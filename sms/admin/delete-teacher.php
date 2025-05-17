<?php
    include '../sql/main_connection.php';

    $number = $_GET['number'];
    $delete_query = "DELETE FROM teacher_info WHERE teacher_number = '$number'";
    
    $data = mysqli_query($conn, $delete_query);
    if($data)
    {
        echo "<script>alert('Record delete successsfully')</script>";
        echo "<script>window.open('manage-teachers.php', '_self')</script>";
    }
    else 
    {
        echo "Record failed to delete";
    }

    // $query = "SELECT teacher_number FROM teacher_subjects WHERE teacher_number = ''";

    $subj_delete = "DELETE FROM `teacher_subjects` WHERE teacher_number = '$number'";
    $is_delete = mysqli_query($conn, $subj_delete);
?>