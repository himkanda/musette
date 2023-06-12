var currentPlaylist = [];
var  Playlist = [];
var tempPlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;
var timer;
var theme = localStorage.getItem('themeNum') || 1;
var isnavBarPinned;


$(document).click(function(click) {
	var target = $(click.target);

	if(!target.hasClass("item") && !target.hasClass("optionsButton")) {
		hideOptionsMenu();
	}
});

window.onload=themeSwitch();

$(window).scroll(function() {
	hideOptionsMenu();
});

$(document).on("click", ".item.playlist", function() {
	var select = $(this);
	var playlistId = select.attr("name");
	var id = select.prevAll(".id").val();
	var type = select.prevAll(".id").attr('name');

		$.post("includes/handlers/ajax/addToPlaylist.php", { playlistId: playlistId, id: id, type: type})
		.done(function(error) {

			if(error != "") {
				showMessage(error);
				hideOptionsMenu();
				return;
			}
		
		});
	
});


function updateEmail(emailClass) {
	var emailValue = $("." + emailClass).val();

	$.post("includes/handlers/ajax/updateEmail.php", { email: emailValue, username: userLoggedIn})
	.done(function(response) {
		$("." + emailClass).nextAll(".message").text(response);
	})


}
function setTrackNP(songId){
	
	setTrack(songId, currentPlaylist, true );
	addIconToNowPlaying();
}
function addIconToNowPlaying(){
	path = window.location.pathname;
	if(path.includes("nowPlaying.php")||path.includes("nowplaying.php"))
	{
			
		if (shuffle){
			var index= shufflePlaylist[currentIndex];
		}
		else{
			var index= currentPlaylist[currentIndex];
		}
		
		

		$('.nowplayingicon').each(function(){
			var $this = $(this);
			$this.parent().parent().removeClass('active');
			$('.nowplayingicon img').css("visibility", 'hidden');
		});
		$('.tracklistRow .trackCount .song' + index).each(function(){
			var $this = $(this);
			$('.song'+index+' img').css("visibility", 'visible');
			$this.parent().parent().addClass('active');
			
		});
		$('#CINP').text(currentIndex+1 + '/' + currentPlaylist.length );

	}		
}

function removeFromNowPlaying(id){
	var y = shufflePlaylist;
	var removeItem = id;
    var index = y.indexOf(id);
	y.splice( $.inArray(removeItem,y) ,1 );



	y = currentPlaylist;
	removeItem = id;
    index = y.indexOf(id);
	y.splice( $.inArray(removeItem,y) ,1 );



	if(index<currentIndex){
		currentIndex--;
	}



	nowPlaying();
	$(".song"+id).parent().parent().remove();
	$('#CINP').text(currentIndex+1 + '/' + currentPlaylist.length );
	getTotalTimeNP();
}

function addToQueue(button){
	
	if($(button).prevAll(".id").attr("name")=='song'){
		var a = $(button).prevAll(".id").val();
		if(shuffle){
			if((jQuery.inArray(a , shufflePlaylist)) == -1){
					shufflePlaylist.push(a); 
					showMessage("Added ✔");
				}
				else{
					
					showMessage("Song already present. Failed to add again! ");
				}
		}
		else{
			if((jQuery.inArray(a , currentPlaylist)) == -1){
					currentPlaylist.push(a);
					showMessage("Added ✔");
				}
				else{
					
					showMessage("Song already present. Failed to add again! ");
			}

		}
	}
	else{
		var theType = $(button).prevAll(".id").attr("name");
		var Id = $(button).prevAll(".id").val();
		$.post('includes/handlers/ajax/playIconShortcut.php', { Id: Id, theType: theType}, function(data){
			var songsids =JSON.parse(data);
			if(shuffle){
				var count=0;
				songsids.forEach(element => {
					if((shufflePlaylist.indexOf(element)) == -1){
						shufflePlaylist.push(element);
						count++;	
					}
				});
				showMessage("Added "+ count + " songs");
				nowPlaying();
			}
			else{
				var count=0;
				songsids.forEach(element => {
					if((jQuery.inArray(element , currentPlaylist)) == -1){
						currentPlaylist.push(element);
						count++;
					}
				});
				showMessage("Added "+ count + " songs");
				nowPlaying();
			}
			
		})
	}


	hideOptionsMenu();
	
	nowPlaying();
	
}

