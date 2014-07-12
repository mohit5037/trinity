<?php 
include("../recommendercode/config.php");
include("../config.php");
include('../recommendercode/recommend_coupons.php');
include('../recommendercode/deals_of_the_day.php');
include('../recommendercode/hf.php');

if ($_POST['page']):
$page = $_POST['page'];
$requestFor = $_POST['pageName'];
$user_id= $_POST['userId'];
/*
$page = 1;
$requestFor = 'favourite';*/
//$user_id= 1;

// sourab code for testing purpose
 date_default_timezone_set("Asia/Calcutta");
 $todaydate = new DateTime();
 $currenttime = date_format($todaydate, 'Y-m-d H:i:s');
 $query = "INSERT INTO `test`(`userid`, `requestfor`, `page`, `time`) 
     VALUES ('$user_id','$requestFor ','$page ','$currenttime ')";
     $res2=mysql_query($query);
 
 //test code ends here    
     
     
  class Coupon
{
	public $couponid;
	public $category;
	public $name;
        public $description;
        public $price;
        public $image;
}

$cur_page = $page;
$page -= 1;
$per_page = 15;
$start = $page * $per_page;


$x = '';
$i = 0;
$result_pag_data = array();

if( 0 == strcasecmp($requestFor,'allcoupons'))
{
$x = 'all a to z';
//echo $x."<br>";
$catId=$_POST['category'];

$query2 = "SELECT * FROM `main_coupons` Where cat_id=".$catId." order by valid_from desc LIMIT $start, $per_page";
$result = mysql_query($query2)or die('MySql Error' . mysql_error());
while($row = mysql_fetch_array($result))
{
$result_pag_data[] = $row;
}

$i = 0;
}
else if ( 0 == strcasecmp($requestFor,'dealday'))
{
$x = 'dealday';
	//echo $x."<br>";
	$deals_of_day = new deals_of_the_day(83,85,86);
	foreach($deals_of_day->deals as $id=>$is)
	{
		//echo $id." ".$is."<br>";
		$query = "SELECT * FROM `main_coupons` Where id = ".$id;
	    	$result = mysql_query($query)or die('MySql Error' . mysql_error());
	    	$count=mysql_num_rows($result);
	    	if($count == 1)
	    	$result_pag_data[] = mysql_fetch_array($result);
	}
	
	$i = $start;
} 
else if ( 0 == strcasecmp($requestFor,'favourite'))
{
$x = 'favourite';
$query2 = "SELECT * FROM usercoupons Where userid = ".$user_id."  LIMIT $start, $per_page";
$result = mysql_query($query2)or die('MySql Error' . mysql_error());
$count=mysql_num_rows($result);
if($count > 0)
{
while($row = mysql_fetch_array($result))
{
$coupon_id = $row["couponid"];
//echo $coupon_id."<br>";
$query3 = "SELECT * FROM main_coupons Where id = ".$coupon_id;
$result3 = mysql_query($query3)or die('MySql Error' . mysql_error());
$count=mysql_num_rows($result3);
if($count == 1)
{
$row1 = mysql_fetch_array($result3);
$result_pag_data[] = $row1;
}
}
}
$i = 0;
}
else
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
//$query2 = "SELECT * FROM `main_coupons` Where 1 LIMIT $start, $per_page";
//$result_pag_data = mysql_query($query2)or die('MySql Error' . mysql_error()); 

//$i = 0; 
$Coupons = array();
while ($i < count($result_pag_data) && $i < $start + $per_page)
{
$row = $result_pag_data[$i];
 $Coupons[$i] = new Coupon;
$Coupons[$i]->couponid = $row['id'];
$Coupons[$i]->name = $row['name'];

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
$Coupons[$i]->image = "http://icoupons.co.in/trinity/uploads/".$row['image'];

$i++;
}

echo json_encode($Coupons); 
endif;
?>