<?php

namespace app\models;

class PostLike extends \app\core\Model {
    public $post_like_id;
    public $user_id;
    public $profile_post_id;

    // the constructor
    public function __construct() {
        parent::__construct();
    }

    // Add likes 
    public function addLike($profile_post_id) {
        $SQL = "INSERT INTO post_like (user_id, profile_post_id) VALUES (:user_id, :profile_post_id)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["user_id" => $this->user_id, "profile_post_id"=>$profile_post_id]);
    }

    // Remove a like 
    public function removeLike($profile_post_id) {
        $SQL = "DELETE FROM post_like WHERE profile_post_id = :profile_post_id AND user_id = :user_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["user_id" => $this->user_id, "profile_post_id"=>$profile_post_id]);
    }

    // Get all the likes of the post
    public function getAllLikes($profile_post_id) {
        $SQL = "SELECT COUNT(*) FROM post_like WHERE profile_post_id = :profile_post_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["profile_post_id" => $profile_post_id]);
        return $STMT->fetch();
    }

    // A boolean that checks whether the user likes the post
    public function isPostLiked($profile_post_id, $user_id) {
        $SQL = "SELECT COUNT(*) FROM post_like WHERE profile_post_id = :profile_post_id AND user_id = :user_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["profile_post_id" => $profile_post_id, "user_id" => $user_id]);
        $count = $STMT->fetch();

        if ($count["COUNT(*)"] >= 1) {
            return true;
        }

        return false;
    }
}