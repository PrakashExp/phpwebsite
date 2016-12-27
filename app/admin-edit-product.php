<?php 
    session_start();
    require_once '../api/model/database.php';
    require_once '../api/model/functions.php';
    require_once '../api/model/product_db.php';
    require_once '../api/model/category_db.php';
    
    $db = Database::getDB();
    
    $CategoryList = CategoryDB::getCategoriesByKey(array(), 'CategoryID');
    
    $configs	= parse_ini_file('../api/model/uploadImageConfig.ini');
    
    $ProductID  = $_GET['ProductID'];
    if (checkEmpty($ProductID)){
        header("location: ./admin-dashboard.php");
    }
    
    $currentProductInfo = ProductDB::getProductsByKey(array('ProductID'=>$ProductID));
    
    if ($currentProductInfo == null){
        header("location: ./admin-dashboard.php");
    } else {
        $currentProductInfo = @$currentProductInfo[0];
    }

    if (isset($_POST['update'])) {
        $ProductID      = $currentProductInfo['ProductID'];
        $ProductName    = $_POST['productName'];
        $CategoryID     = $_POST['category'];
        $Color          = $_POST['color'];
        $Unit           = $_POST['unit'];
        $Quantity       = $_POST['quantity'];
        $Price          = $_POST['price'];
        $Keyword        = $_POST['keyword'];
        $Description    = $_POST['description'];
        $Hide           = isset($_POST['hide']) ? 1 : 0;
        $Active         = isset($_POST['active']) ? 1 : 0;
        $Home           = isset($_POST['home']) ? 1 : 0;
        $LinkImage  = $currentProductInfo['LinkImage'];

        $db->beginTransaction();
        
        if ($_FILES != null){
            $fileUpload = $_FILES["picture"];

            if (($fileUpload["error"]) == 0 && (checkSize($fileUpload['size'], $configs['min_size'], $configs['max_size'])) && (checkExtension($fileUpload['name'], explode('|', $configs['extension'])))){
                $Image = "Images/Flowers/" . strtolower($_FILES["picture"]["name"][0]) . '/' . pathinfo($_FILES["picture"]["name"], PATHINFO_FILENAME) . '_' . randomString(null, 5) . '.' . pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);
                $LinkImage  = (move_uploaded_file($fileUpload["tmp_name"], '../' . $Image) == true) ? $Image : null;
            }
        }

        $data   = array('Name'=>$ProductName, 'CategoryID'=>$CategoryID, 'Unit'=>$Unit, 'Price'=>$Price, 'Description'=>$Description, 'Color'=>$Color, 'Quantity'=>$Quantity, 'LinkImage'=>$LinkImage, 'Hide'=>$Hide, 'Active'=>$Active, 'Keyword'=>$Keyword, 'Home'=>$Home);        
        ProductDB::updateProduct($ProductID, $data);
        
        $db->commit();
    } else {
        $ProductID      = $currentProductInfo['ProductID'];
        $ProductName    = $currentProductInfo['ProductName'];
        $CategoryID     = $currentProductInfo['CategoryID'];
        $Color          = $currentProductInfo['Color'];
        $Unit           = $currentProductInfo['Unit'];
        $Quantity       = $currentProductInfo['Quantity'];
        $Price          = $currentProductInfo['Price'];
        $Keyword        = $currentProductInfo['Keyword'];
        $Description    = $currentProductInfo['Description'];
        $Hide           = $currentProductInfo['Hide'];
        $Active         = $currentProductInfo['Active'];
        $Home           = $currentProductInfo['Home'];
        $LinkImage      = $currentProductInfo['LinkImage'];
    }
    
    require_once './view/admin_edit_product_view.php';
?>