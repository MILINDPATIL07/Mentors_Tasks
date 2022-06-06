<?php
session_start();
if (!$_SESSION['email'] == "testuser@kcsitglobal.com") {
    header("Location:login.php");
}
?>
<html>
<head>
    <title>product</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/add_product_validations.js"></script>
</head>
</head>
<body>
    <div class="pull-right">
        <h3>Logout : <a href="logout.php" class="btn btn-warning" onClick="return confirm('Are You Sure You Want to logout?');"><?= $_SESSION['email'] ?></a></h3>
    </div>

    <div class="container">
        <div class="row">
            <span class="text-danger" id="error"></span>
        </div>
        <!-- <div class="pull-right">
                    <a class="btn btn-primary" href="../index.php"> Back</a>
                </div> -->

        <form name="product" action="add_product_process.php" method="POST"  enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h3>Add New Product</h3>
                    <div class="form-group">
                        <strong>Product Name:</strong>
                        <input type="text" id="pname" name="name" class="form-control" placeholder="Enter First Name" required autofocus>
                        <span class="text-danger" id="pnameval"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Category Id</strong>
                        <select name="category_id" id="category_id" class="form-control">
                        <option value=""  selected="">Select Category</option>
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
                        <span class="text-danger" id="category_idval"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Created By UserId:</strong>
                        <span id="createdbyuserval"><?= $_SESSION['email'] ?></span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Active</strong>
                        <select name="active" id="active" class="form-control">
                            <option value="">Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        <span class="text-danger" id="activeval"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Select Image:</strong>
                        <input type="file" id="image" name="image" class="form-control" required accept=".jpg,.jpeg,.png">
                        <span>Only PNG, JPEG and JPG files are allowed</span>
                        <span class="text-danger" id="imageval"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="button" id="Btnsubmit" name="btnsubmit" class="btn btn-primary">Add Product</button>
                    <a class="btn btn-primary" onclick="history.back()"> Back</a>
                    <!-- <button onclick="history.back()">Go Back</button> -->

                </div>
            </div>
        </form>
    </div>
</body>

</html>