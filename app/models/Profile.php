<?php

namespace app\models;

class Profile extends \app\core\Model {

    // Profile data members. 
    public $profile_id;
    public $user_id;
    public $bio;
    public $filename;
    
    // the constructor
    public function __construct() {
        parent::__construct();
    }

    // method to insert a new profile to the database.
    public function insertProfile() {
        $SQL = "INSERT INTO profile (user_id, bio, filename) VALUES (:user_id, :bio, :filename)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["user_id" => $this->user_id, "bio" => $this->bio, "filename" => $this->filename]);
    }

    // method to get a profile based on user id.
    public function getProfile($user_id) {
        $SQL = "SELECT * FROM profile WHERE user_id = :user_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["user_id" => $user_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, "app\\models\\Profile");
        return $STMT->fetch();
    }

    // method to update the profile of a user. 
    public function updateProfile() {
        $SQL = "UPDATE profile SET bio = :bio, filename = :filename WHERE user_id = :user_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["bio" => $this->bio, "filename" => $this->filename, "user_id" => $this->user_id]);
    } 

    // method that search the profile based on the given username
    public function searchProfile($username) {
        $SQL = "SELECT * FROM user WHERE username LIKE :username";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["username"=> "%$username%"]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, "app\\models\\User");
        return $STMT->fetchAll();
    }

}