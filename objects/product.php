<?php
class Product{
  
    // database connection and table name
    private $conn;
    private $table_name = "Students";
  
    // object properties
    public $Id;
	public $Name;
	public $Age;
    public $Department;
    public $Subjects;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

	// read products
	function read(){
	    // select all query
	    $query = "SELECT * FROM " . $this->table_name . " ORDER BY Id ASC";
	  
	    // prepare query statement
	    $stmt = $this->conn->prepare($query);
	  
	    // execute query
	    $stmt->execute();
	  
	    return $stmt;
	}//end of read()

	// create product
	function create(){
	  
	    // query to insert record
	    $query = "INSERT INTO
			" . $this->table_name . "
		    SET
			Id=:Id,  Name=:Name, Age=:Age, Department=:Department, Subjects=:Subjects";
	  
	    // prepare query
	    $stmt = $this->conn->prepare($query);
	  
		// sanitize
		$this->Id=htmlspecialchars(strip_tags($this->Id));
	    $this->Name=htmlspecialchars(strip_tags($this->Name));
	    $this->Age=htmlspecialchars(strip_tags($this->Age));
	    $this->Department=htmlspecialchars(strip_tags($this->Department));
	    $this->Subjects=htmlspecialchars(strip_tags($this->Subjects));
	  
	    // bind values
	    $stmt->bindParam(":Id", $this->Id);
	    $stmt->bindParam(":Name", $this->Name);
	    $stmt->bindParam(":Age", $this->Age);
	    $stmt->bindParam(":Department", $this->Department);
	    $stmt->bindParam(":Subjects", $this->Subjects);
	  
	    // execute query
	    if($stmt->execute()){
		return true;
	    }
	  
	    return false;      
	}//end of create()

	// readOne product
	function readOne(){
	  
	    // query to read single record
	    $query = "SELECT * FROM " . $this->table_name . " WHERE Id = ? LIMIT 0,1";
	  
	    // prepare query statement
	    $stmt = $this->conn->prepare( $query );
	  
	    // bind id of product to be updated
	    $stmt->bindParam(1, $this->Id);
	  
	    // execute query
	    $stmt->execute();
	  
	    // get retrieved row
	    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	  
	    // set values to object properties
	    if($row){
			$this->Id = $row['Id'];
			$this->Name = $row['Name'];
			$this->Age = $row['Age'];
			$this->Department = $row['Department'];
			$this->Subjects = $row['Subjects'];
		}
	}//end of readOne()


	// update the product
	function update(){
	  
	    // update query
	    $query = "UPDATE
		        " . $this->table_name . "
		    SET
		        Name = :Name,
		        Age = :Age,
		        Department = :Department,
		        Subjects = :Subjects
		    WHERE
		        Id = :Id";
	  
	    // prepare query statement
	    $stmt = $this->conn->prepare($query);
	  
	    // sanitize
	    $this->Id=htmlspecialchars(strip_tags($this->Id));
	    $this->Name=htmlspecialchars(strip_tags($this->Name));
	    $this->Age=htmlspecialchars(strip_tags($this->Age));
	    $this->Department=htmlspecialchars(strip_tags($this->Department));
	    $this->Subjects=htmlspecialchars(strip_tags($this->Subjects));
	  
	    // bind values
	    $stmt->bindParam(":Id", $this->Id);
	    $stmt->bindParam(":Name", $this->Name);
	    $stmt->bindParam(":Age", $this->Age);
	    $stmt->bindParam(":Department", $this->Department);
	    $stmt->bindParam(":Subjects", $this->Subjects);
	  
	    // execute the query
	    if($stmt->execute()){
		return true;
	    }
	  
	    return false;
	}//end of update()

	// delete the product
	function delete(){
	  
	    // delete query
	    $query = "DELETE FROM " . $this->table_name . " WHERE Id = ?";
	  
	    // prepare query
	    $stmt = $this->conn->prepare($query);
	  
	    // sanitize
	    $this->Id=htmlspecialchars(strip_tags($this->Id));
	  
	    // bind id of record to delete
	    $stmt->bindParam(1, $this->Id);
	  
	    // execute query
	    if($stmt->execute()){
		return true;
	    }else{
	    	return false;
		}
	}//end of delete()

	// search products
	function search($keywords){
	  
	    // select all query
	    $query = "SELECT * FROM
		        " . $this->table_name . " WHERE Name LIKE ? OR Department LIKE ? OR Subjects LIKE ?
		    ORDER BY
		        Id ASC";
	  
	    // prepare query statement
	    $stmt = $this->conn->prepare($query);
	  
	    // sanitize
	    $keywords=htmlspecialchars(strip_tags($keywords));
	    $keywords = "%{$keywords}%";
	  
	    // bind
	    $stmt->bindParam(1, $keywords);
	    $stmt->bindParam(2, $keywords);
	    $stmt->bindParam(3, $keywords);
	  
	    // execute query
	    $stmt->execute();
	  
	    return $stmt;
	}//end of search()

}//end of class
?>
