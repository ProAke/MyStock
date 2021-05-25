<?php error_reporting (E_ALL ^ E_NOTICE);
/*****************************************************************
Created :22/10/2010
Author : JIE'software 
E-mail : jie@pacificserver.net
Website : www.pacificserver.net
Blog : www.digitalmediathai.com
Copyright (C) 2010-2011, www.pacificserver.net all rights reserved.
*****************************************************************/

include_once("../../include/config.inc.php");
include_once("../../include/function.inc.php");
include_once("../../include/class.inc.php");
include_once("../../include/class.TemplatePower.inc.php");
include_once("../authentication/check_login.php");


$tpl = new TemplatePower("../template/_tp_main.html");
$tpl->assignInclude("body", "_tp_index.html");
$tpl->prepare();
$tpl->assign("_ROOT.user_id",$user_id);
// Menu



	$query = "SELECT * FROM `$tableAdminMenu` WHERE `ID` = '5' AND `SHOW` = '0'  ORDER BY `ORDER` ASC";
	$result = mysql_query($query);

	while ($line = mysql_fetch_array($result)) {
		$tpl->assign("_ROOT.backend_menu",$line['MENU']);
		$backend_menu = $line['MENU'];
		$backend_url = $line['URL'];
		$backend_icon = $line['ICON'];
	}


// Menu
$menu2 = "5";
$tpl->assign("_ROOT.hotitle","<li>
							<i class='$backend_icon'></i>
							<a href='$backend_url'>$backend_menu</a>
							<i class='fa fa-angle-right'></i>
						</li>");
GetMenuAdmin($menu2);
$page_lag=$_GET['page_lag'];
if(!isset($_GET['page_lag'])  && !isset($_SESSION['page_lag']) || $_GET['page_lag']=="" && !isset($_SESSION['page_lag']))  $page_lag="1";
if(!isset($_GET['page_lag'])  && isset($_SESSION['page_lag']) || $_GET['page_lag']=="" && isset($_SESSION['page_lag']))  $page_lag=$_SESSION['page_lag'];
GetMenuLAG($page_lag,$_GET['key'],$_GET['group'],$_GET['id']);

						
// Check Page No.
if(!is_numeric($_GET['page'])) $_GET['page'] = 1;
$sqlPageLimit = ($_GET['page'] * $cfgOtherRowPerPage) - $cfgOtherRowPerPage;


// Split Page
$query = "SELECT COUNT(*) FROM `$tablePageDetail` WHERE `LAG`='$page_lag'";
$result = mysql_query($query);
$line = mysql_fetch_array($result);
$intTotalItem = $line['COUNT(*)'];

$sp = new SplitPage();
$sp->intTotalItem = $intTotalItem;
$sp->intItemPerPage = $cfgOtherRowPerPage;
$sp->intCurrentPage = $_GET['page'];
$sp->strLinkParam = "key={$_GET['key']}";

$sp->intItemPageShow = 10;
$sp->booShowAllPage = false;

$tpl->assign("_ROOT.page",$sp->Show());



// List Data
$no = $sqlPageLimit;

$query = "SELECT * FROM `$tablePageDetail` WHERE `LAG`='$page_lag' ORDER BY `ID` ASC LIMIT $sqlPageLimit , $cfgOtherRowPerPage";
$result = mysql_query($query);
while($line = mysql_fetch_array($result)){
	$no++;
	$tpl->newBlock("DATA");
	$tpl->assign("no",$no);
	$tpl->assign("id",$line['ID']);
	$tpl->assign("page",$line['PAGE']);
}



$tpl->printToScreen();

?>