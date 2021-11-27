<?php

class User extends \app\core\Model {

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

    // insert a user to the database.
    public function insertAnime() {
		$this->hash = password_hash($this->password, PASSWORD_DEFAULT);
		$SQL = 'INSERT INTO anime(anime_name, anime_creator, anime_date,
        anime_description,
        anime_episodes,
        anime_status,
        anime_rating,
        anime_studio,
        anime_genre,
        picture_link) VALUES (:anime_name, :anime_creator, :anime_date,
        :anime_description,
        :anime_episodes,
        :anime_status,
        :anime_rating,
        :anime_studio,
        :anime_genre,
        :picture_link)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['anime_name'=>$this->anime_name,'anime_creator'=>$this->anime_creator, 'anime_description'=>$this->anime_description,
        'anime_episodes'=>$this->anime_episodes, 'anime_status'=>$this->anime_status, 'anime_rating'=>$this->anime_rating, 'anime_studio'=>$this->anime_studio,
        'anime_genre'=>$this->anime_genre, 'picture_link'=>$this->picture_link]);
	}

    // get all of the users in the database.
    public function getAllUsers() {
        $SQL = "SELECT * FROM anime";
		$STMT = self::$_connection->query($SQL);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\\models\\Anime");
		return $STMT->fetchAll();
    }

     // get one user by their username.
     public function getAnimeByName($name) {
        $SQL = 'SELECT * FROM anime WHERE anime LIKE :name';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['name' => $name]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Anime');
		return $STMT->fetch();
    }
}
