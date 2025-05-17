<?php 
    include '../include/admin_privacy.php'; 
    include '../sql/main_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/links.php'; ?>
    <link rel="stylesheet" href="../styles/admin_dashboard.css">
    <link rel="stylesheet" href="admin-responsive.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
</head>
<body>
    <?php include '../include/admin-sidebar.php'; ?>

    <section class="dashboard-middle-area">
        <h4 class="admin-name">Hello, Admin</h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="../admin/logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination pb-1"><p style="color:#1264a3;">Admin / </p> <p><a href="dashboard.php" style="color:#1264a3;">Dashboard</a> / </p> <a href="manage-course.php">Manage Course</a></pre> <hr>
        <div class="student-table">
            <table class="table table-bordered text-center table-striped mt-2">
                <tr>
                    <th>Sr. no.</th>
                    <th>Course Name</th>
                    <th>Total Semesters</th>
                    <th>Total Duration</th>
                    <th>Action</th>
                </tr>
                <?php 
                    $data = mysqli_query($conn, "SELECT * FROM course_info");
                    $total = mysqli_num_rows($data);

                    if($total != 0)
                    {
                        while($result = mysqli_fetch_assoc($data))
                        {
                            echo 
                            "
                                <tr>
                                    <td>".$result['sr_no']."</td>
                                    <td>".$result['course_name']."</td>
                                    <td>".$result['total_semester']."</td>
                                    <td>".$result['course_duration']."</td>
                                    <td> 
                                        <a class='action-icons' href='edit-course-details.php?sr=".$result['sr_no']."'><i class='fa-solid fa-pen-to-square'></i></a> 
                                        <a class='action-icons' href='delete-course.php?sr=".$result['sr_no']."' onclick='return confirm_delete()'><i class='fa-solid fa-trash-can'></i></a>
                                    </td>
                                </tr>
                            ";
                        }
                    }
                    else
                    {   
                        echo "No Record Found";
                    }
                ?>
            </table>
        </div>
    </section>
        
    <script>
        function confirm_delete()
        {
            return confirm('Are you sure to delete this record ?');
        }
    </script>
</body>
</html>