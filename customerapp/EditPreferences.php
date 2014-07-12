<?php 
include("../config.php");

if ($_GET['userid']):

//$_GET['value1']
//$_GET['value2']
//$_GET['value3'].......  and $_GET['userid']

    $query = "UPDATE users SET ";
    for($i = 1;$i <= 14; $i++)
    {
                $query.= "cat".$i."_rank = ".$_GET["value".$i]." ,";
    }
    $query = trim($query,",");
    $query .= " where user_id = ".$_GET['userid'];
    //echo $query;
    $res=mysql_query($query);
    
    echo "Changes Saved Successfully !";
endif; 
?>