<?php 
//echo "mohit";
function return_API_Call_URL($partner_id, $partner_api_key, $selected_api_method, $additional_parameters){ 
 
//staging 
 //$base_url = "http://staging.couponapitest.com/"; 
 
//production 
 $base_url = "http://www.coupondunia.in/"; 
 $ts = time(); //for current timestamp 
 $partial_qs = "pi=".$partner_id."&ts=".$ts; //pi is partner id
 
if(isset($additional_parameters) && !empty($additional_parameters)){ 
 $partial_qs .= "&".$additional_parameters; 
 } 

// create a checksum using current timestamp, partner id, partner key and the additional 
 $checksum = md5($partner_api_key.$partial_qs); 
 
$queryString = $partial_qs."&cs=".$checksum; 
 
$api_call_url = $base_url."api/".$selected_api_method."?".$queryString; 
 return $api_call_url; 
}

$cat_url =  return_API_Call_URL('10','7A6E7042-986C-C6E1-3219-81E0BA79912C',"coupons_by_category","category_id=4");
echo $cat_url."<br>";
echo (file_get_contents($cat_url));

?>