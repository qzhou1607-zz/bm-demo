<?php
require_once '../../init.php';

$id = rand(1, 1000);
$customer = new MockCustomer($DB, $id);

$response = array(
    'first_name' => $customer->first_name,
    'last_name'  => $customer->last_name,
    'email'      => $customer->email,
    'address_1'  => $customer->address_1,
    'city'       => $customer->city,
    'state'      => $customer->state,
    'country'    => $customer->country,
    'postal_code'=> $customer->postal_code,
    'cc_num'     => $customer->cc_num,
    'cc_month'   => $customer->cc_month,
    'cc_year'    => $customer->cc_year,
    'phone'      => $customer->phone,
    'cc_cvv'     => $customer->cc_cvv
);

echo json_encode($response);

