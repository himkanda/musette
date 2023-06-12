<?php
header( 'Content-type: text/html; charset=utf-8' );
include("includes/includedFiles.php");
$username = $userLoggedIn->getUsername();
			
?>




<script>
    $(document).ready(function(){
        var sortSongBy = localStorage.getItem('sortSongBy') || 1;
        sortSongs(sortSongBy);
        $("#songSelect").val(sortSongBy).change();
        off();
        $(".shuffleAll").append( 'Shuffle All ('+$(".tracklist li").length +')');
    })
	var page_title = "Your Music";
	document.title = page_title;
	themeSwitch();
    
    
</script>










<script>
    var itemss = $('.tracklist > li').get();
    $.each(itemss, function(e, i) { e.originalIndex = i; });


    $("#songSelect").on('change', function(){
        var sortby = $("#songSelect").val();
        sortSongs(sortby);
        
    });
    
    function sortSongs(abcd){
        console.log(abcd);
        var items = $('.tracklist > li').get();
        localStorage.setItem('sortSongBy', abcd);
        if(abcd==1){

                    var ull = $('.tracklist');
                    $.each(itemss, function(a, i){
                        ull.append(i); /* This removes li from the old spot and moves it */
                    });            
        }
        else if(abcd==2){
                     items.sort(function(a,b){
                        var keyA = $(a).text();
                        var keyB = $(b).text();

                        if (keyA < keyB) return -1;
                        if (keyA > keyB) return 1;
                        return 0;
                    })
        }
        else if(abcd==3){
                    items.sort(function(a,b){
                        var keyA = $(a).children('.trackInfoMore').text();
                        var keyB = $(b).children(".trackInfoMore").text();

                        if (keyA < keyB) return -1;
                        if (keyA > keyB) return 1;
                        return 0;
                    })
        }
        else if(abcd==4){
                    items.sort(function(a,b){
                        var keyA = $(a).children('.trackInfo').children('.albumName').text();
                        var keyB = $(b).children(".trackInfo").children('.albumName').text();

                        if (keyA < keyB) return -1;
                        if (keyA > keyB) return 1;
                        return 0;
                    })
        }

                  
        if(abcd!=1){
            var ul = $('.tracklist');
                $.each(items, function(i, li){
                ul.append(li); /* This removes li from the old spot and moves it */
            });
        }
        /* checkContainer();*/

    }

    /* var count = 0;
	function checkContainer () {
		
		themeSwitch();  //Adds a grid to the html
		count++;
		
		if (count < 30) setTimeout(checkContainer, 50); //wait 50 ms, then try again
		else count=0;
		
	} */


</script>







<span class="mainContentTop">Your Songs... </span>






<div class="tracklistContainer yourMusicThree ">
    <div class="yourMusicOptions">
        <span onclick="makeShuffle(tempPlaylist)" class="shuffleAll" role="link"><img src="assets/images/icons/shuffle all.png" ></span>
        <span style='cursor: not-allowed'>Genre: All genres</span>        
        <span>
            Sort by: 
            
            <select id="songSelect" role='link'>
                <option value="1">Date added</option>
                <option value="2">A to Z</option>
                <option value="3">Artist</option>
                <option value="4">Album</option>
            </select>
            
        </span>
    </div>
    
    <ul class="tracklist">
    <?php 

        $songquery = mysqli_query($con2, "SELECT library FROM $username ORDER BY id DESC");
        $array3 = array();
        while($row = mysqli_fetch_array($songquery)) {
            array_push($array3, $row['library']);
        }

             
        foreach($array3 as $d){
            
            $song = new Song($con, $d);
            echo "<li class='tracklistRow'>
                <div class='trackCount'>
                    <img class='play zoom' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $song->getId() . "\", tempPlaylist, true)'>               
                </div>

                <div class='trackInfo'>
                    <span class='trackName'>" . $song->getTitle() . "</span>
                    <span role='white' class='albumName' onclick='openPage(\"album.php?id=" . $song->getAlbum()->getId() . "\")'>" . $song->getAlbum()->getTitle() . "</span>
                </div>

                <div class= 'trackInfoMore'>
                    <span role='white' class='artistName' onclick='openPage(\"artist.php?id=" . $song->getArtist()->getId() . "\")'>" . $song->getArtist()->getName() . "</span> 
                    <span role='white' class='featName' onclick='openPage(\"artist.php?id=" . $song->getFeat()->getId() . "\")'>" . $song->getFeat()->getFeatName() . "</span>
                </div>

                <div class='trackOptions'>
                    <span class='yearName'> ". $song->getAlbum()->getYear() ."</span> &nbsp; &nbsp;&nbsp; &nbsp;
                    <input type='hidden' class='id' value='" . $song->getId() . "' name='song'>
                    <img class='optionsButton zoom' title='Options' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
                    
                </div>

                <div class='trackDuration'>
                    <span class='duration'>" . $song->getDuration() . "</span>
                </div>


            </li>";

        

        
        }
        
        
        
    ?>
            <script>
                var tempSongIds = '<?php echo json_encode($array3); ?>';
                tempPlaylist = JSON.parse(tempSongIds);
                
            </script>
            
    </ul>

    






    <nav class="optionsMenu">
        <input type="hidden" class="id" name="">
        <?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
        <div class='item' onclick='addToQueue(this)'><img class='addToQueue zoom' src='assets/images/icons/add.png'>Add to Queue</div>
        <div class='item' onclick='addToNext(this)'><img class='addToNext zoom' src='assets/images/icons/play-next.png'>Play Next</div>
    </nav>
			

</div>