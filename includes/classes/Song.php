<?php
class Song
{

	private $con;
	private $id;
	private $mysqliData;
	private $title;
	private $artistId;
	private $albumId;
	private $genre;
	private $duration;
	private $path, $plays, $feat, $albumorder;
	private $mysqliData2, $maxplays;

	public function __construct($con, $id)
	{
		$this->con = $con;
		$this->id = $id;

		$query = mysqli_query($this->con, "SELECT * FROM songs WHERE id='$this->id'");

		$this->mysqliData = mysqli_fetch_array($query);
		$this->title = $this->mysqliData['title'];
		$this->artistId = $this->mysqliData['artist'];
		$this->albumId = $this->mysqliData['album'];
		$this->duration = $this->mysqliData['duration'];
		$this->path = $this->mysqliData['path'];
		$this->plays = $this->mysqliData['plays'];
		$this->feat = $this->mysqliData['feat'];
		$this->albumorder = $this->mysqliData['albumorder'];

		$query2 = mysqli_query($this->con, "SELECT MAX(plays) FROM songs WHERE album='$this->albumId'");

		$this->mysqliData2 = mysqli_fetch_array($query2);
		$this->maxplays = $this->mysqliData2['MAX(plays)'];
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getArtist()
	{
		return new Artist($this->con, $this->artistId);
	}

	public function getAlbum()
	{
		return new Album($this->con, $this->albumId);
	}

	public function getPath()
	{
		return $this->path;
	}

	public function getDuration()
	{
		return $this->duration;
	}

	public function getMysqliData()
	{
		return $this->mysqliData;
	}

	public function getPopularity()
	{
		return $this->plays;
	}
	public function getPopularityBar()
	{
		if ($this->maxplays != 0) {
			$i = ($this->plays / $this->maxplays);
			$i = $i * 20;
			return $i;
		} else
			return 0;
	}

	public function getFeat()
	{
		if ($this->feat != NULL) {
			return new Artist($this->con, $this->feat);
		} else
			return new Artist($this->con, 123456789);
	}

	public function getalbumOrder()
	{
		return $this->albumorder;
	}

}
?>