<?php
/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 27/05/2018
 * Time: 04:53
 */
namespace CartService;
use db\Db as Db;
use PDO;
use product\Product;
use user\User;
use ProductService ;
require_once (__DIR__."/../resources/Db.php");
require_once (__DIR__."/../Service/ProductService.php");

class CartService
{
    /**
     * @param User $user
     * @param Product $product
     */
    public function addToCart(User $user, Product $product) : void
    {
        /**
         * Check if added quantity <= product quantity
         */
        $initialQuantity=1;
        $connection = Db::connect();
        $statement = $connection->prepare("INSERT INTO cart (user_id,product_id,quantity) VALUES (:user_id, :product_id, :quantity)");
        $statement->bindParam("user_id",$user->getId());
        $statement->bindParam("product_id",$product->getId());
        $statement->bindParam("quantity",$initialQuantity);
        $statement->execute();


    }


    /**
     * @param User $user
     * @param Product $product
     * @return float
     */
    public function removeFromCart(User $user, Product $product) : float
    {
        $pid = $product->getId();
        $uid=$user->getId();
        $connection = Db::connect();
        $statement = $connection->prepare("DELETE from cart where product_id = :product_id and user_id = :user_id");
        $statement->bindParam("product_id",$pid);
        $statement->bindParam("user_id",$uid);
        $statement->execute();
        if($this->getTotal($user)==null)
        {
            return 0;
        }
        return $this->getTotal($user);

    }

    /**
     * @param User $user
     * @return float|null
     */
    public function getTotal(User $user) : ? float
    {
        $connection = Db::connect();
        $statement = $connection->prepare('select sum(product_price) as "total" from cart where user_id= :user_id');
        $statement->bindParam("user_id",$user->getId());
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if($result["total"]== "NULL")
        {
            return null;
        }

        return $result["total"];
    }


    /**
     * @param User $user
     * @param Product $product
     * @param int $quantity
     * @return null|string
     */
    public function updateQuantity(User $user, Product $product, int $quantity) : ? string
    {
        if($quantity>$product->getProductQuantity())
        {
            return null;
        }
        $connection = Db::connect();
        $statement = $connection->prepare('update cart set quantity = :quantity where user_id = :user_id');
        $statement->bindParam("quantity",$quantity);
        $statement->bindParam("user_id",$user->getId());
        $statement->execute();
        return "update has been successfully done";
    }


    /**
     * @param User $user
     * @return array|null
     */
    public function getMyCart(User $user) : ? array
    {
        $id = $user->getId();
        $listProduct = [];
        $productService = new ProductService();
        $connection = Db::connect();
        $statement = $connection->prepare("select * from cart where user_id = :user_id");
        $statement->bindParam("user_id",$id);
        $statement->execute();
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $products)
        {
            $product =$productService->getProductInfoById($products["product_id"]);
            $product->setProductQuantity($products['quantity']);
            $listProduct[]=$product;
        }
        return $listProduct;
    }

}