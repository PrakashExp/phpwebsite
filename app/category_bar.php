<?php
    require_once '../api/model/category_db.php';
    
    $CategoryList = CategoryDB::getCategoriesByKey(array(), 'CategoryID');
        
    require_once './view/category_bar_view.php';
?>