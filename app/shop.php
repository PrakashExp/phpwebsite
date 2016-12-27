<?php 
    session_start();
    
    require_once '../api/model/Pagination.php';
    require_once '../api/model/database.php';
    require_once '../api/model/product_db.php';
    require_once '../api/model/functions.php';
    require_once '../api/model/category_db.php';

	$numberItemsPerPage = 12;
	$currentPage        = (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) ? intval($_GET['page']) : 1;
	$pageRange          = 5;
	
	$db = Database::getDB();
	
	$CategoryName  = (isset($_GET['category'])) ? $_GET['category'] : '0';
	$CategoryID    = CategoryDB::getCategoryIdByName($CategoryName);
	
	//Lấy sản phẩm cho phân trang hiện tại.
	$KeyGet        = (($CategoryID != 0) ? array('CategoryID'=>$CategoryID) : array());
	$Products      = ProductDB::getProductsPagination($currentPage, $numberItemsPerPage, $KeyGet);

	$result   = ProductDB::getProductsByKey($KeyGet);
	$totalProducts      = count($result) - 1;
	
	$paginator  = new Pagination($totalProducts, $numberItemsPerPage, $currentPage, $pageRange);
	
	require_once './view/shop_view.php';
?>