<?php

namespace app\filters;

// filter to kick out admin from trying to access customer screen.
#[\Attribute]
class Admin {
	function execute() {
		if ($_SESSION['role'] == 'admin') {
			header("location:".BASE."User/adminIndex");
			return true;
		} else {
			return false;
		}
	}
}