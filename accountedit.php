<?php
ob_start();
include("config.php");
include('lock.php');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
 
 date_default_timezone_set("Asia/Calcutta");
 $todaydate = new DateTime();
 $currenttime = date_format($todaydate, 'H:i:s d:m:Y');  
    
 
 $fullname = $_POST['fullname']; 
 $bankname = $_POST['bankname'];
 $bankaddress = $_POST['bankaddress'];
 $accountnumber = $_POST['accountnumber'];
 $accounttype = $_POST['accounttype'];
 
 
 
 $sql="SELECT * FROM accountdetails WHERE merchantid ='".$_SESSION['login_user']."' ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1)
{
 $up = "UPDATE `accountdetails` SET  `lastupdated`='$currenttime',`fullname`='$fullname',
          `bankname`='$bankname',`bankaddress`='$bankaddress',
          `accountnumber`='$accountnumber',`accounttype`='$accounttype' WHERE `merchantid`='".$_SESSION['login_user']."'";
 $result=mysql_query($up);
 
}
else
{
     $insert = "INSERT INTO `accountdetails`(`merchantid`, `lastupdated`, `fullname`,
         `bankname`, `bankaddress`, `accountnumber`, `accounttype`) 
         VALUES ('".$_SESSION['login_user']."','$currenttime','$fullname','$bankname',
    '$bankaddress','$accountnumber','$accounttype') ";
 $result=mysql_query($insert);
   }
 

 
 $_SESSION['message']="Account Details Updated Successfully ";
   
 
}
 header("Location: AccountDetails.php"); 
   exit();
    
?>
