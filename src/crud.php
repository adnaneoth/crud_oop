<?php
class crud {
    private $dbHost = 'localhost';
    private $dbUsername = 'root';
    private $dbPassword = '';
    private $dbName = 'test';
    private $pdo;

    public function __construct() {
       
            $this->pdo = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName", $this->dbUsername, $this->dbPassword);
           
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
    }

    public function insertRecord($tableName, $data) {
        try {
            $columns = implode(',', array_keys($data));
            $placeholders = implode(',', array_fill(0, count($data), '?'));

            $sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute(array_values($data));
            return true; 
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false; 
        }
    }

    function updateRecord($table, $data, $id) {
        $placeholders = array();
    
        foreach ($data as $key => $value) {
            $placeholders[] = "$key = :$key";
        }
    
        $sql = "UPDATE $table SET " . implode(',', $placeholders) . " WHERE id = :id";
    
        $stmt = $this->pdo->prepare($sql);
    
        if (!$stmt) {
            die("Error in prepared statement: " . $this->pdo->errorInfo()[2]);
        }
    
        foreach ($data as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }
        $stmt->bindParam(":id", $id);
    
        $result = $stmt->execute();
    
        $stmt = null;
    
        return $result;
    }
    


    function deleteRecord($table, $id) {
        $sql = "DELETE FROM $table WHERE id = :id";
    
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            echo "Error" . $e->getMessage();
        }
    }
}

