<?php include("../../config.php");
if (isset($_POST['array']) && isset($_POST['username']) && isset($_POST['name'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $cp = json_decode(stripslashes($_POST['array']));
    $date = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone('Asia/Kolkata'));
    $date = $date->format('Y-m-d H:i:s');
    $query = mysqli_query($con, "INSERT into playlists VALUES ( NULL, '$name', '$username', '$date', 1, NULL, NULL)");
    $query2 = mysqli_query($con, "SELECT last_insert_id() from playlists");
    $results1 = mysqli_fetch_array($query2);
    $playlistId = $results1['0'];
    foreach ($cp as $data) {
        $orderIdQuery = mysqli_query($con, "SELECT COALESCE(MAX(playlistOrder)+1,0) as playlistOrder FROM playlistsongs WHERE playlistId=$playlistId");
        $row = mysqli_fetch_array($orderIdQuery);
        $order = $row['playlistOrder'];
        $query3 = mysqli_query($con, "INSERT into playlistsongs VALUES (NULL, $data, $playlistId, $order)");
    }
} else {
    echo "Username not correct!";
}



?>