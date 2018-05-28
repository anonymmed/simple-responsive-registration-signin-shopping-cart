<?php
/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 28/05/2018
 * Time: 02:38
 */

use rating\Rating as Rating;
require_once (__DIR__.'/../Service/RatingService.php');
class RatingController
{
    /**
     * @param int $id
     * @return float|null
     */
    public function getRatingByProductId(int $id) : ? float
    {
        $ratingService = new RatingService();
        return $ratingService->getRatingByProductId($id);

    }


    /**
     * @return string
     */
    public function getProductsRating() : string
    {
        $ratingService = new RatingService();
        return $ratingService->getProductsRating();
    }

    /**
     * @param int $userId
     * @param int $productId
     * @param float $rate
     */
    public function insertRatingToProduct(int $userId, int $productId, float $rate) : void
    {
        $ratingService = new RatingService();
        $ratingService->insertRatingToProduct($userId,$productId,$rate);

    }

}