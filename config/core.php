<?php
    
    // страница, указанная в параметре URL, страница по умолчанию - 1
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;

    // ограничение количества записей на странице
    $records_per_page = 5;

    // подсчитываем лимит запроса
    $from_record_num = ($records_per_page * $page) - $records_per_page;

?>