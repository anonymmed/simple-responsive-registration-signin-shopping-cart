<?php
if(session_status()== PHP_SESSION_NONE)
{
    session_start();
}
if(!isset($_SESSION['id']))
{
    header('Location: ./index.php');
}
else
{
header("Location: ./public_html/views/products.php");
}




?>