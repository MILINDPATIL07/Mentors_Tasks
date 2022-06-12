<?php
include 'connection.php';
//session_start(); 

if (isset($_POST) && count($_POST) > 0) {
	$name = $_POST["name"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$gender = $_POST["gender"];
	@$hobbies = implode(',', (array)$_POST["checkbox"]);
	$utype="2";
	if ($hobbies == "") {
		echo "Please Select Any Hobbies" . "<br>";
	}
	//check if alrady exist 
	$qry1 = "SELECT * FROM admin where email = '" . $email . "' ";
	$rs1 = mysqli_query($conn, $qry1);
	if (mysqli_num_rows($rs1) > 0) {
		//  echo"$qry";
		 $_SESSION['email_error'] = "EMAIL ALREADY EXIST";
		header('Location:createadmin.php?email_error=EMAIL ALREADY EXIST');
		exit();
	}
	if ($name != "" && $email != "" && $password != "" && $gender != "" && $hobbies != "") {
		$sql = "INSERT INTO admin VALUES (NULL,'$name','$email','$gender','$hobbies','$password','$utype')";
		if (mysqli_query($conn, $sql)) {
			header("Location:adminlist.php");
		} else {
			echo "ERROR: Sorry $sql. " . mysqli_error($conn);
		}
		mysqli_close($conn);
	} else {
		echo "Enter Required Fields";
	}
}
?>
