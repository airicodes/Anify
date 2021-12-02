<?php

namespace app\models;

class Anime extends \app\core\Model {

    // variables for user
    public $anime_id;
    public $anime_name;
    public $anime_creator;
    public $anime_date;
    public $anime_description;
    public $anime_episodes;
    public $anime_status;
    public $anime_rating;
    public $anime_studio;
    public $anime_genre;
    public $picture_link;

    // the constructor
    public function __construct() {
        parent::__construct();
    }

    // get all of the animes in the database.
    public function getAllAnime() {
        $SQL = "SELECT * FROM anime";
		$STMT = self::$_connection->query($SQL);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\\models\\Anime");
		return $STMT->fetchAll();
    }

     // get anime by name
     public function getAnimeByName($anime_name) {
        $SQL = 'SELECT * FROM anime WHERE anime_name = :anime_name';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['anime_name' => $anime_name]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Anime');
		return $STMT->fetch();
    }

    // get anime by id
    public function getAnime($anime_id) {
        $SQL = 'SELECT * FROM anime WHERE anime_id = :anime_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['anime_id' => $anime_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Anime');
		return $STMT->fetch();
    }

    // add an anime to the database.
    public function addAnime() {
        $SQL = "INSERT INTO anime(anime_name, anime_creator, anime_date, anime_description, anime_episodes, anime_status, anime_studio, anime_genre, picture_link)
            VALUES (:anime_name, :anime_creator, :anime_date, :anime_description, :anime_episodes, :anime_status, :anime_studio, :anime_genre, :picture_link)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["anime_name" => $this->anime_name, "anime_creator" => $this->anime_creator, "anime_date" => $this->anime_date, "anime_description" => $this->anime_description, 
            "anime_episodes" => $this->anime_episodes, "anime_status" => $this->anime_status, "anime_studio" => $this->anime_studio, "anime_genre" => $this->anime_genre,
            "picture_link" => $this->picture_link]);
    }

    // method to delete an anime using the anime id.
    public function deleteAnime() {
        $SQL = "DELETE FROM anime WHERE anime_id = :anime_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["anime_id" => $this->anime_id]);
    }

    public function updateAnime() {
        $SQL = "UPDATE anime SET anime_name = :anime_name, anime_creator = :anime_creator, anime_date = :anime_date, anime_description = :anime_description,
            anime_episodes = :anime_episodes, anime_status = :anime_status, anime_studio = :anime_studio, anime_genre = :anime_genre, picture_link = :picture_link
            WHERE anime_id = :anime_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["anime_name" => $this->anime_name, "anime_creator" => $this->anime_creator, "anime_date" => $this->anime_date, "anime_description" => $this->anime_description, 
            "anime_episodes" => $this->anime_episodes, "anime_status" => $this->anime_status, "anime_studio" => $this->anime_studio, "anime_genre" => $this->anime_genre,
            "picture_link" => $this->picture_link, "anime_id" => $this->anime_id]);
    }
}
