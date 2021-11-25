<?php

//where to implement the autoload

spl_autoload_register(
	function ($class_name) { 
		$class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
    	include($class_name . '.php'); 
	}
); 