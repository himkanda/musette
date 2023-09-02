<?php
include("../../config.php");


if (isset($_POST['playlistId']) && isset($_POST['id']) && $_POST['type'] == 'song') {
	$playlistId = $_POST['playlistId'];
	$songId = $_POST['id'];

	$orderIdQuery = mysqli_query($con, "SELECT COALESCE(MAX(playlistOrder)+1,0) as playlistOrder FROM playlistsongs WHERE playlistId=$playlistId");
	$row = mysqli_fetch_array($orderIdQuery);
	$order = $row['playlistOrder'];

	$durationquery = mysqli_query($con, "SELECT duration FROM songs WHERE id = '$songId'");
	$result = mysqli_fetch_array($durationquery);
	$duration = $result['duration'];

	$duplicatequery = mysqli_query($con, "SELECT id FROM playlistsongs WHERE (playlistId='$playlistId' && songId='$songId')");
	$duplicaterow = mysqli_fetch_array($duplicatequery);

	if ($duplicaterow) {
		echo "Song already exists in the playlist. Can't add again. ";
	} else {
		$query = mysqli_query($con, "INSERT INTO playlistsongs VALUES( null, '$songId', '$playlistId', '$order')");
		echo "Added";
	}
} else if (isset($_POST['playlistId']) && isset($_POST['id']) && $_POST['type'] == 'album') {

	$playlistId = $_POST['playlistId'];
	$albumId = $_POST['id'];
	$orderIdQuery = mysqli_query($con, "SELECT COALESCE(MAX(playlistOrder)+1,0) as playlistOrder FROM playlistsongs WHERE playlistId='$playlistId'");
	$row = mysqli_fetch_array($orderIdQuery);
	$order = $row['playlistOrder'];
	$songs = mysqli_query($con, "SELECT * from songs WHERE album='$albumId'");
	$num = 0;

	foreach ($songs as $row) {

		$songId = $row['id'];
		$duplicatequery = mysqli_query($con, "SELECT id FROM playlistsongs WHERE (playlistId='$playlistId') && (songId='$songId')");
		if (mysqli_num_rows($duplicatequery) == 0) {
			$query = mysqli_query($con, "INSERT INTO playlistsongs VALUES( null, '$songId', '$playlistId', '$order')");
			$order++;
			$num++;
		}
	}

	echo $num . " songs added.";

} else if (isset($_POST['playlistId']) && isset($_POST['id']) && $_POST['type'] == 'artist') {

	$playlistId = $_POST['playlistId'];
	$artistId = $_POST['id'];
	$orderIdQuery = mysqli_query($con, "SELECT COALESCE(MAX(playlistOrder)+1,0) as playlistOrder FROM playlistsongs WHERE playlistId='$playlistId'");
	$row = mysqli_fetch_array($orderIdQuery);
	$order = $row['playlistOrder'];
	$songs = mysqli_query($con, "SELECT * from songs WHERE artist='$artistId'");
	$num = 0;

	foreach ($songs as $row) {

		$songId = $row['id'];
		$duplicatequery = mysqli_query($con, "SELECT id FROM playlistsongs WHERE (playlistId='$playlistId') && (songId='$songId')");
		if (mysqli_num_rows($duplicatequery) == 0) {
			$query = mysqli_query($con, "INSERT INTO playlistsongs VALUES( null, '$songId', '$playlistId', '$order')");
			$order++;
			$num++;
		}
	}

	echo $num . " songs added.";

} else if (isset($_POST['playlistId']) && isset($_POST['id']) && $_POST['type'] == 'playlist') {

	$playlistId = $_POST['playlistId'];
	$Id = $_POST['id'];
	$orderIdQuery = mysqli_query($con, "SELECT COALESCE(MAX(playlistOrder)+1,0) as playlistOrder FROM playlistsongs WHERE playlistId='$playlistId'");
	$row = mysqli_fetch_array($orderIdQuery);
	$order = $row['playlistOrder'];
	$songs = mysqli_query($con, "SELECT * from playlistsongs WHERE playlistId='$Id'");
	$num = 0;

	foreach ($songs as $row) {

		$songId = $row['songId'];
		$duplicatequery = mysqli_query($con, "SELECT id FROM playlistsongs WHERE (playlistId='$playlistId') && (songId='$songId')");
		if (mysqli_num_rows($duplicatequery) == 0) {
			$query = mysqli_query($con, "INSERT INTO playlistsongs VALUES( null, '$songId', '$playlistId', '$order')");
			$order++;
			$num++;
		}
	}

	echo $num . " songs added.";

} else {
	echo "PlaylistId or songId was not passed into addToPlaylist.php";
}



?>