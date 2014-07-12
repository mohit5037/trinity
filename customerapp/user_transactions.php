<?php

include '../config.php';


if ($_POST['userId']):
$user_id = $_POST['userId'];
$cat_id = $_POST['category'];


//$user_id = 3;
//$cat_id = 0;

class user_transactions
{
    public $date;
    public $terminal_owner;
    public $terminal_city;
    
    function user_transactions($date,$terminal_owner,$terminal_city)
    {
        $this->date = $date;
        $this->terminal_owner = $terminal_owner;
        $this->terminal_city = $terminal_city;
    }
}

$user_transactions = array();
$i = 0;

$query = "select card_number from users where user_id = '$user_id'";
$result = mysql_query($query) or die (mysql_error());
$row = mysql_fetch_array($result);
$account_number = $row['card_number'];

if($cat_id == 0)
{
$query = "select * from transaction_history1 where account_number = '$account_number' and cat_id = '$cat_id' group by terminal_owner";
}
else
{
$query = "select * from transaction_history1 where account_number = '$account_number' and cat_id = '$cat_id' ";
}
$result = mysql_query($query) or die (mysql_error());
if(mysql_num_rows($result) > 0)
{
    while($row = mysql_fetch_array($result))
    {
        $user_transactions[$i++] = new user_transactions($row['date'],$row['terminal_owner'],$row['terminal_city']);
        //echo $user_transactions[$i-1]->date."-------".$user_transactions[$i-1]->terminal_owner."-------".$user_transactions[$i-1]->terminal_city."<br>";
    }
}
echo json_encode($user_transactions); 
endif;

?>