function addToNext(button){
	if($(button).prevAll(".id").attr("name")=='song'){
		var a = $(button).prevAll(".id").val();
		if(shuffle){
			if((shufflePlaylist.indexOf(a)) == -1){
				shufflePlaylist.splice(currentIndex+1, 0, a); 
				showMessage("Added ✔");
			}
			
			else{
				showMessage("Song already present.");
			}
			
		}
		else{
			if((jQuery.inArray(a , currentPlaylist)) == -1){
				currentPlaylist.splice(currentIndex+1, 0, a); 
				showMessage("Added ✔");
			}
			else{
				showMessage("Song already present.");
		}
			
		}
	}
	else{
		var theType = $(button).prevAll(".id").attr("name");
		var Id = $(button).prevAll(".id").val();
		$.post('includes/handlers/ajax/playIconShortcut.php', { Id: Id, theType: theType}, function(data){
			var songsids =JSON.parse(data);
			if(shuffle){
				var count=0;
				songsids.forEach(element => {
					if((shufflePlaylist.indexOf(element)) == -1){
						shufflePlaylist.splice(currentIndex+1, 0, element); 
						count++;	
					}
				});
				showMessage("Added "+ count + " songs");
				nowPlaying();
			}
			else{
				var count=0;
				songsids.forEach(element => {
					if((jQuery.inArray(element , currentPlaylist)) == -1){
						currentPlaylist.splice(currentIndex+1, 0, element); 
						count++;
					}
				});
				showMessage("Added "+ count + " songs");
				nowPlaying();
			}
			
		})
	}
	
	hideOptionsMenu();
	
	nowPlaying();

}



function nowPlaying(){
	if(shuffle==true){
		var jsonString = JSON.stringify(shufflePlaylist);
		$.post("includes/handlers/ajax/getNowPlaying.php", { jsonString: jsonString, userLoggedIn: userLoggedIn }, function(data){
			
	});
	}
	else{
		var jsonString = JSON.stringify(currentPlaylist);
		$.post("includes/handlers/ajax/getNowPlaying.php", { jsonString: jsonString, userLoggedIn: userLoggedIn }, function(data){
		
	});	
	}
	
}
function showMessage(message){
	
	$("#showMessage").css("visibility",'visible');
	$("#showMessage").text(message);
	
	
		$('#showMessage').fadeIn('slow', function(){
		   $('#showMessage').delay(2500).fadeOut(); 
		});
}

function updatePassword(oldPasswordClass, newPasswordClass1, newPasswordClass2) {
	var oldPassword = $("." + oldPasswordClass).val();
	var newPassword1 = $("." + newPasswordClass1).val();
	var newPassword2 = $("." + newPasswordClass2).val();

	$.post("includes/handlers/ajax/updatePassword.php", 
		{ oldPassword: oldPassword,
			newPassword1: newPassword1,
			newPassword2: newPassword2, 
			username: userLoggedIn})

	.done(function(response) {
		$("." + oldPasswordClass).nextAll(".message").text(response);
	})


}

function logout() {
	$.post("includes/handlers/ajax/logout.php", function() {
		location.reload();
	});
}

function openPage(url) {
	document.getElementById("overlay").style.display = "block";
	var link = url;
	if(timer != null) {
		clearTimeout(timer);
	}

	if(link.indexOf("?") == -1) {
		link = link + "?";
	}
	
	var encodedUrl = encodeURI(link + "&userLoggedIn=" + userLoggedIn);

	$("#mainContent").load(encodedUrl);
	
	history.pushState({encodedUrl: encodedUrl}, null, encodedUrl);
	activate();
	
	
}

window.addEventListener('popstate', function(e){
	if(e.state){
		document.getElementById("overlay").style.display = "block";
		$("#mainContent").load(e.state.encodedUrl); 
		
		activate();	
			
	}
});

function removeFromPlaylist(button, playlistId) {
	
	songId = button;

	$.post("includes/handlers/ajax/removeFromPlaylist.php", { playlistId: playlistId, songId: songId })
	.done(function(error) {

		if(error != "") {
			showMessage(error);
			return;
		}

		//do something when ajax returns
		openPage("playlist.php?id=" + playlistId);
	});
}

function createPlaylist() {

	var popup = prompt("Please enter the name of your playlist");

	if(popup != null) {
		console.log(popup);
		$.post("includes/handlers/ajax/createPlaylist.php", { name: popup, username: userLoggedIn })
		.done(function(data) {

			showMessage(data);

			//do something when ajax returns
			openPage("yourPlaylists.php");
		});

	}

}


