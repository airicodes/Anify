<?php

namespace app\models;

class Profile extends \app\core\Model {

    public $profile_id;
    public $user_id;
    public $bio;
    public $filename;
    
    // the constructor
    public function __construct() {
        parent::__construct();
    }

    public function insertProfile() {
        $SQL = "INSERT INTO profile (user_id, bio, filename) VALUES (:user_id, :bio, :filename)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["user_id" => $this->user_id, "bio" => $this->bio, "filename" => $this->filename]);
    }

    public function getProfile($user_id) {
        $SQL = "SELECT * FROM profile WHERE user_id = :user_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["user_id" => $user_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, "app\\models\\Profile");
        return $STMT->fetch();
    }



}