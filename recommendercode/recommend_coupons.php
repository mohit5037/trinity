<?php

include 'config.php';
include 'hf_new.php';

//$user_id=12;

class user_info
{
    var $name;
    var $other_details;
    var $user_row;
    
    function user_info($user_id)
    {
        $query = "select * from users where user_id=".$user_id;
        $result = mysql_query($query) or die("user_info query failed");
        $row = mysql_fetch_array($result);
        $this->name = $row["name"];
        $this->other_details = $row["other_details"];
	$this->user_row = $row;
    }
}

class category_ranks
{
    var $cat_ranks;
    
    function category_ranks($user_id, $number_of_categories)
    {
        $query = "select * from users where user_id=".$user_id;
        $result = mysql_query($query) or die("chali ni");
        $row = mysql_fetch_array($result);
        for($i=1;$i<=$number_of_categories;$i++)
        {
            $this->cat_ranks[strval($row['cat'.$i.'_id'])] = $row['cat'.$i.'_rank'];
            //echo strval($row['cat'.$i.'_id'])." => ".$row['cat'.$i.'_rank']."<br>";
        }
    }
}
class transaction_history
{
    public $transactions_coupon_id;
    var $ui;
    
    function transaction_history($user_id)
    {
	$this->ui=new user_info($user_id);
	
        $query = "select table_name from transaction_table_identifier where ".$user_id." between user_from and user_to";
        $result = mysql_query($query) or die("chali ni");
        $row = mysql_fetch_array($result);
        $query="select coupon_id from ".$row[0]." where user_id=".$user_id." order by transaction_timestamp desc limit 10";
        $result = mysql_query($query) or die("chali ni");
        $i=0;
        $count=mysql_num_rows($result);
       // echo "no. of last transactions is = ".$count."<br>";
	if($count > 0)
	{
        while($row = mysql_fetch_array($result))
        {
            $this->transactions_coupon_id[$i++]=$row[0];
        }
        }
	if($count < 10)
	{
	    for($j = 1; $j <= 14; $j++)
	    {
		if($this->ui->user_row["cat".$j."_rank"] > 1)
		{
		    //echo "cat".$j."_rank = ".$this->ui->user_row["cat".$j."_rank"]."<br>";
		    $query = "select id from main_coupons where cat_id = '$j'";
		    $result = mysql_query($query) or die(mysql_error()."<br>");
		    $count=mysql_num_rows($result);
		    if($count > 0)
		    {
			while($row = mysql_fetch_array($result))
			{
			    $this->transactions_coupon_id[$i++]=$row[0];
			}
		    }
		}
	    }    
	}
    }
}

class user_profile
{
    public $ui, $cr, $th;
    public $map=array();
    
    function user_profile($user_id,$number_of_categories,$d,$min_constant)
    {
        $this->ui=new user_info($user_id);
        $this->cr=new category_ranks($user_id,$number_of_categories);
        $this->th=new transaction_history($user_id);
        $this->generate($d,$min_constant);
    }
    
    function generate($d,$min_constant)
    {
    
    global $gender_disadvantage_weight;
    global $gender_advantage_weight;
    global $age_group_advantage_weight;
        
        foreach($this->th->transactions_coupon_id as $coupon_id)
        {
            //echo "coupon id = ".$coupon_id."<br>";
            $query="select * from main_coupons where id=".$coupon_id;
            $result = mysql_query($query) or die("main coupon not found in mains table");
            $count=mysql_num_rows($result);
	    if($count > 0)
            {
		$row = mysql_fetch_array($result);
		//////////////////////////////////////////
		$main_coupon_id_valid_from = $row['valid_from'];
		$main_coupon_id = $coupon_id;
		
		// query to get similar coupons
		$query = "SELECT coupon1_id,count from counts where coupon2_id = '$main_coupon_id' and count > 1 UNION
			    SELECT coupon2_id,count from counts where coupon1_id = '$main_coupon_id' and count > 1
			     ORDER by count DESC";
		$result = mysql_query($query) or die("Similar coupons query failed ".mysql_error());
		if(mysql_num_rows($result) > 0)
		{
		    while($row = mysql_fetch_array($result))
		    {
			$sc_id = $row[0];
			$pair_count = $row[1];
			
			// for debug purpose
			//echo "-----similar coupon id === ".$sc_id."<br>";
			
			// info of similar coupon
			$query = "select valid_from,cat_id from main_coupons where id = '$sc_id'";
			$sc_result = mysql_query($query) or die("similar coupon info not found");
			if(mysql_num_rows($sc_result) > 0)
			$sc_row = mysql_fetch_array($sc_result);
			
			$category=$sc_row["cat_id"];
			$category_rank=$this->cr->cat_ranks[$category];
			
			$hf = hf_new($sc_id,$main_coupon_id_valid_from,$sc_row['valid_from'],$d,$pair_count);
			
			$gender_query="select gender,age_group from main_coupons where id=".$sc_id;
			$gender_result = mysql_query($gender_query) or die("chali ni");
			$gender_count=mysql_num_rows($gender_result);
            	    
			if($gender_count > 0)
			$gender_row = mysql_fetch_array($gender_result);
            	    
			$gender = $gender_row["gender"];
			$age_group = $gender_row["age_group"];
                    
			// increasing or decreasing hf based on user gender
			if($gender == 'M')
			{
			    if($this->ui->user_row["gender"] == 'M')
			    {
				$hf *= $gender_advantage_weight;
			    }
			    else
			    {
				$hf *= $gender_disadvantage_weight;
			    }
			}
		    
			else if($gender == 'F')
			{
			    if($this->ui->user_row["gender"] == 'F')
			    {
				$hf *= $gender_advantage_weight;
			    }
			    else
			    {
				$hf *= $gender_disadvantage_weight;
			    }
			}
		    
			// increasing or decreasing hf based on user's age group
			if($age_group != 5)
			{
			    if($this->ui->user_row["age_group"] == $age_group)
			    {
				$hf *= $age_group_advantage_weight;
			    }
			}
			
			$item_score=$hf*$category_rank;
			
			//echo "item_score of ".$coupon_id." & ".$sc_id." is -> ".$item_score."<br>";
			
	  
			if(array_key_exists($sc_id,$this->map))
			{
			    $this->map[$sc_id]+=$item_score;
			}
			else
			$this->map[$sc_id]=$item_score;
		    }
		}
		//////////////////////////////////////////
		
               
            }
        }
        
        arsort($this->map);
        
        /*foreach($this->map as $id=>$is)
        {
	    $query="select * from main_coupons where id=".$id;
            $result = mysql_query($query) or die("chali ni");
	    $row = mysql_fetch_array($result);
            echo "coupon_id = ".$id."----------"."category_id = ".$row['cat_id']."----------"."Item_score = ".$is."<br>";
        }*/
        
    }
}

//echo "mohit";
//$up= new user_profile($user_id,$number_of_categories,$d,$min_constant);
?>