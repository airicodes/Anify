<?php

namespace app\filters;

// filter to kick out regular user from trying to access admin screens.
#[\Attribute]
class Regular {
	function execute() {
		if ($_SESSION['role'] == 'regular') {
			header("location:".BASE."User/regularIndex");
			return true;
		} else {
			return false;
		}
	}
}