<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include("config.php");
include('lock.php');

     $sql="SELECT * FROM merchantusers WHERE merchantusername='".$_SESSION['login_user']."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

$count=mysql_num_rows($result);
 
 
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
    {
        $_SESSION['password']=$row['merchantpassword'];
        
    }
      
      echo "<script type='text/javascript'> var password='".$_SESSION['password']."'; </script>";
   

?>
<html>
	<head>
		<title>iCoupons Merchant</title>
        <link rel="shortcut icon" href="images\ilogo.png"> 
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet" type="text/css" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" id="themeStyles" href="dialog.css"/>
                
                <script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
                 <script type="text/javascript" charset="utf-8" src="js/jquery.leanModal.min.js"></script>
                
		<noscript>
                
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
                
                
                <script type="text/javascript">
            function editaccount()
            {
              var fullname =  $("#fullname").val();
                        var bankname =  $("#bankname").val();
                        var bankaddress =  $("#bankaddress").val();
                        var accountnumber =  $("#accountnumber").val();
                        var accounttype =  $("#accounttype").val();
                        
                       
                         var flag = 1;
                         
                         if(fullname.length < 1)
                             {
                               flag = 0; 
                               document.getElementById('msgfullname').innerHTML="**";    
                             }
                             else
                                 {
                                   document.getElementById('msgfullname').innerHTML="";   
                                 }
               if(bankname.length < 1)
                             {
                               flag = 0; 
                               document.getElementById('msgbankname').innerHTML="**";    
                             }
                             else
                                 {
                                   document.getElementById('msgbankname').innerHTML="";   
                                 }
                                 
                                 
                                 
                                  if(bankaddress.length < 1)
                             {
                               flag = 0; 
                               document.getElementById('msgbankaddress').innerHTML="**";    
                             }
                             else
                                 {
                                   document.getElementById('msgbankaddress').innerHTML="";   
                                 }
                                 
                                 
                                  if(accountnumber.length < 1)
                             {
                               flag = 0; 
                               document.getElementById('msgaccountnumber').innerHTML="**";    
                             }
                             else
                                 {
                                   document.getElementById('msgaccountnumber').innerHTML="";   
                                 }
                                  if(accounttype.length < 1)
                             {
                               flag = 0; 
                               document.getElementById('msgaccounttype').innerHTML="**";    
                             }
                             else
                                 {
                                   document.getElementById('msgaccounttype').innerHTML="";   
                                 }
              if(flag== 1)
                  {
                     document.getElementById("accountdetails").submit();
                  }
              
              
              
            }
  
  var textbox1 = "";
        var textbox2 = "";
        var textbox3 = "";

   
        function saveTextBoxes() {
            textbox1 = $("#textbox1").val();
            textbox2 = $("#textbox2").val();
            textbox3 = $("#textbox3").val();
            
            var flag = 1;
             if(textbox1 != password)
                {
                    document.getElementById('old').innerHTML="<b style='color:red;'>*Incorrect</b>";
                 flag = 0;
                }
                else
                {
                    document.getElementById('old').innerHTML="<b style='color:green;'>*Correct</b>";
                 
                }
            
            if(textbox2.length < 8)
                {
                    document.getElementById('new').innerHTML="<b style='color:red;'>*Length should be atleast 8 characters</b>";
                 flag = 0;
                }
                else
                    {
                      document.getElementById('new').innerHTML="<b style='color:green;'>*Correct</b>";
                   
                    }
                    
            
            if(textbox2 != textbox3)
                {
                  document.getElementById('confirm').innerHTML="<b style='color:red;'>*Did not match New password</b>";
                 flag = 0;
                }
            
            if(flag == 1)
            {
                document.getElementById("passworddetails").submit();
               
            }
            
        }
            
            
            
            
            
            
            </script>
                
                
                
	</head>
	<body>

		<!-- Header -->
			<div id="header" class="skel-panels-fixed">

				<div class="top">

					<!-- Logo -->
						<div id="logo">
              <span class="image avatar48"><img src="images/ilogo.png" alt="" /></span>
              <h1 id="title">iCoupons Merchant</h1>
            </div>

					<!-- Nav -->
						<nav id="nav">
							
							<ul>
                                                            <li><a href="Home.php" ><span class="fa fa-home">Dash Board</span></a></li>
								<li><a href="HowItWorks.php"><span class="fa fa-th">How It Works</span></a></li>
								<li><a href="CreateDeal.php"><span class="fa fa-clock-o">Create A Deal</span></a></li>
								<li><a href="Transactions.php" ><span class="fa fa-dollar">Transactions</span></a></li>
							<li><a href="Analytics.php" ><span class="fa fa-calendar">Analytics</span></a></li>
                                                        <li><a href="AccountDetails.php" class="active"><span class="fa fa-lock">Account Details</span></a></li>
                                                          
                                                          <?php     
                                                      if(0 == (strcmp($_SESSION['user_type'],"admin")))
               {   ?>
                                                        <li><a href="requests.php" ><span class="fa fa-coffee">Requests</span></a></li>
                                                          
                                 <?php  }      ?>   
                                                        <li><a href="Logout.php"><span class="fa fa-user">Logout</span></a></li>
 
                                                        </ul>
						</nav>
						
				</div>
				
				<div class="bottom">

					<!-- Social Icons -->
						<ul class="icons">
							<li><a href="#" class="fa fa-twitter solo"><span>Twitter</span></a></li>
							<li><a href="#" class="fa fa-facebook solo"><span>Facebook</span></a></li>
							
						</ul>
				
				</div>
			
			</div>

		<!-- Main -->
			<div id="main">
			<section id="account" class="two" >
						<div class="container">
					
							<header>
								<h2>Account Details</h2>
                                                                
                                                                
                                                                
							</header>
							
							<p>
                                                           
                                                            
                                                            
                                                        </p>
		 <div style="position: relative;" >      <?php
                            
                $query = "SELECT * FROM `accountdetails` WHERE `merchantid`='".$_SESSION['login_user']."'";
                $account = mysql_query($query);
               $row=mysql_fetch_array($account);
            $count=mysql_num_rows($account);
 $fullname = "";
 $bankname = "";
 $bankaddress = "";
 $accountnumber = "";
 $accounttype = "";
 $lastupdated = "";
 
 
 $buttonname = "Add Details";
 $buttondialog = "Save";
