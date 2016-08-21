<?php
require_once '../../init.php';
$product_id = $_REQUEST['product_id'];
$quantity = $_REQUEST['quantity'];
$customer_id = $_REQUEST['customer_id'];

$params = array(
    'product_id' => $product_id,
    'quantity'   => $quantity,
    'customer_id'=> $customer_id,
    'paid'       => 0
);

//prd($params);
$response = array();

if ($DB->insert_to_db('orders', $params)) {
    $response['success'] = 'success';
    echo json_encode($response);
}