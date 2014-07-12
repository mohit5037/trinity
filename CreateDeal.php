<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include("config.php");
include('lock.php');


   ?> 
<html>
	<head>
		<title>ICoupons Merchant</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet" type="text/css" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		
                <link rel="stylesheet" type="text/css" media="all" href="dialog.css">
                <link rel="stylesheet" href="css/datepicker.css" />
                <style type="text/css">
                    
.myButton {
	background-color:#e4685d;
	-moz-border-radius:18px;
	-webkit-border-radius:18px;
	border-radius:28px;
	border:1px solid #ffffff;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:arial;
	font-size:12px;
	padding:2px 12px;
	text-decoration:none;
	text-shadow:0px 1px 0px #b23e35;
        width: 80px;
        
}
.myButton:hover {
	background-color:#eb675e;
        color:white;
}
.myButton:active {
	position:relative;
	top:1px;
}
                </style>
                
                
                <script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
                 <script type="text/javascript" charset="utf-8" src="js/jquery.leanModal.min.js"></script>
  
                <script src="js/datepicker.js"></script>
                
                
                <script type="text/javascript" >
                    
                        function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
                    
                    
                    function savedeal()
                    {
                        
                        var dealnameval =  $("#dealname").val();
                        var dealdesciptionval =  $("#dealdescription").val();
                        var dealimageval =  $("#file").val();
                        var dealcategoryval =  $("#dealcategory").val();
                        var dealpriceval =  $("#dealprice").val();
                        
                        var dealfromval =  document.getElementsByName('dealfrom')[0].value;
                        var dealtoval =  document.getElementsByName('dealto')[0].value;
                        
                         var flag = 1;
                         
                         if(dealnameval.length < 1)
                             {
                               flag = 0; 
                               document.getElementById('msgdealname').innerHTML="**";    
                             }
                             else
                                 {
                                   document.getElementById('msgdealname').innerHTML="";   
                                 }
                                 
                        if(dealdesciptionval.length < 1)
                             {
                               flag = 0; 
                               document.getElementById('msgdealdescription').innerHTML="**";    
                             }
                             else
                                 {
                                   document.getElementById('msgdealdescription').innerHTML="";  
                                 }
                                 
                                
                               
                                
                       if(dealimageval.length < 1)
                             {
                               flag = 0; 
                               document.getElementById('msgdealimage').innerHTML="**";    
                             }
                             else
                                 {
                                   var ext = dealimageval.substring(dealimageval.lastIndexOf('.')+1);  
                                     
                                     //toLowerCase(ext);
                                     var check = 0;
                                     var extns = new Array(5) 

// Initialize the array values
extns[0] = "jpg";
extns[1] = "png";
extns[2] = "bmp";
extns[3] = "gif";
extns[4] = "jpeg";


                                     var i = 0;
                                     for(i=0;i<extns.length;i++)
      {
          
         if(ext==extns[i])
         {
            check = 0;
            break;
         }
         else
         {
            check = 1;
         }
      }
      if(check == 0)
          {
              flag = 1; 
             
             document.getElementById('msgdealimage').innerHTML=""; 
          }
           else
               {
                   flag = 0;
                   document.getElementById('msgdealimage').innerHTML="**";
               }
                                   
                                   
                                 } 
                        
                        
                        
                        if(dealcategoryval.length < 1)
                             {
                               flag = 0; 
                               document.getElementById('msgdealcategory').innerHTML="**";    
                             }
                             else
                                 {
                                    document.getElementById('msgdealcategory').innerHTML=""; 
                                 }
                           
                           
                           
                           if(dealpriceval.length < 1)
                             {
                               flag = 0; 
                               document.getElementById('msgdealprice').innerHTML="**";    
                             } 
                             else
                                 {
                                  document.getElementById('msgdealprice').innerHTML="";   
                                 }
                        
                       var today = new Date();
                        var dealfrom ;
                        var dealto ;    
                         
        today.setHours(0, 0, 0, 0);
                   
                     
                        
                        if(dealfromval.length < 1)
                             {
                                
                               flag = 0; 
                               document.getElementById('msgdealfrom').innerHTML="**";    
                             }
                             else
                                 {
                                     dealfrom = new Date(dealfromval);
                                      
                                     if(dealfrom < today  )
          {
             flag = 0; 
            document.getElementById('msgdealfrom').innerHTML="**";  
          }
          else
              {
               document.getElementById('msgdealfrom').innerHTML="";   
              }
              
                                 }
                              
                              
                              
                              
                              
                              if(dealtoval.length < 1)
                             {
                               flag = 0; 
                               document.getElementById('msgdealto').innerHTML="**";    
                             }
                             else
                                 {
                                     dealto = new Date(dealtoval);
                                    
                                             if(dealto < today  || dealto < dealfrom )
          {
             flag = 0; 
            document.getElementById('msgdealto').innerHTML="**";  
          }
          else
              {
                document.getElementById('msgdealto').innerHTML="";  
              }
                                    
                                 }
                            
         if(flag ==1)
             {
               document.getElementById("dealform").submit();  
             }
                        
                      
                    }
                    
                    
                     (function($) {
    $(document).ready(function () {
        
    /*  jQuery ready function. Specify a function to execute when the DOM is fully loaded.  */
$(document).ready(
  
  /* This is the function that will get executed after the DOM is fully loaded */
  function () {
    $( ".datepicker" ).datepicker({
      changeMonth: true,//this option for allowing user to select month
      changeYear: true, //this option for allowing user to select from year range
      dateFormat:"dd MM yy"
    });
    
    //$('#genderoptions').hide('fast');
    $('#yesgender').click( function() 
		  {
                    //alert('yes');
                    //$('#genderoptions').show('fast');
                    //$('#genderoptions').trigger('refresh');
                    //$("#genderoptions").css("display", "block");
                    //$('#genderoptions').removeAttr('disabled');
                  });
    $('#nogender').click( function() 
		  {
                    //alert('no');
                   // $('#genderoptions').hide('fast');
                    //$('#genderoptions').trigger('refresh');
                         //$("#genderoptions").css("display", "none");
                  });
    $('#yesage').click( function() 
		  {
                    //alert('yes');
                    //$('#ageoptions').show('fast');
                    //$('#ageoptions').trigger('refresh');
                        // $("#ageoptions").css("display", "block");
                         //$('#ageoptions').removeAttr('disabled');
                  });
    $('#noage').click( function() 
		  {
                    //alert('no');
                    //$('#ageoptions').hide('fast');
                    //$('#ageoptions').trigger('refresh');
                    //$("#ageoptions").css("display", "none");
                  });
  }

);       
    }); //END READY
})(jQuery); 
 
 function clearall()
 {
   
    
        
        document.getElementById('dealname').value = '';
        document.getElementById('dealdescription').value = '';
        document.getElementById('dealcategory').value = '';
        document.getElementById('file').value = '';
        document.getElementById('dealprice').value = '';
        document.getElementById('dealfrom').value = '';
        document.getElementById('dealto').value = '';
       
               
 }
 function deleterow()
 {
      document.getElementById("couponform").submit();
     
 }
 
 
 
 
