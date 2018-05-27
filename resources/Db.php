<?php
namespace db;
use PDO;

/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 26/01/2018
 * Time: 15:23
 */
class Db
{

    public function __construct()
    {
    }

    /**
     * @return PDO
     */
    public static function connect() :PDO
    {
        try {
            $connection = new PDO("mysql:host=localhost;dbname=abc", "root", "V4Vendetta");
            return $connection;
        }
        catch (PDOException $ex)
        {
            die($ex->getMessage());
        }
    }

}

