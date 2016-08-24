<?php
require_once '../../init.php';
//prd($_REQUEST);
//Array
//(
//    [customer_id] => 1
//    [first_name] => claire
//    [last_name] => zhou
//    [address_1] => 20901 lava flow lane
//    [state] => OR
//    [postal_code] => 97701
//    [email] => qczhou@ucdavis.edu
//    [same_address] => true
//    [cc_first_name] => Qing
//    [cc_last_name] => Zhou
//    [cc_num] => 4242424242424242
//    [cc_month] => 09
//    [cc_year] => 2019
//    [cc_cvv] => 198
//    [billing_address_1] => 20901 lava flow lane
//    [billing_state] => OR
//    [billing_postal_code] => 97701
//    [orders] => Array
//        (
//            [0] => Array
//                (
//                    [customer_id] => 1
//                    [product_id] => 2
//                    [quantity] => 1
//                    [total] => 24.99
//                )
//
//            [1] => Array
//                (
//                    [customer_id] => 1
//                    [product_id] => 6
//                    [quantity] => 1
//                    [total] => 280.49
//                )
//
//        )
//)

//$customer_id = $_REQUEST['customer_id'];
$first_name = (string) $_REQUEST['first_name'];
$last_name = (string) $_REQUEST['last_name'];
$address_1 = (string) $_REQUEST['address_1'];
$address_2 = is_null(get($_REQUEST['address_2'])) ? null : (string) get($_REQUEST['address_2']);
$state = (string) $_REQUEST['state'];
$email = (string) $_REQUEST['email'];
$cc_first_name = (string) $_REQUEST['cc_first_name'];
$cc_last_name = (string) $_REQUEST['cc_last_name'];
$cc_num = (string) $_REQUEST['cc_num'];
$cc_month = (string) $_REQUEST['cc_month'];
$cc_year = (string) $_REQUEST['cc_year'];
$cc_cvv = (string) $_REQUEST['cc_cvv'];
$billing_address_1 = (string) $_REQUEST['billing_address_1'];
$billing_address_2 = is_null(get($_REQUEST['billing_address_2'])) ? null : (string) get($_REQUEST['billing_address_2']);
$billing_state = (string) $_REQUEST['billing_state'];
$billing_postal_code = (string) $_REQUEST['billing_postal_code'];

$response = array();

try {
    $customer = new Customer($DB);
    $confirmation_code = 'QS' . rand(10000,99999);
    $customer->insert(array(
        //'customer_id' => $customer_id,
        'first_name'  => $first_name,
        'last_name'   => $last_name,
        'address_1'   => $address_1,
        'address_2'   => $address_2,
        'state'       => $state,
        'email'       => $email,
        'cc_first_name'=> $cc_first_name,
        'cc_last_name' => $cc_last_name,
        'cc_num'      => $cc_num,
        'cc_month'    => $cc_month,
        'cc_year'     => $cc_year,
        'cc_cvv'      => $cc_cvv,
        'billing_address_1' => $billing_address_1,
        'billing_address_2' => $billing_address_2,
        'billing_state'     => $billing_state,
        'billing_postal_code' => $billing_postal_code,
        'confirmation_code'    => $confirmation_code

    ));

    $customer_id = $customer->get_customer_by_confirmation_code($confirmation_code)->customer_id;

    $orders_fr_shop = $_REQUEST['orders'];

    foreach($orders_fr_shop as $order_fr_shop) {
        $order = new Order($DB);
        $order->insert(array(
            'customer_id' => $customer_id,
            'product_id'  => $order_fr_shop['product_id'],
            'quantity'    => $order_fr_shop['quantity'],
            'total'       => $order_fr_shop['total']
        ));
    }

} catch (Exception $e) {
    $response['error'] = $e;
    echo json_encode($response);
    exit();
}

$response['success'] = 'saved successfully!';
echo json_encode($response);
//prd($address_1);
