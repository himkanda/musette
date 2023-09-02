<?php
include("includes/includedFiles.php");
$username = $userLoggedIn->getUsername();
?>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<link rel="stylesheet" href="assets/css/swiper.min.css">
<style>
	html,
	body {
		position: relative;
		height: 100%;
	}

	body {
		font-size: 14px;
		color: #000;
		margin: 0;
		padding: 0;
	}

	.swiper-container {
		padding: 10px 0;
		width: 100%;
		height: 300px;
	}

	.swiper-slide {
		cursor: pointer;
		width: 100%;
		color: black;
		text-align: center;
		font-size: 18px;
		background: #fff;
		/* Center slide text vertically */
		display: -webkit-box;
		display: -ms-flexbox;
		display: -webkit-flex;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		-webkit-justify-content: center;
		justify-content: center;
		-webkit-box-align: center;
		-ms-flex-align: center;
		-webkit-align-items: center;
		align-items: center;
		background-size: cover;
		background-position: center;
	}
</style>



<div class="swiper-container">
	<div class="swiper-wrapper">
		<div class="swiper-slide" style="background-image:url(assets/images/slideshow/two.jpg)"
			onclick="openPage('album.php?id=12')"></div>
		<div class="swiper-slide" style="background-image:url(assets/images/slideshow/three.jpg)"
			onclick="openPage('artist.php?id=6')"></div>
		<div class="swiper-slide" style="background-image:url(assets/images/slideshow/four.jpg)"
			onclick="openPage('artist.php?id=8')"></div>
		<div class="swiper-slide" style="background-image:url(assets/images/slideshow/one.jpg)"
			onclick="openPage('playlist.php?id=33')"></div>
		<div class="swiper-slide" style="background-image:url(assets/images/slideshow/six.jpg)"
			onclick="openPage('artist.php?id=10')"></div>
		<div class="swiper-slide" style="background-image:url(assets/images/slideshow/five.jpg)"
			onclick="openPage('album.php?id=9')"></div>
	</div>
	<!-- Add Pagination -->

	<!-- Add Arrows -->
	<div class="swiper-button-next"></div>
	<div class="swiper-button-prev"></div>
</div>

<!-- Swiper JS -->
<script src="assets/js/swiper.min.js"></script>

