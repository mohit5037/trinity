<?php 
include("../config.php");
$result = mysql_query("SELECT * FROM categories WHERE 1");         
  class Category
{
	public $id;
	public $category;
	public $prefrence;

}
// Make a list of Categories
$Categories = array();
// Make a new Category
$i = -1;
     while($row2 = mysql_fetch_array($result))
     {
       $i++;
$Categories[$i] = new Category;
$Categories[$i]->id = $row2['id'];
$Categories[$i]->category = $row2['name'];
$Categories[$i]->prefrence = $i+2;          
     }
echo json_encode($Categories); 

?>