<?php

namespace app\models;

class User extends \app\core\Model {

    // variables for user
    public $user_id;
    public $username;
    public $password;
    public $hash;
    public $role;
    public $profile_id;

    // the constructor
    public function __construct() {
        parent::__construct();
    }

    // insert a user to the database.
    public function insertUser() {
		$this->hash = password_hash($this->password, PASSWORD_DEFAULT);
		$SQL = 'INSERT INTO user(username, hash, role) VALUES (:username,:password_hash, :role)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['username'=>$this->username,'password_hash'=>$this->hash, "role" => $this->role]);
	}

    // get all of the users in the database.
    public function getAllUsers() {
        $SQL = "SELECT * FROM user";
		$STMT = self::$_connection->query($SQL);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\\models\\User");
		return $STMT->fetchAll();
    }

     // get one user by their username.
     public function getUserByUsername($username) {
        $SQL = 'SELECT * FROM user WHERE username LIKE :username';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['username' => $username]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\User');
		return $STMT->fetch();
    }
}