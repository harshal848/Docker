<?php

$dbhost  = 'localhost';
$dbuser  = 'root';
$dbpass  = '';
$link = mysqli_connect($dbhost, $dbuser, $dbpass);
if (!$link) {
    die('SERVER CONNECTION FAILED... <br>: ' . mysqli_error($link));
}

//creating Database
$sql = "CREATE DATABASE IF NOT EXISTS USERS";
$retval = mysqli_query($link,$sql);
if (!$retval) {
    die('DATABASE CREATION FAILED <br>: ' . mysqli_error($link));
}

//Creating table in above database
$sql = "CREATE TABLE IF NOT EXISTS `Students` (\n"

. "  `Id` int(11) NOT NULL UNIQUE,\n"

. "  `Name` varchar(100) NOT NULL,\n"

. "  `Age` int(11) NOT NULL,\n"

. "  `Department` varchar(100) NOT NULL,\n"

. "  `Subjects` varchar(100) NOT NULL\n"

. ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

mysqli_select_db($link,"USERS");
$retval = mysqli_query($link,$sql);
if (!$retval) {
    die('COULD NOT CREATE TABLE <br>: ' . mysqli_error($link));
}


//class is created to get the db connection in other pages and above script is for creating db and table
class Database{
  
    private $host = "localhost";
    private $db_name = "USERS";
    private $username = "root";
    private $password = "";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>
