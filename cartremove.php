<?php
session_start();
include "admin/config.php";
include "databasefile.php";
$obj = new homeclass();
$var =false;
$prid=$_POST['pr_id'];

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ){

    $obj->delete('dish_cart',"dish_detail_id = $prid ");
    
    foreach($_SESSION['cart'] as $key=>$value){
        if($value['product_id'] == $prid){
            unset($_SESSION['cart'][$key]);
            $var =true;
        }
    }
    $result = $obj->getResult();
    if(!empty($result) && $var == true){
        echo "true";
    }else{
        echo"false";
    }
    

}else{

    foreach($_SESSION['cart'] as $key=>$value){
        if($value['product_id'] == $prid){
            unset($_SESSION['cart'][$key]);
            $var =true;
        }
    }
    if($var == true){
        echo "true";
    }else{
        echo "false";
    }
}

?>