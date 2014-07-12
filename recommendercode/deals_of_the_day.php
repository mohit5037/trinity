<?php
include 'config.php';

/*$coupon1 = 17;
$coupon2 = 18;
$coupon3 = 19;*/

class deals_of_the_day
{
	public $deals=array();
	
	function deals_of_the_day($coupon1,$coupon2,$coupon3)
	{
		$this->deals[$coupon1] = $coupon1;
		$this->deals[$coupon2] = $coupon2;
		$this->deals[$coupon3] = $coupon3;
	}
}
//echo "mohit";
//$up = new deals_of_the_day($coupon1,$coupon2,$coupon3);

/*$deals_of_day = new deals_of_the_day($coupon1,$coupon2,$coupon3);
	foreach($deals_of_day->deals as $id=>$is)
	{
		echo $id." ".$is."<br>";
	}*/

?>