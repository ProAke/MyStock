<?php error_reporting (E_ALL ^ E_NOTICE);
/*****************************************************************
Created :26/05/2021
Author : Pros.Ake
E-mail : worapot@outlook.com
Website : www.vpslive.com
Script : PHP 8 / mysql support
Copyright (C) 2018-2021, VPS Live Digital togethers, all rights reserved.
*****************************************************************/


include_once("./include/config.inc.php");
include_once("./include/function.inc.php");
include_once("./include/class.inc.php");
include_once("./include/class.TemplatePower.inc.php");






$code= isset($_GET['code']) ? $_GET['code'] : '';
if($code !=""){
$query = "SELECT * FROM `$tableBarcode` WHERE `BARCODE`='".$code."'";
echo $query;
$result = $conn->query($query);
if ($line= $result->fetch_assoc()) {
				$num = $line['NUM']+1;

					$arrData1 = array();
					$arrData1['BARCODE']					= $code;
					$arrData1['DATETIME']					= date("Y-m-d H:i:s");
					$query1 = sqlCommandInsert($tableBarcodelog,$arrData1);
					$result1 = $conn->query($query1);
					$arrData = array();
					$arrData['NUM']					= $num;
					$arrData['DATETIME']			= date("Y-m-d H:i:s");
					$query = sqlCommandUpdate($tableBarcode,$arrData,"`BARCODE`='".$code."'");
					$result = $conn->query($query);

?>
<script type="text/javascript">
    window.close();
</script>
<?php
}else{
					$arrData = array();
					$arrData['BARCODE']					= $code;
					$arrData['NUM']							= 1;
					$arrData['DATETIME']					= date("Y-m-d H:i:s");
					$query = sqlCommandInsert($tableBarcode,$arrData);
					$result = $conn->query($query);
					$arrData1 = array();
					$arrData1['BARCODE']					= $code;
					$arrData1['DATETIME']					= date("Y-m-d H:i:s");
					$query1 = sqlCommandInsert($tableBarcodelog,$arrData1);
					$result1 = $conn->query($query1);

?>
<script type="text/javascript">
    window.close();
</script>
<?php
}

}


$tpl = new TemplatePower("_tp_gallery.html");
$tpl->prepare();
$query = "SELECT * FROM `$tableGroup` WHERE `GROUP`='0' AND `STATUS`='0' ORDER BY `ID` ASC";
$result = $conn->query($query);
$no=0;
while($line= $result->fetch_assoc()) {
	$no++;
	$tpl->newBlock("GROUP");
		$tpl->assign("id",$line['ID']);
		$tpl->assign("group_name",$line['NAME']);
}

$query = "SELECT * FROM `$tableBarcode` WHERE `DEL`='0' ORDER BY `DATETIME` DESC";
$result = $conn->query($query);
while($line= $result->fetch_assoc()) {
	$no++;
	$tpl->newBlock("DATA");
	$tpl->assign("no",$line['ID']);
	$tpl->assign("id",$line['ID']);

	$tpl->assign("name",$line['NAME']);
	$tpl->assign("barcode",$line['BARCODE']);
	$tpl->assign("sumBarcode",$line['NUM']);
	$tpl->assign("bprice",$line['BPRICE']);
	$tpl->assign("nprice",$line['NPRICE']);

    $num = $line['NUM'];
	$percentNum = $num/100;
	$tpl->assign("percentNum",$percentNum);






if($line['IMG']==""){
$tpl->assign("img","<a href='product_detail.php?barcode=".$line['BARCODE']."'><img src='files/blank.png' width='150'></a>");
}else{

$tpl->assign("img","<a href='product_detail.php?barcode=".$line['BARCODE']."'><img src='".$line['IMG']."' width='150' border='1'></a>");
}
	$tpl->assign("datetime",$line['DATETIME']);
}



$tpl->printToScreen();
?>
