$(document).ready(function(){

    $("#submit").on("submit",function(){
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
               
                proid: id,
                quantity: qty,
                total: price
            },
            success: function(data) {
                // $(".php").html(data);
                 alert(data);
                
                
            } 
        });
        // addorder_cart(pr_id,qty,price);
    });

    function addorder_cart(prid,qty,total_price){
        $.ajax({
            url: "order-sent.php",
            type: "POST",
            data: {proid: prid,
                   quantity: qty,
                    price: total_price
                },
                success: function(data){
                    alert("order has been added to queue");
                }
        });
    }
});