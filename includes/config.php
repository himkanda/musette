<?php

session_start();

$timezone = date_default_timezone_set("Asia/Kolkata");

$con = mysqli_connect("127.0.0.1", "root", "Test1234", "musette_app_data");
$con2 = mysqli_connect("127.0.0.1", "root", "Test1234", "musette_user_data");

if (mysqli_connect_errno()) {
	echo "Failed to connect: " . mysqli_connect_errno();
}
?>