<?php 
ob_start();
include("config.php");
 include('lock.php');
//database connection details

  if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $_SESSION['message']="";
 if(isset($_POST['accept']))
          {

$merchantid=$_POST['merchantid'];

$sqlc="SELECT * FROM merchantusers WHERE merchantid='".$merchantid ."'";
$resultc=mysql_query($sqlc);
$row=mysql_fetch_array($resultc);

$finalUsername = $row['merchantfirstname'].$merchantid."@".$company;
$finalpassword = $row['merchantfirstname'].$merchantid;

    
  $sql = "UPDATE `merchantusers` SET `merchantusername`='".$finalUsername."',
      `merchantpassword`='".$finalpassword."',`approved`='yes',`usertype`='normal' 
      WHERE `merchantid`= '".$merchantid."'";
            mysql_query($sql);

            
     //email code here       
$_SESSION['message']= "Request Approved Successfully, And mail has been sent to Merchant for same !! ***"; 

      }
     else 
          {
          $merchantid=$_POST['merchantid'];
            
          $sql = "Delete from merchantusers where merchantid ='".$merchantid."'";
            mysql_query($sql);
        $_SESSION['message']= "Request Rejected SuccessFully Email Sent*** !!"; 
       
      }
      
       
      
}
header('Location: requests.php');
exit();

 
?>