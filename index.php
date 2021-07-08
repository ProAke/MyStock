<?php error_reporting(E_ALL ^ E_NOTICE);
/*****************************************************************
Created :26/05/2021
Author : Pros.Ake
E-mail : worapot@outlook.com
Website : www.vpslive.com
Script : PHP 8 / mysql support
Copyright (C) 2018-2021, VPS Live Digital togethers, all rights reserved.
 *****************************************************************/


$code = isset($_GET['code']) ? $_GET['code'] : '';

echo $code . "<<< <hr><br>";
echo file_get_contents("php://input");
