<!DOCTYPE html>
<html lang="en">

  <head>

  <?php include "header.php";?>
<!--
Tooplate 2114 Pixie
https://www.tooplate.com/view/2114-pixie
-->
<style>
  .cat_img{
    max-height: 150px;
  }
</style>
  </head>

  <body>
    
  

    <!-- Page Content -->
    <!-- Items Starts Here -->
    <div class="featured-page">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <div class="section-heading">
              <div class="line-dec"></div>
              <h1>Featured Items</h1>
            </div>
          </div>
          <?php
               $catid= $_GET['catid'];
               if($catid != '*'){
               ?>
          <div class="col-md-8 col-sm-12">
            <div id="filters" class="button-group">
              <button  class="btn btn-primary rs" data-filter="*" onclick="getprice(0,<?php echo $catid;?>)" value="all" >All Products</button>
              <button class="btn btn-primary rs"  data-filter=".new" onclick="getprice(1,<?php echo $catid;?>)" value="new">Newest</button>
              <button class="btn btn-primary rs" data-filter=".low" onclick="getprice(150,<?php echo $catid;?>)" value="low">Low Price</button>
              <button class="btn btn-primary rs" data-filter=".high" onclick="getprice(250,<?php echo $catid;?>)"  value="high">Hight Price</button>
              <!-- High Price<input type="button" class="btn btn-primary " onclick="getprice(250)" id="3" value="high"> -->
            </div>
          </div><?php }?>
        </div>
      </div>
    </div>
  
    <div class="featured container no-gutter">

        <div class="row posts php">

       <?php
       
    //    include "databasefile.php";
    $catid= $_GET['catid'];
    // echo $catid;
    // die();
       $obj = new homeclass();
       if($catid == '*'){
        $obj->select('category',"*",null,null,null,null,null,null);
        $result=$obj->getResult();
        foreach($result as $row_1){
            echo ' <div class="item low col-md-4">
            <a href="category.php?catid='.$row_1['catid'].'">
              <div class="featured-item">
              <img class="cat_img" src="assets/images/'.$row_1['cat_image'].'" alt="">
                <h4>'.$row_1['cat_name'].'</h4>
              </div>
            </a>
          </div>';
        }
       }else{
        $obj->select('product',"*",null,null,"pr_cat_id = $catid ",null,null,null);
       }
      
       $result =$obj->getResult();
       foreach($result as $row){
       ?>
            <div class="item low col-md-4">
              <a href="single-product.php?prid=<?php echo $row['pr_id'];?>">
                <div class="featured-item">
                  <img src="admin/upload/<?php echo $row['pr_img'];?>" alt="">
                  <h4><?php echo $row['pr_name'];?></h4>
                  <h6>Rs:<?php echo $row['pr_price'];?></h6>
                </div>
              </a>
            </div>
           <?php
             }
           
           ?>
            
        </div>
    </div>

    <div class="page-navigation">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ul>
              <li class="current-page"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Featred Page Ends Here -->


     <!-- Subscribe Form Starts Here -->
     <?php
    include 'subscribeus.php';
    
    ?>
    <!-- Subscribe Form Ends Here -->



    <!-- Footer Starts Here -->
   <?php
   include 'footer.php';
   
   ?>
    <!-- Sub Footer Ends Here -->


    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/isotope.js"></script>

<!-- <script src="fillterproduct.js"></script> -->
<script>
    function getprice(rs,catid){
            $.ajax({
                url: "filter_data_category.php",
                type: "POST",
                data: {
                    first_name: rs,
                    category: catid,
                },
                success: function(data) {
                    $(".php").html(data);
                }
            });
        }
</script>
    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>


  </body>

</html>