<?php
/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 26/05/2018
 * Time: 19:38
 */

namespace product;

class Product
{
    private $id;
    private $productName;
    private $productQuantity;
    private $productPrice;


    /**
     * @return int
     */
    public function getId() :int
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
     * @return string
     */
    public function getProductName() : string
    {
        return $this->productName;
    }


    /**
     * @param string $productName
     */
    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return int
     */
    public function getProductQuantity() : int
    {
        return $this->productQuantity;
    }

    /**
     * @param int $productQuantity
     */
    public function setProductQuantity(int $productQuantity): void
    {
        $this->productQuantity = $productQuantity;
    }


    /**
     * @return float
     */
    public function getProductPrice() : float
    {
        return $this->productPrice;
    }


    /**
     * @param float $productPrice
     */
    public function setProductPrice(float $productPrice): void
    {
        $this->productPrice = $productPrice;
    }




}