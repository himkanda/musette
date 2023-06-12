<?php
include("../../config.php");

if(isset($_POST['playlistId'])) {
	$playlistId = $_POST['playlistId'];
	$query2 = mysqli_query($con2, "DELETE from savedplaylist WHERE playlistId='$playlistId'");
	$songsQuery = mysqli_query($con, "DELETE FROM playlistsongs WHERE playlistId='$playlistId'");
	$playlistQuery = mysqli_query($con, "DELETE FROM playlists WHERE id='$playlistId'");


}
else {
	echo "PlaylistId was not passed into deletePlaylist.php";
}


?>