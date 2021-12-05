<?php

namespace app\models;

class Profile extends \app\core\Model {
    public $post_like_id;
    public $user_id;
    public $profile_post_id;

    // the constructor
    public function __construct() {
        parent::__construct();
    }

    public function addLike($profile_post_id) {
        $SQL = "INSERT INTO post_like (user_id, profile_post_id) VALUES (:user_id, profile_post_id)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["user_id" => $this->user_id, "profile_post_id"=>$profile_post_id]);
    }

    public function removeLike($profile_post_id) {
        $SQL = "DELETE FROM post_like WHERE profile_post_id = :profile_post_id AND user_id = :user_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["user_id" => $this->user_id, "profile_post_id"=>$profile_post_id]);
    }

    public function getAllLikes($profile_post_id) {
        $SQL = "SELECT COUNT(*) FROM post_like WHERE profile_post_id = :profile_post_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["profile_post_id" => $profile_post_id]);
        return $STMT->fetch();
    }
}