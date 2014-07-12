<?php
include('config.php');
session_start();

if(isset($_SESSION['login_user']))
{
  $user_check=$_SESSION['login_user'];
 
$ses_sql=mysql_query("select merchantusername from merchantusers where merchantusername='$user_check' ");
 
$row=mysql_fetch_array($ses_sql);
 
$login_session=$row['merchantusername'];
 
if(!isset($login_session))
    {
         header("Location: index.php");
    }  
}
else
{
    header("Location: index.php");
}



?>