function deletePlaylist(playlistId) {
	var prompt = confirm("Are you sure you want to delete this playlist?");

	if(prompt == true) {

		$.post("includes/handlers/ajax/deletePlaylist.php", { playlistId: playlistId })
		.done(function(error) {

			if(error != "") {
				showMessage(error);
				return;
			}

			//do something when ajax returns
			openPage("Yourplaylists.php");
		});


	}
}

function hideOptionsMenu() {
	var menu = $(".optionsMenu");
	if(menu.css("display") != "none") {
		menu.css("display", "none");
	}
}

function showOptionsMenu(button) {
	var id = $(button).prevAll(".id").val();
	var type = $(button).prevAll(".id").attr('name');
	var menu = $(".optionsMenu");
	var menuWidth = menu.width();
	menu.find(".id").val(id);
	menu.find(".id").attr('name',type);

	var scrollTop = $(window).scrollTop(); //Distance from top of window to top of document
	var elementOffset = $(button).offset().top; //Distance from top of document

	var top = elementOffset - scrollTop;
	var left = $(button).offset().left;

	menu.css({ "top": top + "px", "left": left - menuWidth + "px", "display": "inline" });

}


function formatTime(seconds) {
	var time = Math.round(seconds);
	var minutes = Math.floor(time / 60); //Rounds down
	var seconds = time - (minutes * 60);

	var extraZero = (seconds < 10) ? "0" : "";

	return minutes + ":" + extraZero + seconds;
}

function updateTimeProgressBar(audio) {
	$(".progressTime.current").text(formatTime(audio.currentTime));
	$(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime));

	var progress = audio.currentTime / audio.duration * 100;
	$(".playbackBar .progress").css("width", progress + "%");
}

function updateVolumeProgressBar(audio) {
	var volume = audio.volume * 100;
	$(".volumeBar .progress").css("width", volume + "%");

	$(".volumeBar .volumeText").text(Math.ceil(volume));
}

function playFirstSong() {
	setTrack(tempPlaylist[0], tempPlaylist, true);
	
}

function Audio() {

	this.currentlyPlaying;
	this.audio = document.createElement('audio');

	this.audio.addEventListener("ended", function() {
		nextSong();
	});

	this.audio.addEventListener("canplay", function() {
		//'this' refers to the object that the event was called on
		var duration = formatTime(this.duration);
		$(".progressTime.remaining").text(duration);
	});

	this.audio.addEventListener("timeupdate", function(){
		if(this.duration) {
			updateTimeProgressBar(this);
		}
	});

	this.audio.addEventListener("volumechange", function() {
		updateVolumeProgressBar(this);
	});

	this.setTrack = function(track) {
		this.currentlyPlaying = track;
		this.audio.src = track.path;
	}

	this.play = function() {
		this.audio.play();
	}

	this.pause = function() {
		this.audio.pause();
	}

	this.setTime = function(seconds) {
		this.audio.currentTime = seconds;
	}

}


function getDominantColor ($src) {
	$image = imagecreatefromstring(file_get_contents($src));
	$thumb=imagecreatetruecolor(1,1); imagecopyresampled($thumb,$image,0,0,0,0,1,1,imagesx($image),imagesy($image));
	$mainColor=strtoupper(dechex(imagecolorat($thumb,0,0)));
	return $mainColor;
}

function toggleFullScreen() {
	if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
	 (!document.mozFullScreen && !document.webkitIsFullScreen)) {
	  if (document.documentElement.requestFullScreen) {  
		document.documentElement.requestFullScreen();  
	  } else if (document.documentElement.mozRequestFullScreen) {  
		document.documentElement.mozRequestFullScreen();  
	  } else if (document.documentElement.webkitRequestFullScreen) {  
		document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
	  }  
	} else {  
	  if (document.cancelFullScreen) {  
		document.cancelFullScreen();  
	  } else if (document.mozCancelFullScreen) {  
		document.mozCancelFullScreen();  
	  } else if (document.webkitCancelFullScreen) {  
		document.webkitCancelFullScreen();  
	  }  
	}  
}

function goBack(){
	window.history.back();
}
function goForward(){
	window.history.forward();
}

function activate(){
	var current = window.location.pathname;
	$('.middleNavBar > div').removeClass('active');
	$('.middleNavBar > div > span').removeClass('active2');
	$('.middleNavBar > div > span').each(function(){
		var $this = $(this);
		
		
		var substring = $this.attr('onclick');
		var replaceString = "openPage('";
		var substring = substring.replace(replaceString , "" );

		var replaceString = "')";
		substring = substring.replace(replaceString, "");
		if(current.indexOf(substring) !== -1){
			$this.parent().addClass('active');
			$this.addClass('active2');
		}
	})
}
function themeSet(getTheme){
	
	localStorage.setItem('themeNum', getTheme);
	theme=getTheme;
	
	themeSwitch();
	$("#mainContent").load(location.href+"#mainContent");
}



