<?php

(new DotEnv('./.env'))->load(); // Read .env contents
class Database {
    private $host;
    private $user;
    private $pwd;
    private $dbName;

    /**
     * Initializes once the class have been instantiated
     */
    function __construct() {
        $this->host = getenv('DB_HOST');
        $this->user = getenv('DB_USERNAME');
        $this->pwd = getenv('DB_PASSWORD');
        $this->dbName = getenv('DB_NAME');
    }

    /**
     * Connect to database
     */
    protected function connect() {

        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName; // Type of database and what host and db name 

            $pdo = new PDO($dsn, $this->user, $this->pwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, 
                               PDO::FETCH_ASSOC); // FETCH_ASSOC returns an array

            return $pdo;
        } 
        catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }

    }

    /**
     * Get all rows inside a table
     */
    protected function getAll(string $table_name) {
        $query = "SELECT * 
                FROM $table_name";
        
        $stmt = $this->connect()->query($query); // Executes query
        $rows = $stmt->fetchAll(); // Gets query results

        return $rows;
    }

    /**
     * Get all rows inside a table by column and some value
     */
    protected function findAll(string $table_name, string $column_name, $column_value) {
        $query = "SELECT * 
                  FROM $table_name
                  WHERE $column_name = $column_value";
        
        $stmt = $this->connect()->query($query); // Executes query
        $rows = $stmt->fetchAll(); // Gets query results

        return $rows;
    }

    /**
     * Find a row by id or email
     */
    protected function find(string $table_name, int $id = null, string $email = null) {
        if ($email !== null) {
            $query = "SELECT * 
                FROM $table_name
                WHERE `email`=?"; // Made to prevention harmful injections by users
        
            $stmt = $this->connect()->prepare($query); // prepare() is used to bind any user-input
            $stmt->execute([$email]); // execute() executes a prepared statement
            $row = $stmt->fetch();

            return $row;
        }

        if ($id !== null) {
            $query = "SELECT * 
                FROM $table_name
                WHERE id = ?";
        
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$id]);
            $row = $stmt->fetch();

            return $row;
        }
    }

    /**
     * Insert new row to table
     */
    protected function create(string $table_name, array $data) {
        $key = array_keys($data);  // get key( column name)

        $values = array_values($data);  // get values (values to be inserted)

        $placeholders = implode(',', array_fill(0, count($data), '?')); // create '?' based on count

        $query = "INSERT INTO $table_name ( " . implode(',' , $key) . ") VALUES($placeholders)";
        
        $stmt = $this->connect()->prepare($query);
        $stmt->execute($values);
    }

    /**
     * Update row inside a table
     */
    protected function update(string $table_name, int $id, array $data) {
        $key = array_keys($data);  // get key( column name)

        $values = array_values($data);  // get values (values to be inserted)

        $query = "UPDATE $table_name 
                  SET " . "`" . implode('`=?, `' , $key) . "`=? " .
                  " WHERE `id` = $id";

        $stmt = $this->connect()->prepare($query);
        $stmt->execute($values);
    }
    
    /**
     * Delete row inside a table
     */
    protected function delete(string $table_name, int $id) {
        $query = "DELETE 
                FROM $table_name
                WHERE id = ?";

        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$id]);
    }
}