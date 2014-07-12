<?php

/********************************
	func_for_new_transaction.php
Description : 
Used to update the main_coupons similar list 
whenever new transaction occurs

Arguments:
$last_transactions = table containing info of max 10 last transactions
$new_coupon = array containing info of transacted coupon
$coupon_id = coupon id of transacted coupon
$i = loop variable of last_transations array
$min_constant = constant defined in config.php
****************************************************/

function func($last_transactions , $new_coupon , $coupon_id , $i , $min_constant )
{
    $bahar = 0;		// variable to check if transacted coupon_id is already present in sc_list of last_transacted_coupon
    $min = $min_constant;
    $max = 0;
    $min_pos = -1;	// contains id of similar coupon to be replaced
    $j = 1;
    
    // calculating valid_from of last_transacted_coupon which is used to calculate hf
    $valid_from = $last_transactions[$i]["valid_from"];

    // loop to find if transacted coupon is already present in the list
    for($j=1 ; $j<=15 && $last_transactions[$i]["sc".$j."_id"]!=NULL ; $j++)
    {
        if($last_transactions[$i]["sc".$j."_id"] == $coupon_id)
            $bahar = 1;
    }
    
    // if present then return, no need of further calculations
    if($bahar == 1)
    return;
    
    /*for($j=1 ; $last_transactions[$i]["sc".$j."_id"]!=NULL ; $j++)
    {
        $c_old = $last_transactions[$i]["sc".$j."_c_value"];
        $sc_id = $last_transactions[$i]["sc".$j."_id"];
        $min_max_hf = hf($sc_id,$j,$valid_from,$d,$c_old,$coupon_id,$max,$min);
        $min=$min_max_hf["min"];
        $min_pos = $min_max_hf["min_pos"];
    }
    $min_max_hf = hf($coupon_id , 0 , $valid_from , $d , $new_coupon["c_value"] , $last_transactions[$i]["id"], $max , $min);
    $hf_new_transaction_coupon = $min_max_hf["max"];*/
    
    $id_approved = $new_coupon["id"];
    $c_value_approved = $new_coupon["c_value"];
    $cat_id_approved = $new_coupon["cat_id"];
    
    // if no position in the similar coupon list is empty then we need to update one pos
    // calculating the entry with min hf value
    if($j==16)
    {
        //echo "bhara hua<br>";
        for($j=1 ; $last_transactions[$i]["sc".$j."_id"]!=NULL ; $j++)
        {
            $c_old = $last_transactions[$i]["sc".$j."_c_value"];
            $sc_id = $last_transactions[$i]["sc".$j."_id"];
            $min_max_hf = hf($sc_id,$j,$valid_from,$d,$c_old,$coupon_id,$max,$min,$min_pos);
            $min=$min_max_hf["min"];
            $min_pos = $min_max_hf["min_pos"];
        }

        // calculating the hf of transacted coupon
        $min_max_hf = hf($coupon_id , 0 , $valid_from , $d , $new_coupon["c_value"] , $last_transactions[$i]["id"], $max , $min);
        $hf_new_transaction_coupon = $min_max_hf["max"];

        if ($hf_new_transaction_coupon > $min)
        {
        $coupon_id = $last_transactions[$i]["id"];
        $query="update main_coupons set sc".$min_pos."_id = '".$id_approved."' , sc".$min_pos."_c_value='".$c_value_approved."' , sc".$min_pos."_cat_id = '".$cat_id_approved."' where id = '".$coupon_id."'";
        $result11 = mysql_query($query) or die("update similar_coupons query failed");
        }
    }
    else
    {
       // echo "khali hai<br>";
        //echo $j."<br>";
        $coupon_id = $last_transactions[$i]["id"];
	// there is an empty position so will simply put transacted coupon there
        $query="update main_coupons set sc".$j."_id = '".$id_approved."' , sc".$j."_c_value='".$c_value_approved."' , sc".$j."_cat_id = '".$cat_id_approved."' where id = '".$coupon_id."'";
        $result11 = mysql_query($query)or die("query2 nai challi");
    }
}                    
?>
