<?php include("includes/includedFiles.php");  ?>
<script> 

	$(document).ready(function(){
		off();

	})
	themeSwitch(); getTotalTimeNP(); 

</script>

<?php 	
	if(isset($_GET['id']) && isset($_GET['userLoggedIn'])) {
		$playlistId = $_GET['id'];
		$playlist = new Playlist($con, $playlistId);
		$owner = new User($con, $playlist->getOwner());
		$realowner = $_GET['userLoggedIn'];
		$theowner = $playlist->getOwner();
		$ispublic = $playlist->checkPublic() == 1 ? "checked" : "";

		if($realowner == $theowner){
			$proceed = 1;
		}
		else{
			$proceed = 0;
		}
		echo "<script> var page_title = \"playlist : ". $playlist->getName(). "\" ; document.title = page_title ; </script>";
		

		if($proceed == 1){ ?>

		
		<div id='playlistContainer'>
		<div class='entityInfo'>

			<div class='leftSection'>
				<div class='playlistImage'>
					<img src='<?php echo $playlist->getPic() ?>'>
				</div>
			</div>
			<script>
				$('#checkbox1').on('click',function() {
					if(this.checked) {
						makePublicPrivate('public', <?php echo $playlistId ?>); 
						$(this).trigger('change');
						return;
					}
					else{ 
						makePublicPrivate('private', <?php echo $playlistId ?>);
						$(this).trigger('change'); 
						return;
					}
					      
				});
			</script>
			<div class='rightSection'>
				
				<h2> <?php echo $playlist->getName(); ?> </h2>
				<p>By <?php echo $playlist->getOwner(); ?> </p>
				<p> <?php echo $playlist->getNumberOfSongs();?> songs • <span id='getTotalTimeNP'></span></p>
				<p> created on <?php echo $playlist->getDate(); ?> </p>
				<p style="display: flex"> Public &nbsp; <input type="checkbox" id="checkbox1" <?php echo $ispublic ?>> </p>
				<div class='headerControls'>
					<span  onclick='playFirstSong()'> <img src="assets/images/icons/play (2).png" alt="Play" title='Play All'> &nbsp; Play All </span>
					<span onclick='makeShuffle(tempPlaylist)'> <img src="assets/images/icons/shuffle (2).png" alt="Shuffle" title= 'Shuffle All' >  &nbsp; Shuffle </span>
					<span onclick='renamePlaylist( <?php echo $playlistId; ?> )'> <img src="assets/images/icons/rename.png" alt="Rename" title='Rename'>  &nbsp; Rename </span> 
					<span onclick='deletePlaylist( <?php echo $playlistId; ?> )'> <img src="assets/images/icons/delete.png" alt="Delete" title='Delete Playlist'>  &nbsp; Delete </span> 
				</div>
			</div>

		</div>


		<div class='tracklistContainer'>
			<ul class='tracklist'> 
				
				
			<?php 	$songIdArray = $playlist->getSongIds();
				
				if(sizeof($songIdArray) == 0){ 
					echo "<div class='noSongs'> 
							<h1>What's a playlist without music? </h1> 
							<div class= 'noSongWrap'> 	
								<img src='assets/images/icons/album.png' title=''>
								<ul> <li class='noSongWrap1'> Add songs from your collection </li> <li class='noSongWrap2' role='link' onclick='openPage(\"yourSongs.php\")'> Go to Songs </li> </ul>	 
							</div>
							
						</div>"; 
				}
				
			

				$i = 1;
				foreach($songIdArray as $songId) {

					$playlistSong = new Song($con, $songId);
					$songArtist = $playlistSong->getArtist(); 

					echo "<li class='tracklistRow'>
							<div class='trackCount'>
								<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $songId . "\", tempPlaylist, true)'>
								<img class='removeNP' title='Remove' src='assets/images/icons/remove.png' onclick='removeFromPlaylist(\"". $songId ."\", ". $playlistId .")'> </span>
								<span class='trackNumber'>$i</span>
							</div>


							<div class='trackInfo'>
								<span class='trackName'>" . $playlistSong->getTitle() . "</span>
								<span role='white' class='albumName' onclick='openPage(\"album.php?id=" . $playlistSong->getAlbum()->getId() . "\")'>" . $playlistSong->getAlbum()->getTitle() . "</span>
		
							</div>

							<div class= 'trackInfoMore'>
								<span role='white' class='artistName' onclick='openPage(\"artist.php?id=" . $songArtist->getId() . "\")'>" . $songArtist->getName() . "</span> 
								<span role='white' class='featName' onclick='openPage(\"artist.php?id=" . $playlistSong->getFeat()->getId() . "\")'>" . $playlistSong->getFeat()->getFeatName() . "</span>
							</div>

							<div class='trackOptions'>
								<input type='hidden' class='id' value='" . $songId . "' name='song'>
								<img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
							</div>

							<div class='trackDuration'>
								<span class='duration'>" . $playlistSong->getDuration() . "</span>
							</div>


						</li>";

					$i = $i + 1;
				}

				echo "

				<script>
					
					var tempSongIds = ". json_encode($songIdArray ) ."; 
					tempSongIds = JSON.stringify(tempSongIds);
					
					tempPlaylist = JSON.parse(tempSongIds);
					
				</script>

			</ul>
		</div>

		<nav class='optionsMenu'>
			<input type='hidden' class='id' name=''>";
			echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); 
			echo "<div class='item' onclick='addToQueue(this)'><img class='addToQueue zoom' src='assets/images/icons/add.png'>Add to Queue</div>
			<div class='item' onclick='addToNext(this)'><img class='addToNext zoom' src='assets/images/icons/play-next.png'>Play Next</div>
		</nav>



		</div>";

	}
	else if ($proceed == 0){ 
		 if($ispublic == '') {
			 echo "<h1> You do not have any authorization to view this playlist</h1> ";
			 exit();
		 } 
		?>

		
			<div id='playlistContainer'>
			<div class='entityInfo'>
	
				<div class='leftSection'>
					<div class='playlistImage'>
						<img src='<?php echo $playlist->getPic() ?>'>
					</div>
				</div>
	
				<div class='rightSection'>
					<?php 
						$query9 = mysqli_query($con2, "SELECT * FROM savedplaylist WHERE userName = '$realowner' and playlistId = '$playlistId'");
						if (mysqli_num_rows($query9)==0){
							$nametoshow = "Save";
							$icontoshow = "more";
						}
						else{
							$nametoshow="Remove";
							$icontoshow = "delete";

						}
					?> 
					<h2> <?php echo $playlist->getName(); ?> </h2>
					<p>By <?php echo $playlist->getOwner(); ?> </p>
					<p> <?php echo $playlist->getNumberOfSongs();?> songs • <span id='getTotalTimeNP'></span></p>
					<p> created on <?php echo $playlist->getDate(); ?> </p>
					<div class='headerControls'>
						<span  onclick='playFirstSong()'> <img src="assets/images/icons/play (2).png" alt="Play" title='Play All'> &nbsp; Play All </span>
						<span onclick='makeShuffle(tempPlaylist)'> <img src="assets/images/icons/shuffle (2).png" alt="Shuffle" title= 'Shuffle All' >  &nbsp; Shuffle </span>
						<span class='savePlaylistButton' onclick='savePlaylistToMyLibrary(<?php echo $playlistId; ?>)'> 
							<img src="assets/images/icons/<?php echo $icontoshow ?>.png"> &nbsp; <?php echo $nametoshow; ?>
						</span> 
					</div>
				</div>
	
			</div>
	
	
			<div class='tracklistContainer'>
				<ul class='tracklist'> 
					
					
				<?php 	$songIdArray = $playlist->getSongIds();

					if(sizeof($songIdArray) == 0){ 
						echo "<span class='grey'> This playlist currently have no songs... <br> Please come back later </span>"; 
						exit();
					}

					$i = 1;
					foreach($songIdArray as $songId) {
	
						$playlistSong = new Song($con, $songId);
						$songArtist = $playlistSong->getArtist(); 
	
						echo "<li class='tracklistRow'>
								<div class='trackCount'>
									<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $songId . "\", tempPlaylist, true)'>
									<span class='trackNumber'>$i</span>
								</div>
	
	
								<div class='trackInfo'>
									<span class='trackName'>" . $playlistSong->getTitle() . "</span>
									<span role='white' class='albumName' onclick='openPage(\"album.php?id=" . $playlistSong->getAlbum()->getId() . "\")'>" . $playlistSong->getAlbum()->getTitle() . "</span>
			
								</div>
	
								<div class= 'trackInfoMore'>
									<span role='white' class='artistName' onclick='openPage(\"artist.php?id=" . $songArtist->getId() . "\")'>" . $songArtist->getName() . "</span> 
									<span role='white' class='featName' onclick='openPage(\"artist.php?id=" . $playlistSong->getFeat()->getId() . "\")'>" . $playlistSong->getFeat()->getFeatName() . "</span>
								</div>
	
								<div class='trackOptions'>
									<input type='hidden' class='id' value='" . $songId . "' name='song'>
									<img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
								</div>
	
								<div class='trackDuration'>
									<span class='duration'>" . $playlistSong->getDuration() . "</span>
								</div>
	
	
							</li>";
	
						$i = $i + 1;
					}
	
					echo "
	
					<script>
						
						var tempSongIds = ". json_encode($songIdArray ) ."; 
						tempSongIds = JSON.stringify(tempSongIds);
						
						tempPlaylist = JSON.parse(tempSongIds);
						
					</script>
	
				</ul>
			</div>
	
			<nav class='optionsMenu'>
				<input type='hidden' class='id' name=''>";
				echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); 
				echo "<div class='item' onclick='addToQueue(this)'><img class='addToQueue zoom' src='assets/images/icons/add.png'>Add to Queue</div>
				<div class='item' onclick='addToNext(this)'><img class='addToNext zoom' src='assets/images/icons/play-next.png'>Play Next</div>
			</nav>
	
	
	
			</div>";
	
	}


	}
	
?>


