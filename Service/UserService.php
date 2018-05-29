<?php
/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 27/05/2018
 * Time: 04:53
 */
use \db\Db as Db;
use user\User as User;
require_once(__DIR__ . "/../resources/Db.php");
require_once(__DIR__ . "/../Entity/User.php");
class UserService
{

    /**
     * @param string $email
     * @param string $password
     * @return array|null
     */
    public function signIn(string $email, string $password) : ? array
    {
        $connection = db::connect();
        $statement = $connection->prepare("select * from users where email = :email LIMIT 1");
        $statement->bindParam("email",$email);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if($statement->rowCount()<1)
        {
            return null;
        }
        else
        {
            if(!password_verify($password,$result['password']))
            {
                echo "wrong";
                return null;
            }
            else
            {
                return $result;
            }
        }
    }


    /**
     * @param string $email
     * @param string $password
     * @param string $firstName
     * @param string $lastName
     * @return string
     */
    public function signUp(string $email, string $password, string $firstName, string $lastName) :string
    {

        $connection = Db::connect();
        $statement = $connection->prepare('select * from users where email = :email');
        $statement->bindParam("email",$email);
        $statement->execute();
        if($statement->rowCount() >0)
        {
            return "user taken";
        }

        $statement = $connection->prepare('insert into users (email,password,first_name,last_name) values (:email, :password, :first, :last)');
        $statement->bindParam("email",$email);
        $hash = password_hash($password,PASSWORD_DEFAULT);
        $statement->bindParam('password',$hash);
        $statement->bindParam("first",$firstName);
        $statement->bindParam("last",$lastName);
        $statement->execute();
        return "registration succeeded";
    }

    /**
     * @param int $id
     * @return User
     */
    public function getUserById(int $id) : User
    {
        $connection = Db::connect();
        $statement = $connection->prepare('select * from users where id = :id');
        $statement->bindParam("id",$id);
        $statement->execute();
        $user = new User();
        $result= $statement->fetch(PDO::FETCH_ASSOC);
        $user->setId($id);
        $user->setEmail($result['email']);
        $user->setLastName($result['first_name']);
        $user->setLastName($result['last_name']);
        return $user;

    }

    /**
     * @param int $uid
     * @param float $cash
     */
    public function updateCash(int  $uid, float $cash) : void
    {

        $connection = Db::connect();
        $statement = $connection->prepare("update users set cash = :cash where id = :user_id");
        $statement->bindParam("cash",$cash);
        $statement->bindParam("user_id", $uid);
        $statement->execute();
    }

}