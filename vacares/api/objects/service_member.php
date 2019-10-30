<?php
class Service_Member{
 
    // database connection and table name
    private $conn;
    private $table_name = "service_member";
 
    // object properties
    public $firstName;
    public $LastName;
    public $Rank;
    public $Branch;
    public $Component;
    public $Street;
    public $City;
    public $State;
	public $Eligible
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read all service members
    function read(){
    
        // select all query
        $query = "SELECT
                    `Service_Member_Name_First`, `Service_Member_Name_Last`, `Rank`, `Branch`, `Component`, `Address_Street`, `Address_City`, `Address_State`, `Eligible`
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    Service_Member_Name_Last DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
    // get single service member data
    function read_single(){
    
        // select all query
        $query = "SELECT
                    `Service_Member_Name_First`, `Service_Member_Name_Last`, `Rank`, `Branch`, `Component`, `Address_Street`, `Address_City`, `Address_State`, `Eligible`
                FROM
                    " . $this->table_name . " 
                WHERE
                    Service_Member_Name_Last= '".$this->lastName."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }
    // create service member
    function create(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        
        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ." 
                        (`Service_Member_Name_First`, `Service_Member_Name_Last`, `Rank`, `Branch`, `Component`, `Address_Street`, `Address_City`, `Address_State`, `Eligible`)
                  VALUES
                        ('".$this->firstName."', '".$this->lastName."', '".$this->Rank."', '".$this->Branch."', '".$this->Component."', '".$this->Street."', '".$this->City."', '".$this->State."', '".$this->Eligible"')";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->lastName = $this->conn->lastInsertLastName();
            return true;
        }
        return false;
    }
    // update service member 
    function update(){
    
        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name='".$this->firstName."', '".$this->lastName."', '".$this->Rank."', '".$this->Branch."', '".$this->Component."', '".$this->Street."', '".$this->City."', '".$this->State."', '".$this->Eligible"'
                WHERE
                    Service_Member_Name_Last='".$this->lastName."'";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    // delete service member
    function delete(){
        
        // query to insert record
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE
                    Service_Member_Name_Last= '".$this->lastName."'";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                email='".$this->email."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}