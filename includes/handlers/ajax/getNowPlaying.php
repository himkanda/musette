<?php
include("../../config.php");

$data = json_decode(stripslashes($_POST['jsonString']));
echo $data;
$user = $_POST['userLoggedIn'];
// here i would like use foreach:
$q = mysqli_query($con2, "DELETE FROM currentplaylist WHERE userName = '$user' ");
foreach ($data as $d) {
  $query = mysqli_query($con2, "INSERT INTO currentplaylist VALUES( $d, '$user')");
}

?>