
<?php include "header.php";?>
<head>

    <style>
    .shopping-cart {
        padding: 3% 0;
    }

    .card-items+.card-items {
        padding: 2% 0;
    }

    .price-details h6 {
        padding: 3% 2%;
    }
    </style>

</head>

<div class="container w-100" style="margin-top: 10%;">

    <?php
   $user_id= $_GET['userid'];
    $obj =new homeclass();
    $obj->select('user',"*",null,null," user_id = $user_id ",null,null,null);
    $result = $obj->getResult();
    foreach($result as $row){
   ?>
   <div >
    <form action="user_update.php" method="POST">
        <div class="form-group ">
            <input type="hidden" name="user_id" class="form-control " value="<?php echo $row['user_id']; ?>"
                placeholder="">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address:</label>
            <input type="email" class="form-control w-75" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="<?php echo $row['email']?>">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="firstname">Fisrt Name:</label>
            <input type="text" class="form-control w-75" name="firstname" id="firstname"
                value="<?php echo $row['first_name']?>">
        </div>
        <div class="form-group">
            <label for="lastname">Last Name:</label>
            <input type="text" class="form-control w-75" name="lastname" id="lastname"
                value="<?php echo $row['last_name']?>">
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control w-75" name="username" id="username"
                value="<?php echo $row['user_name']?>">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <input type="submit" class="form-group btn btn-primary" value="Update">
    </form>
    
    <?php
    }
 
 ?>
   </div>
</div>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart">
                    <h6>Order History</h6>
                    <hr>
                    <?php 
                    $total=0;
                    $user_id = $row['user_id'];
                                    // echo $product_id;
                                    $obj = new homeclass();
                                    $obj1=new homeclass();
                                    $obj->select('user_order', "*", null, null," user_id = $user_id ", null, null, null);
                                    $result1 = $obj->getResult();
                                    foreach ($result1 as $row1) {

                                            $obj1->select('product', "*",null,null,null,null,null,null);
                                            $result2=$obj1->getResult();
                                            foreach($result2 as $row2){
                                                    if($row1['pr_id'] == $row2['pr_id']){

                                                    
                                     ?>
                    <div id="pid<?php echo$row2 ['pr_id']?>">
                        <form class="cart-items">

                            <div class="border-rounded">

                                <div class="row bg-white">

                                    <div class="col-md-3 pl-0">

                                        <img src="admin/upload/<?php echo$row2['pr_img']?>" alt="imagName1" class="img-fluid">
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="pt-2"><?php echo$row2['pr_name']?></h5>
                                        <small class="text-secondry">Order Date-<?php echo $row1['order_date'];?></small>
                                        <h5 class="pt-2">Rs:<?php echo$row2['pr_price'];?></h5>
                                    </div>
                                    <div class="new rounded-top new rounded-bottom h-100 bg-secondary mt-3 ">
                                        <div class="col-md-3 pt-2 ">
                                            <div>
                                                <h5>Quantity:<?php echo$row1['quantity'];?></h5>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="new rounded-top new rounded-bottom h-100 w-20 bg-info ml-0">
                                            <div class="col-md-3 pt-1 ">
                                                
                                                    <h5>Total Pay:<?php echo$row1['pay'];?></h5>
                                                
                                            </div>

                                        </div>
                                </div>
                        </form>

                    </div>
                    <?php
                                         }
                                        }
                                    }
                                         
            
               
               ?>
                </div>