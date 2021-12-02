<?php

namespace app\filters;

// This filter is to check if a user is logged in or not. 
// If not, put them back to the login page.
#[\Attribute]
class MainPage	{
	function execute(){
		if(!isset($_SESSION['user_id'])){
			header('location:/Main/index');
			return true;
		}
		return false;
	}
}
