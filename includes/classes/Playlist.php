<?php
	class Playlist {

		private $con;
		private $id;
		private $name;
		private $owner;

		public function __construct($con, $data) {

			if(!is_array($data)) {
				//Data is an id (string)
				$query = mysqli_query($con, "SELECT * FROM playlists WHERE id='$data'");
				$data = mysqli_fetch_array($query);
			}

			$this->con = $con;
			$this->id = $data['id'];
			$this->name = $data['name'];
			$this->owner = $data['owner'];
			$this->date = $data['dateCreated'];
			$this->public = $data['public'];
		}

		public function getId() {
			return $this->id;
		}

		public function getDate() {
			$date = new DateTime($this->date);
			return date_format($date, 'jS M Y, h:i A');
		}

		public function getName() {
			return $this->name;
		}

		public function getOwner() {
			return $this->owner;
		}
		public function checkPublic(){
			return $this->public;
		}
		public function getNumberOfSongs() {
			$query = mysqli_query($this->con, "SELECT songId FROM playlistSongs WHERE playlistId='$this->id'");
			return mysqli_num_rows($query);
		}

		public function getPic(){
			$songIds = $this->getSongIds();
			if(sizeof($songIds)==0){
				return "assets/images/icons/playlist.png";
			}
			else{
				$songid= $songIds[0];
				$song = new Song($this->con, $songid);
				return $song->getAlbum()->getArtworkPath();
			}

		}

		public function getSongIds() {

			$query = mysqli_query($this->con, "SELECT songId FROM playlistSongs WHERE playlistId='$this->id' ORDER BY playlistOrder ASC");

			$array = array();

			while($row = mysqli_fetch_array($query)) {
				array_push($array, $row['songId']);
			}

			return $array;

		}
		public function getPlaylistLength() {
			$query1 = mysqli_query($this->con, "SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `duration` ) ) ) AS timeSum FROM playlistsongs WHERE playlistid='$this->id' ");
			$queryresult1 = mysqli_fetch_array($query1);
			$queryresult = $queryresult1['timeSum'];
			echo $queryresult;

		}

		public static function getPlaylistsDropdown($con, $username) {
			$dropdown = '';

			$query = mysqli_query($con, "SELECT id, name FROM playlists WHERE owner='$username'");
			while($row = mysqli_fetch_array($query)) {
				$id = $row['id'];
				$name = $row['name'];

				$dropdown = $dropdown . "<div class='playlist item' name='$id'>$name</div>";
			}


			return $dropdown;
		}

		





	}
?>