<?php 
    include '../include/admin_privacy.php'; 
    include '../sql/main_connection.php';

    $search_value = "";
    if (isset($_GET['search-value'])) {
        $search_value = mysqli_real_escape_string($conn, $_GET['search-value']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/links.php'; ?>
    <link rel="stylesheet" href="../styles/admin_dashboard.css">
    <link rel="stylesheet" href="admin-responsive.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Teachers</title>
</head>
<body>
    <?php include '../include/admin-sidebar.php'; ?>

    <!-- Middle Section  -->
    <section class="dashboard-middle-area">
        <h4 class="admin-name">Hello, Admin</h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="../admin/logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination"><p style="color: #1264a3;">Admin / </p> <p><a href="dashboard.php" style="color:#1264a3;">Dashboard</a> / </p> <a href="total-teachers.php">Total Teachers</a></pre> <hr>
        <div class="edit-detail-link pt-2">
            <span style="display: flex; width: 330px;">
                <i class='fa-solid fa-pen-to-square pe-2 pt-1'></i>
                <a href="manage-teachers.php" style="color: #006bff">Edit Details</a>
            </span>
            <div class="search-div">
                <form action="" method="GET">
                    <input type="search" name="search-value" autocomplete="off" placeholder="Search By Name" value="<?php echo htmlspecialchars($search_value); ?>">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
        <div class="teacher-table">
            <table class="table table-bordered text-center table-striped">
                <tr>
                    <th>Sr.no.</th>
                    <th>Teacher Name</th>
                    <th>Mobile no.</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Gender</th>
                    <th>DOB</th>
                </tr>
                <?php 
                    if (!empty($search_value)) 
                    {
                        $sql = "SELECT * FROM teacher_info WHERE teacher_name LIKE '%$search_value%'";
                    } 
                    else 
                    {
                        $sql = "SELECT * FROM teacher_info";
                    }

                    $data = mysqli_query($conn, $sql);
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
                                    <td>".$result['teacher_name']."</td>
                                    <td>".$result['teacher_number']."</td>
                                    <td>".$result['teacher_email']."</td>
                                    <td>".$result['teacher_course']."</td>
                                    <td>".$result['teacher_gender']."</td>
                                    <td>".$result['teacher_dob']."</td>
                                </tr>
                            ";
                        }
                    }
                    else
                    {
                        echo "<tr><td colspan='6'>No Record Found</td></tr>";
                    }
                ?>
            </table>
        </div>
    </section>
</body>
</html>