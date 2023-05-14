<!-- You will create a landing page for our CRUD application that contains a data grid showing 
the records from the employee’s database table. It also has actions for each record displayed in 
the grid, you may choose to view its details, update, or delete.
You'll also add a create button on the top of the data grid that can be used for 
creating new records in the employee’s table. The file will be called "index.php"  -->
<?php
include('config.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- link to bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- link to jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- link to css -->
    <link rel="stylesheet" href="css/admin_dashboard.css">
    <title>dashboard</title>
    
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Users Table</h3>
                        <div class="search">
                            <div class="input-group mb-4 mt-3">
                                <div class="form-outline">
                                    <label for="search">search:</label>
                                    <input type="text" id="getName" name="getName" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-warning mt-3"><a href="user_create.php" class="text-light" style="text-decoration: none;">Insert to table</a></button>
                            <button class="btn btn-primary mt-3"><a href="admin_products.php" class="text-light" style="text-decoration: none;">Products Dashboard</a></button>
                        </div>
                    </div>
                    <div class="container text-center mb-3 mt-3 ">
                        <div class="row align-items-start">
                            <div class="col">
                                <?php
                                $query = "SELECT COUNT(*) AS rowCount FROM tb_users";
                                $result = mysqli_query($conn, $query);

                                if ($result && mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $rowCount = $row['rowCount'];
                                    echo "Number of users: " . $rowCount;
                                } else {
                                    echo "No data available";
                                }                                
                                ?>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>user image</th>
                                    <th>First Name </th>
                                    <th>Last Name </th>
                                    <th>Email</th>
                                    <th>Mobile phone</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody id="showdata">
                                <?php
                                $query = "SELECT * FROM tb_users WHERE role_id != '1'";
                                $result = mysqli_query($conn, $query);

                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <td><?= $row['user_id']; ?></td>
                                            <td><img src="<?php echo 'img/' . $row['user_img'] ?>" width="90" height="90" alt=""></td>
                                            <td><?= $row['user_fname']; ?></td>
                                            <td><?= $row['user_lname']; ?></td>
                                            <td><?= $row['user_email']; ?></td>
                                            <td><?= $row['user_phone']; ?></td>
                                            <td class="buttons">
                                                <button class="btn btn-warning"><a href="view_users.php?viewid=<?= $row['user_id'] ?>" class="text-light">View</a></button>
                                                <button class="btn btn-primary"><a href="update_users.php?updateid=<?= $row['user_id'] ?>" class="text-light">Update</a></button>
                                                <button class="btn btn-danger"><a href="delete_users.php?deleteid=<?= $row['user_id'] ?>" class="text-light">Delete</a></button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="5">No Record Found</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#getName').on("keyup", function() {
                var getName = $(this).val();
                $.ajax({
                    method: 'POST',
                    url: 'search_users.php',
                    data: {
                        name: getName
                    },
                    success: function(response) {
                        $("tbody").html(response);
                    }
                });
            });
        });
    </script>




    <!-- link to bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>