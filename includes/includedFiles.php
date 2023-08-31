<?php

if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
	include("includes/config.php");
	include("includes/classes/User.php");
	include("includes/classes/Artist.php");
	include("includes/classes/Album.php");
	include("includes/classes/Song.php");
	include("includes/classes/Playlist.php");

	if (isset($_GET['userLoggedIn'])) {
		$userLoggedIn = new User($con, $_GET['userLoggedIn']);
	} else {
		echo "Username variable was not passed into page. Check the openPage JS function";
		exit();
	}
} else {
	include("includes/header.php");
	include("includes/footer.php");

	$url = $_SERVER['REQUEST_URI'];


	$url = strpos($url, "&userLoggedIn") ? substr($url, 0, strpos($url, "&userLoggedIn")) : $url;
	echo "<script>openPage('$url')</script>";
	exit();
}

?>