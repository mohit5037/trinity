<?php
include 'config.php';
include 'hf.php';

/******************************
approve_to_main.php

Description: This class is used to transfer approved coupons from approved table to
			 main table.
			 
*******************************/

class approve_to_main
{
    var $result;	//stores approved table entries which have valid_from < now()
	
	/**************************
	Arguments:
	$d = constant defined in config.php
	$min_constant = constant defined in config.php used for comparison purposes
	****************************/
    function approve_to_main($d, $min_constant)
    {
		// checking if any valid entry exists in approved table or not
        if($this->entry_exists()==true)
        {
	    // for every coupon in approved table find all the coupons of same category in main_coupons table.
            for($i=0;$i<count($this->result);$i++)
            {
				// $this_result represents approved table entries
                $query="select * from main_coupons where cat_id=".$this->result[$i]["cat_id"];
		$result=mysql_query($query) or die("select query failed in approve_to_main.php");
				
		// $row represents main_coupons rows
		while($row = mysql_fetch_array($result))
                {
                    $j=1; 
                    $coupon_id=$row["id"];
                    $min_pos=-1;
                    $min=$min_constant;
					
					// calculate hf value of all similar coupons placed in one row of main_coupons with main_coupon itself
                    while($row['sc'.$j."_id"]!=NULL)
                    {
                        $sc_id=$row['sc'.$j."_id"];
                        $valid_from=$row["valid_from"];
                        $c_old=$row['sc'.$j."_c_value"];
                        //echo $sc_id." ".$valid_from." ".$c_old." ";
                        $min_max_hf = hf($sc_id,$j,$valid_from,$d,$c_old,$coupon_id,0,$min,$min_pos);
                        $min=$min_max_hf["min"];
                        $min_pos = $min_max_hf["min_pos"];
                        //echo $min."<br>";
                        $j++;
                    }
					
					// now calculating the hf of approved coupon with main coupon of main_coupons row.
                    $c_value_approved = $this->result[$i]["c_value"];
                    $id_approved = $this->result[$i]["id"];
                    $cat_id_approved = $this->result[$i]["cat_id"];
                    $hf_approved = $c_value_approved/$d;
                     
					// if all similar coupons are filled for main_coupons row 
					// then we will replace the one similar coupon entry
                    if($j==16)
                    {
                        $query="update main_coupons set sc".$min_pos."_id = '".$id_approved."' , sc".$min_pos."_c_value='".$c_value_approved."' , sc".$min_pos."_cat_id = '".$cat_id_approved."' where id = '".$coupon_id."'";
                        $result11 = mysql_query($query) or die("adding approved coupon into similar coupons failed");
                    }
		    // if now then we will simply add approved coupons into empty slot in similar coupon list
                    else
                    {
                        
                        //echo $j;
                        $query="update main_coupons set sc".$j."_id = '".$id_approved."' , sc".$j."_c_value='".$c_value_approved."' , sc".$j."_cat_id = '".$cat_id_approved."' where id = '".$coupon_id."'";
                        $result11 = mysql_query($query)or die("adding approved coupon into similar coupons failed");
                    }
                }
				
		// entries to insert in main_coupons table
                $id1 = $this->result[$i]["id"];
                //echo "id to be inserted ->".$id1."<br>";
                $c_value1 = $this->result[$i]["c_value"];
                $name1= $this->result[$i]["name"];
                $description1 = $this->result[$i]["description"];
                $create_date1 = $this->result[$i]["create_date"];
                $valid_from1 = $this->result[$i]["valid_from"];
                $valid_to1 = $this->result[$i]["valid_to"];
                $merchant_id1 = $this->result[$i]["merchant_id"];
                $image1 = $this->result[$i]["image"];
                $price1 = $this->result[$i]["price"];
                $cat_id1 = $this->result[$i]["cat_id"];
		$gender1 = $this->result[$i]["gender"];
		$age_group1 = $this->result[$i]["age_group"];
                
                date_default_timezone_set("Asia/Calcutta");
        	$todaydate = new DateTime();
        	$currenttime = date_format($todaydate, 'Y-m-d H:i:s');
                
                // Now its time to insert the row of approved coupon into main_coupons table
                $query="insert into main_coupons (id, c_value, name, description, gender, age_group, create_date, valid_from, valid_to, merchant_id,approved_date,image,price,cat_id) values ('".$id1."','".$c_value1."','".$name1."','".$description1."','".$gender1."','".$age_group1."','".$create_date1."','".$valid_from1."','".$valid_to1."','".$merchant_id1."', '".$currenttime."' , '".$image1."' , '".$price1."','".$cat_id1."')";
		$result1 = mysql_query($query)or die("insert approved coupon into main_coupons failed 2");
                
                // deleting the coupon from approved table.
                $id22=$this->result[$i]["id"];
                $query="delete from approved where id = ".$id22;
		$result12 = mysql_query($query)or die("deletion of approved coupon from approved table failed");
            }
        }
    }
	
    function entry_exists()
    {
		// we are interested in only those entries of approved table which have 
		// valid_from timestamp less current timestamp
        

       // echo time();
	date_default_timezone_set("Asia/Calcutta");
        $todaydate = new DateTime();
        $currenttime = date_format($todaydate, 'Y-m-d H:i:s');
        $query = "select * from approved where valid_from < '".$currenttime."'";
        $result = mysql_query($query) or die("error");
		
        $check=false; // variable used to tell if any entry exists in approved table which have valid_from < now()
        while($row = mysql_fetch_array($result))
        {
			// if any entry exists make this variable true
            $check=true;
			
			// storing the valid entries into class variable result
            $this->result[]=$row;
        }
		
        return $check;
    }
}


// making a new object
$atm = new approve_to_main($d , $min_constant);


?>