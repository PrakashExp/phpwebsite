<?php
include 'config.php';   // save password 
    class Database{
        private static $username    = 'root';
        private static $dsn         = 'mysql:host=localhost;dbname=dbflowershop';
        private static $db          = NULL;
        private static $_sql        = '';
        private static $_flag    = NULL;
        
        private function __construct(){}
        
        /**
         * Oct 02, 2016 - 10:36 AM - YongKoo
         * Trả về một tham chiếu đến đối tượng PDO cho cơ sở dữ liệu dbflowershop. 
         */
        public static function getDB(){
            global $passwordDB;
            if (!isset(self::$db)){
                try {
                    self::$db   = new PDO(self::$dsn, self::$username, $passwordDB);
                    self::$db->query("SET NAMES 'utf8'");
                    self::$db->query("SET CHARACTER SET 'utf8'");
                } catch (PDOException $err) {
                    $err_message    = $err->getMessage();
                    echo "Error: " . $err_message;
                    //include_once 'database_error.php';  //Trang hiển thị lỗi.
                    exit();
                }        
            }
            
            return self::$db;
        }
        
        /** Oct 02, 2016 - 10:37 AM - YongKoo
         * Thiết lập câu truy vấn
         * @param unknown $sql  Câu truy vấn
         */
        public static function setQuery($sql){
            self::$_sql = $sql;
        }
        
        /** Oct 02, 2016 - 10:38 AM - YongKoo
          * Thực thi câu truy vấn
          * @param unknown $options  Mảng các tham số thay thế (nếu có)
          */
        public static function execute($options    = array()){
            self::$_flag = NULL;
            
            $stmt  = self::$db->prepare(self::$_sql);

            if ($options) {
                $n  = count($options);
                for($i = 0; $i < $n; ++$i){
                    $stmt->bindParam($i + 1, $options[$i]);
                }
            }
            
            self::$_flag   = $stmt->execute();
            
            return $stmt;
        }

        /** Oct 02, 2016 - 10:46 AM - YongKoo
         * Lấy các dòng trong CSDL và gán vào cho mảng các đối tượng
         * @param PDOStatement $stmt PDOStatement từ hàm thực thi excute
         * @return boolean  PDO tất cả dòng hoặc false nếu không thành công.
         */
        public static function loadAllRows(PDOStatement $stmt){
            if (!self::$_flag){
                    return false;
            }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        /** Oct 02, 2016 - 10:46 AM - YongKoo
         * Lấy một dòng thỏa điều kiện trong CSDL và gán cho đối tượng
         * @param PDOStatement $stmt PDOStatement từ hàm thực thi excute
         * @return boolean  PDO 1 dòng thoả điều kiện hoặc false nếu không thành công.
         */
        public static function loadRow(PDOStatement $stmt){
            if (!self::$_flag){
                    return false;
            }

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /** Oct 02, 2016 - 10:47 AM - YongKoo
         * Tìm ID cuối cùng trong bảng
         */
        public static function getLastID(){
            return self::$db->lastInsertId();
        }

        /** Oct 02, 2016 - 10:47 AM - YongKoo
         * Ngắt kết nối
         */
        public static function disconnect(){
            self::$db = NULL;
        }
    }
?>
