<?php
session_start();
include "admin/config.php";
include "databasefile.php";

$user_id = $_SESSION['user_id'];
$obj =new homeclass();
$pr_id = $_POST['proid'];
$qty = $_POST['quantity'];
$total_price = $_POST['total'];

$obj->insert('user_order',["user_id"=>$user_id,"pr_id"=>$pr_id,"pay"=>$total_price,"quantity"=>$qty]);
$result=$obj->getResult();

if(!empty($result)){
    echo "order have been added in queue";
}else{
    echo"Order could not be post";
}


?>

