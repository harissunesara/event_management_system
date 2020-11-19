<?php
class Database {
    
    /*
        private $host = "localhost";
        private $db_name = "presecur_db";
        private $db_username = "presecur_db_user";
        private $db_pswd = "Royal@1985";
        */
   /*
        private $host = "localhost";
        private $db_username = "iridh_root";
        private $db_pswd = "admin@123";
        private $db_name = "iridh_political_app";
    */
    private $db_username = "root";
    private $db_pswd = "";
    private $db_name = "ems";
     private $host = "localhost";
    public $conn;

    public function dbConnection() 
    {
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->db_username, $this->db_pswd);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $pe) {
            echo "ddd";
            die("Could not connect to the database $this->db_name :" . $pe->getMessage());
        }
        return $this->conn;
    }
}
$mydb= new Database();
?>