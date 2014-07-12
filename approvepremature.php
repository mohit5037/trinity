<?php
ob_start();
include("config.php");
include('lock.php');
include('recommendercode/approve.php');
include('recommendercode/config.php');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    
      if(isset($_POST['Delete']))
          {
                
 $couponid = $_POST['couponid'];
          
 $query2 = "DELETE FROM `premature` WHERE  `id`='".$couponid."'";
 $shifts2 = mysql_query($query2);
 
 $_SESSION['message']="Coupon Deleted Successfully.";
      }
    
      else
      {
          
           
 $couponid = $_POST['couponid'];  
$priority = $_POST['priority']; 

   
  date_default_timezone_set("Asia/Calcutta");
 $todaydate = new DateTime();
 $currenttime = date_format($todaydate, 'Y-m-d H:i:s');   
  

 
 
 $q = "SELECT * FROM `premature` WHERE `id`='".$couponid."'";
 $result=mysql_query($q);
$rowq=mysql_fetch_array($result);

$count=mysql_num_rows($result);
 
 
// If result matched if we have atleaor this
if($count==1)
    {
  
    //calling function with couponid and priority value
    $inserter= new inserter($couponid   , $d,   $priority  ,$min_constant);
    
    
    

   /*//not using this code now 
   $insert =    "INSERT INTO `approved`
           (`id`,`merchant_id`, `name`, `description`, `approved_date`, 
           `valid_from`, `valid_to`, `image`, `price`,`cat_id`)
           VALUES ('".$couponid."','".$rowq['merchant_id']."','".$rowq['name']."','".$rowq['description']."',
               '".$currenttime."','".$rowq['valid_from']."',
           '".$rowq['valid_to']."','".$rowq['image']."','".$rowq['price']."','".$rowq['cat_id']."')";
   
   //$insertinfo = mysql_query($insert);*/
   
   
    }
/*//not using this also
 $query2 = "DELETE FROM `premature` WHERE  `id`='".$couponid."'";
 //$shifts2 = mysql_query($query2);*/
 
 $_SESSION['message']="Coupon Approved Successfully.";
  
      }
    
  
 
}
 header("Location: requests.php"); 
  exit();
    
?>