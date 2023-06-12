<?php
include("../../config.php");

if(isset($_POST['name']) && isset($_POST['username'])) {

	$name = $_POST['name'];
	
	$cleaned_name = str_replace("\"", "\\\"", $name);
	$cleaned_name = str_replace('\'', '\\\'', $cleaned_name);
	$username = $_POST['username'];
	$date = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone('Asia/Kolkata'));
    $date = $date->format('Y-m-d H:i:s');

	$query = mysqli_query($con, "INSERT INTO playlists VALUES('', '$cleaned_name', '$username', '$date', '1', NULL, NULL)");
	echo $name." created";
}
else {
	echo "Name or username parameters not passed into file";
}

?>