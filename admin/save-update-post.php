<?php
include "config.php";

include "_db_pdo.php";
$obj = new database();

    if(empty($_FILES['new-image']['name']))
    {
        $target =$_POST['old-image'];
    }else{
        
        $errors =array();

        $file_name =$_FILES['new-image']['name'];
        $file_size =$_FILES['new-image']['size'];
        $file_tmp =$_FILES['new-image']['tmp_name'];
        $file_type =$_FILES['new-image']['type'];
        $file_ext =explode('.',$file_name);
        $fileActualExit =strtolower(end($file_ext));

        $extension =array("jpeg","jpg","png");
        if(in_array($fileActualExit,$extension) === false)
        {
            $errors[]="this extension filetype is not allowed, please choose a jpg, png ,or jpeg";

        }
       

        if($file_size >2097152)
        {
            $errors[] ="File size must be 2mb or lower";
        }
        $new_name= time()."-".basename($file_name);
        $target ="upload/".$new_name;
        $image_name =$new_name;
        if(empty($errors)==true)
        {
            move_uploaded_file($file_tmp,$target);

        }
        else{
            print_r($errors);
            die();
        }
    }

$sql="";
$obj->update('product',["pr_name"=>$_POST['post_title'], "pr_desc"=>$_POST['postdesc'], "pr_cat_id"=>$_POST['category'], "pr_price"=>$_POST['price'], "pr_img"=>$image_name], "pr_id ={$_POST['post_id']} ");
// $sql ="UPDATE post SET title ='{$_POST['post_title']}', description='{$_POST['postdesc']}', category={$_POST['category']}, post_img='{$new_name}' WHERE post_id={$_POST['post_id']};";
$result =$obj->getResult();
// echo"<pre>";
// print_r($result);
// echo"</pre>";
// die();
// echo "<pre>";
// print_r($result);
// echo "</pre>";
 if($_POST['old_category'] != $_POST['category'])
 {   

     echo $_POST['old_category']."</br>";
    
     echo $sql ="UPDATE category SET cat_product = cat_product-1 WHERE catid = {$_POST['old_category']};";
      echo $sql.="UPDATE category SET cat_product = cat_product+1 WHERE catid = {$_POST['category']}";
    
     $row= mysqli_multi_query($conn,$sql);
     
 }

//  $result1 = or die("sql commoand didnt work");
// mysqli_multi_query($conn,$sql) or die("cetgeory sqlfail");

if(!empty($result) )
{
    header("Location:{$hostname}/admin/post.php");

}else{
    echo"querry Failed";
}


?>