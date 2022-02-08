<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <form action="save-post.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="post_title">Title</label>
                        <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="postdesc" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="for_price">Price</label>
                        <input type="number" name="pr_price" class="form-control" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Category</label>
                        <select name="category" class="form-control">
                            <?php
                                include "config.php";
                                include "_db_pdo.php";

                                $obj =new database();

                                // $sql ="SELECT * FROM category ";
                                $obj->select("category", "*",null,null,null,null,null,null);
                                    $result =$obj->getResult();
                                    if(!empty($result))
                                    {
                                        // while($row=mysqli_fetch_assoc($result))
                                        foreach ($result as list("catid"=>$id, "cat_name"=>$cname,"cat_product"=>$post)) 
                                        {
                                            echo"<option value ='$id'>{$cname}</option>";
                                        }
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Post image</label>
                        <input type="file" name="fileToUpload" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="save" required />
                </form>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>