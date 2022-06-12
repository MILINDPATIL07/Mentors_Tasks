<?php
session_start();
unset($_SESSION['email1']);
unset($_SESSION['utype1']);
unset($_SESSION['id1']);
header("Location:../index.php");
?>