
        


<head>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
    <!-- Bootstrap core CSS -->
<?php include "header.php";?>
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

<div class="bg-light" style="margin-top: 10%;">
    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart">
                    <h6>My Cart</h6>
                    <hr>
                    <?php 
                    if(isset($_SESSION['cart'])){
                    $total=0;
                    $product_id = array_column($_SESSION['cart'], 'product_id');
                                    // echo $product_id;
                                    $obj = new homeclass();
                                    $obj->select('product', "*", null, null, null, null, null, null);
                                    $result = $obj->getResult();
                                    foreach ($result as $row) {
                                        foreach ($product_id as $id) {
                                            if ($row['pr_id'] == $id) {
                                            $total=$total+(int)$row['pr_price'];
                                     ?>
                                     <div id="pid<?php echo$row['pr_id']?>">
                    <form action="cartremove.php" method="post" class="cart-items">
                    
                        <div class="border-rounded">
                            
                            <div class="row bg-white">
                                
                                <div class="col-md-3 pl-0">
                                   
                                    <img src="admin/upload/<?php echo$row['pr_img']?>" alt="imagName1" class="img-fluid">
                                </div>
                                <div class="col-md-6">
                                    <h5 class="pt-2"><?php echo$row['pr_name']?></h5>
                                    <small class="text-secondry">Seller:dailytution</small>
                                    <h5 class="pt-2">Rs:<?php echo$row['pr_price'];?></h5>
                                    <button type="button" class="btn btn-warning" onclick="qunatityof(<?php echo $row['pr_id'];?>)" >Save for Later</button>
                                    <button type="button" class="btn btn-danger mx-2" onclick="remove(<?php echo $row['pr_id'];?>)" name="remove">Remove</button>
                                </div>
                                
                                <div class="col-md-3 py-5">
                                    <div>
                                        <button type="button" class="btn bg-light border rounded-circle minus" onclick="minus()"><i class="fas fa-minus"></i></button>
                                        <input type="number" value="1" id="qunatity" class="form-control w-25% d-inline">
                                        <button type="button" class="btn bg-light border rounded-circle plus" onclick="plus()"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-5 ">
                                <a href="order.php?prid=<?php echo $row['pr_id'];?>"><button type="button" class="btn btn-primary ">Order Now!</button></a>
                                </div>
                            </div>
                        </div>
                    </form>
               
                </div>
                </div>
                <?php
                                         }
                                         }
            }
               
               ?>
               <div class=" col-md-4 offset-md-1 border rounded md-5 bg-white h-25">
                   <div class="pt-4">
                       <h6>Price Details</h6>
                       <hr>
                       <div class="row price-details">
                           <div class="col-md-6">
                              <?php
                              if(isset($_SESSION['cart'])){
                                  $count =count($_SESSION['cart']);
                                  echo"<h6>Price ($count items)</h6>";

                              }else{
                                echo"<h6>Price (0 items)</h6>";
                              }
                              
                              ?>
                              <h6>Delivery Charges</h6>
                              <hr>
                              <h6>Amount Payable</h6>
                           </div>
                           <div class="col-md-6">
                               <h6><?php echo "Rs:".$total;?></h6>
                               <h6 class="text-success">FREE</h6>
                               <hr>
                               <h6>Rs:<?php echo $total;?></h6>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
        
    </div>
                            </div>
                           <?php
                    }
                           else{
                           ?>

                           <div class="container">
                            <h5>No Dish in Cart</h5>
                           </div>
<?php
                           }

?>

<!-- <script src="vendor/jquery/jquery.js"></script> -->

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
function plus(){
     var qtyval=parseInt( $("#qunatity").val());
     qtyval+=1;
    $("#qunatity").val(qtyval);
}
function minus(){
     var qtyval=parseInt( $("#qunatity").val());
     qtyval-=1;
    $("#qunatity").val(qtyval);
}
</script>