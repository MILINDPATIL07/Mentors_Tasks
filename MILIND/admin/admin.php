<?php
session_start();
if (!$_SESSION['email']) {
    header("Location:../login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/Home_CSS.css" />

    <script type="text/javascript" src="../js/ajaxdelete_admin.js"></script>
</head>

<body>
    
    <span id="txtmsg"></span>
    <div class="pull-right">
        <h3>Logout: <a href="../logout.php" class="btn btn-warning"><?= $_SESSION['email'] ?></a></h3>
    </div>
    <div class="container">
        <div class="row" style="margin-top: 5rem;">
            <div class="col-lg-12 margin-tb">

                <?php
                if ($_SESSION['email'] == "testuser@kcsitglobal.com") { ?>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="createadmin.php"> Create New Admin</a>
                        <a class="btn btn-primary" href="../index.php"> Back</a>
                        <!-- <a class="btn btn-success" href="category/categorylist.php"> Category</a> -->
                        <!-- <a class="btn btn-success" href="product/product.php"> Product</a> -->
                    </div>
                <?php } else { ?>
                    <a class="btn btn-primary" href="../index.php"> Back</a>
                <?php } ?>

            </div>
            <table class="table table-bordered table-striped table-responsive-stack" id="Productlist">
                <thead>
                    <center>
                        <h3>ADMIN LIST</h3>
                    </center>
                    <tr id="Productlist">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Hobbies</th>
                        <?php
                        if ($_SESSION['email'] == "testuser@kcsitglobal.com") { ?>
                            <th width="280px">Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <?php
                include '../connection.php';
                $sql = "SELECT * FROM admin";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tbody id="productbody">
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['gender'] ?></td>
                                <td><?= $row['hobbies'] ?></td>
                                <?php
                                if ($_SESSION['email'] == "testuser@kcsitglobal.com") { ?>
                                    <td><a href='editadmin.php?id=<?= $row['id'] ?>' class="btn btn-primary">Edit</a>
                                        <button class="btn btn-danger" onclick="deleterow(<?= $row['id'] ?>);">Delete</button>
                                    </td>
                                <?php } ?>
                            </tr>
                        </tbody>
                <?php }
                } ?>
            </table>
        </div>
</body>
</html>