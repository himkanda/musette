<?php include("../../config.php");

if (isset($_POST['array']) && isset($_POST['username']) && isset($_POST['name'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $cp = json_decode(stripslashes($_POST['array']));
    $date = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone('Asia/Kolkata'));
    $date = $date->format('Y-m-d H:i:s');
    $query = mysqli_query($con, "INSERT into playlists VALUES ( NULL, '$name', '$username', '$date', 1, NULL, NULL)");
    $playlistId = mysqli_query($con, "SELECT LAST_INSERT_ID() from playlists");
    $playlistId = mysqli_fetch_array($playlistId);
    $playlistId = $playlistId['0'];

    foreach ($cp as $data) {
        $orderIdQuery = mysqli_query($con, "SELECT (MAX(playlistOrder) + 1) as playlistOrder FROM playlistSongs WHERE playlistId='$playlistId'");
        $row = mysqli_fetch_array($orderIdQuery);
        $order = $row['playlistOrder'];
        $query2 = mysqli_query($con, "INSERT into playlistSongs VALUES (NULL, $data, $playlistId, $order)");
    }


} else {
    echo "Username not correct!";
}



?>