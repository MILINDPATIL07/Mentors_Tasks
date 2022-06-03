<?php
session_start();
if (!$_SESSION['email']) {
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
    <link type="text/css" rel="stylesheet" href="css/product_CSS.css" />
    <script type="text/javascript" src="js/filter_javascript.js"></script>
    <script type="text/javascript" src="js/ajaxdelete_product.js"> </script>

</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php"> Trainning Assignment </a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <!-- <li><a href="product.php">Product</a></li> -->
                <li><a href="admin/admin.php">Admin</a></li>
                <li><a href="category/categorylist.php">Category</a></li>
            </ul>
            <div class="pull-right" style="color:aliceblue;">
                <h4>Logout : <a href="logout.php" class="btn btn-warning" onClick="return confirm('Are You Sure You Want to logout?');"><?= $_SESSION['email'] ?></a></h4>
            </div>
        </div>
    </nav>
    
       <div class="pull-left">   
        <div id="filters">
            <span>Select Category :</span>
            <select class="btn btn-primary dropdown-toggle" name="fetchval" id="fetchval">
                <option value="" disabled="" selected="">All Category</option>
                <?php
                include 'connection.php';
                //select only active categories form category table 
                $sql = "SELECT * FROM category where active='Yes'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                <?php }
                }
                ?>
            </select>
            <!-- <select class="btn btn-primary dropdown-toggle" name="fetchval" id="fetchval">
                                    <option value="" disabled="" selected="">Select Filter</option>
                                    <option value="" >Active status</option> 
                                    <option value="Yes">Active</option>
                                    <option value="No">In Active</option>

                                </select> -->
        </div>
       </div>
  

    <div class="container">
        <div class="row" style="margin-top: 5rem;">
            <div class="col-lg-12 margin-tb">

                <span id="txtmsg"></span>
                <div class="pull-right">
                    <?php
                    if ($_SESSION['email'] == "testuser@kcsitglobal.com") { ?>

                        <a class="btn btn-primary" href="addproduct.php"> Add New Product</a>

                    <?php } else { ?>
                        <!-- <a class="btn btn-primary" href="category/categorylist.php"> Category List</a>
                    <a class="btn btn-primary" href="admin/admin.php"> Admin</a> -->
                    <?php } ?>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-responsive-stack" id="Productlist">
            <thead>
                <center>
                    <h2>Product List</h2>
                </center>
                <tr id="Productlist">
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Created By User ID</th>
                    <th>Active</th>

                    <?php
                    if ($_SESSION['email'] == "testuser@kcsitglobal.com") { ?>
                        <th width="280px">Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <?php
            include 'connection.php';
            // $sql = "SELECT * FROM product where active='Yes'";
            $sql = "SELECT * FROM product where active='Yes'";

            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tbody id="productbody">
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['p_name'] ?></td>
                            <td>
                                <?php
                                $cat = $row['category_id'];
                                // $act=$row['active'];
                                $sel = "SELECT name FROM category WHERE id='$cat'";
                                $result2 = mysqli_query($conn, $sel);
                                if (mysqli_num_rows($result2) > 0) {
                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                        echo $row2['name'];
                                    }
                                }
                                ?>
                            </td>
                            <td><img src="uploads/<?php echo $row['images']; ?>" width="160" height="80"></td>
                            <td><?= $row['createdbyuser'] ?></td>
                            <td><?= $row['active'] ?></td>
                            <?php
                            if ($_SESSION['email'] == "testuser@kcsitglobal.com") { ?>
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
    <script>
        
    </script>
</body>

</html>