<?php

include("../config.php");

if ($_POST['couponId']):
    
    $couponId = $_POST['couponId'];
$userId = $_POST['userId'];
$review = $_POST['review'];

$sql1="SELECT * FROM usercoupons WHERE couponid='".$couponId."' and userid ='".$userId."'";
$res1=mysql_query($sql1);
$count=mysql_num_rows($res1);
if($count==1)
{
$query = "UPDATE `usercoupons` SET `review`='$review' WHERE `userid`='$userId' and `couponid`='$couponId'"; 
}
else
{
  $query = "INSERT INTO `usercoupons`(`couponid`, `userid`, `rating`, `favourite`, `review`) 
     VALUES ('$couponId','$userId','0','no','$review')";   
}
$res2=mysql_query($query);

  echo json_encode("Done");  
    
endif; 
?>
