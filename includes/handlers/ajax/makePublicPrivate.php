<?php
include("../../config.php");

if (isset($_POST['playlistId']) && isset($_POST['publicprivate']) && isset($_POST['userLoggedIn'])) {
    $playlistId = $_POST['playlistId'];
    $publicprivate = $_POST['publicprivate'];
    $username = $_POST['userLoggedIn'];
    if ($publicprivate == "public") {
        $publicprivate = 1;
    } else {
        $publicprivate = 0;
    }
    $query = mysqli_query($con, "SELECT * FROM playlists WHERE id='$playlistId' AND owner='$username'");
    if (mysqli_num_rows($query) == 1) {
        $query1 = mysqli_query($con, "UPDATE playlists SET public='$publicprivate' WHERE id='$playlistId' AND owner='$username'");
        echo "done";
        if ($publicprivate == 0) {
            $query2 = mysqli_query($con2, "DELETE from savedplaylist WHERE playlistId='$playlistId'");
        }
    } else {
        echo "something went wrong!";
    }
} else {
    echo "PlaylistId or publicprivate was not passed correctly";
}


?>