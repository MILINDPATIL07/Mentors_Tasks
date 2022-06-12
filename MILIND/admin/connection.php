<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="milind";	

//create connection
$conn = mysqli_connect($servername,$username,$password);

//check connection
if (!$conn) 
	{
		die("connection Failed" . mysqli_connect_error());
	    # code...
	}
   //echo "Connection Successfully";

$db = mysqli_select_db($conn,$dbname);

if ($db)
	{	 	
	 	// echo "Database Selected Sucsessfully...!";
		# code...
	 }
else
{

	 echo "Database Is Not Selected!";
}
?>