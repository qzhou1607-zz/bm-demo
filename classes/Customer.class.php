<?php 
class Order extends DBO {
    function __construct($db, $id = 0) {
        parent::__construct(array(
            'db' => $db,
            'table_name' => 'customers',
            'primary_key'=> 'customer_id',
            'columns'    => 'customer_id, first_name, last_name, address_1, address_2, state,postal_code, email, billing_address_1, billing_address_2,billing_state,billing_postal_code',
        ));
        $id = (int) $id;
        $this->select($id);
    }
    
}
?>