<?php
class Patient{

    // database connection and table name
    private $conn;
    private $table_name = "patients";
 
    // object properties
    public $Patient_Name_First;
    public $Patient_Name_Last;
    public $Rank;
    public $Branch;
    public $Component;
    public $Address_Street;
    public $Address_City;
    public $Address_State;
    public $Service_Member_Name_First;
    public $Service_Member_Name_Last;
    public $VA_Hospital_Name;
    public $Healthcare_Provider_Name_First;
    public $Healthcare_Provider_Name_Last;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

     // read all patients
    function read(){
    
        // select all query
        $query = "SELECT
                    `Patient_Name_First`, `Patient_Name_Last`, `Rank`, `Branch`, `Component`, `Address_Street`, `Address_City`, `Address_State`, `Service_Member_Name_First`, `Service_Member_Name_Last`, `VA_Hospital_Name`, `Healthcare_Provider_Name_First`, `Healthcare_Provider_Name_Last`
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    Patient_Name_Last DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // get single patient data
    function read_single(){
    
        // select all query
        $query = "SELECT
                    `Patient_Name_First`, `Patient_Name_Last`, `Rank`, `Branch`, `Component`, `Address_Street`, `Address_City`, `Address_State`, `Service_Member_Name_First`, `Service_Member_Name_Last`, `VA_Hospital_Name`, `Healthcare_Provider_Name_First`, `Healthcare_Provider_Name_Last`
                FROM
                    " . $this->table_name . " 
                WHERE
                    Patient_Name_Last= '".$this->Patient_Name_Last."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }
    // create patient
    function create(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        
        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ." 
                        (`Patient_Name_First`, `Patient_Name_Last`, `Rank`, `Branch`, `Component`, `Address_Street`, `Address_City`, `Address_State`)
                  VALUES
                        ('".$this->Patient_Name_First."', '".$this->Patient_Name_Last."', '".$this->Rank."', '".$this->Branch."', '".$this->Component."', '".$this->Address_Street."', '".$this->Address_City."', '".$this->Address_State."')";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->Patient_Name_Last = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }
    // update patient 
    function update(){
    
        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name='".$this->Patient_Name_First."', '".$this->Patient_Name_Last."', '".$this->Rank."', '".$this->Branch."', '".$this->Component."', '".$this->Address_Street."', '".$this->Address_City."', '".$this->Address_State."'
                WHERE
                    Patient_Name_Last='".$this->Patient_Name_Last."'";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    // delete patient
    function delete(){
        
        // query to insert record
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE
                    Patient_Name_Last= '".$this->Patient_Name_Last."'";
        
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
                Patient_Name_Last='".$this->Patient_Name_Last."'";
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