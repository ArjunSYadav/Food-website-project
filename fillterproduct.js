$(document).ready(function(){
   $("#add-cart").on("click",function(){

    
    var pro_id =$(".qty").attr("id");
    
    console.log(pro_id);
    addtoCart(pro_id,"add");
   
   });

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
});
