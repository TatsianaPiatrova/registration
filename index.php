<?php

    include_once "config/core.php";
    include_once "objects/student.php";
    include_once "objects/database.php";

    $database = new Database();
    $db = $database->getConnection();

    $student = new Student($db);

    $page_title = "Вывод таблицы студентов";
    
    require_once "views/layout_header.php";

    $stmt = $student->readAll($from_record_num, $records_per_page);
    
    // укажем страницу, на которой используется пагинация
    $page_url = "index.php?";

    $total_rows = $student->countAll();

    include_once "views/read_template.php";

    require_once "views/layout_footer.php";

?>