<?php
ob_start();
include("config.php");
include('lock.php');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    echo "here";
  date_default_timezone_set("Asia/Calcutta");
 $todaydate = new DateTime();
 $currenttime = date_format($todaydate, 'H:i:s d:m:Y');   
  
 
 
 $couponid = $_POST['couponid'];  
$categoryname = $_POST['categorytable'];

$categorymaintable = "main_coupons";
 $categorydeadtable = "dead";
 
 
 $q = "SELECT * FROM `main_coupons` WHERE `merchant_id`='".$_SESSION['merchant_id']."' and `id`='".$couponid."'";
 $result=mysql_query($q);
$rowq=mysql_fetch_array($result);

$count=mysql_num_rows($result);
 
 
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
    {
  //$validfromdate = new DateTime($rowq['validfrom']); 
 
 //$interval = $validfromdate->diff($todaydate);
 //$daysalive = $interval->format('%a');  
 // echo "days alive:". $daysalive;  
    
   $insert =    "INSERT INTO `dead`
           (`id`,`cat_id`,`merchant_id`, `name`, `description`, `approved_date`, 
           `valid_from`, `valid_to`, `image`, `price`, `delete_date`)
           VALUES ('".$couponid."','".$rowq['cat_id']."','".$_SESSION['merchant_id']."','".$rowq['name']."','".$rowq['description']."',
               '".$rowq['approved_date']."','".$rowq['valid_from']."',
           '".$rowq['valid_to']."','".$rowq['image']."','".$rowq['price']."','".$currenttime."' )";
   
   $insertinfo = mysql_query($insert);
   
   
    }
 
 
 
 
 
 $query2 = "DELETE FROM `main_coupons` WHERE `merchant_id`='".$_SESSION['merchant_id']."' and `id`='".$couponid."'";
$deletecoupon = mysql_query($query2);
 
 $_SESSION['message']="Coupon is moved to dead coupons successfully.";
   
 
}
 header("Location: Transactions.php"); 
   exit();
    
?>
