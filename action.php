<?php
use user\User as User;
require_once (__DIR__."/Controller/UserController.php");
require_once (__DIR__."/Controller/CartController.php");
require_once (__DIR__."/Controller/ProductController.php");
require_once (__DIR__."/Controller/RatingController.php");
require_once (__DIR__."/Entity/User.php");
if(session_status()== PHP_SESSION_NONE)
{
    session_start();
}

if(isset($_GET['delete']))
{
$cartController = new CartController();
$userController = new UserController();
$user = $userController->getUserById($_SESSION['id']);
$productController = new ProductController();
$product = $productController->getProductInfoById($_GET['delete']);
$cartController->removeFromCart($user,$product);
header('Location: ./public_html/views/cart.php');
}
if (isset($_GET['logout']))
{
$_SESSION =[];
session_destroy();
header('Location: ./index.php');
}

if (isset($_GET['red']))
{
    if ($_GET['red'] == 'home')
    {
        header('Location: ./home.php');
    }
    else if ($_GET['red'] == 'index')
    {
        header('Location: ./index.php');

    }
    else if ($_GET['red'] == 'cart')
    {
        header('Location: ./public_html/views/cart.php');

    }
}
if (isset($_GET['cart']))
{
    if ($_GET['cart'] == 'add')
    {
        $userController = new UserController();
        $user = $userController->getUserById($_SESSION['id']);
        $productController = new ProductController();
        $product = $productController->getProductInfoById($_GET['pid']);
        $cartController = new CartController();
        echo $cartController->addToCart($user,$product,1);
        }
}
    if (isset($_POST['rating']))
    {

         $ratingController = new RatingController();
         echo $ratingController->getProductsRating();
    }
    if((isset($_GET['insertRating'])))
    {
        $ratingController = new RatingController();
        $ratingController->insertRatingToProduct($_SESSION['id'],$_GET['product_id'],$_GET['rate']);
        echo "success";
    }
    if(isset($_GET['getrow']))
    {
        $cartController = new CartController();
        echo  $cartController->getUserCartByProduct(1);
    }
    if(isset($_POST['refresh']))
    {
        $cartController = new CartController();
        $userController = new UserController();
        $user = $userController->getUserById($_SESSION['id']);
        $productController = new ProductController();
        $product = $productController->getProductInfoById($_POST['product_id']);
        if($_POST['quantity'] == 0)
        {
            $cartController->removeFromCart($user,$product);
            echo "product removed from cart";
        }
        else
        {
        echo  $cartController->updateQuantity($user,$product,$_POST['quantity']);
        }
    }

    if(isset($_POST['checkout']))
    {
        if($_POST['price']<=$_SESSION['cash'])
        {
            $cartController = new CartController();
            $cartController->emptyCartAfterCheckout($_SESSION['id']);
            $_SESSION['cash']-=$_POST['price'];
            echo true;
        }
        else
        {
            echo false;
        }
    }
?>