<?php
require_once(__DIR__."/../layout/header.php");
require_once (__DIR__."/../../Controller/CartController.php");
require_once (__DIR__."/../../Controller/UserController.php");
if(session_status()== PHP_SESSION_NONE)
{
    session_start();
}

?>
<div class="container">
    <?php
    require_once (__DIR__."/../layout/topmenu.php");
    ?>
    <br><br>
    <hr>
    <div class="row">
        <div class="col-md-2 col-md-offset-5">
            <strong style="margin-left: 20px;" class="alert-success">My shopping cart</strong>

        </div>
    </div>
    <hr>
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $cartController = new CartController();
        $userController = new UserController();
        $user = $userController->getUserById($_SESSION['id']);
        foreach ($cartController->getMyCart($user) as $mycart) {
            ?>
            <tr>
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-2 hidden-xs"><img src="../images/<?=$mycart->getProductName().'.jpg' ?>" alt="..."
                                                             class="img-responsive"/></div>
                        <div class="col-sm-10">
                            <h4 class="nomargin"><?=$mycart->getProductName(); ?></h4>
                        </div>
                    </div>
                </td>
                <td data-th="Price">$<?=$mycart->getProductPrice(); ?></td>
                <td data-th="Quantity">
                    <input type="number" class="form-control text-center quantity" data-id="<?= $mycart->getId();?>" value="<?=$mycart->getProductQuantity(); ?>">
                </td>
                <td data-th="Subtotal" class="text-center subtotal" data-id="<?= $mycart->getId();?>" data-price="<?=$mycart->getProductPrice(); ?>"><?=$mycart->getProductQuantity()*$mycart->getProductPrice(); ?></td>
                <td class="actions" data-th="">
                    <a href="" data-id="<?= $mycart->getId();?>" class="btn btn-info btn-sm refresh"><i class="fa fa-refresh"></i></a>
                    <a href="../../action.php?delete=<?= $mycart->getId();?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
        <tfoot>
        <tr class="visible-xs">
            <td class="text-center"><strong class="total">Total 1.99</strong></td>
        </tr>
        <tr>
            <td><a href="products.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong class="total">Total $1.99</strong></td>
            <td><select class="btn-group" name="transport" required style="height: 30px;">
                    <option value="disabled" disabled selected>Choose transport type</option>
                    <option value="0">Pick up 0$</option>
                    <option value="5">UPS 5$</option>
                </select>
            </td>

        </tr>
        </tfoot>
    </table>
    <div class="btn-block">
    <input type="submit" name="checkout" class="btn btn-success btn-block" value="Checkout"/>
    </div>
</div>
<script>
    function getTotal(a)
    {

        var products = $('.subtotal');
        var total = 0;
        for (var i=0;i<products.length;i++)
        {
            total +=parseFloat(products[i].innerHTML);
        }
        if(a==null)
        {
        $('.total').text("$"+total.toFixed(2));
        }
        else
        {
            a=parseFloat(a);

            total+=a;
            $('.total').text("$"+total.toFixed(2));

        }
        return total;
    };
    $(document).ready(function () {
        getTotal();
        var products = $('.subtotal');
        var total = 0;
       $('.refresh').on("click",function (e) {
           e.preventDefault();
           var pid = $(this).attr("data-id");
           var quantity = $('.quantity[data-id='+pid+']').val();
           $.ajax({
               type:'post',
               url:'../../action.php',
               data:'refresh=yes&product_id='+pid+'&quantity='+quantity,
               cache:false,
               success:function (response) {
                   if(response == true)
                   {
                       var sub = $('.subtotal[data-id='+pid+']').attr('data-price') * quantity;
                       sub= sub.toFixed(2);
                       $('.subtotal[data-id='+pid+']').text(sub);
                      getTotal();
                       swal("Great!", "You have successfully updated the product quantity! to "+quantity, "success");

                   }
                   else if(response =="product removed from cart")
                   {
                       swal("Great!", "You have successfully removed the product from your cart! ", "success");
                       setTimeout(function () {
                           window.location.href="cart.php";

                       },2000);
                   }
                   else
                   {
                       swal("Error!", "You reached the maximum product quantity on stock!", "error");
                   }
               }
           })
       });
        $('.btn-group').on("change",function (e) {
            var price = $('.btn-group option:selected').val();
            getTotal(price);

        });

        $('.btn.btn-success.btn-block').on("click",function (e) {
            if($('.btn-group option:selected').val()==="disabled")
            {
                swal("Error!", "Please select a transport method!", "error");
            }
            else
            {
            var price = $('.btn-group option:selected').val();
            var total = parseFloat(getTotal(price));
            total=total.toFixed(2);
           e.preventDefault();
           $.ajax({
              type:'post',
              url:'../../action.php',
              data:'checkout=yes&price='+total,
               cache:false,
               success:function (response) {
                   if(response)
                   {

                       swal("Great!", "You have successfully paid your products! ", "success");
                       setTimeout(function () {
                           window.location.href='products.php';
                       },2000);
                   }
                   else
                   {
                       swal("Error!","insufficient funds!","error");
                   }
               }
           });
        }
        });
    });
</script>