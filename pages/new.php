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
$tpl->assignInclude("body", "_tp_new.html");
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
							<a href='".str_replace("index.php","",$backend_url)."pages/new.php'>New</a>
							<i class='fa fa-angle-right'></i>
						</li>");
GetMenuAdmin($menu2);
$page_lag=$_GET['page_lag'];
if(!isset($_GET['page_lag'])  && !isset($_SESSION['page_lag']) || $_GET['page_lag']=="" && !isset($_SESSION['page_lag']))  $page_lag="1";
if(!isset($_GET['page_lag'])  && isset($_SESSION['page_lag']) || $_GET['page_lag']=="" && isset($_SESSION['page_lag']))  $page_lag=$_SESSION['page_lag'];
GetMenuLAG($page_lag,$_GET['key'],$_GET['group'],$_GET['id']);

						
						
if($_POST['action'] == "save" && $_POST['page'] != ""){

		$newfilename1 = SaveUploadImg($_FILES['img1'],"../../upload/pages/");
		$newfilename2 = SaveUploadImg($_FILES['img2'],"../../upload/pages/");		

		

// Create ID
	$arrData = array();
	$arrData['TITLE'] 	= $_POST['title'];
	$arrData['PAGE'] 	= $_POST['page'];
	$arrData['DATE'] = date("Y-m-d H:i:s");
	$arrData['LAG'] = $_POST['lag'];
	$query = sqlCommandInsert($tablePage,$arrData);
	$result = mysql_query($query);
// Create Defalt Lag
	$query = "SELECT * FROM `$tablePage` ORDER BY `ID` DESC limit 1";
	$result = mysql_query($query);
	$rnum=mysql_num_rows($result);
	if($rnum>0){
			$line = mysql_fetch_array($result);
			$arrData = array();
			if(!isset($_POST['id']) || $_POST['id']=="") {$arrData['ID'] = $line['ID'];}
			if(isset($_POST['id']) && $_POST['id']!="") {$arrData['ID'] = $_POST['id'];	}
			$arrData['PAGE'] = $_POST['page'];
			$arrData['TITLE'] = $_POST['title'];
			$arrData['DETAIL']	= $_POST['detail'];
			$arrData['DESC'] = $_POST['desc'];	
			$arrData['KEYWORD'] = $_POST['keyword'];
			$arrData['DESCRIPTION'] = $_POST['description'];	
			if($newfilename1 != "") {$arrData['KEYIMG'] = $newfilename1;}
			if($newfilename2 != "") {$arrData['GOIMG'] = $newfilename2;	}
		
			$arrData['GOTITLE'] = $_POST['gotitle'];	
			$arrData['GOSITENAME'] = $_POST['gositename'];	
			$arrData['GOTYPE'] = $_POST['gotype'];	
	
			$arrData['CSS'] = $_POST['css'];	
			$arrData['JS'] = $_POST['js'];		
		
			$arrData['LAG'] = $_POST['lag'];
			$arrData['DATE'] = date("Y-m-d H:i:s");	
			$query = sqlCommandInsert($tablePageDetail,$arrData);
			$result = mysql_query($query);
			//////////////////////////////
			if($page_lag=="1"){
				if(!isset($_POST['id']) || $_POST['id']=="") {$arrData['ID'] = $line['ID'];}
				if(isset($_POST['id']) && $_POST['id']!="") {$arrData['ID'] = $_POST['id'];}
					$arrData['PAGE'] = $_POST['page'];
					$arrData['TITLE'] = $_POST['title'];
					$arrData['DETAIL']	= $_POST['detail'];
					$arrData['DESC'] = $_POST['desc'];	
					$arrData['KEYWORD'] = $_POST['keyword'];
					$arrData['DESCRIPTION'] = $_POST['description'];	
					if($newfilename1 != "") {$arrData['KEYIMG'] = $newfilename1;}
					if($newfilename2 != "") {$arrData['GOIMG'] = $newfilename2;	}
		
					$arrData['GOTITLE'] = $_POST['gotitle'];	
					$arrData['GOSITENAME'] = $_POST['gositename'];	
					$arrData['GOTYPE'] = $_POST['gotype'];	
	
					$arrData['CSS'] = $_POST['css'];	
					$arrData['JS'] = $_POST['js'];		
		
					$arrData['LAG'] = 2;
					$arrData['DATE'] = date("Y-m-d H:i:s");	
					$query = sqlCommandInsert($tablePageDetail,$arrData);
					$result = mysql_query($query);
			}
			/////////////////////////////
			//////////////////////////////
			if($page_lag=="2"){
				if(!isset($_POST['id']) || $_POST['id']=="") {$arrData['ID'] = $line['ID'];}
				if(isset($_POST['id']) && $_POST['id']!="") {$arrData['ID'] = $_POST['id'];}
					$arrData['PAGE'] = $_POST['page'];
					$arrData['TITLE'] = $_POST['title'];
					$arrData['DETAIL']	= $_POST['detail'];
					$arrData['DESC'] = $_POST['desc'];	
					$arrData['KEYWORD'] = $_POST['keyword'];
					$arrData['DESCRIPTION'] = $_POST['description'];	
					if($newfilename1 != "") {$arrData['KEYIMG'] = $newfilename1;}
					if($newfilename2 != "") {$arrData['GOIMG'] = $newfilename2;	}
		
					$arrData['GOTITLE'] = $_POST['gotitle'];	
					$arrData['GOSITENAME'] = $_POST['gositename'];	
					$arrData['GOTYPE'] = $_POST['gotype'];	
	
					$arrData['CSS'] = $_POST['css'];	
					$arrData['JS'] = $_POST['js'];		
		
					$arrData['LAG'] = 1;
					$arrData['DATE'] = date("Y-m-d H:i:s");	
					$query = sqlCommandInsert($tablePageDetail,$arrData);
					$result = mysql_query($query);
			}
			/////////////////////////////
	}
	
	
	


	$tpl->newBlock("SAVE");
	$tpl->assign("strMessage",GetMessage(7));


}//else{

	$tpl->newBlock("FORM");
	$tpl->assign("lag",$page_lag);	
//}


$tpl->printToScreen();

?>