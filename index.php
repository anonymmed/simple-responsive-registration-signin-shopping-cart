<?php
require_once (__DIR__."/Controller/UserController.php");
if(session_status()== PHP_SESSION_NONE)
{
    session_start();
}
if(isset($_SESSION['id']))
{
    header('Location: home.php');
}
else {
    if(isset($_POST["login"]))
    {
        $userController = new UserController();
        $email =$_POST["email"];
        $password = trim($_POST['password']);
        $userInfo=$userController->signIn($email,$password);

        if(is_null($userInfo))
        {
            header('Location: ./public_html/views/signin.php?msg=error');
        }
        else
        {
            echo "success";
            $_SESSION['id'] =$userInfo['id'];
            $_SESSION['email']=$userInfo['email'];
            $_SESSION['fName']=$userInfo['first_name'];
            $_SESSION['lName']=$userInfo['last_name'];
            $_SESSION['cash']=$userInfo['cash'];
            header('Location: ./home.php');
        }
    }
    else if(isset($_POST["signup"]))
    {
        $userController = new UserController();
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $firstName = trim($_POST['firstName']);
        $lastName = trim($_POST['lastName']);
        $userController->signUp($email,$password,$firstName,$lastName);
        header("Location: ./public_html/views/signin.php");
    }
    else
    {
        header("Location: ./public_html/views/signin.php");
    }
}
?>