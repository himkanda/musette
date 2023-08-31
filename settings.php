<?php
include("includes/includedFiles.php");
?>

<script>
	var page_title = "Settings";
	document.title = page_title;
	themeSwitch();
	$('input:radio[name=radioZoom]').val([localStorage.getItem("setZoom")]);
	$('input:radio[name=radioTheme]').val([theme]);

	$('#radioZoom input').on('change', function () {
		var zoom = $('input[name=radioZoom]:checked', '#radioZoom').val();
		radioZoom(zoom);
	});
	$('#radioTheme input').on('change', function () {
		var getTheme = $('input[name=radioTheme]:checked', '#radioTheme').val();
		themeSet(getTheme);
	});
	$(document).ready(function () {
		off();
		if (localStorage.getItem("isnavBarPinned") == 1) {
			console.log("jhg");
			$('#checkbox2').prop('checked', true);
		}
	});
	$('#checkbox2').on('click', function () {
		if (this.checked) {
			pinNavBar(1);
			$('#checkbox2').prop('checked', true);
			return;
		}
		else {
			pinNavBar(0);
			$('#checkbox2').prop('checked', false);
			return;
		}

	});
</script>

<div class='albumTopViewContainer borderBottom' style="background: url(assets/images/artistbg.jpg)">

	<div id="leftContainer">
		<img src=" <?php echo $userLoggedIn->getPic(); ?> " id="artistMainPic">
	</div>
	<div id="rightContainer">
		<div id="artistName">
			<?php echo $userLoggedIn->getFirstAndLastName(); ?>
		</div>
		<section class="accountSettings">
			<span>Email : <b>
					<?php echo $userLoggedIn->getEmail(); ?>
				</b> </span>
			<span>Username : <b>
					<?php echo $userLoggedIn->getUsername(); ?>
				</b> </span>
			<span class='permLink2' onclick="openPage('updateDetails.php')">Update Details</span>
			<img src="assets/images/icons/full-screen.png" title="Full Screen toggle" onclick="toggleFullScreen()"
				class="fullScreen zoom">

		</section>
		<button class="button blue zoom settingsLogOutButton" onclick="logout()">LOGOUT</button>
	</div>
</div>


<div>
	<span class="mainContentTop">Display</span>
	<div id="radioZoom">
		<label><input type="radio" name="radioZoom" value="1"> Smaller </label><br>
		<label><input type="radio" name="radioZoom" value="2"> Normal </label><br>
		<label><input type="radio" name="radioZoom" value="3"> Bigger </label><br>
	</div>
</div>

<div>
	<span class="mainContentTop">Theme</span>
	<div id="radioTheme">
		<label><input type="radio" name="radioTheme" value="1"> Dark </label><br>
		<label><input type="radio" name="radioTheme" value="2"> Light </label><br>
	</div>
</div>

<div>
	<span class="mainContentTop">Sidebar</span>
	<p class="sideNavSettings changeable"> Pin the sidebar &nbsp; <input type="checkbox" id="checkbox2"> </p>
</div>

<div>
	<span class="mainContentTop">Account</span>
	<div class="accountSettings">
		<span class="permLink">Update my information</span>
		<span class="permLink">Delete my music info</span>
		<span class="permLink">Delete my account</span>

	</div>
</div>

<div>
	<span class="mainContentTop">App</span>
	<div class="accountSettings">
		<span class="permLink">Help</span>
		<span class="permLink">Feedback</span>
		<span class="permLink">About</span>
		<span class="permLink">What's new</span>
	</div>
</div>