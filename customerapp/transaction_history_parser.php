<?php
include '../recommendercode/config.php';
include './calculate_interests.php';

$user_id = 12;
class transaction_history_parser
{
    
    function transaction_history_parser($user_id)
    {
        $query = "select card_number from users where user_id = '$user_id'";
        $result = mysql_query($query) or die("card_number not found");
        if(mysql_num_rows($result) > 0)
        $row = mysql_fetch_array($result);
        
        $card_number = $row["card_number"];
        //echo $card_number;
        
        $query = "select terminal_owner,terminal_city from transaction_history1 where account_number = '$card_number' and STR_TO_DATE(date,'%m/%d/%Y') >=  '2014-03-01'  ";
        $result = mysql_query($query) or die("no entry for this account number");
        $map = array();
        while($row = mysql_fetch_array($result))
        {
           // echo $row['terminal_owner']."<br>";
            $terminal = $row['terminal_owner'];
            $query = "select category from sorted_table where terminal_owner = '$terminal' ";
            $result_inner = mysql_query($query) ;//or die("no entry :".mysql_error());
            if(mysql_num_rows($result_inner) > 0)
            {
            $row_inner = mysql_fetch_array($result_inner);
            if(array_key_exists($row_inner["category"] , $map))
            $map[$row_inner["category"]] += 1;
            else if($row_inner["category"] !=0)
            $map[$row_inner["category"]] = 1;
            
            }
            else
            {
	            echo $row["terminal_owner"]." -------  ".$row["terminal_city"]."<br>";
	            $terminal_city = $row["terminal_city"];
	            $query = "insert into sorted_table (frequency,terminal_owner,terminal_city) values ('5','$terminal','$terminal_city')";
	            $result_inner = mysql_query($query); //or die (mysql_error()) ;
            }
        }
        
        arsort($map);
                
            $query = "update users set ";
        
        foreach($map as $key=>$value)
        {
            $query .= "count_".$key." = ".$value." ,";
            echo $key."->".$value."<br>";
        }
        
        $query = trim($query,",");
        $query .= " where card_number = ".$card_number;
        //echo $query;
        //$result = mysql_query($query) or die("query failed while updating counts in users table  ". mysql_error());
        //$update_interests = new calculate_interests($user_id);
    }
    
}

$thp = new transaction_history_parser($user_id);

?>