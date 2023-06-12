<?php
$username = $userLoggedIn->getUsername();
$songQuery = mysqli_query($con2, "SELECT songId FROM currentplaylist where userName='$username'");
if(mysqli_num_rows($songQuery)==0){
	$songQuery = mysqli_query($con, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");
	$resultArray = array();

	while($row = mysqli_fetch_array($songQuery)) {
	array_push($resultArray, $row['id']);
}
}
else{
	$resultArray = array();

	while($row = mysqli_fetch_array($songQuery)) {
	array_push($resultArray, $row['songId']);
}
}

$jsonArray = json_encode($resultArray);



?>

<script>
	
	$(document).ready(function() {
		var nowplayingheaderpic;
		
		var newPlaylist = <?php echo $jsonArray; ?>;
		var currentIndexNP = localStorage.getItem("currentIndexNP") || 0;
		isnavBarPinned = localStorage.getItem("isnavBarPinned") || 1;
		pinNavBar(isnavBarPinned);
		audioElement = new Audio();
		setTrack(newPlaylist[currentIndexNP], newPlaylist, false);
		updateVolumeProgressBar(audioElement.audio);
		setZoom();
		themeSwitch();

		

		$("#nowPlayingBarContainer").on("mousedown mousemove", function(e) {
			e.preventDefault();
		});
		$(document).bind('keydown',function(e){
			if(!$(e.target).is(':input')){
				if(e.keyCode == 75) {
					if($(".controlButton.play").is(":visible")){
						$( ".controlButton.play" ).trigger( "click" );
					}
					else if($(".controlButton.pause").is(":visible")){
						$( ".controlButton.pause" ).trigger( "click" );
					}
				}
				else if(e.keyCode == 74) {
					prevSong();
				}
				else if(e.keyCode == 76) {
					nextSong();
				}
				else if(e.keyCode == 83) {
					setShuffle();
				}
				else if(e.keyCode == 82) {
					setRepeat();
				}
				else if(e.keyCode == 77) {
					setMute();
				}
				else if(e.keyCode == 70) {
					toggleFullScreen();
				}
				else if(e.keyCode == 39){
					audioElement.setTime(audioElement.audio.currentTime + 10);
				}
				else if(e.keyCode == 37){
					audioElement.setTime(audioElement.audio.currentTime - 10);
				}
		}
		});


	$(".playbackBar .progressBar").mousedown(function() {
		mouseDown = true;
	});

	$(".playbackBar .progressBar").mousemove(function(e) {
		if(mouseDown == true) {
			//Set time of song, depending on position of mouse
			timeFromOffset(e, this);
		}
	});

	$(".playbackBar .progressBar").mouseup(function(e) {
		timeFromOffset(e, this);
	});


	$(".volumeBar .progressBar").mousedown(function() {
		mouseDown = true;
	});

	$(".volumeBar .progressBar").mousemove(function(e) {
		if(mouseDown == true) {

			var percentage = e.offsetX / $(this).width();

			if(percentage >= 0 && percentage <= 1) {
				audioElement.audio.volume = percentage;
			}
		}
	});

	$(".volumeBar .progressBar").mouseup(function(e) {
		var percentage = e.offsetX / $(this).width();

		if(percentage >= 0 && percentage <= 1) {
			audioElement.audio.volume = percentage;
		}
	});

	$(document).mouseup(function() {
		mouseDown = false;
	});

	
	nowPlaying(); 
	addIconToNowPlaying();



});

function timeFromOffset(mouse, progressBar) {
	var percentage = mouse.offsetX / $(progressBar).width() * 100;
	var seconds = audioElement.audio.duration * (percentage / 100);
	audioElement.setTime(seconds);
}

function prevSong() {
	if(audioElement.audio.currentTime >= 5) {
		audioElement.setTime(0);
	}
	else if(currentIndex == 0){
		currentIndex = currentPlaylist.length-1;
		setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
	}
	else {
		currentIndex = currentIndex - 1;
		setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
	}
	addIconToNowPlaying();
}

function nextSong() {
	if(repeat == true) {
		audioElement.setTime(0);
		playSong();
		return;
	}

	if(currentIndex == currentPlaylist.length - 1) {
		currentIndex = 0;
	}
	else {
		currentIndex++;
	}

	var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
	setTrack(trackToPlay, currentPlaylist, true);
	addIconToNowPlaying();
}

function setRepeat() {
	repeat = !repeat;
	var imageName = repeat ? "repeat-active.png" : "repeat.png";
	$(".controlButton.repeat img").attr("src", "assets/images/icons/" + imageName);
}

function setMute() {
	audioElement.audio.muted = !audioElement.audio.muted;
	var imageName = audioElement.audio.muted ? "volume-mute.png" : "volume.png";
	
	if(audioElement.audio.muted){
	$(".volumeBar .progress").css({backgroundColor: "#a0a0a0"});
	}
	else{
	$(".volumeBar .progress").css({backgroundColor: "#0070d3bd"});
	}
	$(".controlButton.volume img").attr("src", "assets/images/icons/" + imageName);
}
function setShuffle() {
	
	shuffle = !shuffle;
	var imageName = shuffle ? "shuffle-active.png" : "shuffle.png";
	$(".controlButton.shuffle img").attr("src", "assets/images/icons/" + imageName);

	if(shuffle == true) {
		//Randomize playlist
		shuffleArray(shufflePlaylist);
		currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
	}
	else {
		//shuffle has been deactivated
		//go back to regular playlist
		currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
	}
	nowPlaying();
	addIconToNowPlaying();
	path = window.location.pathname;
	if(path.includes("nowPlaying.php")||path.includes("nowplaying.php")){
		openPage("nowPlaying.php");
	}
	
}

function shuffleArray(a) {
    var j, x, i;
    for (i = a.length; i; i--) {
        j = Math.floor(Math.random() * i);
        x = a[i - 1];
        a[i - 1] = a[j];
        a[j] = x;
    }
}

function makeShuffle(newPlaylist){
	shuffleArray(newPlaylist);
	setTrack(newPlaylist[0], newPlaylist, true);
}


function setTrack(trackId, newPlaylist, play) {
	console.log(newPlaylist);
	if(newPlaylist != currentPlaylist) {
		currentPlaylist = newPlaylist;
		console.log(currentPlaylist);
		shufflePlaylist = currentPlaylist.slice();
		shuffleArray(shufflePlaylist);
		nowPlaying();
	}

	if(shuffle == true) {
		currentIndex = shufflePlaylist.indexOf(trackId);
	}
	else {
		currentIndex = currentPlaylist.indexOf(trackId);
	}
	pauseSong();

	$.post("includes/handlers/ajax/getSongJson.php", { songId: trackId }, function(data) {

		var track = JSON.parse(data);
		$(".trackName span").text(track.title);

		$.post("includes/handlers/ajax/getArtistJson.php", { artistId: track.artist }, function(data) {
			var artist = JSON.parse(data);
			$(".trackInfo .artistName span").text(artist.name);
			$(".trackInfo .artistName span").attr("onclick", "openPage('artist.php?id=" + artist.id + "')");
			nowplayingheaderpic = artist.artistpic;
			localStorage.setItem('nowplayingheaderpicreal', nowplayingheaderpic);
        	$(".backgroundImage").css("background", "url('"+ nowplayingheaderpic +"') 0 0 no-repeat");
			
		});

		$.post("includes/handlers/ajax/getAlbumJson.php", { albumId: track.album }, function(data) {
			var album = JSON.parse(data);
			$(".content .albumLink img").attr("src", album.artworkPath);
			$(".content .albumLink img").attr("onclick", "openPage('album.php?id=" + album.id + "')");
			$(".trackInfo .trackName span").attr("onclick", "openPage('album.php?id=" + album.id + "')");
		});
		
		/* $.post("includes/handlers/ajax/getBgColor.php", { albumId: track.album }, function(data) {
			var bgColor = data;
			console.log[data];
			$("#nowPlayingBarContainer").css("background-color", '#'+ bgColor );
			
		}); */


		audioElement.setTrack(track);
		localStorage.setItem("currentIndexNP", currentIndex);

		if(play == true) {
			playSong();
		}
	});

}

function playSong() {

	if(audioElement.audio.currentTime == 0) {
		$.post("includes/handlers/ajax/updatePlays.php", { songId: audioElement.currentlyPlaying.id, userLoggedIn: userLoggedIn });
	}

	$(".controlButton.play").hide();
	$(".controlButton.pause").show();
	audioElement.play();
}

function pauseSong() {
	$(".controlButton.play").show();
	$(".controlButton.pause").hide();
	audioElement.pause();
}
</script>


<div id="nowPlayingBarContainer" class="hover-shadow">

	<div id="nowPlayingBar">

		<div id="nowPlayingLeft">
	
			<div class="content">
				<span class="albumLink">
					<img role="link" tabindex="0" src="" class="albumArtwork artzoom hover-shadow">
				</span>

				<div class="trackInfo">

					<span class="trackName">
						<span role="link" tabindex="0"></span>
					</span>

					<span class="artistName">
						<span role="link" tabindex="0"></span>
					</span>

				</div>



			</div>
		</div>

		<div id="nowPlayingCenter">

			<div class="content playerControls">

				<div class="buttons">

					<button class="controlButton shuffle" title="Shuffle button" onclick="setShuffle()">
						<img src="assets/images/icons/shuffle.png" alt="Shuffle">
					</button>

					<button class="controlButton previous" title="Previous button" onclick="prevSong()">
						<img src="assets/images/icons/previous.png" alt="Previous">
					</button>

					<button class="controlButton play" title="Play button" onclick="playSong()">
						<img src="assets/images/icons/play.png" alt="Play">
					</button>

					<button class="controlButton pause" title="Pause button" style="display: none;" onclick="pauseSong()">
						<img src="assets/images/icons/pause.png" alt="Pause">
					</button>

					<button class="controlButton next" title="Next button" onclick="nextSong()">
						<img src="assets/images/icons/next.png" alt="Next">
					</button>

					<button class="controlButton repeat" title="Repeat button" onclick="setRepeat()">
						<img src="assets/images/icons/repeat.png" alt="Repeat">
					</button>

				</div>


				<div class="playbackBar">

					<span class="progressTime current">0.00</span>

					<div class="progressBar">
						<div class="progressBarBg">
							<div class="progress"></div>
						</div>
					</div>

					<span class="progressTime remaining">0.00</span>


				</div>


			</div>


		</div>

		<div id="nowPlayingRight">
			<div class="volumeBar">

				<button class="controlButton volume" title="Volume button" onclick="setMute()">
					<img src="assets/images/icons/volume.png" alt="Volume">
				</button>

				<div class="progressBar">
					<div class="progressBarBg">
						<div class="progress"></div>
					</div>
				</div>

				<div>
					<span class="volumeText"></span>
				</div>

			</div>
			<div id="showMessage"> </div>
		</div>




	</div>

</div>

