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
    <title>Manage Teachers</title>
</head>
<body>
    <?php include '../include/admin-sidebar.php'; ?>

    <section class="dashboard-middle-area">
        <h4 class="admin-name">Hello, Admin</h4>
        <div class="middle-area-logout-div logout-div">
            <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i> <a href="../admin/logout.php" onclick="return confirm('Are you sure to Log out?')">Log Out</a>
        </div>
        <pre class="pagination pb-1"><p style="color:#1264a3;">Admin / </p> <p><a href="dashboard.php" style="color:#1264a3;">Dashboard</a> / </p> <a href="manage-teachers.php">Manage Teachers</a></pre> <hr>
        <div class="search-div" style="left: -10px">
            <form action="" method="GET">
                <input type="search" name="search-value" autocomplete="off" placeholder="Search By Name" value="<?php echo htmlspecialchars($search_value); ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <div class="teacher-table">
            <table class="table table-bordered text-center table-striped mt-2">
                <tr>
                    <th>Sr. no.</th>
                    <th>Student Name</th>
                    <th>Mobile no.</th>
                    <th>Action</th>
                </tr>
                <?php
                    if (!empty($search_value)) {
                        $sql = "SELECT * FROM teacher_info WHERE teacher_name LIKE '%$search_value%'";
                    } else {
                        $sql = "SELECT * FROM teacher_info";
                    }

                    $data = mysqli_query($conn, $sql); // Use $sql here!
                    $total = mysqli_num_rows($data);

                    if ($total != 0) {
                        while ($result = mysqli_fetch_assoc($data)) {
                            echo
                            "
                                <tr>
                                    <td>" . $result['sr_no'] . "</td>
                                    <td>" . $result['teacher_name'] . "</td>
                                    <td>" . $result['teacher_number'] . "</td>
                                    <td>
                                        <a class='action-icons' href='edit-teacher-detail.php?sr=" . $result['sr_no'] . "'><i class='fa-solid fa-pen-to-square'></i></a>
                                        <a class='action-icons' href='delete-teacher.php?number=" . $result['teacher_number'] . "' onclick='return confirm_delete()'><i class='fa-solid fa-trash-can'></i></a>
                                    </td>
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

    <script>
        function confirm_delete() {
            return confirm('Are you sure to delete this record ?');
        }
    </script>
</body>
</html>