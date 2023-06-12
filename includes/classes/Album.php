<?php
	class Album {

		private $con;
		private $id;
		private $title;
		private $artistId;
		private $genre;
		private $artworkPath;

		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;

			$query = mysqli_query($this->con, "SELECT * FROM albums WHERE id='$this->id'");
			$album = mysqli_fetch_array($query);

			$this->title = $album['title'];
			$this->artistId = $album['artist'];
			$this->genre = $album['genre'];
			$this->artworkPath = $album['artworkPath'];
			$this->Year = $album['Year'];

			$query2 = mysqli_query($this->con, "SELECT * FROM genres WHERE id='$this->genre'");
			$genre = mysqli_fetch_array($query2);

			$this->genreName = $genre['name'];

			
		}
		public function getId() {
			return $this->id;
		}
		
		
		public function getGenreName() {
			return $this->genreName;
		}

		public function getTitle() {
			return $this->title;
		}

		public function getArtist() {
			return new Artist($this->con, $this->artistId);
		}

		public function getGenre() {
			return $this->genre;
		}
		public function getYear() {
			return $this->Year;
		}

		public function getArtworkPath() {
			return $this->artworkPath;
		}

		public function getNumberOfSongs() {
			$query = mysqli_query($this->con, "SELECT id FROM songs WHERE album='$this->id'");
			return mysqli_num_rows($query);
		}

		public function getLength(){
			$query = mysqli_query($this->con, "SELECT SUM(duration) FROM songs WHERE album='$this->id'");
			$result = mysqli_fetch_row($query);
			return $result[0];
		}

		public function getSongIds() {

			$query = mysqli_query($this->con, "SELECT id FROM songs WHERE album='$this->id' ORDER BY albumorder ASC");

			$array = array();

			while($row = mysqli_fetch_array($query)) {
				array_push($array, $row['id']);
			}

			return $array;

		}

	}
	
?>