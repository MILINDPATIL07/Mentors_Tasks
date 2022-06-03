<?php
include 'connection.php';
session_start(); 
if(isset($_POST) && count($_POST)>0){
    // if(!$_POST["txtemail"] || !$_POST["txtpassword"]){
    //     $msg = "Invalid username or password.";
    //     //header("Location:login.php?msg=$msg");
        // }
    $useremail = $_POST['txtemail'];  
    $userpassword = $_POST['txtpassword']; 
    // check user is super admin or not and session works accordingly
    if($_SESSION['email']="testuser@kcsitglobal.com"){
        $sql = "select * from super_admin where email = '$useremail' and password = '$userpassword'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $_SESSION['email']=$useremail;
                header("Location:index.php");
            }
        }
        else {
            $sql = "select * from admin where email = '$useremail' and password = '$userpassword'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $_SESSION['email']=$useremail;
                header("Location:index.php");
                }
            }
            else {

                  header("Location:login.php?msg=Invalid Email or Password.");
                // header("Location:login.php");
            }
        }   
    }
}
?>