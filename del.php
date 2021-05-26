<?php error_reporting (E_ALL ^ E_NOTICE);

include_once("./include/config.inc.php");
include_once("./include/function.inc.php");
include_once("./include/class.inc.php");


$barcode = isset($_GET['barcode']) ? $_GET['barcode'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

if($action=='del' && !isset($id){


	$query = "DELETE FROM `$tableBarcode` WHERE `ID`='".$id."'";
	$result = $conn->query($query);

	@unlink("../../upload/begin/full/".$_GET['file']);

   if($result){
	header('Location: index.php?Alert' );
	exit;

   }

}else{

	header('Location: index.php' );
	exit;

}



?>
