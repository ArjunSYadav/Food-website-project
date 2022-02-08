<?php
// include "databasefile.php";

?>
<html lang="en">

<head>
    <?php
     include "header.php";
    // require 'new-header.php';
    ?>
    <style>
    .featured-item {

        width: 220px;


    }

    
    </style>
</head>

<body>



    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="caption">
                        <h2>So fast so yummy!</h2>
                        <div class="line-dec"></div>
                        <p>Pixie food provides you food services. We deleiver food to right at your door step.<strong>10+
                                flavoures</strong> from to choose. You can choose what you like from our local menu.
                            <br><br>Please tell your friends about <a rel="nofollow"
                                href="http://localhost/tem_proj1/pixie/index.php">Pixie food</a> get your faviouret food. 
                        </p>
                        <div class="main-button">
                            <a href="products.php">Order Now!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Ends Here -->

    <!-- Featured Starts Here -->
    <div class="featured-items">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h1>Featured Items</h1>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme">
                        <?php
              $obj =new homeclass();
              $obj->select('product',"*",null,null,null,null,null,null);
              $result =$obj->getResult();
              foreach($result as $row){
              ?>
                        <a href="single-product.php?prid=<?php echo $row['pr_id'];?>">
                            <div class="featured-item">
                                <img src="admin/upload/<?php echo $row['pr_img']?>" height="200px" alt="Item 1"
                                    style="border-radius: 2%">
                                <h4><?php echo $row['pr_name'];?></h4>
                                <h6>Rs:<?php echo $row['pr_price'];?></h6>
                            </div>
                        </a>
                        <?php
              }
            //  style="width: 300px;"
             ?>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featred Ends Here -->

    <!-- Subscribe Form Starts Here -->
    <?php
    include "subscribeus.php";
    ?>
    <!-- Subscribe Form Ends Here -->
    <!-- Footer Starts Here -->
   <?php
   include 'footer.php';
   ?>
    <!--  Footer Ends Here -->


    <!-- Bootstrap core JavaScript -->
    <!-- <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->


    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>


    <script language="text/Javascript">
    cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
    function clearField(t) { //declaring the array outside of the
        if (!cleared[t.id]) { // function makes it static and global
            cleared[t.id] = 1; // you could use true and false, but that's more typing
            t.value = ''; // with more chance of typos
            t.style.color = '#fff';
        }
    }
    </script>


</body>

</php>