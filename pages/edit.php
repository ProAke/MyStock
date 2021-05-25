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
include_once("../../include/class.Thumbnail.php");
include_once("../authentication/check_login.php");


$tpl = new TemplatePower("../template/_tp_main.html");
$tpl->assignInclude("body", "_tp_edit.html");
$tpl->prepare();

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
							<a href='".str_replace("index.php","",$backend_url)."edit.php?id=".$_GET['id']."'>Edit</a>
							<i class='fa fa-angle-right'></i>
						</li>");
GetMenuAdmin($menu2);
$page_lag=$_GET['page_lag'];
if(!isset($_GET['page_lag'])  && !isset($_SESSION['page_lag']) || $_GET['page_lag']=="" && !isset($_SESSION['page_lag']))  $page_lag="1";
if(!isset($_GET['page_lag'])  && isset($_SESSION['page_lag']) || $_GET['page_lag']=="" && isset($_SESSION['page_lag']))  $page_lag=$_SESSION['page_lag'];
GetMenuLAG($page_lag,$_GET['key'],$_GET['group'],$_GET['id']);

						
//
if($_GET['ac']=="remove1"){
	$id = $_GET['id'];
	if(is_file("../../upload/pages/".$_GET['file1'])){
			@unlink("../../upload/pages/".$_GET['file1']);
		}
		
/*	header("location: edit.php?id=".$id);
	exit;*/
		$tpl->newBlock("REMOVE");
   }

if($_GET['ac']=="remove2"){
	$id = $_GET['id'];
	if(is_file("../../upload/pages/".$_GET['file2'])){
			@unlink("../../upload/pages/".$_GET['file2']);
		}
/*	header("location: edit.php?id=".$id);
	exit;	*/	
		$tpl->newBlock("REMOVE");	
   }





if($_POST['action'] == "save" && $_POST['id'] != "" && $_POST['page'] != ""){
		$newfilename1 = SaveUploadImg($_FILES['img1'],"../../upload/pages/");
		$newfilename2 = SaveUploadImg($_FILES['img2'],"../../upload/pages/");		
		if($newfilename1){@unlink("../../upload/pages/".$_POST['file1']);}
		if($newfilename2){@unlink("../../upload/pages/".$_POST['file2']);}
	
	// Update Data
	$arrData = array();
	$arrData['PAGE'] = $_POST['page'];
	//$arrData['MENU'] = $_POST['menu'];
	$arrData['TITLE'] = $_POST['title'];
	$arrData['DESC'] = $_POST['desc'];
	$arrData['DETAIL']		= $_POST['detail'];	
	$arrData['KEYWORD'] = $_POST['keyword'];
	$arrData['DESCRIPTION'] = $_POST['description'];	
	if($newfilename1 != "") $arrData['KEYIMG'] = $newfilename1;
	if($newfilename2 != "") $arrData['GOIMG'] = $newfilename2;	
		
	$arrData['GOTITLE'] = $_POST['gotitle'];	
	$arrData['GOSITENAME'] = $_POST['gositename'];	
	$arrData['GOTYPE'] = $_POST['gotype'];	
	
	$arrData['CSS'] = $_POST['css'];	
	$arrData['JS'] = $_POST['js'];			

	$arrData['DATE'] = date("Y-m-d H:i:s");
	$query = sqlCommandUpdate($tablePageDetail,$arrData,"`ID`='{$_POST['id']}' AND `LAG`='{$page_lag}'");
	$result = mysql_query($query);


	$tpl->newBlock("SAVE");
	$tpl->assign("strMessage",GetMessage(7));
	$tpl->assign("id",$_POST['id']);	

	
}//else{
	

	// Form
	$query = "SELECT * FROM `$tablePageDetail` WHERE `ID`='{$_GET['id']}'  AND `LAG`='".$_SESSION['page_lag']."'";
	$result = mysql_query($query);
	$nresult = mysql_num_rows($result);
	if($nresult==0){
	?>
	<script>alert("Cannot found this record, Could you please create new record");window.location.href="index.php";</script>
	<?
	//exit;
	}	
	while ($line = mysql_fetch_array($result)) {
		$tpl->newBlock("FORM");
		$tpl->assign("id",$line['ID']);
		$tpl->assign("page",$line['PAGE']);
		//$tpl->assign("menu",$line['MENU']);
		$tpl->assign("title",$line['TITLE']);
		$tpl->assign("desc",$line['DESC']);			
		$tpl->assign("keyword",$line['KEYWORD']);
		$tpl->assign("description",$line['DESCRIPTION']);	
		
		$tpl->assign("detail",$line['DETAIL']);
		
		$tpl->assign("gotitle",$line['GOTITLE']);
		$tpl->assign("gositename",$line['GOSITENAME']);
		$tpl->assign("gotype",$line['GOTYPE']);		
		
		
			if(is_file("../../upload/pages/".$line['KEYIMG'])){
			$tpl->assign("img1","<img src='../../upload/pages/".$line['KEYIMG']."' border='1' width='300'>");
			$tpl->assign("remove1","<a href='?id=".$line['ID']."&ac=remove1&file1=".$line['KEYIMG']."'> Remove image </a>");
		     }
		
			if(is_file("../../upload/pages/".$line['GOIMG'])){			
			$tpl->assign("img2","<img src='../../upload/pages/".$line['GOIMG']."' border='1'>");
			$tpl->assign("remove2","<a href='?id=".$line['ID']."&ac=remove2&file2=".$line['GOIMG']."'> Remove image </a>");
		     }
			 
		$tpl->assign("css",$line['CSS']);
		$tpl->assign("js",$line['JS']);		
					 

	}
//}

$tpl->printToScreen();

?>