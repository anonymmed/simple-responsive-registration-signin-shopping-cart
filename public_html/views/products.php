<?php
require_once(__DIR__."/../layout/header.php");
require_once (__DIR__."/../../Controller/ProductController.php");
require_once (__DIR__."/../../Controller/RatingController.php");
?>
<div class="container">
    <?php
    require_once (__DIR__."/../layout/topmenu.php");
    ?>
    <br>
    <hr>
    <div class="row">
        <div class="col-md-2 col-md-offset-5">
            <strong style="margin-left: 20px;" class="alert-success">Our Products</strong>
        </div>
    </div>
    <hr>
    <br>
    <div id="products" class="row list-group">
        <?php
        $ratingController = new RatingController();
        $productController = new ProductController();
        foreach ($productController->getAllProducts() as $product) {
            ?>
            <div class="item  col-xs-4 col-lg-3">
                <div class="thumbnail" style="width: 480px;height: 480px;">
                    <img style="width: 200px;height: 200px;" class="group list-group-image" src="../images/<?= $product['product_name'].'.jpg';?>" alt="<?= $product['product_name']; ?>"/>
                    <div class="caption">
                        <h4 class="group inner list-group-item-heading">
                            Product name: <?= $product['product_name']; ?></h4>
                        <p class="lead">
                            Quantity: <?= $product['quantity'];?></p>
                        <p class="lead"> Price : <?= $product['price'];?>$</p>
                        <p class="lead" data-id="<?=$product['id'];?>"> Rating : <?= $ratingController->getRatingByProductId($product['id']);?>/5</p>
                        <div class="row">
                                  <div class="rateyo-readonly-widg" data-id="<?=$product['id'];?>" style="bottom: 20px;"></div>
                            <div class="col-xs-12 col-md-10">
                                <a class="btn btn-success cart" data-id="<?=$product['id'];?>" href="" >Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php
        }
        ?>
    </div>
</div>
<script>
    function refreshRating () {
        var newRate;
        $.ajax({
            type:'post',
            url:'../../action.php',
            data:'rating=getRating',
            cache:false,
            success:function (response) {
                $.each(JSON.parse(response),function (key, value) {

                    $(".rateyo-readonly-widg[data-id="+value.product_id+"]").rateYo({

                        rating: value.rate,
                        numStars: 5,
                        precision: 2,
                        minValue: 1,
                        maxValue: 5
                    }).on("rateyo.change", function (e, data) {

                        console.log(data.rating);
                        newRate= data.rating;
                    }).on("click",function (e2, data2) {
                        $.ajax({
                            type:'get',
                            url:'../../action.php',
                            data:'insertRating=insertRating&product_id='+value.product_id+'&rate='+newRate,
                            cache:false,
                            success:function (response2) {
                                if(response2 ==="success")
                                {

                                    swal("Thank you!", "You have successfully rated the product!", "success");
                                    $(".lead[data-id="+value.product_id+"]").text("Rating : "+newRate+"/5");
                                    refreshRating();
                                }
                                else
                                {
                                    swal("Error!", "Something wrong happened!", "error");
                                }
                            }

                        })
                    });

                });
            }
        });



    }
$(document).ready(function () {
    refreshRating();
    $(".btn-success.cart").on("click",function (e)
    {
        var productId= $(this).attr("data-id");
        e.preventDefault();
        $.ajax({
           type:'get',
            url:'../../action.php',
            data:'cart=add&pid='+productId,
            cache:false,
            success:function (response) {
            if(response)
            {
                swal("Thank you!", "You have successfully added a product to your cart!", "success");

            }
            else
            {
                swal("Error!", "You reached the maximum product quantity!", "error");

            }
            }
        });
    })

}) ;
</script>

