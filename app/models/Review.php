<?php

namespace app\models;

class Review extends \app\core\Model {
    public $user_review_id;
    public $review;
    public $user_id;
    public $anime_id;

     // the constructor
     public function __construct() {
        parent::__construct();
    }

    public function getReview($user_review_id, $user_id) {
        $SQL = "SELECT * FROM user_review WHERE user_id = :user_id AND user_review_id = :user_review_id ";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["user_id"=>$user_id,"user_review_id"=> $user_review_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, "app\\models\\Review");
        return $STMT->fetch();
    }

    public function deleteReview($user_review_id, $user_id) {
        $SQL = 'DELETE FROM user_review WHERE user_id = :user_id AND user_review_id = :user_review_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(["user_id"=>$user_id, "user_review_id"=> $user_review_id]);
    }

    public function updateReview($user_review_id, $user_id, $review) {
        $SQL = "UPDATE user_review SET review = :review WHERE user_id = :user_id AND user_review_id = :user_review_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["user_id"=>$user_id,"user_review_id"=> $user_review_id, "review" => $review]);
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

    public function getAnimeReview($user_id, $anime_id) {
        $SQL = "SELECT * FROM user_review WHERE user_id = :user_id AND anime_id = :anime_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["user_id"=>$user_id, "anime_id" => $anime_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, "app\\models\\Review");
        return $STMT->fetch();
    }
}
