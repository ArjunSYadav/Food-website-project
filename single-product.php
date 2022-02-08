<!DOCTYPE html>
<html lang="en">

  <head>
  <?php include "header.php";?>

  </head>

    <!-- Page Content -->
    <!-- Single Starts Here -->
    <div class="single-product">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <div class="line-dec"></div>
             <?php
             
            //  session_start();
             $prid=$_GET['prid'];
             
             $obj =new homeclass();
             $obj->select('product',"pr_cat_id",null,null,"pr_id =$prid ",null,null,null);
             $result = $obj->getResult();
            //  print_r($result);
             $catid= $result[0]['pr_cat_id'];
             $obj->select('category',"*",null,null,"catid = $catid ",null,null,null);
             $result1 =$obj->getResult();
             foreach($result1 as $row){

             
             ?>
              <h1><?php echo $row['cat_name']?></h1>
             <?php
             }
             
             ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="product-slider">
              <div id="slider" class="flexslider">
                <ul class="slides">
                 <?php
                 $prid=$_GET['prid'];
             
                 $obj =new homeclass();
                 $obj->select('product',"pr_img",null,null,"pr_id =$prid ",null,null,null);
                 $result = $obj->getResult();
                //  print_r($result);
                 $pr_img= $result[0]['pr_img'];
                 
                 ?>
                  <li>
                    <img src="admin/upload/<?php echo ltrim($pr_img)?>" />
                  </li>
                  
                  <!-- items mirrored twice, total of 12 -->
                </ul>
              </div>
              <div id="carousel" class="flexslider">
                <ul class="slides">
                  <li>
                  <img src="admin/upload/<?php echo ltrim($pr_img)?>" />
                  </li>
                  
                  <!-- items mirrored twice, total of 12 -->
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-content">
            <?php
             
             //  session_start();
              $prid=$_GET['prid'];
              
              $obj1 =new homeclass();
              $obj1->select('product',"*"," category ON product.pr_cat_id = category.catid ",null,"pr_id =$prid ",null,null,null);
              $result2 = $obj1->getResult();
              foreach($result2 as $row1){
              ?>
              <h4><?php echo $row1['pr_name']?></h4>
              <h6>Rs:<?php echo $row1['pr_price']?></h6>
              <p><?php echo $row1['pr_desc']?></p>
              <span>7 left on stock</span>
              <form action="" method="get">
                    <input type="button" class="button" onclick="addtoCart(<?php echo $row1['pr_id']?>,'add')" id="add-cart" name="cart"  value="add to cart">
                    <a href="order.php?prid=<?php echo $row1['pr_id'];?>"><input type="button" class="button" name="order" value="Order Now!"></a>
              </form>
              <div class="down-content">
                <div class="categories">
                  <h6>Category: <span><a href="#"><?php echo $row1['cat_name']?></a></span></h6>
                </div>
                <div class="share">
                  <h6>Share: <span><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-linkedin"></i></a><a href="#"><i class="fa fa-twitter"></i></a></span></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
             <?php
              }
             
             ?>
    <!-- Single Page Ends Here -->


    <!-- Similar Starts Here -->
    <div class="featured-items">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <div class="line-dec"></div>
              <h1>You May Also Like</h1>
            </div>
          </div>
          <div class="col-md-12">
            <div class="owl-carousel owl-theme">
         <?php
              $obj2 =new homeclass();
              $catid=$row1['pr_cat_id'];
              $obj2->select('product',"*",null,null,"pr_cat_id = $catid ",null,null,null);
              $result3 = $obj2->getResult();
              foreach($result3 as $row3){         
         ?>
         
            <a href="single-product.php?prid=<?php echo $row3['pr_id'];?>">
                <div class="featured-item">
                  <img src="admin/upload/<?php echo ltrim($row3['pr_img']);?>" alt="Item 1">
                  <h4><?php echo $row3['pr_name'];?></h4>
                  <h6>Rs:<?php echo $row3['pr_price'];?></h6>
                </div>
              </a>
             <?php
              }
             
             ?>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Similar Ends Here -->


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
    <!-- <script src="fillterproduct.js"></script> -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/flex-slider.js"></script>


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
    <script>
      function addtoCart(id,type){
            $.ajax({
                url: "add_to_cart.php",
                type: "POST",
                data: {
                   
                    pr_id: id,
                    type: type
                },
                success: function(data) {
                    // $(".php").html(data);
                     alert(data);
                    
                    
                } 
            });
       }
    </script>

  </body>

</php>
