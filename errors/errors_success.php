<?php

if(isset($_SESSION['errors'])){
    echo '<div class="alert alert-danger" role="alert">';
    foreach($_SESSION['errors'] as $error){
        echo $error . "<br>";
    }
    echo "</div>";
    unset($_SESSION['errors']);
}elseif(isset($_SESSION['success'])){
    echo '<div class="alert alert-success" role="alert">';
    echo $_SESSION['success'];
    echo "</div>";
    unset($_SESSION['success']);
}