<?php
    // содержит переменные пагинации
    include_once "../config/core.php";

    include_once "../objects/student.php";
    include_once "../objects/database.php";

    $database = new Database();
    $db = $database->getConnection();

    $student = new Student($db);

    // получение поискового запроса
    $search_term = isset($_GET["s"]) ? $_GET["s"] : "";

    $page_title = "Вы искали \"{$search_term}\"";
    
    require_once "../views/layout_header.php";

    $stmt = $student->search($search_term, $from_record_num, $records_per_page);

    $page_url = "search.php?s={$search_term}&";

    // подсчитываем общее количество строк - используется для разбивки на страницы
    $total_rows = $student->countAll_BySearch($search_term);

    include_once "../views/read_template.php";
    require_once "../views/layout_footer.php";
?>