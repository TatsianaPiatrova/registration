<?php
    // форма поиска
    echo "<form role=\"search\" action=\"../controllers/search.php\">";
        echo "<div class=\"input-group col-md-3 pull-left margin-right-1em\">";
        if(isset($search_term)){
            $search_value = $search_term;
        }
        else $search_value = "";
            echo "<input type=\"text\" class=\"form-control\" placeholder=\"Введите строку для поиска...\" 
            name=\"s\" id=\"srch-term\" required {$search_value} />";
            echo "<div class=\"input-group-btn\">";
                echo "<button class=\"btn btn-primary\" type=\"submit\"><i class=\"glyphicon glyphicon-search\"></i></button>";
            echo "</div>";
        echo "</div>";
        echo "<a href=\"../index.php\" class=\"back\" id=\"back\"><span>Назад</span></a>";
    echo "</form>";

    // кнопка создания студента
    echo "<div class=\"right-button-margin\">";
        echo "<a href=\"/controllers/create_student.php\" class=\"btn btn-primary pull-right\">";
            echo "<span class=\"glyphicon glyphicon-plus\"></span> Создать товар";
        echo "</a>";
    echo "</div>";

    if ($total_rows > 0) {

        echo '<table class="table table-hover table-responsive table-bordered">';
        echo "<tr>";
            echo "<th>Фамилия</th>";
            echo '<th>Имя</th>';
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
                    echo "<a href=\"../controllers/update_student.php?id={$id}\" class=\"btn btn-info left-margin\">
                    <span class=\"glyphicon glyphicon-edit\"></span> Редактировать
                    </a>

                    <a delete-id=\"{$id}\" class=\"btn btn-danger delete-object\">
                    <span class=\"glyphicon glyphicon-remove\"></span> Удалить
                    </a>";
                echo "</td>";

            echo "</tr>";

            }

        echo "</table>";

    // пагинация
    include_once "paging.php";
    }
    else {
        echo '<div class="alert alert-danger">Студентов не найдено.</div>';
    }
?>