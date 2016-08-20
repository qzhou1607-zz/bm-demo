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
    
    function query_as_objects($class_name, $query) {
        $result = array();
        $rows = $this->query($query);
        while($row = $rows->fetch_object($class_name)) {
            //$instance = new $class_name($row);
            array_push($result, $row);
        }
        $rows->free();
        return $result;
    }
}
?>