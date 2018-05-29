<?php
/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 28/05/2018
 * Time: 02:39
 */



use rating\Rating as Rating;
use db\Db as Db;
require_once (__DIR__.'/../Entity/Rating.php');
class RatingService
{

    /**
     * @param int $id
     * @return float|null
     */
    public function getRatingByProductId(int $id) : ? float
    {
        $connection = Db::connect();
        $statement = $connection->prepare("select truncate(avg(rate),2) as 'rate' from rating where product_id = :product_id");
        $statement->bindParam("product_id",$id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if($result['rate']=="NULL")
        {
            return null;
        }
        return number_format($result['rate'],2);
    }


    /**
     * @return string
     */
    public function getProductsRating() : string
    {
        $connection = Db::connect();
        $statement = $connection->query("select product_id, truncate(avg(rate),2) as 'rate' from rating GROUP by product_id");
        $statement->execute();
        return json_encode($statement->fetchAll(PDO::FETCH_ASSOC),true);


    }

    /**
     * @param int $id
     * @return string
     */
    public function getProductRatingById(int $id) : string
    {
        $connection = Db::connect();
        $statement = $connection->prepare("select product_id, truncate(avg(rate),2) as 'rate' from rating where product_id = :product_id GROUP by product_id");
        $statement->bindParam("product_id",$id);
        $statement->execute();
        return json_encode($statement->fetch(PDO::FETCH_ASSOC),true);


    }


    /**
     * @param int $userId
     * @param int $productId
     * @param float $rate
     * @return bool
     */
    public function insertRatingToProduct(int $userId, int $productId, float $rate) : bool
    {

        $connection = Db::connect();
        $statement = $connection->prepare("select rate from rating where user_id = :user_id and product_id = :product_id");
        $statement->bindParam("product_id",$productId);
        $statement->bindParam("user_id",$userId);
        $statement->execute();
        $statement->fetch(PDO::FETCH_ASSOC);
        if($statement->rowCount()>0)
        {
           return false;
        }
        else
        {
        $statement = $connection->prepare("insert into rating (product_id,user_id,rate) values (:product_id, :user_id, :rate)");
        $statement->bindParam("product_id",$productId);
        $statement->bindParam("user_id",$userId);
        $statement->bindParam("rate",$rate);
        $statement->execute();
        return true;
        }
    }
}