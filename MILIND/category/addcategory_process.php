<?php
include '../connection.php';

if (isset($_POST) && count($_POST) > 0) {
    $name = $_POST["cname"];
    $active = $_POST["active"];
    if ($name != "" && $active != "") {
        
        $sql = "INSERT INTO category VALUES (NULL,'$name','$active')";
        if (mysqli_query($conn, $sql)) {
            header("Location:categorylist.php");
        } else {
            echo "ERROR: Sorry $sql. " . mysqli_error($conn);
        }
        mysqli_close($conn);
    } else {
        echo "Enter Required Fields";
    }
}
?>