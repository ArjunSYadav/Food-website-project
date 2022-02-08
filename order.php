<?php include "header.php";?>
<?php

if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true){
    header ("Location:http://localhost/tem_proj1/pixie/login.php");
}

?>
 
<!DOCTYPE html>
<html lang="en">

<head>



    <style>
        .shopping-cart {
            padding: 3% 0;
        }
        .card-items+.card-items{
            padding: 2% 0;
        }
        .price-details h6{
            padding: 3% 2%;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart">
                    <h6>Order</h6>
                    <hr>
                    <?php 
                    
                    $prid=$_GET['prid'];
                    $total=0;
                    
                                    $obj = new homeclass();
                                    $obj->select('product', "*", null, null, " pr_id = $prid ", null, null, null);
                                    $result = $obj->getResult();
                                    foreach ($result as $row) {
                                            $total=$total+(int)$row['pr_price'];
                                     ?>
                                     <div id="pid<?php echo$row['pr_id']?>">
                    <form action="user_order.php" method="post" class="cart-items">
                    
                        <div class="border-rounded">
                            
                            <div class="row bg-white">
                                
                                <div class="col-md-3 pl-0">
                                   
                                    <img src="admin/upload/<?php echo$row['pr_img']?>" alt="imagName1" class="img-fluid">
                                </div>
                                <div class="col-md-6">
                                    <h5 class="pt-2"><?php echo$row['pr_name']?></h5>
                                    <small class="text-secondry">Seller:dailytution</small>
                                    <h5 class="pt-2" id="rs">Rs:<?php echo$row['pr_price'];?></h5>
                                    <input type="hidden" id="price" value="<?php echo (int)$row['pr_price'];?>">
                                    <input type="hidden" id="pro_id" value="<?php echo (int)$row['pr_id'];?>">
                                    <!-- <button type="button" class="btn btn-primary">Order</button> -->
                                    <!-- <button type="button" class="btn btn-danger mx-2" onclick="remove(<?php echo $row['pr_id'];?>)" name="remove">Remove</button> -->
                                </div>
                                <div class="col-md-3 py-5">
                                    <div>
                                        <button type="button" class="btn bg-light border rounded-circle plus"  onclick="plus(<?php echo $row['pr_price'];?>)"><i class="fas fa-plus"></i></button>
                                        <input type="number" value="1" id="qunatity" class="form-control w-25% d-inline">
                                        <button type="button" class="btn bg-light border rounded-circle minus" onclick="minus(<?php echo $row['pr_price'];?>)"><i class="fas fa-minus" ></i></button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <button type="button" class="btn btn-primary" onclick="add_order()" id="submit">Order</button>
                                <button type="button" class="btn btn-danger mx-2" onclick="remove(<?php echo $row['pr_id'];?>)" name="remove">Remove</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- <a href="order-sent.php?userid=<?php echo $_SESSION["user_id"];?>"> -->
                </div>
                </div>
                <?php
                                         
                                         
            }
               
               ?>
               <div class=" col-md-4 offset-md-1 border rounded md-5 bg-white h-50 ">
                   <div class="pt-4">
                       <h6>Price Details</h6>
                       <hr>
                       <div class="row price-details">
                           <div class="col-md-6">
                              <?php
                              if(isset($_GET['prid'])){

                                  echo"<h6>Price ( 1 item) </h6>";

                              }else{
                                echo"<h6>Price (0 items)</h6>";
                              }
                              
                              ?>
                              <h6>Delivery Charges</h6>
                              <hr>
                              <h6>Amount Payable</h6>
                           </div>
                           <div class="col-md-6">
                               <input type="hidden" class="price" value="<?php echo (int)$row['pr_price'];?>">
                               <h6><?php echo "Rs:".$total;?></h6>
                               <h6 class="text-success">FREE</h6>
                               <hr>
                               <h6>Rs:<label id="show"><?php echo (int)$row['pr_price'];?><label></h6>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
        
    </div>
</body>

</html>
<script src="vendor/jquery/jquery.js"></script>
<script >
  
function remove(id){
    // console.log(id);
    $("#pid"+id).remove();
    $.ajax({
        url : "cartremove.php",
        type : "POST",
        data : {pr_id: id},
        success : function(data,response){
            if(response == "true"){
                alert("item have been removed");
            }
            if(response == "false"){
                alert("item could not be removed");
            }
        }
    });
    
}
var qtyval= $("#qunatity").val();



function qunatityof(id){
    var qtyval= $("#qunatity").val();
    console.log(qtyval +id );
    
}
function plus(rs){
     var qtyval=parseInt( $("#qunatity").val());
    
     qtyval+=1;
    $("#qunatity").val(qtyval);
   console.log((rs*qtyval));
   $("#show").text((rs*qtyval));
   $("#price").val((rs*qtyval));
    
}
function minus(rs){
     var qtyval=parseInt( $("#qunatity").val());
     qtyval-=1;
    $("#qunatity").val(qtyval);
    console.log((rs*qtyval));
    $("#show").text((rs*qtyval));
    $("#price").val((rs*qtyval));
}

function add_order(){
    var pr_id =parseInt($("#pro_id").val());
        var qty =parseInt($("#qunatity").val());
        var price =parseInt($("#price").val());
        // console.log(price);
        // console.log(qty);
        // console.log(pr_id);
        $.ajax({
            url: "order-sent.php",
            type: "POST",
            data: {
               
                proid: pr_id,
                quantity: qty,
                total: price
            },
            success: function(data) {
                // $(".php").html(data);
                 alert(data);
                
                
            } 
        });
}

</script>

<!-- <script src="ordersent.js"></script> -->