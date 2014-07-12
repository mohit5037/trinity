<?php 
include("config.php");
$result = mysql_query("SELECT * FROM categories WHERE 1");         
  class Category
{
	public $id;
	public $category;
	public $description;
	public $tablename;
}
// Make a list of Categories
$Categories = array();
// Make a new Category
$i = -1;
     while($row2 = mysql_fetch_array($result))
     {
       $i++;
$Categories[$i] = new Category;
$Categories[$i]->id = $row2['categoryid'];
$Categories[$i]->category = $row2['category'];
$Categories[$i]->description = $row2['description'];
$Categories[$i]->tablename = $row2['tablename']; 
         
     }
echo json_encode($Categories); 

?>