function themeSwitch(){
	$('.addIconShortcut').attr('title', 'Add to');
	$('.playIconShortcut').attr('title', 'Play');

	if(theme == 2){
		$("#nowPlayingBarContainer, .searchContainer").css("background-color", "#f3f3f3");
		$("body").css("background-color", "white");
		$(".hNavBar").css("background", "#f3f3f3");
		$(".hnavBar").css("border-bottom", "1px solid #e1e1e1");
		$("#navBarContainer").css("background-color", "#f3f3f3");
		$(".unhighlighted-popularitybar").css("background-color", "#d4d4d4");
		$("::-webkit-scrollbar-track").css("background", "#ffffff");
		$(".borderBottom").css("border-bottom", "0.5px solid #d6d6d6");
		$(".optionsMenu .item, .optionsMenu").css("background", "#f3f3f3");
		$("label").addClass('black');
		$(".middleNavBar > span").addClass('black');
		$(".big-dot").addClass('black');
		$(".navItemSettings").css("background", "white");
		$(".separator").addClass('black');
		$(".playlistImage").removeClass('playlistImageBlack');
		$(".playlistImage").addClass('playlistImageWhite');
		$(".backgroundImageGradient").addClass("backgroundImageGradientWhite");
		$(".backgroundImageGradient").removeClass("backgroundImageGradientBlack");
		$("p.changeable, span.changeable").addClass('black');
		$(".mainContentInfo").addClass('black');
		
		if(!$('#webkit-style').length){

			var styles = "<style type='text/css' id='webkit-style'>::-webkit-scrollbar-track{background: white}</style>";  
			$(styles).appendTo('head');
	
		  }


		$(".mainContentTop , .gridViewInfo, .allArtistGridViewInfo, .InYourMusic, .InYourMusic span").addClass('black');
		$(".tracklistRow .trackInfo .trackName").addClass('black');
		$(".hNavBar .hNavActive span, .trackInfo .trackName span").addClass('black');
		$(".hNavActive span").addClass('black');
		$(".yourMusicOptions *").addClass('black');
		$("option").addClass('black');
		$(".searchContainer .searchInput").addClass('black');
		$(".entityInfo .rightSection h2").addClass('black');
		$(".userInfo h1, .buttonItems button").addClass('black');
		$(".optionsMenu .item, .optionsMenu .item option").addClass('black');
		$("h1, h2, h3, h4, h5, h6, input").addClass('black');
		$("option").addClass('optionBlack');
	}
	else{
		/*
		$(".mainContentTop , .gridViewInfo, .allArtistGridViewInfo, .InYourMusic, .InYourMusic span").removeClass('black');
		$(".tracklistRow .trackInfo .trackName").removeClass('black');
		$(".tracklist li:nth-child(odd)").removeClass('tracklistwhite');
		$(".hNavBar .hNavActive span, .trackInfo .trackName span").removeClass('black');
		$(".hNavActive span").removeClass('black');
		$(".yourMusicOptions *").removeClass('black');
		$(".searchContainer .searchInput").removeClass('black');
		$(".entityInfo .rightSection h2").removeClass('black');
		$(".userInfo h1, .buttonItems button").removeClass('black');
		$("label").removeClass('black');
		$(".optionsMenu .item, .optionsMenu .item option").removeClass('black');
		$("h1, h2, h3, h4, h5, h6, input").removeClass('black');
		*/

		$("body").css("background-color", "#181818");
		$(" #navBarContainer, #nowPlayingBarContainer, .searchContainer").css("background-color", "black");
		$(".trackInfo .trackName span").removeClass('black');
		$(".middleNavBar > span").removeClass('black');
		$(".big-dot").removeClass('black');
		$(".navItemSettings").css("background", "#181818");
		$(".separator").removeClass('black');
		$(".playlistImage").addClass('playlistImageBlack');
		$(".playlistImage").removeClass('playlistImageWhite');
		$(".backgroundImageGradient").removeClass("backgroundImageGradientWhite");
		$(".backgroundImageGradient").addClass("backgroundImageGradientBlack");
		$("p.changeable, span.changeable").removeClass('black');
		$(".mainContentInfo").removeClass('black');
		
		if ($('#webkit-style').length){
			$('#webkit-style').remove();
		}
		
	}
	
}

