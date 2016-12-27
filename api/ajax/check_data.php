<?php
/* 	CÁC HÀM HỖ TRỢ*/
/*hàm kiểm tra ký tự đặx biệt trong 1 chuỗi. nếu tồn tại ký tự đặc biệt thì return false*/
function specCharChecking($string)
{
	$specChar=array("*","/","\\",":",";","(",")","#");
	for($i=0;$i<count($specChar);$i++)
		if(strpos($string,$specChar[$i])!=false) //tồn tại ký tự đặc biệt
			return false;
	return true;
}
/*hàm kiểm tra số trong chuỗi. nếu xuất hiện số thì return false*/
function notNumChecking($string)
{
	$num=array("0","1","2","3","4","5","6","7","8","9");
	for($i=0;$i<count($num);$i++)
		if(strpos($string,$num[$i])!=false) //tồn tại số
			return false;
	return true;
}
/*Hàm kiểm tra số. Nếu tất cả phần tử trong chuỗi đều là số thì return true 
(hay cách khác: nếu tồn tại ký tự khác số thì return false*/
//Dùng hàm is_numberic để kiểm tra giá trị có phải số hay không.
function isNumChecking($string)
{
	for($i=0;$i<strlen($string);$i++)
		if($string[$i]<='0' && $string[$i]>='9')
			return false;
	return true;
}

/*hàm chuyển định dạng ngày từ d-m-y sang y-m-d*/
//Dùng date_parse_format để chuyển đổi định dạng ngày.
function convertDate($date)
{
	$dateNew=$arrDate[2]."-".$arrDate[1]."-".$arrDate[0];
	return $dateNew;
}
/*CÁC HÀM KIỂM TRA DỮ LIỆU NHẬP VÀO*/
/*kiểm tra password. Nếu ô password trống, ô nhập lại password trống, hoặc password khác password nhập lại, thì return false */
function checkPass($pass,$pass_retype)
{
	if($pass!="" && $pass_retype!="" && ($pass==$pass_retype))
			return true;
	return false;
}
/*kiểm tra ngày tháng nhập vào có chuẩn xác không (theo ĐỊNH DẠNG d/m/y */
//Dùng hàm check_date để kiểm tra ngày hợp lệ.
function checkBirth($date)
{
	$checking=true;
	$arrDate=explode("-",$date);
	if(specCharChecking($date)) //không chứa ký tự đặc biệt
		if($arrDate[1]>12&&$arrDate[1]<1&&$arrDate[0]<1) //tháng lớn 1 và nhỏ hơn 12 và ngày lớn hơn 1
			$checking=false;
		else
		{
			if($arrDate[1]==2) //tháng 2 thì những năm nhuận ngày nhỏ hơn hoặc bằng 29, không thì ngày nhỏ hơn hoặc bằng 28
				if($arrDate[2]%4==0&&$arrDate[0]>29)
					$checking=false;
				else if($arrDate[2]%4!=0&&$arrDate[0]>28)
					$checking=false;
			else if(($arrDate[1]==1||$arrDate[1]==3||$arrDate[1]==5||$arrDate[1]==7||$arrDate[1]==8||$arrDate[1]==10)&&$arrDate[0]>31) //các tháng 1,3,5,7,8,10,12 thì ngày nhỏ hơn hoặc bằng 30
				$checking=false;
				else if($arrDate[0]>30) //các tháng còn lại thì ngày nhỏ hơn hoặc bằng 30
					$checking=false;			
		}
	else
		$checking=false;
		
	if($checking==false)
		return false;
	else
		return true;
	//$date = date_parse_from_format('H:i:s A - d/m/y',date('H:i:s A - d/m/y'));
}
/*kiểm tra họ tên nhập vào. Họ tên không được chứa số, hoặc ký tự đặc biệt*/
function checkName($name)
{
	if(specCharChecking($name)==true && notNumChecking($name)==true)
		return true;
	else
		return false;
}
/*kiểm tra tên đăng nhập. tên đăng nhập không được chứa ký tự đặc biệt*/
function checkUserName($username)
{
	if(specCharChecking($name))
		return true;
	else
		return false;
}
/*kiểm tra số cmnd. số cmnd chỉ chứa số, không chứa ký tự khác*/
function checkIDCard($useridcard)
{
	if(isNumChecking($useridcard))
		return true;
	else
		return false;
}
/*kiểm tra số điện thoại. số điện thoại không thể chứa ký tự khác ngoài số*/
function checkPhoneNumber($tel)
{
	if(isNumChecking($tel))
		return true;
	else
		return false;
}
/*kiểm tra email. email theo định dạng: abcd@efg  */
//Sử dụng RegExp hoặc hàm filter để kiểm tra email.
function checkEmail($email)
{
	if(strpos($email,'@'))
		return true;
	else
		return false;
}
?>