<?php
require_once 'init.php';
echo 'hello';
//prd($DB);
$sql = 'SELECT * 
        FROM products 
';

$row = $DB->query_as_objects('Product', $sql);
//print_r($row[0]->name);
prd($row[0]);

