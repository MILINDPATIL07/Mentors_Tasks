<?php
session_start();
include 'connection.php';
@$email = $_SESSION['email1'];
@$utype = $_SESSION['utype1'];
echo "$utype";
// echo "$email"; 
// if (!$utype == 1 || !$utype == 2) {
//     header("Location:login.php");
// }
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/Category_CSS.css" type="text/css" />
    <title>Category List Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="../js/ajaxdelete_category.js"></script>
</head>

<body>
    <?php
    if (!empty($email)) {
    ?>
        <div class="pull-right" style="color:black;">
            <h4> <?php echo "$email"; ?> <a href="logout.php" class="btn btn-warning" onClick="return confirm('Are You Sure You Want to logout?');" title="<?php echo "$email" ?>"> Logout</a>
            </h4>
        </div>
    <?php
    } else { ?>
        <div class="pull-right" style="color:aliceblue;">
            <h4>
                <? echo "$email"; ?> <a href="login.php" class="btn btn-primary">Login</a>
            </h4>
        </div>
    <?php
    }
    ?>
    <span id="txtmsg"></span>
    <div class="container">
        <div class="row" style="margin-top: 5rem;">
            <div class="col-lg-12 margin-tb">
                <?php
                if ($utype == "1" || $utype == "2") { ?>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="addcategory.php"> Add Category</a>
                        <a class="btn btn-info" href="index.php"> Home</a>

                    </div>
                <?php } ?>

            </div>
        </div>
        <center>
            <h2>Category List</h2>
        </center>
        <table class="table table-bordered">
            <thead>
                <tr id="Productlist">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Active</th>
                    <?php
                    if ($utype == "1" || $utype == "2") { ?>
                        <th width="280px">Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <?php

            $sql = "SELECT * FROM category";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <tbody id="productbody">
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['cname'] ?></td>
                            <td><?= $row['active'] ?></td>
                            <?php
                            if ($utype == "1" || $utype == "2") { ?>
                                <td><a href='editcategory.php?id=<?= $row['id'] ?>' class="btn btn-primary">Edit</a>
                                    <button class="btn btn-danger" onclick="deleterow(<?= $row['id'] ?>);">Delete</button>
                                </td>
                            <?php } ?>
                        </tr>
                <?php }
            } ?>
            </tbody>
        </table>
    </div>
</body>

</html>