<?php

    class Database {

        private $host = "localhost";
        private $db_name = "university";
        private $username = "root";
        private $password = "10091997";
        public $conn;

        // получение соединения с базой данных
        public function getConnection() {
            $this->conn = null;

            try {
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            } catch(PDOException $exception) {
                echo "Ошибка соединения: " . $exception->getMessage();
            }

            return $this->conn;
        }
    }
    
?>