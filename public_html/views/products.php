<?php
require_once(__DIR__."/../layout/header.php");
require_once (__DIR__."/../../Controller/ProductController.php")
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
                        <p class="lead"> Rating : <?= $product['price'];?>$</p>
                        <div class="row">
                                  <div class="rateyo-readonly-widg" style="bottom: 20px;"></div>
                            <div class="col-xs-12 col-md-10">
                                <a class="btn btn-success" href="../../action.php?cart=add&pid=<?=$product['id'];?>" >Add to cart</a>
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

    $(function () {

        $.ajax({
           url:'../../action.php?rating',
           data:'',
           cache:false,
           success:function (data) {

           }
        });
        var rating = 3;


        $(".rateyo-readonly-widg").rateYo({

            rating: rating,
            numStars: 5,
            precision: 2,
            minValue: 1,
            maxValue: 5
        }).on("rateyo.change", function (e, data) {

            console.log(data.rating);
        });
    });
</script>

