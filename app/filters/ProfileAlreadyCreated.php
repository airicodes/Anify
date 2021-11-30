<?php

namespace app\filters;
//definition of an attribute
//it needs to be applied to be functional
#[\Attribute]
class ProfileAlreadyCreated extends \app\core\Model {

	function execute() {
        $user_id = $_SESSION['user_id'];
        $SQL = "SELECT COUNT(profile_id) FROM profile WHERE user_id = $user_id";
        $STMT = self::$_connection->query($SQL)->fetch();
		 if ($STMT[0] == 1) {
            if ($_SESSION["role"] == "admin") {
                header("location:".BASE."User/adminIndex");
            } else if ($_SESSION["role"] == "regular") {
                header("location:".BASE."User/adminIndex");
            }
			return true;
		}
		return false;
	}
}