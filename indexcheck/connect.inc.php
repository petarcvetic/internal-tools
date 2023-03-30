<?php
class Database
{   
    private $host = "localhost";
    private $db_name = "noindex";
    private $username = "forge";
    private $password = "JOvsyLho1zKZ9xUXLIoK";

/*
    private $username = "tools";
    private $password = "Sp33d??";
*/
/*
    private $username = "noindex";
    private $password = "noindex";
 */   public $conn;
     
    public function dbConnection()
	{
     
	    $this->conn = null;    
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conn->exec('SET NAMES utf8');
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }         
        return $this->conn;
    }
}
?>