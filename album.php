<?php include("includes/includedFiles.php");

if (isset($_GET['id'])) {
	$albumId = $_GET['id'];
} else {
	header("Location: index.php");
}


$album = new Album($con, $albumId);
$artist = $album->getArtist();
$artistId = $artist->getId();
$artwork = $album->getArtworkPath();
$username = $userLoggedIn->getUsername();
?>

<script>
	themeSwitch();
	$('body').scrollTop(0);

	$(document).ready(function () {
		var itemss = $('#AllSongs .trackInLibrary img').get();
		$.each(itemss, function () {
			if ($(this).attr("src") == "assets/images/icons/checkmark.png") {
				$(this).attr("title", "Remove from My Music");
			}

		});
		off();
		$("#inLibrarySongs").show();
		$("#AllSongs").hide();
		$(".hNavBarInLibrary").addClass('hNavActive');
	});
	var albumId = '<?php echo $albumId ?>';


	$("#showAll").click(function () {
		if ($(this).text() == "Show all songs from the album ⬇") {
			$("#inLibrarySongs").hide();
			$("#AllSongs").show();
			$(this).text("Show songs from my music ⬆");
		}
		else {
			$("#inLibrarySongs").show();
			$("#AllSongs").hide();
			$("#inLibrarySongs").load(location.href + " #inLibrarySongs>*", "");
			checkContainer();
			$(this).text("Show all songs from the album ⬇");
		}
	});


	count = 0;
	function checkContainer() {

		themeSwitch();  //Adds a grid to the html
		count++;
		console.log(count);
		if (count < 30) setTimeout(checkContainer, 50); //wait 50 ms, then try again
		else count = 0;

	}




</script>


<?php
echo "<script> var count=0; var page_title = \"album : " . $album->getTitle() . "\" ; document.title = page_title ;</script>";
$src = $album->getArtworkPath();
$image = imagecreatefromstring(file_get_contents($src));
$thumb = imagecreatetruecolor(1, 1);
imagecopyresampled($thumb, $image, 0, 0, 0, 0, 1, 1, imagesx($image), imagesy($image));
$mainColor = strtoupper(dechex(imagecolorat($thumb, 0, 0)));

echo "<script> var firstcolor = '#$mainColor' ; var secondcolor = theme == 1 ? '#181818' : '#fff' ;</script>"; ?>
<script>
	$(".artistTopViewContainer").css("background-image", "linear-gradient(to right," + firstcolor + "," + secondcolor);
</script>

