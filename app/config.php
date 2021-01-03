<?php 
session_start();

if(isset($_COOKIE['lang']) && !isset($_GET['lang']))
{
    $_SESSION['lang']= $_COOKIE['lang'];  
}
else
{
    if(!isset($_SESSION['lang']))
    {
        $_SESSION['lang']= "en";
    }
    else 
    if(isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty ( $_GET['lang']))
        {
            if($_GET['lang']=="en")
            {
            $_SESSION['lang'] = "en";
            setcookie('lang',$_SESSION['lang'], time()+2678400);
            }
            else if($_GET['lang']=="ru")
            {
            $_SESSION['lang'] = "ru";
            setcookie('lang',$_SESSION['lang'], time()+2678400);
            }
            else if($_GET['lang']=="ukr")
            {
            $_SESSION['lang'] = "ukr";
            setcookie('lang',$_SESSION['lang'], time()+2678400);
            }
        }
}
    require "languages/" . $_SESSION['lang'] . ".php";
?>