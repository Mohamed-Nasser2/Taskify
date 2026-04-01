<?php

function redirect($path){
    header("location:$path");
}

function clean($value){
    return trim(htmlspecialchars($value));
}

function require_login(){
    if(!isset($_SESSION['user_id'])){
        redirect("../auth/login.php");
    }
}