<div id="albumContainer">
	<div class='artistTopViewContainer'>

		<div id="leftContainer">
			<img src="<?php echo $artwork; ?>" id="albumMainPic">

		</div>
		<div id="rightContainer">
			<div id="artistName">
				<?php echo $album->getTitle(); ?>
			</div>
			<div class="by">
				by <span role="link" tabindex="0" onclick="openPage('artist.php?id=<?php echo $artistId; ?>')"> <b>
						<?php echo $artist->getName(); ?>
					</b> </span>
			</div>
			<div id="artistInfo">

				<?php echo $album->getNumberOfSongs(); ?> songs •
				<?php echo $album->getGenreName(); ?> •
				<?php echo $album->getYear(); ?>
			</div>
			<br> <br> <br>
			<div class='headerControls'>
				<span onclick='playFirstSong()'> <img src="assets/images/icons/play (2).png" alt="Play"
						title='Play All'> &nbsp; Play All </span>
				<span onclick='makeShuffle(tempPlaylist)'> <img src="assets/images/icons/shuffle (2).png" alt="Shuffle"
						title='Shuffle All'> &nbsp; Shuffle </span>
			</div>
		</div>
	</div>


	<div class="tracklistContainer" id="inLibrarySongs">
		<?php

		$songquery = mysqli_query($con2, "SELECT * FROM $username WHERE album=$albumId ORDER BY albumorder");
		if (mysqli_num_rows($songquery) == 0) {
			echo "<div class='noSongs'> 
					<h1>Currently you have no songs </h1> 
					<div class= 'noSongWrap'> 
						
						<img src='assets/images/icons/album.png' title=''>
						<ul> <li class='noSongWrap1'> Add songs from the album </li> <li class='noSongWrap2' role='link'> Go to album </li> </ul>	 
					</div>
					
				</div>";
		}

		?>
		<script>
			$(document).on("click", ".noSongWrap2", function () {
				$("#showAll").trigger("click");
			});
		</script>
		<ul class="tracklist">
			<?php



			$array = array();

			while ($row = mysqli_fetch_array($songquery)) {
				array_push($array, $row['library']);
			}


			foreach ($array as $d) {

				$song = new Song($con, $d);
				$songIdUser = $song->getId();
				$queryplays = mysqli_query($con2, "SELECT plays FROM $username WHERE library='$songIdUser'");
				$queryplays = mysqli_fetch_array($queryplays);
				$queryplays = $queryplays['plays'];
				echo "<li class='tracklistRow'>
					<div class='trackCount'>
					
						<img class='play zoom' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $songIdUser . "\", tempPlaylistInLibrary, true)'>
						<span class='trackNumber'>" . $song->getalbumOrder() . "</span>
					
					</div>


					<div class='trackInfo'>
						<span class='trackName'>" . $song->getTitle() . "</span>
						<span role='white' class='artistName' onclick='openPage(\"artist.php?id=" . $song->getArtist()->getId() . "\")'>" . $song->getArtist()->getName() . "</span> &nbsp;
						<span role='white' class='featName' onclick='openPage(\"artist.php?id=" . $song->getFeat()->getId() . "\")'>" . $song->getFeat()->getFeatName() . "</span>

					</div>


					<div class='trackPopularityWithoutBG'>
						<input type='hidden' class='songId' value='" . $songIdUser . "'>
						<span class='popularity'>" . $queryplays . " plays</span>
					</div>

					<div class='trackOptions'>
						<input type='hidden' class='id' value='" . $songIdUser . "' name='song'>
						<img class='optionsButton zoom' title='Options' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
						
					</div>

					<div class='trackDuration'>
						<span class='duration'>" . $song->getDuration() . "</span>
					</div>


				</li>";
			}
			?>
			<script>
				var tempSongIds = '<?php echo json_encode($array); ?>';
				tempPlaylistInLibrary = JSON.parse(tempSongIds);


				for (var i = 0; i < tempPlaylistInLibrary.length; i++) {
					item = tempPlaylistInLibrary[i];
					console.log(item);
					$(".songin" + item).attr("src", "assets/images/icons/checkmark.png");
				}
			</script>

		</ul>

	</div>



	<div class="tracklistContainer" id="AllSongs">
		<ul class="tracklist">

			<?php
			$songIdArray = $album->getSongIds();


			$i = 1;
			foreach ($songIdArray as $songId) {

				$albumSong = new Song($con, $songId);
				$albumArtist = $albumSong->getArtist();
				$p = $albumSong->getPopularityBar();
				$up = 20 - $p;





				echo "<li class='tracklistRow'>
						<div class='trackCount'>
							<img class='play zoom' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $songId . "\", tempPlaylist, true)'>
							<span class='trackNumber'>" . $albumSong->getalbumOrder() . "</span>
						</div>


						<div class='trackInfo'>
							<span class='trackName'>" . $albumSong->getTitle() . "</span>
							<span role='white' class='artistName' onclick='openPage(\"artist.php?id=" . $albumSong->getArtist()->getId() . "\")'>" . $albumArtist->getName() . "</span> &nbsp;
							<span role='white' class='featName' onclick='openPage(\"artist.php?id=" . $albumSong->getFeat()->getId() . "\")'>" . $albumSong->getFeat()->getFeatName() . "</span>
						</div>

						<div class='trackPopularity'>";
				while ($p > 0) {
					echo "<div class='highlighted-popularitybar'></div>";
					$p--;
				}
				while ($up > 0) {
					echo "<div class='unhighlighted-popularitybar'></div>";
					$up--;
				}


				echo "<span class='popularity'>" . $albumSong->getPopularity() . " spins</span>
							
						</div>

						<div class='trackOptions'>
							<input type='hidden' class='id' value='" . $songId . "' name='song'>
							<img class='optionsButton zoom' title='Options' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
						</div>

						<div class='trackDuration'>
							<span class='duration'>" . $albumSong->getDuration() . "</span>
						</div>

						<div class='trackInLibrary'>
							<input type='hidden' class='songId' value='" . $songId . "'>
							<img role='link' class='songin" . $songId . " addToLibraryButton' title='Add to My Music' src='assets/images/icons/add2.png' onclick=addToLibrary(this)>
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
	</div>

	<span id="showAll" role='link'>Show all songs from the album ⬇</span>
	<span id="copyright"> ©
		<?php echo $album->getYear(); ?> licensed to
		<?php echo $artist->getName(); ?>
	</span>


	<nav class="optionsMenu">
		<input type="hidden" class="id" name=''>
		<?php echo Playlist::getPlaylistsDropdown($con, $username); ?>
		<div class='item' onclick='addToQueue(this)'><img class='addToQueue zoom' src='assets/images/icons/add.png'>Add
			to Queue</div>
		<div class='item' onclick='addToNext(this)'><img class='addToNext zoom'
				src='assets/images/icons/play-next.png'>Play Next</div>
	</nav>

</div>




<?php

$albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE genre = (SELECT genre FROM albums WHERE id=$albumId) ");

if (mysqli_num_rows($albumQuery) != 1) {
	echo "<span class='mainContentTop'>More like this...</span>";
}

echo "<div class='gridViewContainer'>";
while ($row = mysqli_fetch_array($albumQuery)) {


	if ($row['id'] != $albumId) {

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
}
?>

</div>