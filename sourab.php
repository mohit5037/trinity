<?php 
include("./config.php");
include("../config.php");
include('recommendercode/recommend_coupons.php');
include('recommendercode/deals_of_the_day.php');
include('recommendercode/hf.php');

/*if ($_POST['page']):
$page = $_POST['page'];
$requestFor = $_POST['pageName'];*/

  class Coupon
{
	public $couponid;
	public $category;
	public $name;
        public $description;
        public $price;
        public $image;
}
//$page = 1;
//$cur_page = $page;
$page = 0;
$per_page = 2;
$start = $page * $per_page;
$requestFor = 'deals_of_the_day';
$user_id = 1;
$x = '';
$i = 0;

$result_pag_data = array();

if( 0 == strcasecmp($requestFor,'allcoupons'))
{
$x = 'all a to z';
//echo $x."<br>";

$query2 = "SELECT * FROM `main_coupons` Where 1 LIMIT $start, $per_page";
$result = mysql_query($query2)or die('MySql Error' . mysql_error());
while($row = mysql_fetch_array($result))
{
$result_pag_data[] = $row;
}

$i = 0;
}

else if(0 == strcasecmp($requestFor,'recommended'))
{
$x = 'recommended';
//echo $x."<br>";

$up= new user_profile($user_id,$number_of_categories,$d,$min_constant);
foreach($up->map as $id=>$is)
        {
            //echo $id."<br>";
            $query = "SELECT * FROM `main_coupons` Where id = ".$id;
	    $result = mysql_query($query)or die('MySql Error' . mysql_error());
	    $result_pag_data[] = mysql_fetch_array($result);
        }
        
  $i = $start;
}
else if(0 == strcasecmp($requestFor,'deals_of_the_day'))
{
	$x = 'deals_of_the_day';
	//echo $x."<br>";
	$deals_of_day = new deals_of_the_day(17,18,19);
	foreach($deals_of_day->deals as $id=>$is)
	{
		//echo $id." ".$is."<br>";
		$query = "SELECT * FROM `main_coupons` Where id = ".$id;
	    	$result = mysql_query($query)or die('MySql Error' . mysql_error());
	    	$result_pag_data[] = mysql_fetch_array($result);
	}
	
	$i = $start;
}

 
//$query2 = "SELECT * FROM `main_coupons` Where 1 LIMIT $start, $per_page";
//$result_pag_data = mysql_query($query2)or die('MySql Error' . mysql_error());
 
$Coupons = array();
while ($i < count($result_pag_data) && $i < $start + $per_page)
{
$row = $result_pag_data[$i];
 $Coupons[$i] = new Coupon;
$Coupons[$i]->couponid = $row['id'];
$Coupons[$i]->name = $row['name'].$x;

$sql="SELECT * FROM categories WHERE id='".$row['cat_id']."' ";
$res=mysql_query($sql);
$r=mysql_fetch_array($res);
$count=mysql_num_rows($res);
if($count==1)
    {   
        $categoryname=$r['name'];   
    }

$Coupons[$i]->category = $categoryname; 
$Coupons[$i]->description = $row['description'];
$Coupons[$i]->price = $row['price'];
$Coupons[$i]->image = "http://localhost/trinity/uploads/".$row['image'];

$i++;
}

echo json_encode($Coupons); 
 //endif;
?>