<?php
include("../../config.php");
if (isset($_POST['valyu'])) {

    $name = $_POST['valyu'];


    $url = "https://en.wikipedia.org/api/rest_v1/page/summary/$name";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "TestScript"); // required by wikipedia.org server; use YOUR user agent with YOUR contact information. (otherwise your IP might get blocked)
    $c = curl_exec($ch);
    $json = json_decode($c);
    $artistinfo2 = $json->{'extract'};
    $artistpic = $json->{'originalimage'}->{'source'};
    $artistname = $json->{'displaytitle'};

    $array = array([$artistinfo2], [$artistpic], [$artistname]);
    $resultarray = json_encode($array);
    echo $resultarray;
}



?>