<?php
include("includes/includedFiles.php");

if (isset($_GET['id'])) {
	$artistId = $_GET['id'];
} else {
	header("Location: index.php");
}

$artist = new Artist($con, $artistId);
$artwork = $artist->getPic();
?>

<script>
	$(document).ready(function () {
		off();
	})
</script>

<?php

echo "<script> var page_title = \"artist : " . $artist->getName() . "\" ; document.title = page_title ; themeSwitch();  $('body').scrollTop(0); </script>";

$src = $artist->getPic();
$image = imagecreatefromstring(file_get_contents($src));
$thumb = imagecreatetruecolor(1, 1);
imagecopyresampled($thumb, $image, 0, 0, 0, 0, 1, 1, imagesx($image), imagesy($image));
$mainColor = strtoupper(dechex(imagecolorat($thumb, 0, 0)));

echo "<div class='albumTopViewContainer'>
    <div id='blurWrapper' style='background-color: #" . $mainColor . "9e ; background-image:url($artwork)'></div>" ?>
<div id="leftContainer">
	<img src=" <?php echo $artwork ?> " id="artistMainPic">
</div>
<div id="rightContainer">
	<div id="artistName">
		<?php echo $artist->getName(); ?>
	</div>
	<div>
		<b>
			<?php echo $artist->getCountry(); ?>
		</b>
	</div>
	<div id="artistInfo">
		<?php echo $artist->getInfo(); ?>
	</div>

</div>
</div>

<div class="InYourMusic">All albums &nbsp; &nbsp; &nbsp;
	<div class='headerControls'>
		<span onclick='playIconShortcut("artist", <?php echo $artistId ?>)'> <img src="assets/images/icons/play (2).png"
				alt="Play" title='Play'> &nbsp; Play All</span>
		<span onclick='makeShuffle(tempPlaylist)'> <img src="assets/images/icons/shuffle (2).png" alt="Shuffle"
				title='Shuffle'> &nbsp; Shuffle </span>
	</div>
</div>



<div class="gridViewContainer">
	<?php
	$albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE artist='$artistId'");

	while ($row = mysqli_fetch_array($albumQuery)) {




		echo "<div class='gridViewItem '>
					<span class='allArtistGridViewImage'>
						<img src='" . $row['artworkPath'] . "' role='link' class='hover-shadow zoomless'  onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
						<img class='playIconShortcut zoom' src='assets/images/icons/playIconShortcut.png' onclick='playIconShortcut(\"album\", " . $row['id'] . ")'>
						<input type='hidden' class='id' value='" . $row['id'] . "' name='album'>
						<img class='addIconShortcut zoom optionsButton' src='assets/images/icons/addIconShortcut.png' onclick='showOptionsMenu(this)'>
					</span>
						<div class='gridViewInfo'>"
			. $row['title'] .
			"</div>
						<div class='gridViewInfo2'>"
			. $row['Year'] .
			"</div>
			</div>";

	}
	?>

</div>
<div class="tracklistContainer songsView">
	<div class="InYourMusic">Biggest hits &nbsp;
		<img onclick='playFirstSong()' role='link' class='zoomless' src="assets/images/icons/play-next.png" title="Play"
			alt='play'>
	</div>

	<ul class="tracklist">

		<?php
		$songIdArray = $artist->getSongIds();

		$i = 1;
		foreach ($songIdArray as $songId) {

			if ($i > 5) {
				break;
			}

			$albumSong = new Song($con, $songId);
			$albumArtist = $albumSong->getArtist();

			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
						<span class='trackNumber'>$i</span>
					</div>


					<div class='trackInfo'>
						<span class='trackName'>" . $albumSong->getTitle() . "</span>
						<span role='white' class='artistName ' onclick='openPage(\"album.php?id=" . $albumSong->getAlbum()->getId() . "\")'>" . $albumSong->getAlbum()->getTitle() . "</span>
					</div>

					<div class='trackPopularityWithoutBG'>
						<input type='hidden' class='songId' value='" . $albumSong->getId() . "'>
						<span class='popularity'>" . $albumSong->getPopularity() . " spins</span>
					</div>

					<div class='trackOptions'>
						<input type='hidden' class='id' value='" . $albumSong->getId() . "' name='song'>
						<img class='optionsButton zoom' title='Options' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
                    </div>

					<div class='trackDuration'>
						<span class='duration'>" . $albumSong->getDuration() . "</span>
					</div>


				</li>";

			$i = $i + 1;
		}

		?>

		<script>
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
			tempPlaylist = JSON.parse(tempSongIds);
		</script>

	</ul>
	<nav class="optionsMenu">
		<input type="hidden" class="id" name=''>
		<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
		<div class='item' onclick='addToQueue(this)'><img class='addToQueue zoom' src='assets/images/icons/add.png'>Add
			to Queue</div>
		<div class='item' onclick='addToNext(this)'><img class='addToNext zoom'
				src='assets/images/icons/play-next.png'>Play Next</div>
	</nav>
</div>


</body>

</html>