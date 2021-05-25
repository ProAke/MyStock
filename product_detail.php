<?php error_reporting (E_ALL ^ E_NOTICE);

include_once("./include/config.inc.php");
include_once("./include/function.inc.php");
include_once("./include/class.inc.php");
include_once("./include/class.Thumbnail.php");
include_once("./include/class.TemplatePower.inc.php");




$barcode = isset($_GET['barcode']) ? $_GET['barcode'] : '';




$action = isset($_GET['action']) ? $_GET['action'] : '';




if($action){
$newfilename1 = SaveUploadImg($_FILES['photo'],"files/photo/");
	$arrData = array();


   if($newfilename1){	$arrData['IMG'] = "files/photo/".$newfilename1;}
	else if($_POST['url']){	$arrData['IMG'] = $_POST['url'];}

	if($_POST['name']){	$arrData['NAME'] = $_POST['name'];}
	if($_POST['produced_name']){	$arrData['PRODUCED_NAME'] = $_POST['produced_name'];}
	if($_POST['produced_code']){	$arrData['PRODUCED_CODE'] = $_POST['produced_code'];}
	if($_POST['items_stock']){	$arrData['ITEMS_STOCK'] = $_POST['items_stock'];}
	if($_POST['items_all']){	$arrData['ITEMS_ALL'] = $_POST['items_all'];}
	if($_POST['series']){	$arrData['SERIES'] = $_POST['series'];}
	if($_POST['bprice']){	$arrData['NPRICE'] = $_POST['nprice'];}
	if($_POST['nprice']){	$arrData['BPRICE'] = $_POST['bprice'];}
	if($_POST['detail']){	$arrData['DETAIL'] = $_POST['detail'];}
	if($_POST['aoryor']){	$arrData['AORYOR'] = $_POST['aoryor'];}

	$arrData['DATETIME'] = date("Y-m-d H:i:s");
	$query = sqlCommandUpdate($tableBarcode,$arrData,"`BARCODE`='".$barcodes."'");
	$result = $conn->query($query);

}









$tpl = new TemplatePower("_tp_product_detail.html");
$tpl->prepare();



	$query = "SELECT * FROM `$tableBarcode` WHERE `BARCODE`='".$barcode."'";
	$result = $conn->query($query);
	while($line= $result->fetch_assoc()) {
		$tpl->newBlock("FORM");
		$tpl->assign("id",$line['ID']);
		$tpl->assign("barcode",$line['BARCODE']);
		$tpl->assign("name",$line['NAME']);
		$tpl->assign("detail",$line['DETAIL']);
		$tpl->assign("bprice",$line['BPRICE']);
		$tpl->assign("nprice",$line['NPRICE']);
		$tpl->assign("items_stock",$line['ITEMS_STOCK']);
		$tpl->assign("items_all",$line['ITEMS_ALL']);
		$tpl->assign("aoryor",$line['AORYOR']);
		$tpl->assign("series",$line['SERIES']);
		$tpl->assign("series".$line['SERIES']," checked");
		if($line['IMG']){
		$tpl->assign("img","<img src='".$line['IMG']."' width='300' border='1'>");
		$tpl->assign("url",$line['IMG']);

        }


		$bussiness_type		= $line['BUSINESS_TYPE'];
		$manufacturer		= $line['MANUFACTURER'];
}



// Business_type
	$query = "SELECT * FROM `$tableBarcode` WHERE `BARCODE`='".$barcode."'";
	$result = $conn->query($query);
	while($line= $result->fetch_assoc()) {
	}
// Manufacturer
	$query = "SELECT * FROM `$tableBarcode` WHERE `BARCODE`='".$barcode."'";
	$result = $conn->query($query);
	while($line= $result->fetch_assoc()) {
	}




$tpl->printToScreen();
?>
