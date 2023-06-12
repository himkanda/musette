<?php include("includes/includedFiles.php");  ?>
<script>
    $(document).ready(function(){
        off();
    })

	$('body').scrollTop(0); 
	var page_title = 'Playlists' ;
	document.title = page_title ; 
	var a = 2; 
	themeSwitch();

</script>

<span class='mainContentTop'> Playlists... &nbsp; <button class='button blue zoom' onclick='createPlaylist()'> NEW PLAYLIST </button></span>
		
<div id='playlistsContainer'>

<div class='gridViewContainer'>


<?php 
			
	$username = $userLoggedIn->getUsername();

	$playlistsQuery = mysqli_query($con, "SELECT * FROM playlists WHERE owner='$username'");

	if(mysqli_num_rows($playlistsQuery) == 0) {
		echo "<span class='noResults'>You don't have any playlists yet.</span>";
	}

	while($row = mysqli_fetch_array($playlistsQuery)) {

		$playlist = new Playlist($con, $row);

		echo "<div class='gridViewItem'>

					<div class='playlistImage allArtistGridViewImage' role='link'>
						<img src='". $playlist->getPic()."' onclick='openPage(\"playlist.php?id=" . $playlist->getId() . "\")'>
						<img class='playIconShortcut zoom' src='assets/images/icons/playIconShortcut.png' onclick='playIconShortcut(\"playlist\", ". $playlist->getId() .")'>
						<input type='hidden' class='id' value='" . $playlist->getId() . "' name='playlist'>
						<img class='addIconShortcut zoom optionsButton' src='assets/images/icons/addIconShortcut.png' onclick='showOptionsMenu(this)'>
                        
					</div>
					
					<div class='gridViewInfo'>"
						. $playlist->getName() .
					"</div>
				</div>";



	}






		echo "
		</div>
		</div> ";		
?>


<span class='mainContentTop'> Saved playlists... </span>
	
	<div id='playlistsContainer'>
	
	<div class='gridViewContainer'>
	
	
	<?php 
	
		$playlistmeQuery = mysqli_query($con2, "SELECT * FROM savedplaylist WHERE userName='$username'");
	
		if(mysqli_num_rows($playlistmeQuery) == 0) {
			echo "<span class='noResults'>You don't have any saved playlists yet.</span>";
		}
	
		while($row = mysqli_fetch_array($playlistmeQuery)) {
	
			$playlistme = new Playlist($con, $row['playlistId']);
	
			echo "<div class='gridViewItem'>
	
						<div class='playlistImage allArtistGridViewImage' role='link'>
							<img src='". $playlistme->getPic()."' onclick='openPage(\"playlist.php?id=" . $playlistme->getId() . "\")'>
							<img class='playIconShortcut zoom' src='assets/images/icons/playIconShortcut.png' onclick='playIconShortcut(\"playlist\", ". $playlistme->getId() .")'>
							<input type='hidden' class='id' value='" . $playlistme->getId() . "' name='playlist'>
							<img class='addIconShortcut zoom optionsButton' src='assets/images/icons/addIconShortcut.png' onclick='showOptionsMenu(this)'>
						</div>
						
						<div class='gridViewInfo'>"
							. $playlistme->getName() ." (by ". $playlistme->getOwner() .")".
						"</div>
					</div>";
	
	
	
		}
	
	
	
	


	echo "
	</div>
	</div> ";		
?>
    <nav class="optionsMenu">
        <input type="hidden" class="id" name=''>
        <?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
        <div class='item' onclick='addToQueue(this)'><img class='addToQueue zoom' src='assets/images/icons/add.png'>Add to Queue</div>
        <div class='item' onclick='addToNext(this)'><img class='addToNext zoom' src='assets/images/icons/play-next.png'>Play Next</div>
    </nav>
