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
                        last_name=:last_name, name=:name, patronymic=:patronymic, date_of_birth=:date_of_birth, 
                        phone_number=:phone_number, score=:score, passport_number=:passport_number, 
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
    }

?>