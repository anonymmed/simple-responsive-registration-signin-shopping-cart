<?php
/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 28/05/2018
 * Time: 02:19
 */

namespace rating;


class Rating
{

    private $id;
    private $product_id;
    private $user_id;
    private $rating;


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
     * @return float
     */
    public function getRating() : float
    {
        return $this->rating;
    }


    /**
     * @param float $rating
     */
    public function setRating(float $rating): void
    {
        $this->rating = $rating;
    }


}