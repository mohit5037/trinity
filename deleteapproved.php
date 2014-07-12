<?php
ob_start();
include("config.php");
include('lock.php');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
 $couponid = $_POST['couponid'];  


 
 $query2 = "DELETE FROM `approved` WHERE `merchant_id`='".$_SESSION['merchant_id']."' and `id`='".$couponid."'";
 $shifts2 = mysql_query($query2);
 
 $_SESSION['message']="Coupon Delted Successfully.";
   
 
}
 header("Location: Transactions.php"); 
   exit();
    
?>
