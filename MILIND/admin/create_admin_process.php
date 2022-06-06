<?php
//session_start(); 
// if (!$_SESSION['email']) {
// 	header("Location:../login.php");
// }
include '../connection.php';
//session_start(); 

if (isset($_POST) && count($_POST) > 0) {
	$name = $_POST["name"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$gender = $_POST["gender"];
	@$hobbies = implode(',', (array)$_POST["checkbox"]);
	if ($hobbies == "") {
		echo "Please Select Any Hobbies" . "<br>";
	}
	//check if alrady exist 

	$qry1 = "SELECT * FROM admin where email = '" . $email . "' ";
	$rs1 = mysqli_query($conn, $qry1);
	if (mysqli_num_rows($rs1) > 0) {
		//  echo"$qry";
		// $_SESSION['error_email_message'] = "EMAIL ALREADY EXIST";
		header('Location:createadmin.php?email=EMAIL ALREADY EXIST');
		exit();
	}

	if ($name != "" && $email != "" && $password != "" && $gender != "" && $hobbies != "") {
		$sql = "INSERT INTO admin VALUES (NULL,'$name','$email','$gender','$hobbies','$password')";
		if (mysqli_query($conn, $sql)) {
			header("Location:admin.php");
		} else {
			echo "ERROR: Sorry $sql. " . mysqli_error($conn);
		}
		mysqli_close($conn);
	} else {
		echo "Enter Required Fields";
	}
}
?>
