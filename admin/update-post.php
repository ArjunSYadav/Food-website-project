<?php include "header.php";
if ($_SESSION["user_role"] == '0') {

    include "config.php";
    include "_db_pdo.php";
    $obj = new database();
    $product_id = $_GET['postid'];

    $obj->select('product', 'author', null,null, " pr_id={$product_id}",null,null,null);

    // $sql_2 = "SELECT author FROM product WHERE product_id={$product_id}";
    
    $result_2 = $obj2->getResult();
    foreach ($result_2 as list("pr_id "=>$productid, "author"=>$authorname)){
        $row_2= $authorname;
    }
    if ($row_2 != $_SESSION["user_id"]) {
        header("Location: {$hostname}/admin/postt.php");
    }
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update product</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form for show edit-->

                <?php
                include "config.php";
                include "_db_pdo.php";
                $obj = new database();
                $product_id = $_GET['postid'];

                // $sql = "SELECT product.product_id, product.title, product.description, product.product_img, product.category, category.category_name  FROM product LEFT JOIN category ON product.category =category.category_id LEFT JOIN user ON product.author = user.user_id WHERE product.product_id={$product_id}";
                $obj->select('product', " product.pr_id, product.pr_name, product.pr_desc, product.pr_img, product.pr_cat_id, product.pr_price, category.cat_name, user.user_name ", " category ON product.pr_cat_id = category.catid ", " user ON product.author = user.user_id "," product.pr_id={$product_id} ",null,null,null,);
                
                $result = $obj->getResult();
                if (!empty($result))
                 {
                    // while ($row = mysqli_fetch_assoc($result))
                    foreach ($result as list("pr_id"=>$pid, "pr_name"=>$title, "pr_desc"=>$desc, "pr_img"=>$pr_img, "pr_cat_id"=>$pcategory, "pr_price"=>$price, "cat_name"=> $cname, "user_name"=>$username))
                    {
                ?>
                <form action="save-update-post.php" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-group">
                        <input type="hidden" name="post_id" class="form-control" value="<?php echo $pid; ?>"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputTile">Title</label>
                        <input type="text" name="post_title" class="form-control" id="exampleInputUsername"
                            value="<?php echo $title; ?>">
                    </div>
                    <div class="form-group">
                        <label for="for_price">Title</label>
                        <input type="number" name="price" class="form-control" id="exampleInputUsername"
                            value="<?php echo $price; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="postdesc" class="form-control" required rows="5">
                <?php echo $desc; ?>
                </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCategory">Category</label>
                        <select class="form-control" name="category">
                            <option disabled>Select Category</option>
                            <?php
                                    include "config.php";
                                    // include "_db_pdo.php";
                                    // $sql1 = "SELECT * FROM category ";
                                    $obj->select('category','*',null,null,null,null,null,null);
                                    $result1 = $obj->getResult();
                                    if (!empty($result1)) {
                                        // while ($row1 = mysqli_fetch_assoc($result1)) 
                                        foreach ($result1 as list("catid"=>$cid, "cat_name"=>$cname,"cat_product"=>$product)){
                                            if ($pcategory == $cid) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            echo "<option {$selected} value ='{$cid}'>$cname</option>";
                                        }
                                    }
                                   
                                    ?>
                                     
                        </select>
                        <input type="hidden" name="old_category" value= '<?php echo $pcategory ?>'>
                        
                    </div>
                    <div class="form-group">
                        <label for="">product image</label>
                        <input type="file" name="new-image">
                        <?php echo $pr_img ; ?>
                        <img src="upload/<?php echo $pr_img ; ?>" height="150px">
                        <input type="hidden" name="old-image" value="<?php echo $pr_img; ?>">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                </form>
                <?php
                    }
                } else {
                    echo "Result Not found";
                }

                ?>
                <!-- Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>