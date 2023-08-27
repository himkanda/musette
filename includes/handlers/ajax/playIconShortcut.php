<?php
include("../../config.php");

if (isset($_POST['Id'])) {

    $id = $_POST['Id'];
    $type = $_POST['theType'];

    $date = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone('Asia/Kolkata'));
    $date = $date->format('Y-m-d H:i:s');

    if ($type == 'album') {
        $query = mysqli_query($con, "SELECT id FROM songs WHERE album='$id'");
    } else if ($type == 'artist') {
        $query = mysqli_query($con, "SELECT id FROM songs WHERE artist='$id'");
    } else if ($type == 'playlist') {
        $query = mysqli_query($con, "SELECT songId FROM playlistsongs WHERE playlistId='$id'");
    }
    if (isset($_POST['userLoggedIn'])) {
        $username = $_POST['userLoggedIn'];
        $query2 = mysqli_query($con2, "INSERT INTO recentlyplayed VALUES( null, '$id', '$type', '$username', '$date' )");

    }

    $array = array();
    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row[0]);
    }


    echo json_encode($array);


}



?>