<!-- Initialize Swiper -->
<script>
	var swiper = new Swiper('.swiper-container', {
		slidesPerView: 1.2,
		loop: true,
		spaceBetween: 30,
		centeredSlides: true,
		autoplay: {
			delay: 3500,
			disableOnInteraction: true,
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});
</script>



<script>
	$(document).ready(function () {
		off();
	})
	var page_title = "Browse";
	document.title = page_title;
	themeSwitch();
	$("body").scrollTop(0); 
</script>



<span class="mainContentTop">New releases...</span>
<span class="mainContentInfo"> 🆕 Take a look at the newly released music. Updated regularly everyday. </span>
<div class="gridViewContainer">
	<?php
	$newAlbumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY dateAdded desc LIMIT 5 ");

	while ($row = mysqli_fetch_array($newAlbumQuery)) {

		$artist = new Artist($con, $row['artist']);

		echo "<div class='gridViewItem divBGblue'>
					<span  tabindex='0' class='allArtistGridViewImage'>
						<img src='" . $row['artworkPath'] . "' onclick='openPage(\"album.php?id=" . $row[0] . "\")' role='link'>
						<img class='playIconShortcut zoom' src='assets/images/icons/playIconShortcut.png' onclick='playIconShortcut(\"album\", " . $row[0] . ")'>
						<input type='hidden' class='id' value='" . $row[0] . "' name='album'>
						<img class='addIconShortcut zoom optionsButton' src='assets/images/icons/addIconShortcut.png' onclick='showOptionsMenu(this)'>

						<div class='gridViewInfo'>"
			. $row['title'] .
			"</div>
						<div class='gridViewInfo2'> by "
			. $artist->getName() .
			"</div>
					</span>
				</div>";
	}
	?>
</div>


<span class="mainContentTop">You might also like ...</span>
<span class="mainContentInfo"> 📀 Recommended albums for you based on your listening experience. </span>
<div class="gridViewContainer">

	<?php
	$albumQuery = mysqli_query($con, "SELECT * FROM musette_app_data.albums AS t1 LEFT JOIN musette_user_data.$username AS t2 ON t1.id = t2.album WHERE t2.album is null ORDER BY RAND() LIMIT 5 ");

	while ($row = mysqli_fetch_array($albumQuery)) {

		$artist = new Artist($con, $row[2]);

		echo "<div class='gridViewItem divBGblue'>
					<span  tabindex='0' class='allArtistGridViewImage'>
						<img src='" . $row['artworkPath'] . "' onclick='openPage(\"album.php?id=" . $row[0] . "\")' role='link'>
						<img class='playIconShortcut zoom' src='assets/images/icons/playIconShortcut.png' onclick='playIconShortcut(\"album\", " . $row[0] . ")'>
						<input type='hidden' class='id' value='" . $row[0] . "' name='album'>
						<img class='addIconShortcut zoom optionsButton' src='assets/images/icons/addIconShortcut.png' onclick='showOptionsMenu(this)'>

						<div class='gridViewInfo'>"
			. $row['title'] .
			"</div>
						<div class='gridViewInfo2'> album by "
			. $artist->getName() .
			"</div>
					</span>

				</div>";

	}
	?>
</div>


<span class='mainContentTop'> Recommended playlists... </span>
<span class="mainContentInfo"> 🎶 These are just some of the playlists created by our users that we thought you would
	like. </span>
<div id='playlistsContainer'>

	<div class='gridViewContainer'>


		<?php

		$playlistmeQuery = mysqli_query($con, "SELECT * FROM playlists WHERE owner!='$username' AND public = 1 ORDER BY RAND() LIMIT 8");

		if (mysqli_num_rows($playlistmeQuery) == 0) {
			echo "Coming soon...";
		}

		while ($row = mysqli_fetch_array($playlistmeQuery)) {

			$playlistme = new Playlist($con, $row['id']);

			echo "<div class='gridViewItem' >

						<div class='playlistImage allArtistGridViewImage'>
							<img role='link' src='" . $playlistme->getPic() . "' onclick='openPage(\"playlist.php?id=" . $playlistme->getId() . "\")'>
							<img class='playIconShortcut zoom' src='assets/images/icons/playIconShortcut.png' onclick='playIconShortcut(\"playlist\", " . $playlistme->getId() . ")'>
							<input type='hidden' class='id' value='" . $playlistme->getId() . "' name='playlist'>
							<img class='addIconShortcut zoom optionsButton' src='assets/images/icons/addIconShortcut.png' onclick='showOptionsMenu(this)'>

						</div>
						
						<div class='gridViewInfo'>"
				. $playlistme->getName() . " (by " . $playlistme->getOwner() . ")" .
				"</div>
					</div>";



		}






		echo "
	</div>
	</div> ";
		?>
















		<span class="mainContentTop">All time most played...</span>
		<div class="headerButtons"> &nbsp; &nbsp;
			<button onclick='playFirstSong()' class='zoomless blue button'> Play </button>
		</div>

		<div class="tracklistContainer ">
			<ul class="tracklist">

				<?php
				$i = 1;
				$songQuery = mysqli_query($con, "SELECT * FROM songs ORDER BY plays desc LIMIT 10");
				$songIdArray = array();
				while ($row = mysqli_fetch_array($songQuery)) {
					$songId = $row['id'];
					$song = new Song($con, $songId);
					array_push($songIdArray, $row['id']);





					echo "<li class='tracklistRow'>
						<div class='trackCount'>
							<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $row['id'] . "\", tempPlaylist, true)'>
							<span class='trackNumber'>$i</span>
						</div>


						<div class='trackInfo'>
							<span class='trackName'>" . $row['title'] . "</span>
							<span role='white' class='artistName' onclick='openPage(\"artist.php?id=" . $row['artist'] . "\")'>" . $song->getArtist()->getName() . "</span>  
							
						</div>

						<div class='trackInfoMore'> <span role='white' class='albumName' onclick='openPage(\"album.php?id=" . $row['album'] . "\")'>" . $song->getAlbum()->getTitle() . " </span></div>
						
						<div class='trackPopularityWithoutBG'>
							<input type='hidden' class='songId' value='" . $song->getId() . "'>
							<span class='popularity'>" . $song->getPopularity() . " spins</span>
						</div>

						<div class='trackOptions'>
							<input type='hidden' class='id' value='" . $row['id'] . "' name='song'>
							<img class='optionsButton zoom' title='Options' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
							</div>

						<div class='trackDuration'>
							<span class='duration'>" . $row['duration'] . "</span>
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
		<nav class="optionsMenu">
			<input type="hidden" class="id" name=''>
			<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
			<div class='item' onclick='addToQueue(this)'><img class='addToQueue zoom'
					src='assets/images/icons/add.png'>Add to Queue</div>
			<div class='item' onclick='addToNext(this)'><img class='addToNext zoom'
					src='assets/images/icons/play-next.png'>Play Next</div>
		</nav>