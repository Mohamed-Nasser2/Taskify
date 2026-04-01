<?php

require_once "../inc/conn.php";
require_once "../inc/functions.php";

if(isset($_POST['submit'])){
    $title = clean($_POST['title']);
    $description = clean($_POST['description']);
    $_SESSION['title'] = $title;
    $_SESSION['description'] = $description;
    $errors=[];
    if(empty($title)){
        $errors[] = "title is required";
    }

    if(empty($description)){
        $errors[] = "description is required";
    }

    $user_id = $_SESSION['user_id'];

    if(empty($errors)){
        $query = "insert into tasks (`title` , `description` , `user_id`) values ('$title' , '$description' , '$user_id')";
        $result = mysqli_query($conn , $query);
        if($result){            
            $_SESSION['success'] = "Task Created";
            redirect("index.php");
        }else{
            $_SESSION['errors'] = ['error while creating task'];
            redirect("index.php");
        }
    }else{
        $_SESSION['errors'] = $errors;
        redirect("index.php");
    }
}else{
    redirect("../errors/404.php");
}