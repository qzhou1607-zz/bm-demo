<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'functions.php';
require_once 'config.php';

spl_autoload_register(function($class_name) {
    $path = ROOT . '/classes/' . $class_name . '.class.php';
    include_once $path;
});

$DB = new DB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);



