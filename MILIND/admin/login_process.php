<?php
include 'connection.php';
session_start();
//var_dump($_post);
// if(!isset($_POST["btn_sb"]))
// {
// 	header("location:login.php");
// 	exit();
// }
if(isset($_POST) && count($_POST)>0){

		$useremail=$_POST['txtemail'];
		$userpassword=$_POST['txtpassword'];

		$qry = "SELECT * FROM admin WHERE email='".$useremail."' AND password='".$userpassword."'";
		// var_dump($qry);
		// exit();
		$rs = mysqli_query($conn,$qry);

		if(mysqli_num_rows($rs)>0)
		{

			$row =mysqli_fetch_assoc($rs);
			// echo $row['utype'];
			// exit;
			$_SESSION['name1']=$row['name'];
			$_SESSION['email1']=$row['email'];
			$_SESSION['utype1']=$row['utype'];
			$_SESSION['id1']=$row['id'];
			
			$utype=$row['utype'];
			//echo $utype;
			// exit;
		
			if ($utype==1)
			{
				$_SESSION['user']==2;
				header("location:index.php");
				
			}
			else
			{
				$_SESSION['admin']==1;
				header("location:index.php");
				
			}
		}else{

			//echo "INVALID LOGIN";
			header("location:login.php?masInvalid credentials");
			
		}
 }
