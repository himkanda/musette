<?php
include("../../config.php");

if(isset($_POST['songId']) && isset($_POST['userLoggedIn'])) {
	$songId = $_POST['songId'];
	$username= $_POST['userLoggedIn'];

	$query = mysqli_query($con, "UPDATE songs SET plays = plays + 1 WHERE id='$songId'");
	$query2= mysqli_query($con2, "UPDATE $username SET plays = plays + 1 WHERE library='$songId'" );
}
?>