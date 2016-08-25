<?php 
class Order extends DBO {
    function __construct($db, $id = 0) {
        parent::__construct(array(
            'db' => $db,
            'table_name' => 'orders',
            'primary_key'=> 'order_id',
            'columns'    => 'order_id, product_id, customer_id, quantity, paid',
        ));
        $id = (int) $id;
        $this->select($id);
    }
    
    static function get_orders_by_customer_id($customer_id) {
        GLOBAL $DB;
        $sql = 'SELECT * FROM orders WHERE customer_id = ' . $DB->sqlval($customer_id);
        $orders = $DB->query_as_objects('Order',$sql);
        return$orders;
    }
    
    static function get_total_by_customer_id($customer_id) {
        GLOBAL $DB;
        $sql = 'SELECT * FROM orders WHERE customer_id = ' . $DB->sqlval($customer_id);
        $orders = $DB->query_as_objects('Order',$sql);
        $total = 0;
        foreach ($orders as $order) {
            $total += $order->total;
        }
        return $total;
    }    
    
}
?>