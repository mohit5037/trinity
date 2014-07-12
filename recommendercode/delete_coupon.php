<?php
include 'config.php';

$coupon_id = 114;

class deleter
{
    var $main_coupon_rows;
    
    function deleter($coupon_id , $number_of_sc)
    {
        $this->get_info($coupon_id , $number_of_sc);
        $this->shifter($coupon_id , $number_of_sc);
    }
    
    function shifter($coupon_id , $number_of_sc)
    {
        $i=0;
        $j=1;
        for($i = 0 ; $i < count($this->main_coupon_rows) ; $i++)
        {
            for($j = 1 ; $j <= $number_of_sc ; $j++)
            {
                if($this->main_coupon_rows[$i]["sc".$j."_id"] == $coupon_id)
                {
                    break;
                }
            }
            
            //$j is the position of the coupon to be deleted and from here on left shift is to be done
            
            for($t =$j ; $t<= ($number_of_sc-1) ; $t++)
            {
                $t_inc = $t+1;
                if($this->main_coupon_rows[$i]["sc".$t_inc."_id"] == NULL)
                {
                    $this->main_coupon_rows[$i]["sc".$t."_id"] = NULL;
                    $this->main_coupon_rows[$i]["sc".$t."_cat_id"] = NULL;
                    $this->main_coupon_rows[$i]["sc".$t."_c_value"] = NULL;
                }
                else
                {
                    $this->main_coupon_rows[$i]["sc".$t."_id"] = $this->main_coupon_rows[$i]["sc".$t_inc."_id"];
                    $this->main_coupon_rows[$i]["sc".$t."_cat_id"] = $this->main_coupon_rows[$i]["sc".$t_inc."_cat_id"];
                    $this->main_coupon_rows[$i]["sc".$t."_c_value"] = $this->main_coupon_rows[$i]["sc".$t_inc."_c_value"];  
                }
                
            }
            $this->main_coupon_rows[$i]["sc".$t."_id"] = NULL;
            $this->main_coupon_rows[$i]["sc".$t."_cat_id"] = NULL;
            $this->main_coupon_rows[$i]["sc".$t."_c_value"] = NULL;
            
            $this->insert_updated_data($i, $number_of_sc, $coupon_id);
        }
        
        
        $query = "select * from main_coupons where id = ".$coupon_id;
        $result = mysql_query($query) or die("query failed");
        $delete_coupon = mysql_fetch_array($result);
        
        // inserting into dead table
        $id1 = $delete_coupon["id"];
        $cat_id1 = $delete_coupon["cat_id"];
        $name1= $delete_coupon["name"];
        $description1 = $delete_coupon["description"];
        $create_date1 = $delete_coupon["create_date"];
        $valid_from1 = $delete_coupon["valid_from"];
        $valid_to1 = $delete_coupon["valid_to"];
        $merchant_id1 = $delete_coupon["merchant_id"];
        $approved_date1 = $delete_coupon["approved_date"];
        
        $query = "insert into dead (id, cat_id, name, description, valid_from, valid_to, merchant_id,approved_date,delete_date) values ('".$id1."','".$cat_id1."','".$name1."','".$description1."','".$valid_from1."','".$valid_to1."','".$merchant_id1."','".$approved_date1."', now())";
        echo "dead query = ".$query."<br>";
        $result = mysql_query($query) or die("insert into dead table failed ".mysql_error());
        
        $query = "delete from main_coupons where id='".$coupon_id."'";
        $result = mysql_query($query) or die("row not deleted");
        
        $query = "delete from counts where coupon1_id = '".$coupon_id."' or coupon2_id = '".$coupon_id."'";
        $result = mysql_query($query) or die("counts row not deleted");
        
        
    }
    
    function insert_updated_data($row_number, $number_of_sc , $c_id)
    {
        $query = $this->generate_insert_query($row_number, $number_of_sc);
        $result = mysql_query($query) or die("row not updated ".mysql_error());
        
    }
    
    function generate_insert_query($row_number, $number_of_sc)
    {
        $query1 = "update main_coupons set ";
        for($i = 1 ; $i <= $number_of_sc ; $i++)
        {
            $sc_id = $this->main_coupon_rows[$row_number]["sc".$i."_id"];
            $sc_c_value = $this->main_coupon_rows[$row_number]["sc".$i."_c_value"];
            $sc_cat_id = $this->main_coupon_rows[$row_number]["sc".$i."_cat_id"];
            if($sc_id == NULL)
            $query2 = "sc".$i."_id = NULL , sc".$i."_c_value = NULL , sc".$i."_cat_id = NULL";
            else
            $query2 = "sc".$i."_id = ".$sc_id." , sc".$i."_c_value = ".$sc_c_value." , sc".$i."_cat_id = ".$sc_cat_id."";
            if($i < $number_of_sc)
            $query2 = $query2." , ";
            $query1 = $query1.$query2;
        }
       
        $query1=$query1."where id=".$this->main_coupon_rows[$row_number]["id"];
        echo " insert query = ".$query1."<br>";
        return $query1;
    }
    function get_info( $coupon_id , $number_of_sc)
    {
        $query = $this->generate_query( $coupon_id , $number_of_sc );
        echo $query."<br>";
        $result = mysql_query($query) or die("The query did n't run");
        while($main_coupon_row = mysql_fetch_array($result))
        {
            $this->main_coupon_rows[] = $main_coupon_row;
            echo "coupon_id = ".$main_coupon_row["id"]."<br>";
        }
    }
    
    
    function generate_query($coupon_id , $number_of_sc)
    {
        $query1 = "select * from main_coupons where ";
        for($i = 1 ; $i <= $number_of_sc ; $i++)
        {
            $query2 = " sc".$i."_id = '".$coupon_id."'";
            if($i<15)
            $query2 = $query2." or ";
            $query1 = $query1.$query2;
        }
        return $query1;
    }
}

$delete = new deleter($coupon_id , $number_of_sc);
?>