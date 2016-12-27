<?php
    class SlideShowDB{
        public function getSlideShowsByKey($KeyGet = array('Hide' => '0', 'Active' => '1'), $OrderBy = 'SlideShowID'){
            $db = Database::getDB();
            
            //WHERE
            $Where = '';
            if (!isset($KeyGet['Hide']) && !isset($KeyGet['Active'])){
                $KeyGet = array_merge($KeyGet, array('Hide' => '0', 'Active' => '1'));
            }            
            foreach ($KeyGet as $Colunm => $Value){
                $Where .= ' AND `slideshow`.`' . $Colunm . '`=\'' . $Value . '\'';
            }
            $Where = substr($Where, 5);   //Loại bỏ ' AND ' đầu tiên.
            
            $sql = 'SELECT
                      `SlideShowID`,
                      `Title`,
                      `Description`,
                      `LinkImage`,
                      `Link`,
                      `Priority`
                    FROM
                      `slideshow`
                    WHERE
                      '. $Where;
            
            Database::setQuery($sql);
            $stmt   = Database::execute();
            
            return Database::loadAllRows($stmt);
        }

        public function getSlideShowHidden($KeyGet = array(), $OrderBy = 'SlideShowID'){
            return self::getSlideShowsByKey(array_merge($KeyGet, array('Hide' => '1')), $OrderBy);
        }
       
        public function getSlideShowDeleted($KeyGet = array(), $OrderBy = 'SlideShowID'){
            return self::getSlideShowsByKey(array_merge($KeyGet, array('Active' => '0')), $OrderBy);
        }
        
        public function addSlideShow($SlideShow){
            @$UserID = $_SESSION['User']['UserID'];
            
            $db = Database::getDB();
            
            $sql    = "SELECT `UserID` FROM `users` WHERE `UserID`='" . $UserID . "' AND `GroupID`>=4";
            
            Database::setQuery($sql);
            $stmt   = Database::execute();
            
            if (Database::loadRow($stmt) == false){
                echo $err   = "ID người dùng không hợp lệ";
                return false;
            } else {
                $SlideShowID  = 'S' . randomString(str_repeat(implode('', range('0', '9')), 4), 7);
                $sql    = 'INSERT INTO
                              `slideshow`(
                                `SlideShowID`,
                                `Title`,
                                `Description`,
                                `LinkImage`,
                                `Link`,
                                `Priority`,
                                `Hide`,
                                `Active`
                              )
                            VALUES(
                                \'' . $SlideShowID . '\',
                                \'' . $SlideShow['Title'] . '\',
                                \'' . $SlideShow['Description'] . '\',
                                \'' . $SlideShow['LinkImage'] . '\',
                                \'' . $SlideShow['Link'] . '\',
                                \'' . $SlideShow['Priority'] . '\',
                                \'' . $SlideShow['Hide'] . '\',
                                \'' . $SlideShow['Active'] . '\'
                            )';
                
                Database::setQuery($sql);
                $stmt   = Database::execute();
                return true;
            }
        }
        
        public function updateSlideShow($SlideShowID, $data){
            @$UserID = $_SESSION['User']['UserID'];
            
            $db = Database::getDB();
            
            $sql    = "SELECT `UserID` FROM `users` WHERE `UserID`='" . $UserID . "' AND `Active` = '1' AND `GroupID` >= '4'";
            
            Database::setQuery($sql);
            $stmt   = Database::execute();
            
            if (Database::loadRow($stmt) == false){
                echo $err   = "ID người dùng không hợp lệ";
                return false;
            } else {
                $colSet  = '';
                foreach ($data as $Colunm => $Value){
                        $colSet .= '`' . $Colunm . '` = \'' . $Value . '\', ';
                }
                $colSet = substr($colSet, 0, strlen($colSet) - 3);
                
                $sql        = 'UPDATE
                                  `slideshow`
                                SET
                                  ' . $colSet . '
                                WHERE
                                  `SlideShowID` = \''. $SlideShowID . '\'';
            
                Database::setQuery($sql);
                $stmt   = Database::execute();
                return true;
            }
        }

        public function deleteSlideShow($SlideShowID){
            return ProductDB::updateSlideShow($SlideShowID, array('Active' => '0'));
        }
        
        public function activeSlideShow($SlideShowID){
            return ProductDB::updateSlideShow($SlideShowID, array('Active' => '1'));
        }
        
        public function hideSlideShow($SlideShowID){
            return ProductDB::updateSlideShow($SlideShowID, array('Hide' => '1'));
        }

        public function showSlideShow($SlideShowID){
            return ProductDB::updateSlideShow($SlideShowID, array('Hide' => '0'));
        }
    }
?>