if($count==1)
    {
     $buttonname = "Edit Details";
     
     
        $fullname =$row['fullname'];
         $bankname =$row['bankname'];
          $bankaddress =$row['bankaddress'];
           $accountnumber =$row['accountnumber'];
            $accounttype =$row['accounttype'];
             $lastupdated =$row['lastupdated'];     
    }
                            
                            ?>
                            
                                                  
						  <?php  if(isset($_SESSION['message']))
    {
             echo $_SESSION['message'];
             unset ($_SESSION['message']);
            }
?><br>                         
                            
<a href="#loginmodal"  id="modaltrigger"  class="myButton" style="display: inline;color: black;font-weight: bold">
    
   <?php echo $buttonname ;  ?> 
</a>
 <a href="#loginmodal2"  id="modaltrigger2"  class="myButton" style="display: inline;color: black;font-weight: bold">
 Change Password
</a>
 
                            
                            <div id="loginmodal" style="display:none;">
     <h1 style="text-align: center">Account Details</h1>
 <form id="accountdetails" name="accountform" method="post" action="accountedit.php" >
     
     <div class="formLayout">
        
        <label>Full Name:</label>
        <input id="fullname" name="fullname" type="text"  value="<?php echo $fullname ;  ?>"/><span id="msgfullname" style="color:red"></span> <br>
       <label>Bank Name:</label>
        <input id="bankname" name="bankname" type="text" value="<?php echo $bankname ;  ?>"/><span id="msgbankname" style="color:red"></span> <br>
       <label>Bank Address:</label>
        <input id="bankaddress" name="bankaddress" type="text" value="<?php echo $bankaddress ;  ?>"/><span id="msgbankaddress" style="color:red"></span> <br>
       <label>Account Number:</label>
        <input id="accountnumber" name="accountnumber" type="text" value="<?php echo $accountnumber ;  ?>"/><span id="msgaccountnumber" style="color:red"></span> <br>
       <label>Account Type:</label>
        <input id="accounttype" name="accounttype" type="text" value="<?php echo $accounttype ;  ?>"/><span id="msgaccounttype" style="color:red"></span> <br>
     
    </div> 
    
       <div class="center">
           <input type="button" name="dealcancelbutton"  class="flatbtn-blu hidemodal" value="Cancel"  onclick="window.location.href='AccountDetails.php'"/>
           <input type="button" name="dealsavebutton"  class="flatbtn-blu " value="<?php echo $buttondialog; ?>"  onclick="editaccount();"/>
       </div>
 </form>
  </div>
                            
                            
                            
                            
                            <div id="loginmodal2" style="display:none;">
     <h1 style="text-align: center">Change Password</h1>
 <form id="passworddetails" name="passwordform" method="post" action="changepassword.php" >
     
     <div class="formLayout">
        
        <label>Old Password:</label>
        <input id="textbox1" name="oldpassword" type="password"  value=""/>
        <span id="old" style="color:red"></span> <br>
       <label>New Password:</label>
        <input id="textbox2" name="newpassword" type="password" value=""/>
        <span id="new" style="color:red"></span> <br>
       <label>Confirm Password:</label>
        <input id="textbox3" name="confirmpassword" type="password" value=""/>
        <span id="confirm" style="color:red"></span> <br>
       
    </div> 
    
       <div class="center">
           <input type="button" name="dealcancelbutton"  class="flatbtn-blu hidemodal" value="Cancel"  onclick="window.location.href='AccountDetails.php'"/>
           <input type="button" name="dealsavebutton"  class="flatbtn-blu " value="Change Password"  onclick="saveTextBoxes();"/>
       </div>
 </form>
  </div>
                            
                            
		
                            <table id="gradient-style" name="contenttable" style="width: 50%">			
        <thead style="min-height: 100px">
            <tr style="min-height: 200px;">
                                    <th></th>
					<th></th>
