<?php
	class Artist {

		private $con;
		private $id;

		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;
		}

		public function getId() {
			return $this->id;
		}

		public function getName() {
			$artistQuery = mysqli_query($this->con, "SELECT name FROM artists WHERE id='$this->id'");
			$artist = mysqli_fetch_array($artistQuery);
			return $artist['name'];
		}

		public function getFeatName(){
			if($this->id == 123456789){
				return"";
			}
			else{
				$artistQuery = mysqli_query($this->con, "SELECT name FROM artists WHERE id='$this->id'");
				$artist = mysqli_fetch_array($artistQuery);
				return ' • ' . $artist['name'];
			}
			
		}

		public function getInfo() {
			$artistQuery1 = mysqli_query($this->con, "SELECT artistinfo FROM artists WHERE id='$this->id'");
			$artist = mysqli_fetch_array($artistQuery1);
			return $artist['artistinfo'];
		}	

		public function getCountry(){
			$artistQuery2 = mysqli_query($this->con, "SELECT country FROM artists WHERE id='$this->id'");
			$artist = mysqli_fetch_array($artistQuery2);
			return $artist['country'];
		}

		public function getPic(){
			$artistQuery3 = mysqli_query($this->con, "SELECT artistpic FROM artists WHERE id='$this->id'");
			$artist = mysqli_fetch_array($artistQuery3);
			return $artist['artistpic'];
		}
		
		public function getSongIds() {

			$query = mysqli_query($this->con, "SELECT id FROM songs WHERE artist='$this->id' ORDER BY plays DESC");

			$array = array();

			while($row = mysqli_fetch_array($query)) {
				array_push($array, $row['id']);
			}

			return $array;

		}
	}
?>