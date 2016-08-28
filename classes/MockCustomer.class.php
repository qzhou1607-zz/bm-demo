<?php 
class MockCustomer extends DBO {
    function __construct($db, $id = 0) {
        parent::__construct(array(
            'db' => $db,
            'table_name' => 'MOCK_CUSTOMER',
            'primary_key'=> 'id',
            'columns'    => 'id, first_name, last_name, email, address_1, city, state, country, postal_code, cc_num, cc_month, cc_year, phone, cc_cvv',
        ));
        $id = (int) $id;
        $this->select($id);
    }
}
?>