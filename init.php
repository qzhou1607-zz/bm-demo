<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'functions.php';

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$db_host = $url["host"];
$db_user = $url["user"];
$db_password = $url["pass"];
$db_name = substr($url["path"], 1);

//$db_host = 'localhost';
//$db_user = 'root';
//$db_password = 'root';
//$db_name = 'test_db';

define('ROOT', dirname(__FILE__));

spl_autoload_register(function($class_name) {
    $path = ROOT . '/classes/' . $class_name . '.class.php';
    include_once $path;
});

$DB = new DB($db_host, $db_user, $db_password, $db_name);


