<?php
/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 27/05/2018
 * Time: 04:50
 */
require_once (__DIR__."/../Service/UserService.php");
use user\User as User;
class UserController
{
    /**
     * @param string $email
     * @param string $password
     * @return array|null
     */
    public function signIn(string $email, string $password) : ? array
    {
        $userService = new UserService();
        return $userService->signIn($email,$password);
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

        $userService = new UserService();
        return $userService->signUp($email,$password,$firstName,$lastName);
    }

    /**
     * @param int $id
     * @return User
     */
    public function getUserById(int $id) : User
    {
        $userService = new UserService();
        return $userService->getUserById($id);
    }
    /**
     * @param int $uid
     * @param float $cash
     */
    public function updateCash(int  $uid, float $cash) : void
    {
        $userService = new UserService();
        $userService->updateCash($uid,$cash);
    }

}