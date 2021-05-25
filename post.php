<?php error_reporting (E_ALL ^ E_NOTICE);

include_once("./include/config.inc.php");
include_once("./include/function.inc.php");
include_once("./include/class.inc.php");
include_once("./include/class.TemplatePower.inc.php");


$tpl = new TemplatePower("_tp_main.html");
$tpl->assignInclude("body", "_tp_post.html");
$tpl->prepare();



$tpl->newBlock("DATA");

$n=0;
for($i=0;$i<10;$i++){

  if($n==0){$tpl->newBlock("STOCK");$tpl->newBlock("STOCKLIST");}else{$tpl->newBlock("STOCKLIST");}
  $tpl->assign("i",$i);

  $n++;
  if($n==5){$n=0;}
}

$query = "SELECT * FROM `$tableGroup` WHERE `GROUP`='0' AND `STATUS`='0' ORDER BY `ID` ASC";
$result = $conn->query($query);
while($line= $result->fetch_assoc()) {
	$no++;
	$tpl->newBlock("GROUPS");
		$tpl->assign("id",$line['ID']);
		$tpl->assign("group_name",$line['NAME']);
}






//{page_title}{website_name}
$tpl->assign("_ROOT.page_title","Post Stock");
$tpl->assign("_ROOT.post"," active");
$tpl->printToScreen();
?>
