<?php
    /**
     * Thêm giỏ hàng vào giỏ hàng
     * @param unknown $ProductID    ID sản phẩm thêm
     * @param unknown $Quantity     Số lượng
     */
    function addItem($ProductID, $Quantity){
        if ($Quantity < 1){
            return;
        }
        
        //Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng.
        if (isset($_SESSION['cart'][$ProductID])){
            $Quantity += $_SESSION['cart'][$ProductID]['Quantity'];
            updateItem($ProductID, (int)$Quantity);
            return;
        }
        
        //Thêm sản phẩm
        $product    = ProductDB::getProductsByKey(array('ProductID' => $ProductID));
        $total      = (int)$Quantity * $product[0]['Price'];

        $item       = array(
                        'Image' => $product[0]['LinkImage'],
                        'Name'  => $product[0]['ProductName'],
                        'Price' => $product[0]['Price'],
                        'Quantity'   => (int)$Quantity,
                        'Total' => $total
                      );

        $_SESSION['cart'][$ProductID]   = $item;
    }    
    
    /**
     * Cập nhật sản phẩm trong giỏ hàng
     * @param unknown $ProductID    ID sản phẩm
     * @param unknown $Quantity     Số lượng
     */
    function updateItem($ProductID, $Quantity){
        if (isset($_SESSION['cart'][$ProductID])){
            if ($Quantity <= 0){
                unset($_SESSION['cart'][$ProductID]);
            } else {
                $_SESSION['cart'][$ProductID]['Quantity']   = $Quantity;
                $_SESSION['cart'][$ProductID]['Total']      = $_SESSION['cart'][$ProductID]['Price'] * $_SESSION['cart'][$ProductID]['Quantity']; 
            }
        }
    }
    
    //Tính tổng giá trị của giỏ hàng.
    function getSubTotal(){
        $subTotal   = 0;
        
        foreach ($_SESSION['cart'] as $item){
            $subTotal   += $item['Total'];
        }
        
        return $subTotal;
    }
?>