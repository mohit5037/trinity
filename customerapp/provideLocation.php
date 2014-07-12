<?php 
include("../config.php");

if ($_POST['userId']):
$userid = $_POST['userId'];

$result = mysql_query("SELECT * FROM users WHERE user_id ='".$userid."'"); 
$row=mysql_fetch_array($result);
$location= $row['userLocation'];

echo json_encode($location); 
 endif;
?>