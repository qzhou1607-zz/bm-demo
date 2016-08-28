<?php 
class Customer extends DBO {
    function __construct($db, $id = 0) {
        parent::__construct(array(
            'db' => $db,
            'table_name' => 'customers',
            'primary_key'=> 'customer_id',
            'columns'    => 'customer_id, first_name, last_name, address_1, address_2, city, state, country, postal_code, email, billing_address_1, billing_address_2, billing_city, billing_state, billing_country, billing_postal_code',
        ));
        $id = (int) $id;
        $this->select($id);
    }
    
    static function get_all_customers() {
        GLOBAL $DB;
        $sql = 'SELECT * FROM customers';
        $customers = $DB->query_as_objects('Customer',$sql);
        return $customers;
    }
  
          
    function get_customer_by_confirmation_code($code) {
        $sql = 'SELECT * FROM ' . $this->table_name . ' WHERE confirmation_code = ' . $this->db->sqlval($code);
        $customer = $this->db->query_as_object('Customer', $sql);
        return $customer;
    }
    
    function get_orders() {
        $orders = Order::get_orders_by_customer_id($this->customer_id);
        return $orders;
    }
}
?>