<?php
session_start();
//inclusions 
date_default_timezone_set("America/Montreal");
include('core/autoload.php');

require("core/phpqrcode/qrlib.php");
$path = getcwd() . '/';

$path = str_replace('\\', '/', $path);

//goal: C:\xampp/htdocs/project => /project/
$path = preg_replace('/^.+\/htdocs\//', '/', $path);

$path = preg_replace('
/\/+/', '/', $path);

define('BASE', $path);
