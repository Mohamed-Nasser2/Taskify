<?php
require_once '../inc/conn.php';
require_once '../inc/functions.php';

require_login();

if(isset($_POST['submit']) && isset($_GET['id'])){
    $id = $_GET['id'];
    $userId = $_SESSION['user_id'];
    $query = "select * from tasks where id = $id And user_id = $userId";
    $result = mysqli_query($conn , $query);
    if(mysqli_num_rows($result) == 1){
        $query = "delete from tasks where id=$id and user_id=$userId";
        $result = mysqli_query($conn , $query);
        if($result){
            $_SESSION['success'] = "Task Deleted";
            redirect("index.php");
        }else{
            $_SESSION['errors'] = ['Error while delete task'];
            redirect("index.php");
        }
    }else{
        $_SESSION['errors'] = ['Error while deleteing'];
        redirect("index.php");
    }
}else{
    redirect('../errors/404.php');
}

