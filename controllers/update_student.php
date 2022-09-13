<?php
    // получаем ID редактируемого студента
    $id = isset($_GET["id"]) ? $_GET["id"] : die("ERROR: отсутствует ID.");

    // подключаем файлы для работы с базой данных и файлы с объектами
    include_once "../objects/database.php";
    include_once "../objects/student.php";

    $database = new Database();
    $db = $database->getConnection();

    $student = new Student($db);

    $student->id = $id;

    $student->readOne();

    $page_title = "Обновление информации о студенте";

    include_once "../views/layout_header.php";
?>

<div class="right-button-margin">
    <a href="../index.php" class="btn btn-default pull-right">Просмотр таблицы студентов</a>
</div>

<?php
    // если форма была отправлена (submit)
    if ($_POST) {
        
        $student->last_name = $_POST["last_name"];
        $student->name = $_POST["name"];
        $student->patronymic = $_POST["patronymic"];
        $student->date_of_birth = $_POST["date_of_birth"];
        $student->phone_number = $_POST["phone_number"];
        $student->score = $_POST["score"];
        $student->passport_number = $_POST["passport_number"];

        if ($student->update()) {
            echo '<div class="alert alert-success alert-dismissable">';
                echo "Информация о студенте была обновлена.";
            echo "</div>";
        }
        else {
            echo '<div class="alert alert-danger alert-dismissable">';
                echo "Невозможно обновить информацию.";
            echo "</div>";
        }
    }
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class="table table-hover table-responsive table-bordered">

        <tr>
            <td>Фамилия</td>
            <td><input type="text" name="last_name" value="<?php echo $student->last_name; ?>" class="form-control" /></td>
        </tr>

        <tr>
            <td>Имя</td>
            <td><input type="text" name="name" value="<?php echo $student->name; ?>" class="form-control" /></td>
        </tr>

        <tr>
            <td>Отчество</td>
            <td><input type="text" name="patronymic" value="<?php echo $student->patronymic; ?>" class="form-control" /></td>
        </tr>

        <tr>
            <td>Дата рождения</td>
            <td><input type="date" name="date_of_birth" value="<?php echo $student->date_of_birth; ?>" class="form-control" /></td>
        </tr>

        <tr>
            <td>Номер телефона</td>
            <td><input type="tel" name="phone_number" value="<?php echo $student->phone_number; ?>" class="form-control" /></td>
        </tr>

        <tr>
            <td>Средний балл</td>
            <td><input type="number" name="score" value="<?php echo $student->score; ?>" class="form-control" /></td>
        </tr>

        <tr>
            <td>Номер паспорта</td>
            <td><input type="text" name="passport_number" value="<?php echo $student->passport_number; ?>" class="form-control" /></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Обновить</button>
            </td>
        </tr>

    </table>
</form>

<?php 

    require_once "../views/layout_footer.php";

?>