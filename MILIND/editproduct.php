<?php
session_start();

if (!$_SESSION['email']) {
    header("Location:login.php");
}
include 'edit_product_process.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Product</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
</head>

<body>
    <div class="pull-right">
        <h3>Logout : <a href="../logout.php" class="btn btn-warning" onClick="return confirm('Are You Sure You Want to logout?');"><?= $_SESSION['email'] ?></a></h3>
    </div>
    <div class="container">
        
        <form action="" method="POST" enctype="multipart/form-data">
            <?php
            $sql = "select * from product where id='$id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h2>Edit Product</h2>
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input type="text" name="name" class="form-control" placeholder="Enter Product Name" value="<?= $row['p_name'] ?>" required>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Category Id</strong>
                                <select name="category_id" id="category_id" class="form-control">
                                    <?php
                                    include '../connection.php';
                                    $sql1 = "SELECT * FROM category";
                                    $result1 = mysqli_query($conn, $sql1);
                                    if (mysqli_num_rows($result1) > 0) {
                                        while ($row1 = mysqli_fetch_assoc($result1)) { ?>
                                            <option value="<?php echo $row1['id'] ?>" <?php if ($row['category_id'] == $row1['id']) {echo "selected";} ?>><?php echo $row1['name'] ?></option>
                                    <?php }
                                    }
                                    ?>
                                </select>
                                <span class="text-danger" id="category_id"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Created By UserId:</strong>
                                <span><?= $_SESSION['email'] ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Active</strong>
                                <select name="active" id="active" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Yes" <?php if ($row['active'] == "Yes") {
                                                            echo "selected";
                                                        } ?>>Yes</option>
                                    <option value="No" <?php if ($row['active'] == "No") {
                                                            echo "selected";
                                                        } ?>>No</option>
                                </select>
                                <small id="activeval" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Select Image:</strong>
                                <input type="file" id="image" name="image" class="form-control" required>
                                <span>Only PNG, JPEG and JPG files are allowed</span>
                                <span class="text-danger" id="imageval"><?php echo $row['images']; ?></span>
                            </div>
                        </div>
                <?php
                }
            } else {
                echo "Error";
            }
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" name="edit" class="btn btn-primary">Edit Product</button>
                    <a class="btn btn-primary" href="index.php"> Back</a>

                </div>
                    </div>
        </form>
    </div>
</body>

</html>