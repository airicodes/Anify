<?php

namespace app\filters;
//definition of an attribute
//it needs to be applied to be functional
#[\Attribute]
class AdminCheck {
	function execute(){
		if($_SESSION['type'] == 'admin'){
			header('location:/User/login');
			return true;
		}
		return false;
	}
}
