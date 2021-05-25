<?php error_reporting (E_ALL ^ E_NOTICE);
/*****************************************************************
Created :26/05/2021
Author : Pros.Ake
E-mail : worapot@outlook.com
Website : www.vpslive.com
Script : PHP 8 / mysql support
Copyright (C) 2018-2021, VPS Live Digital togethers, all rights reserved.
*****************************************************************/



/*
	$db_config=array(
	    "host"=>"localhost",
	    "user"=>"uarea_office",
	    "pass"=>"C5mWnjqC",
	    "dbname"=>"uarea_office",
	    "charset"=>"utf8"
	);
*/

	$db_config=array(
	    "host"=>"103.246.18.79",
	    "user"=>"uarea_office",
	    "pass"=>"C5mWnjqC",
	    "dbname"=>"uarea_office",
	    "charset"=>"utf8"
	);

	

	$conn = @new mysqli($db_config["host"], $db_config["user"], $db_config["pass"], $db_config["dbname"]);
	$conn->set_charset($db_config["charset"]);

	if(mysqli_connect_error()) {
	    die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
	    exit;
	}

date_default_timezone_set("Asia/Bangkok");
$iPod = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$Android= stripos($_SERVER['HTTP_USER_AGENT'],"Android");
$webOS= stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
$status=true;

if( $iPod || $iPhone ){
$status=false;
        //were an iPhone/iPod touch -- do something here
}else if($iPad){
$status=false;
        //were an iPad -- do something here
}else if($Android){
$status=false;
        //were an Android device -- do something here
}else if($webOS){
$status=false;
        //were a webOS device -- do something here
	}
	if($status==true){
	}

// Display Error ,0=none display,1=display
@ini_set('display_errors', '1');
@set_time_limit(0);

// MySQL Table
$tableLag 							= "kgu_lag";
$tableAdmin 						= "kgu_admin_user";
$tableAdminMenu 				= "kgu_admin_menu";
$tableMessage 					= "kgu_message";
$tableMember 						= "kgu_member";
$tableMemberAddress			= "kgu_member_address";
$tableMailMessage 			= "kgu_mail_message";
$tableBarcode						= "kgu_products";
$tableBarcodelog				= "kgu_products_log";
$tableGroup							= "kgu_groups";
$tableManufacturer			= "kgu_Manufacturer";
$tableBusinessType			= "kgu_Business_Type";
$tableProvince					=	"province";
$tableAmphur						=	"amphur";
$tableDistrict					=	"district";
$tableCustomers					= "kgu_customers";
$tableSetting						= "kgu_setting";



// All config
$cfgDefaultPerPage = 5;
$cfgOtherRowPerPage = 15;



// Session
if(substr_count($_SERVER["SCRIPT_NAME"],"/barcode/") == 1){
	session_name("bardcode");
}

session_start();


if(empty($_SESSION['file_upload'])) $_SESSION['file_upload'] = array();






/*
if(!get_magic_quotes_gpc()){
	$_GET = array_map('setMagicQuotesGPC', $_GET);
	$_POST = array_map('setMagicQuotesGPC', $_POST);
	$_COOKIE = array_map('setMagicQuotesGPC', $_COOKIE);
}

function setMagicQuotesGPC($element){
	if(is_array($element)){
		return array_map('setMagicQuotesGPC', $element);
	}else{
		return addslashes($element);
	}
}
*/





?>
