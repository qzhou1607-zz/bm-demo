<?php 
class DBO {
    protected $db;//databse
    protected $data = array();//data of the object;
    protected $table_name;
    protected $primary_key;
    protected $columns;
    function __construct($params) {
        $this->db = $params['db'];
        $this->table_name = $params['table_name'];
        $this->primary_key = $params['primary_key'];
        $this->columns = $params['columns'];
    }
    
    function select($id) {
        $sql = sprintf('SELECT * FROM %s WHERE %s = %s', $this->table_name, $this->primary_key, $id);
        $result = $this->db->query($sql);
        $pairs = $result->fetch_assoc();
        if (count($pairs)) {
            foreach($pairs as $name => $value) {
//                echo $name;
//                echo $value;
                $this->data[$name] = $value;
            }
        }
    }
    
    function __get($key) {
        return $this->data[$key];
    }
    //load key value pairs into data property of a class
    function load_properties(array $pairs) {
        foreach ($pairs as $name => $value) {
            $this->data[$name] = $value;
        }
    }
    
    function update(array $updated_columns) {
        $pairs = array();
        foreach($updated_columns as $key => $value ) {
            array_push($pairs, $key . '=' . $this->db->sqlval($value));
            array_push($pairs,'updated='.date());
        } 
        
        $sql = sprintf(
                'UPDATE %s SET %s WHERE %s = %s',
                $this->table_name,
                implode(',',$pairs),
                $this->primary_key,
                $this->data[$this->primary_key]
                );
        $this->db->query($sql);
    }
    
    function insert(array $updated_columns) {
            $updated_columns['updated'] = date("Y-m-d",time());
            $names = array();
            $values = array();
            foreach ($updated_columns as $key => $value) {
                 array_push($names, $key);
                 array_push($values, $this->db->sqlval($value));
            }
            $sql = sprintf('INSERT INTO %s (%s) VALUES (%s)',
                                     $this->table_name,
                                     implode(', ', $names),
                                     implode(', ', $values)
                             );
            
            //prd($sql);
            $this->db->query($sql);
    }
    
    function delete() {
        $sql = sprintf('DELETE * FROM %s WHERE %s = %s',
                $this->table_name,
                $this->primary_key,
                $this->data[$this->primary_key]
                );
        $this->db->query($sql);
    }
}
?>