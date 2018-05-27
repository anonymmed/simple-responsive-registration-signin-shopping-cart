<?php
/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 27/05/2018
 * Time: 04:50
 */
require_once (__DIR__."/../Service/ProductService.php");

use product\Product as Product;
class ProductController
{

    /**
     * @param int $id
     * @return Product
     */
    public function getProductInfoById(int $id) : Product
    {
        $productService = new ProductService();
        return $productService->getProductInfoById($id);
    }

    /**
     * @param int $id
     */
    public function updateProductQuantity(int $id) : void
    {
        $productService = new ProductService();
        $productService->updateProductQuantity($id);

    }


    /**
     * @return array
     */
    public function getAllProducts() : array
    {
        $productService = new ProductService();
        return $productService->getAllProducts();
    }

}