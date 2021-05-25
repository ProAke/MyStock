<?php error_reporting (E_ALL ^ E_NOTICE);

include_once("./include/config.inc.php");
include_once("./include/function.inc.php");
include_once("./include/class.inc.php");
include_once("./include/class.TemplatePower.inc.php");



if ($_GET['barcode']){$barcode=$_GET['barcode'];}
if ($_POST['barcode']){$barcode=$_POST['barcode'];}





/*

if($_POST['url'])
	
	
	{
$url    = $_POST['url'];
$img    =$_POST['barcode'];
$file   = file($url);
$result = file_put_contents($img, $file);
}


*/

if($_POST['action']){

	$arrData = array();

	if($_POST['url']){	$arrData['IMG'] = $_POST['url'];}
	if($_POST['name']){	$arrData['NAME'] = $_POST['name'];}
	if($_POST['series']){	$arrData['SERIES'] = $_POST['series'];}
	if($_POST['bprice']){	$arrData['NPRICE'] = $_POST['nprice'];}
	if($_POST['nprice']){	$arrData['BPRICE'] = $_POST['bprice'];}



	$arrData['DATETIME'] = date("Y-m-d H:i:s");
	$query = sqlCommandUpdate($tableCustomers,$arrData,"`BARCODE`='{$_POST['barcode']}'");
	$result = mysql_query($query);

}









$tpl = new TemplatePower("_tp_customers_detail.html");
$tpl->prepare();









	$query = "SELECT * FROM `$tableCustomers` WHERE `ID`='".$id."'";
	$result = mysql_query($query);
	while($line = mysql_fetch_array($result)){
		$tpl->newBlock("FORM");
		$tpl->assign("id",$line['ID']);

		/*
		$tpl->assign("barcode",$line['BARCODE']);
		$tpl->assign("name",$line['NAME']);
		$tpl->assign("bprice",$line['BPRICE']);
	    $tpl->assign("nprice",$line['NPRICE']);
		$tpl->assign("series",$line['SERIES']);
		$tpl->assign("series".$line['SERIES']," checked");
	
		if($line['IMG']){
		$tpl->assign("img","<img src='".$line['IMG']."' width='300' border='1'>");
		$tpl->assign("url",$line['IMG']);

        }
*/


		}

$tpl->printToScreen();
?>