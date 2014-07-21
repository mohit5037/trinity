<?php
include './config.php';

class recommend_offers
{
    public $counts = array();
    public $offers = array();
    public $encoded_offers;
    
    function recommend_offers($map)
    {   
        $sum_counts = 0;

        foreach($map as $key=>$val)
        {
            //$this->counts[$i] = $row["count_".$i.""];
            $sum_counts += $val;   // calculating sum of all the counts
        }
        
        $i = 0;
        foreach($map as $key=>$val)
        {
            $this->counts[$i++] = ($val/$sum_counts)*10;
            /*if($this->counts[$i] < 1 && $this->counts[$i] >0)
            {
                $this->counts[$i] = 1;
            }
            else
            {
                $this->counts[$i] = floor($this->counts[$i]);
            }*/
        }
        
        arsort($this->counts);
        
        
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
        
        
        /*foreach($this->counts as $key=>$val)
        {
            echo "cat_".$key."------>   ".$val."<br>";
        }*/
        

        
        /*foreach($this->offers as $item)
        {
            echo $item['Brand']."------->".$item['Offer']."<br>";
        }*/
        
        $this->encoded_offers = ($this->offers);
    }
    
    function get_encoded_offers()
    {
        return $this->encoded_offers;
    }
}

//$obj = new recommend_offers($user_id);
?>