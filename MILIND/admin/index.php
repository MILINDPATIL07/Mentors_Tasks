<?php
session_start();
include 'connection.php';
@$email = $_SESSION['email1'];
@$utype = $_SESSION['utype1'];
echo "$utype";

if (!$utype == "1" || !$utype == "2") {
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Product Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/product_CSS.css" />
    <!-- <script type="text/javascript" src="js/filter_javascript.js"></script> -->
    <script type="text/javascript" src="../js/ajaxdelete_product.js"> </script>

</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php"> Trainning Assignment </a>
            </div>
            <ul class="nav navbar-nav">
                <!-- <li class="active"><a href="index.php">Home</a></li> -->
                <li><a href="adminlist.php">Admin</a></li>
                <!-- <li><a href="admin/productlist.php">Product</a></li> -->
                <li><a href="categorylist.php">Category</a></li>
            </ul>
            <?php
            if (!empty($email)) {
            ?>
                <div class="pull-right" style="color:aliceblue;">
                    <h4 style="color:aliceblue;"> <?php echo "$email"; ?> <a href="logout.php" class="btn btn-warning" onClick="return confirm('Are You Sure You Want to logout?');" title="<?php echo "$email" ?>">Logout</a></h4>
                </div>
            <?php
            } else {
            ?>

                <div class="pull-right" style="color:aliceblue;">
                    <h4>
                        <? echo "$email"; ?> <a href="admin/login.php" class="btn btn-primary">Login</a>
                    </h4>
                </div>
            <?php
            }
            ?>

        </div>
    </nav>


    <div class="container">
        <div class="row" style="margin-top: 5rem;">
            <div class="col-lg-12 margin-tb">

                <span id="txtmsg"></span>
                <div class="pull-right">
                    <?php
                    if ($utype == "1" || $utype == "2") { ?>

                        <a class="btn btn-primary" href="addproduct.php"> Add New Product</a>
                        <!-- <a class ="btn btn-primary" href="index.php">Home</a> -->

                    <?php } else { ?>
                        <a class="btn btn-primary" href="index.php">Home</a>

                    <?php } ?>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-responsive-stack" id="Productlist">
            <thead>
                <center>
                    <h2>Products</h2>
                </center>
                <tr id="Productlist">
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th width="280px">Active</th>
                    <?php
                    if ($utype == "1" || $utype == "2") { ?>
                        <th width="280px">Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <?php

            $sql = "SELECT * FROM product Where active= 'Yes';";

            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) { ?>

                    <tbody id="productbody">
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['p_name'] ?></td>
                            <td><img src="../uploads/<?php echo $row['images']; ?>" width="160" height="80"></td>
                            <td><?= $row['active'] ?></td>
                            <?php
                            if ($utype == "1" || $utype == "2") { ?>
                                <td><a href='editproduct.php?id=<?= $row['id'] ?>' class="btn btn-primary">Edit</a>
                                    <button class="btn btn-danger" onclick="deleterow(<?= $row['id'] ?>);">Delete</button>
                                </td>
                            <?php } ?>

                        </tr>
                    </tbody>
            <?php }
            }
            ?>
        </table>
    </div>

</body>

</html>