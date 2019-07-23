<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'myblog';
    private $username = 'root';
    private $password = 'riaze';
    private $conn;

    //db connct

    public function connection(){
        $this->conn= null;

        try{
            $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,$this->username, $this->password);
        
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        }
        catch(PDOException $e){
            echo 'connection Error' . $e->getMessage();
        }
        return $this->conn;
    } 
}