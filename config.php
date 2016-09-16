<?php

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
define('DB_HOST',	$url["host"]);
define('DB_USER',	$url["user"]);
define('DB_PASSWORD', $url["pass"]);
define('DB_NAME',	substr($url["path"], 1));

//define('DB_HOST',	'localhost');
//define('DB_USER',	'root');
//define('DB_PASSWORD', 'root');
//define('DB_NAME',	'test_db');

define('GOOGLE_MAP_KEY',	getenv("GOOGLEMAPKEY"));
define('SHIPPO_KEY',	getenv("SHIPPOKEY"));
define('ROOT', dirname(__FILE__));

