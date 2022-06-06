<?php
session_start();
include "connection.php";
if (isset($_POST['request'])) {
    $request = $_POST['request'];
    $query = "SELECT * FROM product WHERE category_id = '$request' ";
    // $query = "SELECT p.id, p.p_name, p.category_id,p.images, c.name, c.active FROM product as p join category as c on p.category_id = c.id  where c.active = '$request' ";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
?>

<div>
    <span id="txtmsg"></span>
</div>

<div class="row" style="margin-top: 5rem;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <!-- <h2>Logout : <a href="../logout.php"></?= $_SESSION['email'] ?></a></h2> -->
        </div>

        <div class="pull-right">

            <?php
                if ($_SESSION['email'] == "testuser@kcsitglobal.com") { ?>

            <!-- <a class="btn btn-primary" href="addproduct.php"> Add New Product</a> -->
            <!-- <a class="btn btn-success" href="addproduct.php"> Add New Product</a> -->
            <!-- <a class="btn btn-primary" href="../product/product.php"> Back</a> -->

            <?php } else { ?>
            <!-- <a class="btn btn-primary" href="category/categorylist.php"> Category List</a> -->
            <!-- <a class="btn btn-primary" href="admin/admin.php"> Admin list</a> -->
            <?php } ?>
        </div>
    </div>
</div>
<center>
    <h2>Product List</h2>
</center>
<table class="table table-bordered table-striped table-responsive-stack" id="Productlist">
    <?php
        if ($count) {
        ?>
    <thead>
        <tr id="Productlist">
            <th>ID</th>
            <th>Product Name</th>
            <th>Category </th>
            <th>Image</th>
            <th>Created By User ID</th>
            <th>Active</th>
        </tr>
        <?php
        } else {
            echo "Sorry no record found..!!";
        }
            ?>
    </thead>

    <?php
            while ($row = mysqli_fetch_array($result)) {
            ?>
    <tbody id="productbody">
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['p_name'] ?></td>
            <td>
                <?php
                            $cat = $row['category_id'];
                            $sel = "select name from category where id='$cat'";
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

            <!-- <td></?= $row['createdBy']?></td> -->
        </tr>
        <?php
            }
                ?>
    </tbody>
</table>
<?php
}
?>