<?php

    // страница, указанная в параметре URL, страница по умолчанию - 1
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;

    // ограничение количества записей на странице
    $records_per_page = 5;

    // подсчитываем лимит запроса
    $from_record_num = ($records_per_page * $page) - $records_per_page;

    include_once "objects/student.php";
    include_once "objects/database.php";

    $database = new Database();
    $db = $database->getConnection();

    $student = new Student($db);

    $stmt = $student->readAll($from_record_num, $records_per_page);
    $num = $stmt->rowCount();

    $page_title = "Вывод таблицы студентов";

    require_once "layout_header.php";

?>

<div class="right-button-margin">
    <a href="create_student.php" class="btn btn-default pull-right">Добавить студента</a>
</div>

<?php

    // вывод студентов, если они есть
    if ($num > 0) {

        echo '<table class="table table-hover table-responsive table-bordered">';
            echo "<tr>";
                echo "<th>Фамилия</th>";
                echo "<th>Имя</th>";
                echo "<th>Отчество</th>";
                echo "<th>Дата рождения</th>";
                echo "<th>Номер телефона</th>";
                echo "<th>Средний балл</th>";
                echo "<th>Номер паспорта</th>";
                echo "<th>Действия</th>";
            echo "</tr>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                extract($row);

                echo "<tr>";
                    echo "<td>{$last_name}</td>";
                    echo "<td>{$name}</td>";
                    echo "<td>{$patronymic}</td>";
                    echo "<td>{$date_of_birth}</td>";
                    echo "<td>{$phone_number}</td>";
                    echo "<td>{$score}</td>";
                    echo "<td>{$passport_number}</td>";    
                    echo "<td>";
                        // ссылки для редактирования и удаления
                        echo "<a href=\"update_student.php?id={$id}\" class=\"btn btn-info left-margin\">
                        <span class=\"glyphicon glyphicon-edit\"></span> Редактировать
                        </a>

                        <a delete-id=\"{$id}\" class=\"btn btn-danger delete-object\">
                        <span class=\"glyphicon glyphicon-remove\"></span> Удалить
                        </a>";
                    echo "</td>";

                echo "</tr>";

            }

        echo "</table>";

        // страница, на которой используется пагинация
        $page_url = "index.php?";

        // подсчёт всех студентов в базе данных, чтобы подсчитать общее количество страниц
        $total_rows = $student->countAll();

        include_once "paging.php";
    }

    else {
        echo '<div class="alert alert-info">Студенты не найдены.</div>';
    }

?>

<?php 

    require_once "layout_footer.php";

?>