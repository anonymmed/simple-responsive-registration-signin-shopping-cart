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
     * @param int $quantity
     * @return bool
     */
    public function addToCart(User $user, Product $product, int $quantity) : bool
    {
        if($quantity<= $product->getProductQuantity()) {
            $id = $user->getId();
            $pid = $product->getId();
            $productPrice = $product->getProductPrice();

            $rowcount = $this->getUserCartByProduct($id,$pid);

            if ($rowcount > 0) {
                $connection = Db::connect();
                $statement = $connection->prepare("select quantity from cart where user_id = :user_id and product_id = :product_id");
                $statement->bindParam("user_id", $id);
                $statement->bindParam("product_id", $pid);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $quantity = $result['quantity'];
                if($quantity<$product->getProductQuantity())
                {
                $statement = $connection->prepare("update cart set quantity = quantity+1 where user_id = :user_id and product_id = :product_id");
                $statement->bindParam("user_id", $id);
                $statement->bindParam("product_id", $pid);
                $statement->execute();
                return true;
                }
                else
                {
                    return false;
                }
            } else {
                $connection = Db::connect();
                $statement = $connection->prepare("INSERT INTO cart (user_id,product_id,quantity,product_price) VALUES (:user_id, :product_id, :quantity, :product_price)");
                $statement->bindParam("user_id", $id);
                $statement->bindParam("product_id", $pid);
                $statement->bindParam("quantity", $quantity);
                $statement->bindParam("product_price", $productPrice);
                $statement->execute();
                return true;
            }
        }
        return false;

    }

    /**
     * @param int $uid
     * @param int $id
     * @return int
     */
    public function getUserCartByProduct(int $uid, int $id) : int
    {
        $connection = Db::connect();
        $statement = $connection->prepare('select quantity  from cart where user_id= :user_id and product_id = :prod');
        $statement->bindParam("user_id",$uid);
        $statement->bindParam("prod",$id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $statement->rowCount();
    }


    /**
     * @param User $user
     * @param Product $product
     * @return float
     */
    public function removeFromCart(User $user, Product $product) : float
    {
        $id = $user->getId();
        $pid = $product->getId();
        $connection = Db::connect();
        $statement = $connection->prepare("DELETE from cart where product_id = :product_id and user_id = :user_id");
        $statement->bindParam("product_id",$pid);
        $statement->bindParam("user_id",$id);
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
        $id = $user->getId();
        $connection = Db::connect();
        $statement = $connection->prepare('select sum(product_price) as "total" from cart where user_id= :user_id');
        $statement->bindParam("user_id",$id);
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
     * @return bool
     */
    public function updateQuantity(User $user, Product $product, int $quantity) :  bool
    {
        $pid = $product->getId();
        if($quantity>$product->getProductQuantity())
        {
            return false;
        }
        $id = $user->getId();
        $connection = Db::connect();
        $statement = $connection->prepare('update cart set quantity = :quantity where user_id = :user_id and product_id = :product_id');
        $statement->bindParam("quantity",$quantity);
        $statement->bindParam("user_id",$id);
        $statement->bindParam("product_id",$pid);
        $statement->execute();
        return true;
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

    /**
     * @param int $user_id
     */
    public function emptyCartAfterCheckout(int $user_id) : void
    {
        $connection = Db::connect();
        $statement = $connection->prepare("delete from cart where user_id = :user_id");
        $statement->bindParam("user_id",$user_id);
        $statement->execute();

    }

}