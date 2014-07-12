<?php

/*************************
   new_transaction.php

Description:
This file is used to execute a new transaction.

Arguments :
$coupon_id = which coupon is bought
$user_id = which user has bought that coupon
***********************************************/


include 'config.php';
include 'hf.php';
include 'func_for_new_transaction.php';
include '../customerapp/calculate_interests.php';
//include 'time.php';


class new_transaction{
    
    var $coupon_id;		// supplied by frontend
    var $user_id;		// supplied by frontend
    var $table_name;		// contains table_name in which all transactions of above user are stored
    var $last_transactions;	// consists of last 10 transactions of that user
    var $new_coupon;		// consists of complete information about the coupon transacted
    
    function new_transaction($coupon_id , $user_id , $number_of_last_transactions, $min_constant , $d)
    {
	// call set_values to fetch all info about coupon transacted and store it in $new_coupon
        $this->set_values($coupon_id , $user_id);

	// find the table in which transactions of particular user is stored
        $this->table_name = $this->transaction_table_name();

	// get last 10 transactions of this user and store them in $last_transactions
        $this->get_last_transactions($number_of_last_transactions , $this->table_name , $user_id);

	// insert the new transaction entry in transactions table
        $this->insert_new_transaction($coupon_id , $user_id);

	// increment the transaction count of coupon in main_coupons table
        $this->increment_transaction_count($coupon_id);
        
        // increments the interest counts
        $this->increment_interest_count();
        
        //function to send mail to user and merchant
        $this->send_confirmation_mails();
        
        //echo count($this->last_transactions);
	// looping over the last 10 or less than 10 transactions
        for($i = 0 ; $i < count($this->last_transactions) ; $i++)
        {
           //echo $this->last_transactions[$i]['id']." ".$this->coupon_id."<br>";

		//if($this->last_transactions[$i]["id"]==$this->coupon_id)
            //{
            // updating the pair counts in counts table
            $query = "update counts set count = count+1 where coupon1_id = ".$this->coupon_id." and coupon2_id=".$this->last_transactions[$i]["id"]." or coupon2_id=". $this->coupon_id." and coupon1_id=".$this->last_transactions[$i]["id"];
            $result = mysql_query($query) or die("update query nahi chali ".$this->last_transactions[$i]["id"]." ".$this->coupon_id."<br>");

	    // if no row is updated then that means this coupon is transacted first time or the coupon id's are same
            if(mysql_affected_rows()==0)
            {
		// if coupon id's of transacted coupon and last transacted 
		// coupon are different then insert an entry for this pair in counts table
                if($this->last_transactions[$i]["id"]!=$this->coupon_id)
                {
                    $query="insert into counts values ('".$this->last_transactions[$i]["id"]."','".$this->coupon_id."','1')";
                    $result22 = mysql_query($query) or die("counts table not updated");
                    
		    // calling func to update the similar coupon list of last transacted coupon
                    func($this->last_transactions , $this->new_coupon , $this->coupon_id , $i , $min_constant);
                }
            }
            else
            {
                func($this->last_transactions , $this->new_coupon , $this->coupon_id , $i , $min_constant);
            }
        }
        //}
    }
    
    // used to insert the new transaction entry in transaction table
    function insert_new_transaction($coupon_id , $user_id )
    {
        date_default_timezone_set("Asia/Calcutta");
        $todaydate = new DateTime();
        $currenttime = date_format($todaydate, 'Y-m-d H:i:s');
        
        $cat_id = $this->new_coupon["cat_id"];
        $query = "insert into ".$this->table_name." (user_id , coupon_id , cat_id, transaction_timestamp) values ( '".$user_id."','".$coupon_id."' , '".$cat_id."' , '".$currenttime."' )";
        $result = mysql_query($query) or die("insert");
    }
    

