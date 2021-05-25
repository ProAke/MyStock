<?php error_reporting (E_ALL ^ E_NOTICE);
/*****************************************************************
Created :19/10/2018
Author : Kingeru
E-mail : worapot.kingeru@gmail.com
Website : www.kingeru.com
Copyright (C) 2018, Kingeru Digital Touch all rights reserved.
*****************************************************************/


function CheckLogin($user=""){
	global $tpl;
	if($user==""){
		$tpl->newBlock("LOGIN");
}else{
	$tpl->newBlock("LOGON");
	$tpl->assign("fname",$_SESSION['sfname']);
	$tpl->assign("lname",$_SESSION['slname']);
	}
}



function sqlCommandInsert($strTableName,$arrFieldValue){

	$arrFieldTmp = [];
	$arrValueTmp = [];

	$strFieldTmp = [];
	$strValueTmp = [];

	foreach ($arrFieldValue as $key => $value) {
		$arrFieldTmp[] = "`$key`";
		$arrValueTmp[] = "'$value'";
	}

	$strFieldTmp = implode(",", $arrFieldTmp);
	$strValueTmp = implode(",", $arrValueTmp);

	$strSql = "INSERT INTO `$strTableName`($strFieldTmp) VALUES($strValueTmp)";

	return $strSql;
}
/*
# Function sqlCommandUpdate
# Example

$arrData = array();
$arrData['A'] = "aaaa";
$arrData['B'] = "bbbb";
$arrData['C'] = "cccc";
sqlCommandUpdate("table",$arrData,"`ID`='1'");
*/
function sqlCommandUpdate($strTableName,$arrFieldValue,$strWhere){

	$arrFieldValueTmp = [];
	$strFieldValueTmp = [];

	foreach ($arrFieldValue as $key => $value) {
		$arrFieldValueTmp[] = "`$key`='$value'";
	}

	$strFieldValueTmp = implode(",", $arrFieldValueTmp);

	$strSql = "UPDATE `$strTableName` SET $strFieldValueTmp WHERE $strWhere";

	return $strSql;
}
/*
# Function ThaiDateLong
# Example

ThaiDateLong("YYYY-mm-dd hh:ii:ss",false);
*/
function ThaiDateLong($strDateTime,$booTime){
	$arrThaiMonth = array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

	list($strYMD, $strTime) = explode(" ", $strDateTime);
	list($intY, $intM, $intD) = explode("-", $strYMD);

	$intY = $intY + 543;
	$strM = $arrThaiMonth[$intM*1];
	$intD = $intD * 1;

	if($booTime) $strShowTime = $strTime;

	return "$intD $strM $intY $strShowTime";
}
/*
# Function ThaiDateShort
# Example
ThaiDateShort("YYYY-mm-dd hh:ii:ss",false);
*/
function ThaiDateShort($strDateTime,$booTime){
	$arrThaiMonth = array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");

	list($strYMD, $strTime) = explode(" ", $strDateTime);
	list($intY, $intM, $intD) = explode("-", $strYMD);

	$intY = $intY + 543;
	$strM = $arrThaiMonth[$intM*1];
	$intD = $intD * 1;

	if($booTime) $strShowTime = $strTime;

	return "$intD $strM $intY $strShowTime";
}
/*
# Function EngDateLong
# Example

EngDateLong("YYYY-mm-dd hh:ii:ss",false);
*/
function EngDateLong($strDateTime,$booTime){
	$arrThaiMonth = array("","January","February","March","April","May","June","July","August","September","October","November","December");

	list($strYMD, $strTime) = explode(" ", $strDateTime);
	list($intY, $intM, $intD) = explode("-", $strYMD);

	$intY = $intY;
	$strM = $arrThaiMonth[$intM*1];
	$intD = $intD * 1;

	if($booTime) $strShowTime = $strTime;

	return "$intD $strM $intY $strShowTime";
}
/*
# Function EngDateShort
# Example

EngDateShort("YYYY-mm-dd hh:ii:ss",false);
*/
function EngDateShort($strDateTime,$booTime){
	$arrThaiMonth = array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

	list($strYMD, $strTime) = explode(" ", $strDateTime);
	list($intY, $intM, $intD) = explode("-", $strYMD);

	$intY = $intY;
	$strM = $arrThaiMonth[$intM*1];
	$intD = $intD * 1;

	if($booTime) $strShowTime = $strTime;

	return "$intD $strM $intY $strShowTime";
}
/*
# Function SplitExtension
# Example

SplitExtension("strFileName");
*/
function SplitExtension($strFileName){
   $arrSplit = explode(".", $strFileName);

   return strtolower($arrSplit[count($arrSplit)-1]);
}
/*
# Function SplitText
# Example

SplitText("strText",intLength);
*/
function SplitText($strMessage,$intLength){

	$arrMessage = explode(" ", $strMessage);
	$strNewMessage = $arrMessage[0];

	for($i=1;$i<count($arrMessage);$i++){
		if(strlen($strNewMessage.$arrMessage[$i]) > $intLength){
			break;
		}else{
			$strNewMessage = $strNewMessage." ".$arrMessage[$i];
		}
	}

   return $strNewMessage;
}
/*
# Function ReplaceHtmlTag
# Example

ReplaceHtmlTag("strText",$arrRudeWord);
*/
function ReplaceHtmlTag($strHtmlOld){
	$strHtmlNew = str_replace("<", "&lt;", $strHtmlOld);
	$strHtmlNew = str_replace(">", "&gt;", $strHtmlNew);
	$strHtmlNew = str_replace("\n", "<br>\n", $strHtmlNew);

	return $strHtmlNew;
}
/*
# Function GetMessage
# Example

GetMessage($intId);
*/
function GetMessage($intId){
	global $tableMessage;
	$query = "SELECT * FROM `$tableMessage` WHERE `ID`='$intId'";
	$result = $conn->query($query);
	$line= $result->fetch_assoc();
	return nl2br($line['MESSAGE']);
}
/*
# Function SaveUploadImg
# Example

$strNewFileName = SaveUploadImg($arrFile,$strPath);

*/
function SaveUploadImg1M($arrFile,$strPath){

	$strFileNameTmp = "";
	if(SplitExtension($arrFile['name']) == "jpg" || SplitExtension($arrFile['name']) == "gif" ){
		$strFileNameTmp = date("Ymdhis")."-".sprintf("%05d",rand()).".".SplitExtension($arrFile['name']);
		if($arrFile['size'] < 1000000){ move_uploaded_file($arrFile['tmp_name'],$strPath.$strFileNameTmp);
		}else{
		$strFileNameTmp = "Over";
		}
	}else{
	$strFileNameTmp = "Over";
	}

	return $strFileNameTmp;
}
function SaveUploadImg100K($arrFile,$strPath){

	$strFileNameTmp = "";
	if(SplitExtension($arrFile['name']) == "jpg" || SplitExtension($arrFile['name']) == "gif" ){
		$strFileNameTmp = date("Ymdhis")."-".sprintf("%05d",rand()).".".SplitExtension($arrFile['name']);
		if($arrFile['size'] < 100000){ move_uploaded_file($arrFile['tmp_name'],$strPath.$strFileNameTmp);
		}else{
		$strFileNameTmp = "Over";
		}
	}else{
	$strFileNameTmp = "Over";
	}

	return $strFileNameTmp;
}
function SaveUploadImg($arrFile,$strPath){

	$strFileNameTmp = "";
	if(SplitExtension($arrFile['name']) == "jpg" || SplitExtension($arrFile['name']) == "gif" || SplitExtension($arrFile['name']) == "png" || SplitExtension($arrFile['name']) == "ico"){
		$strFileNameTmp = date("Ymdhis")."-".sprintf("%05d",rand()).".".SplitExtension($arrFile['name']);
		move_uploaded_file($arrFile['tmp_name'],$strPath.$strFileNameTmp);
	}

	return $strFileNameTmp;
}
/*
# Function SaveUploadFile
# Example

$strNewFileName = SaveUploadFile($arrFile,$strPath);
*/
function SaveUploadFile($arrFile,$strPath){

	$strFileNameTmp = "";
	if(SplitExtension($arrFile['name']) != ""){
		$strFileNameTmp = date("Ymdhis")."-".sprintf("%05d",rand()).".".SplitExtension($arrFile['name']);
		move_uploaded_file($arrFile['tmp_name'],$strPath.$strFileNameTmp);
	}

	return $strFileNameTmp;
}


?>
