<?php

namespace app\filters;
//definition of an attribute
//it needs to be applied to be functional
#[\Attribute]
class ProfileCheck extends \app\core\Model {

	function execute() {
        $user_id = $_SESSION['user_id'];
        $SQL = "SELECT COUNT(profile_id) FROM profile WHERE user_id = $user_id";
        $STMT = self::$_connection->query($SQL)->fetch();
		 if ($STMT[0] == 0) {
			header('location:/Profile/createProfile');
			return true;
		}
		return false;
	}
}