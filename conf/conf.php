<?php

$user_name = "stu";
$pass_word = "stu@1234";
$database = "dmsd_db";
$server = "localhost";

global $db;
//$db_handle=mysqli_connect($server,$user_name,$pass_word,false,65536)or die('Unable to establish a DB connection'.mysql_error());
//$db_found=  mysqli_select_db($database,$db_handle);
$db = new mysqli($server, $user_name, $pass_word, $database);
//error_reporting(E_ERROR|E_PARSE);
global $path, $imp;
// $path="/home/trtagedj/public_html/";
$path = "";
$imp = "smoothness";
?>

