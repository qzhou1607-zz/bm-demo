<?php 
class DB {
    private $db;
    function __construct($db_host, $db_user, $db_password, $db_name) {
        $this->db = new mysqli($db_host,$db_user,$db_password,$db_name);
        if ($this->db->connect_errno) {
            die('error with connection, error_code:'.$this->db->connect_errno.', error:'.$this->db->connect_error);
        }
    }
    
    function query($query) {
        $result = $this->db->query($query);
        return $result;
    }
    
    function query_as_array($query) {
        $result = array();
        $rows = $this->query($query);
        while($row = $rows->fetch_assoc()) {
            array_push($result, $row);
        }
        $rows->free();
        return $result;
    }
    
    function insert_to_db($table_name, array $params) {
        $names = array();
        $values = array();
        foreach ($params as $name => $value) {
            array_push($names, $name);
            array_push($values, $value);
        }
        $sql = sprintf('INSERT INTO %s (%s) VALUES (%s)',
				$table_name,
				implode(', ', $names),
				implode(', ', $values)
			);
        $this->query($sql);
        return true;
    }
    
    function query_as_objects($class_name, $query) {
        $result = array();
        $rows = $this->query($query);
        while($row = $rows->fetch_object($class_name)) {
            array_push($result, $row);
        }
        $rows->free();
        return $result;
    }
}
?>