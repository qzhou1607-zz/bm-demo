<?php
require_once '../../init.php';
$message = new Message($DB);
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$content = $_REQUEST['content'];
$shop_id = $_REQUEST['shop_id'];

$response = array();
try {
    $message->insert(array(
        'name' => $name,
        'email'=> $email,
        'content' => $content,
        'shop_id' => $shop_id
    ));
}  catch (Exception $e) {
    $response['error'] = $e->getMessage();
    echo json_encode($response);
    exit();
}
$response['success'] = 'Message Sent!';
echo json_encode($response);

