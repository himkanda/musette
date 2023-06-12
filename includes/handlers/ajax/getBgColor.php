<?php
include("../../config.php");

if(isset($_POST['albumId'])) {
	$albumId = $_POST['albumId'];

	$query = mysqli_query($con, "SELECT artworkPath FROM albums WHERE id='$albumId'");
    $resultArray = mysqli_fetch_array($query);
    $src = $resultArray['artworkPath'];
    $src = "C:\\xampp\htdocs\Musette\\".$src;
    $image = imagecreatefromstring(file_get_contents($src));
	$thumb=imagecreatetruecolor(1,1); imagecopyresampled($thumb,$image,0,0,0,0,1,1,imagesx($image),imagesy($image));
    $mainColor=strtoupper(dechex(imagecolorat($thumb,0,0)));
    
	$rgb = $mainColor ; $darker=1;

        $hash = (strpos($rgb, '#') !== false) ? '#' : '';
        $rgb = (strlen($rgb) == 7) ? str_replace('#', '', $rgb) : ((strlen($rgb) == 6) ? $rgb : false);
        if(strlen($rgb) != 6) return $hash.'000000';
        $darker = ($darker > 1) ? $darker : 1;
    
        list($R16,$G16,$B16) = str_split($rgb,2);
    
        $R = sprintf("%02X", floor(hexdec($R16)/$darker));
        $G = sprintf("%02X", floor(hexdec($G16)/$darker));
        $B = sprintf("%02X", floor(hexdec($B16)/$darker));
    
    echo $hash.$R.$G.$B;
    
}
?>