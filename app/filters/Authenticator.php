<?php

namespace app\filters;
//definition of an attribute
//it needs to be applied to be functional
#[\Attribute]
class Authenticator {
	function execute() {
		if(!is_null($_SESSION['secretkey'])){
			header('location:/Main/confirm2fa');
			return true;
		}
		return false;
	}
}