</tr>
			</thead>
			<tbody>
                                            <tr>
                        
                                                <td style="text-align: left">Full Name</td>
                            <td style="text-align: left"><?php echo $fullname; ?></td>
                     </tr>
                                     <tr>
                        
                            <td style="text-align: left">Bank Name</td>
                            <td style="text-align: left"><?php echo $bankname; ?></td>
                     </tr>
                                     <tr>
                        
                            <td style="text-align: left">Bank Address</td>
                            <td style="text-align: left"><?php echo $bankaddress; ?></td>
                     </tr>
                                     <tr>
                        
                            <td style="text-align: left">Account Number</td>
                            <td style="text-align: left"><?php echo $accountnumber; ?></td>
                     </tr>
                                     <tr>
                        
                            <td style="text-align: left">Account Type</td>
                            <td style="text-align: left"><?php echo $accounttype; ?></td>
                     </tr>
                                 <tr>
                        
                            <td style="text-align: left">Last Updated</td>
                            <td style="text-align: left"><?php echo $lastupdated; ?></td>
                     </tr>
                  
			</tbody>
		</table>                         
                            
                       </div> 			 
							

						</div>
                            
	                            
                            
                            
                            
					</section>
                         
                                                        
			
			</div>

<script type="text/javascript">
$(function(){
  $('#loginform').submit(function(e){
    return false;
  });
  
  $('#modaltrigger').leanModal({ top: 30, overlay: 0.55, closeButton: ".hidemodal" });
   $('#modaltrigger2').leanModal({ top: 30, overlay: 0.55, closeButton: ".hidemodal" });
});
</script>

	</body>
</html>