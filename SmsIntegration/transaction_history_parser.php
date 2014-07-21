<?php
include './config.php';
include './recommend_offers.php';

//$card_number = '5701042908';

class transaction_history_parser
{
    public $recommend_offers;
    
    function transaction_history_parser($card_number)
    {
        $query = "select cat_id from transaction_history1 where account_number = '$card_number'";
        $result = mysql_query($query) or die("no entry for this account number");
        $map = array();
        while($row = mysql_fetch_array($result))
        {
		if(array_key_exists($row["cat_id"] , $map))
		$map[$row["cat_id"]] += 1;
		else if($row["cat_id"] !=0)
		$map[$row["cat_id"]] = 1;
        }
        
        ksort($map);
                
        
        
        /*foreach($map as $key=>$value)
        {
            echo $key."->".$value."<br>";
        }*/
        
        
	$rec_offers = new recommend_offers($map);
	$this->recommend_offers = $rec_offers->get_encoded_offers();
        
    }
    
    function get_rec_offers()
    {
	return $this->recommend_offers;
    }
    
}

//$thp = new transaction_history_parser($card_number);

?>