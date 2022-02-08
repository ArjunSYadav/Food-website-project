<?php

include "admin/config.php";
include "databasefile.php";

$obj =new homeclass();
$price = $_POST['first_name'];
$type = $_POST['type'];

$rs = 150;
if($price == 0){
   
    $obj->select('product',"*",null,null,null,null,null,null);
}
if($price == 1 ){
   
    $obj->select('product',"*",null,null,null,"pr_id DESC ",null,null);
}
if($price == 1 ){
   
    $obj->select('product',"*",null,null,null,"pr_id DESC",null,null);
}
if($price == 150 ){
   
    $obj->select('product',"*",null,null,"pr_price < $rs ",null,null,null);
}
if($type !=-1){
   
    $obj->select('product',"*",null,null,"veg_or_non = $type ",null,null,null);
}
if($price == 250 ){
   
    $obj->select('product',"*",null,null,"pr_price > $rs ",null,null,null);
}
if( $type != -1){
   
    $obj->select('product',"*",null,null,"veg_or_non = $type ",null,null,null);
}

$result = $obj->getResult();

$output= '';
if(!empty($result)){
    foreach($result as $row){
            
        $output='<div class="item col-md-4">
        <a href="single-product.php?='.$row['pr_id'].'">
        <div class="featured-item">
            <img src="admin/upload/'.$row['pr_img'].'" alt="">
            <h4>'.$row['pr_name'].'</h4>
            <h6>Rs:'.$row['pr_price'].'</h6>
        </div>
        </a>
    </div>';
    echo $output;
   
    }
   

   

}
else{
    echo "no record found";
}
?>