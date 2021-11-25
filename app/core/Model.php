<?php
namespace app\core;

class Model{

	protected static $_connection = null;

	public function __construct(){
		$username = 'root';
		$password = '';
		$host = 'localhost';//where we find the MySQL DB server
		$DBname = 'socialmediadb'; //the DB name for your Web application


		//connect the objects to the storage medium
		if(self::$_connection == null){
			self::$_connection = new \PDO("mysql:host=$host;dbname=$DBname",$username,$password);
		}
	}

}