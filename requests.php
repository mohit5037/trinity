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
		
                
                <script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
                
                
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
		</noscript>
                
                
                <style type="text/css">
                    
                    
                    
                </style>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
	</head>
	<body>

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
								<li><a href="HowItWorks.php" ><span class="fa fa-th">How It Works</span></a></li>
								<li><a href="CreateDeal.php" ><span class="fa fa-clock-o">Create A Deal</span></a></li>
								<li><a href="Transactions.php" ><span class="fa fa-dollar">Transactions</span></a></li>
							<li><a href="Analytics.php" ><span class="fa fa-calendar">Analytics</span></a></li>
                                                        <li><a href="AccountDetails.php" ><span class="fa fa-lock">Account Details</span></a></li>
                                                   <?php     
                                                      if(0 == (strcmp($_SESSION['user_type'],"admin")))
               {   ?>
                                                        <li><a href="requests.php" class="active"><span class="fa fa-coffee">Requests</span></a></li>
                                                          
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
			<section id="howitworks" class="two" >
						<div class="container">
					
							<header>
								<h2>Transactions</h2>
                                          
							</header>
                                            
              
	</section>
  
 <div> 
                                              
                                                      
                                                
						  <?php  if(isset($_SESSION['message']))
    {
             echo $_SESSION['message'];
             unset ($_SESSION['message']);
            }
?>
            <div id="tabContainer">
    <div id="tabs">
      <ul>
        <li id="tabHeader_1">Premature Coupons</li>
        <li id="tabHeader_2">Merchant User Requests</li>
        <li id="tabHeader_3">Customer App Requests</li>
       <li id="tabHeader_4">Approved Merchants</li>
      </ul>
    </div>
    <div id="tabscontent">
      <div class="tabpage" id="tabpage_1">
       
    <table id="gradient-style" name="contenttable" >			
			<thead>
				<tr>
                                    <th>Image</th>
					<th>Deal Name</th>
                                        <th>Category</th>
                                        <th>Price (INR)</th>
					<th>Description</th>
					<th>Create Date</th>
                                        <th>Valid From</th>
                                        <th>Valid To</th>
                                         <th>Priority</th>
                                        <th></th>
                                      
				</tr>
			</thead>
			<tbody>
                
			<?php 
                        
                        $query2 = "SELECT * FROM `premature` WHERE 1";
                $coupons2 = mysql_query($query2);
                $count=0;
                while($row2 = mysql_fetch_array($coupons2))
{
              $count=1;      
                    $categoryid  = $row2['cat_id'];
                    $sql="SELECT * FROM categories WHERE id='$categoryid' ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

$count=mysql_num_rows($result);
if($count==1)
    {   
        $categoryname=$row['name'];   
    }
                    
                    
                        ?>
                            <tr>
                       
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
                            <form name="couponform" id="couponform" action="approvepremature.php" method="post"style="display: inline" >     
                            <td>
                                <select style="max-width: 70px" name="priority">
                                    <option value="1">1 Min</option>  
                                    <option value="2">2</option>
                                    <option value="3">3 Average</option>
                                    <option value="4">4</option>
                                    <option value="5">5 Highest</option>
                                </select></td>
                            <td>
                                 <input type="submit" value="Delete" name="Delete" class="myButton" >
                                <input type="text" name="couponid" value="<?php echo $row2['id'];  ?>" style="display: none;"/>
                                <input type="submit" value="Approve" name="Approve" class="myButton" >
                              <input type="text" name="couponid" value="<?php echo $row2['id'];  ?>" style="display: none;"/>
                           
                                 </td>
                        </form>
                            </tr>
         <?php 
}
if($count==0)echo "No New Coupon For Approval !";
         ?>                   
			</tbody>
		</table>        
      </div>
        <div class="tabpage" id="tabpage_2">
           
           
               <?php
          
          //check if user is admin type
          
              $query2 = "SELECT * FROM `merchantusers` WHERE approved = 'no'";
                $calls2 = mysql_query($query2);
                $count = mysql_num_rows($calls2);
if($count==0)
{
    echo "<h3 style='color:green'>No New Request for Registration !</h3>";  
}
else
{
 
    
    
    ?>


<table id="gradient-style">
     <thead>
 <tr>
 <th>Sr. No</th>
<th>Business</th>
 <th>Category</th>
 <th>Name</th>
 <th>Contact Details</th>
 <th>Request Time</th>
 
 <th></th>
  </tr>
 </thead> 
     <tbody> <br>
<?php 
$i=1;
while($row2 = mysql_fetch_array($calls2))
{
  ?>  

    
<tr>
 <form name="form1" method="post" action="ProcessMerchantRequests.php"  
      style="margin-top: 5px; width: 100%;position: relative;" >
 
 <td> <?php echo $i; ?>
     <input type="text" name="merchantid" value="<?php echo $row2['merchantid']; ?>" style="display: none;" />
     </td>
  <td><?php echo $row2['businessname']; ?></td>
   <td><?php echo $row2['merchantbusinesscategory']; ?></td>
    <td> <?php echo $row2['merchantfirstname']." ".$row2['merchantlastname']; ?></td>
     <td><?php echo "Email:".$row2['businessemail']." <br>Phone:"
     .$row2['businessphone']." <br>Address:".$row2['merchantaddress']; ?></td>
     <td><?php echo $row2['requesttime']; ?></td>
  <td>
      <input name='reject'  type='submit' id='delete' value='Reject' class="myButton"/>
      <input name='accept' type='submit' id='accept' value='Approve' class="myButton" /></td>
  
  <?php 
   $i++;
   ?>
   </form>
  </tr>
             <?php
} ?>
</tbody></table>
<?php 
          } 
          ?>
            
            
            
            
            
            
        </div> 
        
         <div class="tabpage" id="tabpage_3">
           
           
               <?php
          
          //check if user is admin type
          
              $query2 = "SELECT * FROM `userrequests` WHERE 1";
                $calls2 = mysql_query($query2);
                $count = mysql_num_rows($calls2);
if($count==0)
{
    echo "<h3 style='color:green'>No New Request for Registration !</h3>";  
}
else
{
 
    
    
    ?>


<table id="gradient-style">
     <thead>
 <tr>
 <th>Sr. No</th>
<th>Name</th>
 <th>Account Number</th>
 <th>Atm Pin</th>
 <th>Email</th>
 <th>Age Group</th>
 <th>Gender</th>
 <th>Request Time </th>
 
 <th></th>
  </tr>
 </thead> 
     <tbody> <br>
<?php 
$i=1;
while($row2 = mysql_fetch_array($calls2))
{
  ?>  

    
<tr>
 <form name="form1" method="post" action="ProcessCustomerRequests.php"  
      style="margin-top: 5px; width: 100%;position: relative;" >
 
 <td> <?php echo $i; ?>
     <input type="text" name="customerid" value="<?php echo $row2['requestid']; ?>" style="display: none;" />
     </td>
  <td><?php echo $row2['firstname'].' '.$row2['lastname']; ?></td>

     <td><?php echo $row2['accountnumber']; ?></td>
     <td><?php echo $row2['pin']; ?></td>
        <td><?php echo $row2['email']; ?></td>
         <td><?php echo $row2['age']; ?></td>
        <td><?php echo $row2['gender']; ?></td>
        <td> <?php echo $row2['requesttime']; ?></td>
  <td>
      <input name='reject'  type='submit' id='delete' value='Reject' class="myButton"/>
      <input name='accept' type='submit' id='accept' value='Approve' class="myButton" /></td>
  
  <?php 
   $i++;
   ?>
   </form>
  </tr>
             <?php
} ?>
</tbody></table>
<?php 
          } 
          ?>
            
            
            
            
            
            
        </div> 
         
   <div class="tabpage" id="tabpage_4">
          
         

<table id="gradient-style">
     <thead>
 <tr>
 <th>Sr. No</th>
 <th>Merchant Id</th>
<th>Business</th>
 <th>Category</th>
 <th>Name</th>
 <th>Contact Details</th>
 <th>Last Login</th>
 <th></th>
  </tr>
 </thead> 
     <tbody> <br>
        <?php 
        $que = "SELECT * FROM `merchantusers` WHERE approved = 'yes'";
                $users = mysql_query($que);
           $i=1;
while($row2 = mysql_fetch_array($users))
{    
        ?>     
        <tr>
  <form name="formexistingusers" method="post" action="UpdateMerchant.php"  
      style="margin-top: 5px; width: 100%;position: relative;" >
 
 <td> <?php echo $i; ?>
 <input type="text" name="merchantid2" value="<?php echo $row2['merchantid']; ?>" style="display: none;" />
</td>
   <td><?php echo $row2['merchantusername']; ?></td>
  <td><?php echo $row2['businessname']." <br>Locations:".$row2['merchantlocations']; ?></td>
   <td><?php echo $row2['merchantbusinesscategory']; ?></td>
    <td> <?php echo $row2['merchantfirstname']." ".$row2['merchantlastname']; ?></td>
     <td><?php echo "Email: ".$row2['businessemail']." <br>Phone:".$row2['businessphone']
     ." <br>Address:".$row2['merchantaddress']." Zip:".$row2['businesszip']; ?></td>
    
  <td><?php echo $row2['lastlogin']; ?></td>
     <td>
      <?php if(0 != (strcmp($row2['usertype'],"admin")))  { ?>
         <input name='delete' type='submit' id='delete' value='Delete'  class="myButton" />
    <?php }
    else { ?> 
      
      <img src="adminIcon.ico"  height="30px" width="30px"/>
      <?php } ?>
</td>
  
  <?php 
   $i++;
   ?>
   </form> 
  </tr>
             <?php
} ?>
</tbody></table>
          
          
         
             
             
      </div>      
    </div>
  </div>              
							

						</div>
                                                              
                            
                            
			</div>

	<script src="tabs_old.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1332079-8']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

	</body>
</html>