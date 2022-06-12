<?php
include 'connection.php';
$id = $_GET['id'];
if (isset($_REQUEST['edit'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];
    $hobbies = implode(',', $_POST["checkbox"]);

    if ($name != ""  && $email != "" && $password != "" && $gender != "" && $hobbies != "") {

        $edit = "UPDATE `admin` SET `name`='$name',`email`='$email',`password`='$password',`gender`='$gender',`hobbies`='$hobbies' WHERE `id`='$id'";
        $result1 = $conn->query($edit);

        if ($result1 == TRUE) {
            header("Location:adminlist.php");
        } else {
            echo "Error:" . $edit . "<br>" . $conn->error;
        }
    } else {
        echo("Please input all Required fields..!!");
    }
}
?>