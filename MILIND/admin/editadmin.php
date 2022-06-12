<?php
session_start();
include 'connection.php';
@$email = $_SESSION['email1'];
@$utype = $_SESSION['utype1'];
echo "$utype";
if ($utype == 2) {
    header("Location:login.php");
}
include "edit_admin_process.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title> Edit Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>
    <!-- Jquery Validation Extermal Link  -->
    <script type="text/javascript" src="../js/add_admin_validations.js"></script>
</head>

<body>
    <div class="pull-right">
        <h4> <a href="../logout.php " class="btn btn-warning" onClick="return confirm('Are You Sure You Want to logout?');" title="<?php echo "$email" ?>"><?php echo "$email" ?></a></h4>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-primary" href="admin.php"> Back</a>
                </div>
            </div>
        </div>
        <form action="" method="POST">
            <?php

            $sql = "select * from admin where id='$id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <center>
                                <h2>Edit Admin</h2>
                            </center>
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input type="text" name="name" class="form-control" placeholder="Enter First Name" value="<?= $row['name'] ?>" required>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Email:</strong>
                                <input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?= $row['email'] ?>" required>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Gender:</strong>
                                <div class="input-group">
                                    <input type="radio" name="gender" id="male" value="male" <?php if ($row['gender'] == "Male") {
                                                                                                    echo "checked";
                                                                                                } ?>>
                                    <span>Male</i></span><br>
                                    <input type="radio" name="gender" id="female" value="female" <?php if ($row['gender'] == "Female") {
                                                                                                        echo "checked";
                                                                                                    } ?>>
                                    <span> Female</i></span>
                                </div>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Hobbies:</strong><br>
                                <input type="checkbox" name="checkbox[]" value="Cricket" <?php if (in_array("Cricket", explode(",", $row['hobbies']))) {
                                                                                                echo "checked";
                                                                                            } ?>>Cricket<br>
                                <input type="checkbox" name="checkbox[]" value="Singing" <?php if (in_array("Singing", explode(",", $row['hobbies']))) {
                                                                                                echo "checked";
                                                                                            } ?>>Singing<br>
                                <input type="checkbox" name="checkbox[]" value="Swimming" <?php if (in_array("Swimming", explode(",", $row['hobbies']))) {
                                                                                                echo "checked";
                                                                                            } ?>>Swimming<br>
                                <input type="checkbox" name="checkbox[]" value="Shopping" <?php if (in_array("Shopping", explode(",", $row['hobbies']))) {
                                                                                                echo "checked";
                                                                                            } ?>>Shopping<br>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Password:</strong>
                                <input type="password" name="password" class="form-control" value="<?= $row['password'] ?>" required>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                <?php
                }
            } else {
                echo "Sorry...No Records Found...!";
            }
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" name="edit" class="btn btn-primary">Save</button>
                </div>
                </div>
        </form>
    </div>
</body>

</html>