<?php
include 'connection.php';
$id = $_GET['id'];
if (isset($_REQUEST['edit'])) {
    $name = $_POST["name"];
    $category_id = $_POST["category_id"];
    $createdbyuser = $_SESSION['email'];
    $active = $_POST["active"];
    $image = $_FILES["image"]["name"];

    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large." . "<br>";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($filetype != "png" && $filetype != "jpeg" && $filetype != "jpg") {
        echo "Sorry, only PNG, JPEG and JPG files are allowed." . "<br>";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file." . "<br>";
        }
    }
    $edit = "UPDATE `product` SET `p_name`='$name',`category_id`='$category_id',`images`='$image',`active`='$active',`createdbyuser`='$createdbyuser' WHERE `id`='$id'";
    $result2 = $conn->query($edit);
    if ($result2 == TRUE) {
        echo "Record updated successfully.";
        // alert("Record Updated Successfully");
        header("Location:index.php");
    } else {
        echo "Error:" . $edit . "<br>" . $conn->error;
    }
}
?>