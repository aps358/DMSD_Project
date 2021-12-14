<?php

$user_name = "root";
$pass_word = "password";
$database = "dmsd_db";
$server = "localhost";
$port = 3306;

global $db;

$db = new mysqli($server, $user_name, $pass_word, $database, $port);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
//echo "Connected successfully";

?>
