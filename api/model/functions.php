<?php
    /*==================================== STRING ====================================*/
    /**
     * Tạo một chuỗi ngẫu nhiên (đích) từ một chuỗi
     * @param string $strSource     Chuỗi nguồn chứa tập hợp các ký tự được phép xuất hiện trong chuỗi đích (mặc định chuỗi gồm A-z, 0-9)
     * @param number $length        Độ dài chuỗi đích (mặc định 8 ký tự)
     * @return string               Chuỗi ngẫu nhiên
     */
	
    function randomString($strSource = null, $length = 8){
        if (checkEmpty($strSource)){
            $strSource  = implode((array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'))), '');
        }
        return substr(str_shuffle($strSource), 0, $length);
    }
    
    /**
     * Chuyển đổi chuỗi Unicode thành chuỗi không dấu
     * @param unknown $str          Chuỗi Unicode
     * @return boolean|mixed        Chuỗi không dấu
     */
    function stripUnicode($str){
        if(checkEmpty($str)){
            return false;
        }

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
                            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
                            '_'=>' '
                            );
        
        foreach($arrUnicode as $unUnicode => $Unicode) {
            $arrUnicodeCharsets     = explode("|", $Unicode);
            $str                    = str_replace($arrUnicodeCharsets, $unUnicode, $str);
        }
        
        return $str;
    }
    
    /**
     * Chuẩn hóa chuỗi
     * @param unknown $string       Chuẩn cần chuẩn hóa
     * @param string $type          Loại chuỗi (Danh từ riêng: Name)
     * @return void|string          Chuỗi sau khi chuẩn hóa
     */
    function reformatString($string, $type  = null){
        if (checkEmpty($string)){
            return;
        }
        
        $string = strtolower($string);                  // Chuyển chuỗi về dạng chữ thường.
        
        $string = trim($string);                        // Loại bỏ các khoảng trắng bên trái và bên phải chuỗi.
        
        //Thay thế các ký tự \t, \n bằng khoảng trắng
        $string = str_replace("\t", ' ', $string);
        $string = str_replace("\n", ' ', $string);
        
        // Loại bỏ các khoảng trắng thừa giữa các từ trong chuỗi.
        $arrWords   = explode(' ', $string);
        $result     = '';
        
        foreach ($arrWords as $key => $value) {
            if (trim($value) != null)
            {
                $result .= ' ' . $value;
            }
        }
        
        $result = trim($result);
        
        //Xử lý nếu là danh từ riêng.
        if($type == 'Name')
        {
            $result = ucwords($result);                 // Chuyển ký tự đầu của từng từ trong chuỗi thành chữ hoa.
        } else {
            $result = ucfirst($result);                 // Xử lý ký tự đầu tiên của chữ đầu tiên: luôn là chữ hoa.
        }
        
        return $result;
    }
    /*================================================================================*/
    
    /*===================================== ARRAY ====================================*/
    /**
     * Hàm so sánh bởi key
     * @param unknown $key  Trường so sánh
     * @param string $type  Kiểu sắp xếp: ASC - tăng dần || DESC - giảm dần
     * @return number       Hàm vô danh chứa giá trị -1, 0, 1 - tùy thuộc vào kiểu sắp xếp
     */
    function compareFuncByKey($key, $type   = 'ASC'){
        return function($left, $right) use ($key, $type){
            if ($left[$key] == $right[$key]){
                return 0;    
            }
            
            switch ($type){
                case 'ASC':
                    if ($left[$key] < $right[$key]){
                        return -1;   
                    } else {
                        return 1;
                    }                    
                    break;
                case 'DESC':
                    if ($left[$key] > $right[$key]){
                        return -1;
                    } else {
                        return 1;
                    }
                    break;
                default:
                    break;
            }         
        };
    }
    
    /**
     * Hàm sắp xếp theo hàm người dùng tự định nghĩa
     * @param unknown $arr      Mảng nguồn cần sắp xếp
     * @param unknown $key      Trường so sánh 
     * @param string $type      Kiểu sắp xếp: ASC - tăng dần || DESC - giảm dần
     * @return unknown          Mảng đích sau khi sắp xếp (khác mảng nguồn)
     */
    function _uSort($arr, $key, $type = 'ASC'){
        $tmpArr = $arr;
        
        $value_compare_func = compareFuncByKey($key, $type);
        
        usort($tmpArr, $value_compare_func);
        
        return $tmpArr;
    }
    
    /*================================================================================*/
    
    /*================================== CHECK INPUT =================================*/
    /**
     * Kiểm tra giá trị rỗng
     * @param unknown $value        Giá trị kiểm tra
     * @return boolean              True: giá trị rỗng hoặc không tồn tại || False: giá trị hợp lệ 
     */
    function checkEmpty($value){
        return (!isset($value) || trim($value) == '') ? true : false;
    }
      
    /**
     * Kiểm tra tính hợp lệ của chiều dài
     * @param unknown $value        Giá trị cần kiểm tra
     * @param unknown $minlength    Chiều dài tối thiểu
     * @param unknown $maxLength    Chiều dài tối đa
     * @return boolean              True: độ dài không hợp lệ || False: độ dài hợp lệ
     */
    function checkInvalidLength($value, $minlength, $maxLength){
        $length = strlen($value);
        return ($length < $minlength || $length > $maxLength) ? true : false;
    }
    /*================================================================================*/

    /*===================================== FILE =====================================*/
    /**
     * Kiểm tra kích thước
     * @param unknown $size
     * @param unknown $min
     * @param unknown $max
     * @return boolean
     */
    function checkSize($size, $min, $max){
        return ($size >= $min && $size <= $max) ? true : false;
    }
        
    /**
     * Kiểm tra định dạng file
     * @param unknown $fileName
     * @param unknown $arrExtension
     * @return boolean
     */
    function checkExtension($fileName, $arrExtension){
        return (in_array(pathinfo($fileName, PATHINFO_EXTENSION), $arrExtension) == true) ? true : false;
    }
    /*================================================================================*/
    
    /*===================================== OTHER ====================================*/
    /**
     * Chuyển đổi đơn vị (kích thước file)
     * @param unknown $size         Kích thước (Byte)
     * @param string $longUnit      True: hiển thị đầy đủ đơn vị || False: hiển thị ký hiệu đơn vị rút gọn (mặc định false)
     * @param number $totalDigit    Số ký số phần thập phân (mặc định 2 ký số)
     * @param string $ditance       Ký tự ngăn cách giữa kích thước và đơn vị (mặc định khoảng trắng)
     * @return string               Kích thước sau khi chuyển đổi + đơn vị
     */
    function convertUnit($size, $longUnit  = false, $totalDigit = 2, $ditance = ' '){
        $units	= ($longUnit == true) ? array('Byte', 'Kilobyte', 'Megabyte', 'Gigabyte', 'Tegabyte') : array('B', 'KB', 'MB', 'GB', 'TB');
        $length	= count($units);
        
        for($i = 0; $i < $length; $i++){
            if ($size > 1024) {
                $size	/= 1024;
            } else {
                $unit	= $units[$i];
                break;
            }
        }

        return round($size, $totalDigit) . $ditance . $unit;
    }
    
    
	/**
	 * Kiểm tra định dạng nhập
	 * @param unknown $value   Giá trị cần kiểm tra
	 * @param unknown $type    Kiểu dữ liệu: Username, Password, Email, TelNumber, IDCard, Website.
	 * @return boolean         True: định dạng nhập hợp lệ || False: định dạng nhập không hợp lệ
	 */
	function checkFormat($value, $type){
        switch ($type){
            case 'Username':
                $pattern    = '#^[A-z][A-z0-9_\.\s]{3,49}$#';
                break;
            case 'Password':
//                 $pattern    = '#^(?=.*\d)(?=.*[A-Z])(?=.*\W).{4,20}$#';     //\d: 0-9; \W: ký tự đặc biệt
                $pattern    = '#^(?=.*[A-Z])(?=.*\d).{4,20}$#';     //\d: 0-9; \W: ký tự đặc biệt
                break;
            case 'Email':
                $pattern    = '#^[a-z][a-z0-9_\.]{4,31}@[a-z0-9]{2,}(\.[a-z]{2,4}){1,2}$#';
                break;
            case 'TelNumber':
                $pattern    = '#^0([0-9]){10,11}$|^08([0-9]){6,8}$#';
                break;
            case 'IDCard':
                $pattern    = '#^(([0-9]){9}|([0-9]){12})$#';
                break;
            case 'Website':
                $pattern    = '#^(https?://(www\.)?|(www\.))[a-z0-9_]{3,}(\.[a-z]{2,4}){1,2}$#';
                break;
        }
        
        return preg_match($pattern, $value) ? true : false;
    }
	
    /*================================================================================*/
?>