<?php
$connection = mysql_connect("localhost","root") or die("nahi hoya!");
$db = mysql_select_db("recommender3") or die("database kehnda nahi");
$d=3;
$min_constant=100000;
$number_of_categories = 14; // used to find categories interest of users
$number_of_last_transactions = 10;
$number_of_sc = 15;
$gender_disadvantage_weight = 0;
$gender_advantage_weight = 1.3;
$age_group_advantage_weight = 1.1;


// feed coupon id and user id for new transaction here
//coupon_id=33;
//$user_id=1;


?>