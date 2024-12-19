<?php 
session_start();
if (isset($_SERVER['HTTP_ORIGIN'])) {
    $origin = $_SERVER['HTTP_ORIGIN'];
} else {
    $origin = ''; // or a default value
}
require_once('../../model/MysqliApp.php');
require_once('../../model/apiKeys.php');
header("Access-Control-Allow-Origin:" . $_SERVER['HTTP_ORIGIN']);
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
date_default_timezone_set("Asia/Manila");


$date = date('Y-m-d h:i:s a');
foreach (glob("../../Model/*.php") as $filename)
{
    include_once($filename);
}

$url = $_SERVER['REQUEST_URI'];
$url_folder = substr($url,1);
include_once("../../includes/functions.php");


$PROJECTNAME = "wop";