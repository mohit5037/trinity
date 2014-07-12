<?php

include '../config.php';


if ($_POST['userId']):
$user_id = $_POST['userId'];

class all_transactions
{
    public $cat_id;
    public $category_name;
    public $count;
    
    function all_transactions($cat_id,$category_name,$count)
    {
        $this->cat_id = $cat_id;
        $this->category_name = $category_name;
        $this->count = $count;
    }
}

$categories = array();
$query = "select id , name from categories";
$result = mysql_query($query) or die (mysql_error());
while($row = mysql_fetch_array($result))
{
    $categories[$row['id']] = $row['name'];
    //echo $row['id']."------->".$categories[$row['id']]."<br>";
}


$query = "select card_number from users where user_id = '$user_id'";
$result = mysql_query($query) or die (mysql_error());
$row = mysql_fetch_array($result);
$account_number = $row['card_number'];

$all_transactions = array();
$i = 0;

$query = "select cat_id, count(cat_id) as 'count' from transaction_history1 where account_number = '$account_number' group by cat_id order by count(cat_id) DESC ";
$result = mysql_query($query) or die (mysql_error());
if(mysql_num_rows($result) > 0)
{
    while($row = mysql_fetch_array($result))
    {
        $all_transactions[$i++] = new all_transactions($row['cat_id'],$categories[$row['cat_id']],$row['count']);
        //echo $all_transactions[$i-1]->cat_id."-------".$all_transactions[$i-1]->category_name."-------".$all_transactions[$i-1]-//>count."<br>";
    }
}

// return $all_transactions as json encode
echo json_encode($all_transactions); 
endif;

?>