<?php 
class Product extends DBO {
    function __construct($db, $id) {
        parent::__construct(array(
            'db' => $db,
            'table_name' => 'products',
            'primary_key'=> 'product_id',
            'columns'    => 'product_id, name, description, price, inventory, img_url',
        ));
        $id = (int) $id;
        $this->select($id);
    }
    
    
}
?>