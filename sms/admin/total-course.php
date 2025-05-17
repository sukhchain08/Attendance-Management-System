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
    <title>Total Students</title>
</head>
<body>
    <?php include '../include/admin-sidebar.php'; ?>

    <section class="dashboard-middle-area">
        <h4 class="admin-name">Hello, Admin</h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="../admin/logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination"><p style="color:#1264a3;">Admin / </p> <p><a href="dashboard.php" style="color:#1264a3;">Dashboard</a> / </p> <a href="total-course.php">Total Course</a></pre> <hr>
        <div class="edit-detail-link pt-2">
            <i class='fa-solid fa-pen-to-square pe-1'></i>
            <a href="manage-course.php" style="color: #006bff">Edit Details</a>
        </div>
        <div class="total-students">
            <table class="table table-bordered text-center table-striped mt-3">
                <tr>
                    <th>Sr. no.</th>
                    <th>Course Name</th>
                    <th>Course Duration</th>
                    <th>Total Semesters</th>
                </tr>
                <?php 
                    // Select all data from the database 
                    $data = mysqli_query($conn, "SELECT * FROM course_info");
                    $total = mysqli_num_rows($data);

                    if($total != 0)
                    {
                        // Odo tak while loop chale jado tak record khatam ni ho jande
                        while($result = mysqli_fetch_assoc($data))
                        {
                            echo 
                            "
                                <tr>
                                    <td>".$result['sr_no']."</td>
                                    <td>".$result['course_name']."</td>
                                    <td>".$result['course_duration']."</td>
                                    <td>".$result['total_semester']."</td>
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
</body>
</html>