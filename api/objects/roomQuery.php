<?php
class roomQuery{
 
    // database connection and table name
    private $conn;
    private $table_name = "emptyroom";
 
    // object properties
    public $id;
    public $roomNo;
    public $day;
    public $time;
    public $timeStamp;
    public $isbooked;
    public $contact_no;
    public $courseCode;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    public function read(){
    
        // select all query
        //$query = "SELECT * FROM ". $this->table_name ."";
        $query = "SELECT * FROM ". $this->table_name ." WHERE isbooked = 'pending' OR isbooked IS NULL";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product

    public function create(){
        
            // query to insert record

            $query = "INSERT INTO
                        " . $this->table_name . "
                    SET
                       roomNo=:roomNo, day=:day, time=:time, timeStamp=:timeStamp
                       ,isbooked=:isbooked, contact_no=:contact_no,courseCode=:courseCode";
        
            // prepare query
            $stmt = $this->conn->prepare($query);
            // bind values
            $stmt->bindParam(":roomNo", $this->roomNo);
            $stmt->bindParam(":day", $this->day);
            $stmt->bindParam(":time", $this->time);
            $stmt->bindParam(":timeStamp", $this->timeStamp);
            $stmt->bindParam(":isbooked", $this->isbooked);
            $stmt->bindParam(":contact_no", $this->contact_no);
            $stmt->bindParam(":courseCode", $this->courseCode);
        
            // execute query
            if($stmt->execute()){
                return true;
            }
        
            return false;
            
        }


    
        // create product
    
    public function insertAllJson(){
            
                // query to insert record
    
                $query = "INSERT INTO
                            " . $this->table_name . "
                        SET
                           roomNo=:roomNo, day=:day, time=:time, timeStamp=:timeStamp";
                // prepare query
                $stmt = $this->conn->prepare($query);
                // bind values
                $stmt->bindParam(":roomNo", $this->roomNo);
                $stmt->bindParam(":day", $this->day);
                $stmt->bindParam(":time", $this->time);
                $stmt->bindParam(":timeStamp", $this->timeStamp);
            
                // execute query
                if($stmt->execute()){
                    return true;
                }
            
                return false;
                
            }

function update(){
 
                // update query
                $query = "UPDATE
                            " . $this->table_name . "
                    SET 
                                     
                        isbooked=:isbooked,
                        contact_no=:contact_no,
                        courseCode=:courseCode
                    WHERE
                        id=:id";
             
                // prepare query statement
                $stmt = $this->conn->prepare($query);
             
             
                // bind new values
                $stmt->bindParam(":id",$this->id);
                $stmt->bindParam(":isbooked", $this->isbooked);
                $stmt->bindParam(":contact_no", $this->contact_no);
                $stmt->bindParam(":courseCode", $this->courseCode);
                // execute the query
                if($stmt->execute()){
                    return true;
                }
             
                return false;
            }
}
