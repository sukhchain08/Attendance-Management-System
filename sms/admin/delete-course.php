<?php
    include '../sql/main_connection.php';

    $serial_number = $_GET['sr'];
    $delete_query = "DELETE FROM course_info WHERE sr_no = '$serial_number'";

    $data = mysqli_query($conn, $delete_query);
    if($data)
    {
        echo "<script>alert('Record delete successsfully')</script>";
        echo "<script>window.open('manage-course.php', '_self')</script>";
    }
    else 
    {
        echo "Record failed to delete";
    }
?>