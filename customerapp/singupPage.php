<?php
include("../config.php");
	                      
if ($_POST['cardNumber']):
    $accountNumber = $_POST['cardNumber'];
   // $pin = $_POST['pin'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['signuppassword'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
     //insert
      date_default_timezone_set("Asia/Calcutta");
 $todaydate = new DateTime();
 $currenttime = date_format($todaydate, 'H:i:s d:m:Y'); 
 
 
    $sql="SELECT * FROM userrequests WHERE email ='$email'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
    {
//already raised requests
 echo "Request with Same Email Id is already registered with us, Please wait fo approval";
    }
    else
    {

   //update login time
 
 $query = "INSERT INTO `userrequests`(`accountnumber`, `firstname`, `lastname`, `email`, `password`, `requesttime`,`gender`,`age`) 
    VALUES ('$accountNumber','$firstName','$lastName','$email','$password','$currenttime','$gender','$age')";
    $res=mysql_query($query); 

echo "Your request for registration is submitted successfully, Please Wait for Approval.";
    }
    
    
    endif;
?>