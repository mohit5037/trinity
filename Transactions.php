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
		<title>iCoupons Merchant</title>
        <link rel="shortcut icon" href="images\ilogo.png"> 
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
                            <span class="image avatar48"><img src="images/ilogo.png" alt="" /></span>
                            <h1 id="title">iCoupons Merchant</h1>
                        </div>

					<!-- Nav -->
						<nav id="nav">
							
							<ul>
                                                            <li><a href="Home.php" ><span class="fa fa-home">Dash Board</span></a></li>
								<li><a href="HowItWorks.php" ><span class="fa fa-th">How It Works</span></a></li>
								<li><a href="CreateDeal.php" ><span class="fa fa-clock-o">Create A Deal</span></a></li>
								<li><a href="Transactions.php" class="active"><span class="fa fa-dollar">Transactions</span></a></li>
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
        <li id="tabHeader_1">Live Coupons</li>
        <li id="tabHeader_2">Dead Coupons</li>
        <li id="tabHeader_3">Approved Coupons</li>
        <li id="tabHeader_4">Premature Coupons</li>
      </ul>
    </div>
    <div id="tabscontent">
      <div class="tabpage" id="tabpage_1">
       
           <table id="gradient-style" name="contenttable" >			
			<thead>
				<tr>
                                    <th>Image</th>
					<th>Coupon Name</th>
                                        <th>Category</th>
                                        <th>Price (INR)</th>
					<th>Description</th>
					<th>Approval Date</th>
                                        <th>Valid From</th>
                                        <th>Valid To</th>
                                        <th>No of Transactions</th>
                                        <th>Total Sale (INR)</th>
                                        <th></th>
                                      
				</tr>
			</thead>
			<tbody>
                
			<?php 
            
                    
             $live = "SELECT * FROM `main_coupons` WHERE `merchant_id`='".$_SESSION['merchant_id']."'";
                $livec = mysql_query($live);
                while($rowlive = mysql_fetch_array($livec))
            {
                   $categoryid  = $row2['cat_id'];
                    $sql="SELECT * FROM categories WHERE id='$categoryid' ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

$count=mysql_num_rows($result);
if($count==1)
    {   
        $categoryname=$row['name'];   
    } 
                    
                    
                    
                    $moneyearned = "**NA";
             ?>
              <tr>
                        <form name="couponform" id="couponform" action="deletelive.php" method="post" >
              <td>
    <img src="uploads/<?php echo $rowlive['image']; ?>" 
         style ="width: 70px;height: 60px;border-color: blue;border-width: 3px;" alt="Coupon Image"/>
            </td>
                            <td><?php echo $rowlive['name']; ?></td>
                            <td><?php echo $categoryname; ?></td>
                            <td><?php echo $rowlive['price']; ?></td>
                            <td><?php echo $rowlive['description']; ?></td>
                            <td><?php echo $rowlive['approved_date']; ?></td>
                            <td><?php echo $rowlive['valid_from']; ?></td>
                            <td><?php echo $rowlive['valid_to']; ?></td>
                            <td><?php echo "**NA"; ?></td>
                            <td><?php echo $moneyearned; ?></td>
                            <td>
                                <input type="submit" value="Disable it" class="myButton" >
                                <input type="text" name="couponid" value="<?php echo $rowlive['id'];  ?>" style="display: none;"/>
                            <input type="text" name="categorytable" value="<?php echo $categoryname;  ?>" style="display: none;"/>
                            </td>
                        </form>
                            </tr>
           <?php         
            }             
                        
                      

                        ?>
                          
			</tbody>
		</table>      
          
          
          
      </div>
        <div class="tabpage" id="tabpage_2">
           
          <table id="gradient-style" name="contenttable" >			
			<thead>
				<tr>
                                    <th>Image</th>
					<th>Coupon Name</th>
                                        <th>Category</th>
                                        <th>Price (INR)</th>
					<th>Description</th>
					<th>Approval Date</th>
                                        <th>Valid From</th>
                                        <th>Valid To</th>
                                        <th>Disable Date</th>
                                        <th>No of Transactions</th>
                                        <th>Total Sale (INR)</th>
                                        <th></th>
                                      
				</tr>
			</thead>
			<tbody>
                
			<?php 
       
             $dead = "SELECT * FROM `dead` WHERE `merchant_id`='".$_SESSION['merchant_id']."'";
                $deadc = mysql_query($dead);
                while($rowdead = mysql_fetch_array($deadc))
            {
                         $categoryid  = $row2['cat_id'];
                    $sql="SELECT * FROM categories WHERE id='$categoryid' ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

$count=mysql_num_rows($result);
if($count==1)
    {   
        $categoryname=$row['name'];   
    } 
                    
                    
                    $moneyearned = "**NA";
             ?>
              <tr>
                        <form name="couponform" id="couponform" action="deletedead.php" method="post" >
              <td>
    <img src="uploads/<?php echo $rowdead['image']; ?>" 
         style ="width: 70px;height: 60px;border-color: blue;border-width: 3px;" alt="Coupon Image"/>
            </td>
                            <td><?php echo $rowdead['name']; ?></td>
                            <td><?php echo $categoryname; ?></td>
                            <td><?php echo $rowdead['price']; ?></td>
                            <td><?php echo $rowdead['description']; ?></td>
                            <td><?php echo $rowdead['approved_date']; ?></td>
                            <td><?php echo $rowdead['valid_from']; ?></td>
                            <td><?php echo $rowdead['valid_to']; ?></td>
                            <td><?php echo $rowdead['delete_date']; ?></td>
                            <td><?php echo "**NA"; ?></td>
                            <td><?php echo $moneyearned; ?></td>
                            <td>
                                <input type="submit" value="Delete" class="myButton" >
                                <input type="text" name="couponid" value="<?php echo $rowdead['id'];  ?>" style="display: none;"/>
                            <input type="text" name="categorytable" value="<?php echo $categoryname;  ?>" style="display: none;"/>
                            </td>
                        </form>
                            </tr>
           <?php         
            }             
                        
                       

                        ?>
                          
			</tbody>
		</table>        
            
            
            
            
            
            
        </div> 
         <div class="tabpage" id="tabpage_3">
         <table id="gradient-style" name="contenttable" >			
			<thead>
				<tr>
                                    <th>Image</th>
					<th>Deal Name</th>
                                        <th>Category</th>
                                        <th>Price(INR)</th>
					<th>Description</th>
					<th>Approved Date</th>
                                        <th>Valid From</th>
                                        <th>Valid To</th>
                                        <th></th>
                                      
				</tr>
			</thead>
			<tbody>
                
			<?php 
                        
                        $query2 = "SELECT * FROM `approved` WHERE `merchant_id`='".$_SESSION['merchant_id']."'";
                $coupons2 = mysql_query($query2);
                while($row2 = mysql_fetch_array($coupons2))
{
                    $categoryid  = $row2['cat_id'];
                    $sql="SELECT * FROM categories WHERE id='$categoryid' ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

$count=mysql_num_rows($result);
 $categoryname="";
 
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
    {   
        $categoryname=$row['name'];   
    }
                    
                    
                        ?>
                            <tr>
                        <form name="couponform" id="couponform" action="deleteapproved.php" method="post" >
              <td>
    <img src="uploads/<?php echo $row2['image']; ?>" 
         style ="width: 70px;height: 60px;border-color: blue;border-width: 3px;" alt="Coupon Image"/>
            </td>
                            <td><?php echo $row2['name']; ?></td>
                            <td><?php echo $categoryname; ?></td>
                            <td><?php echo $row2['price']; ?></td>
                            <td><?php echo $row2['description']; ?></td>
                            <td><?php echo $row2['approved_date']; ?></td>
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
        <div class="tabpage" id="tabpage_4">
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