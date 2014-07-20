<?php
include 'config.php';

$query = "LOAD DATA LOCAL INFILE './I-coupons_offers.txt' INTO TABLE icici_offers FIELDS TERMINATED BY '\t' LINES TERMINATED BY '\n'  ";
$result = mysql_query($query) or die(mysql_error());
//$row = mysql_fetch_array($result);

?>