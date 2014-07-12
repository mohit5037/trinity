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
                 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    
<?php
//get sales in maximum order
echo "<span style='color:blue;margin-left:300px;'></span>";




 $query2 = "SELECT * FROM `categories` WHERE 1 ";
                $coupons2 = mysql_query($query2);
                $dataArray[][] = array ();
                $i=0;
                while($row2 = mysql_fetch_array($coupons2))
      {
             $categorymaintable = $row2['tablename']."maincoupons";
             $categoryname = $row2['category'];       
                    
             $live = "SELECT * FROM `$categorymaintable` WHERE `merchantid`='".$_SESSION['login_user']."'";
                $livec = mysql_query($live);
                
                while($rowlive = mysql_fetch_array($livec))
            {
                    $i++;
                    $moneyearned = $rowlive['price']*$rowlive['personsbought'];
                    
                     $dataArray[$i][0] = $moneyearned;
                    $dataArray[$i][1] = $rowlive['name'];
                   
                    
                
            }
            
            
      }
      
    
rsort($dataArray);

 echo "<script type='text/javascript'>
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Total Sale']";
 for($j=0;$j<$i & $j< 10 ;$j++)
         echo ",['".$dataArray[$j][1]."',  ".$dataArray[$j][0]."]";
         
       echo " ]);
        var options = {
          title: 'Comparative Sale of Top 10 Live Coupons',
          is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      } 
</script>";   

$x1 = "couponxyz";
$x = 25;


?>
                 
                 
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      
      google.setOnLoadCallback(drawChart1);
      function drawChart1() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Sales'],
          ['15th April',  200],
          ['16th April',  400],
          ['17th April',  100],
          ['18th April',  10],
          ['19th April',  660],
          ['20th April',  730],
          ['21st April',  660],
          ['22nd April',  100],
          ['23rd April',  1200],
          ['24th April',  140],
          ['25th April',  1100],
          ['26th April',  1300],
          ['27th April',  1200],
          ['28th April',  400],
          ['29th April',  250]
        ]);

        var options = {
          title: 'Company Performance',
          hAxis: {title: 'Day', titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
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
        <body style="background-color: white;">

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
								<li><a href="CreateDeal.php"><span class="fa fa-clock-o">Create A Deal</span></a></li>
								<li><a href="Transactions.php" ><span class="fa fa-dollar">Transactions</span></a></li>
							<li><a href="Analytics.php" class="active"><span class="fa fa-calendar">Analytics</span></a></li>
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
			<section id="analytics" class="two" >
						<div class="container">
					
							<header>
								<h2>Analytics</h2>
                                                             
							</header>
						
							

						</div>
                            
                          
					</section>

                            
		 <div id="piechart_3d" style="width: 1060px; height: 500px;background-color: black"></div>
                     
                  <div id="chart_div" style="width: 1060px; height: 500px;"></div>	
			
			</div>

	

	</body>
</html>