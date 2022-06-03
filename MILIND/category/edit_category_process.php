<?php
include '../connection.php';
$id = $_GET['id'];
if (isset($_REQUEST['edit'])) {
    $name = $_POST["cname"];
    $active = $_POST["active"];
    $edit = "UPDATE `category` SET `name`='$name',`active`='$active' WHERE `id`='$id'";
    $result1 = $conn->query($edit);
    if ($result1 == TRUE) {
        header("Location:categorylist.php");
    } else {
        echo "Error:" . $edit . "<br>" . $conn->error;
    }
}
?>