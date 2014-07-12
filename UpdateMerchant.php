<?php 
ob_start();
include("config.php");
 include('lock.php');
//database connection details

  if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $_SESSION['message']="";
 if(isset($_POST['admin']))
          {

$merchantid=$_POST['merchantid2'];


    
 $sql = "UPDATE `merchantusers` SET `usertype`='admin' 
    WHERE `merchantid`= '".$merchantid."'";
           mysql_query($sql);

$_SESSION['message']= "Merchant User has been Updated to Admin  !! ***"; 

      }
     else 
          {
          $merchantid=$_POST['merchantid2'];
            
          $sql = "Delete from merchantusers where merchantid ='".$merchantid."'";
           mysql_query($sql);
        $_SESSION['message']= "Merchant Deleted Successfully*** !!"; 
       
      }
      
    
}
header('Location: requests.php');
exit();

 
?>