<?php
ob_start();
include("config.php");
include('lock.php');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
 
 
 $couponid = $_POST['couponid'];  
$categorytable = $_POST['categorytable'];
$categorydeadtable = $categorytable."deadcoupons";

 $query2 = "DELETE FROM `dead` WHERE `merchant_id`='".$_SESSION['merchant_id']."' and `id`='".$couponid."'";
$deletecoupon = mysql_query($query2);
 
 $_SESSION['message']="Coupon deleted from the system successfully ";
   
 
}
 header("Location: Transactions.php"); 
   exit();
    
?>
