<?php
use user\User as User;
require_once (__DIR__."/Controller/UserController.php");
require_once (__DIR__."/Controller/CartController.php");
require_once (__DIR__."/Controller/ProductController.php");
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
        if($cartController->addToCart($user,$product,1)) {
             header('Location: ./public_html/views/cart.php');
        }
        else
        {
            header('Location: ./public_html/views/products.php?msg=quantity not available');
        }
        }
}
?>