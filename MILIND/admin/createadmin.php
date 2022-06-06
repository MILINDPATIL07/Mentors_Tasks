<?php
session_start();
if (!$_SESSION['email']) {
    header("Location:../login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Create New Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/admin_CSS.css" type="text/css">
    <script type="text/javascript" src="../js/add_admin_validations.js"></script>
</head>

<body>
    <div class="pull-right">
        <h4>Logout : <a href="../logout.php" class="btn btn-warning" onClick="return confirm('Are You Sure You Want to logout?');"><?= $_SESSION['email'] ?></a></h4>
    </div>
    <div class="container">
        <div class="row">
        </div>
        <form name="register" action="create_admin_process.php" method="POST">
            <span class="text-danger" id="error"></span>
            <div class="row">
                <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6 col-xs-12" id="cnsform">
                    <center>
                        <h2>Create New Admin</h2>
                    </center>
                    <hr>
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Admin Name" autofocus>
                        <span class="text-danger" id="nameval"></span>
                    </div>

                    <div class="form-group">
                        <strong>Email:</strong>
                        <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email" autofocus>
                        <span class="text-danger" id="emailval"></span>
                        <span style="color:red;text-align: center;">
                        <?php
                        if (isset($_REQUEST['email'])) {
                            # code...
                            $msg2 = $_REQUEST['email'];
                        ?>
                            <p> <?php echo $msg2; ?></p>
                        <?php
                        } else {
                            $msg2 = "";
                        }
                        ?>
                    </span>
                    </div>

                    <div class="form-group">
                        <strong>Gender:</strong>
                        <div class="input-group">
                            <input type="radio" name="gender" id="male" value="male" checked>
                            <span>Male</i></span><br>
                            <input type="radio" name="gender" id="female" value="female">
                            <span> Female</i></span>
                        </div>
                        <span class="text-danger"></span>
                    </div>

                    <div class="form-group">
                        <strong>Hobbies:</strong><br>
                        <input type="checkbox" id="hobbies" name="checkbox[]" value="Cricket">Cricket<br>
                        <input type="checkbox" id="hobbies" name="checkbox[]" value="Singing">Singing<br>
                        <input type="checkbox" id="hobbies" name="checkbox[]" value="Swimming">Swimming<br>
                        <input type="checkbox" id="hobbies" name="checkbox[]" value="Shopping">Shopping<br>
                        <div>
                            <span class="text-danger" id="hobbiesval"></span>
                        </div>
                    </div>


                    <div class="form-group">
                        <strong>Password:</strong>
                        <input type="password" id="password" name="password" placeholder="Enter your password" class="form-control" autofocus>
                        <span class="text-danger" id="passwordval"></span>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center" id="btnid">
                        <button type="button" id="Btnsubmit" name="btnsubmit" class="btn btn-primary">Submit</button>


                        <a class="btn btn-primary" href="admin.php"> Cancel</a><br>
                    </div>
                </div>
        </form>
    </div>
</body>

</html>