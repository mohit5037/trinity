<?php
include("../config.php");

if ($_POST['userid']):
    $userid = $_POST['userid'];
$password = $_POST['password'];

    $sql="SELECT * FROM users WHERE user_id ='$userid' and pw='$password'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
    {
    if(strlen($row['last_login'])==0)
    {
       echo json_encode("new");  
    }
    else
      {
      echo "old";  
    }  
    date_default_timezone_set("Asia/Calcutta");
 $todaydate = new DateTime();
 $currenttime = date_format($todaydate, 'H:i:s d:m:Y'); 
   //update login time
$query = "UPDATE `users` SET `last_login`='".$currenttime."' WHERE `user_id`='".$userid."'";
$res=mysql_query($query);
 
    }
    else
    {
     echo "fail";   
    }
    
    
    endif;
?>