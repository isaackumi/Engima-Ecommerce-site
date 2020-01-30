<?php 
 include('constants.php');

class dbConnection{
    // Encapsulating values of connection 
    private $localhost;
    private $hostname;
    private $password;
    private $db;
    private $connection;

    public function dbconnect(){
        $this->localhost  = HOSTNAME;
        $this->hostname = USERNAME;
        $this->password = PASSWD;
        $this->db = DATABASE;

        $this->connection = new Mysqli($this->localhost,$this->hostname,$this->password,$this->db);
        if($this->connection){
            return $this->connection;
            // return "CONNECTION_SUCCESSFUL";
        }
        else{
            return "CONNECTION_ERROR";
        }
    }


}


 ?>