<?php
 
    include_once "objects/database.php";
    include_once "objects/student.php";

    $database = new Database();

    $db = $database->getConnection();

    $student = new Student($db);

    $page_title = "Регистрация студента";

    require_once "layout_header.php";

?>

<div class="right-button-margin">
    <a href="index.php" class="btn btn-default pull-right">Просмотр всех студентов</a>
</div>

<?php

    // если форма была отправлена
    if ($_POST) {

        $student->last_name = $_POST["last_name"];
        $student->name = $_POST["name"];
        $student->patronymic = $_POST["patronymic"];
        $student->date_of_birth = $_POST["date_of_birth"];
        $student->phone_number = $_POST["phone_number"];
        $student->score = $_POST["score"];
        $student->passport_number = $_POST["passport_number"];

        if ($student->create()) {
            echo '<div class="alert alert-success">Студент был успешно зарегистрирован.</div>';
        } else {
            echo '<div class="alert alert-danger">Невозможно зарегистрировать студента.</div>';
        }
    }

?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="last_name-box">
                <input type="text" name="last_name" class="input last_name" required="">
                <label>Фамилия</label>
            </div>
            <div class="name-box">
                <input type="text" name="name" class="input name" required="">
                <label>Имя</label>
            </div>
            <div>
                <input type="text" name="patronymic" class="input patronymic" required="">
                <label>Отчество</label>
            </div>
            <div>
                <input type="date" name="date_of_birth" class="input date" required>
                <label class="label-date">Дата рождения</label>
            </div>
            <div>
                <input type="text" name="phone_number" class="input
                        phoneNumber" required="" maxlength="13">
                <label>Номер телефона</label>
            </div>
            <div>
                <input type="number" name="score" class="input
                        score" required="" min="0" max="100">
                <label>Средний балл</label>
            </div>
            <div>
                <input type="text" name="passport_number" class="input passport" required="">
                <label>Номер паспорта</label>
            </div>
            <input type="submit" name="" value="Зарегистрировать" class="button">
        </form>

<?php 

    require_once "layout_footer.php";

?>