<?php
/**
  * summary
  */
class Database
{
     /**
      * summary
      */
     private static $instance = null;
     private $mysqli,
     $host = 'localhost',
     $user = 'root',
     $pass = '',
     $dbname = 'tutorialforum_oop',
     $port = '3307';

     public function __construct(){
     	$this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->dbname, $this->port);
     	if ( mysqli_connect_error() ) {
     		die('gagal koneksi');
     	}
     }

     // singleton pattern, menguji koneksi agar tidak double
     public static function getInstance(){
     	if (!isset(self::$instance)) {
     		self::$instance = new Database();
     	}

     	return self::$instance;
     }

     public function insert($table, $fields = array())
     {
        //mengambil kolom
        $column = implode(",", array_keys($fields));

        //mengambil nilai
        $valuesArrays = array();
        $i = 0;
        foreach ($fields as $key => $values) {
            if(is_int($values)){
                $valuesArrays[$i] = $this->escape($values);
            }else{
                $valuesArrays[$i] = "'" . $this->escape($values) . "'";
            }

            $i++;
        }
        $values = implode(",", $valuesArrays);

        $query = "INSERT INTO $table ($column) VALUES ($values)";

        return $this->run_query($query, 'Masalah Saat Memasukan Data');
    }

    public function get_info($table, $column, $value)
    {
        if (!is_int($value)) {
            $value = "'" . $value . "'";
             
             $query = "SELECT * FROM $table WHERE $column = $value";
             
             $result = $this->mysqli->query($query);

             while ($row = $result->fetch_assoc()) {
                 return $row;
             }
        }
    }

    public function run_query($query, $msg)
    {
        if($this->mysqli->query($query) or die($msg)) return true;
        else die($msg);
    }

    public function escape($name)
    {
        return $this->mysqli->real_escape_string($name);
    } 
}


// $db = Database::getInstance();
?>