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
            <div class="item  col-xs-4 col-lg-4">
                <div class="thumbnail">
                    <img style="width: 255px;height: 255px;" class="group list-group-image" src="../images/<?= $product['product_name'].'.jpg';?>" alt="<?= $product['product_name']; ?>"/>
                    <div class="caption">
                        <h4 class="group inner list-group-item-heading">
                            Product name: <?= $product['product_name']; ?></h4>
                        <p class="lead">
                            Quantity: <?= $product['quantity'];?></p>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <p class="lead">
                                    Product price : <?= $product['price'];?>$</p>
                            </div>
                            <br><br>
                            <div class="col-xs-12 col-md-6">
                                <a class="btn btn-success" href="">Add to cart</a>
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