function addToLibrary(button){

	var songId =  $(button).prevAll(".songId").val();
	$.post("includes/handlers/ajax/addToLibrary.php", {songId: songId, userLoggedIn: userLoggedIn}, function (data) 
			{
				if(data == 1){
					console.log(data);
					$(button).attr("src", "assets/images/icons/checkmark.png");
					$(button).attr("title", "Remove from My Music");

					}
				else if(data == 2){
					console.log(data);
					$(button).attr("src", "assets/images/icons/add2.png");
					$(button).attr("title", "Add to My Music");

				}
				else{
					showMessage(data);
				}
			});
				
}


function radioZoom(zoom){
	localStorage.setItem("setZoom", zoom);
	if(zoom==1){
		$('html').css("zoom", "94%");
		$('body').css("font-size", "13px" );

	}
	else if(zoom==2){
		$('html').css("zoom", "100%");
		$('body').css("font-size", "13px" );
		
	}
	else if(zoom==3){
		$('html').css("zoom", "103%");
		$('body').css("font-size", "14px" );
		
	}
}

function setZoom(){
	radioZoom(localStorage.getItem("setZoom") || 2);
}

function getTotalTimeNP(){
	var itemss = $('.tracklist > li > .trackDuration > .duration').get();
	var itemss0 = "00:00";
	$.each(itemss, function() {
		var start = $(this).text().toString();
		var end = itemss0.toString();
		var a = start.split(":");
		if(a.length==2){
			a.unshift("00");
		}
		var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]); 
		var b = end.split(":");
		if(b.length==2){
			b.unshift("00");
		}
		var seconds2 = (+b[0]) * 60 * 60 + (+b[1]) * 60 + (+b[2]); 

		var date = new Date(1970,0,1);
			date.setSeconds(seconds + seconds2);

		var c = date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
		itemss0 = c;
	});
	
	var timesplit= itemss0.split(":");
	if(timesplit[0] != 00){
		$("#getTotalTimeNP").text(timesplit[0] +" hours " + timesplit[1] + " minutes " + timesplit[2] + " seconds");
	}
	else{
		if(!timesplit[2]){
			timesplit[2] = '00';
		}
		$("#getTotalTimeNP").text(timesplit[1] +" minutes " + timesplit[2] + " seconds ");
	}

}

function off() {
    document.getElementById("overlay").style.display = "none";
}

function makePublicPrivate(publicprivate, playlistId){
	$.post("includes/handlers/ajax/makePublicPrivate.php", { playlistId: playlistId, publicprivate: publicprivate, userLoggedIn: userLoggedIn})
	.done(function(data) {

		showMessage(data);
	});

}
function savePlaylistToMyLibrary(playlistId){
	$.post("includes/handlers/ajax/savePlaylistToMyLibrary.php", { playlistId: playlistId, userLoggedIn: userLoggedIn})
	.done(function(data) {
		if(data == "removed"){
			$(".savePlaylistButton").text("Save");

			$(".saveplaylistButton").prepend('<img src= "assets/images/icons/more.png" style="padding-right: 6px"> ');
		}
		if(data == "added"){
			$(".savePlaylistButton").text("Remove");

			$(".saveplaylistButton").prepend('<img src= "assets/images/icons/delete.png" style="padding-right: 6px">');			

		}
	});
}

function pinNavBar(x){
	
	if(x==1){
		$("#navBarContainer").css("left", "0");
		$("#mainViewContainer").css("width", "calc(100% - 150px)");
		$("#mainViewContainer").css("margin-left", "150px");
		$("#navBarLabel").hide();
	}
	else if(x==0){
		$("#navBarContainer").css("left", "-130px");
		$("#mainViewContainer").css("width", "calc(100% - 20px)");
		$("#mainViewContainer").css("margin-left", "20px");
		$("#navBarLabel").show();
	}
	localStorage.setItem('isnavBarPinned', x);
	isnavBarPinned = x;
}

function playIconShortcut(theType, typesId){
	console.log(theType);
		$.post("includes/handlers/ajax/playIconShortcut.php", { Id: typesId, theType: theType, userLoggedIn: userLoggedIn}, function(data){
			console.log(data);
			var track = JSON.parse(data);
			console.log(track);
			setTrack(track[0], track, true);

		});

}

function renamePlaylist(id){
	var popup = prompt("Please enter the new name of the playlist");

	if(popup != null) {
		console.log(popup);
		$.post("includes/handlers/ajax/renamePlaylist.php", { id: id, name: popup })
		.done(function(data) {

			showMessage(data);

			//do something when ajax returns
			openPage("playlist.php?id="+ id);
		});

	}
}