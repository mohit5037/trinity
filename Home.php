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
                                                            <li><a href="Home.php" class="active"><span class="fa fa-home">Dash Board</span></a></li>
								<li><a href="HowItWorks.php"><span class="fa fa-th">How It Works</span></a></li>
								<li><a href="CreateDeal.php"><span class="fa fa-clock-o">Create A Deal</span></a></li>
								<li><a href="Transactions.php" ><span class="fa fa-dollar">Transactions</span></a></li>
							<li><a href="Analytics.php" ><span class="fa fa-calendar">Analytics</span></a></li>
							
                                                        
                                                        <li><a href="AccountDetails.php"><span class="fa fa-lock">Account Details</span></a></li>
                                                        
                                                        
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
			<section id="home" class="two" >
						<div class="container">
					
							<header>
								<h2>DashBoard</h2>
							</header>
							
							<p></p>
						
							

						</div>
					</section>

				
			
			</div>

	

	</body>
</html>