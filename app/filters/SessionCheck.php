<?php

namespace app\filters;

// This filter is to not let users access login and register when they are logged in.
#[\Attribute]
class SessionCheck {
	function execute() {
		if(isset($_SESSION['user_id'])){
			$user = new \app\models\User();
			$user = $user->getUser($_SESSION["user_id"]);
			if ($user->role == "admin") {
				header("location:".BASE."User/adminIndex");
			} else if ($user->role == "regular") {
				header("location:".BASE."User/regularIndex");
			}
			return true;
		}
		return false;
	}
}