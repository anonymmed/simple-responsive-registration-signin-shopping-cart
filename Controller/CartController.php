<?php
/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 27/05/2018
 * Time: 04:50
 */

use CartService\CartService as CartService;
use product\Product as Product;
use user\User as User;
require_once (__DIR__."/../Service/CartService.php");

class CartController
{


    /**
     * @param User $user
     * @param Product $product
     * @param int $quantity
     * @return bool
     */
    public function addToCart(User $user, Product $product, int $quantity) : bool
    {
    $cartService = new CartService();
    return $cartService->addToCart($user,$product,$quantity);

    }


    /**
     * @param int $uid
     * @param int $id
     * @return int
     */
    public function getUserCartByProduct(int $uid, int $id) : int
    {
        $cartService = new CartService();
        return $cartService->getUserCartByProduct($id);
    }


    /**
     * @param User $user
     * @param Product $product
     * @return float
     */
    public function removeFromCart(User $user, Product $product) : float
    {
        $cartService = new CartService();
        return $cartService->removeFromCart($user,$product);
    }

    /**
     * @param User $user
     * @return float|null
     */
    public function getTotal(User $user) : ? float
    {
        $cartService = new CartService();
        return $cartService->getTotal($user);
    }


    /**
     * @param User $user
     * @param Product $product
     * @param int $quantity
     * @return bool
     */
    public function updateQuantity(User $user, Product $product, int $quantity) :  bool
    {
        $cartService = new CartService();
        return $cartService->updateQuantity($user,$product,$quantity);
    }

    /**
     * @param User $user
     * @return array|null
     */
    public function getMyCart(User $user) : ? array
    {
        $cartService = new CartService();
        return $cartService->getMyCart($user);
    }


    /**
     * @param int $user_id
     */
    public function emptyCartAfterCheckout(int $user_id) : void
    {
        $cartService = new CartService();
        $cartService->emptyCartAfterCheckout($user_id);

    }


}