<?php
include '../recommendercode/config.php';
$user_id = 12;

class calculate_interests
{
    public $counts = array();
    
    function calculate_interests($user_id)
    {
        $query = "select * from users where user_id = '$user_id'";
        $result = mysql_query($query) or die("user not found");
        if(mysql_num_rows($result) > 0)
        {
            $row = mysql_fetch_array($result);
            for($i = 1; $i <=14; $i++)
            {
                $this->counts[$i] = $row["count_".$i.""];
            }
        }
        
       /* foreach($this->counts as $count)
        {
            echo $count."<br>";
        }*/
        
        $max_count = max($this->counts);
        
        //echo "max count is : ".$max_count."<br>";
        
        $query = "update users set ";
        
        for($j = 1; $j <= 14; $j++)
        {
            $interest = ceil(($this->counts[$j]/$max_count)*9) + 1;
            $query .= "cat".$j."_rank = ".$interest." ,";
            echo "cat_id = ".$j."------>".$interest."<br>";
        }
        $query = trim($query,",");
        $query .= " where user_id = '$user_id'";
        //echo $query."<br>";
        $result = mysql_query($query) or die("category ranks not updated");
    }
}

$obj = new calculate_interests($user_id);
?>