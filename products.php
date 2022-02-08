<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "header.php";?>
    <!--
Tooplate 2114 Pixie
https://www.tooplate.com/view/2114-pixie
-->
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
                <div class="col-md-8 col-sm-12">
                    <div id="filters" class="button-group">
                        <button class="btn btn-primary rs" data-filter="*" onclick="getprice(0,-1)" value="all">All
                            Products</button>
                        <button class="btn btn-primary rs" data-filter=".new" onclick="getprice(1,-1)"
                            value="new">Newest</button>
                        <button class="btn btn-primary rs" data-filter=".low" onclick="getprice(150,-1)" value="low">Low
                            Price</button>
                        <button class="btn btn-primary rs" data-filter=".high" onclick="getprice(250,-1)"
                            value="high">Hight Price</button>
                        <!-- High Price<input type="button" class="btn btn-primary " onclick="getprice(250)" id="3" value="high"> -->
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" onclick="getprice(-1,0)" type="radio" name="foodType" value="veg">
                            <label class="form-check-label " for="foodType"> Veg
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" onclick="getprice(-1,1)" type="radio" name="foodType" value="non-veg">
                            <label class="form-check-label" for="foodType"> Non-Veg
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="featured container no-gutter">

        <div class="row posts php">

            <?php
       
      //  include "databasefile.php";
       $obj = new homeclass();
       $obj->select('product',"*",null,null,null,null,null,null);
       $result =$obj->getResult();
       foreach($result as $row){
       ?>
            <div class="item low col-md-4">
                <a href="single-product.php?prid=<?php echo $row['pr_id'];?>">
                    <div class="featured-item">
                        <img src="admin/upload/<?php echo $row['pr_img'];?>" alt="" style="border-radius: 2%">
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
    
    function getprice(rs,id) {
        $.ajax({
            url: "filter_data.php",
            type: "POST",
            data: {
                first_name: rs,
                type: id
            },
            success: function(data) {
                $(".php").html(data);
            }
        });
    }
    </script>
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

</html>