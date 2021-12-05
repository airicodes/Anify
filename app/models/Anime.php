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
    public $favorite;
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

    public function addAnimeToList($anime_id, $animelist_id, $status, $favorite, $rating) {
        $SQL = "INSERT INTO anime_in_list(anime_id, animelist_id, watching_status, favorite, rating)
            VALUES (:anime_id, :animelist_id, :watching_status, :favorite, :rating)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["anime_id"=>$anime_id, "animelist_id"=>$animelist_id, "watching_status"=>$status,
        "favorite"=>$favorite, "rating"=>$rating]);
    }

    public function getAnimeList($anime_id) {
        $SQL = 'SELECT * FROM anime_list WHERE user_id = :user_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['anime_id' => $anime_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Anime');
		return $STMT->fetch();
    }

    public function getAnimeFromList($anime_id, $animelist_id) {
        $SQL = 'SELECT * FROM anime_in_list LEFT JOIN anime
        ON anime_in_list.anime_id = anime.anime_id WHERE animelist_id = :animelist_id AND anime.anime_id = :anime_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['anime_id' => $anime_id, 'animelist_id'=>$animelist_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Anime');
		return $STMT->fetch();
    }

    public function getAllAnimeFromList($animelist_id) {
        $SQL = 'SELECT DISTINCT * FROM anime_in_list LEFT JOIN anime ON anime_in_list.anime_id =
        anime.anime_id WHERE anime_in_list.animelist_id = :animelist_id GROUP BY anime.anime_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['animelist_id'=>$animelist_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Anime');
		return $STMT->fetchAll();
    }

    public function updateFavAnimeFromList($animelist_id, $anime_id, $favorite) {
        $SQL = 'UPDATE anime_in_list SET favorite = :favorite WHERE animelist_id = :animelist_id
        AND anime_id = :anime_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['animelist_id'=>$animelist_id, 'anime_id'=>$anime_id, 'favorite'=>$favorite]);
    }

    public function getAllFavAnimeFromList($animelist_id) {
        $SQL = 'SELECT DISTINCT * FROM anime_in_list LEFT JOIN anime ON anime_in_list.anime_id =
        anime.anime_id WHERE anime_in_list.animelist_id = :animelist_id AND 
        anime_in_list.favorite = "y" GROUP BY anime.anime_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['animelist_id'=>$animelist_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Anime');
		return $STMT->fetchAll();
    }
    
    public function updateAnimeFromList($animelist_id, $anime_id, $watching_status, $rating) {
        $SQL = 'UPDATE anime_in_list SET watching_status = :watching_status, rating = :rating WHERE animelist_id = :animelist_id
        AND anime_id = :anime_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['animelist_id'=>$animelist_id, 'anime_id'=>$anime_id, 'watching_status'=>$watching_status,
        'rating'=>$rating]);
    }

}
