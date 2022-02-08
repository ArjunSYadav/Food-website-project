<?php
session_start();
include "admin/config.php";
include "databasefile.php";

$obj = new homeclass();
$count = 0;
$pr_id = $_POST['pr_id'];
$opertaion = $_POST['type'];

// echo $qunatity .$pr_id;

if ($opertaion == 'add') {

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {

         $obj->insert('dish_cart',["dish_detail_id"=>$pr_id,"qty"=>'1']);
    } else {
        if (isset($_SESSION['cart'])) {
            $item_array_id = array_column($_SESSION['cart'], $pr_id);
            if (in_array($pr_id, $item_array_id)) {
            } else {
                $count = count($_SESSION['cart']);

                $item_array = array('product_id' => $pr_id);
                $_SESSION['cart'][$count] = $item_array;
            }
        } else {
            $item_array = array('product_id' => $pr_id);
            $_SESSION['cart'][0] = $item_array;
        }
    }
}
if($opertaion == 'update'){
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {

        $obj->update('dish_cart',["qty"=>$qunatity],"dish_detail_id = $pr_id ");
   }
}
