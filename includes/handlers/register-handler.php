<?php 

function sanitizeFormPassword($inputText) {
	$inputText = strip_tags($inputText);
	return $inputText;
}

function sanitizeFormUsername($inputText) {
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	return $inputText;
}

function sanitizeFormString($inputText) {
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	$inputText = ucfirst(strtolower($inputText));
	return $inputText;
}


if(isset($_POST['registerButton'])) {
	//Register button was pressed
	$username = sanitizeFormUsername($_POST['username']);
	$firstName = sanitizeFormString($_POST['firstName']);
	$lastName = sanitizeFormString($_POST['lastName']);
	$email = sanitizeFormString($_POST['email']);
	$email2 = sanitizeFormString($_POST['email2']);
	$password = sanitizeFormPassword($_POST['password']);
	$password2 = sanitizeFormPassword($_POST['password2']);

	$wasSuccessful = $account->register($username, $firstName, $lastName, $email, $email2, $password, $password2);

	if($wasSuccessful == true) {
		$conn = mysqli_connect("127.0.0.1", "root", "", "userdata");
		if (!$conn)
				die ("<p>Couldn't connect to the server!<p>");
		$selectData = mysqli_select_db ($conn, "userdata");
		if(!$selectData)
		{
			die ("Database Not Selected");
		}
		echo $username;
		echo $selectData;



		$sql = "CREATE TABLE `".$username."` ("
		. " `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
		. " `library` INT, "
		. " `album` INT, "
		. " `artist` INT, "
		. " `currentplaylist` INT DEFAULT NULL, "
		. " `plays` INT NOT NULL DEFAULT 0, "
		. " `albumorder` INT "
		. " )"
		. " ENGINE = InnoDB;";

		$query_result = mysqli_query($conn, $sql);

		$_SESSION['userLoggedIn'] = $username;
		header("Location: browse.php");
		

	}

}


?>