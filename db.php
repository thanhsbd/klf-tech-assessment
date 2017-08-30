<?php
class db {
	protected $conn;
	
	function __construct() 
	{
	    $this->conn = new PDO('mysql:host='.DB_HOSTNAME.';dbname='.DB_DATABASE.';port='.DB_PORT, DB_USERNAME, DB_PASSWORD, 
	                            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8;"));
	    $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	
	function __destruct() 
	{
	    $this->conn = null;
	}

	public function execute_query($sql, $params = array())
	{
	    $this->log_db_event($sql . " [".http_build_query($params)."]");
	    try
	    {
	        $stm = $this->conn->prepare($sql);
	        $stm->execute($params);
	    }
	    catch (PDOException $e)
	    {
				/*
	        echo $e->getMessage();
	        echo "Database error! Please contact administrator.";
				*/
	        $this->log_db_event("ERROR - " . $e->getMessage());
	        die();
	    }
	}

	public function fetch_results($sql, $params = array())
	{
	    $this->log_db_event($sql . " [".http_build_query($params)."]");
	    try
	    {
	        $stm = $this->conn->prepare($sql);
	        $stm->execute($params);
	        $results = $stm->fetch(PDO::FETCH_ASSOC);
	        return $results;
	    }
	    catch (PDOException $e)
	    {
				/*
	        echo $e->getMessage();
	        echo "Database error! Please contact administrator.";
				*/
	        $this->log_db_event("ERROR - " . $e->getMessage());
	        die();
	    }
	}

	public function fetch_all_results($sql, $params = array())
	{
	    $this->log_db_event($sql . " [".http_build_query($params)."]");
	    try
	    {
	        $stm = $this->conn->prepare($sql);
	        $stm->execute($params);
	        $results = $stm->fetchAll(PDO::FETCH_ASSOC);
	        return $results;
	    }
	    catch (PDOException $e)
	    {
				/*
	        echo $e->getMessage();
	        echo "Database error! Please contact administrator.";
				*/
	        $this->log_db_event("ERROR - " . $e->getMessage());
	        die();
	    }
	}
	
	public function last_insert_id()
	{
	    try
	    {
					$sql = "SELECT last_insert_id() AS last_insert_id";
	        $stm = $this->conn->prepare($sql);
	        $stm->execute();
	        $results = $stm->fetch(PDO::FETCH_ASSOC);
					return $results['last_insert_id'];
	    }
	    catch (PDOException $e)
	    {
				/*
	        echo $e->getMessage();
	        echo "Database error! Please contact administrator.";
				*/
	        $this->log_db_event("ERROR - " . $e->getMessage());
	        die();
	    }
	}

	protected function log_db_event($str)
	{
	    file_put_contents(LOG_FILE, date('Y-m-d H:i:s') . " - " . $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING']. " - " .  $str . "\n", FILE_APPEND);
	}
}

?>