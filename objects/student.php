<?php

    class Student {

        // подключение к базе данных и имя таблицы
        private $conn;
        private $table_name = "students";

        // свойства объекта
        public $id;
        public $last_name;
        public $name;
        public $patronymic;
        public $date_of_birth;
        public $phone_number;
        public $score;
        public $passport_number;
        public $timestamp;

        public function __construct($db) {
            $this->conn = $db;
        }

        // метод регистрации студента
        function create() {

            $query = "INSERT INTO
                        " . $this->table_name . "
                    SET
                        last_name=:last_name, 
                        name=:name, 
                        patronymic=:patronymic, 
                        date_of_birth=:date_of_birth, 
                        phone_number=:phone_number, 
                        score=:score, 
                        passport_number=:passport_number, 
                        created=:created";

            $stmt = $this->conn->prepare($query);

            // опубликованные значения
            $this->last_name = htmlspecialchars(strip_tags($this->last_name));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->patronymic = htmlspecialchars(strip_tags($this->patronymic));
            $this->date_of_birth = htmlspecialchars(strip_tags($this->date_of_birth));
            $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
            $this->score = htmlspecialchars(strip_tags($this->score));
            $this->passport_number = htmlspecialchars(strip_tags($this->passport_number));

            // получаем время создания записи
            $this->timestamp = date("Y-m-d H:i:s");

            // привязываем значения
            $stmt->bindParam(":last_name", $this->last_name);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":patronymic", $this->patronymic);
            $stmt->bindParam(":date_of_birth", $this->date_of_birth);
            $stmt->bindParam(":phone_number", $this->phone_number);
            $stmt->bindParam(":score", $this->score);
            $stmt->bindParam(":passport_number", $this->passport_number);
            $stmt->bindParam(":created", $this->timestamp);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }

        }

        //метод чтения всех студентов из базы данных
        function readAll($from_record_num, $records_per_page) {

            $query = "SELECT
                        id, last_name, name, patronymic, date_of_birth, phone_number, score, passport_number
                    FROM
                        " . $this->table_name . "
                    ORDER BY
                        score DESC
                    LIMIT
                        {$from_record_num}, {$records_per_page}";
        
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
        
            return $stmt;
        }

        // метод используется для пагинации
        public function countAll() {

            $query = "SELECT id FROM " . $this->table_name . "";

            $stmt = $this->conn->prepare( $query );
            $stmt->execute();

            $num = $stmt->rowCount();

            return $num;
        }

        function readOne() {

            $query = "SELECT
                        id, last_name, name, patronymic, date_of_birth, phone_number, score, passport_number
                    FROM
                        " . $this->table_name . "
                    WHERE
                        id = ?
                    LIMIT
                        0,1";
        
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
        
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            $this->last_name = $row["last_name"];
            $this->name = $row["name"];
            $this->patronymic = $row["patronymic"];
            $this->date_of_birth = $row["date_of_birth"];
            $this->phone_number = $row["phone_number"];
            $this->score = $row["score"];
            $this->passport_number = $row["passport_number"];
        }

        function update() {

            $query = "UPDATE
                        " . $this->table_name . "
                    SET
                        last_name=:last_name, 
                        name=:name, 
                        patronymic=:patronymic, 
                        date_of_birth=:date_of_birth, 
                        phone_number=:phone_number, 
                        score=:score, 
                        passport_number=:passport_number
                    WHERE
                        id = :id";
        
            $stmt = $this->conn->prepare($query);
        
            // очистка
            $this->last_name = htmlspecialchars(strip_tags($this->last_name));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->patronymic = htmlspecialchars(strip_tags($this->patronymic));
            $this->date_of_birth = htmlspecialchars(strip_tags($this->date_of_birth));
            $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
            $this->score = htmlspecialchars(strip_tags($this->score));
            $this->passport_number = htmlspecialchars(strip_tags($this->passport_number));
            $this->id = htmlspecialchars(strip_tags($this->id));
        
            // привязка значений
            $stmt->bindParam(":last_name", $this->last_name);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":patronymic", $this->patronymic);
            $stmt->bindParam(":date_of_birth", $this->date_of_birth);
            $stmt->bindParam(":phone_number", $this->phone_number);
            $stmt->bindParam(":score", $this->score);
            $stmt->bindParam(":passport_number", $this->passport_number);
            $stmt->bindParam(":id", $this->id);
        
            if ($stmt->execute()) {
                return true;
            }        
            return false;
        }
       
        function delete() {

            $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);

            if ($result = $stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }

?>