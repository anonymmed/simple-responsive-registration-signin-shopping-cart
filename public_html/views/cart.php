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
                    <input type="number" class="form-control text-center" value="<?=$mycart->getProductQuantity(); ?>">
                </td>
                <td data-th="Subtotal" class="text-center">$<?=$mycart->getProductQuantity()*$mycart->getProductPrice(); ?></td>
                <td class="actions" data-th="">
                    <a href="" class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></a>
                    <a href="../../action.php?delete=<?= $mycart->getId();?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
        <tfoot>
        <tr class="visible-xs">
            <td class="text-center"><strong>Total 1.99</strong></td>
        </tr>
        <tr>
            <td><a href="products.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total $1.99</strong></td>
            <td><select class="btn-group" required style="height: 30px;">
                    <option value="" disabled selected>Choose transport type</option>
                    <option value="first Option">Pick up 0$</option>
                    <option value="Second Option">UPS 5$</option>
                </select>
            </td>

        </tr>
        </tfoot>
    </table>
    <div class="btn-block">
    <input type="submit" name="checkout" class="btn btn-success btn-block" value="Checkout"/>
    </div>
</div>
