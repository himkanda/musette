<?php
include("../../config.php");

if (isset($_POST['playlistId']) && isset($_POST['userLoggedIn'])) {
    $playlistId = $_POST['playlistId'];
    $username = $_POST['userLoggedIn'];

    $query = mysqli_query($con2, "SELECT * FROM savedplaylist WHERE playlistId='$playlistId' AND userName='$username'");
    if (mysqli_num_rows($query) == 1) {
        $query1 = mysqli_query($con2, "DELETE FROM savedplaylist WHERE playlistId='$playlistId' AND userName='$username'");
        echo "removed";
    } else {
        $query1 = mysqli_query($con2, "INSERT INTO savedplaylist VALUES ( '', '$username' ,'$playlistId') ");
        echo "added";
    }
} else {
    echo "PlaylistId or userName was not passed correctly";
}


?>