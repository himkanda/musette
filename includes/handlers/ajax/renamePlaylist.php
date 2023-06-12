<?php
include("../../config.php");

if(isset($_POST['name']) && isset($_POST['id'])) {

    $name = $_POST['name'];
    $playlistId = $_POST['id'];
    
	
	$cleaned_name = str_replace("\"", "\\\"", $name);
	$cleaned_name = str_replace('\'', '\\\'', $cleaned_name);


	$query = mysqli_query($con, "UPDATE playlists SET name = '$name' WHERE id = $playlistId");
	echo $name." renamed";
}
else {
	echo "Name or username parameters not passed into file";
}

?>