</script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
	</head>
        <body style="min-height: 600px">

		<!-- Header -->
			<div id="header" class="skel-panels-fixed">

				<div class="top">

					<!-- Logo -->
						<div id="logo">
							<span class="image avatar48"><img src="images/avatar.jpg" alt="" /></span>
							<h1 id="title">ICoupons MERCHANT</h1>
							<span class="byline">Description Here</span>
						</div>

					<!-- Nav -->
						<nav id="nav">
							
							<ul>
                                                            <li><a href="Home.php" ><span class="fa fa-home">Dash Board</span></a></li>
								<li><a href="HowItWorks.php"><span class="fa fa-th">How It Works</span></a></li>
								<li><a href="CreateDeal.php" class="active"><span class="fa fa-clock-o">Create A Deal</span></a></li>
								<li><a href="Transactions.php" ><span class="fa fa-dollar">Transactions</span></a></li>
							<li><a href="Analytics.php" ><span class="fa fa-calendar">Analytics</span></a></li>
                                                        <li><a href="AccountDetails.php" ><span class="fa fa-lock">Account Details</span></a></li>
                                                          
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
 <div id="pagecontent" style="width: 100%; padding-left: 5px;padding-right: 5px;padding-bottom: 200px;height: 100%;" > 
                      
 <?php 
 //echo  "Doc root: ".$_SERVER['DOCUMENT_ROOT']."/remindersoftware/uploads/";
     if($_SERVER["REQUEST_METHOD"] == "POST")
{
         
 $dealname = $_POST['dealname'];  
 $dealdescription = $_POST['dealdescription'];
 $dealprice = $_POST['dealprice'];
 $dealcategory = $_POST['dealcategory'];
 $dealfrom = $_POST['dealfrom'];
 $dealto = $_POST['dealto'];
 $merchantId = $_SESSION['merchant_id'];
 
 
 $gender = 'N';
 $genderselect  = $_POST['genderselect'];
 if($genderselect=='yes')
 {
  $gender = $_POST['genderoptions'];   
 }
 $age = 5;
 $ageselect  = $_POST['ageselect'];
 if($ageselect=='yes')
 {
  $age = $_POST['ageoptions'];   
 }
 
      
 date_default_timezone_set("Asia/Calcutta");
 $todaydate = new DateTime();
 $currenttime = date_format($todaydate, 'Y-m-d H:i:s');
 
 
  $currentday = date_format($todaydate, 'd-m-Y');
  
  $validDt = new DateTime($dealfrom);
  $validDay = date_format($validDt, 'd-m-Y');
  
  $validto = new DateTime($dealto);
 
      
  if(0 == (strcasecmp($validDay, $currentday)) )
  {
   $dealfrom =   date_format($validDt, 'Y-m-d').date_format($todaydate, ' H:i:s ');
  }
  else
  {
   $dealfrom =   date_format($validDt, 'Y-m-d').' 00:00:00 ';
  }
  
  $dealto = date_format($validto, 'Y-m-d').' 23:59:59';
 
   $ins = "INSERT INTO `premature`(`cat_id`, `merchant_id`, `name`, `description`, `create_date`, `valid_from`, `valid_to`,`price`,`age_group`,`gender` ) 
       VALUES ('$dealcategory','$merchantId','$dealname','$dealdescription','$currenttime','$dealfrom','$dealto','$dealprice','$age','$gender')";
      mysql_query($ins);       
    
       $lastId = mysql_insert_id() ;   
    //echo "last id: " . $lastId ;  
    
   
    
         
//upload file for same
         $allowedExts = array("png","jpg","jpeg","bmp","gif");
         
         //echo "<br>filename: ".$_FILES["file"]["tmp_name"]."<br>"; 
         
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);



 $imageName = "coupon".$lastId.".".$extension;
