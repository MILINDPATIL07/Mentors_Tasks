<?php
session_start();
if (!$_SESSION['email']) {
    header("Location:../login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/Category_CSS.css" type="text/css" />
    <title>Category List Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css"
        rel="stylesheet">
    <script type="text/javascript" src="../js/ajaxdelete_category.js"></script>
</head>

<body>
    <div class="pull-right">
        <h3>Logout : <a href="../logout.php" class="btn btn-warning"><?= $_SESSION['email'] ?></a></h3>
    </div>
    <span id="txtmsg"></span>
    <div class="container">
        <div class="row" style="margin-top: 5rem;">
            <div class="col-lg-12 margin-tb">
                <?php
                if ($_SESSION['email'] == "testuser@kcsitglobal.com") { ?>
                <div class="pull-right">
                    <a class="btn btn-primary" href="addcategory.php"> Add Category</a>
                    <a class="btn btn-primary" href="../index.php"> Back</a>
                </div>
                <?php } else { ?>
                <a class="btn btn-primary" href="../index.php"> Back</a>
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
                if ($_SESSION['email'] == "testuser@kcsitglobal.com") { ?>
                    <th width="280px">Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <?php
            include '../connection.php';
            $sql = "SELECT * FROM category";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tbody id="productbody">
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['active'] ?></td>
                    <?php
                        if ($_SESSION['email'] == "testuser@kcsitglobal.com") { ?>
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