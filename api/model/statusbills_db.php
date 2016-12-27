<?php
    class StatusBillsDB{ 
        /**
         * Lấy thông tin nhóm sản phẩm từ KeyGet.
         * @param unknown $KeyGet   Mảng các (Cột=>Giá trị) dùng trong mệnh đề WHERE
         * @param string $OrderBy   Trường được sắp xếp
         * @return Ambigous <boolean, multitype:>
         */
        public static function getStatusBillsByKey($KeyGet = array('Hide' => '0', 'Active' => '1'), $OrderBy = 'StatusID') {
            $db = Database::getDB();
        
            if (!isset($KeyGet['Hide']) && !isset($KeyGet['Active'])){
                $KeyGet = array_merge($KeyGet, array('Hide' => '0', 'Active' => '1'));
            }
        
            $WhereCondition = '';
             
            foreach ($KeyGet as $Colunm => $Value){
                $WhereCondition .= ' AND `statusbills`.`' . $Colunm . '`=\'' . $Value . '\'';
            }
        
            $WhereCondition = substr($WhereCondition, 5);   //Loại bỏ ' AND ' đầu tiên.
        
            $sql    = 'SELECT  `StatusID`, `statusbills`.`Name` as \'StatusName\'
                        FROM `statusbills` ';
        
            Database::setQuery($sql);
            $stmt   = Database::execute();
        
            return Database::loadAllRows($stmt);
        }
    }
?>