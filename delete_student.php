<?php
    
    if ($_POST) {

        include_once "objects/database.php";
        include_once "objects/student.php";

        $database = new Database();
        $db = $database->getConnection();

        $student = new Student($db);

        $student->id = $_POST["object_id"];

        if ($student->delete()) {
            echo "Студент был удалён.";
        } else {
            echo "Невозможно удалить студента.";
        }
    }

?>