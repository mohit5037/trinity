<?php 
include("../config.php");

if ($_POST['userid']):
$userid = $_POST['userid'];
  class Category
{
	public $id;
	public $category;
	public $rank;

}
$result = mysql_query("SELECT * FROM users WHERE user_id ='".$userid."'"); 
$row=mysql_fetch_array($result);  
// Make a list of Categories
$Categories = array();
for($i=1;$i<=14;$i++)
{
$Categories[$i] = new Category;
$Categories[$i]->id = $i;
$Categories[$i]->rank = $row['cat'.$i.'_rank'];

$sql="SELECT * FROM categories WHERE id='".$i."' ";
$res=mysql_query($sql);
$r=mysql_fetch_array($res);
$count=mysql_num_rows($res);
if($count==1)
    {   
        $categoryname=$r['name'];   
    }

$Categories[$i]->category = $categoryname;
}
echo json_encode($Categories); 
 endif;
?>