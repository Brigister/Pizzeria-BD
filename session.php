<?php
session_start();

if(isset($_SESSION["user"]) && $_SESSION["user"] instanceof Utente){
    $user = $_SESSION["user"];
    
    $isLogged = true;
    $isAdmin = $user -> isAdmin(); 
}else{
    $isLogged = false;
    $isAdmin = false;
}
