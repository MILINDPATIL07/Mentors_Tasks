<?php
session_start();
include "admin/connection.php";
if (isset($_POST['request'])) {
    $request = $_POST['request'];
    //  $query = "SELECT * FROM product WHERE category_id = '$request' ";
    // $query = "SELECT p.id, p.p_name, p.category_id,p.images, c.name, c.active FROM product as p join category as c on p.category_id = c.id  where c.active = '$request' ";
    $query = "SELECT p.id,p.p_name,c.cname,p.images,a.email,p.active FROM product p INNER JOIN category c ON p.category_id = c.id INNER JOIN admin a ON p.createdbyuser = a.email where category_id = '$request' ";

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
                    <th>Category Name</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Created By User</th>
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
                        <td><?= $row['cname'] ?> </td>
                        <td><?= $row['p_name'] ?></td>
                        <td><img src="uploads/<?php echo $row['images']; ?>" width="160" height="80"></td>
                        <td><?= $row['email'] ?></td>
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