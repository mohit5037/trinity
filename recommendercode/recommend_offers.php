<?php
include './config.php';
$user_id = 12;

class recommend_offers
{
    public $counts = array();
    public $offers = array();
    
    function recommend_offers($user_id)
    {
        $query = "select * from users where user_id = '$user_id'";
        $result = mysql_query($query) or die("user not found");
        
        $sum_counts = 0;
        
        if(mysql_num_rows($result) > 0)
        {
            $row = mysql_fetch_array($result);
            for($i = 1; $i <=14; $i++)
            {
                //$this->counts[$i] = $row["count_".$i.""];
                $sum_counts += $row["count_".$i.""];   // calculating sum of all the counts
            }
            
            for($i = 1; $i <=14;$i++)
            {
                $this->counts[$i] = ($row["count_".$i.""]/$sum_counts)*10;
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
        }
        
        /*foreach($this->counts as $key=>$val)
        {
            echo "cat_".$key."------>   ".$val."<br>";
        }*/
        

        
        /*foreach($this->offers as $item)
        {
            echo $item['Brand']."------->".$item['Offer']."<br>";
        }*/
        
        echo json_encode($this->offers);
        
    }
}

$obj = new recommend_offers($user_id);
?>