<?php
include "config.php";

    $post_id =$_GET['postid'];
    $cat_id=$_GET['catid'];

    
    $sql1="SEECT * FROM product WHERE pr_id ={$post_id}";

    $result =mysqli_query($conn,$sql) or die("Querry Failed : Select");
    $row =mysqli_fetch_assoc($result);
    unlink("upload/".$row['post_img']);


    $sql="DELETE FROM product WHERE pr_id ={$post_id};";
    
    $sql.="UPDATE category SET cat_product= cat_product-1 WHERE catid ={$cat_id}";

    if(mysqli_multi_query($conn,$sql))
    {
        header("Location:{$hostname}/admin/post.php");
    }else{
        echo "Query failed";
    }

?>