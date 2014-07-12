<?php
include("../config.php");

if ($_POST['couponId']):
$couponId = $_POST['couponId'];
$userId = $_POST['userId'];
  class Coupon
{
	public $couponid;
	public $category;
	public $name;
        public $description;
        public $price;
        public $image;
        public $rating;
        public $favourite;
        public $review;
}
$query2 = "SELECT * FROM `main_coupons` Where id='".$couponId."'";
$resCou=mysql_query($query2);
$row=mysql_fetch_array($resCou);


$sql="SELECT * FROM categories WHERE id='".$row['cat_id']."' ";
$res=mysql_query($sql);
$r=mysql_fetch_array($res);


$sql1="SELECT * FROM usercoupons WHERE couponid='".$couponId."' and userid ='".$userId."'";
$res1=mysql_query($sql1);
$r1=mysql_fetch_array($res1);
$count=mysql_num_rows($res1);


$coupon = new Coupon;


$coupon->couponid = $row['id'];
$coupon->name = $row['name'];
$coupon->category = $r['name'];
$coupon->description = $row['description'];
$coupon->price = $row['price'];
$coupon->image = "http://icoupons.co.in/trinity/uploads/".$row['image'];
if($count==1)
    {   
        $coupon->rating =$r1['rating'];  
        $coupon->favourite =$r1['favourite'];
        $coupon->review =$r1['review'];
    }
else
{
     $coupon->rating ='0';  
     $coupon->favourite ='no';
     $coupon->review ='';
}

echo json_encode($coupon);
endif;
?>