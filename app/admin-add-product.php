<?php 
    session_start();
    require_once '../api/model/database.php';
    require_once '../api/model/functions.php';
    require_once '../api/model/product_db.php';
    require_once '../api/model/category_db.php';
    
    $db = Database::getDB();
    
    $CategoryList = CategoryDB::getCategoriesByKey(array(), 'CategoryID');
    
    $configs	= parse_ini_file('../api/model/uploadImageConfig.ini');
    
    $Hide   = 0;
    $Active = 1;
    $Home   = 0;
        
    if (isset($_POST['add'])) {
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
        $LinkImage      = null;

        $db->beginTransaction();
        
        if ($_FILES != null){
            $fileUpload = $_FILES["picture"];
            
            if (($fileUpload["error"]) == 0 && (checkSize($fileUpload['size'], $configs['min_size'], $configs['max_size'])) && (checkExtension($fileUpload['name'], explode('|', $configs['extension'])))){
                $Image = "Images/Flowers/" . strtolower($_FILES["picture"]["name"][0]) . '/' . pathinfo($_FILES["picture"]["name"], PATHINFO_FILENAME) . '_' . randomString(null, 5) . '.' . pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);
                $LinkImage  = (move_uploaded_file($fileUpload["tmp_name"], '../' . $Image) == true) ? $Image : null;
            }
        }
        
        $product    = array('Name'=>$ProductName, 'CategoryID'=>$CategoryID, 'Unit'=>$Unit, 'Price'=>$Price, 'Description'=>$Description, 'Color'=>$Color, 'Quantity'=>$Quantity, 'LinkImage'=>$LinkImage, 'Hide'=>$Hide, 'Active'=>$Active, 'Keyword'=>$Keyword, 'Home'=>$Home);        
        ProductDB::addProduct($product);
        
        $db->commit();
    }
    
    require_once './view/admin_add_product_view.php';
?>