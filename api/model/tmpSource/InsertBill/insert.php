<?php
    set_time_limit(3000);
    
    require_once './database.php';
    function shuffleString($str, $lenght = 10){
        $shuffleCharacters = str_shuffle($str);
        return substr($shuffleCharacters, 0, $lenght);
    }
    
    function stripUnicode($str){
        $arrUnicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ',
            'D'=>'Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
        );
    
        foreach($arrUnicode as $unUnicode => $Unicode) {
            $arrUnicodeCharsets     = explode("|", $Unicode);
            $str                    = str_replace($arrUnicodeCharsets, $unUnicode, $str);
        }
    
        return $str;
    }
    
    $Status67arr = array(
        7,
        6,
        6,
        6,
        6,
        6,
        6,
        6,
        6,
        6,
    );
    $nStatus67  = count($Status67arr) - 1;
    
    $db = Database::getDB();
    
    $sqlCustomerID  = 'SELECT `UserID` FROM `users` WHERE `UserID` REGEXP \'^C\'';
    $sqlEmployeeID  = 'SELECT `UserID` FROM `users` WHERE `UserID` REGEXP \'^E\'';
    $sqlProduct     = 'SELECT `ProductID`, `Price` FROM `products`';
    
    Database::setQuery($sqlCustomerID);
    $stmt           = Database::execute();
    $CustomerIDs    = Database::loadAllRows($stmt);
    $nCustomerIDs   = count($CustomerIDs) - 1;
    
    Database::setQuery($sqlEmployeeID);
    $stmt           = Database::execute();
    $EmployeeIDs    = Database::loadAllRows($stmt);
    $nEmployeeIDs   = count($EmployeeIDs) - 1;
    
    Database::setQuery($sqlProduct);
    $stmt           = Database::execute();
    $ProductIDPrices = Database::loadAllRows($stmt);
    $nProductIDPrices = count($ProductIDPrices) - 1;

    for($i = 0; $i < 1000; $i++):
        $Time1 = str_pad(rand(0, 23), 2, '0', STR_PAD_LEFT) . ':' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT) . ':' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT) . ' ' . rand(1, 29) . '/' . rand(10, 12) . '/' . 2015;
        $Time2 = str_pad(rand(0, 23), 2, '0', STR_PAD_LEFT) . ':' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT) . ':' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT) . ' ' . rand(1, 29) . '/' . rand(1, 9) . '/' . 2016;
        $Time   = (rand(0, 1) == 0) ? $Time1 : $Time2;
        $dateArr = date_parse_from_format("H:i:s d/m/Y", $Time);
        $Time = date("Y-m-d H:i:s", mktime($dateArr["hour"], $dateArr["minute"], $dateArr["second"], $dateArr["month"], $dateArr["day"], $dateArr["year"]));
    
        
        $now        = date('Y-m-d H:i:s', strtotime('now'));
        $dateArr    = date_parse_from_format("Y-m-d H:i:s", $now);
        $Time3456 = date("Y-m-d H:i:s", mktime(0, 0, 0, $dateArr["month"], $dateArr["day"] - 21, $dateArr["year"]));
        $Time12 = date("Y-m-d H:i:s", mktime(0, 0, 0, $dateArr["month"], $dateArr["day"] - 7, $dateArr["year"]));
    
        $BillID     = 'B' . shuffleString(str_repeat(implode(range('0', '9'), ''), 4), 7);

        $BillValue  = 0;
        
        do{
            $CustomerID = $CustomerIDs[rand(0, $nCustomerIDs)]['UserID'];
            
            $sqlDateCustomer   = 'SELECT
                                      `Time`
                                    FROM
                                      `users`
                                    WHERE
                                      `UserID`=\'' . $CustomerID . '\'';
            Database::setQuery($sqlDateCustomer);
            $stmt = Database::execute();
            $DateCustomer   = Database::loadRow($stmt);
            $DateCustomer   = $DateCustomer['Time'];
        } while ($DateCustomer >= $Time);
        
        do{
            $EmployeeID = $EmployeeIDs[rand(0, $nEmployeeIDs)]['UserID'];
            
            $sqlDateEmployee   = 'SELECT
                                      `Time`
                                    FROM
                                      `users`
                                    WHERE
                                      `UserID`=\'' . $EmployeeID . '\'';
            Database::setQuery($sqlDateEmployee);
            $stmt = Database::execute();
            $DateEmployee   = Database::loadRow($stmt);
            $DateEmployee   = $DateEmployee['Time'];
        } while ($DateEmployee >= $Time);
        
        if($Time >= $Time3456){
            if ($Time >= $Time12){
                $Status = rand(1, 2);
            } else {
                $Status = rand(3, 6);
            }
            if ($Status == 1) {
                $EmployeeID = 'NewOrder';
            }
        } else {
            $Status     = $Status67arr[rand(0, $nStatus67)];
        }
        
        $db->beginTransaction();
        
        $sqlBills   = 'INSERT INTO `bills`(
                            `BillID`,
                            `Time`,
                            `CustomerID`,
                            `EmployeeID`,
                            `BillValue`,
                            `Status`
                        )
                        VALUES(
                            \'' . $BillID . '\',
                            \'' . $Time . '\',
                            \'' . $CustomerID . '\',
                            \'' . $EmployeeID . '\',
                            \'' . $BillValue . '\',
                            \'' . $Status . '\'
                        )';
        Database::setQuery($sqlBills);
        Database::execute();
        
        $nDetailOfBill  = rand(1, 5);
        
        
        for ($j = 0; $j < $nDetailOfBill; $j++):
            $keyProduct = rand(0, $nProductIDPrices);
            $ProductID  = $ProductIDPrices[$keyProduct]['ProductID'];
            $Price      = $ProductIDPrices[$keyProduct]['Price'];
            $Quantity   = rand(1, 4);
            $BillValue  += $Price * $Quantity;
            $sqlDetailOfBill     = 'INSERT INTO `detailofbill`(
                                        `BillID`,
                                        `ProductID`,
                                        `Quantity`)
                                    VALUES(
                                        \'' . $BillID . '\',
                                        \'' . $ProductID . '\',
                                        \'' . $Quantity . '\'
                                    );';
            Database::setQuery($sqlDetailOfBill);
            Database::execute();
        endfor;

        $sqlUpdateBillValue = 'UPDATE
                                  `bills`
                                SET
                                  `BillValue` = \'' . $BillValue . '\'
                                WHERE
                                  `BillID`=\'' . $BillID . '\'';
        Database::setQuery($sqlUpdateBillValue);
        Database::execute();
        
        if ($Status == 6){
            $sqlGetCustomerRevenue = 'SELECT
                                          `Revenue`
                                        FROM
                                          `users`
                                        WHERE
                                          `UserID`=\'' . $CustomerID . '\'';
            Database::setQuery($sqlGetCustomerRevenue);
            $stmt = Database::execute();
            $Revenue    = Database::loadRow($stmt);
            $Revenue    = $Revenue['Revenue'] + $BillValue;
            
            if ($Revenue < 10000000){
                    $GroupID    = 0;
            } else if ($Revenue < 50000000){
                    $GroupID    = 1;
            } else if ($Revenue < 200000000){
                    $GroupID    = 2;
            } else {
                    $GroupID    = 3;
            }
            
            $sqlUpdateCustomerRevenue = 'UPDATE
                                          `users`
                                        SET
                                          `GroupID` = \'' . $GroupID . '\',
                                          `Revenue` = `Revenue`+' . $BillValue . '
                                        WHERE
                                          `UserID`=\'' . $CustomerID . '\'';
            Database::setQuery($sqlUpdateCustomerRevenue);
            Database::execute();
            
            $sqlUpdateEmployeeRevenue = 'UPDATE
                                          `users`
                                        SET
                                          `Revenue` = `Revenue`+' . $BillValue . '
                                        WHERE
                                          `UserID`=\'' . $EmployeeID . '\'';
            Database::setQuery($sqlUpdateEmployeeRevenue);
            Database::execute();
        }
        
        $db->commit();
    endfor;
    
    echo 'Hoan thanh';
?> */