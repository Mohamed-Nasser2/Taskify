<?php

require_once "../inc/conn.php";
require_once "../inc/functions.php";

if(isset($_POST['submit']) && isset($_GET['id'])){
    $id = $_GET['id'];
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
        $query = "select * from tasks where id = $id and user_id = $user_id";
        $result = mysqli_query($conn , $query);
        if(mysqli_num_rows($result) ==1){
            $query = "update tasks set title = '$title' , description = '$description' , updated_at = now() where id=$id and user_id=$user_id";
            $result = mysqli_query($conn , $query);
            if($result){            
                $_SESSION['success'] = "Task Updated";
                redirect("index.php");
            }else{
                $_SESSION['errors'] = ['error while updating task'];
                redirect("index.php");
            }
        }else{
                $_SESSION['errors'] = ['error while updating task'];
                redirect("index.php");
        }

    }else{
        $_SESSION['errors'] = $errors;
        redirect("edit.php?id=$id");
    }
}else{
    redirect("../errors/404.php");
}