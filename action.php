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
?>