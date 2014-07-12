<?php
ob_start();
include("config.php");
include('lock.php');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
 $oldpassword = $_POST['oldpassword'];  
 $newpassword = $_POST['newpassword'];
 $confirmpassword = $_POST['confirmpassword'];
 
 if( ($newpassword == $confirmpassword) && ($oldpassword==$_SESSION['password'])  )
 {
    $q = "UPDATE `merchantusers` SET `merchantpassword`='".$_POST['newpassword']."'  WHERE merchantusername='".$_SESSION['login_user']."'";
    $res = mysql_query($q); 
 $_SESSION['message']="Password has been changed successfully !";
       
 }
 else
 {
   $_SESSION['message']="Error in changing password, please try again";  
 }
 

   
 
}
 header("Location: AccountDetails.php"); 
    exit();
    
?>
