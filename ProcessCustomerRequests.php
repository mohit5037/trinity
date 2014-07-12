<?php 
ob_start();
include("config.php");
 include('lock.php');
//database connection details

  if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $_SESSION['message']="";
  echo "here";
 if(isset($_POST['accept']))
          {
$customerid=$_POST['customerid'];
echo "here in accept ".$customerid;

$sqlc="SELECT * FROM userrequests WHERE requestid='".$customerid."'";
$resultc=mysql_query($sqlc);
$row=mysql_fetch_array($resultc);

date_default_timezone_set("Asia/Calcutta");
 $todaydate = new DateTime();
 $currenttime = date_format($todaydate, 'Y-m-d H:i:s');  

 $sql = "INSERT INTO `users`(`name`, `pw`, `card_number`, `create_date`,`last_login`,`other_details`,`gender`,`age_group`) VALUES
  ( '".$row['firstname']."  ".$row['lastname']."','".$row['password']."','".$row['accountnumber']."','".$currenttime."','','".$row['email']."','".$row['gender']."','".$row['age']."')";
 mysql_query($sql);


//here is userId
 $userId = mysql_insert_id() ; 
  

            
     //email code here       
$_SESSION['message']= "Request Approved Successfully, And mail has been sent to App User for same !! ***". $lastId; 


$sql1 = "Delete from userrequests where requestid ='".$customerid."'";
 mysql_query($sql1);
 
 
   //userId  is the id u need to call your function  with...
   //pls call your function here with userId variable 
 
 
 

      }
     else 
          {
          $merchantid=$_POST['merchantid'];
            
          $sql = "Delete from userrequests where requestid ='".$customerid."'";
            mysql_query($sql);
        $_SESSION['message']= "Request Rejected SuccessFully Email Sent*** !!"; 
       
      }
      
       
      
}
header('Location: requests.php');
exit();

 
?>