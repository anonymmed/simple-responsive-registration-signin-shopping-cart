<?php
/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 26/05/2018
 * Time: 19:38
 */

namespace cart;

class Cart
{
private $id;
private $user_id;
private $product_id;
private $quantity;


    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }


    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * @return int
     */
    public function getUserId() : int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getProductId() : int
    {
        return $this->product_id;
    }


    /**
     * @param int $product_id
     */
    public function setProductId(int $product_id): void
    {
        $this->product_id = $product_id;
    }


    /**
     * @return int
     */
    public function getQuantity() : int
    {
        return $this->quantity;
    }


    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }


}