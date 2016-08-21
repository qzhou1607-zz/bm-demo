<?php 
class Order extends DBO {
    function __construct($db, $id) {
        parent::__construct(array(
            'db' => $db,
            'table_name' => 'orders',
            'primary_key'=> 'order_id',
            'columns'    => 'order_id, product_id, customer_id, quantity, paid',
        ));
        $id = (int) $id;
        $this->select($id);
    }
    
}
?>