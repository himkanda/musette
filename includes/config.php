<?php
	session_start();

	$timezone = date_default_timezone_set("Asia/Kolkata");

	$con = mysqli_connect("127.0.0.1", "root", "", "Slotify");
	$con2 = mysqli_connect("127.0.0.1", "root", "", "userdata");

	if(mysqli_connect_errno()) {
		echo "Failed to connect: " . mysqli_connect_errno();
	}
?>