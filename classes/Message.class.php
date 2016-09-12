<?php 
class Message extends DBO {
    function __construct($db, $id = 0) {
        parent::__construct(array(
            'db' => $db,
            'table_name' => 'messages',
            'primary_key'=> 'id',
            'columns'    => 'id,name,email,content,shop_id',
        ));
        $id = (int) $id;
        $this->select($id);
    }
    
    
}
?>