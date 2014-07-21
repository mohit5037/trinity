<?php
include './config.php';

/************************************
 recommend_offers.php
 Author: Mohit Kumar
 
 Arguments:
            $map : map containing category id and number of transactions in that category as key value pair
            
*************************************/

class recommend_offers
{
    public $counts = array();       // to store normalised counts
    public $offers = array();       // to store offers for a user
    
    // contructor function
    function recommend_offers($map)
    {
        // variable to store sum of transactions
        $sum_counts = 0;

        // summing in a loop
        foreach($map as $key=>$val)
        {
            $sum_counts += $val;   // calculating sum of all the counts
        }
        
        // normalising the counts
        $i = 0;
        foreach($map as $key=>$val)
        {
            $this->counts[$i++] = ($val/$sum_counts)*10;
        }
        
        // sort the norm. counts in decreasing order
        arsort($this->counts);
        
        // loop over the map and get offers from each cat acc to their counts
        $i = 0;
        foreach($this->counts as $key=>$val)
        {
            if($val < 1 && $val > 0)
            {
                $val = 1;
            }
            else
            {
                $val = floor($val);
            }
            
            
            $query = "select * from icici_offers where cat_id = '$key' order by rand() LIMIT ".$val;
            $result = mysql_query($query) or die(mysql_error());
            if(mysql_num_rows($result) > 0)
            {
                while($row = mysql_fetch_assoc($result))
                {
                    $this->offers[$i++] = $row;
                    if($i==10)
                        break;
                }
            }
            
            if($i==10)
                    break;
            
        }
        
        // for debugging purposes only
        
        /*foreach($this->counts as $key=>$val)
        {
            echo "cat_".$key."------>   ".$val."<br>";
        }*/
        

        
        /*foreach($this->offers as $item)
        {
            echo $item['Brand']."------->".$item['Offer']."<br>";
        }*/
        
        
    }
    
    function get_offers()
    {
        return $this->offers;
    }
}

//$obj = new recommend_offers($user_id);
?>