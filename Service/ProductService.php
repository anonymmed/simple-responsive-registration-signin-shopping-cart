<?php
/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 27/05/2018
 * Time: 04:53
 */
use db\Db as Db;
use product\Product as Product;
require_once(__DIR__ . "/../resources/Db.php");
require_once(__DIR__ . "/../Entity/Product.php");

class ProductService
{
    /**
     * @param int $id
     * @return Product
     */
    public function getProductInfoById(int $id) : Product
    {
        $connection = Db::connect();
        $statement = $connection->prepare("select * from products where id = :id");
        $statement->bindParam("id",$id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $product = new Product();
        $product->setId($result['id']);
        $product->setProductName($result['product_name']);
        $product->setProductPrice($result['price']);
        $product->setProductQuantity($result['quantity']);
        return $product;

    }

    /**
     * @param int $id
     */
    public function updateProductQuantity(int $id) : void
    {
        $connection = Db::connect();
        $statement = $connection->query("update products set quantity = quantity-1 where id = :id");
        $statement->bindParam("id",$id);
        $statement->execute();

    }

    /**
     * @return array
     */
    public function getAllProducts() : array
    {
        $connection = Db::connect();
        $query = $connection->query("select * from products");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}