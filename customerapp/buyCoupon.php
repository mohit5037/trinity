<?php

include("../config.php");
include("../recommendercode/config.php");
include("../recommendercode/new_transaction.php");

if ($_POST['couponId']):
$couponId = $_POST['couponId'];
$userId = $_POST['userId'];

 
//$couponId = 111;
//$userId = 1;

$nt = new new_transaction($couponId , $userId , $number_of_last_transactions , $min_constant , $d);

//code to make it favourite
$sql1="SELECT * FROM usercoupons WHERE couponid='".$couponId."' and userid ='".$userId."'";
$res1=mysql_query($sql1);
$count=mysql_num_rows($res1);
if($count==1)
{
//$query = "UPDATE `usercoupons` SET `favourite`='yes' WHERE `userid`='$userId' and `couponid`='$couponId'"; 
}
else
{
  $query = "INSERT INTO `usercoupons`(`couponid`, `userid`, `rating`, `review`) 
     VALUES ('".$couponId."','".$userId."','1','0')";   
     $res2=mysql_query($query);
}

//mail('mohit_pec@yahoo.com','hello','How are you?');

//code for transaction i am giving you couponId and userId

 echo json_encode("**Your Transaction is Successfull, You will get an email shortly");  
    
endif; 
?>