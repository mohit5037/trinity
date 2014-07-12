<?php
ob_start();
include("config.php");
include('lock.php');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
 $couponid = $_POST['couponid'];  


 
 $query2 = "DELETE FROM `premature` WHERE  `id`='".$couponid."'";
 $shifts2 = mysql_query($query2);
 
 $_SESSION['message']="Coupon Delted Successfully.";
   
 
}
 header("Location: CreateDeal.php"); 
   exit();
    
?>
