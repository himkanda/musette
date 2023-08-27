<?php
include("../../config.php");

if (isset($_POST['submitalbum'])) {
    if (isset($_POST['artists']) && isset($_POST['genres']) && isset($_POST['artworkpath']) && isset($_POST['title']) && isset($_POST['year'])) {
        $artist = $_POST['artists'];
        $genre = $_POST['genres'];
        $artworkpath = $_POST['artworkpath'];
        $title = $_POST['title'];
        $year = $_POST['year'];
        $date = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone('Asia/Kolkata'));
        $date = $date->format('Y-m-d H:i:s');

        if (empty($genre) || empty($artist) || empty($year) || empty($artworkpath) || empty($title) || empty($date)) {
            echo "empty";
            exit();
        }


        $query = mysqli_query($con, "SELECT * FROM albums  WHERE title = '$title'");
        if (mysqli_num_rows($query) == 0) {
            $query2 = mysqli_query($con, "INSERT INTO albums VALUES ( null, '$title', '$artist', '$genre', '$artworkpath', '$year', '$date' )");
            echo "done";
        } else
            echo "already exists";
    } else {
        echo "one of parameter not passed";
    }

} else if (isset($_POST['submitartist'])) {
    if (isset($_POST['name2']) && isset($_POST['country']) && isset($_POST['artistinfo']) && isset($_POST['artistpic'])) {

        $artistpic = $_POST['artistpic'];
        $name = $_POST['name2'];
        $country = $_POST['country'];
        $artistinfo = $_POST['artistinfo'];
        $artistinfo = mysql_real_escape_string($artistinfo);
        if (empty($artistpic) || empty($name) || empty($country) || empty($artistinfo)) {
            echo "empty";
            exit();
        }


        $query = mysqli_query($con, "SELECT * FROM artists  WHERE name = '$name'");
        if (mysqli_num_rows($query) == 0) {
            $query2 = "INSERT INTO artists VALUES ( null, '$name', '$country', '$artistpic', '$artistinfo')";


            $success = mysqli_query($con, $query2);
            if ($success) {
                echo "done";
            } else {
                echo mysqli_error();
            }
        } else
            echo "already exists";
    } else {
        echo "one of parameters not passed";
    }
} else if (isset($_POST['submitgenre'])) {
    if (isset($_POST['genreupload'])) {


        $genre = $_POST['genreupload'];
        if (empty($genre)) {
            echo "empty";
            exit();
        }




        $query = mysqli_query($con, "SELECT * FROM artists  WHERE name = '$name'");
        if (mysqli_num_rows($query) == 0) {
            $query2 = mysqli_query($con, "INSERT INTO artists VALUES ( null, '$name', '$country', '$artistpic', '$artistinfo' )");
            echo "done";
        } else
            echo "already exists";
    } else {
        echo "one of parameters not passed";
    }
}
?>