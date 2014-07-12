<?php 
include("../config.php");

if ($_POST['userId']):
$userid = $_POST['userId'];
$location = $_POST['userLocation'];

$result = mysql_query("UPDATE `users` SET `userLocation`='".$location ."' WHERE user_id ='".$userid."'"); 
echo "Changes Saved Successfuly!"; 

endif;
?>