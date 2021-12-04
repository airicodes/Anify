<?php

namespace app\models;

class Animelist extends \app\core\Model {

    // variables for animelist
    public $animelist_id;
    public $user_id;

    // the constructor
    public function __construct() {
        parent::__construct();
    }

    // insert a user's anime list to the database.
    public function insertUserAL($user_id) {
		$SQL = 'INSERT INTO animelist(user_id) VALUES (:user_id)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$user_id]);
	}

    // get a user's anime list by getting the user id.
    public function getUserAL($user_id) {
        $SQL = 'SELECT * FROM animelist WHERE user_id = :user_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id' => $user_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Animelist');
		return $STMT->fetch();
    }

}