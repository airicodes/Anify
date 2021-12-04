<?php

namespace app\filters;
//definition of an attribute
//it needs to be applied to be functional
#[\Attribute]
class Login	{
	function execute(){
		if(!isset($_SESSION['user_id'])){
			header('location:/Main/login');
			return true;
		}
		return false;
	}
}
