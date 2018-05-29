<?php
namespace user;


class User
{
    private $id;
    private  $email;
    private $password;
    private  $firstName;
    private $lastName;
    private $cash;


    /**
     * @return float
     */
    public function getCash() : float
    {
        return $this->cash;
    }


    /**
     * @param float $cash
     */
    public function setCash(float $cash): void
    {
        $this->cash = $cash;
    }
    public function getCart()
    {

    }


    /**
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }


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
     * @param string $email
     */
    public function setEmail(string $email) : void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }


    /**
     * @param string $password
     */
    public function setPassword(string $password) : void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getFirstName() : string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName) : void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName() : string
    {
        return $this->lastName;
    }


    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName) : void
    {
        $this->lastName = $lastName;
    }




}