<?php
include("includes/includedFiles.php");

if(isset($_GET['term'])) {
	$term = urldecode($_GET['term']);
}
else {
	$term = "";
}
?>
<script> 
    var page_title = "Search";
	document.title= page_title;
	$(document).ready(function(){
        off();
    })
</script>
<div class="searchContainer">

	<input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Search for an artist, album or song...">

</div>

<script>
	themeSwitch();
	$("body").scrollTop(0); 
	$('.searchInput').focus();
	var tmpStr = $('.searchInput').val();
	$('.searchInput').val('');
	$('.searchInput').val(tmpStr);

	$(function() {
		
		$(".searchInput").keyup(function() {
			clearTimeout(timer);

			timer = setTimeout(function() {
				var val = $(".searchInput").val();
				var cleaned_val = val.replace('"', '\\"');
				cleaned_val = cleaned_val.replace("'", "\\'");
				
				openPage("search.php?term=" + cleaned_val);
			}, 200);

		})


	})

</script>

<?php if($term == "") exit(); ?>
<h1 style='margin : 5px; padding: 22px; background-color : #0078D7'>Results for "<?php echo $term; ?>"</h1>

<div class="allArtistContainer borderBottom">

<div class="mainContentTop">Artists ...  </div>

	<?php
	$artistsQuery = mysqli_query($con, "SELECT id FROM artists WHERE name LIKE '%$term%' LIMIT 10");
	
	if(mysqli_num_rows($artistsQuery) == 0) {
		echo "<span class='noResults'>No artists found matching " . $term . "</span>";
	}

	while($row = mysqli_fetch_array($artistsQuery)) {

		$artistFound = new Artist($con, $row['id']);

		echo "<div class='gridViewItem'>
				<div class='artistName'>
					<span class='allArtistGridViewImage' role='link'>
						<img src=" . $artistFound->getPic() ." style='border-radius: 50%' onclick='openPage(\"artist.php?id=" . $artistFound->getId() ."\")'>
						<img class='playIconShortcut zoom' src='assets/images/icons/playIconShortcut.png' onclick='playIconShortcut(\"artist\", ". $artistFound->getId() .")'>
						<input type='hidden' class='id' value='" . $artistFound->getId() . "' name='artist'>
						<img class='addIconShortcut zoom optionsButton' src='assets/images/icons/addIconShortcut.png' onclick='showOptionsMenu(this)'>
					</span>
					<div class='gridViewInfo' >". $artistFound->getName() . "</div>
					

				</div>

			</div>";

	}


	?>

</div>

<div class="allArtistContainer borderBottom">
<div class="mainContentTop">Albums...   </div>
	<?php
		$albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE title LIKE '%$term%' LIMIT 10");

		if(mysqli_num_rows($albumQuery) == 0) {
			echo "<span class='noResults'>No albums found matching " . $term . "</span>";
		}

		while($row = mysqli_fetch_array($albumQuery)) {

			echo "<div class='gridViewItem'>
					<span role='link' class='allArtistGridViewImage' >
						<img src='" . $row['artworkPath'] . "' class='hover-shadow'  onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
						<img class='playIconShortcut zoom' src='assets/images/icons/playIconShortcut.png' onclick='playIconShortcut(\"album\", ". $row['id'] .")'>
						<input type='hidden' class='id' value='" . $row['id'] . "' name='album'>
						<img class='addIconShortcut zoom optionsButton' src='assets/images/icons/addIconShortcut.png' onclick='showOptionsMenu(this)'>
					</span>
						<div class='gridViewInfo'>"
							. $row['title'] .
						"</div>
					

				</div>";



		}
	?>

</div>


<div class="tracklistContainer ">
<div class="mainContentTop">Songs ...  </div>
	
		
		<?php
		$songsQuery = mysqli_query($con, "SELECT id FROM songs WHERE title LIKE '%$term%' LIMIT 10");

		if(mysqli_num_rows($songsQuery) == 0) {
			echo "<span class='noResults'>No songs found matching " . $term . "</span>";
		}

		echo "<ul class='tracklist'>";

		$songIdArray = array();

		$i = 1;
		while($row = mysqli_fetch_array($songsQuery)) {

			if($i > 15) {
				break;
			}

			array_push($songIdArray, $row['id']);

			$albumSong = new Song($con, $row['id']);
			$albumArtist = $albumSong->getArtist();

			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
						<span class='trackNumber'>$i</span>
					</div>


					<div class='trackInfo'>
						<span class='trackName'>" . $albumSong->getTitle() . "</span>
						<span role='white' class='artistName' onclick='openPage(\"artist.php?id=" . $albumArtist->getId() . "\")'>" . $albumArtist->getName() . "</span>
					</div>

					<div class='trackInfoMore'>
						<span role='white' class='albumName' onclick='openPage(\"album.php?id=" . $albumSong->getAlbum()->getId() . "\")'>" . $albumSong->getAlbum()->getTitle() . "</span>
					</div>

					<div class='trackOptions'>
						<input type='hidden' class='id' value='" . $albumSong->getId() . "' name='song'>
						<img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
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
</div>


<nav class="optionsMenu">
	<input type="hidden" class="id" name=''>
	<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
	<div class='item' onclick='addToQueue(this)'><img class='addToQueue zoom' src='assets/images/icons/add.png'>Add to Queue</div>    
	<div class='item' onclick='addToNext(this)'><img class='addToNext zoom' src='assets/images/icons/play-next.png'>Play Next</div>

</nav>


<div class="allArtistContainer borderBottom">
<div class="mainContentTop">Playlists ...  </div>

	<?php
	$username = $userLoggedIn->getUsername();
	$playlistsQuery = mysqli_query($con, "SELECT * FROM playlists WHERE name LIKE '%$term%' AND public = 1 UNION SELECT * FROM playlists WHERE name LIKE '%$term%' AND owner ='$username' LIMIT 10");

	if(mysqli_num_rows($playlistsQuery) == 0) {
		echo "<span class='noResults'>No playlists found matching " . $term . "</span>";
	}

	while($row = mysqli_fetch_array($playlistsQuery)) {

		$playlist = new Playlist($con, $row);
		if($userLoggedIn->getUsername() == $playlist->getOwner()){
			$proceed = "created by you";
		}
		else{
			$proceed = "public playlist by ".$playlist->getOwner();
		}

		echo "<div class='gridViewItem' >

					<div class='playlistImage allArtistGridViewImage' role='link'>
						<img src='".$playlist->getPic()."' onclick='openPage(\"playlist.php?id=" . $playlist->getId() . "\")'>
						<img class='playIconShortcut zoom' src='assets/images/icons/playIconShortcut.png' onclick='playIconShortcut(\"playlist\", ". $playlist->getId() .")'>
						<input type='hidden' class='id' value='" . $playlist->getId() . "' name='playlist'>
						<img class='addIconShortcut zoom optionsButton' src='assets/images/icons/addIconShortcut.png' onclick='showOptionsMenu(this)'>
					</div>
					
					<div class='allArtistGridViewInfo'>"
						. $playlist->getName() .
					"</div>

					<div class='allArtistGridViewInfo2'>". $proceed ."</div>
				</div>";



	}


	?>

</div>