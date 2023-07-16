<?php

$db_name = 'mysql:host=localhost;dbname=artsite_db';
$user_name = 'root';
$user_password = '';

$conn = new PDO($db_name, $user_name, $user_password);

if(!$conn){
 die('Could not Connect My Sql:' .mysql_error());
 }

?>