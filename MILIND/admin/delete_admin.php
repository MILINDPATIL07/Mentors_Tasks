
<?php
session_start();
include "connection.php";
@$email=$_SESSION['email1'];
$utype=$_SESSION['utype1'];

if ($utype == 2) {
    header("Location:login.php");
}

  $did = $_GET['id'];
  $query = "SELECT * FROM admin where id = '$did'";
  $data = mysqli_query($conn, $query);
  $total = mysqli_num_rows($data);
if ($total == 0) {
      echo "No Data available";
  } 
  else {
    $sql = "DELETE FROM admin WHERE id='$did'";
    if ($conn->query($sql) === TRUE) {
      echo '1';
    } else {
      echo "Error deleting record: " . $conn->error;
    }
}
?>
