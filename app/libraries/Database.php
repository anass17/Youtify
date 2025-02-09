<?php

    require_once __DIR__ . '/../../vendor/autoload.php';
    
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
    $dotenv->load();

    class Database {
        private string $host;
        private string $dbname;
        private string $username;
        private string $password;
        private string $port;
        private string $error = '';
        
        private static $instance = null;
        private $conn;

        private function __construct(string $host, string $dbname, string $username, string $password, string $port) {
            $this -> host = $host;
            $this -> dbname = $dbname;
            $this -> username = $username;
            $this -> password = $password;
            $this -> port = $port;

            $this -> connect();
        }

        // Method to connect to database using PDO Class

        private function connect() {
            $dsn = "pgsql:host={$this -> host};port={$this -> port};dbname={$this -> dbname}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_CASE => PDO::CASE_LOWER
            ];

            try {
                $this -> conn = new PDO($dsn, $this -> username, $this -> password, $options);

                return true;
            } catch (PDOException $e) {
                echo $this -> error = "Error! Could not connect to the database" . $e -> getMessage();
                return false;
            }
        }

        // Create an instance if it does not exist

        public static function getInstance() {
            $host = isset($_ENV['DB_HOST']) ? $_ENV['DB_HOST'] : 'localhost';
            $dbname = isset($_ENV['DB_NAME']) ? $_ENV['DB_NAME'] : 'Youdemy';
            $username = isset($_ENV['DB_USER']) ? $_ENV['DB_USER'] : 'root';
            $password = isset($_ENV['DB_PASSWORD']) ? $_ENV['DB_PASSWORD'] : 'root1234';
            $port = isset($_ENV['DB_PORT']) ? $_ENV['DB_PORT'] : '5432';
            
            if (self::$instance == null) {
                self::$instance = new Database($host, $dbname, $username, $password, $port);
            }
            return self::$instance;
        }

        // Method to execute a select statement and fetch a single row

        public function select(string $sql, array|null $data = null) {

            // Execute Statment

            try {
                $stmt = $this -> conn -> prepare($sql);
                $stmt -> execute($data);

                return $stmt -> fetch();
            } catch (PDOException $e) {
                Security::logError(__CLASS__ . " -> Error in the SQL: " . $e);
                return [];
            }
        }

        // Method to execute a select statement and fetch all rows

        public function selectAll(string $sql, array|null $data = null) {

            // Execute Statment

            try {
                $stmt = $this -> conn -> prepare($sql);
                $stmt -> execute($data);

                return $stmt -> fetchAll();
            } catch (PDOException $e) {
                // $this -> error = "Error in the SQL -> " . $e;
                Security::logError(__CLASS__ . " -> Error in the SQL: " . $e);
                return [];
            }
        }

        // Method to execute an insert statement

        public function insert(string $table, array $columns, array $params) {

            if (count($columns) == 0 || count($columns) != count($params)) {
                $this -> error = "The number of columns does not match the number of params";
                return false;
            }

            // repeat the placeholder, to match the number of provided columns

            $placeholders = '';            
            for($i = 0; $i < count($columns); $i++) {
                $placeholders .= '?,';
            }
            $placeholders = trim($placeholders, ',');


            // Join columns into a string

            $columns_string = implode(', ', $columns);

            // Combine all parts to form an insert statement

            $sql = "INSERT INTO $table ($columns_string) VALUES ($placeholders)";

            $stmt = $this -> conn -> prepare($sql);

            try {
                if ($stmt -> execute($params)) {
                    return $this -> conn -> lastInsertId();
                }
                return false;
            } catch (Exception $e) {
                Security::logError(__CLASS__ . " -> Error in the SQL: " . $e);
                return false;
            }
        }

        // Method to execute an update statement

        public function update(string $table, array $columns, string $condition, array $params) {

            $placeholders_count = substr_count($condition, '?');

            if (count($columns) == 0 || count($columns) + $placeholders_count != count($params)) {
                return false;
            }

            // combine columns with placeholders

            $columns_string = ''; 

            foreach($columns as $col) {
                $columns_string .= $col . ' = ?,';
            }

            $columns_string = rtrim($columns_string, ',');

            // Combine all parts to form an insert statement

            $sql = "UPDATE $table SET $columns_string WHERE $condition";

            $stmt = $this -> conn -> prepare($sql);

            try {
                return $stmt -> execute($params);
            } catch (Exception $e) {
                Security::logError(__CLASS__ . " -> Error in the SQL: " . $e);
                return false;
            }

        }

        // Method to execute a delete statement 

        public function delete(string $table, string $condition, array|null $params = null) {

            $sql = "DELETE FROM $table WHERE $condition";

            // Execute Statment

            try {
                $stmt = $this -> conn -> prepare($sql);
                $stmt -> execute($params);

                if ($stmt -> rowCount() > 0) {
                    return true;
                }

                return false;
            } catch (PDOException) {
                return false;
            }
        }

        // Method to get error

        public function getError() {
            return $this -> error;
        }
    }