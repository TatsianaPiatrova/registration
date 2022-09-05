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

        $stmt = $student->readAll(0, $student->countAll());
        $flag = true;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            extract($row);
            if(!strcmp($student->passport_number,$passport_number)){
                $flag = false;
            }
            if(!strcmp($student->phone_number,$phone_number)){
                $flag = false;
            }
        }
        if ($flag){
            if ($student->create()) {
                echo '<div class="alert alert-success">Студент был успешно зарегистрирован.</div>';
            } else {
                echo '<div class="alert alert-danger">Невозможно зарегистрировать студента.</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Студент с такими данными уже зарегестрирован.</div>';
        }
    }

?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <table class="table table-hover table-responsive table-bordered">
                <div class="last_name-box">
                    <input type="text" name="last_name" class="input last_name" required="" pattern="[А-я]{2,}">
                    <label>Фамилия</label>
                </div>
                <div class="name-box">
                    <input type="text" name="name" class="input name" required="" pattern="[А-я]{2,}">
                    <label>Имя</label>
                </div>
                <div>
                    <input type="text" name="patronymic" class="input patronymic" required="" pattern="[А-я]{2,}">
                    <label>Отчество</label>
                </div>
                <div>
                    <input type="date" name="date_of_birth" class="input date" required>
                    <label class="label-date">Дата рождения</label>
                </div>
                <div>
                    <input type="text" name="phone_number" class="input
                            phoneNumber" required="" maxlength="13" pattern="+[0-9]{12}">
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
                <input type="submit" name="" value="Зарегистрировать" class="button submit">
            </table>
        </form>

<?php 

    require_once "layout_footer.php";

?>
