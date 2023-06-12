<?php include("includes/includedFiles.php"); 

$username = $userLoggedIn->getUsername();
$songquery = mysqli_query($con2, "SELECT songId FROM currentplaylist WHERE userName='$username'");

?>
<style>

    .trackDuration .duration{
        cursor: move;
    }


</style>

<script> 

    $(document).ready(function(){
        off();
        thePic = localStorage.getItem('nowplayingheaderpicreal');
        $(".backgroundImage").css("background", "url('"+ thePic +"')0 0 no-repeat");

    })
    var page_title = "Now Playing";
    document.title= page_title;
    themeSwitch();
    $("body").scrollTop(0); 
    addIconToNowPlaying();
    getTotalTimeNP();

    $(window).scroll(function() {
        var scrollPos = $(this).scrollTop();
        var pageHeight = $(document).height() - $(this).height();
        var progress = scrollPos / pageHeight;
        var backgroundOffset = (progress*100) + '%';
        $(".backgroundImage").css("background-position", "0% " + backgroundOffset);
    });


    function saveAsPlaylist(){
	var pop = prompt("Enter the name of playlist.");
	var array = JSON.stringify(currentPlaylist);
	if (pop != null){
		$.post("includes/handlers/ajax/savePlaylist.php", {array: array, name:pop, username: userLoggedIn})
		.done(function(error){
            if(error!= ""){
                alert(error);
                return;
            }
			showMessage("Playlist created !");
		});
	}
    }

    $(document).ready(function () {

        $("ul").sortable({
            
            update : function(event, ui){
                var i = $(this).children('li').children('.trackCount').children('.nowplayingicon');
                currentPlaylist.length=0;
                $.each(i, function() {
                    var a = $(this).attr('class');
                    var parts = a.split("song");
                    var thePart = parts[1];                    
                    currentPlaylist.push(thePart);  
                })               
                currentIndex = $('li.active').index();
                $('#CINP').text(currentIndex+1 + '/' + currentPlaylist.length );
                nowPlaying();
            },
        
            sort: function( event, ui ) {
                
                $("li").not(ui.item).css("opacity", "0.7");
                $("li").not(ui.item).css("padding", "10px 10px");

            },
        
        
            stop: function( event, ui ) {
                $("li").css("opacity", "1");
                $("li").not(ui.item).css("padding", "10px 5px");


            }, 
            scrollSensitivity: 40,
            scrollSpeed: 20,
            containment: "parent",
            handle: ".trackDuration .duration",
            placeholder: 'ui-state-highlight'
            
        
                
        
        });

        $("ul").disableSelection();
        $('.move-down').click(function (e) {
            var self = $(this);
                item = self.parent().parent().parent('.tracklistRow');
                var uvw = item.children('.trackOptions').children('.id').val();
                swapWith = item.next();
                var xyz = swapWith.children('.trackOptions').children('.id').val();
                
                item.before(swapWith.detach());
                swapNP(uvw, xyz);
                

        });
        $('.move-up').click(function (e) {
            var self = $(this);
                item = self.parent().parent().parent('.tracklistRow');
                var uvw = item.children('.trackOptions').children('.id').val();
                swapWith = item.prev();
                var xyz = swapWith.children('.trackOptions').children('.id').val();
                
            item.after(swapWith.detach());
            swapNP(uvw, xyz);
        });
    });

    function  swapNP(uvw, xyz){
        var actualPlaylist = shuffle ? shufflePlaylist : currentPlaylist; 
        var a = actualPlaylist.indexOf(uvw);
        var b = actualPlaylist.indexOf(xyz);
        if(a!=-1 && b!=-1){
            var temp = uvw;
            actualPlaylist[a]=xyz;
            actualPlaylist[b]=uvw;
            nowPlaying();
        }

    }


    function scrollToNP(){
        var $container = $("html,body");
        var $scrollTo = $('.tracklistRow.active');

        $container.animate({scrollTop: $scrollTo.offset().top - $container.offset().top + $container.scrollTop(), scrollLeft: 0},300); 
    }


    
</script>

<div class="backgroundImage"></div>
<div class="backgroundImageGradient"></div>

<span class="mainContentTop">Now Playing ... </span>

<div class="NP-top">
    <span id="CINP"></span>
    <span class="separator">|</span>
    <span id="getTotalTimeNP">Total time: &nbsp;</span>
    <span class="separator">|</span>
    <span role="link" onclick="scrollToNP()">Scroll to current song</span>
    <span class="separator">|</span>
    <span role="link" onclick="saveAsPlaylist()">Save</span>
</div>

<div class="tracklistContainer nwoplaying">
<ul class="tracklist">
<?php 
 


while($row = mysqli_fetch_array($songquery)){
    
    $song = new Song($con, $row['songId']);
    $id = $song->getId();
    echo "<li class='tracklistRow'>
                    <div class='trackCount'>
                        <img class='play' title='Play' src='assets/images/icons/play-white.png' onclick='setTrackNP(\"" . $id . "\")'>
                        <img class='removeNP' title='Remove from Now Playing' src='assets/images/icons/remove.png' onclick='removeFromNowPlaying(\"". $id ."\")'> </span>
                        <span class='nowplayingicon song". $id ."'><img  src='assets/images/icons/audio-wave.png' style=' cursor : auto ; '></span>
                    </div>


                    <div class='trackInfo'>
                        <span class='trackName'>" . $song->getTitle() . "
                        <img src='assets/images/icons/move-up.png' title='Move up' class='move-up'>
                        <img src='assets/images/icons/move-down.png' title='Move down' class='move-down'> </span>
                        <span role='white' class='albumName' onclick='openPage(\"album.php?id=" . $song->getAlbum()->getId() . "\")'>" . $song->getAlbum()->getTitle() . "</span>
                    </div>

                    <div class= 'trackInfoMore'>
                        <span role='white' class='artistName' onclick='openPage(\"artist.php?id=" . $song->getArtist()->getId() . "\")'>" . $song->getArtist()->getName() . "</span> 
                        <span role='white' class='featName' onclick='openPage(\"artist.php?id=" . $song->getFeat()->getId() . "\")'>" . $song->getFeat()->getFeatName() . "</span>
                    </div>

                    <div class='trackOptions'>
                        <span class='yearName'> ". $song->getAlbum()->getYear() ."</span> &nbsp; &nbsp;&nbsp; &nbsp;
                        <input type='hidden' class='id' value='" . $id . "' name='song'>
						<img class='optionsButton zoom' title='Add to' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
						
                    </div>

                    <div class='trackDuration'>
                        <span class='duration'>" . $song->getDuration() . "</span>
                    </div>


                </li>";
            }
            ?>
    
</ul>

    



</div>
<nav class="optionsMenu">
	<input type="hidden" class="id" name=''>
	<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>