//echo "final name:".$imageName;

  $q = "UPDATE `premature` SET `image`='$imageName'
WHERE id='$lastId' and merchant_id ='$merchantId'";
  $res = mysql_query($q); 


  if ($_FILES["file"]["error"] > 0)
    {
    echo "Error in Uploading Image !<br>";
    }
  else
    {
    //echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    //echo "Type: " . $_FILES["file"]["type"] . "<br>";
    //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("uploads/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists on server. Please Rename Your file or delete previous One ! ";
      }
    else
      { 
      move_uploaded_file($_FILES["file"]["tmp_name"],"uploads/" . $imageName);     
    echo "<b >Coupon Added to Premature Pool successfully !</b>";   
      }
    }
 
         
         
}


 
            if(isset($_SESSION['message']))
    {
             echo $_SESSION['message'];
             unset ($_SESSION['message']);
            }
             


 ?>
           <br>

   
  <div id="loginmodal" style="display:none;">
    <h1 style="text-align: center">Coupon Info</h1>
    <form id="dealform" name="dealform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
     
     <div class="formLayout">
        
        <label>Coupon</label>
        <input id="dealname" name="dealname" type="text" /><span id="msgdealname" style="color:red"></span> <br>
        <label>Description</label>
        <input id="dealdescription" name="dealdescription" type="textarea"  /><span id="msgdealdescription" style="color:red"></span><br>
        
        <label>Image</label>
        <input type="file" name="file" id="file" />
        <span id="msgdealimage" style="color:red"></span><br>
        
        
        <label>Category</label>
       <select name="dealcategory" id="dealcategory">
           <option value="">Select Coupon Category</option>
         <?php               
           
             
            $q2 = "SELECT * FROM `categories`";
                $cat1 = mysql_query($q2);
                while($row23 = mysql_fetch_array($cat1))
{  
   ?>
  <option value="<?php echo $row23['id']; ?>"><?php echo $row23['name']; ?></option> 
  <?php
  }
  
  
  ?>


