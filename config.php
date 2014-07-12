<?php

// database connection config
$dbHost = 'localhost';
$dbUser = 'sourab';
$dbPass = 'sourab';
$dbName = 'recommender3';

$company = "icoupons.com";

$bd = mysql_connect($dbHost, 'root')
or die("Opps some thing went wrong");
mysql_select_db($dbName, $bd) or die("Opps some thing went wrong");

?>