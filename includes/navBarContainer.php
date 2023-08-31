<div id="navBarContainer">
	<nav class="navBar ">
		<span id="navBarLabel" class="changeable">Navigation Bar</span>
		<div id='topNavBar'>
			<div class="logoNavBar">
				<span role="link" tabindex="0" onclick="openPage('browse.php')" class="logo">
					<img src="assets/images/icons/groove.png" id='zoom'>
				</span>

				<span role='link' class="back zoom" onclick="goBack()">
					<img src="assets/images/icons/left.png" title="Back" alt="Back">
				</span>

				<span role='link' class="forward zoom" onclick="goForward()">
					<img src="assets/images/icons/right.png" title="Forward" alt="Forward">
				</span>
			</div>




			<div class="group middleNavBar">
				<span>MAIN</span>

				<div class="navItem">
					<span role="link" tabindex="0" onclick="openPage('home.php')" class="navItemLink ">Home</span>
				</div>

				<div class="navItem">
					<span role='link' tabindex='0' onclick="openPage('search.php')" class="navItemLink ">Search</span>
				</div>

				<div class="navItem">
					<span role="link" tabindex="0" onclick="openPage('browse.php')" class="navItemLink ">Browse</span>
				</div>

				<div class="navItem">
					<span role="link" tabindex="0" onclick="openPage('nowPlaying.php')" class="navItemLink ">Now
						Playing</span>
				</div>

			</div>


			<div class="group middleNavBar">
				<span>YOUR MUSIC</span>
				<div class="navItem">
					<span role='link' tabindex='0' onclick="openPage('yourArtists.php')"
						class="navItemLink ">Artists</span>
				</div>

				<div class="navItem">
					<span role="link" tabindex="0" onclick="openPage('yourAlbums.php')"
						class="navItemLink ">Albums</span>
				</div>

				<div class="navItem">
					<span role="link" tabindex="0" onclick="openPage('yourSongs.php')" class="navItemLink ">Songs</span>
				</div>

				<div class="navItem">
					<span role="link" tabindex="0" onclick="openPage('yourPlaylists.php')"
						class="navItemLink ">Playlists</span>
				</div>


			</div>
		</div>
		<div class=" bottomNavBar">
			<div class="navItemSettings navItem">
				<span class="grey ">
					<?php echo $userLoggedIn->getName(); ?>
				</span>
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;
				<img src="assets/images/icons/settings.png" alt="Settings" onclick="openPage('settings.php')">
			</div>
		</div>

	</nav>
</div>