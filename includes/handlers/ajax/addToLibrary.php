<?php
include("../../config.php");


if (isset($_POST['songId']) && isset($_POST['userLoggedIn'])) {
    $songId = $_POST['songId'];
    $username = $_POST['userLoggedIn'];
    $querySelector = mysqli_query($con2, "SELECT id from `$username` WHERE library = $songId");

    if (mysqli_num_rows($querySelector) == 0) {
        $query1 = mysqli_query($con, "SELECT album, artist, albumorder FROM songs WHERE id= $songId");
        $result = mysqli_fetch_array($query1);
        $albumId = $result['album'];
        $artistId = $result['artist'];
        $albumOrder = $result['albumorder'];
        $query = mysqli_query($con2, "INSERT INTO `$username` VALUES (NULL, $songId, $albumId, $artistId, 0, $albumOrder)");
        echo 1;




    } else {
        $query = mysqli_query($con2, "DELETE FROM $username WHERE library = $songId");
        echo 2;
    }



} else {
    echo "ERROR";
}



?>