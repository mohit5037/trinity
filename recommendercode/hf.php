<?php

/********************
HF.php 
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



function hf($sc_id,$j,$valid_from,$d,$c_old,$coupon_id,$max1,$min1,$min_pos1 = -1)
{
    $min=$min1;			// storing values in local variables for returning values
    $max=$max1;
    $min_pos = $min_pos1;
	
	// to calculate hf we need count for the supplied pair of coupons
    $query = "select count from counts where coupon1_id=".$coupon_id." and coupon2_id=".$sc_id." or coupon2_id=".$coupon_id." and coupon1_id=".$sc_id;
    $result0 = mysql_query($query);
    $count = mysql_fetch_array($result0);
    
    //getting the date of coupon_2 to find for how many days it is valid
    $query = "select valid_from from main_coupons where id=".$sc_id;
    $result1 = mysql_query($query) or die("error");
    $sc_date = mysql_fetch_array($result1);
    
    //getting current date to calculate valid days for coupons
    $query = "select curdate()";
    $result2 = mysql_query($query) or die("error");
    $current_date = mysql_fetch_array($result2);
    
	// calculating the valid days for coupon_1
    $coupon_date=$valid_from;
    $query = "select datediff('".$current_date[0]."',date('".$sc_date[0]."'))";
    $result3 = mysql_query($query);
    $days_sc = mysql_fetch_array($result3);
    
	// calculating the valid days for coupon_2
    $query = "select datediff('".$current_date[0]."','".$coupon_date."')";
    $result4 = mysql_query($query);
    $days_coupon = mysql_fetch_array($result4);
    
	// calculating the minimum of valid days of both coupons
    $min_days=($days_sc[0]<$days_coupon[0]?$days_sc[0]:$days_coupon[0]);
    
	// calculating the hf value 
	$hf = ( $c_old + $count[0] ) / ( $d + $min_days);
	
	// if calculated hf is greater than $max1 supplied the update that max value
    if($hf>$max)
    $max=$hf;
	
	// initializing the value of min_pos variable which will decide which similar
	// coupon will be replaced 
    //$min_pos=-1;
	
	// if calculated hf is less than $min1 supplied the update that min value and min_pos
    if($hf<$min){
        $min_pos = $j;
        $min=$hf;
    }
    //echo "hf of ".$coupon_id." & ".$sc_id." is -> ".$hf."<br>";
    
	// returning the array of results which includes updated min hf, updated max hf, min_pos
    $min_max_hf["min"]=$min;
    $min_max_hf["max"]=$max;
    $min_max_hf["min_pos"]=$min_pos;
    return $min_max_hf;
}

?>