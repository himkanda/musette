<?php 
    include("includes/includedFiles.php"); 
    $username = $userLoggedIn->getUsername();
?>


<script> 
    $(document).ready(function(){
        off();
    })
    var page_title = "Home";
	document.title= page_title;
	themeSwitch();
	$("body").scrollTop(0); 
</script>


<span class="mainContentTop">Recently played...</span>
<span class="mainContentInfo"> ⏳ A visual history of the music you played. It contains artists, albums and playlists you listened to earlier. </span>
<div class="gridViewContainer">
<?php

    $query2 = mysqli_query($con2, "SELECT id, typesid, type, username, max(time) time FROM recentlyplayed WHERE username = '$username' GROUP BY typesid, type, username ORDER BY time desc LIMIT 20");
     

    while($row = mysqli_fetch_array($query2)) {
        if($row['type']=='artist'){

            $artist = new Artist($con,$row['typesid']);

            echo "<div class='allArtistGridViewItem divBGblue'>
                        <span  tabindex='0' class='allArtistGridViewImage'>
                            <img src='" . $artist->getPic() . "' onclick='openPage(\"artist.php?id=" . $row['typesid'] . "\")' role='link' style='border-radius: 50%'>
                            <img class='playIconShortcut zoom' src='assets/images/icons/playIconShortcut.png' onclick='playIconShortcut(\"artist\", ". $row['typesid'] .")'>
                            <input type='hidden' class='id' value='" . $row['typesid'] . "' name='artist'>
                            <img class='addIconShortcut zoom optionsButton' src='assets/images/icons/addIconShortcut.png' onclick='showOptionsMenu(this)'>

                            <div class='gridViewInfo'>"
                                . $artist->getName() .
                            "</div>
                            <div class='gridViewInfo3'> ARTIST </div>
                        </span>
                    </div>";
        }

        elseif ($row['type']=='album'){

            $album = new Album($con,$row['typesid']);

            echo "<div class='gridViewItem divBGblue'>
                        <span  tabindex='0' class='allArtistGridViewImage'>
                            <img src='" . $album->getArtworkPath() . "' onclick='openPage(\"album.php?id=" . $row['typesid'] . "\")' role='link' style='border-radius: 10%'>
                            <img class='playIconShortcut zoom' src='assets/images/icons/playIconShortcut.png' onclick='playIconShortcut(\"album\", ". $row['typesid'] .")'>
                            <input type='hidden' class='id' value='" . $row['typesid'] . "' name='album'>
                            <img class='addIconShortcut zoom optionsButton' src='assets/images/icons/addIconShortcut.png' onclick='showOptionsMenu(this)'>

                            <div class='gridViewInfo'>"
                                . $album->getTitle() .
                            "</div>
                            <div class='gridViewInfo2'> " 
                                . $album->getArtist()->getName() .
                            "</div>
                            <div class='gridViewInfo3'> ALBUM </div>
                            
                        </span>
                    </div>";
        }

        elseif($row['type']=='playlist'){

            $playlistme = new Playlist($con, $row['typesid']);
	
			echo "<div class='gridViewItem divBGblue' >

						<div class='playlistImage allArtistGridViewImage'>
							<img role='link' src='". $playlistme->getPic()."' onclick='openPage(\"playlist.php?id=" . $playlistme->getId() . "\")'>
							<img class='playIconShortcut zoom' src='assets/images/icons/playIconShortcut.png' onclick='playIconShortcut(\"playlist\", ". $playlistme->getId() .")'>
							<input type='hidden' class='id' value='" . $playlistme->getId() . "' name='playlist'>
							<img class='addIconShortcut zoom optionsButton' src='assets/images/icons/addIconShortcut.png' onclick='showOptionsMenu(this)'>

						</div>
						
						<div class='gridViewInfo'>"
							. $playlistme->getName().
                        "</div>
                        <div class='gridViewInfo2'> by " 
                             . $playlistme->getOwner() .
                        "</span></div>
                        <div class='gridViewInfo3'> PLAYLIST </div>
					</div>";
	
	
	
		}
    }
    

?>
</div>













<span class="mainContentTop">Your most played songs...</span>

<div class="headerButtons"> &nbsp; &nbsp;
	<button onclick='playFirstSong()' class='zoomless blue button'>  Play </button>
</div>

<div class="tracklistContainer ">
    <ul class="tracklist">
        
        <?php
        $i=1;
        $songQuery = mysqli_query($con2, "SELECT * FROM $username WHERE plays>0 ORDER BY plays desc LIMIT 40 ");
        $songIdArray = array();
        while($row = mysqli_fetch_array($songQuery) ) {
            array_push($songIdArray, $row['library']);
            if($i<21){

            
                
                $songId = $row['library'];
                $song = new Song($con, $songId);
                


                echo "<li class='tracklistRow'>
                        <div class='trackCount'>
                            <img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $songId . "\", tempPlaylist, true)'>
                            <span class='trackNumber'>$i</span>
                        </div>


                        <div class='trackInfo'>
                            <span class='trackName'>" . $song->getTitle() . "</span>
                            <span role='white' class='artistName' onclick='openPage(\"artist.php?id=" . $row['artist'] . "\")'>" . $song->getArtist()->getName() . "</span>  
                            
                        </div>

                        <div class='trackInfoMore'> <span role='white' class='albumName' onclick='openPage(\"album.php?id=" . $row['album'] . "\")'>" . $song->getAlbum()->getTitle() . " </span></div>
                        
                        <div class='trackPopularityWithoutBG'>
                            <span class='popularity'>" . $row['plays'] .  " spins</span>
                        </div>

                        <div class='trackOptions'>
                            <input type='hidden' class='id' value='" . $songId . "' name='song'>
                            <img class='optionsButton zoom' title='Options' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
                            </div>

                        <div class='trackDuration'>
                            <span class='duration'>" . $song->getDuration() . "</span>
                        </div>


                    </li>";
            }
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