    // store the info of max 10 transactions in $last_transaction array
    function get_last_transactions($number_of_last_transactions , $table_name , $user_id)
    {
        $query = "select * from ".$table_name." where user_id=".$user_id." order by transaction_timestamp desc limit ".$number_of_last_transactions;
        $result = mysql_query($query) or die("last transactions");
        while( $last_transactions = mysql_fetch_array($result))
        {
            $coupon_id1 = $last_transactions["coupon_id"];
            //echo $coupon_id1."<br>";
            $query = "select * from main_coupons where id=".$coupon_id1;
            $result2 = mysql_query($query) or die("main_coupons");
            $count=mysql_num_rows($result2 );
	if($count==1)
	{
            $main_coupon_row = mysql_fetch_array($result2);
            //echo $main_coupon_row['id']."<br>";
            $this->last_transactions[] = $main_coupon_row;
        }
            
        }
        
    }
    

    // used to get the info of transacted coupon
    function set_values($coupon_id , $user_id)
    {
        $this->coupon_id = $coupon_id;
        $this->user_id = $user_id;
        $query = "select * from main_coupons where id =".$coupon_id;
        //echo $coupon_id;
        $result = mysql_query($query) or die("coupon not found");
        $row = mysql_fetch_array($result);
        $this->new_coupon = $row;
    }

    // find the table which contains transaction history of transacted coupon
    function transaction_table_name(){
        $query = "select table_name from transaction_table_identifier where ".$this->user_id." between user_from and user_to";
        $result = mysql_query($query) or die("table_name");
        $transaction_table = mysql_fetch_array($result);
        return $transaction_table["table_name"];
        }
       
    // increments the no_of_transactions field of transacted coupon 
    function increment_transaction_count($coupon_id)
    {
           $query = "update main_coupons set no_of_transactions = no_of_transactions + 1 where id = ".$coupon_id;
           $result = mysql_query($query) or die("no_of_transactions not updated");
    }
    
    // increments the interest counts
    function increment_interest_count()
    {
           $count_no = "count_".$this->new_coupon["cat_id"];
           //echo $count_no;
           $query = "update users set $count_no = $count_no + 10 where user_id = '$this->user_id' ";
           //echo "<br>".$query;
           $result = mysql_query($query) or die("category interests not updated");
           
           $obj = new calculate_interests($this->user_id);
    }
    
    // function to send confirmation mails to user and merchant
    function send_confirmation_mails()
    {
        $query = "select * from users where user_id = ".$this->user_id;
        $result = mysql_query($query) or die("user not found");
        
        if(mysql_num_rows($result) > 0)
        $user_info = mysql_fetch_array($result);
        
        $query = "SELECT * FROM transaction_table_1 WHERE user_id = '$this->user_id' order by transaction_timestamp desc limit 1";
        $result = mysql_query($query) or die("user not found");
        
        if(mysql_num_rows($result) > 0)
        $transaction_info = mysql_fetch_array($result);
        
        $query = "select * from merchantusers where merchantid = ".$this->new_coupon["merchant_id"];
        $result = mysql_query($query) or die("user not found");
        
        if(mysql_num_rows($result) > 0)
        $merchant_info = mysql_fetch_array($result);
        
        $to = $user_info["other_details"];
        $subject = "iCoupons Transaction ID: ".$transaction_info["transaction_id"];
        $message = "Dear ".$user_info["name"].",\nYou can avail the offer '".$this->new_coupon["name"]."' using the Transaction ID: ".$transaction_info["transaction_id"].".\n\nThe offer details are as follows:- \n".$this->new_coupon["description"].".\n\nRegards,\nTeam iCoupons";
        $headers = "From: no-reply@icoupons.com";
        
        mail($to,$subject,$message,$headers);
        //echo $message."<br>";
        
        $to = $merchant_info["businessemail"];
        $subject = "iCoupons Transaction ID: ".$transaction_info["transaction_id"];
        $message = "Mr. ".$merchant_info["merchantlastname"].",\nYour offer '".$this->new_coupon["name"]."' has been availed by an iCoupon user.\nIt can be redeemed using the coupon transaction ID: ".$transaction_info["transaction_id"]." only.\n\nRegards,\nTeam iCoupons";
        $headers = "From: admin@icoupons.com";
        mail($to,$subject,$message,$headers);
        //echo $message."<br>";
    }
}

// creating a new object
//$nt = new new_transaction(101, 1, $number_of_last_transactions , $min_constant , $d);

?>