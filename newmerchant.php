<?php
ob_start();
 include("config.php");
 date_default_timezone_set("Asia/Calcutta");

 session_start();
 
 if(isset($_SESSION['login_user']))
    {
    
 $user_check=$_SESSION['login_user'];
 
$ses_sql=mysql_query("select merchantusername from merchantusers where merchantusername='$user_check' ");
 
$row=mysql_fetch_array($ses_sql);
 
$login_session=$row['merchantusername'];
if(isset($login_session))
    {
         header("Location: Home.php");
       
          $error= "user loged in : ".$login_session;
    }
    }
 
    //$_SESSION['login_user']='sourab2012@gmail.com';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from Form
  
    //check is request for signup or signin
    if(!isset($_POST['signup']))
        {
        $myusername=addslashes($_POST['username']);
        $mypassword=addslashes($_POST['password']);
 
$sql="SELECT * FROM merchantusers WHERE merchantusername='$myusername' and merchantpassword='$mypassword' and approved = 'yes' ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

$count=mysql_num_rows($result);
 
 
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
    {
       
        $_SESSION['login_user']=$myusername;
        $_SESSION['user_type']=$row['usertype'];
        $_SESSION['merchant_id']=$row['merchantid'];
        
        $currenttime1 = new DateTime();
         $timestring1 = date_format($currenttime1 , 'Y-m-d H:i:s');
        
        $sqlquery1 ="UPDATE `merchantusers` SET `lastlogin`='$timestring1' WHERE merchantusername='$myusername'";
 $retvalupdate = mysql_query( $sqlquery1);
 
 $error="Login Successful";

        header("location: Home.php");
     
    }
else
    {
        $error="Your Email or Password is invalid, Please Try Again !";
    }      
        }
        else
        {
            $businessname=addslashes($_POST['businessname']);
            $businessphone=addslashes($_POST['businessphone']);
            $businessemail=addslashes($_POST['businessemail']);
            $businesszip=addslashes($_POST['businesszip']);
            $firstname=addslashes($_POST['firstname']);
            $lastname=addslashes($_POST['lastname']);
            $numberphysicallocations=addslashes($_POST['numberphysicallocations']);
            $businesscategory=addslashes($_POST['businesscategory']);
            $businessaddress=addslashes($_POST['businessaddress']);
            
            
               //check already requested
$sqlc="SELECT * FROM merchantusers WHERE businessemail='$businessemail'";
$resultc=mysql_query($sqlc);
$countc=mysql_num_rows($resultc);
// If result matched $myusername, table row must be 1 row
if(0 < $countc)
    {
$error= "You have already raised a request for signup with same Business Email, Please wait for approval !"; 
    }
    else
    {
         $currenttime = new DateTime();
         $timestring = date_format($currenttime , 'Y-m-d H:i:s');
      //insert new request  
       $sql = "INSERT INTO merchantusers 
       (businessname,businessphone, businessemail,
       businesszip,merchantfirstname,merchantlastname,
       merchantlocations,merchantbusinesscategory,
       merchantaddress,approved,requesttime)
       VALUES ('".$businessname."' ,'".$businessphone."' ,'".$businessemail."',
           '".$businesszip."','".$firstname."','".$lastname."',
               '".$numberphysicallocations."','".$businesscategory."',
                   '".$businessaddress."','no','$timestring')";

$retval = mysql_query( $sql);
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
$error = "Your request for registeration is submitted successfully, Please wait for approval !\n";
        
        
        
   
                 
             }
   
            
        }

}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>iCoupons Merchant</title>
        
        <link rel="shortcut icon" href="images\ilogo.png"> 
        <link rel="stylesheet" type="text/css" href="css/login/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/nmerchant/style3.css" />
	<link rel="stylesheet" type="text/css" href="css/login/animate-custom.css" />
    </head>
    <body>  
        <div id="top">
        <div class="inner">
                    
            <p id="social">
              Follow Us On
              <a href="http://www.facebook.com/pages/Concentric-Studio/102560892074?sk=wall" id="facebook" target="_blank">Facebook</a>
              <a href="http://twitter.com/WeAreConcentric" id="twitter" target="_blank">Twitter</a>
            </p>
        </div>
    </div>
        <div id="header">       
            <div id="topbar">
                <img src="images\ilogoweb.png" alt="Logo" height="150">
                
                <ul id="nav">
                    <li id="clients"><a href="http://concentric-studio.com/clients/"><span>Our Clients</span></a></li>
                    <li id="howitworks"><a href="http://concentric-studio.com/about/"><span>How it Works?</span></a></li>
                    <li id="getintouch"><a href="http://concentric-studio.com/getintouch/"><span>Get in Touch</span></a></li>
                    <li id="about"><a href="http://concentric-studio.com/about/"><span>About Us</span></a></li>

                </ul>
                </div>
        </div>
			
                <div id="parent">
                    <div id="slideshow-wrap">
                    <input type="radio" id="button-1" name="controls" checked="checked"/>
                    <label for="button-1"></label>
                    <input type="radio" id="button-2" name="controls"/>
                    <label for="button-2"></label>
                    <input type="radio" id="button-3" name="controls"/>
                    <label for="button-3"></label>
                    <input type="radio" id="button-4" name="controls"/>
                    <label for="button-4"></label>
                    <label for="button-1" class="arrows" id="arrow-1">></label>
                    <label for="button-2" class="arrows" id="arrow-2">></label>
                    <label for="button-3" class="arrows" id="arrow-3">></label>
                    <label for="button-4" class="arrows" id="arrow-4">></label>
                    <div id="slideshow-inner">
                        <ul>
                        <li id="slide1">
                        <img src="images\cover1.png" />
                        <div class="description">
                            <input type="checkbox" id="show-description-1"/>
                            <label for="show-description-1" class="show-description-label">I</label>
                            <div class="description-text">
                                <h2>Flower power</h2>
                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut</p>
                            </div>
                        </div>
                    </li>
                <li id="slide2">
                    <img src="images\cover2.png" />
                    <div class="description">
                        <input type="checkbox" id="show-description-2"/>
                        <label for="show-description-2" class="show-description-label">I</label>
                        <div class="description-text">
                            <h2>Golden sunset</h2>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut</p>
                        </div>
                    </div>
                </li>
                <li id="slide3">
                    <img src="images\cover31.png" />
                    <div class="description">
                        <input type="checkbox" id="show-description-3"/>
                        <label for="show-description-3" class="show-description-label">I</label>
                        <div class="description-text">
                            <h2>Flower power again</h2>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut</p>
                        </div>
                    </div>
                </li>
                <li id="slide4">
                    <img src="images\cover4.png" />
                    <div class="description">
                        <input type="checkbox" id="show-description-4"/>
                        <label for="show-description-4" class="show-description-label">I</label>
                        <div class="description-text">
                            <h2>Stormy coast</h2>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut</p>
                        </div>
                    </div>
                </li>
                
                </ul>
            </div>
        </div>
        <div id="small_parent">
        <div id="wrapper">

                        <div id="register" class="animate form">
                            <form  action="" autocomplete="on" method="post"> 
                            
                                <p> 
                                    <label for="businessname" class="" data-icon="u">Business Name</label>
                                    <input id="businessname" name="businessname" required="required" type="text" placeholder="Company Name" />
                                </p>
                                <p> 
                                    <label for="businesscategory" class="" data-icon="u" >Business Category</label>
                                    <input id="businesscategory" name="businesscategory" required="required"  placeholder="Entertainment"/> 
                                </p>
                                <p> 
                                    <label for="businessemail" class="youmail" data-icon="e" >Business Email</label>
                                    <input id="businessemail" name="businessemail" required="required" type="email" placeholder="mysupermail@mail.com"/> 
                                </p>
                               <p> 
                                    <label for="businessphone" class="" data-icon="e" >Business Phone</label>
                                    <input id="businessphone" name="businessphone" required="required"  placeholder="858789####"/> 
                                </p>
                                <p> 
                                    <label for="businesszip" class="" data-icon="e" >Zip Code</label>
                                    <input id="businesszip" name="businesszip" required="required"  placeholder="160014"/> 
                                </p>
                                <p> 
                                    <label for="firstname" class="uname" data-icon="u" >First Name</label>
                                    <input id="firstname" name="firstname" required="required"  placeholder="John"/> 
                                </p>
                                <p> 
                                    <label for="lasttname" class="uname" data-icon="u" >Last Name</label>
                                    <input id="lastname" name="lastname" required="required"  placeholder="Luther"/> 
                                </p>
                                <p> 
                                    <label for="numberphysicallocations" class="" data-icon="e" >Number of Locations</label>
                                    <input id="numberphysicallocations" name="numberphysicallocations" required="required"  placeholder="20"/> 
                                </p>
                                <p> 
                                    <label for="businessaddress" class="" data-icon="e" >Business Address</label>
                                    <input id="businessaddress" name="businessaddress" required="required"  placeholder="Street, Distt, State"/> 
                                </p>
                                <p class="signin button"> 
                                    <input  type="submit" name="signup" value="Sign up"/> 
								</p>
                                <p class="change_link">  
									Already a member ?
									<a href="index.php" class="to_register"> Go and log in </a>
								</p>
                            </form>
                        </div>
						</div>
                    </div>
                    </div>
            </body>
</html>
<?php

exit();

 
?>