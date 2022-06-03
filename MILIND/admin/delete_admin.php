<?php
session_start();
if (!$_SESSION['email']) {
  header("Location:../login.php");
}
?>
<?php
include "../connection.php";

$did = $_GET['id'];
$query = "SELECT * FROM admin where id = '$did'";
$data = mysqli_query($conn, $query);
$total = mysqli_num_rows($data);
if ($total == 0) {
  echo "No Data available";
} else {
  $sql = "DELETE FROM admin WHERE id='$did'";
  if ($conn->query($sql) === TRUE) {
    echo '1';
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}
?>