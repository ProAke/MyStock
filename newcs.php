<?php error_reporting (E_ALL ^ E_NOTICE);

include_once("./include/config.inc.php");
include_once("./include/function.inc.php");
include_once("./include/class.inc.php");
include_once("./include/class.TemplatePower.inc.php");



$tpl = new TemplatePower("_tp_customers_detail.html");
$tpl->prepare();



						
						
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
			$arrData['PAGE'] = $_POST['page'];
			$arrData['TITLE'] = $_POST['title'];

			if($newfilename1 != "") {$arrData['KEYIMG'] = $newfilename1;}
			if($newfilename2 != "") {$arrData['GOIMG'] = $newfilename2;	}
		
		
			$arrData['LAG'] = $_POST['lag'];
			$arrData['DATE'] = date("Y-m-d H:i:s");	
			$query = sqlCommandInsert($tablePageDetail,$arrData);
			$result = mysql_query($query);
			//////////////////////////////



	}
	
	
	


	$tpl->newBlock("SAVE");
	$tpl->assign("strMessage",GetMessage(7));


}

	$tpl->newBlock("FORM");




$tpl->printToScreen();

?>