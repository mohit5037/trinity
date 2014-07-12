<?php

/********************
hf_new.php 
Contains a function which is used to 
calculate the hf of a pair of coupons
*********************/

/*****************************
Arguments of function :-
Here Coupon_1 represents id of main coupon in main_coupons row
Here coupon_2 represents id of any similar coupon 


$sc_id = id of coupon_2
$valid_from = valid timestamp of coupon_1
$d = constant defined in config.php
$c_old = c_value of coupon_2
$coupon_id = id of coupon_1
$max1 = max constant supplied by calling function for the purpose of comparison
$min1 = min constant supplied by calling function for the purpose of comparison

*******************************/



function hf_new($sc_id,$valid_from,$sc_date,$d,$count)
{
    
    //getting current date to calculate valid days for coupons
    $query = "select curdate()";
    $result2 = mysql_query($query) or die("error");
    $current_date = mysql_fetch_array($result2);
    
    // calculating the valid days for coupon_1
    $coupon_date=$valid_from;
    $query = "select datediff('".$current_date[0]."',date('".$sc_date."'))";
    $result3 = mysql_query($query);
    $days_sc = mysql_fetch_array($result3);
    
    // calculating the valid days for coupon_2
    $query = "select datediff('".$current_date[0]."','".$coupon_date."')";
    $result4 = mysql_query($query);
    $days_coupon = mysql_fetch_array($result4);
    
    // calculating the minimum of valid days of both coupons
    $min_days=($days_sc[0]<$days_coupon[0]?$days_sc[0]:$days_coupon[0]);
    
    // calculating the hf value 
    $hf = ( $count ) / ( $d + $min_days);
	
    
    return $hf;
}

?>