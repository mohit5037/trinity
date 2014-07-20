<?php
include './config.php';
include './recommend_offers.php';

$card_number = '5701042908';

class transaction_history_parser
{
    
    function transaction_history_parser($card_number)
    {
        $query = "select terminal_owner,terminal_city from transaction_history1 where account_number = '$card_number'";
        $result = mysql_query($query) or die("no entry for this account number");
        $map = array();
        while($row = mysql_fetch_array($result))
        {
           // echo $row['terminal_owner']."<br>";
            $terminal = $row['terminal_owner'];
            $query = "select cat_id from transaction_history1 where terminal_owner = '$terminal' ";
            $result_inner = mysql_query($query) ;//or die("no entry :".mysql_error());
            if(mysql_num_rows($result_inner) > 0)
            {
		$row_inner = mysql_fetch_array($result_inner);
		if(array_key_exists($row_inner["cat_id"] , $map))
		$map[$row_inner["cat_id"]] += 1;
		else if($row_inner["cat_id"] !=0)
		$map[$row_inner["cat_id"]] = 1;
            }
            else
            {
	            echo $row["terminal_owner"]." -------  ".$row["terminal_city"]."<br>";
	            $terminal_city = $row["terminal_city"];
	            $query = "insert into sorted_table (frequency,terminal_owner,terminal_city) values ('5','$terminal','$terminal_city')";
	            $result_inner = mysql_query($query); //or die (mysql_error()) ;
            }
        }
        
        ksort($map);
                
        
        
        /*foreach($map as $key=>$value)
        {
            echo $key."->".$value."<br>";
        }*/
        
        
	$recommend_offers = new recommend_offers($map);
        
    }
    
}

$thp = new transaction_history_parser($card_number);

?>