<?php
$connection = mysql_connect("localhost","root") or die("connection to the database not successful : ".mysql_error());
$db = mysql_select_db("recommender3") or die("recommender3 not selected successfully");
?>