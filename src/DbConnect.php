<?php 


namespace App\DbConnect;

use PDOException;

class DbConnect 
{
    private static $instance = null;

    private function __construct(){
        $this->dbName = "npp";
        $this->user = 'root';
        $this->password = '';
        $this->host = "mysql:dbname=" . $this->dbName . ";host=localhost;";
        $this->options = [];
        $this->pdo = new \PDO($this->host, $this->user, $this->password);

    }

    public static function getInstance(){
        if (!self::$instance){
            return new DbConnect;
        }
        return self::$instance;
    }
}


try{
    $connexion = DbConnect::getInstance();
    $connexion->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    // print_r($connexion);
} catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}

// creer table users

// $sql = "CREATE TABLE Users (
//     PersonID int,
//     LastName varchar(255),
//     FirstName varchar(255),
//     Address varchar(255),
//     City varchar(255)
// );";


// read simple
$sql = "SELECT * from Users";

// insertion simple 
// $sql = "INSERT INTO Users (PersonID, LastName, FirstName, Address, City) VALUES (1, 'John', 'david', 'zededzed', 'zdezdee')";


$stmt = $connexion->pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();

print_r($result);





?>

