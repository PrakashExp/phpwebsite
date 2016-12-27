<?php
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
    
    $Ho = array(
        'Nguyễn',
        'Trần',
        'Lê',
        'Phạm',
        'Huỳnh',
        'Hoàng',
        'Phan',
        'Vũ',
        'Võ',
        'Đặng',
        'Bùi',
        'Đỗ',
        'Hồ',
        'Ngô',
        'Dương',
        'Lý',
        'An',
        'Ánh',
        'Ân',
        'Âu',
        'Bá',
        'Bạc',
        'Bạch',
        'Bàng',
        'Bảo',
        'Bửu',
        'Cao',
        'Chế',
        'Chu',
        'Châu',
        'Dương',
        'Doãn',
        'Dư',
        'Đàm',
        'Đào',
        'Đậu',
        'Điền',
        'Đinh',
        'Đoàn',
        'Đổng',
        'Đường',
        'Giang',
        'Hà',
        'Hàn',
        'Hồng',
        'Hứa',
        'Kha',
        'Khương',
        'Kim',
        'Lạc',
        'Lương',
        'Lưu',
        'Mạc',
        'Mai',
        'Phùng',
        'Quách',
        'Tạ',
        'Thạch',
        'Tiêu',
        'Tô',
        'Tôn',
        'Tống',
        'Trác',
        'Triệu',
        'Trịnh',
        'Trương',
        'Từ',
        'Vương'
    );
    
    $tmpMale = array(
        'Văn',
        'Hữu',
        'Đức',
        'Thành',
        'Công',
        'Quang',
        'Tiến',
        'Hoàng',
        'Cao',
        'Mạnh',
        'Huy',
        'Quốc',
        'Tuấn',
        'Đình',
        'Minh',
        'Thiện',
        'Đức',
        'Nam',
        'Thanh',
        'Gia',
        'Khắc',
        'Thế',
        'Duy',
        'Phương',
        'Khắc',
        'Huỳnh'
    );
    
    $tmpFemale = array(
        'Thị',
        'Thúy',
        'Thùy',
        'Thị Hoàng',
        'Ngọc',
        'Kim',
        'Thị Thanh',
        'Yến',
        'Thị Bích',
        'Thị Châu',
        'Thị Thúy',
        'Thị Thùy',
        'Thị Kim',
        'Thị Ngọc'
    );
    
    $Male = array(
        'Phương',
        'Nguyên',
        'Anh',
        'Thủy',
        'Minh',
        'Kim',
        'Thạnh',
        'Phượng',
        'Thiên',
        'An',
        'Phú',
        'Mỹ',
        'Nhật',
        'Sơn',
        'Đức',
        'Hải',
        'Hiếu',
        'Đạo',
        'Hiệp',
        'Nhân',
        'Anh',
        'Tiến',
        'Cảnh',
        'Phú',
        'Bách'
    );
    
    $Female = array(
        'Linh',
        'Trang',
        'Phương',
        'Nguyên',
        'Ngọc',
        'Lan',
        'Anh',
        'Thùy',
        'Thủy',
        'Thúy',
        'Uyên',
        'Thảo',
        'Ngọc',
        'Nhung',
        'Ngân',
        'Nga',
        'Hương',
        'Chi',
        'Hồng',
        'Huyền',
        'Oanh',
        'Phượng',
        'Tiên',
        'Vy',
        'Vân',
        'Dung',
        'Kiều',
        'Trúc',
        'Mai',
        'Hiền',
        'Quỳnh',
        'Hằng',
        'Giang',
        'Trinh',
        'Hà',
    );
    
    $charJob	= array(
        'E',
        'C',
        'C',
        'C',
        'C',
        'C',
        'C',
        'C',
        'C',
        'C',
        'C',
        'C'
    );
    
    $District = array(
        'Quận 1, Tp. HCM',
        'Quận 2, Tp. HCM',
        'Quận 3, Tp. HCM',
        'Quận 4, Tp. HCM',
        'Quận 5, Tp. HCM',
        'Quận Tân Phú, Tp. HCM',
        'Quận Bình Tân, Tp. HCM',
        'Quận Thủ Đức, Tp. HCM',
        'Quận 9, Tp. HCM',
        'Quận 10, Tp. HCM',
        'Quận 12, Tp. HCM'
    );
    
    $arrSex = array(
        0,
        0,
        0,
        0,
        0,
        1,
        1,
        1,
        1,
        1,
        1,
        1,
        1        
    );
    

    $nHo        = count($Ho) - 1;
    $nTmpMale   = count($tmpMale) - 1;
    $nTmpFemale = count($tmpFemale) - 1;
    $nMale      = count($Male) - 1;
    $nFemale    = count($Female) - 1;
    $nJob       = count($charJob) - 1;
    $nSex       = count($arrSex) - 1;
    $nDistrict  = count($District) - 1;
    
    for($i = 0; $i < 200; $i++) :
        $tmpChar    = $charJob[rand(0, $nJob)];
        $GroupID    = ($tmpChar == 'E') ? '4' : 0;
        $UserID =  $tmpChar . shuffleString(str_repeat(implode(range('0', '9'), ''), 4), 7);
        
        $Sex    = $arrSex[rand(0, count($arrSex) - 1)];
        
        if ($Sex == 1){ //Male
            $Name   = $Ho[rand(0, $nHo)] . ' ' . $tmpMale[rand(0, $nTmpMale)] . ' ' . $Male[rand(0, $nMale)];
        } else {
            $Name   = $Ho[rand(0, $nHo)] . ' ' . $tmpFemale[rand(0, $nTmpFemale)] . ' ' . $Female[rand(0, $nFemale)];
        }
        
        $Address = 'Phường ' . rand(1, 10) . ', ' . $District[rand(0, $nDistrict)];

        $Birthday = rand(1, 29) . '/' . rand(1, 12) . '/' . rand(1987, 1998);
        $dateArr = date_parse_from_format("d/m/Y", $Birthday);
        $Birthday = date("Y-m-d", mktime(0, 0, 0, $dateArr["month"], $dateArr["day"], $dateArr["year"]));
        
        $str = str_repeat(implode(range('0', '9'), ''), 4);
        $TelNumber = '083' . shuffleString($str, 8);
        $IDCard = shuffleString($str, 9);
        $Username = str_replace(' ', '', stripUnicode($Name));
        $Password = rand(10000, 100000);
        $Email = $Password . '@gmail.com';
        $Password = md5($Password);
        
        $db = Database::getDB();
        
        $Time1 = str_pad(rand(0, 23), 2, '0', STR_PAD_LEFT) . ':' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT) . ':' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT) . ' ' . rand(1, 29) . '/' . rand(10, 12) . '/' . 2015;
        $Time2 = str_pad(rand(0, 23), 2, '0', STR_PAD_LEFT) . ':' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT) . ':' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT) . ' ' . rand(1, 29) . '/' . rand(1, 8) . '/' . 2016;
        $Time   = (rand(0, 1) == 0) ? $Time1 : $Time2;
        $dateArr = date_parse_from_format("H:i:s d/m/Y", $Time);
        $Time = date("Y-m-d H:i:s", mktime($dateArr["hour"], $dateArr["minute"], $dateArr["second"], $dateArr["month"], $dateArr["day"], $dateArr["year"]));
        
        $userStatment = 'INSERT INTO `users`(`UserID`, `Time`, `Name`, `Sex`, `Birthday`, `IDCard`, `Address`, `TelNumber`, `Email`, `GroupID`, `LastTime`)
                     VALUES (\'' . $UserID . '\', \'' . $Time . '\', \'' . $Name . '\', \'' . $Sex . '\', \'' . $Birthday . '\', \'' . $IDCard . '\', \'' . $Address . '\', \'' . $TelNumber . '\', \'' . $Email . '\', \'' . $GroupID . '\', NOW())';
        
        $accountStatement = 'INSERT INTO `accounts`(`UserID`, `Username`, `Password`) VALUES (\'' . $UserID . '\', \'' . $Username . '\' , \'' . $Password . '\')';
    
        $db->beginTransaction();
        
        Database::setQuery($userStatment);
        $stmt   = Database::execute();
        
        Database::setQuery($accountStatement);
        $stmt   = Database::execute();
        
        $db->commit();
    endfor;
?>