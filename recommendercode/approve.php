<?php

/*************************************
Approve.php
*************************************/

/*include the configuration file and the heuristic function file*/
include 'config.php';

// coupon_id supplied by front end when admin clicks on approve button
//$coupon_id= 158;

// variable to decide the priority of new coupon again supplied by front end
//$insert_level = 5;

class approve
{
	var $coupon_id;
	var $insert_level;
	var $coupon_info;
	
	function approve($coupon_id,$insert_level)
	{
		// setting the class parameters
		$this->coupon_id = $coupon_id;
		$this->insert_level = $insert_level;
		
		//getting info of coupon to be approved
		$this->get_info();
		$this->shifter();
	}
	
	function get_info()
	{
		$query = "select * from premature where id='$this->coupon_id'";
		$result = mysql_query($query) or die("coupon not found in premature table");
		if(mysql_num_rows($result) > 0)
		{
			$row = mysql_fetch_array($result);
			$this->coupon_info = $row;
		}
	}
	
	function shifter()
	{
                date_default_timezone_set("Asia/Calcutta");
                $todaydate = new DateTime();
                $currenttime = date_format($todaydate, 'Y-m-d H:i:s');

		// query to add coupon into approved table
		$query =    "INSERT INTO `approved` (`id`,`cat_id`, `name`, `description`, `create_date`, 
                                                                         `valid_from`, `valid_to`,`merchant_id`,`approved_date`, `image`, `price`, `gender`, `age_group`)
                                                                          VALUES ('".$this->coupon_id."','".$this->coupon_info['cat_id']."','".$this->coupon_info['name']."','".$this->coupon_info['description']."','".$this->coupon_info['create_date']."',
                                                                          '".$this->coupon_info['valid_from']."','".$this->coupon_info['valid_to']."','".$this->coupon_info['merchant_id']."','".$currenttime."','".$this->coupon_info['image']."','".$this->coupon_info['price']."','".$this->coupon_info['gender']."','".$this->coupon_info['age_group']."')";                     
                $result = mysql_query($query) or die(mysql_error());
		
		// query to delete coupon from premature table
                $query = "DELETE FROM `premature` WHERE  `id`='$this->coupon_id'";
                $result = mysql_query($query) or die(mysql_error);
	}
}




//$approve = new approve($coupon_id, $insert_level);

?>