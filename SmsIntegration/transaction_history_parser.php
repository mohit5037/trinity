<?php
include './config.php';
include './recommend_offers.php';

/**************************************
 transaction_history_parser.php
 Author: Mohit Kumar
 
 Arguments:
	    $card_number : debit/credit card number of a particular user

****************************************/

// for debugging purposes only
// $card_number = '5701042908';

class transaction_history_parser
{
    public $recommend_offers;		// array to hold offers for a particular user
    
    // contructor function
    function transaction_history_parser($card_number)
    {
	// query to count the number of transactions of a user in each category
        $query = "select cat_id from transaction_history1 where account_number = '$card_number'";
        $result = mysql_query($query) or die("no entry for this account number");
	
	// hash map to hold the no. of transactions for each category
        $map = array();
	
	// populating the map
        while($row = mysql_fetch_array($result))
        {
		if(array_key_exists($row["cat_id"] , $map))
		$map[$row["cat_id"]] += 1;
		else if($row["cat_id"] !=0)
		$map[$row["cat_id"]] = 1;
        }
        
	// sort the map in ascending order acc. to keys
        ksort($map);
                
	// for debugging purposes	
        /*foreach($map as $key=>$value)
        {
            echo $key."->".$value."<br>";
        }*/
        
        // after populating map we will get the offers for each user
	$rec_offers = new recommend_offers($map);
	
	// saving the offers in class variable
	$this->recommend_offers = $rec_offers->get_offers();
        
    }
    
    // get the recommend offers for a particular user
    function get_rec_offers()
    {
	return $this->recommend_offers;
    }
    
}

//$thp = new transaction_history_parser($card_number);

?>