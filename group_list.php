<?php error_reporting (E_ALL ^ E_NOTICE);

include_once("./include/config.inc.php");
include_once("./include/function.inc.php");
include_once("./include/class.inc.php");
include_once("./include/class.TemplatePower.inc.php");
$tpl = new TemplatePower("_tp_group_list.html");
$tpl->prepare();


$query = "SELECT * FROM `$tableGroup` WHERE `STATUS`='0' ORDER BY `ID` ASC";
$result = $conn->query($query);
while($line= $result->fetch_assoc()) {
	$no++;
	$tpl->newBlock("DATA");
	$tpl->assign("no",$no);
	$tpl->assign("id",$line['ID']);
	$tpl->assign("name",$line['NAME']);
}



$tpl->assign("_ROOT.page_title","Post Stock");
$tpl->assign("_ROOT.post"," active");
$tpl->printToScreen();
?>