</select>
        <span id="msgdealcategory" style="color:red"></span><br>

  
         
        
        
        
       <label>Price INR</label>
       <input id="dealprice" name="dealprice" type="text"  onKeyUp='numericFilter(this);'/>
      <span id="msgdealprice" style="color:red"></span><br>
       <label>Valid From</label>
       
       <input type="text" name="dealfrom" class="datepicker" value="" id="dealfrom" readonly onchange="validatefrom()" />
       <span id="msgdealfrom" style="color:red"></span>
       <br>
       
        <label>Valid To</label>
        <input type="text" name="dealto" class="datepicker" value="" id="dealto" readonly onchange="" />
       <span id="msgdealto" style="color:red"></span>
       <br>
       
       
       
       
       
       <label style="width:auto;min-width: 175px">Gender Specific ?</label>
       <div style="width: 100%">
           <input type="radio"  name="genderselect" id="nogender" value="no" style="width:auto" checked/><label  style="width:auto" for="nogender">No</label>
           <input type="radio"  name="genderselect" value="yes" id="yesgender" style="width: auto"/><label style="width:auto" for="yesgender">Yes</label>
    </div>
       <span id="genderoptions"  style="width: auto;">
           <select name="genderoptions" style="width: auto;height: auto"  >
  <option value="M">Male</option>
  <option value="F">Female</option>
  </select>
           
       </span>
       <br>
       
       
       <label style="width:auto;min-width: 175px">Age Specific ?</label>
       <div style="width: 100%">
           <input type="radio"  name="ageselect" id="noage" value="no" style="width:auto" checked/><label  style="width:auto" for="noage">No</label>
           <input type="radio"  name="ageselect" value="yes" id="yesage" style="width: auto"/><label style="width:auto" for="yesage">Yes</label>
    </div>
       <span id="ageoptions" style="width: auto;">
       <select name="ageoptions" id="age" style="width: auto;height: auto"  >
    <option value="1">18-25</option>
    <option value="2">26-30</option>
    <option value="3">31-45</option>
    <option value="4">Above 45</option>
</select>     
       </span>
       
       
       <br>
       
    
       
       
       
       
    </div> 
    
       <div class="center">
           <input type="button" name="dealcancelbutton"  class="flatbtn-blu hidemodal" value="Cancel"  onclick="clearall();"/>
           <input type="button" name="dealsavebutton"  class="flatbtn-blu " value="Save"  onclick="savedeal()"/>
       </div>
 </form>
  </div>
<script type="text/javascript">
$(function(){
  $('#loginform').submit(function(e){
    return false;
  });
  
  $('#modaltrigger').leanModal({ top: 2, overlay: 0.55, closeButton: ".hidemodal" });
});
</script>                               
     
                                
                                
                                
                                
<h3>Premature Coupons</h3> <a href="#loginmodal" class="flatbtn" id="modaltrigger" style="display: inline">Create New Deal</a>
<table id="gradient-style" name="contenttable" >			
			<thead>
				<tr>
                                    <th>Image</th>
					<th>Deal Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
					<th>Description</th>
					<th>Create Date</th>
                                        <th>Valid From</th>
                                        <th>Valid To</th>
                                        <th></th>
                                      
				</tr>
			</thead>
			<tbody>
                
			<?php 
                        
                        $query2 = "SELECT * FROM `premature` WHERE `merchant_id`='".$_SESSION['merchant_id']."'";
                $coupons2 = mysql_query($query2);
                while($row2 = mysql_fetch_array($coupons2))
{
                    $categoryid  = $row2['cat_id'];
                    $sql="SELECT * FROM categories WHERE id='$categoryid' ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

$count=mysql_num_rows($result);
 
 
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
    {   
        $categoryname=$row['name'];   
    }
                    
                    
                        ?>
                            <tr>
                        <form name="couponform" id="couponform" action="deletepremature.php" method="post" >
              <td>
    <img src="uploads/<?php echo $row2['image']; ?>" 
         style ="width: 70px;height: 60px;border-color: blue;border-width: 3px;" alt="Coupon Image"/>
            </td>
                            <td><?php echo $row2['name']; ?></td>
                            <td><?php echo $categoryname; ?></td>
                            <td><?php echo $row2['price']; ?></td>
                            <td><?php echo $row2['description']; ?></td>
                            <td><?php echo $row2['create_date']; ?></td>
                            <td><?php echo $row2['valid_from']; ?></td>
                            <td><?php echo $row2['valid_to']; ?></td>
                            <td>
                                <input type="submit" value="Delete" class="myButton" >
                                <input type="text" name="couponid" value="<?php echo $row2['id'];  ?>" style="display: none;"/>
                            </td>
                        </form>
                            </tr>
         <?php 
}
         ?>                   
			</tbody>
		</table>         
                                
                                
                                
                            </div> 
                            
                            
                            
                            
                            
			</div>
                
                                
    
	</body>
</html>