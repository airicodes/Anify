<?php

namespace app\models;

class ProfilePost extends \app\core\Model {
    public $profile_post_id;
    public $user_id;
    public $date;
    public $post;

     // the constructor
     public function __construct() {
        parent::__construct();
    }

    public function addPost() {
        $SQL = "INSERT INTO profile_post (post, date, user_id) VALUES (:post, :date, :user_id)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["post"=>$this->post, "date"=>$this->date, "user_id"=>$this->user_id]);
    }

    public function getAllPost($user_id) {
        $SQL = "SELECT * FROM profile_post WHERE user_id = :user_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["user_id"=>$user_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, "app\\models\\ProfilePost");
        return $STMT->fetchAll();
    }

    public function deletePost($profile_post_id) {
        $SQL = "DELETE FROM profile_post WHERE profile_post_id = :profile_post_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["profile_post_id"=>$profile_post_id]);
    }
}

