<?php

include '../config.php';


if($_GET['userId']):

$userId=$_GET['userId'];
$date = $_GET['date'];
$terminal_owner = $_GET['terminal_owner '];
$terminal_city = $_GET['terminal_city'];
$cat_id = $_GET['cat_id'];



$query = "select card_number from users where user_id='$userId'";
$result = mysql_query($query) or die (mysql_error());
$row = mysql_fetch_array($result);

$account_number = $row['card_number'];


class categorize_transaction
{
    function categorize_transaction($account_number,$date,$terminal_owner,$terminal_city,$cat_id)
    {
        $query = "update transaction_history1 set cat_id = '$cat_id' where account_number = '$account_number' and terminal_owner = '$terminal_owner'   ";
        //echo $query;
        $result = mysql_query($query); //or die (mysql_error());
    }
}

$categorize_transaction = new categorize_transaction($account_number,$date,$terminal_owner,$terminal_city,$cat_id);


echo "Changes Saved Successfully !";
endif;


?>